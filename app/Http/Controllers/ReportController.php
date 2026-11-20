<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\QrPoint;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        $trackedReport = null;
        if ($request->filled('ticket')) {
            $ticket = trim($request->ticket);
            $trackedReport = Report::with(['destination', 'qrPoint'])
                ->where('ticket_code', $ticket)
                ->first();
        }

        $resolvedReports = Report::with(['destination', 'qrPoint'])
            ->where('status', 'resolved')
            ->latest('resolved_at')
            ->take(6)
            ->get();

        $stats = [
            'total' => Report::count(),
            'resolved' => Report::where('status', 'resolved')->count(),
            'in_progress' => Report::where('status', 'in_progress')->count(),
            'pending' => Report::where('status', 'pending')->count(),
        ];

        return view('reports.index', compact('trackedReport', 'resolvedReports', 'stats'));
    }

    public function create(Request $request): View
    {
        $destinations = Destination::orderBy('name')->get();
        $qrPoints = QrPoint::where('is_active', true)->get();

        $selectedQr = null;
        if ($request->filled('qr')) {
            $selectedQr = QrPoint::where('code', $request->qr)->first();
        }

        $selectedDestination = null;
        if ($request->filled('destination_id')) {
            $selectedDestination = Destination::find($request->destination_id);
        }

        return view('reports.create', compact('destinations', 'qrPoints', 'selectedQr', 'selectedDestination'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'destination_id' => 'nullable|exists:destinations,id',
            'qr_point_id' => 'nullable|exists:qr_points,id',
            'reporter_name' => 'nullable|string|max:100',
            'reporter_phone' => 'nullable|string|max:30',
            'report_category' => 'required|in:sampah_menumpuk,fasilitas_rusak,titik_rawan,saran_kebersihan',
            'specific_location' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'image_evidence' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $imagePath = null;
        if ($request->hasFile('image_evidence')) {
            $imagePath = $request->file('image_evidence')->store('reports', 'public');
        }

        $todayCode = date('Ym');
        $randomSequence = strtoupper(Str::random(4));
        $ticketCode = "CPN-{$todayCode}-{$randomSequence}";

        while (Report::where('ticket_code', $ticketCode)->exists()) {
            $randomSequence = strtoupper(Str::random(4));
            $ticketCode = "CPN-{$todayCode}-{$randomSequence}";
        }

        $report = Report::create([
            'ticket_code' => $ticketCode,
            'destination_id' => $validated['destination_id'] ?? null,
            'qr_point_id' => $validated['qr_point_id'] ?? null,
            'reporter_name' => $validated['reporter_name'] ?: 'Warga / Wisatawan (Anonim)',
            'reporter_phone' => $validated['reporter_phone'] ?? null,
            'report_category' => $validated['report_category'],
            'specific_location' => $validated['specific_location'],
            'description' => $validated['description'],
            'image_evidence' => $imagePath,
            'status' => 'pending',
        ]);

        return redirect()->route('reports.index', ['ticket' => $report->ticket_code])
            ->with('success', "Laporan Anda berhasil dikirim dengan Kode Tiket: {$report->ticket_code}. Terima kasih atas kepedulian Anda menjaga kebersihan Desa Cupunagara!");
    }
}
