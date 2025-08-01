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
    <!-- Debug script untuk modal berita -->
    <script src="/js/berita-debug.js"></script>
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
            grid-template-columns: repeat(1, 1fr);
            gap: 1.5rem;
        }
        @media (min-width: 640px) {
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (min-width: 1024px) {
            .gallery-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        .gallery-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.10);
            overflow: hidden;
            transition: box-shadow 0.25s cubic-bezier(0.4,0,0.2,1), transform 0.25s cubic-bezier(0.4,0,0.2,1), filter 0.25s cubic-bezier(0.4,0,0.2,1);
            border: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            cursor: pointer;
        }
        .gallery-card:hover {
            box-shadow: 0 8px 32px rgba(16,185,129,0.18), 0 2px 8px rgba(0,0,0,0.10);
            transform: scale(1.04) translateY(-6px);
            filter: brightness(1.04);
            z-index: 2;
        }
        .gallery-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            transition: filter 0.25s cubic-bezier(0.4,0,0.2,1);
        }
        .gallery-card:hover img {
            filter: brightness(1.08) saturate(1.08);
        }
        .gallery-card-title {
            padding: 1rem;
            font-weight: 600;
            color: #222;
            font-size: 1rem;
            text-align: center;
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
        #gallery-status-message {
            display: block !important;
            position: sticky !important;
            top: 0 !important;
            z-index: 10 !important;
            background: #fff !important;
            border-bottom: 2px solid #059669 !important;
            opacity: 1 !important;
            color: #222 !important;
            min-height: 20px !important;
            margin: 10px 0 !important;
            padding: 10px !important;
        }
        #gallery-status-message button {
            display: inline-block !important;
            opacity: 1 !important;
            z-index: 1001 !important;
            visibility: visible !important;
            cursor: pointer !important;
        }
        .faq-card {
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .faq-card:hover {
            box-shadow: 0 4px 16px rgba(16,185,129,0.10);
            transform: translateY(-4px) scale(1.03);
        }
        .faq-question {
            background: none;
            border: none;
            outline: none;
            cursor: pointer;
            width: 100%;
            transition: background 0.2s;
        }
        .faq-question:hover {
            background: #e0f2f1;
        }
        .faq-arrow {
            transition: transform 0.2s;
        }
        @keyframes fadein-up {
            0% { opacity: 0; transform: translateY(24px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fadein-up {
            animation: fadein-up 0.7s cubic-bezier(0.4,0,0.2,1);
        }
        /* Gaya daftar SOP mobile */
        #sop-list-mobile .sop-mobile-item {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            font-weight: 500;
            color: #166534;
            box-shadow: 0 2px 8px rgba(16,185,129,0.06);
            transition: background 0.2s, border 0.2s, color 0.2s, font-weight 0.2s;
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        #sop-list-mobile .sop-mobile-item:hover {
            background: #d1fae5;
            border-color: #10b981;
            color: #065f46;
        }
        #sop-list-mobile .sop-mobile-item.active {
            background: #bbf7d0;
            border-color: #10b981;
            color: #065f46;
            font-weight: 700;
        }
        @media (max-width: 480px) {
            #sop-list-mobile .sop-mobile-item {
                font-size: 0.95rem;
                padding: 0.7rem 0.7rem;
            }
        }
        /* Gaya daftar SOP desktop/sidebar */
        .sop-list li.active {
            background: #bbf7d0;
            border-left: 4px solid #10b981;
            font-weight: 700;
            color: #065f46;
            transition: background 0.2s, border 0.2s, color 0.2s, font-weight 0.2s;
        }
        .sop-list li {
            transition: background 0.2s, border 0.2s, color 0.2s, font-weight 0.2s;
        }
        @media (max-width: 768px) {
            .sop-list li.active {
                border-left-width: 3px;
                font-size: 0.98rem;
            }
        }
        /* Cardview berita */
        .berita-card {
            background: #fff;
            border-radius: 0.75rem;
            box-shadow: 0 2px 8px rgba(16,185,129,0.08);
            border: 1px solid #d1fae5;
            padding: 1.25rem 1rem;
            margin-bottom: 1.5rem;
            transition: box-shadow 0.25s, transform 0.25s, filter 0.25s, background 0.2s;
            animation: berita-fadein 0.7s cubic-bezier(0.4,0,0.2,1);
            position: relative;
        }
        .berita-card:hover {
            box-shadow: 0 8px 32px rgba(16,185,129,0.18), 0 2px 8px rgba(0,0,0,0.10);
            transform: scale(1.03) translateY(-4px);
            filter: brightness(1.04);
            background: #f0fdf4;
            z-index: 2;
        }
        @keyframes berita-fadein {
            0% { opacity: 0; transform: translateY(24px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .berita-pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1.5rem;
        }
        .berita-pagination button {
            background: #fff;
            border: 1px solid #10b981;
            color: #10b981;
            border-radius: 0.5rem;
            padding: 0.5rem 1.1rem;
            font-weight: 600;
            transition: background 0.2s, color 0.2s;
            cursor: pointer;
        }
        .berita-pagination button.active, .berita-pagination button:hover {
            background: #10b981;
            color: #fff;
        }
        @media (max-width: 600px) {
            .berita-card { padding: 1rem 0.7rem; }
            .berita-pagination button { padding: 0.45rem 0.8rem; font-size: 0.98rem; }
        }
        
        /* Berita detail modal styles */
        .berita-detail {
            max-height: 70vh;
            overflow-y: auto;
            padding-right: 1rem;
        }
        .berita-detail::-webkit-scrollbar {
            width: 6px;
        }
        .berita-detail::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }
        .berita-detail::-webkit-scrollbar-thumb {
            background: #10B981;
            border-radius: 3px;
        }
        .berita-detail::-webkit-scrollbar-thumb:hover {
            background: #059669;
        }
        .berita-detail .prose {
            line-height: 1.6;
            color: #374151;
        }
        .berita-detail .prose p {
            margin-bottom: 1rem;
        }
        .berita-detail .prose h1, .berita-detail .prose h2, .berita-detail .prose h3 {
            color: #065f46;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }

         /* Custom Header Styles */
         .header-gradient-custom {
            background: linear-gradient(to bottom right, #16a34a, #047857); /* Darker, richer green gradient */
        }
        .header-shadow-custom {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25); /* Stronger, more elegant shadow */
        }
        .header-pattern-overlay {
            position: absolute;
            inset: 0;
            opacity: 0.1; /* Subtle opacity */
            z-index: 0; /* Behind content */
        }

        @keyframes fadein-up {
            0% { opacity: 0; transform: translateY(32px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fadein-up {
            animation: fadein-up 0.8s cubic-bezier(0.4,0,0.2,1);
        }

    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-4">

        <!-- Header - Revised for more attractive look -->
    <header class="w-full text-center py-6 md:py-8 px-4 header-gradient-custom text-white header-shadow-custom rounded-b-lg relative overflow-hidden">
        <!-- Subtle pattern overlay -->
        <div class="header-pattern-overlay">
            <svg class="w-full h-full" fill="none" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid slice">
                <pattern id="header-pattern" x="0" y="0" width="10" height="10" patternUnits="userSpaceOnUse">
                    <circle cx="5" cy="5" r="1" fill="rgba(255,255,255,0.1)"></circle>
                </pattern>
                <rect x="0" y="0" width="100%" height="100%" fill="url(#header-pattern)"></rect>
            </svg>
        </div>
        <div class="max-w-screen-xl mx-auto flex flex-col items-center relative z-10">
            <!-- Updated image source to a placeholder for better rendering in isolated environments -->
            <img src="/images/pabar.png" alt="Logo Dinas" class="h-24 w-24 rounded-full mb-4 shadow-lg ">
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold mb-1 tracking-wide">DINAS LINGKUNGAN HIDUP DAN PERTANAHAN</h1>
            <p class="text-lg sm:text-xl md:text-2xl opacity-90">PROVINSI PAPUA BARAT</p>
            <p class="text-sm sm:text-base opacity-80 mt-2">Jl. Brigjen (Purn) Abraham O Atururi Kompleks Perkantoran Gubernur Arfai</p>
        </div>
    </header>

    <!-- Main Container -->
    <div class="bg-white rounded-lg shadow-2xl p-6 md:p-8 w-full max-w-screen-xl flex flex-col md:flex-row gap-6 mt-6 md:mt-10">

        <!-- Left Section - SILKAT Title & Navigation Cards -->
        <div class="w-full md:w-1/3 lg:w-1/4 flex flex-col items-center text-center p-4 md:p-6 bg-green-50 rounded-lg shadow-md">
        <img src="/images/silkatlogo.png" alt="SILKAT Logo" class="h-20 w-auto mb-2 mx-auto">
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

                <!-- Tambahkan tombol navigasi Berita -->
                <button id="nav-berita" class="nav-card bg-gradient-to-br from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white p-4 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 ease-in-out flex flex-col items-center justify-center">
                    <i class="ph ph-newspaper text-4xl mb-2"></i>
                    <span class="text-sm font-medium">Berita</span>
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
                            <div id="sop-list-mobile" class="block md:hidden mt-2"></div>

                            <!-- Desktop/Tablet view of categories -->
                            <div class="hidden md:block">
                                <div class="sop-category cursor-pointer p-2 rounded-md hover:bg-green-100 flex items-center text-gray-700 font-medium" data-category="bidang-pertanahan">
                                    <i class="ph ph-map-pin text-xl mr-2"></i>Bidang Pertanahan
                                </div>
                                <ul class="ml-8 text-sm text-gray-600 sop-list" data-category="bidang-pertanahan">
                                    <li class="py-1 flex items-center cursor-pointer hover:text-green-700" data-sop-id="pengadaan_tanah"><i class="ph ph-file-text text-base mr-2"></i>SOP Pengadaan Tanah</li>
                                    <li class="py-1 flex items-center cursor-pointer hover:text-green-700" data-sop-id="sengketa_tanah"><i class="ph ph-file-text text-base mr-2"></i>SOP Penyelesaian Sengketa Tanah</li>
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
                                    <li class="py-1 flex items-center cursor-pointer hover:text-green-700" data-sop-id="penerimaan_pengaduan"><i class="ph ph-file-text text-base mr-2"></i>SOP Dalam Proses Penerimaan Pengaduan</li>
                                    <li class="py-1 flex items-center cursor-pointer hover:text-green-700" data-sop-id="amdal_pp22_2021"><i class="ph ph-file-text text-base mr-2"></i>Penyusunan Dokumen AMDAL sesuai PP 22 Tahun 2021</li>
                                    <li class="py-1 flex items-center cursor-pointer hover:text-green-700" data-sop-id="pengawasan_perizinan_lh"><i class="ph ph-file-text text-base mr-2"></i>SOP Pengawasan Penaatan Perizinan dan Peraturan Perundang-undangan Pengelolaan Lingkungan Hidup</li>
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
                                    <li class="py-1 flex items-center cursor-pointer hover:text-green-700" data-sop-id="pengujian_sampel"><i class="ph ph-file-text text-base mr-2"></i>Prosedur Pelaksanaan Pengujian Sampel</li>
                                    <li class="py-1 flex items-center cursor-pointer hover:text-green-700" data-sop-id="penerimaan_sampel_air"><i class="ph ph-file-text text-base mr-2"></i>Prosedur Pelaksanaan Penerimaan Sampel Air</li>
                                    <li class="py-1 flex items-center cursor-pointer hover:text-green-700" data-sop-id="penyerahan_lhu"><i class="ph ph-file-text text-base mr-2"></i>Prosedur Pelaksanaan Pembuatan dan Penyerahan LHU (Hardcopy)</li>
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
                    <!-- Judul -->
                    <h3 class="text-2xl font-bold text-green-800 mb-6 text-center">Profil Dinas Lingkungan Hidup dan Pertanahan Provinsi Papua Barat</h3>

                    <!-- Baris 1: Kepala Dinas & Sekretaris Dinas (Gubernur & Wakil Gubernur) -->
                    <div class="flex flex-col md:flex-row gap-3 md:gap-4 mb-4 md:mb-6">
                        <div class="flex-1 bg-gray-50 rounded-xl shadow-lg p-4 md:p-6 flex flex-col items-center justify-center transform transition duration-300 hover:scale-105 hover:shadow-2xl animate-fadein-up">
                            <div class="w-24 h-28 md:w-28 md:h-32 bg-gray-200 rounded-lg flex items-center justify-center mb-2 overflow-hidden shadow-md">
                                <img src="/images/gub.png" alt="Foto Gubernur" class="object-cover w-full h-full" onerror="this.style.display='none'">
                                <span class="text-gray-400 text-xs" style="display:none;">Foto Gubernur</span>
                            </div>
                            <p class="font-semibold text-green-900 text-sm md:text-base text-center">Drs.Dominggus Mandacan,M.Si</p>
                            <p class="text-xs text-gray-600 text-center">Gubernur Papua Barat</p>
                        </div>
                        <div class="flex-1 bg-gray-50 rounded-xl shadow-lg p-4 md:p-6 flex flex-col items-center justify-center transform transition duration-300 hover:scale-105 hover:shadow-2xl animate-fadein-up" style="animation-delay:0.1s;">
                            <div class="w-24 h-28 md:w-28 md:h-32 bg-gray-200 rounded-lg flex items-center justify-center mb-2 overflow-hidden shadow-md">
                                <img src="/images/wagub.png" alt="Foto Wakil Gubernur" class="object-cover w-full h-full" onerror="this.style.display='none'">
                                <span class="text-gray-400 text-xs" style="display:none;">Foto Wakil Gubernur</span>
                            </div>
                            <p class="font-semibold text-green-900 text-sm md:text-base text-center">Mohamad Lakotani,SH.,M.Si</p>
                            <p class="text-xs text-gray-600 text-center">Wakil Gubernur Papua Barat</p>
                        </div>
                    </div>

                    <!-- Baris 2: Paragraf Profil -->
                    <div class="mb-4 md:mb-6 text-gray-700 text-justify text-sm md:text-base">
                        Dinas Lingkungan Hidup dan Pertanian Provinsi Papua Barat adalah garda terdepan pemerintah daerah dalam mewujudkan pembangunan berkelanjutan di Tanah Papua Barat. Dinas ini mengemban amanah besar untuk menjaga kelestarian lingkungan hidup dan menata kelola pertanian demi masa depan yang lebih baik.
                    </div>

                    <!-- Baris 3: 3 Kartu Info -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 md:gap-4 mb-4 md:mb-6">
                        <div class="rounded-xl bg-white border-2 border-green-200 shadow-lg p-4 flex flex-col items-center transform transition duration-300 hover:scale-105 hover:shadow-2xl animate-fadein-up">
                            <div class="text-2xl md:text-3xl mb-2"><i class="ph ph-bank"></i></div>
                            <div class="font-bold text-green-700 mb-1 text-sm md:text-base">Dasar Hukum</div>
                            <div class="text-xs md:text-sm text-gray-600 text-center">Peraturan Daerah Provinsi Papua Barat Nomor 7 Tahun 2016<br>Peraturan Gubernur Papua Barat Nomor 32 Tahun 2018</div>
                        </div>
                        <div class="rounded-xl bg-white border-2 border-green-200 shadow-lg p-4 flex flex-col items-center transform transition duration-300 hover:scale-105 hover:shadow-2xl animate-fadein-up" style="animation-delay:0.07s;">
                            <div class="text-2xl md:text-3xl mb-2"><i class="ph ph-globe"></i></div>
                            <div class="font-bold text-green-700 mb-1 text-sm md:text-base">Fokus Utama</div>
                            <div class="text-xs md:text-sm text-gray-600 text-center">Pengelolaan Lingkungan Hidup<br>Pembangunan Pertanian Berkelanjutan</div>
                        </div>
                        <div class="rounded-xl bg-white border-2 border-green-200 shadow-lg p-4 flex flex-col items-center transform transition duration-300 hover:scale-105 hover:shadow-2xl animate-fadein-up" style="animation-delay:0.14s;">
                            <div class="text-2xl md:text-3xl mb-2"><i class="ph ph-target"></i></div>
                            <div class="font-bold text-green-700 mb-1 text-sm md:text-base">Target</div>
                            <div class="text-xs md:text-sm text-gray-600 text-center">Pembangunan Berkelanjutan<br>Kesejahteraan Masyarakat Papua Barat</div>
                        </div>
                    </div>

                    <!-- Baris 4: Visi & Misi -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4 mb-4 md:mb-6">
                        <div class="rounded-xl bg-green-50 border border-green-200 p-4 shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-2xl animate-fadein-up text-sm md:text-base" style="animation-delay:0.21s;">
                            <div class="font-bold text-green-800 mb-2">Visi</div>
                            <div>"Mewujudkan Urusan Pengelolaan Lingkungan Hidup dan Sumber Daya Alam Yang Berkeadilan dan berkelanjutan."</div>
                        </div>
                        <div class="rounded-xl bg-green-50 border border-green-200 p-4 shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-2xl animate-fadein-up text-sm md:text-base" style="animation-delay:0.28s;">
                            <div class="font-bold text-green-800 mb-2">Misi</div>
                            <ul class="list-disc list-inside space-y-1">
                                <li>Melaksanakan perumusan kebijakan teknis di bidang lingkungan hidup dan pertanian.</li>
                                <li>Melakukan koordinasi dan sinkronisasi program lingkungan hidup dan pertanian.</li>
                                <li>Melaksanakan pembinaan, pengawasan, dan pengendalian terhadap pelaksanaan kebijakan di bidang lingkungan hidup dan pertanian.</li>
                                <li>Meningkatkan kapasitas sumber daya manusia dan kelembagaan dalam pengelolaan lingkungan hidup dan pertanian.</li>
                                <li>Meningkatkan partisipasi masyarakat dalam perlindungan dan pengelolaan lingkungan hidup serta penataan pertanian.</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Baris 5: Komitmen Kami -->
                    <div class="rounded-2xl bg-gradient-to-br from-[#16a34a] to-[#047857] text-white flex flex-col md:flex-row items-stretch shadow-lg overflow-hidden animate-fadein-up transform transition duration-300 hover:scale-105 hover:shadow-2xl text-sm md:text-base" style="animation-delay:0.35s;">
                        <div class="flex-shrink-0 flex flex-col items-center justify-center p-4 md:p-6 md:w-1/4 bg-white/10">
                            <div class="w-20 h-24 md:w-24 md:h-28 bg-white rounded-lg flex items-center justify-center overflow-hidden mb-2">
                                <img src="/images/kadis.png" alt="Foto Kepala Dinas" class="object-cover w-full h-full" onerror="this.style.display='none'">
                                <span class="text-gray-400 text-xs" style="display:none;">Foto Kepala Dinas</span>
                            </div>
                            <div class="font-semibold text-white text-center">Reymond R.H Yap, SE., MTP</div>
                            <div class="text-xs text-white text-center">Kepala Dinas Lingkungan Hidup dan Pertanahan</div>
                        </div>
                        <div class="flex-1 flex flex-col justify-center p-4 md:p-6">
                            <div class="font-bold text-lg mb-2">Komitmen Kepemimpinan</div>
                            <div class="mb-2">Dinas Lingkungan Hidup dan Pertanian Provinsi Papua Barat siap menjadi mitra bagi seluruh elemen masyarakat, akademisi, dunia usaha, dan instansi terkait lainnya dalam mencapai tujuan bersama: mewujudkan Papua Barat yang hijau, lestari, dan sejahtera. Kami berkomitmen untuk terus meningkatkan kualitas layanan, transparansi, akuntabilitas, efektivitas program, dan akuntabilitas kerja demi terwujudnya lingkungan hidup yang bersih, sehat, dan berkelanjutan untuk seluruh masyarakat.</div>
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
                    <div id="gallery-images" class="gallery-grid"></div>
                    <div id="gallery-pagination" class="berita-pagination"></div>
                    <div id="gallery-status-message" class="text-center text-gray-600 mb-4"></div>
                </div>
            </div>

            <!-- Section Berita -->
            <div id="berita-content" class="main-content-panel h-[calc(100%-4rem)] overflow-y-auto hidden p-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Berita DLHP Papua Barat</h3>
                <div id="berita-list" class="space-y-4"></div>
                <div id="berita-pagination" class="berita-pagination"></div>
            </div>

            <!-- Modal Berita -->
            <div id="berita-modal" class="modal-overlay hidden">
                <div class="modal-content max-w-4xl w-full mx-4">
                    <button class="modal-close-button" onclick="closeBeritaModal()">&times;</button>
                    <div id="berita-modal-content" class="w-full">
                        <!-- Content will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="w-full bg-gray-800 text-gray-200 py-6 mt-10 rounded-t-2xl">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="text-center text-sm">
                &copy; 2025 Dinas Lingkungan Hidup dan Pertanahan Provinsi Papua Barat. Semua Hak Dilindungi.
            </div>
        </div>
    </footer>

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

    <!-- Force Tailwind CDN to generate classes for dynamic pagination -->
    <div class="hidden">
      <div class="flex flex-col items-center gap-2 mt-4"></div>
      <div class="flex justify-center gap-2 items-center"></div>
      <button class="px-3 py-1 rounded bg-gray-200 text-gray-400 cursor-not-allowed"></button>
      <button class="px-3 py-1 rounded bg-gray-200 text-gray-700 hover:bg-green-100"></button>
      <button class="px-3 py-1 rounded bg-green-600 text-white"></button>
      <div class="text-xs text-gray-500 mt-1"></div>
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


        // --- Gallery Image Loading Logic (REGENERATED) ---
        let allGalleryItems = [];
        let galleryPage = 1;
        const galleryPerPage = 6;

        function renderGalleryPage() {
            const galleryImagesContainer = document.getElementById('gallery-images');
            const galleryPagination = document.getElementById('gallery-pagination');
            galleryImagesContainer.innerHTML = '';
            const total = allGalleryItems.length;
            const totalPages = Math.ceil(total / galleryPerPage);
            const start = (galleryPage - 1) * galleryPerPage;
            const end = start + galleryPerPage;
            const pageData = allGalleryItems.slice(start, end);
            pageData.forEach(item => {
                galleryImagesContainer.innerHTML += `
                    <div class="gallery-card" onclick="openImageModal('${item.src}', '${item.title || ''}')">
                        <img src="${item.src}" alt="${item.title || 'Galeri'}">
                        <div class="gallery-card-title">${item.title || ''}</div>
                    </div>
                `;
            });
            // Pagination
            if (galleryPagination) {
                if (totalPages > 1) {
                    let pagBtns = '';
                    for (let i = 1; i <= totalPages; i++) {
                        pagBtns += `<button class="${i === galleryPage ? 'active' : ''}" data-page="${i}">${i}</button>`;
                    }
                    galleryPagination.innerHTML = pagBtns;
                    galleryPagination.querySelectorAll('button').forEach(btn => {
                        btn.addEventListener('click', function() {
                            galleryPage = parseInt(this.dataset.page);
                            renderGalleryPage();
                            galleryImagesContainer.scrollIntoView({behavior: 'smooth'});
                        });
                    });
                } else {
                    galleryPagination.innerHTML = '';
                }
            }
            // Hide status message
            const galleryStatusMessage = document.getElementById('gallery-status-message');
            galleryStatusMessage.innerHTML = '';
        }

        async function loadGalleryImages() {
            console.log('loadGalleryImages dipanggil');
            const galleryImagesContainer = document.getElementById('gallery-images');
            const galleryStatusMessage = document.getElementById('gallery-status-message');

            if (allGalleryItems.length > 0) {
                galleryPage = 1;
                renderGalleryPage();
                return;
            }

            galleryImagesContainer.innerHTML = '';
            galleryStatusMessage.innerText = 'Memuat gambar...';

            const galleryProxyUrl = '/api/galeri-eksternal';
            const dummyImages = [
                { src: 'https://placehold.co/300x200/a7f3d0/065f46?text=DUMMY+1', title: 'Gambar Demo 1' },
                { src: 'https://placehold.co/300x200/6ee7b7/065f46?text=DUMMY+2', title: 'Gambar Demo 2' },
                { src: 'https://placehold.co/300x200/34d399/065f46?text=DUMMY+3', title: 'Gambar Demo 3' },
                { src: 'https://placehold.co/300x200/10b981/065f46?text=DUMMY+4', title: 'Gambar Demo 4' },
            ];

            try {
                console.log('Mencoba fetch dari:', galleryProxyUrl);
                const response = await fetch(galleryProxyUrl, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                });
                
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);
                
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status} - ${response.statusText}`);
                }
                
                const galleryItems = await response.json();
                console.log('Gallery items received:', galleryItems);
                
                if (galleryItems && galleryItems.length > 0) {
                    allGalleryItems = galleryItems;
                    galleryPage = 1;
                    renderGalleryPage();
                    galleryStatusMessage.innerText = '';
                } else {
                    galleryStatusMessage.innerText = 'Tidak ada gambar ditemukan dari sumber eksternal melalui proxy.';
                }
            } catch (error) {
                console.error('Error fetching gallery:', error);
                galleryStatusMessage.innerHTML = `
                    <p class="text-sm text-red-600 mb-2">
                        Gagal memuat galeri dari sumber eksternal melalui proxy: <strong>${error.message}</strong>.
                        <br>Error detail: ${error.toString()}
                        <br>Mohon pastikan backend proxy Laravel sudah diatur dengan benar, berjalan, dan dapat mengakses URL eksternal tersebut.
                    </p>
                    <p>Menampilkan contoh gambar:</p>
                `;
                allGalleryItems = dummyImages;
                galleryPage = 1;
                renderGalleryPage();
            }
        }


        document.addEventListener('DOMContentLoaded', function() {
            fetchSopData();
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
                    if (panelToShowId === 'sop-content') {
                        tabSopBtn.classList.add('active');
                        tabQaBtn.classList.remove('active');
                    } else {
                        tabQaBtn.classList.add('active');
                        tabSopBtn.classList.remove('active');
                    }
                } else {
                    tabsContainer.classList.add('hidden');
                    dynamicHeadlineContainer.classList.remove('hidden');
                    tabSopBtn.classList.remove('active');
                    tabQaBtn.classList.remove('active');

                    if (panelToShowId === 'profil-dinas-content') {
                        dynamicHeadlineText.innerText = 'Profil Dinas';
                    } else if (panelToShowId === 'pengumuman-content') {
                        dynamicHeadlineText.innerText = 'Pengumuman';
                    } else if (panelToShowId === 'galeri-content') {
                        dynamicHeadlineText.innerText = 'Galeri';
                        loadGalleryImages();
                        const galeriPanel = document.getElementById('galeri-content');
                        if (galeriPanel.dataset.needsRender === '1') {
                            renderGalleryPage();
                            delete galeriPanel.dataset.needsRender;
                        }
                    }
                }
            }


            // Event Listeners for Tab Buttons
            tabSopBtn.addEventListener('click', () => {
                showContentPanel('sop-content');
                // Reset tampilan ke kondisi awal
                document.querySelectorAll('.sop-list').forEach(list => list.style.display = 'none');
                sopDetailContent.innerHTML = '<p class="text-center text-gray-500">Pilih bidang di samping untuk melihat rangkuman dan SOP.</p>';
            });
            tabQaBtn.addEventListener('click', () => showContentPanel('qa-content'));

            // Event Listeners for Nav Cards (main navigation)
            navSop.addEventListener('click', () => {
                showContentPanel('sop-content');
                // Reset tampilan ke kondisi awal
                document.querySelectorAll('.sop-list').forEach(list => list.style.display = 'none');
                sopDetailContent.innerHTML = '<p class="text-center text-gray-500">Pilih bidang di samping untuk melihat rangkuman dan SOP.</p>';
            });
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
           

            // Tambahkan rangkuman kerja bidang pertanahan
            const bidangSummaries = {
                "bidang-pertanahan": "Bidang Pertanahan bertugas melaksanakan perumusan dan pelaksanaan kebijakan di bidang pengadaan tanah, penataan, pendaftaran, serta penyelesaian sengketa tanah di wilayah Papua Barat. Fokus utama adalah memastikan proses pengadaan tanah berjalan transparan, adil, dan sesuai peraturan, serta memfasilitasi penyelesaian sengketa tanah secara mediasi dan administratif.",
                "bidang-penataan-penegakan": "Bidang Penataan dan Penegakan Hukum Lingkungan Hidup bertugas menangani penataan ruang dan penegakan hukum di bidang lingkungan hidup, termasuk penerimaan pengaduan, penyusunan dokumen AMDAL, serta pengawasan kepatuhan perizinan dan peraturan lingkungan.",
                "bidang-persampahan": "Bidang Persampahan, B3 Dan Peningkatan Kapasitas Lingkungan Hidup bertugas menyusun dan melaksanakan kebijakan pengelolaan persampahan, limbah B3, serta program peningkatan kapasitas lingkungan hidup di Papua Barat. Fokus pada pengurangan, penanganan sampah, pengelolaan limbah B3, dan edukasi masyarakat untuk meningkatkan kualitas lingkungan.",
                "bidang-laboratorium": "Bidang Laboratorium Lingkungan Hidup bertugas melakukan pengujian dan analisis sampel lingkungan, memberikan hasil uji, dan menyediakan data lingkungan untuk kebijakan dan pengawasan.",
                "laboratorium-lingkungan": "Laboratorium Lingkungan Hidup bertugas melakukan pengujian dan analisis sampel lingkungan, memberikan hasil uji, serta menyediakan data lingkungan untuk mendukung kebijakan dan pengawasan lingkungan hidup di Papua Barat.",
                // ... bidang lain jika perlu ...
            };

            // Initially hide all SOP lists
            document.querySelectorAll('.sop-list').forEach(list => list.style.display = 'none');

            // Pada awal (setelah deklarasi sopDetailContent), tampilkan pesan default
            sopDetailContent.innerHTML = '<p class="text-center text-gray-500">Pilih bidang di samping untuk melihat rangkuman dan SOP.</p>';

            // --- Tambahkan logika toggle dan highlight pada kategori bidang (sop-category) ---
            let lastOpenedCategory = null;
            sopCategories.forEach(category => {
                category.addEventListener('click', function() {
                    const targetCategory = this.dataset.category;
                    const list = document.querySelector(`.sop-list[data-category="${targetCategory}"]`);
                    // Toggle: jika klik dua kali pada bidang yang sama, tutup daftar SOP
                    if (lastOpenedCategory === targetCategory && list && list.style.display === 'block') {
                        list.style.display = 'none';
                        this.classList.remove('bg-green-100', 'font-bold');
                        lastOpenedCategory = null;
                        // Reset detail panel jika ingin
                        // sopDetailContent.innerHTML = '<p class="text-center text-gray-500">Pilih bidang di samping untuk melihat rangkuman dan SOP.</p>';
                        return;
                    }
                    // Sembunyikan semua daftar SOP dan reset highlight
                    document.querySelectorAll('.sop-list').forEach(l => l.style.display = 'none');
                    sopCategories.forEach(cat => cat.classList.remove('bg-green-100', 'font-bold'));
                    // Tampilkan daftar SOP bidang yang diklik dan highlight
                    if (list) {
                        list.style.display = 'block';
                        this.classList.add('bg-green-100', 'font-bold');
                        lastOpenedCategory = targetCategory;
                    }
                    // ... kode rangkuman/narahubung tetap ...
                    if (bidangSummaries[targetCategory]) {
                        const contact = bidangContacts[targetCategory];
                        let contactHtml = '';
                        if (contact) {
                            const whatsappLink = `https://wa.me/${contact.number}?text=Halo%20${encodeURIComponent(contact.contactPerson)}%20dari%20${encodeURIComponent(contact.name)}%2C%20saya%20ingin%20bertanya...`;
                            const qrCodeUrl = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(whatsappLink)}`;
                            contactHtml = `
                                <div class=\"bg-white rounded-lg shadow-sm p-4 mt-4\">
                                    <div class=\"mb-2\">
                                        <span class=\"block text-base font-semibold text-green-800\">${contact.contactPerson}</span>
                                        <span class=\"block text-xs text-gray-700 mb-1\">${contact.role} - ${contact.name}</span>
                                    </div>
                                    <a href=\"${whatsappLink}\" target=\"_blank\"
                                       class=\"inline-flex items-center px-4 py-2 mt-1 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 transition-colors duration-200\">
                                        <i class=\"ph ph-whatsapp-logo text-lg mr-2\"></i>Hubungi via WhatsApp
                                    </a>
                                    <div class=\"flex flex-col items-center mt-3\">
                                        <p class=\"text-xs text-gray-600 mb-1\">Scan QR code ini untuk terhubung di WA</p>
                                        <img src=\"${qrCodeUrl}\" alt=\"WhatsApp QR Code\" class=\"w-24 h-24 border border-gray-300 rounded-lg p-1\">
                                    </div>
                                </div>
                            `;
                        }
                        sopDetailContent.innerHTML = `
                            <div class=\"bg-green-50 border border-green-300 rounded-lg p-5 animate-fadein-up mt-0 mb-2\">
                                <h4 class=\"text-xl font-bold text-green-800 mb-1\">Selamat Datang di ${contact ? contact.name : ''},</h4>
                                <p class=\"text-green-700 text-sm mb-3\">${bidangSummaries[targetCategory]}</p>
                                ${contactHtml}
                            </div>
                        `;
                        sopActions.classList.add('hidden');
                        sopWhatsappAction.classList.add('hidden');
                    }
                });
            });

            // Handle SOP item click
            sopLists.forEach(item => {
                item.addEventListener('click', function() {
                    const sopId = item.dataset.sopId;
                    const sop = sops[sopId];
                    if (sop) {
                        if (sop.faq) {
                            let faqHtml = '<div class="space-y-3">';
                            sop.faq.forEach((f, idx) => {
                                faqHtml += `
                                    <div class="faq-card border rounded-lg shadow-sm bg-white">
                                        <button type="button" class="w-full text-left px-4 py-3 font-semibold text-green-800 focus:outline-none flex justify-between items-center faq-question" data-faq-idx="${idx}">
                                            <span>${f.q}</span>
                                            <span class="faq-arrow transition-transform">&#9660;</span>
                                        </button>
                                        <div class="faq-answer px-4 pb-3 text-gray-700 hidden">
                                            ${f.a}
                                        </div>
                                    </div>
                                `;
                            });
                            faqHtml += '</div>';
                            sopDetailContent.innerHTML = `
                                <h4 class="text-xl font-semibold text-green-800 mb-2">${sop.title}</h4>
                                <p class="text-sm text-gray-600 mb-4">${sop.content}</p>
                                ${faqHtml}
                                <p class="text-gray-600 text-xs mt-4">Sumber: Dinas Lingkungan Hidup dan Pertanahan</p>
                            `;

                            // Pasang event click accordion (bisa buka/tutup independen)
                            sopDetailContent.querySelectorAll('.faq-question').forEach(btn => {
                                btn.addEventListener('click', function() {
                                    const answer = this.parentElement.querySelector('.faq-answer');
                                    const arrow = this.querySelector('.faq-arrow');
                                    if (answer.classList.contains('hidden')) {
                                        answer.classList.remove('hidden');
                                        arrow.style.transform = 'rotate(180deg)';
                                    } else {
                                        answer.classList.add('hidden');
                                        arrow.style.transform = '';
                                    }
                                });
                            });
                        } else {
                            sopDetailContent.innerHTML = `
                                <h4 class="text-xl font-semibold text-green-800 mb-2">${sop.title}</h4>
                                <p class="text-gray-700 text-base mb-4">${sop.content}</p>
                                <p class="text-gray-600 text-xs">Sumber: Dinas Lingkungan Hidup dan Pertanahan</p>
                            `;
                        }
                        sopActions.classList.add('hidden');
                        sopWhatsappAction.classList.add('hidden');
                    } else {
                        sopDetailContent.innerHTML = '<p class="text-center text-gray-500">SOP tidak ditemukan.</p>';
                        sopActions.classList.add('hidden');
                        sopWhatsappAction.classList.add('hidden');
                    }
                });
            });

            // Handle mobile unit selection for SOPs
            sopUnitSelectMobile.addEventListener('change', function() {
                const selectedCategory = this.value;
                // Sembunyikan semua daftar SOP
                document.querySelectorAll('.sop-list').forEach(list => list.style.display = 'none');
                // Reset highlight pada kategori desktop
                sopCategories.forEach(cat => cat.classList.remove('bg-green-100', 'font-bold'));

                // Tampilkan daftar SOP sesuai bidang yang dipilih
                if (selectedCategory !== 'all') {
                    const list = document.querySelector(`.sop-list[data-category="${selectedCategory}"]`);
                    if (list) list.style.display = 'block';
                }

                // Tampilkan rangkuman dan narahubung seperti di desktop
                if (bidangSummaries[selectedCategory]) {
                    const contact = bidangContacts[selectedCategory];
                    let contactHtml = '';
                    if (contact) {
                        const whatsappLink = `https://wa.me/${contact.number}?text=Halo%20${encodeURIComponent(contact.contactPerson)}%20dari%20${encodeURIComponent(contact.name)}%2C%20saya%20ingin%20bertanya...`;
                        const qrCodeUrl = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(whatsappLink)}`;
                        contactHtml = `
                            <div class="bg-white rounded-lg shadow-sm p-4 mt-4">
                                <div class="mb-2">
                                    <span class="block text-base font-semibold text-green-800">${contact.contactPerson}</span>
                                    <span class="block text-xs text-gray-700 mb-1">${contact.role} - ${contact.name}</span>
                                </div>
                                <a href="${whatsappLink}" target="_blank"
                                   class="inline-flex items-center px-4 py-2 mt-1 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 transition-colors duration-200">
                                    <i class="ph ph-whatsapp-logo text-lg mr-2"></i>Hubungi via WhatsApp
                                </a>
                                <div class="flex flex-col items-center mt-3">
                                    <p class="text-xs text-gray-600 mb-1">Scan QR code ini untuk terhubung di WA</p>
                                    <img src="${qrCodeUrl}" alt="WhatsApp QR Code" class="w-24 h-24 border border-gray-300 rounded-lg p-1">
                                </div>
                            </div>
                        `;
                    }
                    sopDetailContent.innerHTML = `
                        <div class="bg-green-50 border border-green-300 rounded-lg p-5 animate-fadein-up mt-0 mb-2">
                            <h4 class="text-xl font-bold text-green-800 mb-1">Selamat Datang di ${contact ? contact.name : ''},</h4>
                            <p class="text-green-700 text-sm mb-3">${bidangSummaries[selectedCategory]}</p>
                            ${contactHtml}
                        </div>
                    `;
                    sopActions.classList.add('hidden');
                    sopWhatsappAction.classList.add('hidden');
                } else {
                    sopDetailContent.innerHTML = '<p class="text-center text-gray-500">Pilih bidang di samping untuk melihat rangkuman dan SOP.</p>';
                }

                // Tampilkan daftar SOP di bawah dropdown (khusus mobile)
                const sopListMobile = document.getElementById('sop-list-mobile');
                sopListMobile.innerHTML = '';
                if (selectedCategory !== 'all') {
                    // Temukan semua SOP yang bidang_id-nya sesuai
                    const bidangMap = {
                        'bidang-pertanahan': 1,
                        'bidang-persampahan': 2,
                        'bidang-penataan-penegakan': 3,
                        'bidang-pengendalian-pencemaran': 4,
                        'laboratorium-lingkungan': 5,
                        'umum-bidang': 6
                    };
                    const bidangId = bidangMap[selectedCategory];
                    const sopItems = Object.entries(sops).filter(([key, sop]) => sop.bidang_id == bidangId);

                    if (sopItems.length > 0) {
                        sopListMobile.innerHTML = sopItems.map(([key, sop]) =>
                            `<div class="sop-mobile-item" data-sop-id="${key}">
                                <i class=\"ph ph-file-text text-base mr-2\"></i>${sop.title}
                            </div>`
                        ).join('');
                        // Pasang event click
                        sopListMobile.querySelectorAll('[data-sop-id]').forEach(item => {
                            item.addEventListener('click', function() {
                                // Hapus highlight dari semua
                                sopListMobile.querySelectorAll('.sop-mobile-item').forEach(i => i.classList.remove('active'));
                                // Highlight yang diklik
                                this.classList.add('active');
                                showSopDetail(this.dataset.sopId);
                            });
                        });
                    }
                }
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

            // Variables for berita functionality
            window.beritaData = [];
            let beritaPage = 1;
            const beritaPerPage = 4;

            // Tambahkan event listener untuk tombol Berita
            const navBerita = document.getElementById('nav-berita');
            if (navBerita) {
                navBerita.addEventListener('click', () => {
                    showContentPanel('berita-content');
                    beritaPage = 1;
                    loadBerita();
                });
            }
            // Fungsi fetch dan render berita
            async function loadBerita() {
                const beritaList = document.getElementById('berita-list');
                const beritaPagination = document.getElementById('berita-pagination');
                beritaList.innerHTML = 'Memuat berita...';
                beritaPagination.innerHTML = '';
                try {
                    const res = await fetch('/api/berita-dlhp');
                    const data = await res.json();
                    if (!Array.isArray(data) || data.length === 0) {
                        beritaList.innerHTML = '<p class="text-gray-500">Belum ada berita.</p>';
                        return;
                    }
                    window.beritaData = data;
                    renderBeritaPage();
                } catch (e) {
                    beritaList.innerHTML = '<p class="text-red-600">Gagal memuat berita.</p>';
                }
            }
            function renderBeritaPage() {
                const beritaList = document.getElementById('berita-list');
                const beritaPagination = document.getElementById('berita-pagination');
                const total = window.beritaData.length;
                const totalPages = Math.ceil(total / beritaPerPage);
                const start = (beritaPage - 1) * beritaPerPage;
                const end = start + beritaPerPage;
                const pageData = window.beritaData.slice(start, end);
                beritaList.innerHTML = pageData.map((b, index) => `
                    <div class="berita-card cursor-pointer" onclick="showBeritaDetail(${start + index})">
                        ${b.gambar ? `<img src="${b.gambar}" class="w-20 h-20 object-cover rounded-lg float-left mr-4 mb-2" alt="Thumbnail Berita">` : ''}
                        <h4 class="font-bold text-green-800 mb-1 text-base md:text-lg">${b.judul}</h4>
                        <p class="text-xs text-gray-500 mb-2">${b.tanggal || ''}</p>
                        <p class="text-gray-700 mb-2 line-clamp-3">${b.ringkasan || ''}</p>
                        <span class="text-green-600 hover:underline font-semibold text-sm">Baca Selengkapnya</span>
                    </div>
                `).join('');
                // Pagination
                if (totalPages > 1) {
                    let pagBtns = '';
                    for (let i = 1; i <= totalPages; i++) {
                        pagBtns += `<button class="${i === beritaPage ? 'active' : ''}" data-page="${i}">${i}</button>`;
                    }
                    beritaPagination.innerHTML = pagBtns;
                    beritaPagination.querySelectorAll('button').forEach(btn => {
                        btn.addEventListener('click', function() {
                            beritaPage = parseInt(this.dataset.page);
                            renderBeritaPage();
                            beritaList.scrollIntoView({behavior: 'smooth'});
                        });
                    });
                } else {
                    beritaPagination.innerHTML = '';
                }
            }



            // Tutup modal ketika klik di luar modal
            document.addEventListener('click', function(event) {
                const modal = document.getElementById('berita-modal');
                const modalContent = modal.querySelector('.modal-content');
                
                if (event.target === modal) {
                    closeBeritaModal();
                }
            });
        });

    

        let sops = {};

        async function fetchSopData() {
            const sopRes = await fetch('/api/sop');
            const sopData = await sopRes.json();
            sops = {};
            sopData.forEach(sop => {
                sops[sop.slug || sop.id] = {
                    title: sop.judul,
                    content: sop.deskripsi,
                    bidang_id: sop.bidang_id,
                    file: sop.file, // tambahkan baris ini
                    faq: sop.faqs ? sop.faqs.map(f => ({ q: f.pertanyaan, a: f.jawaban })) : []
                };
            });
            renderSopList();
        }

        function renderSopList() {
            // Mapping kategori sidebar ke bidang_id di database
            const bidangMap = {
                'bidang-pertanahan': 1,
                'bidang-persampahan': 2,
                'bidang-penataan-penegakan': 3,
                'bidang-pengendalian-pencemaran': 4,
                'laboratorium-lingkungan': 5,
                'umum-bidang': 6
            };
            Object.entries(bidangMap).forEach(([kategori, bidangId]) => {
                const list = document.querySelector(`.sop-list[data-category="${kategori}"]`);
                if (!list) return;
                list.innerHTML = '';
                Object.entries(sops).forEach(([key, sop]) => {
                    if (sop.bidang_id == bidangId) {
                        const li = document.createElement('li');
                        li.className = 'py-1 flex items-center cursor-pointer hover:text-green-700';
                        li.dataset.sopId = key;
                        li.innerHTML = `<i class="ph ph-file-text text-base mr-2"></i>${sop.title}`;
                        li.addEventListener('click', function() {
                            // Hapus highlight dari semua SOP di semua kategori
                            document.querySelectorAll('.sop-list li').forEach(i => i.classList.remove('active'));
                            // Highlight yang diklik
                            this.classList.add('active');
                            showSopDetail(key);
                        });
                        list.appendChild(li);
                    }
                });
            });
        }

        function showSopDetail(sopId) {
            const sop = sops[sopId];
            const sopDetailContent = document.getElementById('sop-detail-content');
            if (sop && sop.faq && sop.faq.length > 0) {
                let faqHtml = '<div class="space-y-3">';
                sop.faq.forEach((f, idx) => {
                    faqHtml += `
                        <div class="faq-card border rounded-lg shadow-sm bg-white">
                            <button type="button" class="w-full text-left px-4 py-3 font-semibold text-green-800 focus:outline-none flex justify-between items-center faq-question" data-faq-idx="${idx}">
                                <span>${f.q}</span>
                                <span class="faq-arrow transition-transform">&#9660;</span>
                            </button>
                            <div class="faq-answer px-4 pb-3 text-gray-700 hidden">
                                ${f.a}
                            </div>
                        </div>
                    `;
                });
                faqHtml += '</div>';
                let downloadBtn = '';
                if (sop.file) {
                    downloadBtn = `
                        <a href="${sop.file}" download target="_blank"
                           class="block w-full mt-6 border border-green-500 rounded-lg px-4 py-3 text-center text-green-700 font-semibold hover:bg-green-50 transition-colors duration-200 flex items-center justify-center gap-2">
                            <svg xmlns='http://www.w3.org/2000/svg' class='inline-block' width='20' height='20' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3'/></svg>
                            Unduh SOP (PDF)
                        </a>
                    `;
                }
                sopDetailContent.innerHTML = `
                    <h4 class="text-xl font-semibold text-green-800 mb-2">${sop.title}</h4>
                    <p class="text-sm text-gray-600 mb-4">${sop.content}</p>
                    ${faqHtml}
                    ${downloadBtn}
                    <p class="text-gray-600 text-xs mt-4">Sumber: Dinas Lingkungan Hidup dan Pertanahan</p>
                `;

                // Pasang event click accordion (bisa buka/tutup independen)
                sopDetailContent.querySelectorAll('.faq-question').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const answer = this.parentElement.querySelector('.faq-answer');
                        const arrow = this.querySelector('.faq-arrow');
                        if (answer.classList.contains('hidden')) {
                            answer.classList.remove('hidden');
                            arrow.style.transform = 'rotate(180deg)';
                        } else {
                            answer.classList.add('hidden');
                            arrow.style.transform = '';
                        }
                    });
                });
            } else if (sop) {
                sopDetailContent.innerHTML = `
                    <h4 class="text-xl font-semibold text-green-800 mb-2">${sop.title}</h4>
                    <p class="text-sm text-gray-600 mb-4">${sop.content}</p>
                    <p class="text-gray-600 text-xs">Sumber: Dinas Lingkungan Hidup dan Pertanahan</p>
                `;
            } else {
                sopDetailContent.innerHTML = '<p class="text-center text-gray-500">SOP tidak ditemukan.</p>';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            fetchSopData();
            // ... kode lain ...
        });

        // Tambahkan kembali data hardcoded untuk SOP dan FAQ
        

        

        // Pada load awal, tampilkan Bidang Pertanahan dan SOP-nya
        const listPertanahan = document.querySelector('.sop-list[data-category="bidang-pertanahan"]');
        if (listPertanahan) listPertanahan.style.display = 'block';
        if (typeof renderSopList === 'function') renderSopList();

        // Event click untuk semua SOP di sidebar
        document.querySelectorAll('.sop-list li').forEach(item => {
            item.addEventListener('click', function() {
                // Hapus highlight dari semua SOP di semua kategori
                document.querySelectorAll('.sop-list li').forEach(i => i.classList.remove('active'));
                // Highlight yang diklik
                this.classList.add('active');
                const sopId = this.dataset.sopId;
                showSopDetail(sopId);
            });
        });
    </script>
</body>
</html>
