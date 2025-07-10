<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bidang;

class BidangSeeder extends Seeder
{
    public function run(): void
    {
        Bidang::truncate();
        Bidang::create([
            'nama' => 'Bidang Pertanahan',
            'rangkuman' => 'Bidang Pertanahan bertugas melaksanakan perumusan dan pelaksanaan kebijakan di bidang pengadaan tanah, penataan, pendaftaran, serta penyelesaian sengketa tanah di wilayah Papua Barat.'
        ]);
        Bidang::create([
            'nama' => 'Bidang Persampahan',
            'rangkuman' => 'Bidang Persampahan, B3 dan Peningkatan Kapasitas Lingkungan Hidup fokus pada pengelolaan limbah, sampah, dan peningkatan kapasitas masyarakat.'
        ]);
        Bidang::create([
            'nama' => 'Bidang Penataan dan Penegakan Hukum Lingkungan Hidup',
            'rangkuman' => 'Bidang ini menangani penataan ruang dan penegakan hukum di bidang lingkungan hidup.'
        ]);
        Bidang::create([
            'nama' => 'Bidang Pengendalian Pencemaran dan Kerusakan Lingkungan Hidup',
            'rangkuman' => 'Bidang ini bertugas mengendalikan pencemaran dan kerusakan lingkungan hidup.'
        ]);
        Bidang::create([
            'nama' => 'Laboratorium Lingkungan Hidup',
            'rangkuman' => 'Laboratorium Lingkungan Hidup menyediakan layanan pengujian dan analisis kualitas lingkungan.'
        ]);
        Bidang::create([
            'nama' => 'Umum',
            'rangkuman' => 'Bidang Umum mendukung administrasi dan layanan umum dinas.'
        ]);
    }
} 