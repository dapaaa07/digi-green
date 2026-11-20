<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'resolved_at' => 'datetime',
    ];

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    public function qrPoint(): BelongsTo
    {
        return $this->belongsTo(QrPoint::class);
    }

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->report_category) {
            'sampah_menumpuk' => 'Sampah Menumpuk',
            'fasilitas_rusak' => 'Fasilitas Rusak',
            'titik_rawan' => 'Titik Rawan Sampah/Bahaya',
            'saran_kebersihan' => 'Saran & Masukan Kebersihan',
            default => 'Laporan Umum',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Menunggu Verifikasi',
            'in_progress' => 'Sedang Ditindaklanjuti',
            'resolved' => 'Selesai Dibersihkan',
            'rejected' => 'Tidak Valid / Ditolak',
            default => 'Pending',
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'bg-amber-100 text-amber-800 border-amber-300',
            'in_progress' => 'bg-blue-100 text-blue-800 border-blue-300',
            'resolved' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
            'rejected' => 'bg-rose-100 text-rose-800 border-rose-300',
            default => 'bg-slate-100 text-slate-800 border-slate-300',
        };
    }
}
