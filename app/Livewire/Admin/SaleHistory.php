<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Sales;
use App\Models\Product;
use Carbon\Carbon;

class SaleHistory extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $customerFilter = '';
    public $productFilter = '';
    public $dateFilter = '';
    public $statusFilter = '';
    public $paymentStatusFilter = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $timePeriod = 'all';
    public $fromDate = '';
    public $toDate = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'customerFilter' => ['except' => ''],
        'productFilter' => ['except' => ''],
        'dateFilter' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'paymentStatusFilter' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
        'perPage' => ['except' => 10],
        'timePeriod' => ['except' => 'all'],
    ];

    public function mount()
    {
        // Initialize date filters if needed
        if ($this->timePeriod === 'custom' && ($this->fromDate || $this->toDate)) {
            $this->applyCustomDateRange();
        }
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'desc';
        }
    }

    public function updatedTimePeriod($value)
    {
        if ($value !== 'custom') {
            $this->reset(['fromDate', 'toDate']);
            $this->applyTimePeriodFilter();
        }
    }

    public function applyTimePeriodFilter()
    {
        $this->resetPage();

        switch ($this->timePeriod) {
            case 'today':
                $this->dateFilter = now()->format('Y-m-d') . ' to ' . now()->format('Y-m-d');
                break;
            case 'week':
                $this->dateFilter = now()->startOfWeek()->format('Y-m-d') . ' to ' . now()->endOfWeek()->format('Y-m-d');
                break;
            case 'month':
                $this->dateFilter = now()->startOfMonth()->format('Y-m-d') . ' to ' . now()->endOfMonth()->format('Y-m-d');
                break;
            case 'year':
                $this->dateFilter = now()->startOfYear()->format('Y-m-d') . ' to ' . now()->endOfYear()->format('Y-m-d');
                break;
            case 'all':
                $this->dateFilter = '';
                break;
        }
    }

    public function applyCustomDateRange()
    {
        if ($this->fromDate && $this->toDate) {
            $this->dateFilter = $this->fromDate . ' to ' . $this->toDate;
        } elseif ($this->fromDate) {
            $this->dateFilter = $this->fromDate . ' to ' . $this->fromDate;
        }
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset([
            'search',
            'customerFilter',
            'productFilter',
            'dateFilter',
            'statusFilter',
            'paymentStatusFilter',
            'timePeriod',
            'fromDate',
            'toDate'
        ]);
        $this->resetPage();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $sales = Sales::with(['customer', 'user', 'items.product'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('invoice_no', 'like', '%' . $this->search . '%')
                        ->orWhereHas('customer', function ($q) {
                            $q->where('name', 'like', '%' . $this->search . '%')
                                ->orWhere('phone', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('user', function ($q) {
                            $q->where('name', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->when($this->customerFilter, function ($query) {
                $query->where('customer_id', $this->customerFilter);
            })
            ->when($this->productFilter, function ($query) {
                $query->whereHas('items', function ($q) {
                    $q->where('product_id', $this->productFilter);
                });
            })
            ->when($this->dateFilter, function ($query) {
                $dateRange = explode(' to ', $this->dateFilter);
                $startDate = Carbon::parse($dateRange[0])->startOfDay();
                $endDate = isset($dateRange[1])
                    ? Carbon::parse($dateRange[1])->endOfDay()
                    : $startDate->copy()->endOfDay();

                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->when($this->paymentStatusFilter, function ($query) {
                if ($this->paymentStatusFilter === 'paid') {
                    $query->whereColumn('amount_paid', '>=', 'total_amount');
                } elseif ($this->paymentStatusFilter === 'partial') {
                    $query->where('amount_paid', '>', 0)
                        ->whereColumn('amount_paid', '<', 'total_amount');
                } elseif ($this->paymentStatusFilter === 'due') {
                    $query->where('amount_paid', 0);
                }
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $customers = Customer::orderBy('name')->get();
        $products = Product::orderBy('name')->get();
        $statuses = ['completed', 'pending', 'canceled', 'draft', 'sent', 'accepted', 'rejected'];
        $paymentStatuses = ['paid', 'partial', 'due'];

        // Calculate summary statistics
        $totalSales = Sales::when($this->dateFilter, function ($query) {
            $dateRange = explode(' to ', $this->dateFilter);
            $startDate = Carbon::parse($dateRange[0])->startOfDay();
            $endDate = isset($dateRange[1])
                ? Carbon::parse($dateRange[1])->endOfDay()
                : $startDate->copy()->endOfDay();

            $query->whereBetween('created_at', [$startDate, $endDate]);
        })
            ->sum('total_amount');

        $monthlySales = Sales::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('total_amount');

        $averageSale = Sales::when($this->dateFilter, function ($query) {
            $dateRange = explode(' to ', $this->dateFilter);
            $startDate = Carbon::parse($dateRange[0])->startOfDay();
            $endDate = isset($dateRange[1])
                ? Carbon::parse($dateRange[1])->endOfDay()
                : $startDate->copy()->endOfDay();

            $query->whereBetween('created_at', [$startDate, $endDate]);
        })
            ->avg('total_amount');

        $totalDue = Sales::whereColumn('amount_paid', '<', 'total_amount')
            ->when($this->dateFilter, function ($query) {
                $dateRange = explode(' to ', $this->dateFilter);
                $startDate = Carbon::parse($dateRange[0])->startOfDay();
                $endDate = isset($dateRange[1])
                    ? Carbon::parse($dateRange[1])->endOfDay()
                    : $startDate->copy()->endOfDay();

                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->selectRaw('SUM(total_amount - amount_paid) as total_due')
            ->value('total_due') ?? 0;

        return view('livewire.admin.sale-history', [
            'sales' => $sales,
            'customers' => $customers,
            'products' => $products,
            'statuses' => $statuses,
            'paymentStatuses' => $paymentStatuses,
            'totalSales' => $totalSales,
            'monthlySales' => $monthlySales,
            'averageSale' => $averageSale,
            'totalDue' => $totalDue,
        ]);
    }
}
