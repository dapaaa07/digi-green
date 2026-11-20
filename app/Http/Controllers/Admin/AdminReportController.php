<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminReportController extends Controller
{
    public function index(Request $request): View
    {
        $query = Report::with(['destination', 'qrPoint'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('report_category', $request->category);
        }

        $reports = $query->paginate(15);
        $statusCounts = [
            'all' => Report::count(),
            'pending' => Report::where('status', 'pending')->count(),
            'in_progress' => Report::where('status', 'in_progress')->count(),
            'resolved' => Report::where('status', 'resolved')->count(),
            'rejected' => Report::where('status', 'rejected')->count(),
        ];

        return view('admin.reports.index', compact('reports', 'statusCounts'));
    }

    public function show(Report $report): View
    {
        $report->load(['destination', 'qrPoint']);
        return view('admin.reports.show', compact('report'));
    }

    public function update(Request $request, Report $report): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,resolved,rejected',
            'admin_notes' => 'nullable|string|max:2000',
            'resolution_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('resolution_image')) {
            $validated['resolution_image'] = $request->file('resolution_image')->store('resolutions', 'public');
        }

        if ($validated['status'] === 'resolved' && !$report->resolved_at) {
            $validated['resolved_at'] = now();
        }

        $report->update($validated);

        return redirect()->route('admin.reports.show', $report)
            ->with('success', 'Status laporan berhasil diperbarui.');
    }

    public function destroy(Report $report): RedirectResponse
    {
        $report->delete();
        return redirect()->route('admin.reports.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
