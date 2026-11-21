<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\CoffeeProduct;
use App\Models\Destination;
use App\Models\QrPoint;
use App\Models\Report;
use App\Models\User;
use App\Models\VillageProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin Akun Karang Taruna
        User::updateOrCreate(
            ['email' => 'admin@cupunagara.desa.id'],
            [
                'name' => 'Pengelola Desa & Karang Taruna Cupunagara',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Profil Desa Cupunagara
        VillageProfile::updateOrCreate(
            ['id' => 1],
            [
                'village_name' => 'Desa Cupunagara',
                'district' => 'Cisalak',
                'regency' => 'Kabupaten Subang',
                'province' => 'Jawa Barat',
                'tagline' => 'Digi-Green Cupunagara: Harmoni Alam Perbukitan, Harum Kopi, dan Kampung Bebas Sampah',
                'overview' => 'Desa Cupunagara terletak di kawasan selatan Kabupaten Subang, tepat di perbukitan lereng Gunung Canggah dengan ketinggian sekitar 1.000 hingga 1.200 meter di atas permukaan laut. Dikelilingi udara pegunungan yang sejuk dan tanah vulkanik yang subur, desa ini menjadi penghasil utama komoditas kopi specialty unggulan Jawa Barat serta menyimpan potensi ekowisata alam yang asri dan menenangkan.',
                'history' => 'Berawal dari perkampungan agraris di pedalaman Subang, masyarakat Cupunagara menjaga kelestarian alam dan tradisi perkebunan kopi secara turun-temurun. Melalui inisiatif Digi-Green hasil kolaborasi pemuda Karang Taruna, Kelompok Sadar Wisata (Pokdarwis), dan civitas akademika, desa ini bertransformasi menjadi kawasan ekowisata modern berbasis digital yang tetap memegang teguh semangat gotong royong dan kesadaran menjaga ruang publik yang bersih bebas sampah.',
                'vision' => 'Mewujudkan Desa Cupunagara sebagai desa ekowisata mandiri berbasis digital, berdaya saing ekonomi melalui komoditas kopi lokal, dan menjadi pelopor kampung ramah lingkungan yang bebas sampah.',
                'mission' => [
                    'Mengembangkan sarana digital informasi wisata yang mudah diakses dan inklusif bagi seluruh pengunjung.',
                    'Memberdayakan petani lokal dan UMKM kopi melalui promosi digital dan kemitraan terpadu.',
                    'Menggalakkan gerakan aksi nyata pelestarian lingkungan dan edukasi pemilahan sampah di ruang publik.',
                    'Meningkatkan keterampilan pemuda Karang Taruna dalam tata kelola informasi dan layanan ekowisata.',
                ],
                'admin_whatsapp' => '6285798991234',
                'contact_email' => 'pemdes.cupunagara@subang.go.id',
                'address' => 'Jl. Raya Cupunagara, Kec. Cisalak, Kabupaten Subang, Jawa Barat 41283',
                'default_latitude' => -6.7584100,
                'default_longitude' => 107.6893200,
            ]
        );

        // 3. Titik Plang Bambu QR Code (Sesuai Proposal)
        $qrPintuMasuk = QrPoint::updateOrCreate(
            ['code' => 'pintu-masuk'],
            [
                'location_name' => 'Pintu Masuk Kawasan Ekowisata Cupunagara',
                'latitude' => -6.7542000,
                'longitude' => 107.6865000,
                'google_maps_url' => 'https://www.google.com/maps/dir/?api=1&destination=-6.7542000,107.6865000',
                'description' => 'Titik gerbang utama penyambutan pengunjung ekowisata Desa Cupunagara. Dilengkapi plang bambu ramah lingkungan ber-QR Code untuk memandu arah wisata serta mengingatkan pengunjung membawa kembali sampah pribadi.',
                'cleaning_guide' => 'Selamat datang di Desa Cupunagara! Mohon siapkan wadah/kantong sampah pribadi di kendaraan Anda. Dilarang melempar botol dan bungkus plastik di sepanjang jalur masuk desa.',
                'scan_count' => 142,
                'is_active' => true,
            ]
        );

        $qrWarungWarga = QrPoint::updateOrCreate(
            ['code' => 'warung-warga'],
            [
                'location_name' => 'Warung Tempat Berkumpul Warga & UMKM',
                'latitude' => -6.7595000,
                'longitude' => 107.6898000,
                'google_maps_url' => 'https://www.google.com/maps/dir/?api=1&destination=-6.7595000,107.6898000',
                'description' => 'Pusat interaksi sosial, warung kopi lokal, dan tempat berkumpul masyarakat serta wisatawan untuk melepas lelah sembari menikmati seduhan kopi asli Cupunagara.',
                'cleaning_guide' => 'Kawasan bebas sampah plastik berserakan. Tempatkan puntung rokok dan sampah makanan pada wadah tempat sampah terpilah yang telah disediakan di samping warung.',
                'scan_count' => 98,
                'is_active' => true,
            ]
        );

        $qrGarduPandang = QrPoint::updateOrCreate(
            ['code' => 'gardu-pandang'],
            [
                'location_name' => 'Area Gardu Pandang Perbukitan Cupunagara',
                'latitude' => -6.7562000,
                'longitude' => 107.6881000,
                'google_maps_url' => 'https://www.google.com/maps/dir/?api=1&destination=-6.7562000,107.6881000',
                'description' => 'Titik tertinggi dengan panorama bentang perbukitan hijau dan hamparan kebun kopi. Titik favorit swafoto dan melihat kabut pagi di Desa Cupunagara.',
                'cleaning_guide' => 'Jaga keaslian pemandangan perbukitan! Bawa turun kembali semua sampah plastik, tisu, dan wadah minuman yang Anda bawa ke area gardu pandang.',
                'scan_count' => 215,
                'is_active' => true,
            ]
        );

        // 4. Tempat Wisata (8 Destinasi Nyata Cupunagara)
        $this->call(RealDestinationsSeeder::class);
        $destGunungGeulis = Destination::where('slug', 'bukit-lestari-gunung-geulis')->first();
        $destCurug = Destination::where('slug', 'curug-cikaruncang')->first();

        // 5. Produk Kopi Cupunagara (UMKM)
        CoffeeProduct::updateOrCreate(
            ['slug' => 'arabika-canggah-full-wash-200g'],
            [
                'name' => 'Kopi Arabika Canggah Cupunagara (Full Wash)',
                'process_type' => 'Full Wash Process',
                'roast_level' => 'Medium Roast',
                'flavor_notes' => 'Brown Sugar, Citrus Fresh, Jasmine Aroma, Sweet Aftertaste',
                'price' => 65000,
                'packaging_size' => '200 gram (Biji / Bubuk)',
                'description' => 'Dipetik dari ceri merah pilihan di ketinggian 1.150 mdpl perbukitan Gunung Canggah Cupunagara. Melalui proses pencucian ganda higienis yang menghasilkan cita rasa kopi yang jernih (clean cup), keasaman segar yang seimbang, dan aroma rempah bunga yang lembut.',
                'producer_name' => 'Kelompok Tani Kopi Canggah Cupunagara',
                'contact_whatsapp' => '6285798991234',
                'image' => 'https://images.unsplash.com/photo-1587734195503-904fca47e0e9?auto=format&fit=crop&w=800&q=80',
                'is_available' => true,
                'is_featured' => true,
            ]
        );

        CoffeeProduct::updateOrCreate(
            ['slug' => 'arabika-cupunagara-honey-process-200g'],
            [
                'name' => 'Kopi Arabika Cupunagara (Honey Process)',
                'process_type' => 'Yellow Honey Process',
                'roast_level' => 'Medium-Light Roast',
                'flavor_notes' => 'Floral, Honeycomb, Ripe Apple, Smooth Body',
                'price' => 75000,
                'packaging_size' => '200 gram (Biji / Bubuk)',
                'description' => 'Diproses dengan mempertahankan lapisan lendir (mucilage) alami buah kopi saat penjemuran di bawah sinar matahari perbukitan Subang. Memberikan profil rasa manis alami seperti madu hutan dan body yang kental.',
                'producer_name' => 'UMKM Karang Taruna Cupunagara',
                'contact_whatsapp' => '6285798991234',
                'image' => 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?auto=format&fit=crop&w=800&q=80',
                'is_available' => true,
                'is_featured' => true,
            ]
        );

        CoffeeProduct::updateOrCreate(
            ['slug' => 'kopi-robusta-lereng-cisalak-250g'],
            [
                'name' => 'Kopi Robusta Lereng Cisalak Cupunagara',
                'process_type' => 'Natural Dry Process',
                'roast_level' => 'Dark Roast',
                'flavor_notes' => 'Dark Chocolate, Roasted Nut, Bold Body, Low Acid',
                'price' => 45000,
                'packaging_size' => '250 gram (Bubuk Halus)',
                'description' => 'Pilihan tepat untuk penikmat kopi tubruk pekat beraroma cokelat panggang. Ditanam di area lereng dengan perawatan alami tanpa pestisida kimia berlebih.',
                'producer_name' => 'Koperasi Tani Desa Cupunagara',
                'contact_whatsapp' => '6285798991234',
                'image' => 'https://images.unsplash.com/photo-1511920170033-f8396924c348?auto=format&fit=crop&w=800&q=80',
                'is_available' => true,
                'is_featured' => false,
            ]
        );

        // 6. Sampel Laporan Kebersihan (Reports) untuk Uji Coba Langsung
        Report::updateOrCreate(
            ['ticket_code' => 'CPN-202611-001'],
            [
                'destination_id' => $destGunungGeulis?->id,
                'qr_point_id' => $qrGarduPandang->id,
                'reporter_name' => 'Rizky Pratama',
                'reporter_phone' => '081234567891',
                'report_category' => 'sampah_menumpuk',
                'specific_location' => 'Samping bangku kayu di dekat plang bambu QR gardu pandang atas',
                'description' => 'Ada sisa botol plastik air mineral dan kantong kresek yang tertinggal di bawah bangku kayu setelah hari libur kemarin.',
                'image_evidence' => 'https://images.unsplash.com/photo-1618477461853-cf6ed80faba5?auto=format&fit=crop&w=800&q=80',
                'status' => 'resolved',
                'admin_notes' => 'Sampah telah dibersihkan oleh regu kerja bakti pemuda Karang Taruna bersama pengelola wisata pada jadwal ronda kebersihan pagi. Tempat sampah tambahan telah diletakkan di dekat bangku.',
                'resolution_image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80',
                'resolved_at' => now()->subDay(),
            ]
        );

        Report::updateOrCreate(
            ['ticket_code' => 'CPN-202611-002'],
            [
                'destination_id' => $destCurug?->id,
                'qr_point_id' => $qrPintuMasuk->id,
                'reporter_name' => 'Siti Nurhaliza (Wisatawan Bandung)',
                'reporter_phone' => '087811223344',
                'report_category' => 'saran_kebersihan',
                'specific_location' => 'Area parkir kendaraan roda dua dekat gerbang masuk desa',
                'description' => 'Mohon ditambah plang pengingat agar pengendara motor tidak membuang karcis parkir atau plastik bekas jas hujan sembarangan saat musim hujan.',
                'image_evidence' => null,
                'status' => 'in_progress',
                'admin_notes' => 'Laporan diterima dan divalidasi. Tim PDD dan perlengkapan sedang menyiapkan stiker imbauan tahan air tambahan untuk ditempel di pos jaga.',
                'resolution_image' => null,
                'resolved_at' => null,
            ]
        );

        Report::updateOrCreate(
            ['ticket_code' => 'CPN-202611-003'],
            [
                'destination_id' => null,
                'qr_point_id' => $qrWarungWarga->id,
                'reporter_name' => 'Anonim',
                'reporter_phone' => null,
                'report_category' => 'sampah_menumpuk',
                'specific_location' => 'Saluran air di samping warung kopi bu ambar',
                'description' => 'Ada tumpukan daun kering dan cup plastik tersangkut di parit kecil.',
                'image_evidence' => 'https://images.unsplash.com/photo-1530587191325-3db32d826c18?auto=format&fit=crop&w=800&q=80',
                'status' => 'pending',
                'admin_notes' => null,
                'resolution_image' => null,
                'resolved_at' => null,
            ]
        );

        // 7. Artikel & Kabar Desa
        Article::updateOrCreate(
            ['slug' => 'sinergi-digi-green-gerakan-kampung-bebas-sampah-di-desa-cupunagara'],
            [
                'title' => 'Sinergi Digi-Green: Gerakan Kampung Bebas Sampah Melalui Portal Web dan Plang Bambu QR Code',
                'category' => 'Aksi Lingkungan & Bela Negara',
                'excerpt' => 'Kolaborasi nyata mahasiswa Politeknik Negeri Subang bersama pemuda Karang Taruna dan warga Desa Cupunagara dalam mengintegrasikan teknologi dan aksi gotong royong kebersihan.',
                'content' => 'Implementasi nilai bela negara di era modern tidak lagi sebatas pertahanan militer, melainkan diwujudkan melalui keikutsertaan aktif dalam menyelesaikan persoalan nyata di masyarakat. Melalui program Project Citizen yang diinisiasi oleh Kelompok 2 NalarWarga Jurusan TIK Politeknik Negeri Subang, Desa Cupunagara kini dilengkapi portal informasi digital terintegrasi plang bambu QR Code.\n\nPemasangan 3 plang informasi di titik strategis—pintu masuk wisata, warung warga, dan gardu pandang perbukitan—menjadi jembatan edukasi agar para wisatawan turut bertanggung jawab atas sampah yang dibawa. Selain itu, fitur pelaporan digital memudahkan warga mengadu bila menemukan titik rawan sampah sehingga dapat segera ditindaklanjuti secara gotong royong.',
                'thumbnail' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=1200&q=80',
                'author' => 'Tim NalarWarga & Karang Taruna',
                'is_published' => true,
                'published_at' => now()->subDays(2),
            ]
        );

        Article::updateOrCreate(
            ['slug' => 'potensi-emas-hitam-kopi-arabika-canggah-dari-perbukitan-subang-selatan'],
            [
                'title' => 'Menyingkap Cita Rasa Khas Kopi Arabika Canggah dari Perbukitan Cupunagara',
                'category' => 'Potensi Desa & UMKM',
                'excerpt' => 'Tumbuh di tanah vulkanik lereng Gunung Canggah dengan perawatan teliti, Kopi Cupunagara berhasil memikat lidah penikmat kopi nusantara.',
                'content' => 'Kopi bukan sekadar minuman di Desa Cupunagara, melainkan napas perekonomian dan tradisi yang diwariskan antar generasi. Terletak di perbukitan berkabut pada ketinggian lebih dari 1.000 mdpl, biji kopi Arabika di desa ini memiliki tingkat keasaman manis yang khas dengan aroma citrus dan rempah.\n\nDengan hadirnya portal digital Digi-Green ini, kelompok tani lokal kini memiliki etalase mandiri untuk memasarkan hasil panen kopi secara langsung kepada pengunjung dan penikmat kopi di berbagai daerah tanpa perantara panjang, mendorong kemakmuran petani desa secara berkelanjutan.',
                'thumbnail' => 'https://images.unsplash.com/photo-1447933601403-0c6688de566e?auto=format&fit=crop&w=1200&q=80',
                'author' => 'Divisi Publikasi & UMKM Cupunagara',
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ]
        );
    }
}
