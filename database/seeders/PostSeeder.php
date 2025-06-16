<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PostAttachment;
use App\Models\Tag;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $posts = [
        //     [
        //         'title'      => 'Warung Pecel Underrated, Hanya Sultan yang datang',
        //         'content'    => 'Di tengah hutan kota terdapat lokasi penangkaran kupu-kupu dengan ratusan spesies indah. Cocok untuk edukasi dan fotografi.',
        //         'location'   => 'Jl. Ngumban Surbakti No.82A, Sempakata, Kec. Medan Selayang, Kota Medan, Sumatera Utara 20131',
        //         'gmap_url'   => 'https://maps.google.com/?q=Jl.+Hutan+Raya+No.5,+Medan',
        //         'place_name' => 'Warung Pecel Pohon Ceri',
        //         'user_id'    => 1,
        //         'namaFile'     => ['blankprofile.png', 'blankprofile.png']
        //     ],
        //     [
        //         'title'      => 'Warung Soto Pak Didi',
        //         'content'    => 'Warung soto legendaris dengan kuah gurih dan suwiran ayam melimpah. Ramai di pagi hari.',
        //         'location'   => 'Jl. Pemuda No.12, Medan',
        //         'gmap_url'   => 'https://maps.google.com/?q=Jl.+Pemuda+No.12,+Medan',
        //         'place_name' => 'Soto Pak Didi',
        //         'user_id'    => 2,
        //         'namaFile'   => ['blankprofile.png'],
        //     ],
        //     [
        //         'title'      => 'Taman Sari Buah Lokal',
        //         'content'    => 'Kebun buah lokal yang asri, lengkap dengan area panen langsung dan rumah makan buah segar.',
        //         'location'   => 'Desa Sari Makmur, Deli Serdang',
        //         'gmap_url'   => 'https://maps.google.com/?q=Desa+Sari+Makmur,+Deli+Serdang',
        //         'place_name' => 'Taman Sari Buah',
        //         'user_id'    => 3,
        //         'namaFile'   => ['blankprofile.png'],
        //     ],
        //     [
        //         'title'      => 'Kopi Lembah Dewata',
        //         'content'    => 'Kafe dengan konsep alam terbuka, menyajikan kopi single origin pegunungan yang harum.',
        //         'location'   => 'Jl. Lembah Dewata No.8, Berastagi',
        //         'gmap_url'   => 'https://maps.google.com/?q=Jl.+Lembah+Dewata+No.8,+Berastagi',
        //         'place_name' => 'Kopi Lembah Dewata',
        //         'user_id'    => 4,
        //         'namaFile'   => ['blankprofile.png'],
        //     ],
        //     [
        //         'title'      => 'Spot Sunset Pantai Cermin',
        //         'content'    => 'Pantai tersembunyi dengan pemandangan sunset menakjubkan, pasir putih bersih, dan perahu nelayan.',
        //         'location'   => 'Pantai Cermin, Serdang Bedagai',
        //         'gmap_url'   => 'https://maps.google.com/?q=Pantai+Cermin,+Serdang+Bedagai',
        //         'place_name' => 'Pantai Cermin',
        //         'user_id'    => 5,
        //         'namaFile'   => ['blankprofile.png'],
        //     ],
        // ];
        $posts = [
            [
                'title'      => 'Bakso Masa Sekolah?',
                'content'    => '“Masuk ke Bakso Masa Sekolah seperti kembali ke lorong waktu ketika seragam putih-abu, bel sekolah, dan keriuhan kantin menjadi soundtrack hari-hari kita. Disini, bakso disajikan dengan tampilan ikonik: bola-bola bakso jumbo—seperti Bakso Juara—ditambah tahu pong yang garing dan kerupuk merah-putih khas anak sekolah. Kuahnya jernih, gurih pas, dan diberi taburan bawang goreng serta daun bawang yang menambah aroma. Kamu bisa pilih mie kuning atau bihun, plus bonus semangkuk kacang goreng. Harganya ramah dompet, sekitar Rp15-20 ribu, cocok buat nostalgia ringan tanpa bikin kantong bolong. Tempatnya sederhana tapi hangat, banyak pelajar dan pekerja kantoran mampir buat ngisi energi. Eits, tersedia juga variasi bakso urat dan bakso telur buat yang pengen sensasi ekstra. Pokoknya, original, ramah, dan bikin kangen masa sekolah!”',
                'location'   => 'Jalan Putri Hijau No.15, Medan (depan ACE Hardware, dekat Samsat)',
                'gmap_url'   => 'https://maps.app.goo.gl/PJYkvfcUpfRWLeJN9',
                'place_name' => 'Bakso Masa Sekolah',
                'user_id'    => 1,
                'namaFile'   => ['bms.png'],
                'hashtags'   => [1, 2, 3, 4, 5]
            ],
            [
                'title'      => 'Caffe Hidden Gem di Medan',
                'content'    => '“Galaxy Coffee bukan cuma sekadar kedai kopi; ini mini-oasis perkotaan yang menyatu dengan sport & hangout space. Suasana indoor-outdoor bikin betah sejak pagi sampai malam. Konsep unik: area lounge dengan bean bag, sofa, serta meja biliar dan dart—sempurna buat kamu yang pengen santai tapi tetap mencari suasana "hidup". Kopi andalan mereka smooth latte dan cold brew yang disajikan estetik dalam gelas bening, lengkap dengan foam tebal dan art simpel. Selain kopi, tersedia pastry segar, chicken wings, dan snack ringan lain. Layanan cepat, staff ramah. Lokasi strategis—tepat di pinggir jalan besar, mudah dicari dan punya lahan parkir luas. Bangku outdoor dipenuhi tanaman hijau dan lampu gantung, menambah kesan cozy dan Instagramable. Harganya mingkin sedikit di atas rata-rata, tapi worth it buat kamu yang butuh kopi plus ambience kece. Pokoknya, hidden gem yang patut masuk list ngopi kamu!”',
                'location'   => 'Jl. Pasar III Union Soho No.145A/B, Tegal Rejo, Medan Perjuangan',
                'gmap_url'   => 'https://maps.app.goo.gl/wwqHT3ACVzZNtcXM6',
                'place_name' => 'Galaxy Coffee',
                'user_id'    => 1,
                'namaFile' => ['galaxy.jpeg'],
                'hashtags' => [1, 2, 3, 4, 5]
            ],
            [
                'title'      => 'Galih Coffee milik Sandhika Galih kah?',
                'content'    => '“Banyak yang bilang ini milik atau karena inspirasi dari Sandhika Galih, content creator kenamaan—tapi ternyata pemiliknya bukan dia. Meski demikian, Galih Coffee berhasil membangun reputasi lewat kopi berkualitas dan interior minimalis modern yang sangat Instagramable. Saat masuk, kamu disambut aroma kopi panggang menggoda. Menu unggulannya: single-origin brew dan signature espresso. Tersedia juga signature drink seperti affogato dan kopi susu kekinian. Baristanya ramah, siap bantu rekomendasi sesuai selera; mereka juga menjelaskan asal biji dan proses sangrai. Ada area lesehan serta meja kecil untuk yang membawa laptop. Wi-fi cepat, cocok buat kamu yang ingin sekaligus kerja remote. Harga kopi sekitar Rp30-40 ribu—cukup premium kalau dibanding cafe biasa, tapi sangat sepadan dengan kualitas rasa dan presentation. Kesimpulannya, Galih Coffee adalah spot tepat buat kamu yang cari kopi enak dengan suasana stylish.”',
                'location'   => 'Jl. Sei Deli No.12, Medan (sekitar area cafe & startup)',
                'gmap_url'   => 'https://maps.app.goo.gl/ku6vEYrN1LVn6Aac8',
                'place_name' => 'Galih Coffee',
                'user_id'    => 2,
                'namaFile' => ['galih.jpeg'],
                'hashtags' => [3, 6, 9]
            ],
            [
                'title'      => 'Coffee nya Saff & Co ya?',
                'content'    => '“Banyak orang nanya apakah Oslo & Co ini brand dari Saff & Co—jawabannya: keduanya beda. Oslo & Co punya karakter tersendiri: modern minimalis dengan sentuhan Nordic. Desain interiornya bersih, dominan putih kayu cerah, lalu dihiasi tanaman tropis dan pencahayaan natural. Kopinya premium, dengan espresso berbasis biji yang disangrai medium-dark. Signature drinknya: latte dengan art halus dan pas teksturnya. Selain kopi, mereka punya pastry artisan, croissant, dan sandwich segar. Layanannya cukup cepat, pelayan ramah walaupun kadang ramai saat weekend. Harganya di kisaran Rp35-45 ribu per minuman—masih dalam wajar untuk cafe kelas menengah atas di Medan. Tempat ini cocok untuk brunch santai, diskusi bisnis kecil, atau sekadar foto-foto dengan vibes minimalis dan elegan.”',
                'location'   => 'Jl. Cik Ditiro No.10, Medan (daerah kampus & kantor)',
                'gmap_url'   => 'https://maps.app.goo.gl/DLFJmmTEskSEYs5h9',
                'place_name' => 'Oslo & Co',
                'user_id'    => 2,
                'namaFile' => ['oslo.jpeg', 'oslo2.jpeg'],
                'hashtags' => [1, 2, 3]
            ],
            [
                'title'      => 'Mie Pangsit Hidden Gem',
                'content'    => '“Mie Pangsit Tiongsim ini adalah tempat sederhana yang punya rasa luar biasa. Pangsitnya besar dan penuh isi daging, setiap gigitan terasa juicy dan gurih. Kuah kaldu nya bening namun kaya rasa, terasa hangat dan menenangkan tenggorokan. Saya pesan mie kuning, tapi kamu juga bisa pilih bihun atau kwetiau. Dilengkapi kerupuk, daun bawang, dan bawang goreng—sempurna. Tempatnya tidak luas, mungkin hanya beberapa meja plastik, namun penataan rapi dan bersih. Pelayanannya cepat, karena mereka selesai masak batch demi batch. Harga sangat bersahabat: Rp12-15 ribu per porsi. Cocok buat makan siang cepat, tapi rasanya bikin nagih dan bikin lidah terus ingat. Banyak yang bilang ini hidden gem sesungguhnya di antara jajanan kaki lima Medan.”',
                'location'   => 'Jl. Karya No.5, Medan (dekat perempatan jalan utama)',
                'gmap_url'   => 'https://maps.app.goo.gl/tTm3vGB1fZwk8qVL8',
                'place_name' => 'Mie Pangsit Tiongsim',
                'user_id'    => 3,
                'namaFile' => ['tiongsim.jpg', 'tiongsim2.jpeg'],
                'hashtags' => [1, 4, 5]
            ],
            [
                'title'      => 'Cafe Hidden Gem Palangkaraya',
                'content'    => '“Dovers Palangkaraya Medan tampil beda—meskipun namanya menyiratkan Palangkaraya, kedainya ada di Medan dan menyajikan estetika khas kota asalnya: kayu cerah, tanaman hidup, dan lampu gantung temaram. Suasana hangat dan ramah, cocok untuk ngobrol panjang atau kerja di laptop. Mereka punya menu andalan: kopi single-origin, smoothie bowl segar, dan aneka sandwich serta wrap sehat. Penampilan makanan dan minuman sangat Instagramable—smoothie warna-warni dalam mangkuk, topping rapi dan penuh buah serta biji chia. Wifi cepat dan banyak colokan listrik di setiap sudut. Harga: Rp25-45 ribu per menu, masih wajar untuk spot makan sekaligus kerja. Banyak anak muda dan remote worker betah berlama-lama di sini. Rasanya unik, vibe-nya beda, bikin ketagihan buat balik lagi.”',
                'location'   => 'Jl. Taman Setia Budi No.21, Medan (dekat taman kota kecil)',
                'gmap_url'   => 'https://maps.app.goo.gl/zjA7mcsNqZVKV6998',
                'place_name' => 'Dovers Cafe & Lounge',
                'user_id'    => 3,
                'namaFile' => ['dovers.jpeg', 'dovers2.jpeg'],
                'hashtags' => [9,8,4]
            ],
            [
                'title'      => 'Draja Coffee Overrated!!',
                'content'    => '“Draja Coffee Medan sering dibilang overrated karena harga kopinya cukup tinggi (Rp40-55 ribu), tapi begitu masuk saya paham kenapa: ambience-nya top—ruang luas, banyak tanaman hijau, dinding bata tanpa cat, pilar kayu, dan banyak sudut foto. Kopi premium dengan variasi single-origin dan blend khusus yang mereka roast sendiri. Rasa kopinya smooth, terkadang sedikit floral, tergantung batch. Ada juga signature drink seperti kopi kelapa dan coconut latte. Service-nya ramah, barista paham kopi, dan detail penyajiannya — foam tebal, foam art apik. Kalau kamu pengunjung yang menilai bobot experience & estetika lebih dari harga, Draja oke banget. Tapi kalau kamu cari kopi murah dan praktis, mungkin ini bukan tempatnya. Personal opinion? Saya rasa worth it sekali untuk sekali-sekali treat diri sendiri.”',
                'location'   => 'Jl. Setiabudi No.45, Medan (dekat pusat belanja)',
                'gmap_url'   => 'https://maps.app.goo.gl/h5ZMvMmEifrNgk7dA',
                'place_name' => 'Draja Coffee Setiabudi',
                'user_id'    => 4,
                'namaFile' => ['draja.jpeg', 'draja2.jpg'],
                'hashtags' => [1, 2, 5]
            ],
            [
                'title'      => 'Cafe orang kaya, pemilik aventador pernah datang sini',
                'content'    => '“Thirtysix Multatuli Medan: mewah, eksklusif, dan kadang bikin iri. Rumah kopi plus dessert premium dengan sentuhan mewah: meja marmer, bronze art deco, kursi empuk, dan lighting dramatis. Banyak spot fotogenic, cocok buat feed Instagram. Mereka punya dessert special—lava cake premium, mille crepe, dan signature coffee cocktail. Kopi-nya diproses slow-brew dengan pilihan biji roaster internasional. Setelah saya ngobrol, ternyata pemilik Aventador dan deretan seleb pernah mampir—yang bikin tempat ini punya narasi elite. Harga? Bukan untuk dompet standar, minuman dan dessert berkisar Rp50-100 ribu. Tapi ambience dan rasa sedapnya sepadan. Kalau kamu sedang ingin treat diri, butuh tempat eksklusif dan tenang, ini pilihan top. Kalau untuk hangout biasa atau kopdar murah, lebih baik pilih yang lain.”',
                'location'   => 'Jl. Multatuli No.36, Medan',
                'gmap_url'   => 'https://maps.app.goo.gl/K7XByKnRvMhcs2jx8',
                'place_name' => 'Thirtysix Multatuli Medan',
                'user_id'    => 4,
                'namaFile' => ['thirtysix.jpeg', 'thirtysix2.jpg'],
                'hashtags' => [1, 2, 3, 4, 5]
            ],
            [
                'title'      => 'Kok Dagu? Kok...',
                'content'    => '“Kodagu Coffee Medan hadir sebagai spot kopi yang punya karakter kuat. Nama “Kodagu” mengacu ke pegunungan kopi di India—tanda bahwa mereka serius soal single-origin. Kamu bisa coba brew seperti V60, aeropress, atau cold brew. Rasanya cenderung bright, acidic ringan, dengan aroma buah dan floral. Mereka juga punya variant espresso dan kopi susu manis. Tempatnya cozy, dominasi sofa dan meja kayu, plus tanaman hijau yang bikin rasa adem. Harga kopi: Rp28-40 ribu, cukup ramah untuk kopi spesial. Ada juga pastry manis, cake, dan sandwich untuk teman ngopi. Baristanya informatif, berbicara tentang asal biji dan teknik seduh kalau ditanya. Sangat cocok buat kamu yang menghargai kualitas dan ingin belajar kopi lebih dalam. Plus: wifi stabil dan spot non-merokok nyaman untuk laptop atau baca buku.”',
                'location'   => 'Jl. Palang Merah No.22, Medan (daerah perumahan elite)',
                'gmap_url'   => 'https://maps.app.goo.gl/uHbnUdaUs9HUWjps9',
                'place_name' => 'Kodagu Coffee Medan',
                'user_id'    => 5,
                'namaFile' => ['kodagu.jpeg', 'kodagu2.jpeg'],
                'hashtags' => [1, 5, 9]
            ],
            [
                'title'      => 'Casu macam as*, murah banget',
                'content'    => '“Casu Caffee Medan ini dikenal memberikan value for money luar biasa. Kopinya enak—espresso dan kopi susu-nya punya body pas, tidak terlalu pahit, tidak terlalu manis. Penyajiannya cepat, cocok untuk kamu yang buru-buru pagi atau istirahat siang. Suasananya sederhana tapi bersih—meja plastik dan bangku kayu kecil, plus hiasan dinding mural ringan. Mereka juga menjual snack ringan, seperti risol, pisang goreng, dan pastel. Harga sangat terjangkau: Rp10-15 ribu per minuman dan Rp3-5 ribu per snack. Banyak pekerja kantoran dan mahasiswa mampir buat ngopi sambil istirahat singkat. Lokasinya strategis—dekat jalan besar dan transportasi umum. Kalau kamu cari kopi encer-enak tanpa harus tunaikan Syariah dompet, ini tempatnya.”',
                'location'   => '02, Jl. Sultan Agung No.8B, Petisah Tengah, Kota Medan, Sumatera Utara 20111',
                'gmap_url'   => 'https://maps.app.goo.gl/yfbekXwFxUT7zej67',
                'place_name' => 'Casu Grounds',
                'user_id'    => 5,
                'namaFile' => ['casu.jpeg', 'casu2.jpeg'],
                'hashtags' => [5, 1,9]
            ],
            [
                'title'      => 'Warung Pecel Underrated, Hanya Sultan yang datang',
                'content'    => 'Di tengah hutan kota terdapat lokasi penangkaran kupu-kupu dengan ratusan spesies indah. Cocok untuk edukasi dan fotografi.',
                'location'   => 'Jl. Ngumban Surbakti No.82A, Sempakata, Kec. Medan Selayang, Kota Medan, Sumatera Utara 20131',
                'gmap_url'   => 'https://maps.google.com/?q=Jl.+Hutan+Raya+No.5,+Medan',
                'place_name' => 'Warung Pecel Pohon Ceri',
                'user_id'    => 1,
                'namaFile'     => ['WPPC.jpeg', 'WPPC2.jpg'],
                'hashtags' => [1, 4, 5, 6]
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

            $kocak->tag()->attach($post['hashtags']);

            foreach ($post['namaFile'] as $namaFile) {
                PostAttachment::create([
                    'post_id' => $kocak->id,
                    'namafile' => $namaFile
                ]);
            }
        }
    }
}
