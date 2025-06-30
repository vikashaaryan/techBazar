<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Http\Controllers\Controller;
use App\Models\Sales;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{

    public function dashboard()
    {
        // Get quote statistics
        $quoteStats = DB::table('quotes')
            ->select(
                'status',
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(total) as total_amount'), // Changed from total_amount to total
                DB::raw('CASE 
                    WHEN status = "draft" THEN "text-gray-600"
                    WHEN status = "sent" THEN "text-blue-600"
                    WHEN status = "accepted" THEN "text-green-600"
                    WHEN status = "rejected" THEN "text-red-600"
                    WHEN status = "converted" THEN "text-purple-600"
                    ELSE "text-gray-600"
                END as color_class')
            )
            ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->groupBy('status')
            ->get();

        $totalQuotesAmount = $quoteStats->sum('total_amount');

        // Get invoice statistics
        $invoiceStats = DB::table('invoices')
            ->select(
                'status',
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(total) as total_amount'), // Changed from total_amount to total
                DB::raw('CASE 
                    WHEN status = "draft" THEN "text-gray-600"
                    WHEN status = "sent" THEN "text-blue-600"
                    WHEN status = "accepted" THEN "text-green-600"
                    WHEN status = "rejected" THEN "text-red-600"
                    WHEN status = "cancelled" THEN "text-gray-400"
                    ELSE "text-gray-600"
                END as color_class')
            )
            ->whereBetween('created_at', [now()->startOfQuarter(), now()->endOfQuarter()])
            ->groupBy('status')
            ->get();

        $totalInvoicesAmount = $invoiceStats->sum('total_amount');

        $overdueInvoices = DB::table('invoices')
            ->where('due_date', '<', now())
            ->where('status', '!=', 'paid')
            ->sum('total');

        return view('manager.dashboard', compact(
            'quoteStats',
            'totalQuotesAmount',
            'invoiceStats',
            'totalInvoicesAmount',
            'overdueInvoices'
        ));
    }
    public function managerSetting()
    {
        $manager = Staff::all();
        return view('manager.manager-settings', compact('manager'));
    }
   
}
