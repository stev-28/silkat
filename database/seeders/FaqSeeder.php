<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;
use App\Models\Sop;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        Faq::truncate();
        $sopPengadaan = Sop::where('slug', 'pengadaan_tanah')->first();
        $sopLimbah = Sop::where('slug', 'limbah_b3')->first();
        $sopSengketa = \App\Models\Sop::where('slug', 'sengketa_tanah')->first();
        $penataanPengaduan = \App\Models\Sop::where('slug', 'penerimaan_pengaduan')->first();
        $penataanAmdal = \App\Models\Sop::where('slug', 'amdal_pp22_2021')->first();
        $penataanPengawasan = \App\Models\Sop::where('slug', 'pengawasan_perizinan_lh')->first();
        $pengujianSampel = \App\Models\Sop::where('slug', 'pengujian_sampel')->first();
        $penerimaanSampelAir = \App\Models\Sop::where('slug', 'penerimaan_sampel_air')->first();
        $penyerahanLhu = \App\Models\Sop::where('slug', 'penyerahan_lhu')->first();

        Faq::create([
            'sop_id' => $sopPengadaan->id,
            'pertanyaan' => 'Siapa pihak yang menyerahkan dokumen perencanaan pengadaan tanah?',
            'jawaban' => 'Dokumen perencanaan pengadaan tanah diserahkan oleh Organisasi Perangkat Daerah (OPD) yang membutuhkan tanah.'
        ]);
        Faq::create([
            'sop_id' => $sopPengadaan->id,
            'pertanyaan' => 'Berapa lama waktu yang dibutuhkan untuk membentuk Tim Persiapan Pengadaan Tanah setelah dokumen diterima?',
            'jawaban' => 'Pembentukan Tim Persiapan Pengadaan Tanah memerlukan waktu 10 hari sejak diterimanya Dokumen Perencanaan Pengadaan Tanah (PPT).'
        ]);
        Faq::create([
            'sop_id' => $sopPengadaan->id,
            'pertanyaan' => 'Berapa lama waktu yang diberikan kepada Tim untuk melakukan Pemberitahuan Rencana Pembangunan?',
            'jawaban' => 'Tim diberi waktu 20 hari untuk melakukan Pemberitahuan Rencana Pembangunan.'
        ]);
        Faq::create([
            'sop_id' => $sopPengadaan->id,
            'pertanyaan' => 'Berapa durasi waktu untuk Konsultasi Publik?',
            'jawaban' => 'Durasi waktu untuk Konsultasi Publik adalah 60 hari.'
        ]);
        Faq::create([
            'sop_id' => $sopPengadaan->id,
            'pertanyaan' => 'Apa yang terjadi jika ada keberatan dalam Konsultasi Publik?',
            'jawaban' => 'Jika ada keberatan dalam Konsultasi Publik, maka akan diadakan konsultasi publik ulang selama 30 hari.'
        ]);
        Faq::create([
            'sop_id' => $sopPengadaan->id,
            'pertanyaan' => 'Berapa lama waktu yang dibutuhkan untuk menyiapkan Penetapan Lokasi?',
            'jawaban' => 'Penyiapan Penetapan Lokasi membutuhkan waktu 14 hari.'
        ]);
        Faq::create([
            'sop_id' => $sopPengadaan->id,
            'pertanyaan' => 'Siapa yang menjadi pihak utama yang terlibat dalam proses pengadaan tanah ini?',
            'jawaban' => 'Pihak yang terlibat meliputi OPD yang membutuhkan tanah, Bagian Umum, Kabid Pertanahan, Asisten I, dan Tim (Persiapan Pengadaan Tanah).'
        ]);

        Faq::create([
            'sop_id' => $sopSengketa->id,
            'pertanyaan' => 'Siapa yang dapat mengajukan pengaduan sengketa tanah?',
            'jawaban' => 'Pengaduan dapat diajukan oleh pengadu, baik instansi maupun masyarakat.'
        ]);
        Faq::create([
            'sop_id' => $sopSengketa->id,
            'pertanyaan' => 'Berapa lama waktu yang dibutuhkan untuk meneliti dan mengkaji pengaduan yang masuk?',
            'jawaban' => 'Waktu yang dibutuhkan adalah 12 hari.'
        ]);
        Faq::create([
            'sop_id' => $sopSengketa->id,
            'pertanyaan' => 'Dengan siapa Dinas berkoordinasi setelah menerima pengaduan?',
            'jawaban' => 'Dinas berkoordinasi dengan pihak desa/kelurahan serta distrik terkait untuk mendapatkan data dan hasil penanganan yang pernah dilakukan.'
        ]);
        Faq::create([
            'sop_id' => $sopSengketa->id,
            'pertanyaan' => 'Berapa lama durasi peninjauan/pengecekan lapangan?',
            'jawaban' => 'Durasi peninjauan/pengecekan lapangan adalah 30 hari, namun bisa bervariasi tergantung luasan dan kondisi areal/lahan.'
        ]);
        Faq::create([
            'sop_id' => $sopSengketa->id,
            'pertanyaan' => 'Apa tujuan rapat tim dengan pihak-pihak yang bersengketa?',
            'jawaban' => 'Tujuannya adalah untuk mencapai kesepakatan.'
        ]);
        Faq::create([
            'sop_id' => $sopSengketa->id,
            'pertanyaan' => 'Apakah musyawarah dengan pihak-pihak bersengketa bisa dilakukan lebih dari satu kali?',
            'jawaban' => 'Ya, rapat musyawarah bisa dilakukan berulang-ulang.'
        ]);
        Faq::create([
            'sop_id' => $sopSengketa->id,
            'pertanyaan' => 'Kepada siapa kesimpulan hasil akhir disampaikan sebagai laporan?',
            'jawaban' => 'Kesimpulan hasil akhir disampaikan kepada Gubernur, pihak-pihak yang berkonflik (sepakat atau tidak sepakat), serta instansi-instansi terkait.'
        ]);
            
        

        Faq::create([
            'sop_id' => $sopLimbah->id,
            'pertanyaan' => 'Apa itu limbah B3?',
            'jawaban' => 'Limbah B3 adalah limbah bahan berbahaya dan beracun yang memerlukan penanganan khusus.'
        ]);
        Faq::create([
            'sop_id' => $sopLimbah->id,
            'pertanyaan' => 'Apa saja jenis limbah B3?',
            'jawaban' => 'Jenis limbah B3 meliputi: 1) Limbah B3 beracun, 2) Limbah B3 berbahaya, 3) Limbah B3 beracun dan berbahaya, 4) Limbah B3 beracun dan berbahaya, 5) Limbah B3 beracun dan berbahaya.'
        ]);
        
        Faq::create([
            'sop_id' => $penataanPengaduan->id,
            'pertanyaan' => 'Apa saja langkah-langkah dalam menerima aduan secara langsung?',
            'jawaban' => 'Pengadu diterima dengan suasana nyaman, diberikan penjelasan cara pengisian formulir, dan dibantu jika diperlukan. Petugas memeriksa kelengkapan informasi. Jika belum lengkap, pengadu diminta melengkapi dalam 3 hari kerja. Setelah lengkap, aduan dicatat dalam buku register.'
        ]);
        Faq::create([
            'sop_id' => $penataanPengaduan->id,
            'pertanyaan' => 'Bagaimana prosedur jika aduan diterima secara tidak langsung?',
            'jawaban' => 'Aduan dapat diterima melalui telepon, faks, surat, email, website, atau media sosial. Petugas mencatat informasi, dan jika belum lengkap, pengadu diminta melengkapi dalam 3 hari kerja. Jika tidak dilengkapi, aduan tidak diregistrasi. Jika lengkap, aduan dicatat dan pengadu menerima tanda terima atau nomor register dalam 3 hari kerja.'
        ]);
        
        Faq::create([
            'sop_id' => $penataanPengaduan->id,
            'pertanyaan' => 'Apa saja informasi yang harus ada dalam formulir pengaduan?',
            'jawaban' => 'Formulir harus memuat: identitas pengadu, lokasi kejadian, dugaan sumber, waktu dan uraian kejadian, dampaknya, penyelesaian yang diinginkan, dan data tentang pengaduan sebelumnya ke instansi lain.'
        ]);
        
        Faq::create([
            'sop_id' => $penataanPengaduan->id,
            'pertanyaan' => 'Berapa lama waktu pengaduan harus dilengkapi?',
            'jawaban' => 'Pengadu diminta melengkapi informasi dalam waktu 3 hari kerja. Jika tidak lengkap dalam waktu tersebut, aduan tidak akan diregistrasi.'
        ]);
        
        Faq::create([
            'sop_id' => $penataanPengaduan->id,
            'pertanyaan' => 'Apa yang terjadi jika informasi pengadu tidak lengkap dalam waktu 3 hari?',
            'jawaban' => 'Aduan tidak akan diregistrasi dan pengadu diberitahu agar dapat mengajukan ulang setelah melengkapi informasi.'
        ]);
        
        Faq::create([
            'sop_id' => $penataanPengaduan->id,
            'pertanyaan' => 'Kapan pengadu mendapatkan nomor register atau tanda terima?',
            'jawaban' => 'Pengadu mendapatkan nomor register atau tanda terima paling lambat 3 hari kerja setelah aduan lengkap.'
        ]);
        
        Faq::create([
            'sop_id' => $penataanPengaduan->id,
            'pertanyaan' => 'Di mana saya bisa mendapatkan informasi lebih lanjut ?',
            'jawaban' => 'Hubungi narahubung Bidang Penataan Dan Penegakan Hukum Lingkungan Hidup'
        ]);
                
        Faq::create([
            'sop_id' => $penataanAmdal->id,
            'pertanyaan' => 'Apa saja tahapan utama dalam proses penyusunan dokumen lingkungan menurut PP 22 Tahun 2021?',
            'jawaban' => 'Tahapan utama meliputi pengajuan formulir kerangka acuan, penyusunan dan penilaian dokumen seperti ANDAL-RKL/RPL atau UKL-UPL, pemeriksaan administrasi dan substansi, pengumuman dan konsultasi publik, serta penerbitan surat keputusan kelayakan lingkungan'
        ]);
        Faq::create([
            'sop_id' => $penataanAmdal->id,
            'pertanyaan' => 'Apa perbedaan antara dokumen ANDAL-RKL/RPL dan UKL-UPL?',
            'jawaban' => 'ANDAL-RKL/RPL merupakan dokumen yang lebih lengkap dan komprehensif untuk kegiatan yang berpotensi besar dampak lingkungan, sementara UKL-UPL merupakan dokumen sederhana yang diterapkan untuk kegiatan dengan dampak rendah sampai sedang dan prosesnya lebih cepat melalui sistem informasi online'
        ]);
        Faq::create([
            'sop_id' => $penataanAmdal->id,
            'pertanyaan' => 'Bagaimana proses pemeriksaan dokumen dilakukan?',
            'jawaban' => 'Pemeriksaan meliputi evaluasi administrasi selama 10 hari kerja dan pemeriksaan substansi dokumen seperti ANDAL dan RKL-RPL selama 50 hari kerja. Untuk UKL-UPL, proses melalui sistem online juga memfasilitasi pengajuan dan penilaian formulir secara otomatis'
        ]);
        Faq::create([
            'sop_id' => $penataanAmdal->id,
            'pertanyaan' => 'Apa peran Sistem Informasi Amdalnet dalam proses ini?',
            'jawaban' => 'Sistem ini memfasilitasi proses pengajuan, pemeriksaan, dan persetujuan dokumen lingkungan secara online. Sistem otomatis membantu dalam penerbitan persetujuan lingkungan, termasuk persetujuan pernyataan kesanggupan pengelolaan lingkungan hidup dan memudahkan komunikasi antara pelaku usaha dan pemerintah'
        ]);
        Faq::create([
            'sop_id' => $penataanAmdal->id,
            'pertanyaan' => 'Siapa yang berperan dalam proses ini?',
            'jawaban' => 'Pemrakarsa kegiatan adalah Menteri, Gubernur, atau Bupati/Walikota. Tim Uji Kelayakan (TUK) juga terlibat dalam evaluasi dokumen, terutama untuk kegiatan yang memerlukan analisa mendalam seperti ANDAL-RKL/RPL'
        ]);
        Faq::create([
            'sop_id' => $penataanAmdal->id,
            'pertanyaan' => 'Apa langkah terakhir setelah dokumen lingkungan disetujui?',
            'jawaban' => 'Setelah dokumen dinyatakan layak, diterbitkan Surat Keputusan Kelayakan Lingkungan Hidup, yang menjadi prasyarat dalam perizinan usaha dan kegiatan tersebut'
        ]);
        Faq::create([
            'sop_id' => $penataanPengawasan->id,
            'pertanyaan' => 'Mengapa pengawasan lingkungan hidup perlu dilakukan?',
            'jawaban' => 'Pengawasan diperlukan untuk mengetahui tingkat ketaatan pelaku usaha dalam mengelola lingkungan sesuai ketentuan kewajiban dalam peraturan perundang-undangan dan perizinan lingkungan hidup. Hal ini juga untuk memastikan kelestarian fungsi lingkungan hidup terjaga.'
        ]);
        Faq::create([
            'sop_id' => $penataanPengawasan->id,
            'pertanyaan' => 'Siapa yang wajib melakukan pengawasan ini?',
            'jawaban' => 'Menteri, gubernur, dan bupati/walikota, sesuai dengan kewenangannya, wajib melakukan pengawasan terhadap ketaatan penanggung jawab usaha dan/atau kegiatan atas ketentuan yang ditetapkan dengan peraturan perundang-undangan di bidang perlindungan dan pengelolaan lingkungan hidup.'
        ]);
        Faq::create([
            'sop_id' => $penataanPengawasan->id,
            'pertanyaan' => 'Apa saja yang menjadi lingkup pengawasan penaatan?',
            'jawaban' => 'Lingkup pengawasan penaatan yang dilaksanakan oleh Pejabat Pengawas Lingkungan Hidup terdiri atas: aspek peraturan perundang-undangan (Undang-Undang, Peraturan Pemerintah, Peraturan dan Keputusan Menteri Lingkungan Hidup dan Kehutanan, Peraturan Daerah atau Keputusan Kepala Daerah yang terkait), aspek perizinan lingkungan hidup (Izin Lingkungan, Izin Perlindungan dan Pengelolaan Lingkungan Hidup), serta aspek perizinan sektor terkait yang menunjang pengelolaan lingkungan hidup (perizinan kehutanan, perkebunan, pertambangan).'
        ]);
        Faq::create([
            'sop_id' => $penataanPengawasan->id,
            'pertanyaan' => 'Apa yang harus dilakukan pengawas jika ditolak saat akan melakukan pengawasan di lokasi usaha?',
            'jawaban' => 'Jika usaha dan/atau kegiatan menolak kehadiran pengawas lingkungan hidup, maka perlu dilakukan diplomasi agar pengawas dapat melakukan pengawasan. Apabila pihak usaha dan/atau kegiatan tetap menolak, maka langkah selanjutnya adalah membuat Berita Acara Penolakan Pengawasan yang ditandatangani oleh perwakilan manajemen usaha dan/atau kegiatan. Jika menolak menandatangani, diusahakan merekam suara atau mengambil gambar/foto/video pihak yang menolak.'
        ]);
        Faq::create([
            'sop_id' => $penataanPengawasan->id,
            'pertanyaan' => 'Apa yang tidak boleh dilakukan pengawas saat pertemuan penutup?',
            'jawaban' => 'Pengawas dilarang mendiskusikan status penaatan Usaha dan/atau Kegiatan terhadap dampak yuridis atau dampak penegakan hukum; memberikan interpretasi yang sifatnya bimbingan teknis; menyarankan solusi teknis (misal: proses pengolahan limbah yang harus dibangun, jenis peralatan, atau perubahan proses); merekomendasikan penggunaan jasa konsultan atau produk tertentu; memberikan informasi rancangan khusus atau desain teknis pengolahan limbah yang benar; atau memberikan informasi yang dapat diklasifikasikan sebagai informasi bisnis yang rahasia.'
        ]);
        Faq::create([
            'sop_id' => $penataanPengawasan->id,
            'pertanyaan' => 'Kapan penghentian pelanggaran tertentu (penyegelan) dapat dilakukan?',
            'jawaban' => 'Pengawas Lingkungan Hidup memiliki kewenangan untuk menghentikan pelanggaran tertentu apabila ditemukan pelanggaran lingkungan atau menimbulkan pencemaran lingkungan. Contohnya adalah bypass air limbah (air limbah yang dibuang langsung ke lingkungan tanpa diolah) atau penimbunan Limbah B3 tanpa izin.'
        ]);
        Faq::create([
            'sop_id' => $penataanPengawasan->id,
            'pertanyaan' => 'Bagaimana laporan pengawasan harus disusun?',
            'jawaban' => 'Laporan pengawasan harus disusun berdasarkan fakta dan temuan di lapangan , disajikan secara jelas dan sistematis , harus akurat, aktual dan faktual , relevan , obyektif tanpa konklusi atau asumsi pribadi , dan mudah dimengerti. Laporan juga harus melakukan analisis yuridis, memberikan kesimpulan (taat/tidak taat), dan menyarankan rekomendasi atau langkah-langkah perbaikan.'
        ]);

        // FAQ Prosedur Pelaksanaan Pengujian Sampel
        Faq::create([
            'sop_id' => $pengujianSampel->id,
            'pertanyaan' => 'Apa langkah-langkah utama dalam melakukan pengujian sampel di laboratorium?',
            'jawaban' => 'Pengujian sampel dilakukan dengan mengikuti prosedur yang meliputi persiapan alat dan bahan, analisis sesuai parameter yang diuji, dan verifikasi hasil pengujian untuk memastikan keakuratan sesuai standar.'
        ]);
        Faq::create([
            'sop_id' => $pengujianSampel->id,
            'pertanyaan' => 'Berapa lama waktu yang dibutuhkan untuk pengujian sampel air?',
            'jawaban' => 'Waktu pengujian biasanya memakan waktu sekitar 2 hari, tergantung parameter yang diuji dan kesiapan alat serta bahan.'

        ]);
        Faq::create([
            'sop_id' => $pengujianSampel->id,
            'pertanyaan' => 'Apakah pengujian dilakukan sesuai standar tertentu?',
            'jawaban' => 'Ya, pengujian dilakukan sesuai dengan Standar Operasional Prosedur (SOP) dan mengikuti pedoman IKM dan IKA untuk memastikan hasil yang valid dan akurat.'
       
        ]);

        // FAQ Prosedur Pelaksanaan Penerimaan Sampel Air
        Faq::create([
            'sop_id' => $penerimaanSampelAir->id,
            'pertanyaan' => 'Bagaimana proses penerimaan sampel air di laboratorium?',
            'jawaban' => 'Petugas pelayanan menerima sampel, memverifikasi sampel, kemudian mengisi formulir permintaan pengujian serta memberikan nomor atau kode sampel sebagai identifikasi.'
        ]);
        Faq::create([
            'sop_id' => $penerimaanSampelAir->id,
            'pertanyaan' => 'Berapa lama waktu verifikasi sampel berlangsung?',
            'jawaban' => 'Verifikasi sampel dilakukan selama kurang lebih 45 menit, tergantung lokasi sampel dan apakah sampel memenuhi syarat untuk pengujian.'
        ]);
        Faq::create([
            'sop_id' => $penerimaanSampelAir->id,
            'pertanyaan' => 'Apa yang dilakukan setelah sampel diverifikasi?',
            'jawaban' => 'Setelah diverifikasi, sampel siap untuk proses pengujian dan diteruskan ke tahap analisis sesuai prosedur.'
        ]);
      
        // FAQ Prosedur Pelaksanaan Pembuatan dan Penyerahan LHU (Hardcopy)
        Faq::create([
            'sop_id' => $penyerahanLhu->id,
            'pertanyaan' => 'Apa itu LHU?',
            'jawaban' => 'LHU adalah Laporan Hasil Uji, yaitu dokumen resmi hasil pengujian sampel yang diterbitkan oleh laboratorium.'
        ]);
        Faq::create([
            'sop_id' => $penyerahanLhu->id,
            'pertanyaan' => 'Bagaimana proses pembuatan dan penyerahan LHU?',
            'jawaban' => 'Setelah hasil pengujian selesai dan divalidasi, LHU dicetak, ditandatangani pejabat berwenang, dan diserahkan kepada pemohon secara langsung atau melalui pos.'
        ]);
        Faq::create([
            'sop_id' => $penyerahanLhu->id,
            'pertanyaan' => 'Bagaimana proses pembuatan Laporan Hasil Uji (LHU)?',
            'jawaban' => 'Analis melakukan pengujian, kemudian memverifikasi data hasil pengujian tersebut, dan menyiapkan LHU dalam bentuk hardcopy sesuai prosedur yang berlaku..'
        ]);

        Faq::create([
            'sop_id' => $penyerahanLhu->id,
            'pertanyaan' => 'Bagaimana proses penyerahan LHU kepada pelanggan? ',
            'jawaban' => 'LHU diserahkan oleh petugas layanan dengan menandatangani dan menyerahkan dokumen kepada pelanggan, kemudian LHU tersebut diarsipkan sesuai prosedur.'
        ]);

        Faq::create([
            'sop_id' => $penyerahanLhu->id,
            'pertanyaan' => 'Berapa lama waktu yang dibutuhkan untuk membuat dan menyerahkan LHU?',
            'jawaban' => 'Waktu pembuatan LHU tergantung pada proses verifikasi dan administrasi, namun biasanya dilakukan segera setelah pengujian selesai dan hasil diverifikasi.'
        ]);

        Faq::create([
            'sop_id' => $penyerahanLhu->id,
            'pertanyaan' => 'Di mana saya bisa mendapatkan informasi lebih lanjut?',
            'jawaban' => 'Hubungi narahubung Laboratorium Lingkungan Hidup.'
        ]);
    }
} 