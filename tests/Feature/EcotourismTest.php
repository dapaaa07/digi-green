<?php

namespace Tests\Feature;

use App\Models\Destination;
use App\Models\QrPoint;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EcotourismTest extends TestCase
{
    public function test_home_page_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Desa Cupunagara');
        $response->assertSee('master-map');
    }

    public function test_destinations_catalog_loads_successfully(): void
    {
        $response = $this->get('/wisata');
        $response->assertStatus(200);
        $response->assertSee('Bukit Pamoyanan');
    }

    public function test_destination_detail_page_loads(): void
    {
        $destination = Destination::first();
        $response = $this->get('/wisata/' . $destination->slug);
        $response->assertStatus(200);
        $response->assertSee($destination->name);
        $response->assertSee('Petunjuk Arah (Google Maps)');
        $response->assertSee('Tanya Info via WhatsApp');
    }

    public function test_coffee_catalog_page_loads(): void
    {
        $response = $this->get('/kopi');
        $response->assertStatus(200);
        $response->assertSee('Kopi Specialty Lereng Gunung Canggah');
        $response->assertSee('Pesan via WA');
    }

    public function test_user_can_submit_cleanliness_report(): void
    {
        Storage::fake('public');

        $response = $this->post('/lapor/kirim', [
            'report_category' => 'sampah_menumpuk',
            'specific_location' => 'Dekat warung kopi depan balai desa',
            'description' => 'Ada sisa kemasan plastik menumpuk setelah acara warga.',
            'reporter_name' => 'Budi Santoso',
            'reporter_phone' => '081234567890',
            'image_evidence' => UploadedFile::fake()->create('bukti_sampah.jpg', 100, 'image/jpeg'),
        ]);

        $response->assertRedirect();
        
        $report = Report::where('reporter_name', 'Budi Santoso')->first();
        $this->assertNotNull($report);
        $this->assertStringStartsWith('CPN-', $report->ticket_code);
        $this->assertEquals('pending', $report->status);
    }

    public function test_qr_page_redirects_to_home_and_increments_scan_count(): void
    {
        $qrPoint = QrPoint::first();
        $initialScan = $qrPoint->scan_count;

        $response = $this->get('/qr/' . $qrPoint->code);
        $response->assertRedirect(route('home'));

        $this->assertEquals($initialScan + 1, $qrPoint->fresh()->scan_count);
    }

    public function test_admin_can_login_and_access_dashboard(): void
    {
        $user = User::first();
        
        $loginResponse = $this->post('/admin/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $loginResponse->assertRedirect('/admin');
        
        $dashboardResponse = $this->actingAs($user)->get('/admin');
        $dashboardResponse->assertStatus(200);
        $dashboardResponse->assertSee('Ringkasan Pengelolaan Desa');
    }

    public function test_admin_can_access_qr_print_page(): void
    {
        $user = User::first();
        $response = $this->actingAs($user)->get('/admin/qr-print');
        $response->assertStatus(200);
        $response->assertSee('QR Code Resmi Desa Wisata Cupunagara');
    }

    public function test_kafe_cupumanik_exists(): void
    {
        $cafe = Destination::where('slug', 'kafe-bukit-cupumanik')->first();
        $this->assertNotNull($cafe);
        $this->assertStringContainsString('Cupumanik', $cafe->name);
        $this->assertEquals('Wisata Kuliner & Kafe', $cafe->category);
    }

    public function test_admin_can_manage_products(): void
    {
        $user = User::first();

        // 1. Index
        $response = $this->actingAs($user)->get('/admin/products');
        $response->assertStatus(200);
        $response->assertSee('Kelola Produk Kopi & UMKM');

        // 2. Create & Store
        $storeResponse = $this->actingAs($user)->post('/admin/products', [
            'name' => 'Kopi Arabika Test Batch',
            'producer_name' => 'Kelompok Tani Canggah',
            'process_type' => 'Full Wash',
            'roast_level' => 'Medium Roast',
            'flavor_notes' => 'Floral, Citrus, Caramel',
            'packaging_size' => '200 gr',
            'price' => 75000,
            'contact_whatsapp' => '08123456789',
            'is_available' => 1,
            'description' => 'Kopi uji coba kualitas panen musim ini.',
        ]);
        $storeResponse->assertRedirect('/admin/products');

        $product = \App\Models\CoffeeProduct::where('name', 'Kopi Arabika Test Batch')->first();
        $this->assertNotNull($product);
        $this->assertEquals(75000, $product->price);

        // 3. Edit & Update
        $updateResponse = $this->actingAs($user)->put('/admin/products/' . $product->id, [
            'name' => 'Kopi Arabika Test Batch Updated',
            'producer_name' => 'Kelompok Tani Canggah',
            'process_type' => 'Honey Process',
            'roast_level' => 'Light to Medium',
            'flavor_notes' => 'Honey, Peach, Jasmine',
            'packaging_size' => '250 gr',
            'price' => 85000,
            'contact_whatsapp' => '08123456789',
            'is_available' => 1,
            'description' => 'Deskripsi diperbarui.',
        ]);
        $updateResponse->assertRedirect('/admin/products');
        $this->assertEquals('Kopi Arabika Test Batch Updated', $product->fresh()->name);
        $this->assertEquals(85000, $product->fresh()->price);

        // 4. Delete
        $deleteResponse = $this->actingAs($user)->delete('/admin/products/' . $product->id);
        $deleteResponse->assertRedirect('/admin/products');
        $this->assertNull(\App\Models\CoffeeProduct::where('name', 'Kopi Arabika Test Batch Updated')->first());
    }

    public function test_admin_can_update_destination_coordinates(): void
    {
        $user = User::first();
        $destination = Destination::first();

        $updateResponse = $this->actingAs($user)->put('/admin/destinations/' . $destination->id, [
            'name' => $destination->name,
            'category' => $destination->category,
            'excerpt' => $destination->excerpt ?? 'Wisata unggulan Desa Cupunagara',
            'description' => $destination->description,
            'thumbnail' => $destination->thumbnail ?? 'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
            'latitude' => -6.7588888,
            'longitude' => 107.6988888,
            'price_info' => $destination->price_info,
            'operating_hours' => $destination->operating_hours,
        ]);

        $updateResponse->assertRedirect('/admin/destinations');
        $fresh = $destination->fresh();
        $this->assertEquals(-6.7588888, (float) $fresh->latitude);
        $this->assertEquals(107.6988888, (float) $fresh->longitude);
    }
}
