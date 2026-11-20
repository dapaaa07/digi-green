<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('village_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('village_name')->default('Desa Cupunagara');
            $table->string('district')->default('Cisalak');
            $table->string('regency')->default('Subang');
            $table->string('province')->default('Jawa Barat');
            $table->string('tagline')->nullable();
            $table->text('overview')->nullable();
            $table->text('history')->nullable();
            $table->text('vision')->nullable();
            $table->json('mission')->nullable();
            $table->string('admin_whatsapp')->default('6285798991234');
            $table->string('contact_email')->default('desa.cupunagara.subang@gmail.com');
            $table->text('address')->nullable();
            $table->decimal('default_latitude', 10, 7)->default(-6.7584100);
            $table->decimal('default_longitude', 10, 7)->default(107.6893200);
            $table->timestamps();
        });

        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category'); // Wisata Alam, Agrowisata Kopi, Budaya & UMKM, dll
            $table->string('excerpt');
            $table->longText('description');
            $table->string('thumbnail');
            $table->json('gallery_images')->nullable();
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('google_maps_url')->nullable();
            $table->json('facilities')->nullable();
            $table->string('operating_hours')->default('07.00 - 17.00 WIB');
            $table->string('price_info')->default('Gratis / Retribusi Sukarela');
            $table->string('contact_person')->nullable();
            $table->string('whatsapp_number')->default('6285798991234');
            $table->text('cleanliness_tips')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('order_weight')->default(0);
            $table->timestamps();
        });

        Schema::create('qr_points', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // pintu-masuk, warung-warga, gardu-pandang
            $table->string('location_name');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('google_maps_url')->nullable();
            $table->text('description')->nullable();
            $table->text('cleaning_guide')->nullable();
            $table->integer('scan_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('coffee_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('process_type')->default('Full Wash');
            $table->string('roast_level')->default('Medium Roast');
            $table->string('flavor_notes')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->string('packaging_size')->default('200gr');
            $table->text('description')->nullable();
            $table->string('producer_name')->default('Kelompok Tani Kopi Cupunagara');
            $table->string('contact_whatsapp')->default('6285798991234');
            $table->string('image')->nullable();
            $table->boolean('is_available')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });

        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_code')->unique();
            $table->foreignId('destination_id')->nullable()->constrained('destinations')->nullOnDelete();
            $table->foreignId('qr_point_id')->nullable()->constrained('qr_points')->nullOnDelete();
            $table->string('reporter_name')->nullable();
            $table->string('reporter_phone')->nullable();
            $table->string('report_category')->default('sampah_menumpuk'); // sampah_menumpuk, fasilitas_rusak, titik_rawan, saran_kebersihan
            $table->string('specific_location');
            $table->text('description');
            $table->string('image_evidence')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'resolved', 'rejected'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->string('resolution_image')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });

        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('Kegiatan Desa');
            $table->text('excerpt');
            $table->longText('content');
            $table->string('thumbnail')->nullable();
            $table->string('author')->default('Tim Digi-Green & Karang Taruna');
            $table->boolean('is_published')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('coffee_products');
        Schema::dropIfExists('qr_points');
        Schema::dropIfExists('destinations');
        Schema::dropIfExists('village_profiles');
    }
};
