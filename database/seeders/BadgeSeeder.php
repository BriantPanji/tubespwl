<?php

namespace Database\Seeders;

use App\Models\Badge;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Badge::factory(5)->create();
        // $badges = Badge::factory()->count(3)->create();
        $badgesRaw = [
            [
                'badge_name' => 'Langkah Pertama',
                'badge_desc' => 'Untuk pengguna yang baru pertama kali membagikan tempat',
                'badge_color' => '#CC2B2B',
                'badge_icon' => 'langkah_pertama.png',
            ],
            [
                'badge_name' => 'Jejak Kota',
                'badge_desc' => 'Telah mengunjungi beberapa tempat rekomendasi',
                'badge_color' => '#8929D4',
                'badge_icon' => 'jejak_kota.png',
            ],
            [
                'badge_name' => 'Suara Jalanan',
                'badge_desc' => 'Aktif memberikan vote atau komentar pada tempat orang lain',
                'badge_color' => '#50752A',
                'badge_icon' => 'suara_jalanan.png',
            ],
            [
                'badge_name' => 'Pemburu Senyap',
                'badge_desc' => 'Menemukan tempat yang belum pernah dibagikan siapa pun',
                'badge_color' => '#2A7575',
                'badge_icon' => 'pemburu_senyap.png',
            ],
            [
                'badge_name' => 'Peluk Sudut Kota',
                'badge_desc' => 'Menambahkan tempat kecil yang jarang dilirik',
                'badge_color' => '#916334',
                'badge_icon' => 'peluk_sudut_kota.png',
            ],
            [
                'badge_name' => 'Lagu Kota',
                'badge_desc' => 'Aktif menulis cerita soal tempat secara naratif/puitis',
                'badge_color' => '#3A9A3A',
                'badge_icon' => 'lagu_kota.png',
            ],
            [
                'badge_name' => 'Mata Peka',
                'badge_desc' => 'Foto-foto yang dibagikan selalu estetik dan detail',
                'badge_color' => '#3982C3',
                'badge_icon' => 'mata_peka.png',
            ],
            [
                'badge_name' => 'Peta Hati',
                'badge_desc' => 'Sering menyimpan (wishlist) tempat dengan tema tertentu',
                'badge_color' => '#C535C5',
                'badge_icon' => 'peta_hati.png',
            ],
            [
                'badge_name' => 'Temu Tak Disangka',
                'badge_desc' => 'Upload tempat yang jadi viral padahal awalnya biasa saja',
                'badge_color' => '#29734E',
                'badge_icon' => 'temu_tak_disangka.png',
            ],
            [
                'badge_name' => 'Penjelajah Rasa I',
                'badge_desc' => 'Penghargaan untukmu karena sudah membuat 10 post',
                'badge_color' => '#FFC3DD',
                'badge_icon' => 'penjelajah_rasa_i.png',
            ],
            [
                'badge_name' => 'Penjelajah Rasa II',
                'badge_desc' => 'Penghargaan untukmu karena sudah membuat 25 post',
                'badge_color' => '#FF83C0',
                'badge_icon' => 'penjelajah_rasa_ii.png',
            ],
            [
                'badge_name' => 'Penjelajah Rasa III',
                'badge_desc' => 'Penghargaan untukmu karena sudah membuat 50 post',
                'badge_color' => '#FF00A7',
                'badge_icon' => 'penjelajah_rasa_iii.png',
            ],
        
            [
                'badge_name' => 'Suara Halus I',
                'badge_desc' => 'Penghargaan untukmu karena sudah membuat 10 komentar',
                'badge_color' => '#9FF75D',
                'badge_icon' => 'suara_halus_i.png',
            ],
            [
                'badge_name' => 'Suara Halus II',
                'badge_desc' => 'Penghargaan untukmu karena sudah membuat 25 komentar',
                'badge_color' => '#72D428',
                'badge_icon' => 'suara_halus_ii.png',
            ],
            [
                'badge_name' => 'Suara Halus III',
                'badge_desc' => 'Penghargaan untukmu karena sudah membuat 50 komentar',
                'badge_color' => '#56B80B',
                'badge_icon' => 'suara_halus_iii.png',
            ],
        
            [
                'badge_name' => 'Lensa Kota I',
                'badge_desc' => 'Penghargaan untukmu karena sudah mengirim 10 foto',
                'badge_color' => '#BABCFF',
                'badge_icon' => 'lensa_kota_i.png',
            ],
            [
                'badge_name' => 'Lensa Kota II',
                'badge_desc' => 'Penghargaan untukmu karena sudah mengirim 25 foto',
                'badge_color' => '#8C90FF',
                'badge_icon' => 'lensa_kota_ii.png',
            ],
            [
                'badge_name' => 'Lensa Kota III',
                'badge_desc' => 'Penghargaan untukmu karena sudah mengirim 50 foto',
                'badge_color' => '#5B62FF',
                'badge_icon' => 'lensa_kota_iii.png',
            ],
        
            [
                'badge_name' => 'Sentuh Rasa I',
                'badge_desc' => 'Penghargaan untukmu karena sudah melakukan 20 votingan',
                'badge_color' => '#00D247',
                'badge_icon' => 'sentuh_rasa_i.png',
            ],
            [
                'badge_name' => 'Sentuh Rasa II',
                'badge_desc' => 'Penghargaan untukmu karena sudah melakukan 50 votingan',
                'badge_color' => '#00A636',
                'badge_icon' => 'sentuh_rasa_ii.png',
            ],
            [
                'badge_name' => 'Sentuh Rasa III',
                'badge_desc' => 'Penghargaan untukmu karena sudah melakukan 100 votingan',
                'badge_color' => '#007D27',
                'badge_icon' => 'sentuh_rasa_iii.png',
            ],
        
            [
                'badge_name' => 'Cerita Jalan I',
                'badge_desc' => 'Penghargaan untukmu karena sudah membuat 5 komentar panjang',
                'badge_color' => '#D1B000',
                'badge_icon' => 'cerita_jalan_i.png',
            ],
            [
                'badge_name' => 'Cerita Jalan II',
                'badge_desc' => 'Penghargaan untukmu karena sudah membuat 10 komentar panjang',
                'badge_color' => '#A58B00',
                'badge_icon' => 'cerita_jalan_ii.png',
            ],
            [
                'badge_name' => 'Cerita Jalan III',
                'badge_desc' => 'Penghargaan untukmu karena sudah membuat 20 komentar panjang',
                'badge_color' => '#7B6700',
                'badge_icon' => 'cerita_jalan_iii.png',
            ],
        
        ];
        
        foreach ($badgesRaw as $badge) {
            Badge::create($badge);
        }

        $badges = Badge::all();
        $users = User::all();

        foreach ($users as $user) {
            $user->badges()->attach($badges->random(20));
        }
    }
}
