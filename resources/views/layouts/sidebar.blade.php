<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Lintas tech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>

<body class="h-full flex overflow-hidden font-sans">

    <div id="sidebar-backdrop"
        class="fixed inset-0 bg-slate-900/40 z-30 hidden md:hidden transition-opacity duration-300 opacity-0"></div>

    <aside id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-neutral-900 text-white flex flex-col justify-between z-40 shadow-xl 
        -translate-x-full transition-transform duration-300 ease-in-out
        md:relative md:translate-x-0 md:flex">

        <div>
            <div class="h-16 flex items-center justify-between px-6 bg-black border-b border-neutral-800">
                <div class="flex items-center">
                    <img src="{{ asset('img/logo.webp') }}" alt="Logo Ponpes"
                        class="w-8 h-8 object-contain mr-2.5 rounded bg-neutral-900/40 p-0.5">
                    <span class="font-bold tracking-tight text-lg">Lintas Tech</span>
                </div>
                <button id="close-sidebar-btn" class="text-neutral-400 hover:text-white md:hidden focus:outline-none">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <nav class="mt-6 px-4 space-y-1 overflow-y-auto max-h-[calc(100vh-10rem)]">

                {{-- Dashboard --}}
                {{-- <a href="{{ route('media.dashboard') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all duration-150 {{ Route::is('admin.media.dashboard') ? 'bg-neutral-800 text-white shadow-inner' : 'text-neutral-300 hover:bg-neutral-800/50' }}">
                    <i class="fa-solid fa-chart-pie mr-3 text-base"></i> Dashboard
                </a> --}}

                {{-- Profil --}}
                <a href="{{ route('media.profil.edit') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all duration-150 {{ Route::is('admin.media.profil.edit') ? 'bg-neutral-800 text-white shadow-inner' : 'text-neutral-300 hover:bg-neutral-800/50' }}">
                    <i class="fa-solid fa-building-user mr-3 text-base"></i> Profil
                </a>

                {{-- Daftar Card--}}
                <a href="{{ route('portofolio.index') }}"
                    class="flex items
                    -center px-4 py-3 text-sm font-medium rounded-md transition-all duration-150 {{ Route::is('admin.media.kegiatan.index') ? 'bg-neutral-800 text-white shadow-inner' : 'text-neutral-300 hover:bg-neutral-800/50' }}">
                    <i class="fa-solid fa-clipboard-list mr-3 text-base"></i> Daftar Portofolio
                </a>

                {{-- Creator --}}
                <a href="{{ route('media.creator.edit') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all duration-150 {{ Route::is('admin.media.kreator.edit') ? 'bg-neutral-800 text-white shadow-inner' : 'text-neutral-300 hover:bg-neutral-800/50' }}">
                    <i class="fa-solid fa-clapperboard mr-3 text-base"></i> Kreator
                </a>
            </nav>
        </div>

        <div class="p-4 bg-black/60 border-t border-neutral-800 flex items-center justify-between">
            <div class="flex items-center min-w-0 gap-3">
                <div
                    class="w-9 h-9 bg-neutral-800 rounded-full flex items-center justify-center font-bold text-neutral-200 uppercase ring-2 ring-neutral-700 shrink-0">
                    <img src="https://media.tenor.com/ngY5lNArvSIAAAAe/catboss.png" alt="profile" class="rounded-full">
                </div>
                <div class="truncate">
                    <p class="text-xs font-semibold truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[9px] text-neutral-400 font-bold uppercase tracking-wider">
                        {{ Auth::user()->roles->pluck('name')->first() ?? 'User' }}
                    </p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="shrink-0">
                @csrf
                <button type="submit" class="text-neutral-400 hover:text-red-400 p-2 rounded transition-colors"
                    title="Keluar">
                    <i class="fa-solid fa-power-off"></i>
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col overflow-hidden w-full">
        <header
            class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 sm:px-6 z-10 shrink-0">
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

        <main class="flex-1 overflow-x-hidden overflow-y-auto p-4 sm:p-6 bg-slate-50">
            @yield('content')
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        const openBtn = document.getElementById('open-sidebar-btn');
        const closeBtn = document.getElementById('close-sidebar-btn');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            backdrop.classList.remove('hidden');
            setTimeout(() => {
                backdrop.classList.add('opacity-100');
            }, 20);
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            backdrop.classList.remove('opacity-100');
            setTimeout(() => {
                backdrop.classList.add('hidden');
            }, 300); // Sinkron dengan durasi Tailwind duration-300
        }

        openBtn.addEventListener('click', openSidebar);
        closeBtn.addEventListener('click', closeSidebar);
        backdrop.addEventListener('click', closeSidebar);
    </script>

</body>

</html>