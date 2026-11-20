<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Destination extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'gallery_images' => 'array',
        'facilities' => 'array',
        'latitude' => 'float',
        'longitude' => 'float',
        'is_featured' => 'boolean',
    ];

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    public function getGoogleMapsNavigationUrlAttribute(): string
    {
        if ($this->google_maps_url) {
            return $this->google_maps_url;
        }

        return "https://www.google.com/maps/dir/?api=1&destination={$this->latitude},{$this->longitude}";
    }

    public function getWhatsappInquiryUrlAttribute(): string
    {
        $phone = preg_replace('/[^0-9]/', '', $this->whatsapp_number);
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }
        $msg = rawurlencode("Halo Pengelola Desa Cupunagara, saya ingin bertanya informasi lebih lanjut mengenai {$this->name}.");

        return "https://wa.me/{$phone}?text={$msg}";
    }
}
