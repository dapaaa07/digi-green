<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoffeeProduct extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function getWhatsappOrderUrlAttribute(): string
    {
        $phone = preg_replace('/[^0-9]/', '', $this->contact_whatsapp);
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }
        $formattedPrice = 'Rp ' . number_format($this->price, 0, ',', '.');
        $msg = rawurlencode("Halo UMKM Kopi Cupunagara, saya tertarik untuk memesan produk {$this->name} ({$this->packaging_size} - {$formattedPrice}). Apakah produk ini tersedia?");

        return "https://wa.me/{$phone}?text={$msg}";
    }
}
