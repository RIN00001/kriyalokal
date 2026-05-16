<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\SellerReport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        $seller = auth()->user()->seller;

        $reports = SellerReport::where('seller_id', $seller->id)
            ->latest()
            ->paginate(10);

        $orderItems = OrderItem::where('seller_id', $seller->id)->get();

        $totalSales = $orderItems->sum('subtotal');

        $totalProductsSold = $orderItems->sum('quantity');

        $totalOrders = $orderItems->count();

        return view('seller.reports.index', compact(
            'reports',
            'totalSales',
            'totalProductsSold',
            'totalOrders'
        ));
    }

    public function generate()
    {
        $seller = auth()->user()->seller;

        $orderItems = OrderItem::where('seller_id', $seller->id)->get();

        $reportData = [
            'total_sales' => $orderItems->sum('subtotal'),
            'total_products_sold' => $orderItems->sum('quantity'),
            'total_orders' => $orderItems->count(),
        ];

        SellerReport::create([
            'seller_id' => $seller->id,
            'report_type' => 'sales',
            'title' => 'Sales Report ' . now()->format('Y-m-d H:i'),
            'description' => 'Automatically generated sales report.',
            'data_json' => $reportData,
            'generated_at' => now(),
        ]);

        return back()->with('status', 'Report generated successfully.');
    }

public function export()
{
    $seller = auth()->user()->seller;

    $orderItems = OrderItem::with(['product', 'order'])
        ->where('seller_id', $seller->id)
        ->get();

    $fileName = 'seller-report.csv';

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$fileName\"",
    ];

    $callback = function () use ($orderItems) {
        $file = fopen('php://output', 'w');

        fputcsv($file, [
            'Order Code',
            'Product',
            'Quantity',
            'Price',
            'Subtotal',
            'Seller Status',
        ]);

        foreach ($orderItems as $item) {
            fputcsv($file, [
                $item->order->order_code,
                $item->product_name,
                $item->quantity,
                $item->price,
                $item->subtotal,
                $item->seller_status,
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}
}