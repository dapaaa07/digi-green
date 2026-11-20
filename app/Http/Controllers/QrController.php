<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\QrPoint;
use Illuminate\View\View;

class QrController extends Controller
{
    public function show(string $code): View
    {
        $qrPoint = QrPoint::where('code', $code)->firstOrFail();
        $qrPoint->increment('scan_count');

        $nearbyDestinations = Destination::orderBy('order_weight')->take(3)->get();
        $allQrPoints = QrPoint::where('is_active', true)->where('id', '!=', $qrPoint->id)->get();

        return view('qr.show', compact('qrPoint', 'nearbyDestinations', 'allQrPoints'));
    }
}
