<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sop;
use App\Models\Bidang;

class SopSeeder extends Seeder
{
    public function run(): void
    {
        Sop::truncate();
        $pertanahan = Bidang::where('nama', 'Bidang Pertanahan')->first();
        $persampahan = Bidang::where('nama', 'Bidang Persampahan')->first();
        $penataan = Bidang::where('nama', 'Bidang Penataan dan Penegakan Hukum Lingkungan Hidup')->first();
        $laboratorium = Bidang::where('nama', 'Laboratorium Lingkungan Hidup')->first();

        Sop::create([
            'bidang_id' => $pertanahan->id,
            'judul' => 'SOP Pengadaan Tanah',
            'deskripsi' => 'Berikut adalah pertanyaan yang sering diajukan (FAQ) terkait SOP Pengadaan Tanah:',
            'slug' => 'pengadaan_tanah',
            'file' => '/sop/SOP_Pengadaan_Tanah.pdf' // otomatis sesuai slug

        ]);
        Sop::create([
            'bidang_id' => $pertanahan->id,
            'judul' => 'SOP Penyelesaian Sengketa Tanah',
            'deskripsi' => 'Prosedur penanganan dan penyelesaian sengketa tanah, mulai dari pengaduan, mediasi, hingga keputusan akhir.',
            'slug' => 'sengketa_tanah',
            'file' => '/sop/SOP_Penyelesaian_Sengketa_Tanah.pdf' // otomatis sesuai slug

        ]);
        Sop::create([
            'bidang_id' => $persampahan->id,
            'judul' => 'SOP Penanganan Limbah B3',
            'deskripsi' => 'Panduan aman penanganan, penyimpanan, dan pembuangan limbah bahan berbahaya dan beracun (B3).',
            'slug' => 'limbah_b3'
        ]);
        Sop::create([
            'bidang_id' => $penataan->id,
            'judul' => 'SOP Dalam Proses Penerimaan Pengaduan',
            'deskripsi' => 'Prosedur standar dalam menerima dan menindaklanjuti pengaduan terkait pelanggaran lingkungan hidup.',
            'slug' => 'penerimaan_pengaduan',
            'file' => '/sop/SOP_Pengaduan.pdf'
        ]);
        Sop::create([
            'bidang_id' => $penataan->id,
            'judul' => 'Penyusunan Dokumen AMDAL sesuai PP 22 Tahun 2021',
            'deskripsi' => 'Panduan penyusunan dokumen AMDAL sesuai Peraturan Pemerintah Nomor 22 Tahun 2021 tentang Penyelenggaraan Perlindungan dan Pengelolaan Lingkungan Hidup.',
            'slug' => 'amdal_pp22_2021',
            'file' => '/sop/SOP_Tahapan_Penyusunan_Dokumen_Lingkungan.pdf'
        ]);
        Sop::create([
            'bidang_id' => $penataan->id,
            'judul' => 'SOP Pengawasan Penaatan Perizinan dan Peraturan Perundang-undangan Pengelolaan Lingkungan Hidup',
            'deskripsi' => 'Prosedur pengawasan terhadap kepatuhan perizinan dan peraturan perundang-undangan di bidang pengelolaan lingkungan hidup.',
            'slug' => 'pengawasan_perizinan_lh',
            'file' => '/sop/SOP_Pengawasan.pdf'
        ]);
        Sop::create([
            'bidang_id' => $laboratorium->id,
            'judul' => 'Prosedur Pelaksanaan Pengujian Sampel',
            'deskripsi' => 'Langkah-langkah pelaksanaan pengujian sampel di laboratorium lingkungan hidup.',
            'slug' => 'pengujian_sampel',
            'file' => '/sop/SOP_Pengujian_Sampel.pdf'
        ]);
        Sop::create([
            'bidang_id' => $laboratorium->id,
            'judul' => 'Prosedur Pelaksanaan Penerimaan Sampel Air',
            'deskripsi' => 'Prosedur standar penerimaan sampel air untuk pengujian di laboratorium.',
            'slug' => 'penerimaan_sampel_air',
            'file' => '/sop/SOP_Penerimaan_Sampel_Air.pdf'
        ]);
        Sop::create([
            'bidang_id' => $laboratorium->id,
            'judul' => 'Prosedur Pelaksanaan Pembuatan dan Penyerahan LHU (Hardcopy)',
            'deskripsi' => 'Prosedur pembuatan dan penyerahan Laporan Hasil Uji (LHU) dalam bentuk hardcopy kepada pemohon.',
            'slug' => 'penyerahan_lhu',
            'file' => '/sop/SOP_Penyerahan_LHU.pdf'
        ]);
    }
} 