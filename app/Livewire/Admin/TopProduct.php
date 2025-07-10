<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\SalesItem;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;

class TopProduct extends Component
{
    use WithPagination;

    public $sortBy = 'total_sold';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $search = '';
    public $timeRange = 'all_time';
    public $categoryFilter = '';

    protected $queryString = [
        'sortBy' => ['except' => 'total_sold'],
        'sortDirection' => ['except' => 'desc'],
        'perPage' => ['except' => 10],
        'search' => ['except' => ''],
        'timeRange' => ['except' => 'all_time'],
        'categoryFilter' => ['except' => '']
    ];

    public function mount()
    {
        // Initialization if needed
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'desc';
        }
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        // First get aggregated data with product IDs
        $productAggregates = Product::query()
            ->select([
                'products.id',
                DB::raw('COALESCE(SUM(sales_items.qty), 0) as total_sold'),
                DB::raw('COALESCE(SUM(sales_items.total), 0) as total_revenue')
            ])
            ->leftJoin('sales_items', 'products.id', '=', 'sales_items.product_id')
            ->leftJoin('sales', 'sales_items.sale_id', '=', 'sales.id')
            ->when($this->timeRange !== 'all_time', function ($query) {
                $dateRange = $this->getDateRange();
                $query->whereBetween('sales.created_at', $dateRange);
            })
            ->when($this->categoryFilter, function ($query) {
                $query->where('products.category_id', $this->categoryFilter);
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('products.name', 'like', '%' . $this->search . '%')
                        ->orWhere('products.sku', 'like', '%' . $this->search . '%');
                });
            })
            ->groupBy('products.id')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->get();

        // Get the IDs in correct order for pagination
        $productIds = $productAggregates->pluck('id')->toArray();

        // Get full product data with pagination
        $products = Product::with(['category'])
            ->whereIn('id', $productIds)
            ->orderByRaw("FIELD(id, " . implode(',', $productIds) . ")")
            ->paginate($this->perPage);

        // Merge aggregates back into products
        $products->each(function ($product) use ($productAggregates) {
            $aggregate = $productAggregates->firstWhere('id', $product->id);
            $product->total_sold = $aggregate->total_sold ?? 0;
            $product->total_revenue = $aggregate->total_revenue ?? 0;
        });

        $categories = Category::orderBy('cat_title')->get();

        return view('livewire.admin.top-product', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    protected function getDateRange()
    {
        $now = now();

        return match ($this->timeRange) {
            'today' => [$now->startOfDay(), $now->endOfDay()],
            'this_week' => [$now->startOfWeek(), $now->endOfWeek()],
            'this_month' => [$now->startOfMonth(), $now->endOfMonth()],
            'this_year' => [$now->startOfYear(), $now->endOfYear()],
            'last_month' => [$now->subMonth()->startOfMonth(), $now->endOfMonth()],
            'last_quarter' => [$now->subMonths(3)->startOfMonth(), $now->endOfMonth()],
            default => [now()->subYears(10), now()], // All time
        };
    }
}
