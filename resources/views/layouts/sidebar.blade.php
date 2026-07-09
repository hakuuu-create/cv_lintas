<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Lintas Tech</title>
    <script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@7.3.0/css/all.min.css" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
    @stack('styles')
</head>

<body class="h-full flex overflow-hidden font-sans">

    <div id="sidebar-backdrop"
        class="fixed inset-0 bg-slate-900/40 z-30 hidden md:hidden transition-opacity duration-300 opacity-0"></div>

    <aside id="sidebar"
        class="fixed inset-y-0 left-0 w-64 bg-neutral-900 text-white flex flex-col justify-between z-40 shadow-xl
        -translate-x-full transition-transform duration-300 ease-in-out
        md:relative md:translate-x-0 md:flex">

        {{-- HEADER SIDEBAR --}}
        <div>
            <div class="h-16 flex items-center justify-between px-6 bg-black border-b border-neutral-800">
                <div class="flex items-center gap-2.5">
                    <img src="{{ asset('img/logo.webp') }}" alt="Logo"
                        class="w-8 h-8 object-contain rounded bg-neutral-900/40 p-0.5">
                    <span class="font-bold tracking-tight text-lg">Lintas Tech</span>
                </div>
                <button id="close-sidebar-btn" class="text-neutral-400 hover:text-white md:hidden focus:outline-none">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            {{-- NAVIGASI --}}
            <nav class="mt-4 px-3 space-y-0.5">

    {{-- Dashboard --}}
    <a href="{{ route('admin.dashboard') }}"
        class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-md transition-all duration-150
        {{ Route::is('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-neutral-300 hover:bg-neutral-800' }}">
        <i class="fa-solid fa-gauge-high w-4 text-center"></i>
        Dashboard
    </a>

    <div class="pt-3 pb-1 px-4">
        <p class="text-[10px] font-bold uppercase tracking-widest text-neutral-500">Manajemen Konten</p>
    </div>

    {{-- Profil Perusahaan (landing page) --}}
    <a href="{{ route('admin.profil.index') }}"
        class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-md transition-all duration-150
        {{ Route::is('admin.profil.*') ? 'bg-blue-600 text-white' : 'text-neutral-300 hover:bg-neutral-800' }}">
        <i class="fa-solid fa-building-user w-4 text-center"></i>
        Profil Perusahaan
    </a>

    {{-- Layanan --}}
    <a href="{{ route('admin.layanan.index') }}"
        class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-md transition-all duration-150
        {{ Route::is('admin.layanan.*') ? 'bg-blue-600 text-white' : 'text-neutral-300 hover:bg-neutral-800' }}">
        <i class="fa-solid fa-briefcase w-4 text-center"></i>
        Layanan
    </a>

    {{-- Portofolio --}}
    <a href="{{ route('admin.portofolio.index') }}"
        class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-md transition-all duration-150
        {{ Route::is('admin.portofolio.*') ? 'bg-blue-600 text-white' : 'text-neutral-300 hover:bg-neutral-800' }}">
        <i class="fa-solid fa-clipboard-list w-4 text-center"></i>
        Portofolio
    </a>

    {{-- Kreator --}}
    <a href="{{ route('admin.kreator.index') }}"
        class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-md transition-all duration-150
        {{ Route::is('admin.kreator.*') ? 'bg-blue-600 text-white' : 'text-neutral-300 hover:bg-neutral-800' }}">
        <i class="fa-solid fa-clapperboard w-4 text-center"></i>
        Kreator
    </a>

</nav>
        </div>

        {{-- FOOTER SIDEBAR (User Info + Logout) --}}
<div class="p-4 bg-black/60 border-t border-neutral-800">

    {{-- User Info --}}
    <div class="flex items-center justify-between mb-3">
        <div class="flex items-center min-w-0 gap-2.5">
            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center font-bold text-white uppercase ring-2 ring-blue-500 shrink-0 text-xs">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="truncate">
                <p class="text-xs font-semibold truncate text-white">{{ Auth::user()->name }}</p>
                <p class="text-[9px] text-neutral-400 font-bold uppercase tracking-wider">
                    {{ Auth::user()->role ?? 'Admin' }}
                </p>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST" class="shrink-0">
            @csrf
            <button type="submit"
                class="text-neutral-400 hover:text-red-400 p-1.5 rounded transition-colors"
                title="Keluar">
                <i class="fa-solid fa-power-off text-sm"></i>
            </button>
        </form>
    </div>

    {{-- Tombol Pengaturan Profil --}}
    <a href="{{ route('admin.pengaturan.edit') }}"
        class="flex items-center gap-2.5 px-3 py-2 rounded-lg transition-all duration-150 w-full
        {{ Route::is('admin.pengaturan.*') ? 'bg-blue-600 text-white' : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}">
        <i class="fa-solid fa-gear text-sm"></i>
        <span class="text-xs font-semibold">Pengaturan Profil</span>
    </a>

</div>
    </aside>

    {{-- KONTEN UTAMA --}}
    <div class="flex-1 flex flex-col overflow-hidden w-full">

        {{-- TOPBAR --}}
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 sm:px-6 z-10 shrink-0">
            <div class="flex items-center overflow-hidden mr-2">
                <button id="open-sidebar-btn"
                    class="text-slate-500 hover:text-slate-700 md:hidden mr-3 focus:outline-none p-1">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <h2 class="text-base font-bold text-slate-900 tracking-tight truncate">@yield('page_title')</h2>
            </div>
            <div class="text-xs text-slate-400 font-medium hidden sm:block whitespace-nowrap">
                <i class="fa-regular fa-calendar-days mr-1.5"></i>
                {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}
            </div>
        </header>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 overflow-x-hidden overflow-y-auto p-4 sm:p-6 bg-slate-50">
            @yield('content')
        </main>
    </div>

    <script>
        const sidebar   = document.getElementById('sidebar');
        const backdrop  = document.getElementById('sidebar-backdrop');
        const openBtn   = document.getElementById('open-sidebar-btn');
        const closeBtn  = document.getElementById('close-sidebar-btn');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            backdrop.classList.remove('hidden');
            setTimeout(() => backdrop.classList.add('opacity-100'), 20);
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            backdrop.classList.remove('opacity-100');
            setTimeout(() => backdrop.classList.add('hidden'), 300);
        }

        openBtn.addEventListener('click', openSidebar);
        closeBtn.addEventListener('click', closeSidebar);
        backdrop.addEventListener('click', closeSidebar);
    </script>

    @stack('scripts')
</body>
</html>
