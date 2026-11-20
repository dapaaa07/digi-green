-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: cupunagara
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'Kegiatan Desa',
  `excerpt` text NOT NULL,
  `content` longtext NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `author` varchar(255) NOT NULL DEFAULT 'Tim Digi-Green & Karang Taruna',
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `articles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'Sinergi Digi-Green: Gerakan Kampung Bebas Sampah Melalui Portal Web dan Plang Bambu QR Code','sinergi-digi-green-gerakan-kampung-bebas-sampah-di-desa-cupunagara','Aksi Lingkungan & Bela Negara','Kolaborasi nyata mahasiswa Politeknik Negeri Subang bersama pemuda Karang Taruna dan warga Desa Cupunagara dalam mengintegrasikan teknologi dan aksi gotong royong kebersihan.','Implementasi nilai bela negara di era modern tidak lagi sebatas pertahanan militer, melainkan diwujudkan melalui keikutsertaan aktif dalam menyelesaikan persoalan nyata di masyarakat. Melalui program Project Citizen yang diinisiasi oleh Kelompok 2 NalarWarga Jurusan TIK Politeknik Negeri Subang, Desa Cupunagara kini dilengkapi portal informasi digital terintegrasi plang bambu QR Code.\\n\\nPemasangan 3 plang informasi di titik strategis—pintu masuk wisata, warung warga, dan gardu pandang perbukitan—menjadi jembatan edukasi agar para wisatawan turut bertanggung jawab atas sampah yang dibawa. Selain itu, fitur pelaporan digital memudahkan warga mengadu bila menemukan titik rawan sampah sehingga dapat segera ditindaklanjuti secara gotong royong.','https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=1200&q=80','Tim NalarWarga & Karang Taruna',1,'2026-11-18 08:58:18','2026-11-18 23:48:16','2026-11-20 08:58:18'),(2,'Menyingkap Cita Rasa Khas Kopi Arabika Canggah dari Perbukitan Cupunagara','potensi-emas-hitam-kopi-arabika-canggah-dari-perbukitan-subang-selatan','Potensi Desa & UMKM','Tumbuh di tanah vulkanik lereng Gunung Canggah dengan perawatan teliti, Kopi Cupunagara berhasil memikat lidah penikmat kopi nusantara.','Kopi bukan sekadar minuman di Desa Cupunagara, melainkan napas perekonomian dan tradisi yang diwariskan antar generasi. Terletak di perbukitan berkabut pada ketinggian lebih dari 1.000 mdpl, biji kopi Arabika di desa ini memiliki tingkat keasaman manis yang khas dengan aroma citrus dan rempah.\\n\\nDengan hadirnya portal digital Digi-Green ini, kelompok tani lokal kini memiliki etalase mandiri untuk memasarkan hasil panen kopi secara langsung kepada pengunjung dan penikmat kopi di berbagai daerah tanpa perantara panjang, mendorong kemakmuran petani desa secara berkelanjutan.','https://images.unsplash.com/photo-1447933601403-0c6688de566e?auto=format&fit=crop&w=1200&q=80','Divisi Publikasi & UMKM Cupunagara',1,'2026-11-15 08:58:18','2026-11-18 23:48:16','2026-11-20 08:58:18');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('desa-wisata-cupunagara-cache-illuminate:queue:restart','i:1795190592;',2110550592);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coffee_products`
--

DROP TABLE IF EXISTS `coffee_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coffee_products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `process_type` varchar(255) NOT NULL DEFAULT 'Full Wash',
  `roast_level` varchar(255) NOT NULL DEFAULT 'Medium Roast',
  `flavor_notes` varchar(255) DEFAULT NULL,
  `price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `packaging_size` varchar(255) NOT NULL DEFAULT '200gr',
  `description` text DEFAULT NULL,
  `producer_name` varchar(255) NOT NULL DEFAULT 'Kelompok Tani Kopi Cupunagara',
  `contact_whatsapp` varchar(255) NOT NULL DEFAULT '6285798991234',
  `image` varchar(255) DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coffee_products_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coffee_products`
--

LOCK TABLES `coffee_products` WRITE;
/*!40000 ALTER TABLE `coffee_products` DISABLE KEYS */;
INSERT INTO `coffee_products` VALUES (1,'Kopi Arabika Canggah Cupunagara (Full Wash)','arabika-canggah-full-wash-200g','Full Wash Process','Medium Roast','Brown Sugar, Citrus Fresh, Jasmine Aroma, Sweet Aftertaste',65000.00,'200 gram (Biji / Bubuk)','Dipetik dari ceri merah pilihan di ketinggian 1.150 mdpl perbukitan Gunung Canggah Cupunagara. Melalui proses pencucian ganda higienis yang menghasilkan cita rasa kopi yang jernih (clean cup), keasaman segar yang seimbang, dan aroma rempah bunga yang lembut.','Kelompok Tani Kopi Canggah Cupunagara','6285798991234','https://images.unsplash.com/photo-1587734195503-904fca47e0e9?auto=format&fit=crop&w=800&q=80',1,1,'2026-11-18 23:48:16','2026-11-18 23:48:16'),(2,'Kopi Arabika Cupunagara (Honey Process)','arabika-cupunagara-honey-process-200g','Yellow Honey Process','Medium-Light Roast','Floral, Honeycomb, Ripe Apple, Smooth Body',75000.00,'200 gram (Biji / Bubuk)','Diproses dengan mempertahankan lapisan lendir (mucilage) alami buah kopi saat penjemuran di bawah sinar matahari perbukitan Subang. Memberikan profil rasa manis alami seperti madu hutan dan body yang kental.','UMKM Karang Taruna Cupunagara','6285798991234','https://images.unsplash.com/photo-1559056199-641a0ac8b55e?auto=format&fit=crop&w=800&q=80',1,1,'2026-11-18 23:48:16','2026-11-18 23:48:16'),(3,'Kopi Robusta Lereng Cisalak Cupunagara','kopi-robusta-lereng-cisalak-250g','Natural Dry Process','Dark Roast','Dark Chocolate, Roasted Nut, Bold Body, Low Acid',45000.00,'250 gram (Bubuk Halus)','Pilihan tepat untuk penikmat kopi tubruk pekat beraroma cokelat panggang. Ditanam di area lereng dengan perawatan alami tanpa pestisida kimia berlebih.','Koperasi Tani Desa Cupunagara','6285798991234','https://images.unsplash.com/photo-1511920170033-f8396924c348?auto=format&fit=crop&w=800&q=80',1,0,'2026-11-18 23:48:16','2026-11-18 23:48:16');
/*!40000 ALTER TABLE `coffee_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `destinations`
--

DROP TABLE IF EXISTS `destinations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `destinations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `excerpt` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `gallery_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery_images`)),
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `google_maps_url` varchar(255) DEFAULT NULL,
  `facilities` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`facilities`)),
  `operating_hours` varchar(255) NOT NULL DEFAULT '07.00 - 17.00 WIB',
  `price_info` varchar(255) NOT NULL DEFAULT 'Gratis / Retribusi Sukarela',
  `contact_person` varchar(255) DEFAULT NULL,
  `whatsapp_number` varchar(255) NOT NULL DEFAULT '6285798991234',
  `cleanliness_tips` text DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `order_weight` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `destinations_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `destinations`
--

LOCK TABLES `destinations` WRITE;
/*!40000 ALTER TABLE `destinations` DISABLE KEYS */;
INSERT INTO `destinations` VALUES (1,'Bukit Pamoyanan & Gardu Pandang Cupunagara','bukit-pamoyanan-gardu-pandang','Wisata Alam & Pemandangan','Spot panorama perbukitan di atas awan dengan pemandangan 360 derajat lanskap hijau Subang Selatan yang memukau.','Bukit Pamoyanan Cupunagara menawarkan pesona pemandangan perbukitan berkabut dengan hawa sejuk khas pegunungan. Pengunjung dapat menikmati momen matahari terbit (sunrise) dengan lautan awan yang menawan. Di titik ini telah terpasang plang imbauan kebersihan ber-QR Code untuk memastikan setiap pengunjung turut menjaga kelestarian bukit dari sampah plastik.','https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80','[\"https:\\/\\/images.unsplash.com\\/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1000&q=80\",\"https:\\/\\/images.unsplash.com\\/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1000&q=80\",\"https:\\/\\/images.unsplash.com\\/photo-1486870591958-9b9d0d1dda99?auto=format&fit=crop&w=1000&q=80\"]',-6.7588888,107.6988888,'https://www.google.com/maps/dir/?api=1&destination=-6.7562000,107.6881000','[]','05.30 - 18.00 WIB','Retribusi Kebersihan Rp 5.000 / Pengunjung','Kang Asep (Pokdarwis Cupunagara)','6285798991234','Jangan tinggalkan botol minum sekali pakai atau bungkus makanan ringan di lereng bukit. Bawa kembali sampah Anda ke drop-box di pintu keluar parkir.',0,0,'2026-11-18 23:48:16','2026-11-20 09:05:39'),(2,'Agrowisata Perkebunan Kopi Canggah','agrowisata-kebun-kopi-canggah','Agrowisata Kopi & Edukasi','Pengalaman belajar proses budidaya kopi Arabika unggulan Cupunagara langsung dari kebun lereng pegunungan hingga cangkir seduh.','Desa Cupunagara tersohor berkat varietas kopi Arabika yang tumbuh subur di ketinggian 1.100 mdpl lereng Gunung Canggah. Di agrowisata ini, wisatawan diajak berjalan menyusuri barisan pohon kopi, memetik buah ceri merah matang di musim panen, menyaksikan proses fermentasi (Natural, Honey, Full Wash), hingga belajar menyangrai biji kopi secara tradisional bersama petani lokal.','https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=1200&q=80','[\"https:\\/\\/images.unsplash.com\\/photo-1447933601403-0c6688de566e?auto=format&fit=crop&w=1000&q=80\",\"https:\\/\\/images.unsplash.com\\/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=1000&q=80\",\"https:\\/\\/images.unsplash.com\\/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1000&q=80\"]',-6.7584100,107.6923000,'https://www.google.com/maps/dir/?api=1&destination=-6.7584100,107.6923000','[\"Jalur Edukasi Kebun Kopi\",\"Rumah Pengolahan & Roastery Tradisional\",\"Kedai Seduh Kopi Cupunagara\",\"Toilet\",\"Area Duduk Terbuka\"]','07.30 - 17.00 WIB','Kunjungan Edukasi Mandiri: Gratis | Paket Edukasi Petik & Seduh Kopi Hubungi Admin','Pak Dedi (Ketua Kelompok Tani Kopi)','6285798991234','Dilarang mematahkan ranting pohon kopi dan dilarang membuang puntung rokok sembarangan di area kebun kopi untuk menghindari bahaya kebakaran daun kering.',1,2,'2026-11-18 23:48:16','2026-11-18 23:48:16'),(3,'Curug Masigit & Aliran Sungai Cisalak','curug-masigit-dan-aliran-sungai','Wisata Air Alami','Gemercik air terjun alami dengan kolam air jernih segar yang dikelilingi tebing batu dan pepohonan hijau rindang.','Bagi pencinta ketenangan alam, Curug Masigit menawarkan kesegaran air pegunungan alami yang mengalir melintasi lembah Desa Cupunagara. Suasananya yang masih sangat alami cocok untuk relaksasi, bermain air, atau trekking ringan menyusuri tepian sungai yang asri.','https://images.unsplash.com/photo-1432405972618-c60b0225b8f9?auto=format&fit=crop&w=1200&q=80','[\"https:\\/\\/images.unsplash.com\\/photo-1546182990-dffeafbe841d?auto=format&fit=crop&w=1000&q=80\",\"https:\\/\\/images.unsplash.com\\/photo-1470071459604-3b5ec3a7fe05?auto=format&fit=crop&w=1000&q=80\"]',-6.7521000,107.6845000,'https://www.google.com/maps/dir/?api=1&destination=-6.7521000,107.6845000','[\"Jalur Trekking Alami\",\"Kamar Bilas Sederhana\",\"Tempat Penitipan Barang di Warung Warga\",\"Area Bersantai Alami\"]','07.00 - 16.30 WIB','Retribusi Kebersihan Lingkungan Rp 5.000 / Orang','Kang Irham (Karang Taruna Div. Lingkungan)','6285798991234','Jaga kebersihan sumber mata air desa! Dilarang keras menggunakan sabun kimia di aliran sungai utama dan wajib membawa kembali plastik makanan Anda.',1,3,'2026-11-18 23:48:16','2026-11-18 23:48:16'),(4,'Sentra UMKM Kopi & Warung Guyub Warga','sentra-umkm-dan-warung-warga','Budaya & UMKM Desa','Titik kumpul warga desa yang hangat, menyajikan kuliner khas Sunda dan etalase aneka produk kopi bubuk dan sangrai Cupunagara.','Di pusat desa dekat balai pertemuan, sentra warung warga menjadi etalase utama pergerakan ekonomi desa. Di sini wisatawan dapat mencicipi aneka jajanan tradisional, nasi liwet khas Subang, dan membeli buah tangan kopi roasted bean berkualitas tinggi yang dikemas rapi oleh kelompok tani.','https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=1200&q=80','[\"https:\\/\\/images.unsplash.com\\/photo-1509785307050-d4066910ec1e?auto=format&fit=crop&w=1000&q=80\"]',-6.7595000,107.6898000,'https://www.google.com/maps/dir/?api=1&destination=-6.7595000,107.6898000','[\"Tempat Parkir Luas\",\"Mushola Desa\",\"Kantin & Warung Makan\",\"Galeri Display Produk UMKM Kopi\",\"Toilet Umum\"]','06.30 - 21.00 WIB','Bebas Masuk / Terbuka untuk Umum','Teh Amanda (Bendahara Karang Taruna & UMKM)','6285798991234','Gunakan tempat sampah pilah (Organik & Anorganik) yang telah disiapkan di depan setiap gerai warung.',0,4,'2026-11-18 23:48:16','2026-11-18 23:48:16'),(5,'Kafe Bukit Cupumanik (Cupumanik Coffee)','kafe-bukit-cupumanik','Wisata Kuliner & Kafe','Spot ngopi di ketinggian perbukitan lereng Gunung Canggah dengan panorama kabut pegunungan dan seduhan kopi Arabika asli Cupunagara.','Kafe Bukit Cupumanik adalah destinasi singgah favorit bagi para pengunjung dan penikmat kopi yang datang ke Desa Cupunagara. Berlokasi di perbukitan dengan latar panorama lembah hijau dan perkebunan teh/kopi yang asri, kafe ini menyajikan aneka seduhan kopi manual brew dari ceri kopi lokal Cupunagara yang dipetik langsung oleh petani desa. Selain kopi hangat, wisatawan dapat menikmati aneka camilan khas Sunda dan suasana santai dengan semilir angin sejuk perbukitan.','https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=1200&q=80','[\"https:\\/\\/images.unsplash.com\\/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=1000&q=80\",\"https:\\/\\/images.unsplash.com\\/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1000&q=80\",\"https:\\/\\/images.unsplash.com\\/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=1000&q=80\"]',-6.7571000,107.6908000,'https://www.google.com/maps/dir/?api=1&destination=-6.7571000,107.6908000','[\"Area Duduk Indoor & Outdoor\",\"Spot Foto Panorama Lembah\",\"Mushola\",\"Toilet Bersih\",\"Area Parkir Motor & Mobil\",\"Free Wi-Fi\"]','08.00 - 21.00 WIB','Menu Kopi & Camilan Mulai Rp 12.000','Kang Dadan (Pengelola Kafe Cupumanik)','6285798991234','Buang ampas kopi, tisu, dan bungkus makanan ke tempat sampah terpilah yang disediakan di sudut kafe.',1,4,'2026-11-20 08:58:18','2026-11-20 08:58:18');
/*!40000 ALTER TABLE `destinations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_11_19_064536_create_ecotourism_tables',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qr_points`
--

DROP TABLE IF EXISTS `qr_points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qr_points` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `google_maps_url` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `cleaning_guide` text DEFAULT NULL,
  `scan_count` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `qr_points_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qr_points`
--

LOCK TABLES `qr_points` WRITE;
/*!40000 ALTER TABLE `qr_points` DISABLE KEYS */;
INSERT INTO `qr_points` VALUES (1,'pintu-masuk','Pintu Masuk Kawasan Ekowisata Cupunagara',-6.7542000,107.6865000,'https://www.google.com/maps/dir/?api=1&destination=-6.7542000,107.6865000','Titik gerbang utama penyambutan pengunjung ekowisata Desa Cupunagara. Dilengkapi plang bambu ramah lingkungan ber-QR Code untuk memandu arah wisata serta mengingatkan pengunjung membawa kembali sampah pribadi.','Selamat datang di Desa Cupunagara! Mohon siapkan wadah/kantong sampah pribadi di kendaraan Anda. Dilarang melempar botol dan bungkus plastik di sepanjang jalur masuk desa.',145,1,'2026-11-18 23:48:16','2026-11-20 09:05:39'),(2,'warung-warga','Warung Tempat Berkumpul Warga & UMKM',-6.7595000,107.6898000,'https://www.google.com/maps/dir/?api=1&destination=-6.7595000,107.6898000','Pusat interaksi sosial, warung kopi lokal, dan tempat berkumpul masyarakat serta wisatawan untuk melepas lelah sembari menikmati seduhan kopi asli Cupunagara.','Kawasan bebas sampah plastik berserakan. Tempatkan puntung rokok dan sampah makanan pada wadah tempat sampah terpilah yang telah disediakan di samping warung.',98,1,'2026-11-18 23:48:16','2026-11-18 23:48:16'),(3,'gardu-pandang','Area Gardu Pandang Perbukitan Cupunagara',-6.7562000,107.6881000,'https://www.google.com/maps/dir/?api=1&destination=-6.7562000,107.6881000','Titik tertinggi dengan panorama bentang perbukitan hijau dan hamparan kebun kopi. Titik favorit swafoto dan melihat kabut pagi di Desa Cupunagara.','Jaga keaslian pemandangan perbukitan! Bawa turun kembali semua sampah plastik, tisu, dan wadah minuman yang Anda bawa ke area gardu pandang.',215,1,'2026-11-18 23:48:16','2026-11-18 23:48:16');
/*!40000 ALTER TABLE `qr_points` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reports` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_code` varchar(255) NOT NULL,
  `destination_id` bigint(20) unsigned DEFAULT NULL,
  `qr_point_id` bigint(20) unsigned DEFAULT NULL,
  `reporter_name` varchar(255) DEFAULT NULL,
  `reporter_phone` varchar(255) DEFAULT NULL,
  `report_category` varchar(255) NOT NULL DEFAULT 'sampah_menumpuk',
  `specific_location` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_evidence` varchar(255) DEFAULT NULL,
  `status` enum('pending','in_progress','resolved','rejected') NOT NULL DEFAULT 'pending',
  `admin_notes` text DEFAULT NULL,
  `resolution_image` varchar(255) DEFAULT NULL,
  `resolved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reports_ticket_code_unique` (`ticket_code`),
  KEY `reports_destination_id_foreign` (`destination_id`),
  KEY `reports_qr_point_id_foreign` (`qr_point_id`),
  CONSTRAINT `reports_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE SET NULL,
  CONSTRAINT `reports_qr_point_id_foreign` FOREIGN KEY (`qr_point_id`) REFERENCES `qr_points` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
INSERT INTO `reports` VALUES (1,'CPN-202611-001',1,3,'Rizky Pratama','081234567891','sampah_menumpuk','Samping bangku kayu di dekat plang bambu QR gardu pandang atas','Ada sisa botol plastik air mineral dan kantong kresek yang tertinggal di bawah bangku kayu setelah hari libur kemarin.','https://images.unsplash.com/photo-1618477461853-cf6ed80faba5?auto=format&fit=crop&w=800&q=80','resolved','Sampah telah dibersihkan oleh regu kerja bakti pemuda Karang Taruna bersama pengelola wisata pada jadwal ronda kebersihan pagi. Tempat sampah tambahan telah diletakkan di dekat bangku.','https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80','2026-11-19 08:58:18','2026-11-18 23:48:16','2026-11-20 08:58:18'),(2,'CPN-202611-002',1,1,'Siti Nurhaliza (Wisatawan Bandung)','087811223344','saran_kebersihan','Area parkir kendaraan roda dua dekat gerbang masuk desa','Mohon ditambah plang pengingat agar pengendara motor tidak membuang karcis parkir atau plastik bekas jas hujan sembarangan saat musim hujan.',NULL,'in_progress','Laporan diterima dan divalidasi. Tim PDD dan perlengkapan sedang menyiapkan stiker imbauan tahan air tambahan untuk ditempel di pos jaga.',NULL,NULL,'2026-11-18 23:48:16','2026-11-18 23:48:16'),(3,'CPN-202611-003',NULL,2,'Anonim',NULL,'sampah_menumpuk','Saluran air di samping warung kopi bu ambar','Ada tumpukan daun kering dan cup plastik tersangkut di parit kecil.','https://images.unsplash.com/photo-1530587191325-3db32d826c18?auto=format&fit=crop&w=800&q=80','pending',NULL,NULL,NULL,'2026-11-18 23:48:16','2026-11-18 23:48:16'),(4,'CPN-202611-BBTA',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/0nNzAoSBxVhvZXAIhezolHnIEBPKa9kebIC8Mmqp.jpg','pending',NULL,NULL,NULL,'2026-11-19 00:02:27','2026-11-19 00:02:27'),(5,'CPN-202611-E9XM',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/Ef1o78wm1OcRnVCZ9qBBrm8vpUrtSbePBPk5y6aO.jpg','pending',NULL,NULL,NULL,'2026-11-19 00:03:04','2026-11-19 00:03:04'),(6,'CPN-202611-UQ1F',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/Nz0ij0RVqBjBMIZDoy04yTiYwzTXtO9z0XoChTbf.jpg','pending',NULL,NULL,NULL,'2026-11-19 00:05:17','2026-11-19 00:05:17'),(7,'CPN-202611-D01N',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/U4j5dKN5cT1WYNiLyvF42EERwJpy13DpU3r1lZDg.jpg','pending',NULL,NULL,NULL,'2026-11-19 00:31:05','2026-11-19 00:31:05'),(8,'CPN-202611-JOKN',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/b1uI1cdJChFbSjP3AODsREHfuB1izs22wueog1Vd.jpg','pending',NULL,NULL,NULL,'2026-11-19 00:31:21','2026-11-19 00:31:21'),(9,'CPN-202611-DILI',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/lSj2yEaAIe7JhbAfwkgQuqdOSWw8FvPrx4uvmUy8.jpg','pending',NULL,NULL,NULL,'2026-11-19 00:31:36','2026-11-19 00:31:36'),(10,'CPN-202611-E0TI',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/9gYuD3O4daauYIskcT0j0zRhGD5xCYOZjhzsEyAF.jpg','pending',NULL,NULL,NULL,'2026-11-19 00:32:00','2026-11-19 00:32:00'),(11,'CPN-202611-LO6O',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/gZuvlkhrS37R2fjAJZaEZOoTf9Ttj2OdNKFlxyu0.jpg','pending',NULL,NULL,NULL,'2026-11-19 02:00:43','2026-11-19 02:00:43'),(12,'CPN-202611-KJXL',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/ugtbuL0sKWcHVRRXtalcGZKdfwvbRSSHcJ2KtNKZ.jpg','pending',NULL,NULL,NULL,'2026-11-19 03:44:21','2026-11-19 03:44:21'),(13,'CPN-202611-TQXN',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/ga3iImaByUPEZNTCNcNAV7fzRQ56SN7E0V4hE0YI.jpg','pending',NULL,NULL,NULL,'2026-11-19 03:50:19','2026-11-19 03:50:19'),(14,'CPN-202611-C5EU',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/RarvdwRj7aZAZC8FmIpfhAdUXgRLJK0gigiJxJw8.jpg','pending',NULL,NULL,NULL,'2026-11-19 03:50:36','2026-11-19 03:50:36'),(15,'CPN-202611-RY3Z',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/bIX92e4dPWXTuA0Y60m6eLADi5LxxwbBxLkeM2aW.jpg','pending',NULL,NULL,NULL,'2026-11-19 14:16:57','2026-11-19 14:16:57'),(16,'CPN-202611-ITYL',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/mrAWXaKPEPOVi3ulM0o3FAp9xt9bc9xh7dIlBy2f.jpg','pending',NULL,NULL,NULL,'2026-11-19 14:26:09','2026-11-19 14:26:09'),(17,'CPN-202611-L0IU',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/DEaerSzyepo7uLqEWB9SX4IsvPl0uhiCn1SBfhWG.jpg','pending',NULL,NULL,NULL,'2026-11-19 14:31:53','2026-11-19 14:31:53'),(18,'CPN-202611-FYPS',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/2c4UvrtWiVlXg6BNyfw64zLDti4Fb5cIigbEeMwr.jpg','pending',NULL,NULL,NULL,'2026-11-19 14:35:54','2026-11-19 14:35:54'),(19,'CPN-202611-VEF6',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/2bQSMqtvrxe0dlzIYVSskuAi82850GZj0bzQEmA2.jpg','pending',NULL,NULL,NULL,'2026-11-19 14:37:24','2026-11-19 14:37:24'),(20,'CPN-202611-CESP',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/4Tb9s8Tdk9XkFzyA0Y0o6Z1Duv0a3BPrQDLwzf8z.jpg','pending',NULL,NULL,NULL,'2026-11-19 23:28:01','2026-11-19 23:28:01'),(21,'CPN-202611-UGNA',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/XwaMGSNFSVAmywABP63poA31Zet8s3PlhAbDYlK8.jpg','pending',NULL,NULL,NULL,'2026-11-20 09:04:41','2026-11-20 09:04:41'),(22,'CPN-202611-BMBX',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/JotKTxOKSluqTlLBnGyilEKyhdySCvPph20jf3iC.jpg','pending',NULL,NULL,NULL,'2026-11-20 09:05:06','2026-11-20 09:05:06'),(23,'CPN-202611-QYGH',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/GS28lGpj4NIhR9zhrSv45Ikc7fHUXIAJSbrcLpU3.jpg','pending',NULL,NULL,NULL,'2026-11-20 09:05:39','2026-11-20 09:05:39');
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('7SKrFVfPJLPdzNIGkJIoXUPRnCABlG5lJdW4RcWP',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJIMW1pajRyNFVHR3p6MTlpSXlWWU0ybWRzaHYxZ0FkcWRRZ3pTaWNvIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795071977),('8jaMhMBJq1fNLzlXZs3NcN4YkfhB0owB0T7DCGpA',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJkWmJGakswUnZlbVVyQzBWYk1hYTFRSGFvb1h5SFY1TDBxN01JUVd1IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795073545),('8PVrdZTMyZN0xDpHP85uymw6Sk3TyromC2L1x3I7',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiI5S1NoWXRacHVTbUE1R2FxMkJHTWxabnQ4dlJMME45RXFhOEtOR2VyIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795073532),('8uOqqVj8WxXc6UmPRZCWLS3VB8hABWyZ46JNu2k6',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJRM1pjSXk1VkpzS0FZVGtreDBvUGRUY3hqUkNJQ1dKaFlMMzRUbkViIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9xclwvcGludHUtbWFzdWsiLCJyb3V0ZSI6InFyLnNob3cifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795071983),('CoqB6BFzesprLhim7yKz9nnciwIZLsFU3Ze4suIB',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJxRVRESm45b1FJZmRRRU51U2Z5ejlEUmwzVG5VOGo4QWlRU2JFaW5BIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1795123035),('CUtRDb3dmOwfwYS1nL7gdkQ9xGG0BIS0VIsrSubd',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJsQ00zeHhvSUJseTB2VTl2aXpmc2E1MTVicGpnMjQ4U09CRjUzUFZsIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795073531),('CyvqiXkxSokn4gO2LlLTqabB6YR5L00T8R0vRYWY',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJBU2Rjd2RWcnl2cE9BWVQ2UjdoMjduVGp3RG11VGJjRXJGVHhyb1JkIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795073531),('det5rYCTFrEVPNJUWBev0BUT3uwmiSVJg55Ix1Qi',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJKRXlQVlhTUFFYVk5EVmxKcDdXbzFBWW9aTW9vVkRpMmxKWTBsNjRIIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795073531),('dwmh3N86tmyHZOiPHPWt77wBq2jJCsSsndwqKGbd',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiI5ZTE3WTUwZGVMemZWbzZCeFRTRFhpd29ON3lpOU1mSkJ1bGFYVlNnIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795073531),('eEzMF4YGR4Meg4qM92F63qNrAeN3KoE7UmcqFdVs',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJlRmpEZ1c2cEZ5OWtLcWRZTmdCZHk0M0VGTDlZbkFINE5BZGgzUzBTIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sYXBvciIsInJvdXRlIjoicmVwb3J0cy5jcmVhdGUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795071983),('fs5Eq8YdZTO7WcaS093ulwhDav2lND7wBc1pW4BE',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJmZmdUV2V2MDdmZUxVbWVNWlBmanozMmVvb2hrNTk2b2FwdGJCNTNKIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795073531),('i0Y20snz4KdJaDgXm705xFkE6eIMIcMZvH1q40kN',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36','eyJfdG9rZW4iOiI0elp3dk9KZ2I0STdMSnFnSGV1MDVGeU9YNzFEZnRGS21iYm8yWFNyIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDAiLCJyb3V0ZSI6ImhvbWUifX0=',1795124260),('iClfZoHKqN8Va7c2U5pZgNQpXSN7GTqa3atNubtl',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJaaTV5OEtsTjhYM3NMYWVsRFRtTDRia3ZOTGJqdXI2U1JaYk4xallPIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sYXBvciIsInJvdXRlIjoicmVwb3J0cy5jcmVhdGUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795123998),('KAZqfMks0D3IaZefpW51cniMKAGRtybTlyxClQz9',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJLT1FodzZ0dVdSSExCSzVleklIVDlBRFVMTEVkR21WU3VVNnIxRXB4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvcXItcHJpbnQiLCJyb3V0ZSI6ImFkbWluLnFyLnByaW50In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsInBhc3N3b3JkX2hhc2hfd2ViIjoiZjY5ODY2MWRlMWRjMWU0ZTI5M2FkYjQ2ODFlOTY5YWVhMTE3ZjIzN2M0ZGEzZmJhMzA2ZDM3YWMwOGY0ZmI1MyJ9',1795190702),('mhi1LXfTkt44AK1cT2inR7wNV788Ojv6b8UXWzDC',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJ1WVYwTTlEQmRnelZLSUhtM3J3cUhJVWdpTDlWS3FpQmtMdk1qYnNFIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC93aXNhdGEiLCJyb3V0ZSI6ImRlc3RpbmF0aW9ucy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1795071983),('njRSkpi7iNLqV0E8i9PfowCQ13vs8h6R5eBKSG6z',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiI5ZFQ5UW9veFFCMEluWlVrR0xkcFZBM1pWV29jamxzR0tFR3ZVOWlmIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvbG9naW4iLCJyb3V0ZSI6ImFkbWluLmxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1795071983),('NtOT0lwFDQKYwv5mLUnHUdwYOsg5xn0MyCRi5gVV',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJLRWd6aTljYVlFN3JIbnBZcGhaQ3BUbVFaRDBhZExVbFZ0NDZNdmNqIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sYXBvcmFuIiwicm91dGUiOiJyZXBvcnRzLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1795071983),('p0NeWcoZvXwy9IU83Sw7AuJ0hfkb9CeKBIvfv3QC',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiI5MjNyNlk4OWFrZ2pHVm5oSDM2ZmhsNFBVenM3d0ozaDJ6Y0Vkd1RPIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795073531),('PVFmcxEZZhJId5lpHz6dExXWGIcgCWYZC9Aa9Ysa',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJzS1VRczhMcEJCeEdYWGJjSTVxMGpGSGRhdDRCbXpMYzdSSUZTVEJNIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795078853),('qG3PgBES1TOk47nXE0SRfCqfL1Wb8xWQtJUvHOHO',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJJZ3RRdHc5Q3J5RWhKMUVScWhIYUpmODhyVENTS0ppTHVLQzIzWUxxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9rb3BpIiwicm91dGUiOiJjb2ZmZWUuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795071983),('r0nGcAdJ7nKtUrXTTn3FGWj9VFXxu6NrbedqBkbk',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJiSEJwZk9YdGpMZVo1OXYwbnR6b1B6NFJEeVZrWlhYVkxyMFJ5cElYIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795073531),('TcKVARMVHcEkN5TBV8T9Z6JzylcoNuDSmbnU1o1b',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJlUjh4M3hjcUs0VVFQZ2gyVTRGY3hIcFdFdGhrWXgzaTBPWXZacUFDIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1795085516),('UTqkoNbLkKGq80uc9y02wbwwXUD8GiHjKEnjpUuU',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJaVURyb3ExNHJETGVLOUgwbW9CbldxcVluU0FWOEZDRVY2SjRkNWVaIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795073538),('Y8ct13cWypMDvp4rie925ejKsmyex8phhZIElURD',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJIMlNLYWFDb1J4dno5elVTSXpXaFFwUkNnWHNBdTFJQndmbEdGT2p3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC93aXNhdGFcL2N1cnVnLWNpbGVhdCIsInJvdXRlIjoiZGVzdGluYXRpb25zLnNob3cifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795071987),('zsDKFwA2ul7BkM7Ke3kqjb7ga4fyXOkLr2rBvuG2',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJVa0p4aGppZ3dkMXFwTk56cjFwZG01bFNZTm9JU0lBYldnQTVMeDI2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1795154973);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Pengelola Desa & Karang Taruna Cupunagara','admin@cupunagara.desa.id','2026-11-20 08:58:18','$2y$04$1poqHn469eDndBwlGLr6VuPWwMhVUYFEodq.WJ.WfB32zM8LBH5Ju','AbfrujJV9qqsajn5tTIJua0NqfFyrJ6g65Qsea0TwM88O33JKrctThFUtuho','2026-11-18 23:48:16','2026-11-20 09:04:41');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `village_profiles`
--

DROP TABLE IF EXISTS `village_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `village_profiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `village_name` varchar(255) NOT NULL DEFAULT 'Desa Cupunagara',
  `district` varchar(255) NOT NULL DEFAULT 'Cisalak',
  `regency` varchar(255) NOT NULL DEFAULT 'Subang',
  `province` varchar(255) NOT NULL DEFAULT 'Jawa Barat',
  `tagline` varchar(255) DEFAULT NULL,
  `overview` text DEFAULT NULL,
  `history` text DEFAULT NULL,
  `vision` text DEFAULT NULL,
  `mission` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`mission`)),
  `admin_whatsapp` varchar(255) NOT NULL DEFAULT '6285798991234',
  `contact_email` varchar(255) NOT NULL DEFAULT 'desa.cupunagara.subang@gmail.com',
  `address` text DEFAULT NULL,
  `default_latitude` decimal(10,7) NOT NULL DEFAULT -6.7584100,
  `default_longitude` decimal(10,7) NOT NULL DEFAULT 107.6893200,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `village_profiles`
--

LOCK TABLES `village_profiles` WRITE;
/*!40000 ALTER TABLE `village_profiles` DISABLE KEYS */;
INSERT INTO `village_profiles` VALUES (1,'Desa Cupunagara','Cisalak','Kabupaten Subang','Jawa Barat','Digi-Green Cupunagara: Harmoni Alam Perbukitan, Harum Kopi, dan Kampung Bebas Sampah','Desa Cupunagara terletak di kawasan selatan Kabupaten Subang, tepat di perbukitan lereng Gunung Canggah dengan ketinggian sekitar 1.000 hingga 1.200 meter di atas permukaan laut. Dikelilingi udara pegunungan yang sejuk dan tanah vulkanik yang subur, desa ini menjadi penghasil utama komoditas kopi specialty unggulan Jawa Barat serta menyimpan potensi ekowisata alam yang asri dan menenangkan.','Berawal dari perkampungan agraris di pedalaman Subang, masyarakat Cupunagara menjaga kelestarian alam dan tradisi perkebunan kopi secara turun-temurun. Melalui inisiatif Digi-Green hasil kolaborasi pemuda Karang Taruna, Kelompok Sadar Wisata (Pokdarwis), dan civitas akademika, desa ini bertransformasi menjadi kawasan ekowisata modern berbasis digital yang tetap memegang teguh semangat gotong royong dan kesadaran menjaga ruang publik yang bersih bebas sampah.','Mewujudkan Desa Cupunagara sebagai desa ekowisata mandiri berbasis digital, berdaya saing ekonomi melalui komoditas kopi lokal, dan menjadi pelopor kampung ramah lingkungan yang bebas sampah.','[\"Mengembangkan sarana digital informasi wisata yang mudah diakses dan inklusif bagi seluruh pengunjung.\",\"Memberdayakan petani lokal dan UMKM kopi melalui promosi digital dan kemitraan terpadu.\",\"Menggalakkan gerakan aksi nyata pelestarian lingkungan dan edukasi pemilahan sampah di ruang publik.\",\"Meningkatkan keterampilan pemuda Karang Taruna dalam tata kelola informasi dan layanan ekowisata.\"]','6285798991234','pemdes.cupunagara@subang.go.id','Jl. Raya Cupunagara, Kec. Cisalak, Kabupaten Subang, Jawa Barat 41283',-6.7584100,107.6893200,'2026-11-18 23:48:16','2026-11-18 23:48:16');
/*!40000 ALTER TABLE `village_profiles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-20 23:05:52
