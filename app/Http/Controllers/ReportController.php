<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Receipt;
// use App\Models\Product;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function downloadReport($type)
    {
        $startDate = ($type == 'weekly') ? now()->startOfWeek() : now()->startOfMonth();
        $endDate = now();

        $receipts = Receipt::whereBetween('created_at', [$startDate, $endDate])->with('items.product')->get();
        
        $totalSales = $receipts->sum('total_amount');
        $totalOrders = $receipts->count();
        
        // Data structure for the PDF
        $data = [
            'type' => ucfirst($type),
            'date_range' => $startDate->format('d M, Y') . ' to ' . $endDate->format('d M, Y'),
            'receipts' => $receipts,
            'totalSales' => $totalSales,
            'totalOrders' => $totalOrders,
        ];

        $pdf = Pdf::loadView('reports.inventory_pdf', $data);
        return $pdf->download("PharmaLink_{$type}_Report.pdf");
    }
}