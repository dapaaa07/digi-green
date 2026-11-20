<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoffeeProduct;
use App\Models\Destination;
use App\Models\QrPoint;
use App\Models\Report;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_destinations' => Destination::count(),
            'total_reports' => Report::count(),
            'pending_reports' => Report::where('status', 'pending')->count(),
            'in_progress_reports' => Report::where('status', 'in_progress')->count(),
            'resolved_reports' => Report::where('status', 'resolved')->count(),
            'total_qr_scans' => QrPoint::sum('scan_count'),
            'total_coffees' => CoffeeProduct::count(),
        ];

        $recentReports = Report::with(['destination', 'qrPoint'])
            ->latest()
            ->take(6)
            ->get();

        $qrPoints = QrPoint::all();

        return view('admin.dashboard', compact('stats', 'recentReports', 'qrPoints'));
    }

    public function printQr(): View
    {
        $qrPoints = QrPoint::all();
        return view('admin.qr_print', compact('qrPoints'));
    }
}
