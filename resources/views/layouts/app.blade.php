<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SILKAT - Sistem Layanan Kantor Terpadu</title>
    <link href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.0.3/src/phosphor.css" rel="stylesheet">
    <link href="/build/assets/app.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex flex-col min-h-screen">
        <!-- Header -->
        <header class="bg-gradient-to-r from-green-700 via-green-600 to-green-500 shadow-lg py-4 px-2 md:px-8 flex flex-col items-center">
            <img src="/images/pabar.png" alt="Papua Barat Logo" class="w-20 h-20 mb-2 rounded bg-white shadow-md object-contain" />
            <h1 class="text-white text-xl md:text-2xl font-bold text-center tracking-wide">DINAS LINGKUNGAN HIDUP DAN PERTANAHAN</h1>
            <h2 class="text-white text-lg md:text-xl font-semibold text-center tracking-wide">PROVINSI PAPUA BARAT</h2>
            <p class="text-white text-sm md:text-base text-center mt-1">Jl. Brigjen (Purn) Abraham O Atururi Kompleks Perkantoran Gubernur Arfai</p>
        </header>
        <!-- Main Layout -->
        <div class="flex flex-1 w-full max-w-screen-2xl mx-auto">
            <!-- Sidebar -->
            <aside class="w-20 md:w-64 bg-white shadow-lg flex flex-col py-6 px-2 md:px-4 gap-4">
                <nav class="flex flex-col gap-4">
                    <a href="{{ route('sop') }}" class="group flex items-center gap-3 p-3 rounded-lg bg-gradient-to-r from-green-100 to-green-200 shadow hover:from-green-200 hover:to-green-300 hover:scale-105 transition-all">
                        <i class="ph ph-list-dashes text-green-700 text-2xl"></i>
                        <span class="hidden md:inline font-semibold text-green-900">SOP Layanan</span>
                    </a>
                    <a href="{{ route('qna') }}" class="group flex items-center gap-3 p-3 rounded-lg bg-gradient-to-r from-green-100 to-green-200 shadow hover:from-green-200 hover:to-green-300 hover:scale-105 transition-all">
                        <i class="ph ph-chat-circle-dots text-green-700 text-2xl"></i>
                        <span class="hidden md:inline font-semibold text-green-900">Tanya Jawab</span>
                    </a>
                    <a href="{{ route('profile') }}" class="group flex items-center gap-3 p-3 rounded-lg bg-gradient-to-r from-green-100 to-green-200 shadow hover:from-green-200 hover:to-green-300 hover:scale-105 transition-all">
                        <i class="ph ph-buildings text-green-700 text-2xl"></i>
                        <span class="hidden md:inline font-semibold text-green-900">Profil Dinas</span>
                    </a>
                    <a href="{{ route('announcements') }}" class="group flex items-center gap-3 p-3 rounded-lg bg-gradient-to-r from-green-100 to-green-200 shadow hover:from-green-200 hover:to-green-300 hover:scale-105 transition-all">
                        <i class="ph ph-megaphone text-green-700 text-2xl"></i>
                        <span class="hidden md:inline font-semibold text-green-900">Pengumuman</span>
                    </a>
                    <a href="{{ route('gallery') }}" class="group flex items-center gap-3 p-3 rounded-lg bg-gradient-to-r from-green-100 to-green-200 shadow hover:from-green-200 hover:to-green-300 hover:scale-105 transition-all">
                        <i class="ph ph-images text-green-700 text-2xl"></i>
                        <span class="hidden md:inline font-semibold text-green-900">Galeri</span>
                    </a>
                </nav>
            </aside>
            <!-- Content Area -->
            <main class="flex-1 p-4 md:p-8 bg-gray-50 min-h-[80vh]">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
