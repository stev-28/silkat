<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SILKAT - Dinas Lingkungan Hidup dan Pertanahan</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Phosphor Icons for rich icons (e.g., document, question, chat) -->
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1/dist/phosphor.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0fdf4; /* Light green background */
        }
        /* Custom scrollbar for better aesthetics */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f0fdf4;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #81C784;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #66BB6A;
        }
        .tab-button.active {
            border-bottom: 3px solid #10B981; /* Emerald green for active tab */
            color: #10B981;
            font-weight: 600;
        }
        /* Loading indicator styles */
        .loading-dots {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20px;
        }
        .loading-dots span {
            width: 8px;
            height: 8px;
            margin: 0 4px;
            background-color: #4CAF50;
            border-radius: 50%;
            animation: bounce 1.4s infinite ease-in-out both;
        }
        .loading-dots span:nth-child(1) { animation-delay: -0.32s; }
        .loading-dots span:nth-child(2) { animation-delay: -0.16s; }
        .loading-dots span:nth-child(3) { animation-delay: 0s; }

        @keyframes bounce {
            0%, 80%, 100% { transform: scale(0); }
            40% { transform: scale(1); }
        }

        /* Styles for AI response formatting (lists, paragraphs) */
        #qa-history ul, #qa-history ol {
            margin-left: 1.5rem;
            list-style-position: outside;
        }
        #qa-history ul {
            list-style-type: disc;
        }
        #qa-history ol {
            list-style-type: decimal;
        }
        #qa-history li {
            margin-bottom: 0.5rem;
        }
        #qa-history p {
            margin-bottom: 0.75rem;
        }
        /* Gallery specific styles */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
        }
        .gallery-item {
            cursor: pointer; /* Indicate clickable */
        }
        .gallery-item img {
            width: 100%;
            height: 150px; /* Fixed height for consistency */
            object-fit: cover; /* Crop to fit, maintain aspect ratio */
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }
        .gallery-item img:hover {
            transform: scale(1.03);
        }

        /* Modal specific styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal-content {
            background: white;
            padding: 1.5rem;
            border-radius: 0.75rem;
            max-width: 90%;
            max-height: 90%;
            overflow-y: auto;
            position: relative;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .modal-content img {
            max-width: 100%;
            height: auto;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }
        .modal-close-button {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #333;
            padding: 0.5rem;
            border-radius: 50%;
            transition: background-color 0.2s;
        }
        .modal-close-button:hover {
            background-color: #eee;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-4">

    <!-- Header - Moved outside and above the main container -->
    <header class="w-full text-center py-6 md:py-8 px-4 bg-gradient-to-b from-green-50 to-white shadow-md rounded-b-lg">
        <div class="max-w-screen-xl mx-auto flex flex-col items-center">
            <img src="/images/pabar.png" alt="Logo Dinas" class="h-20 w-20 rounded-full mb-4 shadow-lg">
            <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-800 mb-1">DINAS LINGKUNGAN HIDUP DAN PERTANAHAN</h1>
            <p class="text-lg sm:text-xl md:text-2xl text-gray-600">PROVINSI PAPUA BARAT</p>
            <p class="text-sm sm:text-base text-gray-500 mt-2">Jl. Brigjen (Purn) Abraham O Atururi Kompleks Perkantoran Gubernur Arfai</p>
        </div>
    </header>

    <!-- Main Container -->
    <div class="bg-white rounded-lg shadow-2xl p-6 md:p-8 w-full max-w-screen-xl flex flex-col md:flex-row gap-6 mt-6 md:mt-10">

        <!-- Left Section - SILKAT Title & Navigation Cards -->
        <div class="w-full md:w-1/3 lg:w-1/4 flex flex-col items-center text-center p-4 md:p-6 bg-green-50 rounded-lg shadow-md">
            <h2 class="text-4xl lg:text-5xl font-extrabold text-green-800 mb-2">SILKAT</h2>
            <p class="text-lg lg:text-xl text-green-700 mb-8">Layanan Kantor Terpadu</p>

            <nav class="grid grid-cols-2 gap-4 w-full">
                <!-- SOP Layanan Card -->
                <button id="nav-sop" class="nav-card bg-gradient-to-br from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white p-4 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 ease-in-out flex flex-col items-center justify-center">
                    <i class="ph ph-file-text text-4xl mb-2"></i>
                    <span class="text-sm font-medium">SOP Layanan</span>
                </button>

                <!-- Tanya Jawab Card -->
                <button id="nav-qa" class="nav-card bg-gradient-to-br from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white p-4 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 ease-in-out flex flex-col items-center justify-center">
                    <i class="ph ph-question text-4xl mb-2"></i>
                    <span class="text-sm font-medium">Tanya Jawab</span>
                </button>

                <!-- Profil Dinas Card -->
                <button id="nav-profil-dinas" class="nav-card bg-gradient-to-br from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white p-4 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 ease-in-out flex flex-col items-center justify-center">
                    <i class="ph ph-buildings text-4xl mb-2"></i>
                    <span class="text-sm font-medium">Profil Dinas</span>
                </button>

                <!-- Pengumuman Card -->
                <button id="nav-pengumuman" class="nav-card bg-gradient-to-br from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white p-4 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-300 ease-in-out flex flex-col items-center justify-center">
                    <i class="ph ph-megaphone-simple text-4xl mb-2"></i>
                    <span class="text-sm font-medium">Pengumuman</span>
                </button>

                <!-- Galeri Card -->
                <button id="nav-galeri" class="nav-card bg-gradient-to-br from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white p-4 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 ease-in-out flex flex-col items-center justify-center">
                    <i class="ph ph-image-square text-4xl mb-2"></i>
                    <span class="text-sm font-medium">Galeri</span>
                </button>
            </nav>
        </div>

        <!-- Right Section - Dynamic Content Area (SOP Viewer / Q&A) -->
        <div class="w-full md:w-2/3 lg:w-3/4 bg-gray-50 rounded-lg shadow-lg p-4 md:p-6 overflow-hidden">
            <!-- Dynamic Header for the right content panel -->
            <div id="right-panel-header" class="flex flex-col">
                <!-- Tabs for SOP and Q&A (initially visible, hidden when other content is active) -->
                <div id="tabs-container" class="flex border-b border-gray-300 mb-4">
                    <button id="tab-sop-btn" class="tab-button flex-1 text-center py-3 text-gray-700 text-lg md:text-xl transition-colors duration-200 ease-in-out active rounded-t-lg">
                        <i class="ph ph-file-text inline-block mr-2"></i> SOP Layanan
                    </button>
                    <button id="tab-qa-btn" class="tab-button flex-1 text-center py-3 text-gray-700 text-lg md:text-xl transition-colors duration-200 ease-in-out rounded-t-lg">
                        <i class="ph ph-question inline-block mr-2"></i> Tanya Jawab Layanan
                    </button>
                </div>
                <!-- Dynamic Headline for Profil Dinas/Pengumuman/Galeri (initially hidden) -->
                <div id="dynamic-headline-container" class="hidden text-center py-3 text-gray-700 text-lg md:text-xl font-semibold mb-4 border-b border-gray-300">
                    <h3 id="dynamic-headline-text"></h3>
                </div>
            </div>

            <!-- SOP Layanan Content -->
            <div id="sop-content" class="main-content-panel h-[calc(100%-4rem)] overflow-y-auto">
                <div class="mb-4">
                    <input type="text" id="sop-search" placeholder="Cari SOP..." class="w-full p-3 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                </div>

                <div class="flex flex-col md:flex-row gap-4">
                    <!-- SOP Categories (Divisions) -->
                    <div class="md:w-1/2 lg:w-2/5 bg-white p-4 rounded-lg shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Pilih Bidang</h3>
                        <div class="space-y-2">
                            <!-- Dropdown for mobile view (hidden on larger screens) -->
                            <select id="sop-unit-select" class="block md:hidden w-full p-2 border border-gray-300 rounded-lg bg-white">
                                <option value="all">Semua Bidang</option>
                                <option value="bidang-pertanahan">Bidang Pertanahan</option>
                                <option value="bidang-persampahan">Bidang Persampahan, B3 Dan Peningkatan Kapasitas Lingkungan Hidup</option>
                                <option value="bidang-penataan-penegakan">Bidang Penataan Dan Penegakan Hukum Lingkungan Hidup</option>
                                <option value="bidang-pengendalian-pencemaran">Bidang Pengendalian Pencemaran Dan Kerusakan Lingkungan Hidup</option>
                                <option value="laboratorium-lingkungan">Laboratorium Lingkungan Hidup</option>
                                <option value="umum-bidang">Umum</option>
                            </select>

                            <!-- Desktop/Tablet view of categories -->
                            <div class="hidden md:block">
                                <div class="sop-category cursor-pointer p-2 rounded-md hover:bg-green-100 flex items-center text-gray-700 font-medium" data-category="bidang-pertanahan">
                                    <i class="ph ph-map-pin text-xl mr-2"></i>Bidang Pertanahan
                                </div>
                                <ul class="ml-8 text-sm text-gray-600 sop-list" data-category="bidang-pertanahan">
                                    <li class="py-1 flex items-center cursor-pointer hover:text-green-700" data-sop-id="sertifikat"><i class="ph ph-file-text text-base mr-2"></i>Penerbitan Sertifikat Tanah</li>
                                    <li class="py-1 flex items-center cursor-pointer hover:text-green-700" data-sop-id="izin"><i class="ph ph-file-text text-base mr-2"></i>Izin Penggunaan Lahan</li>
                                </ul>
                                <div class="sop-category cursor-pointer p-2 rounded-md hover:bg-green-100 flex items-center text-gray-700 font-medium" data-category="bidang-persampahan">
                                    <i class="ph ph-trash text-xl mr-2"></i>Bidang Persampahan, B3 Dan Peningkatan Kapasitas Lingkungan Hidup
                                </div>
                                <ul class="ml-8 text-sm text-gray-600 sop-list" data-category="bidang-persampahan">
                                    <li class="py-1 flex items-center cursor-pointer hover:text-green-700" data-sop-id="limbah"><i class="ph ph-file-text text-base mr-2"></i>Penanganan Limbah B3</li>
                                </ul>
                                <div class="sop-category cursor-pointer p-2 rounded-md hover:bg-green-100 flex items-center text-gray-700 font-medium" data-category="bidang-penataan-penegakan">
                                    <i class="ph ph-law text-xl mr-2"></i>Bidang Penataan Dan Penegakan Hukum Lingkungan Hidup
                                </div>
                                <ul class="ml-8 text-sm text-gray-600 sop-list" data-category="bidang-penataan-penegakan">
                                    <!-- Add SOPs relevant to this new category if any -->
                                </ul>
                                <div class="sop-category cursor-pointer p-2 rounded-md hover:bg-green-100 flex items-center text-gray-700 font-medium" data-category="bidang-pengendalian-pencemaran">
                                    <i class="ph ph-cloud-arrow-down text-xl mr-2"></i>Bidang Pengendalian Pencemaran Dan Kerusakan Lingkungan Hidup
                                </div>
                                <ul class="ml-8 text-sm text-gray-600 sop-list" data-category="bidang-pengendalian-pencemaran">
                                    <li class="py-1 flex items-center cursor-pointer hover:text-green-700" data-sop-id="amdal"><i class="ph ph-file-text text-base mr-2"></i>Prosedur AMDAL</li>
                                </ul>
                                <div class="sop-category cursor-pointer p-2 rounded-md hover:bg-green-100 flex items-center text-gray-700 font-medium" data-category="laboratorium-lingkungan">
                                    <i class="ph ph-flask text-xl mr-2"></i>Laboratorium Lingkungan Hidup
                                </div>
                                <ul class="ml-8 text-sm text-gray-600 sop-list" data-category="laboratorium-lingkungan">
                                    <!-- Add SOPs relevant to this new category if any -->
                                </ul>
                                <div class="sop-category cursor-pointer p-2 rounded-md hover:bg-green-100 flex items-center text-gray-700 font-medium" data-category="umum-bidang">
                                    <i class="ph ph-building text-xl mr-2"></i>Umum
                                </div>
                                <ul class="ml-8 text-sm text-gray-600 sop-list" data-category="umum-bidang">
                                    <li class="py-1 flex items-center cursor-pointer hover:text-green-700" data-sop-id="cuti"><i class="ph ph-file-text text-base mr-2"></i>Permintaan Cuti</li>
                                    <li class="py-1 flex items-center cursor-pointer hover:text-green-700" data-sop-id="mutasi"><i class="ph ph-file-text text-base mr-2"></i>Mutasi Pegawai</li>
                                    <li class="py-1 flex items-center cursor-pointer hover:text-green-700" data-sop-id="dana"><i class="ph ph-file-text text-base mr-2"></i>Permintaan Dana</li>
                                    <li class="py-1 flex items-center cursor-pointer hover:text-green-700" data-sop-id="dinas"><i class="ph ph-file-text text-base mr-2"></i>Laporan Perjalanan Dinas</li>
                                    <li class="py-1 flex items-center cursor-pointer hover:text-green-700" data-sop-id="atk"><i class="ph ph-file-text text-base mr-2"></i>Permintaan ATK</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- SOP Content Display -->
                    <div class="md:w-1/2 lg:w-3/5 bg-white p-4 rounded-lg shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Detail SOP</h3>
                        <div id="sop-detail-content" class="text-gray-700 text-sm h-full flex flex-col justify-center items-center">
                            <p class="text-center text-gray-500">Pilih SOP dari daftar di samping untuk melihat detailnya.</p>
                            <!-- Placeholder for PDF viewer or download buttons -->
                            <div id="sop-actions" class="mt-4 hidden">
                                <a id="sop-view-btn" href="#" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg shadow-md hover:bg-green-600 transition-colors duration-200 mr-2">
                                    <i class="ph ph-eye text-lg mr-2"></i>Lihat SOP
                                </a>
                                <a id="sop-download-btn" href="#" download class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-lg shadow-md hover:bg-gray-300 transition-colors duration-200">
                                    <i class="ph ph-download-simple text-lg mr-2"></i>Unduh SOP
                                </a>
                            </div>
                            <!-- New WhatsApp button for SOP detail -->
                            <div id="sop-whatsapp-action" class="mt-4 hidden">
                                <a id="sop-whatsapp-btn" href="#" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg shadow-md hover:bg-green-600 transition-colors duration-200">
                                    <i class="ph ph-whatsapp-logo text-lg mr-2"></i>Hubungi Bidang ini via WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tanya Jawab Layanan Content -->
            <div id="qa-content" class="main-content-panel h-[calc(100%-4rem)] overflow-y-auto hidden">
                <div class="mb-4">
                    <label for="qa-unit-select" class="block text-sm font-medium text-gray-700 mb-1">Pilih Bidang</label>
                    <select id="qa-unit-select" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                        <option value="">Pilih Bidang</option>
                        <option value="bidang-pertanahan">Bidang Pertanahan</option>
                        <option value="bidang-penataan-penegakan">Bidang Penataan Dan Penegakan Hukum Lingkungan Hidup</option>
                        <option value="bidang-persampahan">Bidang Persampahan, B3 Dan Peningkatan Kapasitas Lingkungan Hidup</option>
                        <option value="bidang-pengendalian-pencemaran">Bidang Pengendalian Pencemaran Dan Kerusakan Lingkungan Hidup</option>
                        <option value="laboratorium-lingkungan">Laboratorium Lingkungan Hidup</option>
                        <option value="umum-bidang">Umum</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="qa-question-text" class="block text-sm font-medium text-gray-700 mb-1">Ketik Pertanyaan Anda di sini...</label>
                    <textarea id="qa-question-text" rows="4" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 transition-all duration-200 resize-y" placeholder="Contoh: Bagaimana mengajukan cuti?"></textarea>
                </div>
                <button id="send-question-btn" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold p-3 rounded-lg shadow-md transform hover:scale-[1.01] transition-transform duration-200 ease-in-out">
                    Kirim Pertanyaan
                </button>

                <div id="qa-response-area" class="mt-8">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Riwayat Tanya Jawab</h3>
                        <button id="clear-qa-history-btn" class="text-sm text-red-600 hover:text-red-800 font-medium px-3 py-1 rounded-lg bg-red-50 hover:bg-red-100 transition-colors duration-200">
                            <i class="ph ph-trash text-lg mr-1"></i> Hapus Riwayat
                        </button>
                    </div>
                    <div id="qa-history" class="space-y-4 max-h-96 overflow-y-auto p-2 rounded-lg bg-gray-100">
                        <!-- Responses will be appended here -->
                    </div>
                    <div id="qa-loading-indicator" class="hidden loading-dots mt-4">
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                    </div>
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Hubungi Narahubung Bidang</h3>
                        <div id="contact-person-info" class="space-y-2 bg-white p-4 rounded-lg shadow-sm">
                            <p class="text-center text-gray-500">Pilih bidang di atas untuk melihat narahubung terkait.</p>
                            <!-- Contact person details and WhatsApp button will be displayed here dynamically -->
                            <div id="qr-code-section-for-qa" class="flex flex-col items-center mt-4 hidden">
                                <p class="text-sm text-gray-600 mb-2">Scan QR code ini untuk terhubung di WA</p>
                                <img id="whatsapp-qr-code-for-qa" src="" alt="WhatsApp QR Code" class="w-32 h-32 border border-gray-300 rounded-lg p-1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profil Dinas Content -->
            <div id="profil-dinas-content" class="main-content-panel h-[calc(100%-4rem)] overflow-y-auto hidden p-4">
                <div class="bg-white p-4 rounded-lg shadow-sm">
                    <!-- Bagian Judul Profil Dinas (tetap di sini, dan sekarang rata tengah) -->
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center">Profil Dinas Lingkungan Hidup dan Pertanahan Provinsi Papua Barat</h3>
                    
                    <!-- Governor and Vice Governor photos (top-centered on small screens, side-by-side on large) -->
                    <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mb-6">
                        <div class="text-center w-full sm:w-1/2 flex-shrink-0 px-2">
                            <img src="/images/gub.png" alt="Foto Gubernur" class="rounded-lg shadow-md mb-2 mx-auto h-44 w-36 object-cover">
                            <p class="text-sm font-semibold text-gray-800 leading-tight break-words">Drs.Dominggus Mandacan,M.Si </p>
                            <p class="text-xs text-gray-600 leading-tight break-words">Gubernur Papua Barat</p>
                        </div>
                        <div class="text-center w-full sm:w-1/2 flex-shrink-0 px-2">
                            <img src="/images/wagub.png"  alt="Foto Wakil Gubernur" class="rounded-lg shadow-md mb-2 mx-auto h-44 w-36 object-cover">
                            <p class="text-sm font-semibold text-gray-800 leading-tight break-words">Mohamad Lakotani,SH.,M.Si</p>
                            <p class="text-xs text-gray-600 leading-tight break-words">Wakil Gubernur Papua Barat</p>
                        </div>
                    </div>

                    <!-- Main profile text content (initial paragraph, Visi, Misi, Tugas Pokok) -->
                    <div class="text-gray-700 text-justify">
                        <p class="mb-4">
                            Dinas Lingkungan Hidup dan Pertanahan Provinsi Papua Barat adalah garda terdepan pemerintah daerah dalam mewujudkan pembangunan berkelanjutan di Tanah Papua Barat. Dibentuk berdasarkan Peraturan Daerah Provinsi Papua Barat Nomor 7 Tahun 2016 tentang Pembentukan dan Susunan Perangkat Daerah , serta diperkuat dengan Peraturan Gubernur Papua Barat Nomor 32 Tahun 2018 tentang Uraian Tugas dan Fungsi Dinas Lingkungan Hidup dan Pertanahan, dinas ini mengemban amanah besar untuk menjaga kelestarian lingkungan hidup dan menata kelola pertanahan demi masa depan yang lebih baik. Kami berkomitmen untuk menciptakan keseimbangan harmonis antara pembangunan ekonomi, keadilan sosial, dan perlindungan lingkungan, memastikan bahwa kekayaan alam Papua Barat dapat dinikmati oleh generasi sekarang dan yang akan datang.
                        </p>
                        <h4 class="text-md font-semibold text-gray-800 mb-2">Visi:</h4>
                        <p class="mb-4">"Mewujudkan Urusan Pengelolaan Lingkungan Hidup dan Sumber Daya Alam Yang Berkeadilan dan berkelanjutan."</p>
                        <h4 class="text-md font-semibold text-gray-800 mb-2">Misi:</h4>
                        <ul class="list-disc list-inside mb-4">
                            <li>Melaksanakan perumusan kebijakan teknis di bidang lingkungan hidup dan pertanahan.</li>
                            <li>Melakukan koordinasi dan sinkronisasi program lingkungan hidup dan pertanahan.</li>
                            <li>Melaksanakan pembinaan, pengawasan, dan pengendalian terhadap pelaksanaan kebijakan di bidang lingkungan hidup dan pertanahan.</li>
                            <li>Meningkatkan kapasitas sumber daya manusia dan kelembagaan dalam pengelolaan lingkungan hidup dan pertanahan.</li>
                            <li>Meningkatkan partisipasi masyarakat dalam perlindungan dan pengelolaan lingkungan hidup serta penataan pertanahan.</li>
                        </ul>
                        <h4 class="text-md font-semibold text-gray-800 mb-2">Tugas Pokok:</h4>
                        <p class="mb-4">Dinas ini memiliki tugas pokok melaksanakan urusan pemerintahan di bidang lingkungan hidup dan pertanahan berdasarkan asas otonomi daerah dan tugas pembantuan.</p>
                    </div>

                    <!-- Combined section for Kepala Dinas photo and Komitmen Kami -->
                    <div class="flex flex-col md:flex-row items-start gap-6 mt-6">
                        <!-- Kepala Dinas photo -->
                        <div class="flex-shrink-0 w-full md:w-1/3 lg:w-1/4 text-center p-2 mt-0">
                            <img src="/images/kadis.png" alt="Foto Kepala Dinas" class="rounded-lg shadow-md mb-2 mx-auto h-40 w-32 object-cover">
                            <p class="text-sm font-semibold text-gray-800 leading-tight break-words">Reymond R.H Yap,SE.,MTP </p>
                            <p class="text-xs text-gray-600 leading-tight break-words">Kepala Dinas Lingkungan Hidup dan Pertanahan</p>
                        </div>

                        <!-- Komitmen Kami section -->
                        <div class="flex-grow text-gray-700 text-justify">
                            <h4 class="text-md font-semibold text-gray-800 mb-2 text-center"><strong>Komitmen Kami</strong></h4>
                            <p class="mb-4 text-justify">
                                Dinas Lingkungan Hidup dan Pertanahan Provinsi Papua Barat siap menjadi mitra bagi seluruh elemen masyarakat, akademisi, dunia usaha, dan instansi terkait lainnya dalam mencapai tujuan bersama: mewujudkan Papua Barat yang hijau, lestari, dan sejahtera. Kami berkomitmen untuk terus meningkatkan kualitas pelayanan, efektivitas program, dan akuntabilitas kinerja demi terwujudnya lingkunganhidup yang bersih, sehat, dan berkelanjutan untuk seluruh masyarakat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pengumuman Content -->
            <div id="pengumuman-content" class="main-content-panel h-[calc(100%-4rem)] overflow-y-auto hidden p-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Pengumuman Terbaru</h3>
                <div class="bg-white p-4 rounded-lg shadow-sm">
                    <p class="text-gray-700 mb-2">
                        **Pengumuman 1:** Sosialisasi Peraturan Baru tentang Pengelolaan Limbah B3 akan dilaksanakan pada tanggal 25 Juli 2025 di Aula Dinas. Mohon kehadiran perwakilan perusahaan dan masyarakat.
                    </p>
                    <p class="text-sm text-gray-500 mb-4">Tanggal Publikasi: 10 Juli 2025</p>
                    <p class="text-gray-700 mb-2">
                        **Pengumuman 2:** Pendaftaran program "Duta Lingkungan Muda" telah dibuka! Ajak generasi muda Papua Barat untuk berpartisipasi dalam menjaga kelestarian alam kita. Batas akhir pendaftaran 15 Agustus 2025.
                    </p>
                    <p class="text-sm text-gray-500">Tanggal Publikasi: 05 Juli 2025</p>
                    <!-- More announcements can be added here -->
                </div>
            </div>

            <!-- Galeri Content -->
            <div id="galeri-content" class="main-content-panel h-[calc(100%-4rem)] overflow-y-auto p-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Galeri Dinas Lingkungan Hidup dan Pertanahan Provinsi Papua Barat</h3>
                <div class="bg-white p-4 rounded-lg shadow-sm">
                    <div id="gallery-status-message" class="text-center text-gray-600 mb-4">Memuat gambar...</div>
                    <div id="gallery-images" class="gallery-grid">
                        <!-- Images will be loaded here dynamically -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- WhatsApp Floating Action Button (FAB) -->
    <a id="whatsapp-fab" href="https://wa.me/6281234567890?text=Halo%20Dinas%20Lingkungan%20Hidup%20dan%20Pertanahan%2C%20saya%20ingin%20bertanya..." target="_blank"
       class="fixed bottom-6 right-6 bg-green-500 hover:bg-green-600 text-white p-4 rounded-full shadow-lg transform hover:scale-110 transition-transform duration-200 ease-in-out flex items-center justify-center z-50">
        <i class="ph ph-whatsapp-logo text-3xl"></i>
    </a>

    <!-- Custom Modal for Messages (instead of alert/confirm) -->
    <div id="custom-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center p-4 z-[9999]">
        <div class="bg-white rounded-lg p-6 shadow-xl max-w-sm w-full">
            <h3 id="modal-title" class="text-lg font-semibold text-gray-800 mb-4"></h3>
            <p id="modal-message" class="text-gray-700 mb-6"></p>
            <div class="flex justify-end gap-2">
                <button id="modal-cancel-btn" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors duration-200 hidden">Batal</button>
                <button id="modal-ok-btn" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">OK</button>
            </div>
        </div>
    </div>

    <!-- Image Modal for Gallery -->
    <div id="image-modal" class="modal-overlay hidden">
        <div class="modal-content">
            <button class="modal-close-button" onclick="closeImageModal()">
                <i class="ph ph-x"></i>
            </button>
            <img id="modal-image-display" src="" alt="Galeri Gambar Besar">
            <p id="modal-image-title" class="text-base font-semibold text-gray-800 mt-2"></p>
        </div>
    </div>


    <script type="text/javascript">
        // Helper function to show custom modal (for general alerts)
        function showCustomModal(title, message, isConfirm = false, onConfirm = null) {
            const modal = document.getElementById('custom-modal');
            document.getElementById('modal-title').innerText = title;
            document.getElementById('modal-message').innerText = message;
            const okBtn = document.getElementById('modal-ok-btn');
            const cancelBtn = document.getElementById('modal-cancel-btn');

            if (isConfirm) {
                cancelBtn.classList.remove('hidden');
                okBtn.onclick = () => {
                    modal.classList.add('hidden');
                    if (onConfirm) onConfirm(true);
                };
                cancelBtn.onclick = () => {
                    modal.classList.add('hidden');
                    if (onConfirm) onConfirm(false);
                };
            } else {
                cancelBtn.classList.add('hidden');
                okBtn.onclick = () => {
                    modal.classList.add('hidden');
                };
            }
            modal.classList.remove('hidden');
        }

        // --- Markdown to HTML Conversion for AI Answers ---
        function convertMarkdownToHtml(markdownText) {
            let html = markdownText;

            // Convert paragraphs (lines separated by double newline)
            html = html.split('\n\n').map(p => `<p>${p}</p>`).join('');

            // Convert numbered lists: 1. Item -> <ol><li>Item</li></ol>
            // This is a more robust regex that handles multi-line lists correctly
            html = html.replace(/<p>(\d+\.\s.*?(?:\n\d+\.\s.*?)*)<\/p>/g, (match, content) => {
                const listItems = content.split('\n').map(item => `<li>${item.replace(/^\d+\.\s/, '')}</li>`).join('');
                return `<ol>${listItems}</ol>`;
            });

            // Convert bullet points: - Item or * Item -> <ul><li>Item</li></ul>
            html = html.replace(/<p>([-*]\s.*?(?:\n[-*]\s.*?)*)<\/p>/g, (match, content) => {
                const listItems = content.split('\n').map(item => `<li>${item.replace(/^[-*]\s/, '')}</li>`).join('');
                return `<ul>${listItems}</ul>`;
            });
            
            // Convert bold text: **text** or __text__ -> <strong>text</strong>
            html = html.replace(/\*\*(.*?)\*\*|__(.*?)__/g, '<strong>$1$2</strong>');
            
            return html;
        }

        // --- Image Modal Functions (GLOBAL SCOPE) ---
        // These functions need to be in the global scope to be callable from onclick attributes in HTML
        const imageModal = document.getElementById('image-modal');
        const modalImageDisplay = document.getElementById('modal-image-display');
        const modalImageTitle = document.getElementById('modal-image-title');

        function openImageModal(src, title) {
            modalImageDisplay.src = src;
            modalImageDisplay.alt = title;
            modalImageTitle.innerText = title;
            imageModal.classList.remove('hidden');
        }

        function closeImageModal() {
            imageModal.classList.add('hidden');
            modalImageDisplay.src = ''; // Clear image
            modalImageTitle.innerText = ''; // Clear title
        }

        // Close modal when clicking outside content (on overlay)
        if (imageModal) { // Check if element exists before adding listener
            imageModal.addEventListener('click', function(event) {
                if (event.target === imageModal) {
                    closeImageModal();
                }
            });
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && imageModal && !imageModal.classList.contains('hidden')) {
                closeImageModal();
            }
        });


        // --- Gallery Image Loading Logic ---
        async function loadGalleryImages() {
            const galleryImagesContainer = document.getElementById('gallery-images');
            const galleryStatusMessage = document.getElementById('gallery-status-message');
            galleryImagesContainer.innerHTML = ''; // Clear previous images
            galleryStatusMessage.innerText = 'Memuat gambar...';

            // URL of your Laravel backend proxy endpoint
            const galleryProxyUrl = 'http://127.0.0.1:8000/api/galeri-eksternal'; // Sesuaikan URL ini jika backend Anda berjalan di port atau domain lain
            
            // Dummy image data for fallback/CORS issues if proxy fails
            const dummyImages = [
                { src: 'https://placehold.co/300x200/a7f3d0/065f46?text=DUMMY+1', title: 'Gambar Demo 1' },
                { src: 'https://placehold.co/300x200/6ee7b7/065f46?text=DUMMY+2', title: 'Gambar Demo 2' },
                { src: 'https://placehold.co/300x200/34d399/065f46?text=DUMMY+3', title: 'Gambar Demo 3' },
                { src: 'https://placehold.co/300x200/10b981/065f46?text=DUMMY+4', title: 'Gambar Demo 4' },
            ];

            try {
                console.log('Attempting to fetch gallery images from:', galleryProxyUrl); // Log the URL being fetched
                const response = await fetch(galleryProxyUrl); 
                console.log('Response status:', response.status); // Log the HTTP status code

                if (!response.ok) {
                    let errorDetails = '';
                    try {
                        errorDetails = JSON.stringify(await response.json(), null, 2); // Try to parse error JSON
                    } catch (e) {
                        errorDetails = response.statusText; // Fallback to status text if not JSON
                    }
                    throw new Error(`HTTP error! Status: ${response.status}. Details: ${errorDetails}`);
                }

                const galleryItems = await response.json(); // Assuming response is an array of { src: 'url', title: 'title' }
                console.log('Successfully fetched gallery items:', galleryItems); // Log the fetched items

                if (galleryItems.length > 0) {
                    galleryImagesContainer.innerHTML = ''; // Clear "Memuat gambar..." message
                    galleryItems.forEach(item => {
                        if (item.src) {
                            galleryImagesContainer.innerHTML += `
                                <div class="gallery-item rounded-lg overflow-hidden" onclick="openImageModal('${item.src}', '${item.title || ''}')">
                                    <img src="${item.src}" onerror="this.onerror=null; this.src='https://placehold.co/300x200/cccccc/333333?text=Gambar+Gagal+Dimuat';" alt="${item.title || 'Gambar Galeri'}">
                                    <p class="text-sm text-gray-700 mt-2 p-2">${item.title || ''}</p>
                                </div>
                            `;
                        }
                    });
                    galleryStatusMessage.innerText = ''; // Clear status message on success
                } else {
                    galleryStatusMessage.innerText = 'Tidak ada gambar ditemukan dari sumber eksternal melalui proxy.';
                }

            } catch (error) {
                console.error('Error loading gallery images from proxy:', error);
                galleryStatusMessage.innerHTML = `
                    <p class="text-sm text-red-600 mb-2">
                        Gagal memuat galeri dari sumber eksternal melalui proxy: <strong>${error.message}</strong>.
                        <br>Mohon pastikan backend proxy Laravel sudah diatur dengan benar, berjalan, dan dapat mengakses URL eksternal tersebut.
                    </p>
                    <p>Menampilkan contoh gambar:</p>
                `;
                dummyImages.forEach(item => { // Gunakan item.src dan item.title dari dummyImages
                    galleryImagesContainer.innerHTML += `
                        <div class="gallery-item rounded-lg overflow-hidden" onclick="openImageModal('${item.src}', '${item.title}')">
                            <img src="${item.src}" alt="${item.title || 'Galeri Gambar Dummy'}">
                            <p class="text-sm text-gray-700 mt-2 p-2">${item.title || ''}</p>
                        </div>
                    `;
                });
            }
        }


        document.addEventListener('DOMContentLoaded', function() {
            const tabsContainer = document.getElementById('tabs-container'); // Get the tabs container
            const dynamicHeadlineContainer = document.getElementById('dynamic-headline-container'); // Get dynamic headline container
            const dynamicHeadlineText = document.getElementById('dynamic-headline-text'); // Get dynamic headline text

            const tabSopBtn = document.getElementById('tab-sop-btn');
            const tabQaBtn = document.getElementById('tab-qa-btn');
            const sopContent = document.getElementById('sop-content');
            const qaContent = document.getElementById('qa-content');
            const profilDinasContent = document.getElementById('profil-dinas-content'); // New element
            const pengumumanContent = document.getElementById('pengumuman-content'); // New element
            const galeriContent = document.getElementById('galeri-content'); // New element

            const navSop = document.getElementById('nav-sop');
            const navQa = document.getElementById('nav-qa');
            const navProfilDinas = document.getElementById('nav-profil-dinas'); // New element
            const navPengumuman = document.getElementById('nav-pengumuman'); // New element
            const navGaleri = document.getElementById('nav-galeri'); // New element

            const clearQaHistoryBtn = document.getElementById('clear-qa-history-btn'); 

            // Function to show only one main content panel and manage header
            function showContentPanel(panelToShowId) {
                const allContentPanels = document.querySelectorAll('.main-content-panel');
                allContentPanels.forEach(panel => {
                    if (panel.id === panelToShowId) {
                        panel.classList.remove('hidden');
                    } else {
                        panel.classList.add('hidden');
                    }
                });

                // Manage visibility of tabs vs dynamic headline
                if (panelToShowId === 'sop-content' || panelToShowId === 'qa-content') {
                    tabsContainer.classList.remove('hidden');
                    dynamicHeadlineContainer.classList.add('hidden');
                    // Manage active state for SOP and QA tabs
                    if (panelToShowId === 'sop-content') {
                        tabSopBtn.classList.add('active');
                        tabQaBtn.classList.remove('active');
                    } else { // qa-content
                        tabQaBtn.classList.add('active');
                        tabSopBtn.classList.remove('active');
                    }
                } else { // profil-dinas-content, pengumuman-content, or galeri-content
                    tabsContainer.classList.add('hidden');
                    dynamicHeadlineContainer.classList.remove('hidden');
                    tabSopBtn.classList.remove('active'); // Ensure no tabs are active
                    tabQaBtn.classList.remove('active'); // Ensure no tabs are active

                    if (panelToShowId === 'profil-dinas-content') {
                        dynamicHeadlineText.innerText = 'Profil Dinas';
                    } else if (panelToShowId === 'pengumuman-content') {
                        dynamicHeadlineText.innerText = 'Pengumuman';
                    } else if (panelToShowId === 'galeri-content') {
                        dynamicHeadlineText.innerText = 'Galeri';
                        loadGalleryImages(); // Call function to load gallery images
                    }
                }
            }


            // Event Listeners for Tab Buttons
            tabSopBtn.addEventListener('click', () => showContentPanel('sop-content'));
            tabQaBtn.addEventListener('click', () => showContentPanel('qa-content'));

            // Event Listeners for Nav Cards (main navigation)
            navSop.addEventListener('click', () => showContentPanel('sop-content'));
            navQa.addEventListener('click', () => showContentPanel('qa-content'));
            navProfilDinas.addEventListener('click', () => showContentPanel('profil-dinas-content'));
            navPengumuman.addEventListener('click', () => showContentPanel('pengumuman-content'));
            navGaleri.addEventListener('click', () => showContentPanel('galeri-content')); // Event listener for new Galeri button


            // Q&A Section Logic with AI Integration
            const sendQuestionBtn = document.getElementById('send-question-btn');
            const qaUnitSelect = document.getElementById('qa-unit-select');
            const qaQuestionText = document.getElementById('qa-question-text');
            const qaHistory = document.getElementById('qa-history');
            const qaLoadingIndicator = document.getElementById('qa-loading-indicator');
            const contactPersonInfo = document.getElementById('contact-person-info'); // Element for contact info


            let chatHistory = [];

            // Function to add a message to the chat history display
            function addMessageToHistory(sender, message, isUser = false) {
                const formattedMessage = isUser ? message : convertMarkdownToHtml(message);
                const messageHtml = `
                    <div class="flex ${isUser ? 'justify-end' : 'justify-start'} mb-2">
                        <div class="${isUser ? 'bg-blue-500 text-white' : 'bg-green-100 text-gray-800'} p-3 rounded-lg shadow-md max-w-[80%] break-words">
                            <span class="font-semibold ${isUser ? '' : 'text-green-700'} flex items-center mb-1">
                                <i class="ph ${isUser ? 'ph-user' : 'ph-robot'} text-lg mr-1"></i> ${sender}:
                            </span> 
                            ${formattedMessage}
                        </div>
                    </div>
                `;
                qaHistory.innerHTML += messageHtml;
                qaHistory.scrollTop = qaHistory.scrollHeight; // Scroll to bottom
            }

            sendQuestionBtn.addEventListener('click', async function() {
                const unit = qaUnitSelect.value;
                const question = qaQuestionText.value.trim();

                if (!unit) {
                    showCustomModal('Peringatan', 'Harap pilih bidang terlebih dahulu.'); // Updated message
                    return;
                }
                if (!question) {
                    showCustomModal('Peringatan', 'Pertanyaan tidak boleh kosong.');
                    return;
                }

                // Add user question to history display
                addMessageToHistory('Anda', question, true);
                qaQuestionText.value = ''; // Clear input field

                qaLoadingIndicator.classList.remove('hidden'); // Show loading indicator

                try {
                    // Construct the prompt for the AI with instructions for formatting
                    const prompt = `Sebagai sistem informasi resmi untuk Dinas Lingkungan Hidup dan Pertanahan Provinsi Papua Barat, dengan fokus pada bidang "${unit}", jawab pertanyaan berikut: "${question}". Berikan jawaban yang informatif dan relevan dengan topik lingkungan atau kebijakan lahan di Papua Barat. Jika jawaban memerlukan beberapa poin atau langkah, gunakan daftar bernomor (1., 2., 3., dst.) atau poin-poin (bullet points seperti -, *). Pastikan formatnya rapi dan mudah dibaca. Jika tidak dapat menjawab, sarankan untuk menghubungi staf langsung dari bidang terkait.`;

                    chatHistory.push({ role: "user", parts: [{ text: prompt }] });
                    const payload = { contents: chatHistory };
                    const apiKey = "AIzaSyD2ESOa8HXiew6CTDLOuUnDiyEWrOb3gDI"; // API KEY DI SINI
                    const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${apiKey}`;

                    const response = await fetch(apiUrl, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(payload)
                    });

                    const result = await response.json();

                    if (result.candidates && result.candidates.length > 0 &&
                        result.candidates[0].content && result.candidates[0].content.parts &&
                        result.candidates[0].content.parts.length > 0) {
                        const aiAnswer = result.candidates[0].content.parts[0].text;
                        chatHistory.push({ role: "model", parts: [{ text: aiAnswer }] }); // Add AI response to history

                        // Add AI response to history display
                        addMessageToHistory('AI', aiAnswer, false);
                    } else {
                        // Log the full result to console for debugging if AI gives no usable response
                        console.error('AI did not provide a usable response:', result);
                        showCustomModal('Error AI', 'Maaf, AI tidak dapat memberikan jawaban saat ini. Silakan coba lagi atau hubungi staf.');
                        addMessageToHistory('AI', 'Maaf, saya tidak dapat memproses permintaan ini.', false);
                    }
                } catch (error) {
                    console.error('Error calling AI API:', error);
                    showCustomModal('Error Jaringan', 'Terjadi kesalahan saat menghubungi AI. Periksa koneksi internet Anda atau coba lagi nanti.');
                    addMessageToHistory('AI', 'Maaf, terjadi kesalahan teknis saat mengambil jawaban.', false);
                } finally {
                    qaLoadingIndicator.classList.add('hidden'); // Hide loading indicator
                    qaHistory.scrollTop = qaHistory.scrollHeight; // Scroll to bottom again
                }
            });

            // Function to clear chat history
            clearQaHistoryBtn.addEventListener('click', function() {
                showCustomModal('Konfirmasi Hapus Riwayat', 'Apakah Anda yakin ingin menghapus seluruh riwayat percakapan?', true, (confirmed) => {
                    if (confirmed) {
                        qaHistory.innerHTML = ``; // Clear display
                        chatHistory = []; // Reset AI chat history
                        qaHistory.scrollTop = qaHistory.scrollHeight; // Scroll to bottom
                        showCustomModal('Sukses', 'Riwayat percakapan telah dihapus.');
                    }
                });
            });

            // SOP Viewer Logic
            const sopSearchInput = document.getElementById('sop-search');
            const sopCategories = document.querySelectorAll('.sop-category');
            const sopLists = document.querySelectorAll('.sop-list li');
            const sopDetailContent = document.getElementById('sop-detail-content');
            const sopActions = document.getElementById('sop-actions');
            const sopViewBtn = document.getElementById('sop-view-btn');
            const sopDownloadBtn = document.getElementById('sop-download-btn');
            const sopWhatsappAction = document.getElementById('sop-whatsapp-action'); // WhatsApp action div for SOP detail
            const sopWhatsappBtn = document.getElementById('sop-whatsapp-btn'); // WhatsApp button for SOP detail
            const sopUnitSelectMobile = document.getElementById('sop-unit-select');

            // --- WhatsApp Numbers and Contact Persons for each Bidang ---
            const bidangContacts = {
                "bidang-pertanahan": {
                    name: "Bidang Pertanahan",
                    contactPerson: "Subono Pacific Ocean,SH",
                    number: "6281211111111", // Dummy number
                    role: "Narahubung Bidang Pertanahan"
                },
                "bidang-penataan-penegakan": {
                    name: "Bidang Penataan Dan Penegakan Hukum Lingkungan Hidup",
                    contactPerson: "Daniel Leonard,S.Hut,M.Si",
                    number: "6281233333333", // Dummy number
                    role: "Narahubung Bidang Penataan Dan Penegakan Hukum Lingkungan Hidup"
                },
                "bidang-persampahan": {
                    name: "Bidang Persampahan, B3 & Peningkatan Kapasitas Lingkungan Hidup",
                    contactPerson: "Grace Dharmawati Timang,S.T,M.Si",
                    number: "6281222222222", // Dummy number
                    role: "Narahubung Bidang Persampahan, B3 & PKLH"
                },
                "bidang-pengendalian-pencemaran": {
                    name: "Bidang Pengendalian Pencemaran Dan Kerusakan Lingkungan Hidup",
                    contactPerson: "Indah Lestari SIbagariang,M.Si",
                    number: "6281244444444", // Dummy number
                    role: "Narahubung Bidang Pengendalian, Pencemaran dan Kerusakan Lingkungan Hidup"
                },
                "laboratorium-lingkungan": {
                    name: "Laboratorium Lingkungan Hidup",
                    contactPerson: "Henny Pinantoan",
                    number: "6281255555555", // Dummy number
                    role: "Narahubung Bidang Laboratorium Lingkungan Hidup"
                },
                "umum-bidang": {
                    name: "Umum",
                    contactPerson: "Staf Umum",
                    number: "6281266666666", // Dummy number
                    role: "Layanan Umum"
                }
            };

            // Function to display contact person information and QR code in Q&A section
            function displayContactPerson(bidangId) {
                const contact = bidangContacts[bidangId];
                if (contact) {
                    const whatsappLink = `https://wa.me/${contact.number}?text=Halo%20${encodeURIComponent(contact.contactPerson)}%20dari%20${encodeURIComponent(contact.name)}%2C%20saya%20ingin%20bertanya...`;
                    const qrCodeUrl = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(whatsappLink)}`;

                    contactPersonInfo.innerHTML = `
                        <p class="text-base font-semibold text-gray-800">${contact.contactPerson}</p>
                        <p class="text-sm text-gray-700">${contact.role} - ${contact.name}</p>
                        <a href="${whatsappLink}" target="_blank"
                           class="inline-flex items-center px-4 py-2 mt-3 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 transition-colors duration-200">
                            <i class="ph ph-whatsapp-logo text-lg mr-2"></i>Hubungi via WhatsApp
                        </a>
                        <div id="qr-code-section-inner" class="flex flex-col items-center mt-4">
                            <p class="text-sm text-gray-600 mb-2">Scan QR code ini untuk terhubung di WA</p>
                            <img id="whatsapp-qr-code-inner" src="${qrCodeUrl}" alt="WhatsApp QR Code" class="w-32 h-32 border border-gray-300 rounded-lg p-1">
                        </div>
                    `;
                } else {
                    contactPersonInfo.innerHTML = `
                        <p class="text-center text-gray-500">Pilih bidang di atas untuk melihat narahubung terkait.</p>
                    `;
                }
            }

            // Listen for changes on the "Pilih Bidang" dropdown in Q&A section
            qaUnitSelect.addEventListener('change', function() {
                displayContactPerson(this.value);
            });


            // Mock SOP Data (in a real app, this would come from a database)
            const sops = {
                cuti: {
                    title: "SOP Permintaan Cuti",
                    content: "Prosedur standar untuk mengajukan cuti tahunan, cuti sakit, atau cuti khusus. Termasuk formulir yang dibutuhkan dan alur persetujuan.",
                    file: "https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf", // Dummy PDF link
                    bidang_id: "umum-bidang"
                },
                mutasi: {
                    title: "SOP Mutasi Pegawai",
                    content: "Panduan lengkap mengenai proses mutasi pegawai antar divisi atau unit kerja, persyaratan, dan dokumen pendukung.",
                    file: "https://www.africau.edu/images/default/sample.pdf", // Another dummy PDF
                    bidang_id: "umum-bidang"
                },
                dana: {
                    title: "SOP Permintaan Dana",
                    content: "Langkah-langkah untuk mengajukan permintaan dana operasional atau kegiatan, termasuk otorisasi dan pelaporan keuangan.",
                    file: "https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf",
                    bidang_id: "umum-bidang"
                },
                dinas: {
                    title: "SOP Laporan Perjalanan Dinas",
                    content: "Prosedur pembuatan dan penyerahan laporan perjalanan dinas, termasuk kelengkapan bukti pengeluaran dan akomodasi.",
                    file: "https://www.africau.edu/images/default/sample.pdf",
                    bidang_id: "umum-bidang"
                },
                atk: {
                    title: "SOP Permintaan ATK",
                    content: "Prosedur pengajuan permintaan alat tulis kantor (ATK) dan mekanisme distribusinya di lingkungan dinas.",
                    file: "https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf",
                    bidang_id: "umum-bidang"
                },
                limbah: {
                    title: "SOP Penanganan Limbah B3",
                    content: "Panduan aman penanganan, penyimpanan, dan pembuangan limbah bahan berbahaya dan beracun (B3) sesuai regulasi lingkungan.",
                    file: "https://www.africau.edu/images/default/sample.pdf",
                    bidang_id: "bidang-persampahan"
                },
                amdal: {
                    title: "SOP Prosedur AMDAL",
                    content: "Alur proses Analisis Mengenai Dampak Lingkungan (AMDAL) untuk proyek pembangunan, dari pengajuan hingga penerbitan izin lingkungan.",
                    file: "https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf",
                    bidang_id: "bidang-pengendalian-pencemaran"
                },
                sertifikat: {
                    title: "SOP Penerbitan Sertifikat Tanah",
                    content: "Prosedur dan persyaratan untuk penerbitan sertifikat hak atas tanah, termasuk verifikasi data dan pengukuran lahan.",
                    file: "https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf",
                    bidang_id: "bidang-pertanahan"
                },
                izin: {
                    title: "SOP Izin Penggunaan Lahan",
                    content: "Panduan pengajuan izin penggunaan dan pemanfaatan lahan untuk berbagai keperluan, sesuai dengan tata ruang wilayah.",
                    file: "https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf",
                    bidang_id: "bidang-pertanahan"
                }
            };

            // Initially hide all SOP lists
            document.querySelectorAll('.sop-list').forEach(list => list.style.display = 'none');

            // Toggle SOP list visibility for desktop/tablet categories
            sopCategories.forEach(category => {
                category.addEventListener('click', function() {
                    const targetCategory = this.dataset.category;
                    const list = document.querySelector(`.sop-list[data-category="${targetCategory}"]`);
                    if (list) {
                        list.style.display = list.style.display === 'none' ? 'block' : 'none';
                    }
                });
            });

            // Handle SOP item click
            sopLists.forEach(item => {
                item.addEventListener('click', function() {
                    const sopId = item.dataset.sopId;
                    const sop = sops[sopId];
                    if (sop) {
                        sopDetailContent.innerHTML = `
                            <h4 class="text-xl font-semibold text-green-800 mb-2">${sop.title}</h4>
                            <p class="text-gray-700 text-base mb-4">${sop.content}</p>
                            <p class="text-gray-600 text-xs">Sumber: Dinas Lingkungan Hidup dan Pertanahan</p>
                        `;
                        sopViewBtn.href = sop.file;
                        sopDownloadBtn.href = sop.file;
                        sopDownloadBtn.setAttribute('download', `${sop.title.replace(/\s/g, '_')}.pdf`);
                        sopActions.classList.remove('hidden');

                        // --- WhatsApp integration for SOP details ---
                        const bidangData = bidangContacts[sop.bidang_id]; 
                        if (bidangData) {
                            const whatsappUrl = `https://wa.me/${bidangData.number}?text=Halo%20${encodeURIComponent(bidangData.contactPerson)}%20dari%20${encodeURIComponent(bidangData.name)}%2C%20saya%20ingin%20bertanya%20mengenai%20SOP%20${encodeURIComponent(sop.title)}.`;
                            sopWhatsappBtn.href = whatsappUrl;
                            sopWhatsappAction.classList.remove('hidden');
                        } else {
                            sopWhatsappAction.classList.add('hidden');
                        }

                    } else {
                        sopDetailContent.innerHTML = '<p class="text-center text-gray-500">SOP tidak ditemukan.</p>';
                        sopActions.classList.add('hidden');
                        sopWhatsappAction.classList.add('hidden'); // Hide WhatsApp button if SOP not found
                    }
                });
            });

            // Handle mobile unit selection for SOPs
            sopUnitSelectMobile.addEventListener('change', function() {
                const selectedCategory = this.value;
                sopLists.forEach(item => {
                    const itemCategory = item.closest('.sop-list').dataset.category;
                    if (selectedCategory === 'all' || itemCategory === selectedCategory) {
                        item.style.display = 'flex'; // Show
                    } else {
                        item.style.display = 'none'; // Hide
                    }
                });
                 // Hide desktop categories if mobile select is used
                document.querySelectorAll('.sop-category').forEach(cat => cat.style.display = 'none');
                document.querySelectorAll('.sop-list').forEach(list => list.style.display = 'block'); // Ensure the lists themselves are visible
            });

            // SOP Search functionality
            sopSearchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                sopLists.forEach(item => {
                    const sopId = item.dataset.sopId;
                    const sop = sops[sopId];
                    const itemText = item.textContent.toLowerCase();

                    // Check if SOP title or content (if selected) or the list item text contains the search term
                    const isMatch = itemText.includes(searchTerm) || (sop && (sop.title.toLowerCase().includes(searchTerm) || sop.content.toLowerCase().includes(searchTerm)));

                    if (isMatch) {
                        item.style.display = 'flex'; // Show the list item
                        item.closest('.sop-list').style.display = 'block'; // Ensure its parent list is also shown
                        // Also ensure the parent category is visible for desktop if it matches
                        const parentCategoryDiv = item.closest('.sop-list').previousElementSibling;
                        if (parentCategoryDiv && parentCategoryDiv.classList.contains('sop-category')) {
                            parentCategoryDiv.style.display = 'flex';
                        }
                    } else {
                        item.style.display = 'none'; // Hide the list item
                    }
                });

                // Adjust category visibility if all children are hidden
                document.querySelectorAll('.sop-list').forEach(list => {
                    const visibleChildren = Array.from(list.children).filter(child => child.style.display !== 'none');
                    const parentCategoryDiv = list.previousElementSibling;
                    if (parentCategoryDiv && parentCategoryDiv.classList.contains('sop-category')) {
                        if (visibleChildren.length === 0) {
                            parentCategoryDiv.style.display = 'none'; // Hide category if no visible children
                        } else {
                            parentCategoryDiv.style.display = 'flex'; // Show if it has visible children
                        }
                    }
                });

                // If search term is empty, reset display for all categories and list items
                if (searchTerm === '') {
                     document.querySelectorAll('.sop-category').forEach(cat => cat.style.display = 'flex');
                     document.querySelectorAll('.sop-list').forEach(list => list.style.display = 'none');
                     sopLists.forEach(item => item.style.display = 'flex'); // Show all sub-items again by default
                }
            });


            // Initial state: ensure SOP tab is active and visible
            showContentPanel('sop-content'); // Changed to use new showContentPanel function
        });
    </script>
</body>
</html>
