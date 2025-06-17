<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostAttachment;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title'      => 'Bakso.. Masa Sekolah?',
                'content'    => '“Masuk ke Bakso Masa Sekolah seperti kembali ke lorong waktu ketika seragam putih-abu, bel sekolah, dan keriuhan kantin menjadi soundtrack hari-hari kita. Disini, bakso disajikan dengan tampilan ikonik: bola-bola bakso jumbo—seperti Bakso Juara—ditambah tahu pong yang garing dan kerupuk merah-putih khas anak sekolah. Kuahnya jernih, gurih pas, dan diberi taburan bawang goreng serta daun bawang yang menambah aroma. Kamu bisa pilih mie kuning atau bihun, plus bonus semangkuk kacang goreng. Harganya ramah dompet, sekitar Rp15-20 ribu, cocok buat nostalgia ringan tanpa bikin kantong bolong. Tempatnya sederhana tapi hangat, banyak pelajar dan pekerja kantoran mampir buat ngisi energi. Eits, tersedia juga variasi bakso urat dan bakso telur buat yang pengen sensasi ekstra. Pokoknya, original, ramah, dan bikin kangen masa sekolah!”',
                'location'   => 'Jalan Putri Hijau No.15, Medan (depan ACE Hardware, dekat Samsat)',
                'gmap_url'   => 'https://maps.app.goo.gl/PJYkvfcUpfRWLeJN9',
                'place_name' => 'Bakso Masa Sekolah',
                'user_id'    => 1,
                'namaFile' => ['bms.png'],
                'hashtags'   => [1, 2, 6, 10],
            ],
            [
                'title'      => 'Caffe Hidden Gem di Medan',
                'content'    => '“Galaxy Coffee bukan cuma sekadar kedai kopi; ini mini-oasis perkotaan yang menyatu dengan sport & hangout space. Suasana indoor-outdoor bikin betah sejak pagi sampai malam. Konsep unik: area lounge dengan bean bag, sofa, serta meja biliar dan dart—sempurna buat kamu yang pengen santai tapi tetap mencari suasana "hidup". Kopi andalan mereka smooth latte dan cold brew yang disajikan estetik dalam gelas bening, lengkap dengan foam tebal dan art simpel. Selain kopi, tersedia pastry segar, chicken wings, dan snack ringan lain. Layanan cepat, staff ramah. Lokasi strategis—tepat di pinggir jalan besar, mudah dicari dan punya lahan parkir luas. Bangku outdoor dipenuhi tanaman hijau dan lampu gantung, menambah kesan cozy dan Instagramable. Harganya mingkin sedikit di atas rata-rata, tapi worth it buat kamu yang butuh kopi plus ambience kece. Pokoknya, hidden gem yang patut masuk list ngopi kamu!”',
                'location'   => 'Jl. Pasar III Union Soho No.145A/B, Tegal Rejo, Medan Perjuangan',
                'gmap_url'   => 'https://maps.app.goo.gl/wwqHT3ACVzZNtcXM6',
                'place_name' => 'Galaxy Coffee',
                'user_id'    => 1,
                'namaFile' => ['galaxy.jpeg'],
                'hashtags'   => [1, 2, 5, 12],
            ],
            [
                'title'      => 'Galih Coffee milik Sandhika Galih kah?',
                'content'    => '“Banyak yang bilang ini milik atau karena inspirasi dari Sandhika Galih, content creator kenamaan—tapi ternyata pemiliknya bukan dia. Meski demikian, Galih Coffee berhasil membangun reputasi lewat kopi berkualitas dan interior minimalis modern yang sangat Instagramable. Saat masuk, kamu disambut aroma kopi panggang menggoda. Menu unggulannya: single-origin brew dan signature espresso. Tersedia juga signature drink seperti affogato dan kopi susu kekinian. Baristanya ramah, siap bantu rekomendasi sesuai selera; mereka juga menjelaskan asal biji dan proses sangrai. Ada area lesehan serta meja kecil untuk yang membawa laptop. Wi-fi cepat, cocok buat kamu yang ingin sekaligus kerja remote. Harga kopi sekitar Rp30-40 ribu—cukup premium kalau dibanding cafe biasa, tapi sangat sepadan dengan kualitas rasa dan presentation. Kesimpulannya, Galih Coffee adalah spot tepat buat kamu yang cari kopi enak dengan suasana stylish.”',
                'location'   => 'Jl. Sei Deli No.12, Medan (sekitar area cafe & startup)',
                'gmap_url'   => 'https://maps.app.goo.gl/ku6vEYrN1LVn6Aac8',
                'place_name' => 'Galih Coffee',
                'user_id'    => 2,
                'namaFile' => ['galih.jpeg'],
                'hashtags'   => [2, 5, 11],
            ],
            [
                'title'      => 'Coffee nya Saff & Co ya?',
                'content'    => '“Banyak orang nanya apakah Oslo & Co ini brand dari Saff & Co—jawabannya: keduanya beda. Oslo & Co punya karakter tersendiri: modern minimalis dengan sentuhan Nordic. Desain interiornya bersih, dominan putih kayu cerah, lalu dihiasi tanaman tropis dan pencahayaan natural. Kopinya premium, dengan espresso berbasis biji yang disangrai medium-dark. Signature drinknya: latte dengan art halus dan pas teksturnya. Selain kopi, mereka punya pastry artisan, croissant, dan sandwich segar. Layanannya cukup cepat, pelayan ramah walaupun kadang ramai saat weekend. Harganya di kisaran Rp35-45 ribu per minuman—masih dalam wajar untuk cafe kelas menengah atas di Medan. Tempat ini cocok untuk brunch santai, diskusi bisnis kecil, atau sekadar foto-foto dengan vibes minimalis dan elegan.”',
                'location'   => 'Jl. Cik Ditiro No.10, Medan (daerah kampus & kantor)',
                'gmap_url'   => 'https://maps.app.goo.gl/DLFJmmTEskSEYs5h9',
                'place_name' => 'Oslo & Co',
                'user_id'    => 2,
                'namaFile' => ['oslo.jpeg', 'oslo2.jpeg'],
                'hashtags'   => [2, 5, 9],
            ],
            [
                'title'      => 'Mie Pangsit Hidden Gem',
                'content'    => '“Mie Pangsit Tiongsim ini adalah tempat sederhana yang punya rasa luar biasa. Pangsitnya besar dan penuh isi daging, setiap gigitan terasa juicy dan gurih. Kuah kaldu nya bening namun kaya rasa, terasa hangat dan menenangkan tenggorokan. Saya pesan mie kuning, tapi kamu juga bisa pilih bihun atau kwetiau. Dilengkapi kerupuk, daun bawang, dan bawang goreng—sempurna. Tempatnya tidak luas, mungkin hanya beberapa meja plastik, namun penataan rapi dan bersih. Pelayanannya cepat, karena mereka selesai masak batch demi batch. Harga sangat bersahabat: Rp12-15 ribu per porsi. Cocok buat makan siang cepat, tapi rasanya bikin nagih dan bikin lidah terus ingat. Banyak yang bilang ini hidden gem sesungguhnya di antara jajanan kaki lima Medan.”',
                'location'   => 'Jl. Karya No.5, Medan (dekat perempatan jalan utama)',
                'gmap_url'   => 'https://maps.app.goo.gl/tTm3vGB1fZwk8qVL8',
                'place_name' => 'Mie Pangsit Tiongsim',
                'user_id'    => 3,
                'namaFile' => ['tiongsim.jpg', 'tiongsim2.jpeg'],
                'hashtags'   => [1, 2, 6, 5],
            ],
            [
                'title'      => 'Cafe Hidden Gem Palangkaraya',
                'content'    => '“Dovers Palangkaraya Medan tampil beda—meskipun namanya menyiratkan Palangkaraya, kedainya ada di Medan dan menyajikan estetika khas kota asalnya: kayu cerah, tanaman hidup, dan lampu gantung temaram. Suasana hangat dan ramah, cocok untuk ngobrol panjang atau kerja di laptop. Mereka punya menu andalan: kopi single-origin, smoothie bowl segar, dan aneka sandwich serta wrap sehat. Penampilan makanan dan minuman sangat Instagramable—smoothie warna-warni dalam mangkuk, topping rapi dan penuh buah serta biji chia. Wifi cepat dan banyak colokan listrik di setiap sudut. Harga: Rp25-45 ribu per menu, masih wajar untuk spot makan sekaligus kerja. Banyak anak muda dan remote worker betah berlama-lama di sini. Rasanya unik, vibe-nya beda, bikin ketagihan buat balik lagi.”',
                'location'   => 'Jl. Taman Setia Budi No.21, Medan (dekat taman kota kecil)',
                'gmap_url'   => 'https://maps.app.goo.gl/zjA7mcsNqZVKV6998',
                'place_name' => 'Dovers Cafe & Lounge',
                'user_id'    => 3,
                'namaFile' => ['dovers.jpeg', 'dovers2.jpeg'],
                'hashtags'   => [1, 5, 10],
            ],
            [
                'title'      => 'Draja Coffee Overrated!!',
                'content'    => '“Draja Coffee Medan sering dibilang overrated karena harga kopinya cukup tinggi (Rp40-55 ribu), tapi begitu masuk saya paham kenapa: ambience-nya top—ruang luas, banyak tanaman hijau, dinding bata tanpa cat, pilar kayu, dan banyak sudut foto. Kopi premium dengan variasi single-origin dan blend khusus yang mereka roast sendiri. Rasa kopinya smooth, terkadang sedikit floral, tergantung batch. Ada juga signature drink seperti kopi kelapa dan coconut latte. Service-nya ramah, barista paham kopi, dan detail penyajiannya — foam tebal, foam art apik. Kalau kamu pengunjung yang menilai bobot experience & estetika lebih dari harga, Draja oke banget. Tapi kalau kamu cari kopi murah dan praktis, mungkin ini bukan tempatnya. Personal opinion? Saya rasa worth it sekali untuk sekali-sekali treat diri sendiri.”',
                'location'   => 'Jl. Setiabudi No.45, Medan (dekat pusat belanja)',
                'gmap_url'   => 'https://maps.app.goo.gl/h5ZMvMmEifrNgk7dA',
                'place_name' => 'Draja Coffee Setiabudi',
                'user_id'    => 4,
                'namaFile' => ['draja.jpeg', 'draja2.jpg'],
                'hashtags'   => [2, 5, 6],
            ],
            [
                'title'      => 'Cafe orang kaya, pemilik aventador pernah datang sini',
                'content'    => '“Thirtysix Multatuli Medan: mewah, eksklusif, dan kadang bikin iri. Rumah kopi plus dessert premium dengan sentuhan mewah: meja marmer, bronze art deco, kursi empuk, dan lighting dramatis. Banyak spot fotogenic, cocok buat feed Instagram. Mereka punya dessert special—lava cake premium, mille crepe, dan signature coffee cocktail. Kopi-nya diproses slow-brew dengan pilihan biji roaster internasional. Setelah saya ngobrol, ternyata pemilik Aventador dan deretan seleb pernah mampir—yang bikin tempat ini punya narasi elite. Harga? Bukan untuk dompet standar, minuman dan dessert berkisar Rp50-100 ribu. Tapi ambience dan rasa sedapnya sepadan. Kalau kamu sedang ingin treat diri, butuh tempat eksklusif dan tenang, ini pilihan top. Kalau untuk hangout biasa atau kopdar murah, lebih baik pilih yang lain.”',
                'location'   => 'Jl. Multatuli No.36, Medan',
                'gmap_url'   => 'https://maps.app.goo.gl/K7XByKnRvMhcs2jx8',
                'place_name' => 'Thirtysix Multatuli Medan',
                'user_id'    => 4,
                'namaFile' => ['thirtysix.jpeg', 'thirtysix2.jpg'],
                'hashtags'   => [2, 6, 9, 10],
            ],
            [
                'title'      => 'Kok Dagu? Kok...',
                'content'    => '“Kodagu Coffee Medan hadir sebagai spot kopi yang punya karakter kuat. Nama “Kodagu” mengacu ke pegunungan kopi di India—tanda bahwa mereka serius soal single-origin. Kamu bisa coba brew seperti V60, aeropress, atau cold brew. Rasanya cenderung bright, acidic ringan, dengan aroma buah dan floral. Mereka juga punya variant espresso dan kopi susu manis. Tempatnya cozy, dominasi sofa dan meja kayu, plus tanaman hijau yang bikin rasa adem. Harga kopi: Rp28-40 ribu, cukup ramah untuk kopi spesial. Ada juga pastry manis, cake, dan sandwich untuk teman ngopi. Baristanya informatif, berbicara tentang asal biji dan teknik seduh kalau ditanya. Sangat cocok buat kamu yang menghargai kualitas dan ingin belajar kopi lebih dalam. Plus: wifi stabil dan spot non-merokok nyaman untuk laptop atau baca buku.”',
                'location'   => 'Jl. Palang Merah No.22, Medan (daerah perumahan elite)',
                'gmap_url'   => 'https://maps.app.goo.gl/uHbnUdaUs9HUWjps9',
                'place_name' => 'Kodagu Coffee Medan',
                'user_id'    => 5,
                'namaFile' => ['kodagu.jpeg', 'kodagu2.jpeg'],
                'hashtags'   => [2, 5, 11],
            ],
            [
                'title'      => 'Casu macam as*, murah banget',
                'content'    => '“Casu Caffee Medan ini dikenal memberikan value for money luar biasa. Kopinya enak—espresso dan kopi susu-nya punya body pas, tidak terlalu pahit, tidak terlalu manis. Penyajiannya cepat, cocok untuk kamu yang buru-buru pagi atau istirahat siang. Suasananya sederhana tapi bersih—meja plastik dan bangku kayu kecil, plus hiasan dinding mural ringan. Mereka juga menjual snack ringan, seperti risol, pisang goreng, dan pastel. Harga sangat terjangkau: Rp10-15 ribu per minuman dan Rp3-5 ribu per snack. Banyak pekerja kantoran dan mahasiswa mampir buat ngopi sambil istirahat singkat. Lokasinya strategis—dekat jalan besar dan transportasi umum. Kalau kamu cari kopi encer-enak tanpa harus tunaikan Syariah dompet, ini tempatnya.”',
                'location'   => '02, Jl. Sultan Agung No.8B, Petisah Tengah, Kota Medan, Sumatera Utara 20111',
                'gmap_url'   => 'https://maps.app.goo.gl/yfbekXwFxUT7zej67',
                'place_name' => 'Casu Grounds',
                'user_id'    => 5,
                'namaFile' => ['casu.jpeg', 'casu2.jpeg'],
                'hashtags'   => [2, 6, 10],
            ],
            [
                'title'      => 'Warung Pecel Underrated, Hanya Sultan yang datang',
                'content'    => 'Di sudut kota Medan, tersembunyi sebuah warung pecel yang tak banyak diketahui orang—hanya para sultan kuliner sejati yang berani menjajal kenikmatan cita rasa autentik. Warung Pecel Pohon Ceri menyajikan pepaduan bumbu kacang asli Jawa yang kental dengan aroma rempah, dipadu kerupuk jumbo renyah, serta sayur-sayuran segar hasil panen lokal. Ketika seporsi pecel hadir di hadapan Anda, sensasi gurih, manis, dan pedas berpadu sempurna dalam satu suapan. Nuansa sederhana warung—deret meja kayu, lampu gantung temaram, dan bingkai foto hitam-putih suasana pasar tradisional—justru menambah kehangatan. Setiap pagi, seorang sultan pecel lokal rela antre demi sepiring kebaikan ini. Tak heran jika Warung Pecel Pohon Ceri menjadi rahasia tersimpan di kalangan penikmat sejati, meski belum viral di media sosial.',
                'location'   => 'Jl. Ngumban Surbakti No.82A, Sempakata, Kec. Medan Selayang, Kota Medan, Sumatera Utara 20131',
                'gmap_url'   => 'https://maps.app.goo.gl/4KgZ8xHn4TdQcFF48',
                'place_name' => 'Warung Pecel Pohon Ceri',
                'user_id'    => 1,
                'namaFile'   => ['WPPC.jpg', 'WPPC2.jpg'],
                'hashtags'   => [1, 2, 6],
            ],
            [
                'title'      => 'Basecamp Nongkrong Tuan Muda Sukses',
                'content'    => 'Basecamp Nongkrong Tuan Muda Sukses adalah markas rahasia bagi para inovator dan pemimpin masa depan yang ingin mendominasi dunia. Begitu melangkah masuk, Anda akan disambut interior industrial-chic dengan dinding bata ekspos, rak besi berlubang berisi buku-buku strategi bisnis dan peta dunia kuno, serta meja panjang dari kayu daur ulang lengkap dengan kursi kulit empuk. Area lounge dilengkapi bean bag super nyaman, bean bar estetik yang menyediakan kopi single origin pilihan, smoothie eksotis, hingga mocktail signature. Pada setiap sudut, lampu Edison menggantung rendah menciptakan suasana hangat dan dramatis. Di weekends, Basecamp menjadi panggung diskusi intens, workshop coding, hingga sesi mastermind beranggotakan CEO muda, pengusaha startup, dan investor berlatar global. Fasilitas wifi super kencang, ruangan meeting berteknologi VR, serta bilik podcast mini membuat Basecamp tak hanya tempat nongkrong, melainkan laboratorium kreativitas. Bukan hanya soal bisnis: di sini, visi besar dirayakan dengan networking, mentorship, dan tantangan mingguan yang memacu adrenalin. Jika Anda ingin bergabung dalam misi menaklukkan dunia, Basecamp ini adalah gerbang pertamanya.',
                'location'   => 'Jl. Brigjend Katamso Dalam No.62-I, A U R, Kec. Medan Maimun, Kota Medan, Sumatera Utara 20212',
                'gmap_url'   => 'https://maps.app.goo.gl/wGLS8iEGDKqqNDYk6',
                'place_name' => 'Sekretariat KMB-USU',
                'user_id'    => 1,
                'namaFile'   => ['SKU.jpg'],
                'hashtags'   => [10,11,12],
            ],
            [
                'title'      => 'No Babi, No Life',
                'content'    => 'Rumah Makan BPK Tesalonika menjadi destinasi wajib bagi para pencinta kuliner babi di Medan. Dengan aneka olahan daging babi mulai dari sate bumbu kecap, panggang gurih, hingga gulai santan kental, setiap menu diolah dengan resep turun-temurun. Sensasi gurih dan legit berpadu dengan bumbu rahasia keluarga, menciptakan cita rasa yang sulit ditandingi. Suasana tempat makan sengaja dirancang sederhana, meja-meja kayu lurik dan keramik tradisional, agar fokus pada kenikmatan kuliner. Warna lampu kuning lembut menambah hangat suasana, sementara aroma harum daging bakar tercium dari kejauhan. Bagi yang berani bereksperimen, sambal khas rumah makan ini siap menambah level kepedasan. No Babi, No Life—sebagai slogan, menggambarkan filosofi hidup para penggemar daging babi yang tak pernah lelah mengejar kesempurnaan rasa.',
                'location'   => 'Jl. Jamin Ginting No.103, Simpang Selayang, Kec. Medan Tuntungan, Kota Medan, Sumatera Utara 20135',
                'gmap_url'   => 'https://maps.app.goo.gl/MU2cjFZSdKxo2hp39',
                'place_name' => 'Rumah Makan BPK Tesalonika',
                'user_id'    => 2,
                'namaFile'   => ['RBT.jpg','RBT2.jpg'],
                'hashtags'   => [2,6,7],
            ],
            [
                'title'      => 'Sungai Fantasi?',
                'content'    => 'Pelaruga, yang berarti "laut di darat", menyuguhkan panorama sungai jernih berwarna toska yang memantulkan langit cerah dan pepohonan rimbun. Aliran air Pelaruga mengalir tenang melintasi bebatuan besar, menciptakan efek suara gemericik menenangkan. Di tepi sungai, terdapat dermaga kayu kecil untuk bersantai sambil menikmati kopi atau teh hangat. Wisata foto di Pelaruga tak pernah sepi; calon pengantin bahkan menjadikan lokasi ini latar bebas alami untuk foto pranikah. Jika Anda ingin merasakan sensasi berkeliling sungai dengan perahu rakit, pemandu lokal siap mengantar menjelajah 500 meter hilir-muara. Dedaunan hijau dan pepohonan tinggi menambah kesejukan, seolah membela diri dari keramaian dunia luar.',
                'location'   => 'Jl. Telagah, Rumah Galuh, Kec. Sei Bingai, Kabupaten Langkat, Sumatera Utara 20771',
                'gmap_url'   => 'https://maps.app.goo.gl/mqAHjWfxp16hG5SK7',
                'place_name' => 'Pelaruga',
                'user_id'    => 1,
                'namaFile'   => ['P.jpg'],
                'hashtags'   => [4,12,5],
            ],
            [
                'title'      => 'First Date yang Seru, Murah, dan Meriah',
                'content'    => 'Penatapen Barcelona, kafe mungil di pinggiran Sibolangit, memikat pasangan muda untuk merayakan first date dengan konsep unik. Interiornya memadukan gaya rustic kayu blond dan lampu gantung bergaya vintage. Menu andalan, “Spanish Latte”, dipadu kue traditioneel tapas manis dan gurih, memberi pengalaman berbeda. Di halaman belakang, ada area taman mini lengkap dengan bean bag dan lampu taman temaram yang romantis. Harga setiap porsi berkisar 20–30 ribu rupiah, terjangkau untuk kantong mahasiswa. Musik akustik live setiap akhir pekan semakin menambah kemesraan suasana. Penatapen Barcelona bukan sekadar kafe; ia menjadi saksi bisu kisah cinta yang pertama kali bersemi di kursi kayu usang namun penuh kenangan.',
                'location'   => 'Jln. Jamin Ginting km 55 desa doulu kab karo kode pos, Martelu, Kec. Sibolangit, Kabupaten Deli Serdang, Sumatera Utara 22156',
                'gmap_url'   => 'https://maps.app.goo.gl/a41xfKAHFyLWE17aA',
                'place_name' => 'Penatapen Barcelona',
                'user_id'    => 2,
                'namaFile'   => ['PB.jpeg'],
                'hashtags'   => [7,10,1],
            ],
            [
                'title'      => 'Fenomena Alam, Bukti Azab itu Nyata',
                'content'    => 'Batu Gantung di tepi Danau Toba menyimpan mitos bahwa batu besar yang menjulang seperti terlepas dari tebing sarat makna mistis. Menurut cerita, penduduk setempat meyakini bahwa batu ini adalah berkah sekaligus peringatan alam bagi manusia yang lalai. Warna permukaan batu berubah menjadi keemasan saat sinar matahari pagi menembus kabut tipis. Pemandangan Danau Toba di kejauhan, dengan pulau Samosir di tengahnya, tampak nyata seperti lukisan alam. Sensasi angin dan aroma segar perairan memberi efek khusyuk. Bagi yang percaya, Batu Gantung adalah saksi azab alam yang berjaga agar manusia tidak melupakan keseimbangan dengan lingkungan.',
                'location'   => 'MWQF+9P3 Lake Toba, Kabupaten Simalungun, Sumatera Utara 21174',
                'gmap_url'   => 'https://maps.app.goo.gl/FcHneUQNHADCa7UG9',
                'place_name' => 'Batu Gantung',
                'user_id'    => 3,
                'namaFile'   => ['BG.jpeg'],
                'hashtags'   => [8,4,9],
            ],
            [
                'title'      => 'Panorama Indonesia yang Mendunia',
                'content'    => 'Waterfront City Pangururan di tepi Danau Toba menawarkan panorama air tenang berkelopak emas saat matahari terbit dan jingga membara saat senja merunduk. Area promenade dipenuhi marm welcoming benches, lampu taman artistik, serta gerai kopi lokal menebar aroma roasted beans yang mengundang. Di setiap sudut, instalasi seni kontemporer memadukan budaya Batak dan sentuhan modern, menciptakan latar foto yang memukau. Panggung kecil di pusat boulevard rutin menampilkan kelompok musik folk tradisional. Suara gondang dan suling berpadu dengan desiran ombak kecil menyemarakkan suasana. Dengan udara pegunungan segar dan latar megah Danau Toba, Waterfront City Pangururan menjelma destinasi wisata kelas dunia, buktikan bahwa keindahan Indonesia tak tertandingi.',
                'location'   => 'JP22+FR3, Unnamed Road, Pardomuan I, Pangururan, Samosir Regency, North Sumatra 22392',
                'gmap_url'   => 'https://maps.app.goo.gl/mtGD97pdMWwQzzT28',
                'place_name' => 'Waterfront City Pangururan',
                'user_id'    => 1,
                'namaFile'   => ['WP.jpeg', 'WP2.jpeg'],
                'hashtags'   => [1,4,5],
            ],
            [
                'title'      => 'Disneyland Sumatera',
                'content'    => 'Mikie Funland di Berastagi, dijuluki “Disneyland Sumatera”, adalah taman rekreasi keluarga lengkap dengan wahana klasik seperti komidi putar, kereta gantung mini, dan taman labirin. Warna-warni lampu LED di malam hari memantulkan bayangan ceria di jalan setapak. Setiap wahana didesain dengan sentuhan cerita lokal—misalnya desa hobbit Batak—mengajak anak-anak sekaligus orang dewasa untuk belajar budaya sambil bermain. Gerai makanan menawarkan jagung bakar manis, jagung rebus, dan es krim rasa kopi Karo, menciptakan pengalaman kuliner unik. Pengunjung bisa menikmati pemandangan Gunung Sinabung yang menjulang sebagai latar. Dengan tiket terjangkau dan fasilitas ramah anak, Mikie Funland menjadi tujuan rutin liburan keluarga di Sumatera Utara.',
                'location'   => 'Jl. Jamin Ginting, Sempajaya, Kec. Berastagi, Kabupaten Karo, Sumatera Utara 22152',
                'gmap_url'   => 'https://maps.app.goo.gl/1gxUnKzuQ3XX2dZW7',
                'place_name' => 'Mikie Funland',
                'user_id'    => 1,
                'namaFile'   => ['MF.jpg'],
                'hashtags'   => [10,9,6],
            ],
            [
                'title'      => 'Bakso Murni Telong, Tempat Makan Bakso Khas Medan',
                'content'    => 'Bakso Murni Telong adalah tempat makan bakso dengan cita rasa yang khas dan bahan-bahan berkualitas. Tempatnya sederhana namun nyaman, cocok untuk makan bersama keluarga atau teman.',
                'location'   => 'Jl. Sisingamangaraja No.460A, Sitirejo II, Kec. Medan Amplas, Kota Medan, Sumatera Utara 20217',
                'gmap_url'   => 'https://maps.app.goo.gl/VouzBEd99icNqmB48',
                'place_name' => 'Bakso Murni Telong',
                'user_id'    => 1,
                'namaFile'     => ['bms.jpg', 'bms2.jpg'],
                'hashtags' => [7,8,9]
            ],
            [
                'title'      => 'Tempat Es Krim yang kekinian',
                'content'    => 'Cooler city dengan vibes cozy yang cocok buat nongkrong dan menikmati es krim rasa unik seperti klepon, martabak, waffle, sampai durian Medan!',
                'location'   => 'Komplek Epicentrum, Jl. Dr. Mansyur No.98A, Padang Bulan Selayang I, Medan Selayang, Medan City, North Sumatra',
                'gmap_url'   => 'https://maps.app.goo.gl/ru6JP5GTtJWGra5F8',
                'place_name' => 'Cooler City',
                'user_id'    => 1,
                'namaFile'     => ['cooler (1).jpg', 'cooler (2).jpg', 'cooler (3).jpg'],
                'hashtags' => [1, 2, 4]
            ],
            [
                'title'      => 'Tempat makan berkodee',
                'content'    => 'Barkode pasbar tempat makann dengan tema kode kode seperti QR Code sesuai dengan namanya,. Tempatnya asik, seru, nyaman untuk nugas. COCOK JUGA UNTUK KUMPUL KELUARGA.',
                'location'   => 'Jl. Ps. Baru No.39, Titi Rantai, Kec. Medan Baru, Kota Medan, Sumatera Utara 20157',
                'gmap_url'   => 'https://maps.app.goo.gl/uLcyHcWYMoR72nBR8',
                'place_name' => 'Barkode Pasbar',
                'user_id'    => 1,
                'namaFile'     => ['barkode.jpg', 'barkode2.jpg', 'barkode3.jpg'],
                'hashtags' => [1, 2, 3, 4, 5]
            ],
        ];

        foreach ($posts as $post) {
            $kocak = Post::create([
                'title' => $post['title'],
                'content' => $post['content'],
                'location' => $post['location'],
                'gmap_url' => $post['gmap_url'],
                'place_name' => $post['place_name'],
                'user_id' => $post['user_id'],
                'created_at'  => now(),
                'updated_at'  => now()
            ]);

            foreach ($post['namaFile'] as $namaFile) {
                PostAttachment::create([
                    'post_id' => $kocak->id,
                    'namafile' => $namaFile
                ]);
            }
            // foreach($post['hashtags'] as $hashtags){
            //     Tag::create([
            //         'post_id' => $kocak->id,
            //         'hashtag_id' => $hashtags
            //     ]);
            // }
            $kocak->tag()->attach($post['hashtags']);
        }
    }
}