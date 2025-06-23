<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Sales;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]
class Dashboard extends Component
{
    public $totalProduct, $totalSales, $totalCustomer, $totalInvoice;
    // for sales chart
    public $salesLabels, $salesTotals;
    // for categories chart
    public $categoryLabels = [], $categorySales = [];
    public function mount()
    {
        // total count
        $this->totalProduct = Product::count();
        $this->totalSales = Sales::count();
        $this->totalCustomer = Customer::count();
        $this->totalInvoice = Invoice::count();

        //sales chart work
        $sales = Sales::selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
            ->where('created_at', '>=', now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = [];
        $totals = [];
        $days = collect(range(0, 6))->map(fn($i) => now()->subDays($i)->format('Y-m-d'))->reverse();

        foreach ($days as $day) {
            $labels[] = \Carbon\Carbon::parse($day)->format('D'); // Mon, Tue...
            $totals[] = (float) ($sales->firstWhere('date', $day)->total ?? 0);
        }

        $this->salesLabels = $labels;
        $this->salesTotals = $totals;

        // categories chart work
        $data = DB::table('sales_items')
            ->join('products', 'sales_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category', '=', 'categories.id')
            ->select('categories.cat_title', DB::raw('COUNT(sales_items.id) as total_sales'))
            ->groupBy('categories.cat_title')
            ->orderByDesc('total_sales')
            ->limit(5)
            ->get();

        $this->categoryLabels = $data->pluck('name');
        $this->categorySales = $data->pluck('total_sales')->toArray();
    }

    public function render()
    {
        return view('livewire.admin.dashboard')->layout('components.layouts.admin');
    }
}
