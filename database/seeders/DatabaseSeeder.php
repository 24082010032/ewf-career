<?php

namespace Database\Seeders;

use App\Models\Cabang;
use App\Models\Lamaran;
use App\Models\Lowongan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Password di-hash otomatis oleh cast 'hashed' di model User
        User::create([
            'name' => 'Arifuddin Afkar',
            'email' => 'yupigumy@gmail.com',
            'password' => 'admin123',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Rina Marlina',
            'email' => 'ddaimar949+hrd@gmail.com',
            'password' => 'hrd12345',
            'role' => 'hrd',
        ]);

        $pelamar = User::create([
            'name' => 'Damar Inam Prasetyo',
            'email' => 'ddaimar949+pelamar@gmail.com',
            'password' => 'pelamar123',
            'role' => 'pelamar',
        ]);

        // Kantor PT Equityworld Futures Surabaya
        $trillium = Cabang::create([
            'nama' => 'PT Equityworld Futures Surabaya',
            'kota' => 'Surabaya',
            'alamat' => 'Trillium Office & Residence, Jl. Pemuda No.108-116, Embong Kaliasin, Kec. Genteng, Kota Surabaya, Jawa Timur 60271',
            'telepon' => '(031) 60003788 / (031) 6000088',
            'jam_operasional' => 'Buka, tutup pukul 17.00',
            'url_peta' => 'https://www.google.com/maps/?cid=10975071663744044581',
        ]);

        $data = [
            ['EWF-SUB-FC-001',  'Financial Consultant',                  'karier', 'Keuangan & Investasi', 'Full Time', 'Konsultan finansial untuk klien korporat dan individual.',    'Min. 1 Thn',         30],
            ['EWF-SUB-BCA-001', 'Business Consultant Associate',         'karier', 'Business Development', 'Full Time', 'Mengembangkan kemitraan strategis dan edukasi investor.',     'Fresh Graduate',     45],
            ['EWF-SUB-CL-001',  'Compliance & Legal Officer',            'karier', 'Legal & Kepatuhan',    'Full Time', 'Kepatuhan regulasi Bappebti dan legal drafting.',            'Min. 2 Thn',         50],
            ['EWF-SUB-MM-001',  'Magang Digital Marketing & Komunikasi', 'magang', 'Pemasaran & Humas',    'Magang',    'Kampanye literasi finansial digital dan media sosial.',      'Mahasiswa Aktif',    20],
            ['EWF-SUB-MR-001',  'Magang Analis Riset Pasar Komoditas',   'magang', 'Keuangan & Investasi', 'Magang',    'Menyusun buletin harian komoditas emas, minyak, dan valas.', 'Mahasiswa Smst 5-7', 25],
        ];

        $lowongan = [];
        foreach ($data as [$kode, $judul, $kategori, $dept, $tipe, $desk, $exp, $hari]) {
            $lowongan[] = Lowongan::create([
                'kode_ref' => $kode,
                'judul' => $judul,
                'kategori' => $kategori,
                'departemen' => $dept,
                'tipe' => $tipe,
                'cabang_id' => $trillium->id,
                'deskripsi' => $desk,
                'min_pengalaman' => $exp,
                'batas_lamaran' => now()->addDays($hari)->toDateString(),
            ]);
        }

        // DATA CONTOH agar dasbor tidak kosong (hapus kalau formulir lamaran sudah jadi)
        Lamaran::create([
            'no_registrasi' => 'EWF-' . date('Y') . '-0001',
            'user_id' => $pelamar->id,
            'lowongan_id' => $lowongan[1]->id,   // Business Consultant Associate (karier)
            'cabang_pilihan_id' => $trillium->id,
            'status' => 'ditinjau',
        ]);
        Lamaran::create([
            'no_registrasi' => 'EWF-' . date('Y') . '-0002',
            'user_id' => $pelamar->id,
            'lowongan_id' => $lowongan[3]->id,   // Magang Digital Marketing (magang)
            'cabang_pilihan_id' => $trillium->id,
            'status' => 'menunggu',
        ]);
    }
}
