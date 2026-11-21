<?php

namespace App\Http\Controllers;

use App\Models\QrPoint;
use Illuminate\Http\RedirectResponse;

class QrController extends Controller
{
    /**
     * Seluruh pemindaian QR diarahkan langsung ke halaman depan (landing page)
     * Desa Wisata Cupunagara.
     */
    public function show(?string $code = null): RedirectResponse
    {
        if ($code) {
            $qrPoint = QrPoint::where('code', $code)->first();
            if ($qrPoint) {
                $qrPoint->increment('scan_count');
            }
        }

        return redirect()->route('home');
    }
}
