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

    public function test_qr_page_increments_scan_count(): void
    {
        $qrPoint = QrPoint::first();
        $initialScan = $qrPoint->scan_count;

        $response = $this->get('/qr/' . $qrPoint->code);
        $response->assertStatus(200);
        $response->assertSee($qrPoint->location_name);
        $response->assertSee('Lapor Sampah di Titik Ini');

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
        $response->assertSee('Template Cetak Stiker Plang Bambu QR Code');
    }
}
