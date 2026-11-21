-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: cupunagara
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `destinations`
--

LOCK TABLES `destinations` WRITE;
/*!40000 ALTER TABLE `destinations` DISABLE KEYS */;
INSERT INTO `destinations` VALUES (6,'Curug Cikaruncang','curug-cikaruncang','Wisata Alam & Curug','Air terjun tersembunyi (hidden gem) dengan dua aliran air unik dan kolam toska jernih alami di tengah hutan asri Cupunagara.','Curug Cikaruncang merupakan destinasi wisata alam air terjun tersembunyi yang berlokasi di perbukitan Desa Cupunagara, Kecamatan Cisalak. Berbeda dengan destinasi wisata yang padat buatan, Curug Cikaruncang mempertahankan keaslian alamnya dengan hutan rimbun dan udara sejuk pegunungan. Keunikannya terletak pada dua aliran air terjun dengan karakter berbeda—satu aliran lebih tenang dengan kolam alami berwarna toska yang memikat untuk berfoto, dan aliran lainnya lebih deras dengan hempasan air menyegarkan. Pengunjung akan menikmati pengalaman trekking menyusuri jalan setapak tanah dan bebatuan alami sejauh kurang lebih 800 meter.','https://images.unsplash.com/photo-1432405972618-c60b0225b8f9?auto=format&fit=crop&w=1200&q=80','[\"https:\\/\\/images.unsplash.com\\/photo-1546182990-dffeafbe841d?auto=format&fit=crop&w=1000&q=80\",\"https:\\/\\/images.unsplash.com\\/photo-1470071459604-3b5ec3a7fe05?auto=format&fit=crop&w=1000&q=80\"]',-6.7588888,107.6988888,'https://www.google.com/maps/dir/?api=1&destination=-6.7621000,107.6912000','[]','07.30 - 16.30 WIB','Tiket Masuk / Retribusi: Rp 10.000 / orang','Pengelola Curug Cikaruncang & Pokdarwis','6285798991234','Wajib membawa kembali seluruh bungkus makanan dan botol minum pribadi Anda. Jaga kejernihan kolam air alami dari sampah plastik.',1,3,'2026-11-20 23:52:06','2026-11-21 00:15:26'),(7,'Bukit Lestari Gunung Geulis','bukit-lestari-gunung-geulis','Wisata Alam & Camping','Puncak bukit perkemahan di ketinggian 1.200 mdpl dengan lanskap perkebunan teh Bukanagara, lautan awan, dan panorama sunrise spektakuler.','Bukit Lestari Gunung Geulis adalah salah satu destinasi wisata alam dan bumi perkemahan (camping ground) unggulan di dataran tinggi Desa Cupunagara. Berada di ketinggian lebih dari 1.200 meter di atas permukaan laut (mdpl), kawasan ini menawarkan udara pegunungan yang sangat dingin dan segar dengan kabut yang kerap menyapa. Dari puncaknya, pengunjung disuguhi pemandangan spektakuler hamparan perbukitan hijau, lembah kebun teh warisan kolonial, serta pesona matahari terbit (sunrise) yang memesona di atas samudera awan pagi hari.','https://images.unsplash.com/photo-1510312305653-8ed496efae75?auto=format&fit=crop&w=1200&q=80','[\"https:\\/\\/images.unsplash.com\\/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1000&q=80\",\"https:\\/\\/images.unsplash.com\\/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1000&q=80\"]',-6.7715000,107.6854000,'https://www.google.com/maps/dir/?api=1&destination=-6.7715000,107.6854000','[\"Area Camping Ground Luas\",\"Spot Foto Sunrise & Lautan Awan\",\"Toilet & Sumber Air Bersih\",\"Jalur Trekking Bukit\",\"Area Parkir\"]','Buka 24 Jam (Khusus Camping) / Kunjungan Harian 06.00 - 18.00 WIB','Tiket Masuk: Rp 15.000 / orang | Paket Camping: Rp 25.000 / orang','Pengelola Camping Ground Gunung Geulis','6285798991234','Bawa kantong sampah sendiri saat berkemah. Dilarang membuang sampah sisa makanan, puntung rokok, atau membakar sampah di area perkemahan.',1,4,'2026-11-20 23:52:06','2026-11-21 00:15:26'),(8,'Bukit Alam Dunya','bukit-alam-dunya','Wisata Alam & Camping','Bumi perkemahan tenang berlatar bentang alam pegunungan hijau dan udara sejuk untuk relaksasi dan camping di bawah taburan bintang.','Bukit Alam Dunya menyuguhkan suasana perkemahan yang tenang dan intim di perbukitan dataran tinggi Desa Cupunagara. Dikelilingi hutan hijau dan lembah kebun teh, tempat ini menjadi lokasi favorit bagi komunitas pecinta alam dan keluarga yang ingin beristirahat dari keriuhan kota (healing). Di malam hari, pengunjung dapat menikmati indahnya langit berbintang tanpa polusi cahaya dan udara dingin yang menyejukkan, disempurnakan dengan hangatnya api unggun dan seduhan kopi asli Cupunagara.','https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1200&q=80','[\"https:\\/\\/images.unsplash.com\\/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1000&q=80\",\"https:\\/\\/images.unsplash.com\\/photo-1486870591958-9b9d0d1dda99?auto=format&fit=crop&w=1000&q=80\"]',-6.7582000,107.6821000,'https://www.google.com/maps/dir/?api=1&destination=-6.7582000,107.6821000','[\"Area Tenda Camping\",\"Gardu Pandang Alam\",\"Toilet Sederhana\",\"Warung Logistik Ringan\",\"Area Parkir\"]','Buka 24 Jam (Khusus Camping) / Kunjungan 06.00 - 17.30 WIB','Tiket Masuk / Camping: Rp 15.000 / orang','Pengelola Bukit Alam Dunya','6285798991234','Kawasan bebas sampah plastik. Seluruh sampah kemasan makanan wajib dibawa pulang kembali ke rumah atau dibuang ke tempat sampah desa.',0,5,'2026-11-20 23:52:06','2026-11-20 23:52:06'),(9,'Kebun Strawberry Cupunagara','kebun-strawberry-cupunagara','Agrowisata & Edukasi','Agrowisata petik buah stroberi merah ranum langsung dari kebun dataran tinggi dengan iklim sejuk perbukitan Subang Selatan.','Kebun Strawberry Cupunagara menghadirkan pengalaman seru agrowisata petik buah stroberi langsung dari kebunnya di dataran tinggi pegunungan Cisalak. Ketinggian Cupunagara yang mencapai lebih dari 1.050 mdpl dengan suhu udara sejuk memberikan lingkungan ideal untuk budidaya buah stroberi berkualitas prima. Pengunjung dari segala usia, khususnya anak-anak dan keluarga, dapat menyusuri lorong kebun stroberi, memetik buah yang matang merah merekah, serta mencicipi rasa manis asam buah stroberi segar yang baru dipetik.','https://images.unsplash.com/photo-1464965911861-746a04b4bca6?auto=format&fit=crop&w=1200&q=80','[\"https:\\/\\/images.unsplash.com\\/photo-1518635017498-87f514b751ba?auto=format&fit=crop&w=1000&q=80\",\"https:\\/\\/images.unsplash.com\\/photo-1543158266-0066955047b1?auto=format&fit=crop&w=1000&q=80\"]',-6.7538000,107.6875000,'https://www.google.com/maps/dir/?api=1&destination=-6.7538000,107.6875000','[\"Kebun Petik Stroberi\",\"Keranjang & Gunting Petik\",\"Timbangan Hasil Petik\",\"Gazebo Istirahat\",\"Toilet\",\"Area Parkir\"]','08.00 - 17.00 WIB','Masuk Gratis / Bayar sesuai berat stroberi hasil petik (Rp 60.000 - Rp 80.000 / kg)','Pengelola Kebun Stroberi Cupunagara','6285798991234','Dilarang membuang plastik pembungkus atau memetik buah yang masih mentah (hijau). Jaga kebersihan sela-sela bedengan kebun.',1,6,'2026-11-20 23:52:06','2026-11-21 00:15:26'),(10,'Kampung Eco Wisata Bunikasih','kampung-eco-wisata-bunikasih','Ekowisata & Budaya','Kampung pegunungan asri yang tenang dengan aliran mata air DAS Cipunagara, tradisi pengrajin gula aren alami, dan energi mikrohidro mandiri.','Kampung Bunikasih adalah permata tersembunyi ekowisata di lembah perbukitan selatan Desa Cupunagara. Terkenal dengan keramahan warganya dan lingkungan yang masih sangat terjaga, kampung ini dilintasi oleh hulu aliran Sungai Cipunagara dengan air jernih dan puluhan sumber mata air alami. Wisatawan dapat menyaksikan kehidupan pedesaan yang bersahaja, proses tradisional penyadapan nira hingga pembuatan gula aren/gula semut murni, serta melihat inovasi pemanfaatan energi mandiri Pembangkit Listrik Tenaga Mikrohidro (PLTMH).','https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=1200&q=80','[\"https:\\/\\/images.unsplash.com\\/photo-1472214103451-9374bd1c798e?auto=format&fit=crop&w=1000&q=80\",\"https:\\/\\/images.unsplash.com\\/photo-1469854523086-cc02fe5d8800?auto=format&fit=crop&w=1000&q=80\"]',-6.7780000,107.6940000,'https://www.google.com/maps/dir/?api=1&destination=-6.7780000,107.6940000','[\"Jalur Edukasi Kampung & Kebun Aren\",\"Spot Sungai Jernih & Sumber Air Alami\",\"Workshop Pembuatan Gula Aren\",\"Homestay Warga Sederhana\",\"Toilet\"]','07.00 - 17.00 WIB','Retribusi Masuk / Donasi Ekowisata Rp 5.000 / orang','Ketua RT / Tokoh Masyarakat Bunikasih','6285798991234','Dilarang membuang sampah apa pun ke aliran sungai dan parit kampung. Hormati kearifan lokal warga dan bawa kembali sampah anorganik pribadi Anda.',0,7,'2026-11-20 23:52:06','2026-11-20 23:52:06'),(11,'Rumah Belanda Cupunagara (Landhuis Bukanagara)','rumah-belanda-cupunagara','Wisata Sejarah & Warisan Kolonial','Bangunan cagar budaya bergaya arsitektur Eropa kolonial tahun 1930 di tengah hamparan kebun teh Bukanagara yang berkabut.','Berdiri megah di tengah hamparan perkebunan teh eks PTPN VIII Bukanagara, Rumah Belanda Cupunagara (dikenal juga dengan sebutan Landhuis van Tjoepoenegara atau Rumah Anneke Frelier) adalah saksi bisu sejarah panjang perkebunan teh era Hindia Belanda di Subang. Didirikan pada 15 Juni 1930, bangunan ini memiliki arsitektur klasik Eropa tempo dulu dengan fondasi batu kokoh, langit-langit tinggi, serta jendela kayu besar. Dikelilingi pemandangan kebun teh hijau dan hawa dingin pegunungan, rumah bersejarah ini menjadi spot favorit pecinta fotografi, wisata sejarah, dan edukasi cagar budaya.','https://images.unsplash.com/photo-1513694203232-719a280e022f?auto=format&fit=crop&w=1200&q=80','[\"https:\\/\\/images.unsplash.com\\/photo-1518780664697-55e3ad937233?auto=format&fit=crop&w=1000&q=80\",\"https:\\/\\/images.unsplash.com\\/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1000&q=80\"]',-6.7665000,107.6792000,'https://www.google.com/maps/dir/?api=1&destination=-6.7665000,107.6792000','[\"Spot Foto Arsitektur Kolonial\",\"Pemandangan Kebun Teh 360 Derajat\",\"Gazebo Pandang\",\"Area Parkir Motor & Mobil\",\"Toilet\"]','07.30 - 17.30 WIB','Tiket Masuk / Cagar Budaya: Rp 10.000 / orang','Pengelola Kawasan Cagar Budaya Bukanagara','6285798991234','Dilarang mencoret-coret (vandalisme) dinding bersejarah. Bawa pulang sampah makanan/minuman Anda dan jaga keasrian lingkungan kebun teh.',1,8,'2026-11-20 23:52:06','2026-11-21 00:15:26'),(12,'Alun-alun Cupunagara','alun-alun-cupunagara','Ruang Publik & Wisata Komunitas','Lapangan hijau terbuka di pusat kawasan desa untuk olahraga, tempat berkumpul komunitas, dan bersantai menikmati udara sejuk pegunungan.','Alun-alun Cupunagara adalah ruang terbuka hijau yang menjadi pusat denyut aktivitas sosial, olahraga, dan rekreasi masyarakat Desa Cupunagara di kawasan Bukanagara. Lapangan berumput luas berlatar belakang perbukitan teh dan jajaran pohon cemara ini sering menjadi titik kumpul komunitas pesepeda, pecinta motor trail, kegiatan festival seni budaya warga, hingga tempat bersantai sore bagi wisatawan dan keluarga yang ingin menikmati segarnya udara pegunungan tanpa dipungut biaya.','https://images.unsplash.com/photo-1472214103451-9374bd1c798e?auto=format&fit=crop&w=1200&q=80','[\"https:\\/\\/images.unsplash.com\\/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=1000&q=80\",\"https:\\/\\/images.unsplash.com\\/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1000&q=80\"]',-6.7645000,107.6828000,'https://www.google.com/maps/dir/?api=1&destination=-6.7645000,107.6828000','[\"Lapangan Hijau Terbuka\",\"Warung Makanan & Kopi Warga\",\"Mushola Sekitar\",\"Toilet Umum\",\"Area Parkir Luas\"]','Buka 24 Jam (Terbuka untuk Umum)','Gratis (Terbuka untuk umum)','Pengelola Lapangan Komunitas Cupunagara','6285798991234','Gunakan tempat sampah terpilah yang tersedia di tepi lapangan. Dilarang meninggalkan botol plastik atau puntung rokok di area rumput.',0,9,'2026-11-20 23:52:06','2026-11-20 23:52:06'),(13,'Balong Gede Sukasari','balong-gede-sukasari','Wisata Perairan & Rekreasi Alam','Danau alami (balong gede) berair pegunungan jernih yang tenang dan asri, spot favorit untuk rekreasi santai, memancing, dan menikmati sejuknya alam.','Balong Gede Sukasari adalah danau atau kolam air alami berukuran besar yang terletak di kawasan pegunungan perbatasan Cupunagara - Sukasari. Berada di dataran tinggi dengan pasokan mata air pegunungan yang jernih dan melimpah, danau ini menawarkan pemandangan menyejukkan dengan air yang tenang memantulkan hijau pepohonan di sekelilingnya. Tempat ini menjadi tujuan favorit wisatawan dan warga lokal untuk bersantai, rekreasi piknik keluarga di tepi danau, memancing ikan air tawar, serta menikmati udara sejuk khas Subang Selatan.','https://images.unsplash.com/photo-1439066615861-d1af74d74000?auto=format&fit=crop&w=1200&q=80','[\"https:\\/\\/images.unsplash.com\\/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1000&q=80\",\"https:\\/\\/images.unsplash.com\\/photo-1470071459604-3b5ec3a7fe05?auto=format&fit=crop&w=1000&q=80\"]',-6.7490000,107.6935000,'https://www.google.com/maps/dir/?api=1&destination=-6.7490000,107.6935000','[\"Spot Tepi Danau Alami\",\"Spot Memancing Ikan\",\"Gazebo Bambu Santai\",\"Warung Camilan Warga\",\"Area Parkir\"]','07.00 - 17.30 WIB','Retribusi Masuk / Kebersihan Rp 10.000 / orang','Pengelola Wisata Balong Gede','6285798991234','Dilarang membuang sampah, plastik, atau sisa makanan ke dalam danau air alami. Bawa kantong sampah sendiri saat piknik.',0,10,'2026-11-20 23:52:06','2026-11-20 23:52:06');
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
INSERT INTO `qr_points` VALUES (1,'pintu-masuk','Pintu Masuk Kawasan Ekowisata Cupunagara',-6.7542000,107.6865000,'https://www.google.com/maps/dir/?api=1&destination=-6.7542000,107.6865000','Titik gerbang utama penyambutan pengunjung ekowisata Desa Cupunagara. Dilengkapi plang bambu ramah lingkungan ber-QR Code untuk memandu arah wisata serta mengingatkan pengunjung membawa kembali sampah pribadi.','Selamat datang di Desa Cupunagara! Mohon siapkan wadah/kantong sampah pribadi di kendaraan Anda. Dilarang melempar botol dan bungkus plastik di sepanjang jalur masuk desa.',157,1,'2026-11-18 23:48:16','2026-11-21 00:16:02'),(2,'warung-warga','Warung Tempat Berkumpul Warga & UMKM',-6.7595000,107.6898000,'https://www.google.com/maps/dir/?api=1&destination=-6.7595000,107.6898000','Pusat interaksi sosial, warung kopi lokal, dan tempat berkumpul masyarakat serta wisatawan untuk melepas lelah sembari menikmati seduhan kopi asli Cupunagara.','Kawasan bebas sampah plastik berserakan. Tempatkan puntung rokok dan sampah makanan pada wadah tempat sampah terpilah yang telah disediakan di samping warung.',98,1,'2026-11-18 23:48:16','2026-11-18 23:48:16'),(3,'gardu-pandang','Area Gardu Pandang Perbukitan Cupunagara',-6.7562000,107.6881000,'https://www.google.com/maps/dir/?api=1&destination=-6.7562000,107.6881000','Titik tertinggi dengan panorama bentang perbukitan hijau dan hamparan kebun kopi. Titik favorit swafoto dan melihat kabut pagi di Desa Cupunagara.','Jaga keaslian pemandangan perbukitan! Bawa turun kembali semua sampah plastik, tisu, dan wadah minuman yang Anda bawa ke area gardu pandang.',215,1,'2026-11-18 23:48:16','2026-11-18 23:48:16');
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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
INSERT INTO `reports` VALUES (1,'CPN-202611-001',NULL,3,'Rizky Pratama','081234567891','sampah_menumpuk','Samping bangku kayu di dekat plang bambu QR gardu pandang atas','Ada sisa botol plastik air mineral dan kantong kresek yang tertinggal di bawah bangku kayu setelah hari libur kemarin.','https://images.unsplash.com/photo-1618477461853-cf6ed80faba5?auto=format&fit=crop&w=800&q=80','resolved','Sampah telah dibersihkan oleh regu kerja bakti pemuda Karang Taruna bersama pengelola wisata pada jadwal ronda kebersihan pagi. Tempat sampah tambahan telah diletakkan di dekat bangku.','https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80','2026-11-19 08:58:18','2026-11-18 23:48:16','2026-11-20 08:58:18'),(2,'CPN-202611-002',NULL,1,'Siti Nurhaliza (Wisatawan Bandung)','087811223344','saran_kebersihan','Area parkir kendaraan roda dua dekat gerbang masuk desa','Mohon ditambah plang pengingat agar pengendara motor tidak membuang karcis parkir atau plastik bekas jas hujan sembarangan saat musim hujan.',NULL,'in_progress','Laporan diterima dan divalidasi. Tim PDD dan perlengkapan sedang menyiapkan stiker imbauan tahan air tambahan untuk ditempel di pos jaga.',NULL,NULL,'2026-11-18 23:48:16','2026-11-18 23:48:16'),(3,'CPN-202611-003',NULL,2,'Anonim',NULL,'sampah_menumpuk','Saluran air di samping warung kopi bu ambar','Ada tumpukan daun kering dan cup plastik tersangkut di parit kecil.','https://images.unsplash.com/photo-1530587191325-3db32d826c18?auto=format&fit=crop&w=800&q=80','pending',NULL,NULL,NULL,'2026-11-18 23:48:16','2026-11-18 23:48:16'),(4,'CPN-202611-BBTA',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/0nNzAoSBxVhvZXAIhezolHnIEBPKa9kebIC8Mmqp.jpg','pending',NULL,NULL,NULL,'2026-11-19 00:02:27','2026-11-19 00:02:27'),(5,'CPN-202611-E9XM',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/Ef1o78wm1OcRnVCZ9qBBrm8vpUrtSbePBPk5y6aO.jpg','pending',NULL,NULL,NULL,'2026-11-19 00:03:04','2026-11-19 00:03:04'),(6,'CPN-202611-UQ1F',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/Nz0ij0RVqBjBMIZDoy04yTiYwzTXtO9z0XoChTbf.jpg','pending',NULL,NULL,NULL,'2026-11-19 00:05:17','2026-11-19 00:05:17'),(7,'CPN-202611-D01N',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/U4j5dKN5cT1WYNiLyvF42EERwJpy13DpU3r1lZDg.jpg','pending',NULL,NULL,NULL,'2026-11-19 00:31:05','2026-11-19 00:31:05'),(8,'CPN-202611-JOKN',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/b1uI1cdJChFbSjP3AODsREHfuB1izs22wueog1Vd.jpg','pending',NULL,NULL,NULL,'2026-11-19 00:31:21','2026-11-19 00:31:21'),(9,'CPN-202611-DILI',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/lSj2yEaAIe7JhbAfwkgQuqdOSWw8FvPrx4uvmUy8.jpg','pending',NULL,NULL,NULL,'2026-11-19 00:31:36','2026-11-19 00:31:36'),(10,'CPN-202611-E0TI',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/9gYuD3O4daauYIskcT0j0zRhGD5xCYOZjhzsEyAF.jpg','pending',NULL,NULL,NULL,'2026-11-19 00:32:00','2026-11-19 00:32:00'),(11,'CPN-202611-LO6O',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/gZuvlkhrS37R2fjAJZaEZOoTf9Ttj2OdNKFlxyu0.jpg','pending',NULL,NULL,NULL,'2026-11-19 02:00:43','2026-11-19 02:00:43'),(12,'CPN-202611-KJXL',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/ugtbuL0sKWcHVRRXtalcGZKdfwvbRSSHcJ2KtNKZ.jpg','pending',NULL,NULL,NULL,'2026-11-19 03:44:21','2026-11-19 03:44:21'),(13,'CPN-202611-TQXN',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/ga3iImaByUPEZNTCNcNAV7fzRQ56SN7E0V4hE0YI.jpg','pending',NULL,NULL,NULL,'2026-11-19 03:50:19','2026-11-19 03:50:19'),(14,'CPN-202611-C5EU',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/RarvdwRj7aZAZC8FmIpfhAdUXgRLJK0gigiJxJw8.jpg','pending',NULL,NULL,NULL,'2026-11-19 03:50:36','2026-11-19 03:50:36'),(15,'CPN-202611-RY3Z',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/bIX92e4dPWXTuA0Y60m6eLADi5LxxwbBxLkeM2aW.jpg','pending',NULL,NULL,NULL,'2026-11-19 14:16:57','2026-11-19 14:16:57'),(16,'CPN-202611-ITYL',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/mrAWXaKPEPOVi3ulM0o3FAp9xt9bc9xh7dIlBy2f.jpg','pending',NULL,NULL,NULL,'2026-11-19 14:26:09','2026-11-19 14:26:09'),(17,'CPN-202611-L0IU',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/DEaerSzyepo7uLqEWB9SX4IsvPl0uhiCn1SBfhWG.jpg','pending',NULL,NULL,NULL,'2026-11-19 14:31:53','2026-11-19 14:31:53'),(18,'CPN-202611-FYPS',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/2c4UvrtWiVlXg6BNyfw64zLDti4Fb5cIigbEeMwr.jpg','pending',NULL,NULL,NULL,'2026-11-19 14:35:54','2026-11-19 14:35:54'),(19,'CPN-202611-VEF6',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/2bQSMqtvrxe0dlzIYVSskuAi82850GZj0bzQEmA2.jpg','pending',NULL,NULL,NULL,'2026-11-19 14:37:24','2026-11-19 14:37:24'),(20,'CPN-202611-CESP',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/4Tb9s8Tdk9XkFzyA0Y0o6Z1Duv0a3BPrQDLwzf8z.jpg','pending',NULL,NULL,NULL,'2026-11-19 23:28:01','2026-11-19 23:28:01'),(21,'CPN-202611-UGNA',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/XwaMGSNFSVAmywABP63poA31Zet8s3PlhAbDYlK8.jpg','pending',NULL,NULL,NULL,'2026-11-20 09:04:41','2026-11-20 09:04:41'),(22,'CPN-202611-BMBX',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/JotKTxOKSluqTlLBnGyilEKyhdySCvPph20jf3iC.jpg','pending',NULL,NULL,NULL,'2026-11-20 09:05:06','2026-11-20 09:05:06'),(23,'CPN-202611-QYGH',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/GS28lGpj4NIhR9zhrSv45Ikc7fHUXIAJSbrcLpU3.jpg','pending',NULL,NULL,NULL,'2026-11-20 09:05:39','2026-11-20 09:05:39'),(24,'CPN-202611-KYGU',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/0B9j8OrlxUqbcg3ils8M0mAHUR30NzCMCu3oled4.jpg','pending',NULL,NULL,NULL,'2026-11-20 22:20:15','2026-11-20 22:20:15'),(25,'CPN-202611-MK2A',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/qp5G2apHySJ86L2kd9PrzOxum0B3HtqQ9rlRW3dT.jpg','pending',NULL,NULL,NULL,'2026-11-20 22:20:26','2026-11-20 22:20:26'),(26,'CPN-202611-TN06',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/5nbANXJLf3GgPMaCrwd5fIqPhzvyNeuMxadG6KZ8.jpg','pending',NULL,NULL,NULL,'2026-11-20 22:55:38','2026-11-20 22:55:38'),(27,'CPN-202611-7V5D',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/vI6pqW7j7eskzgkD5t5Hag5jZJZigkO3LZERzS48.jpg','pending',NULL,NULL,NULL,'2026-11-20 22:58:58','2026-11-20 22:58:58'),(28,'CPN-202611-OMUB',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/Lx8tMsISoAAVpiqmGn9fxLnS7qILk2XOlVvgkQ9F.jpg','pending',NULL,NULL,NULL,'2026-11-20 23:17:45','2026-11-20 23:17:45'),(29,'CPN-202611-SGSG',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/LkfCDCIcT9KeikZcbmMI5s27rDIpNK5iCXDvGNS7.jpg','pending',NULL,NULL,NULL,'2026-11-20 23:26:41','2026-11-20 23:26:41'),(30,'CPN-202611-C2ZY',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/N5tgCDYUGL58E4lFt6Dxyinb5KIbgfQblrLELbgh.jpg','pending',NULL,NULL,NULL,'2026-11-20 23:33:30','2026-11-20 23:33:30'),(31,'CPN-202611-VCPE',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/oHLeLPmb2e1ZObp19qjFl34PF6VDA3bFzva3l0qt.jpg','pending',NULL,NULL,NULL,'2026-11-20 23:42:33','2026-11-20 23:42:33'),(32,'CPN-202611-BY49',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/3H8JB6ViGpqoTfV3Mq94LuWaIybg3u4v6sma3Xl0.jpg','pending',NULL,NULL,NULL,'2026-11-20 23:52:53','2026-11-20 23:52:53'),(33,'CPN-202611-MYKD',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/ahUlTMuZRZl4BxLgRWkjaXIQmAd5ygvdWaldpAmH.jpg','pending',NULL,NULL,NULL,'2026-11-20 23:58:54','2026-11-20 23:58:54'),(34,'CPN-202611-3ZNQ',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/m6NIr3dvylbYZRRlkBwRONxewCvGjwHZCLOyTCHc.jpg','pending',NULL,NULL,NULL,'2026-11-21 00:09:53','2026-11-21 00:09:53'),(35,'CPN-202611-CSGG',NULL,NULL,'Budi Santoso','081234567890','sampah_menumpuk','Dekat warung kopi depan balai desa','Ada sisa kemasan plastik menumpuk setelah acara warga.','reports/FvfCDSbvzw5TftWhmhy4wPPFbM9480LkeJdj32l3.jpg','pending',NULL,NULL,NULL,'2026-11-21 00:16:02','2026-11-21 00:16:02');
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
INSERT INTO `sessions` VALUES ('0e7TGvVt8lry6AD4uilViqbEsSB96aNcgbsTWzjq',NULL,'127.0.0.1','Symfony','eyJfdG9rZW4iOiI3aGdBM2trTlpITDh4RWZKRzF6a0huZllwbmxFTlduOTNmWDQ0WTV2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1795241473),('46OijWc4ByJkoUYBQqIvTuNR4huVTeTBFPVFJ0ZV',NULL,'127.0.0.1','Symfony','eyJfdG9rZW4iOiJlbVdoRkhLV1VwbmQ3Z283OU91VkZ3RjBoTjMyeUFVc3MxeER0Snp2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1795241739),('4riVZ9SuyAmaNi9a4cLOgEJL2baF4tms2ZgSBriO',NULL,'127.0.0.1','Symfony','eyJfdG9rZW4iOiJYZE5vZktkN0t0TEI2a0xqSnZMT1pwSUNocVNRNkJTczI1YUFIUjh3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1795241620),('7SKrFVfPJLPdzNIGkJIoXUPRnCABlG5lJdW4RcWP',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJIMW1pajRyNFVHR3p6MTlpSXlWWU0ybWRzaHYxZ0FkcWRRZ3pTaWNvIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795071977),('8jaMhMBJq1fNLzlXZs3NcN4YkfhB0owB0T7DCGpA',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJkWmJGakswUnZlbVVyQzBWYk1hYTFRSGFvb1h5SFY1TDBxN01JUVd1IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795073545),('8PVrdZTMyZN0xDpHP85uymw6Sk3TyromC2L1x3I7',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiI5S1NoWXRacHVTbUE1R2FxMkJHTWxabnQ4dlJMME45RXFhOEtOR2VyIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795073532),('8uOqqVj8WxXc6UmPRZCWLS3VB8hABWyZ46JNu2k6',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJRM1pjSXk1VkpzS0FZVGtreDBvUGRUY3hqUkNJQ1dKaFlMMzRUbkViIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9xclwvcGludHUtbWFzdWsiLCJyb3V0ZSI6InFyLnNob3cifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795071983),('9Zp7EgY1XExsvWYWx4WZxQoeBWLppz7kHYY56o94',NULL,'127.0.0.1','Symfony','eyJfdG9rZW4iOiJTZnRwanFzY2xZMXQ2Tks1WnAwTFVRNFRxbk04MGozR0syRmtPaUNLIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1795241546),('CoqB6BFzesprLhim7yKz9nnciwIZLsFU3Ze4suIB',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJxRVRESm45b1FJZmRRRU51U2Z5ejlEUmwzVG5VOGo4QWlRU2JFaW5BIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1795123035),('CUtRDb3dmOwfwYS1nL7gdkQ9xGG0BIS0VIsrSubd',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJsQ00zeHhvSUJseTB2VTl2aXpmc2E1MTVicGpnMjQ4U09CRjUzUFZsIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795073531),('CyvqiXkxSokn4gO2LlLTqabB6YR5L00T8R0vRYWY',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJBU2Rjd2RWcnl2cE9BWVQ2UjdoMjduVGp3RG11VGJjRXJGVHhyb1JkIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795073531),('det5rYCTFrEVPNJUWBev0BUT3uwmiSVJg55Ix1Qi',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJKRXlQVlhTUFFYVk5EVmxKcDdXbzFBWW9aTW9vVkRpMmxKWTBsNjRIIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795073531),('dwmh3N86tmyHZOiPHPWt77wBq2jJCsSsndwqKGbd',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiI5ZTE3WTUwZGVMemZWbzZCeFRTRFhpd29ON3lpOU1mSkJ1bGFYVlNnIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795073531),('eEzMF4YGR4Meg4qM92F63qNrAeN3KoE7UmcqFdVs',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJlRmpEZ1c2cEZ5OWtLcWRZTmdCZHk0M0VGTDlZbkFINE5BZGgzUzBTIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sYXBvciIsInJvdXRlIjoicmVwb3J0cy5jcmVhdGUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795071983),('fs5Eq8YdZTO7WcaS093ulwhDav2lND7wBc1pW4BE',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJmZmdUV2V2MDdmZUxVbWVNWlBmanozMmVvb2hrNTk2b2FwdGJCNTNKIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795073531),('i0Y20snz4KdJaDgXm705xFkE6eIMIcMZvH1q40kN',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36','eyJfdG9rZW4iOiI0elp3dk9KZ2I0STdMSnFnSGV1MDVGeU9YNzFEZnRGS21iYm8yWFNyIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDAiLCJyb3V0ZSI6ImhvbWUifX0=',1795124260),('iClfZoHKqN8Va7c2U5pZgNQpXSN7GTqa3atNubtl',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJaaTV5OEtsTjhYM3NMYWVsRFRtTDRia3ZOTGJqdXI2U1JaYk4xallPIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sYXBvciIsInJvdXRlIjoicmVwb3J0cy5jcmVhdGUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795123998),('KAZqfMks0D3IaZefpW51cniMKAGRtybTlyxClQz9',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJLT1FodzZ0dVdSSExCSzVleklIVDlBRFVMTEVkR21WU3VVNnIxRXB4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pbiIsInJvdXRlIjoiYWRtaW4uZGFzaGJvYXJkIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsInBhc3N3b3JkX2hhc2hfd2ViIjoiZjY5ODY2MWRlMWRjMWU0ZTI5M2FkYjQ2ODFlOTY5YWVhMTE3ZjIzN2M0ZGEzZmJhMzA2ZDM3YWMwOGY0ZmI1MyJ9',1795191007),('LS49vCWSa4mxAShLHfaQnEjkDw6ARptTTpsLX4i8',NULL,'127.0.0.1','Symfony','eyJfdG9rZW4iOiJKOW9UekU4SGpxVzNGM215eFpQeXpPV3FmUXdHMmxUbDBlVU1hdWhWIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1795241703),('mhi1LXfTkt44AK1cT2inR7wNV788Ojv6b8UXWzDC',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJ1WVYwTTlEQmRnelZLSUhtM3J3cUhJVWdpTDlWS3FpQmtMdk1qYnNFIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC93aXNhdGEiLCJyb3V0ZSI6ImRlc3RpbmF0aW9ucy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1795071983),('njRSkpi7iNLqV0E8i9PfowCQ13vs8h6R5eBKSG6z',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiI5ZFQ5UW9veFFCMEluWlVrR0xkcFZBM1pWV29jamxzR0tFR3ZVOWlmIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvbG9naW4iLCJyb3V0ZSI6ImFkbWluLmxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1795071983),('NtOT0lwFDQKYwv5mLUnHUdwYOsg5xn0MyCRi5gVV',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJLRWd6aTljYVlFN3JIbnBZcGhaQ3BUbVFaRDBhZExVbFZ0NDZNdmNqIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sYXBvcmFuIiwicm91dGUiOiJyZXBvcnRzLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1795071983),('p0NeWcoZvXwy9IU83Sw7AuJ0hfkb9CeKBIvfv3QC',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiI5MjNyNlk4OWFrZ2pHVm5oSDM2ZmhsNFBVenM3d0ozaDJ6Y0Vkd1RPIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795073531),('Pksmx9YwsKDc26JpOxqJxNrLUmzXNnzfSmnXHXUI',NULL,NULL,'','eyJfdG9rZW4iOiJJR0d0WlNCQWZJc2dlZnZ5QkZ0MVNYZUxRRDA4OXdsNFhkNnJ2SkJKIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzoiLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795241050),('PVFmcxEZZhJId5lpHz6dExXWGIcgCWYZC9Aa9Ysa',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJzS1VRczhMcEJCeEdYWGJjSTVxMGpGSGRhdDRCbXpMYzdSSUZTVEJNIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795078853),('qG3PgBES1TOk47nXE0SRfCqfL1Wb8xWQtJUvHOHO',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJJZ3RRdHc5Q3J5RWhKMUVScWhIYUpmODhyVENTS0ppTHVLQzIzWUxxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9rb3BpIiwicm91dGUiOiJjb2ZmZWUuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795071983),('r0nGcAdJ7nKtUrXTTn3FGWj9VFXxu6NrbedqBkbk',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJiSEJwZk9YdGpMZVo1OXYwbnR6b1B6NFJEeVZrWlhYVkxyMFJ5cElYIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795073531),('sdYoljPTZB33NTTYPAk7re2JgGEUdgv9uuCsB5lr',NULL,'127.0.0.1','Symfony','eyJfdG9rZW4iOiJOdGplZ1ZxY1JLTndPNDdaMUpOckoxc293emdVbVJZalRVcTNaSnpiIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1795241262),('T2rx2PnmUjO5qbTssHrgfn5u9eRHhXsIOisn6gaR',NULL,'127.0.0.1','Symfony','eyJfdG9rZW4iOiJFYTdZR1dCY3BxTTh2akJqUUFjaU1vakpvSlhSakJ1Q0xya1doVzNIIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1795241556),('TcKVARMVHcEkN5TBV8T9Z6JzylcoNuDSmbnU1o1b',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJlUjh4M3hjcUs0VVFQZ2gyVTRGY3hIcFdFdGhrWXgzaTBPWXZacUFDIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1795085516),('TJie5dXFwlc0XEKgz2hRID08901E2HBWE4reUZbI',NULL,'127.0.0.1','Symfony','eyJfdG9rZW4iOiI5a3hkbVJvd2kxWllPR213R1drME4wdmlLbWR1QWZmTEZ3ZllWOGdXIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1795240692),('UTqkoNbLkKGq80uc9y02wbwwXUD8GiHjKEnjpUuU',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJaVURyb3ExNHJETGVLOUgwbW9CbldxcVluU0FWOEZDRVY2SjRkNWVaIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795073538),('Y8ct13cWypMDvp4rie925ejKsmyex8phhZIElURD',NULL,'127.0.0.1','curl/8.5.0','eyJfdG9rZW4iOiJIMlNLYWFDb1J4dno5elVTSXpXaFFwUkNnWHNBdTFJQndmbEdGT2p3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC93aXNhdGFcL2N1cnVnLWNpbGVhdCIsInJvdXRlIjoiZGVzdGluYXRpb25zLnNob3cifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795071987),('yPlNAKcbRd5bW2dtKB647kHWiDVrbK33249srrqk',NULL,NULL,'','eyJfdG9rZW4iOiJudWY2M1JwQlE1Q1pERDJzcWo0MDN2MVV3RnJvM1dhR1EyZ1BWVHZMIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzoiLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1795241634),('zsDKFwA2ul7BkM7Ke3kqjb7ga4fyXOkLr2rBvuG2',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJVa0p4aGppZ3dkMXFwTk56cjFwZG01bFNZTm9JU0lBYldnQTVMeDI2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1795154973);
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

-- Dump completed on 2026-11-21 14:16:09
