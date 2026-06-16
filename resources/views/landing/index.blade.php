<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Lintas Tech Artomoro — Solusi Digital & Teknologi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="icon" href="{{ asset('img/logo.webp') }}" type="image/webp">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FFFFFF',
                        secondary: '#A3A3A3',
                        tertiary: '#374151',
                        neutral: '#000000',
                        surface: '#111111',
                        'primary-90': '#F5F5F5',
                        'neutral-80': '#1A1A1A',
                    },
                    borderRadius: {
                        'framer-sm': '4px',
                        'framer-md': '8px',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        /* Tipografi Editorial Kustom sesuai Spesifikasi */
        .headline-display {
            font-size: clamp(3.5rem, 8vw, 5.25rem);
            /* Hingga 84px */
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -0.05em;
        }

        .headline-lg {
            font-size: clamp(2.25rem, 5vw, 3.4rem);
            /* Hingga 55px */
            font-weight: 700;
            line-height: 1.2;
            letter-spacing: -0.03em;
        }

        .headline-md {
            font-size: clamp(1.5rem, 3vw, 2.18rem);
            /* Hingga 35px */
            font-weight: 500;
            line-height: 1.2;
            letter-spacing: -0.02em;
        }

        .headline-sm {
            font-size: 1.43rem;
            /* 23px */
            font-weight: 500;
            line-height: 1.2;
            letter-spacing: 0em;
        }

        .body-lg {
            font-size: 1.125rem;
            /* 18px */
            line-height: 1.55;
            letter-spacing: -0.01em;
        }

        .body-md {
            font-size: 0.93rem;
            /* 15px */
            line-height: 1.53;
            letter-spacing: -0.01em;
        }

        /* Mekanisme Scroll Triggered Animation */
        .tunggu-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 2s cubic-bezier(0.16, 1, 0.3, 1) !important;
        }

        .muncul-scroll {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
    </style>
</head>

@include('layouts.background')

<body class="bg-neutral text-primary antialiased selection:bg-primary selection:text-neutral">

    {{-- LOADING SCREEN --}}
    <div id="loading-screen"
        class="fixed inset-0 z-[9999] bg-neutral flex flex-col items-center justify-center gap-8 transition-opacity duration-700">

        <div class="flex flex-col items-center gap-4">
            <div class="text-center space-y-1">
                <p class="text-secondary font-semibold text-xs tracking-[0.2em] uppercase">CV Lintas Tech</p>
                <p class="text-3xl font-extrabold text-primary uppercase tracking-tight">
                    Artomoro
                </p>
            </div>
        </div>

        <div class="w-48 h-[2px] bg-tertiary rounded-none overflow-hidden">
            <div id="loading-bar" class="h-full w-0 bg-primary transition-all ease-out"
                style="transition-duration: 0ms;">
            </div>
        </div>

        <p id="loading-label" class="text-secondary text-[10px] font-medium uppercase tracking-[0.15em]">
            Memuat aset...
        </p>
    </div>
    {{-- END LOADING SCREEN --}}

    {{-- NAVBAR --}}
    <nav
        class="fixed left-0 right-0 top-0 z-50 bg-neutral/85 backdrop-blur-md border-b border-tertiary transition-all duration-300">
        <div class="max-w-7xl mx-auto h-16 px-6 md:px-10 flex items-center justify-between">

            <div class="flex items-center gap-3">
                <span class="font-extrabold text-sm tracking-tight text-primary uppercase">
                    Lintas Tech
                </span>
            </div>

            <div class="hidden md:flex items-center gap-8">
                <a href="#beranda"
                    class="text-xs uppercase tracking-wider font-medium text-secondary hover:text-primary transition-colors">
                    Beranda
                </a>
                <a href="#profil"
                    class="text-xs uppercase tracking-wider font-medium text-secondary hover:text-primary transition-colors">
                    Profil
                </a>
                <a href="#layanan"
                    class="text-xs uppercase tracking-wider font-medium text-secondary hover:text-primary transition-colors">
                    Layanan
                </a>
                <a href="#portofolio"
                    class="text-xs uppercase tracking-wider font-medium text-secondary hover:text-primary transition-colors">
                    Portofolio
                </a>
                <a href="#kreator"
                    class="text-xs uppercase tracking-wider font-medium text-secondary hover:text-primary transition-colors">
                    Kreator
                </a>
                <a href="#alur-kerja"
                    class="text-xs uppercase tracking-wider font-medium text-secondary hover:text-primary transition-colors">
                    Alur Kerja
                </a>
            </div>

            <div>
                <a href="#kontak"
                    class="h-10 px-5 inline-flex items-center justify-center bg-primary text-neutral text-xs font-semibold rounded-framer-sm hover:bg-primary-90 transition-colors uppercase tracking-wider">
                    Hubungi Kami
                </a>
            </div>

        </div>
    </nav>

    {{-- HEADER --}}
    <header id="beranda"
        class="min-h-screen flex flex-col items-center justify-center px-6 text-center max-w-5xl mx-auto pt-20 scroll-mt-20">
        <div class="flex flex-col items-center space-y-4">
            <p class="text-xs text-secondary uppercase tracking-[0.2em] font-semibold">Transformasi Bisnis Digital</p>
            @if ($profil && $profil->logo_perusahaan)
                <img src="{{ asset('storage/' . $profil->logo_perusahaan) }}" alt="Logo"
                    class="w-24 h-24 object-contain drop-shadow-2xl rounded-2xl">
            @else
                <img src="{{ asset('img/logo.webp') }}" alt="Logo"
                    class="w-24 h-24 object-contain drop-shadow-2xl rounded-2xl">
            @endif
            <h1 class="headline-display text-primary uppercase">
                CV LINTAS TECH <br>
                <span class="text-secondary">ARTOMORO</span>
            </h1>
        </div>

        <p class="mt-8 body-lg text-secondary max-w-2xl">
            Sistem pengembangan digital premium beresolusi tinggi. Solusi terpercaya untuk pembuatan website,
            optimalisasi mesin pencari, dan manajemen media sosial terintegrasi.
        </p>

        <div class="mt-10 flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
            <a href="#layanan"
                class="h-10 px-6 inline-flex items-center justify-center bg-primary text-neutral text-sm font-semibold rounded-framer-sm hover:bg-primary-90 transition-colors uppercase tracking-wide">
                Layanan
            </a>
            <a href="#kontak"
                class="h-10 px-6 inline-flex items-center justify-center bg-transparent text-primary border border-tertiary text-sm font-semibold rounded-framer-sm hover:bg-neutral-80 transition-colors uppercase tracking-wide">
                Hubungi Konsultan
            </a>
        </div>
    </header>

    {{-- PORFIL --}}
    <section id="profil" class="tunggu-scroll py-24 px-6 max-w-7xl mx-auto scroll-mt-20">
        <div class="border-t border-tertiary pt-10 mb-16 grid grid-cols-1 md:grid-cols-3 gap-6">
            <p class="text-xs text-secondary uppercase tracking-[0.2em] font-semibold">01 / PROFIL</p>
            <h2 class="headline-lg text-primary uppercase md:col-span-2">Membantu Bisnis Beradaptasi dengan Era Baru
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
            <div class="space-y-6">
                <h3 class="text-xs uppercase tracking-widest text-primary font-bold">Tentang Perusahaan</h3>
                <p class="body-md text-secondary leading-relaxed text-justify">
                    CV Lintas Tech Artomoro adalah firma solusi teknologi independen yang bergerak di bidang optimasi
                    digital berkelanjutan. Kami berkomitmen menyediakan layanan rekayasa perangkat lunak berskala
                    tinggi, kampanye pemasaran presisi, produksi konten kreatif, serta penyediaan fondasi infrastruktur
                    IT yang aman.
                </p>
                <p class="body-md text-secondary leading-relaxed text-justify">
                    Fokus kami adalah menyelaraskan efisiensi operasional dengan kehadiran brand digital modern demi
                    tercapainya pertumbuhan konversi bisnis Anda secara stabil dan terukur.
                </p>
            </div>

            <div
                class="border border-slate-800/80 rounded-[5px] p-3 bg-slate-900/40 backdrop-blur-md max-w-[624px] mx-auto shadow-xl">

                <div
                    class="bg-neutral-950 rounded-1xl overflow-hidden aspect-[2/1] relative flex items-center justify-center border border-slate-900">
                    @if ($profil && $profil->gambar_perusahaan)
                        <img src="{{ asset('storage/' . $profil->gambar_perusahaan) }}" alt="Logo"
                            class="w-full h-full object-cover grayscale opacity-90 transition-all duration-700 hover:scale-105 hover:grayscale-0"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    @else
                        <img src="{{ asset('img/no_foto.jpg') }}" alt="Logo"
                            class="w-full h-full object-cover grayscale opacity-90 transition-all duration-700 hover:scale-105 hover:grayscale-0"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    @endif

                    <div
                        class="hidden absolute inset-0 flex-col items-center justify-center p-6 text-center bg-slate-950/80 backdrop-blur-sm animate-fade-in">
                        <i class="fa-solid fa-microchip text-blue-500 text-4xl mb-3 animate-pulse"></i>
                        <span class="text-xs text-slate-400 font-bold tracking-widest uppercase">STUDIO PRODUKSI
                            TEKNOLOGI</span>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section id="layanan" class="tunggu-scroll py-24 bg-surface border-y border-tertiary scroll-mt-20">
        <div class="max-w-7xl mx-auto px-6">

            <div class="border-t border-tertiary pt-10 mb-16 grid grid-cols-1 md:grid-cols-3 gap-6">
                <p class="text-xs text-secondary uppercase tracking-[0.2em] font-semibold">02 / SPESIALISASI</p>
                <h2 class="headline-lg text-primary uppercase md:col-span-2">Layanan Kami</h2>
            </div>

            <div
                class="grid grid-cols-1 md:grid-cols-2 gap-px bg-tertiary border border-tertiary rounded-framer-md overflow-hidden">

                <div class="bg-neutral p-10 space-y-6 hover:bg-neutral-80/40 transition-colors duration-300">
                    <div class="text-primary text-xl flex items-center gap-3">
                        <i class="fa-solid fa-code"></i>
                        <span class="text-xs uppercase tracking-widest font-semibold text-secondary">02.1</span>
                    </div>
                    <h3 class="headline-sm text-primary uppercase">Web Development</h3>
                    <p class="body-md text-secondary leading-relaxed">
                        Pengembangan arsitektur informasi digital tangguh menggunakan kerangka kerja modern. Kami
                        merancang sistem aplikasi web responsif, integrasi API pihak ketiga secara mulus, serta panel
                        administrasi yang aman.
                    </p>
                </div>

                <div class="bg-neutral p-10 space-y-6 hover:bg-neutral-80/40 transition-colors duration-300">
                    <div class="text-primary text-xl flex items-center gap-3">
                        <i class="fa-solid fa-arrow-trend-up"></i>
                        <span class="text-xs uppercase tracking-widest font-semibold text-secondary">02.2</span>
                    </div>
                    <h3 class="headline-sm text-primary uppercase">SEO & SEM Marketing</h3>
                    <p class="body-md text-secondary leading-relaxed">
                        Optimalisasi keterpaparan organik pada mesin pencari utama. Kami menyusun analisis kata kunci
                        strategis, perbaikan struktur halaman teknis, dan manajemen kampanye iklan berbayar (Google Ads)
                        dengan fokus ROI tinggi.
                    </p>
                </div>

                <div class="bg-neutral p-10 space-y-6 hover:bg-neutral-80/40 transition-colors duration-300">
                    <div class="text-primary text-xl flex items-center gap-3">
                        <i class="fa-solid fa-hashtag"></i>
                        <span class="text-xs uppercase tracking-widest font-semibold text-secondary">02.3</span>
                    </div>
                    <h3 class="headline-sm text-primary uppercase">Content & Social Media</h3>
                    <p class="body-md text-secondary leading-relaxed">
                        Produksi konten audio-visual vertikal berkualitas tinggi disesuaikan dengan algoritma media
                        sosial mutakhir. Meningkatkan retensi pemirsa dan membangun interaksi aktif dengan representasi
                        brand yang selaras.
                    </p>
                </div>

                <div class="bg-neutral p-10 space-y-6 hover:bg-neutral-80/40 transition-colors duration-300">
                    <div class="text-primary text-xl flex items-center gap-3">
                        <i class="fa-solid fa-server"></i>
                        <span class="text-xs uppercase tracking-widest font-semibold text-secondary">02.4</span>
                    </div>
                    <h3 class="headline-sm text-primary uppercase">IT Infrastructure</h3>
                    <p class="body-md text-secondary leading-relaxed">
                        Penyediaan solusi hosting dengan stabilitas tinggi, pendaftaran domain korporat profesional,
                        konfigurasi proteksi keamanan digital (SSL), serta audit analitik performa infrastruktur server
                        berkala.
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- Daftar portofolio --}}
    <section id="portofolio" class="tunggu-scroll py-24 px-6 max-w-7xl mx-auto space-y-16 scroll-mt-20">

        <div class="border-t border-tertiary pt-10 mb-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <p class="text-xs text-secondary uppercase tracking-[0.2em] font-semibold">03 / PORTOFOLIO</p>
            <h2 class="headline-lg text-primary uppercase md:col-span-2">Portofolio Kami Yang Telah Selesai</h2>
        </div>

        <div class="space-y-8">
            @foreach($portofolios as $portofolio)
                {{-- Card Portofolio Dinamis --}}
                <div
                    class="tunggu-scroll bg-surface border border-tertiary rounded-framer-md p-6 md:p-8 grid grid-cols-1 md:grid-cols-12 gap-8 items-center">

                    <div class="md:col-span-7 space-y-4">
                        <p class="text-xs text-secondary tracking-widest uppercase font-bold">{{ $portofolio->sub_judul }}
                        </p>
                        <h3 class="headline-md text-primary uppercase">{{ $portofolio->judul }}</h3>
                        <p class="body-md text-secondary leading-relaxed text-justify">
                            {{ $portofolio->deskripsi }}
                        </p>
                    </div>

                    <div
                        class="md:col-span-5 border border-tertiary rounded-framer-sm overflow-hidden bg-neutral-80 aspect-[16/10] relative flex items-center justify-center">

                        @if($portofolio->foto)
                            <img src="{{ asset('storage/' . $portofolio->foto) }}" alt="[Tampilan {{ $portofolio->judul }}]"
                                class="w-full h-full object-cover opacity-80"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        @else
                            <img src="https://media.tenor.com/ngY5lNArvSIAAAAe/catboss.png" alt="[Tampilan Default]"
                                class="w-full h-full object-cover opacity-80"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

    </section>

    {{-- 04 / Kreatif & Social media --}}
    <section id="kreator" class="tunggu-scroll py-13 px-6 max-w-7xl mx-auto">
        <div class="border-t border-tertiary pt-10 mb-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <p class="text-xs text-secondary uppercase tracking-[0.2em] font-semibold">04 / KREATIF DIVISION</p>
            <h2 class="headline-lg text-primary uppercase md:col-span-2">Optimasi Tren Digital & Kreator</h2>
        </div>

        <div
            class="bg-surface border border-tertiary rounded-framer-md p-8 md:p-12 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

            <div class="space-y-6">
                <div class="space-y-2">
                    <p class="text-xs text-secondary uppercase tracking-[0.2em] font-semibold">Kreator Digital</p>
                    <h3 class="headline-md text-primary uppercase">Strategi, Kreativitas & Inovasi</h3>
                </div>

                <p class="body-md text-secondary leading-relaxed">
                    Kami merancang dan mengeksekusi materi kreatif yang disesuaikan dengan pola konsumsi konten masa
                    kini. Berfokus pada optimalisasi di <span class="text-primary font-semibold">TikTok</span> dan <span
                        class="text-primary font-semibold">Instagram Reels</span> guna membangun loyalitas komunitas
                    digital yang solid.
                </p>

                <div class="space-y-3 pt-4">
                    <h4 class="text-xs uppercase tracking-widest text-primary font-bold">Afiliasi Kreator Resmi:</h4>
                    <div class="flex flex-wrap gap-2.5">
                        @if($creator && $creator->username_1)
                            <span
                                class="px-3.5 py-1.5 bg-neutral border border-tertiary rounded-framer-sm text-xs font-medium text-secondary hover:text-primary hover:border-primary transition-colors cursor-pointer">{{ $creator->username_1 }}</span>
                        @endif
                        @if($creator && $creator->username_2)
                            <span
                                class="px-3.5 py-1.5 bg-neutral border border-tertiary rounded-framer-sm text-xs font-medium text-secondary hover:text-primary hover:border-primary transition-colors cursor-pointer">{{ $creator->username_2 }}</span>
                        @endif
                        @if($creator && $creator->username_3)
                            <span
                                class="px-3.5 py-1.5 bg-neutral border border-tertiary rounded-framer-sm text-xs font-medium text-secondary hover:text-primary hover:border-primary transition-colors cursor-pointer">{{ $creator->username_3 }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Frame Foto Produksi Minimalis -->
            <div
                class="border border-tertiary rounded-framer-sm overflow-hidden bg-neutral-80 aspect-[4/3] relative flex items-center justify-center">
                @if($creator && $creator->foto)
                    <img src="{{ asset('storage/' . $creator->foto) }}"
                        alt="[Ilustrasi produksi pembuatan konten media sosial]"
                        class="w-full h-full object-cover grayscale opacity-80 hover:scale-105 hover:grayscale-0 transition-all duration-500"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                @endif
                <div
                    class="{{ $creator && $creator->foto ? 'hidden' : '' }} absolute inset-0 flex-col items-center justify-center p-4 bg-neutral flex">
                    <i class="fa-solid fa-clapperboard text-tertiary text-4xl mb-3"></i>
                    <span class="text-xs text-secondary font-medium uppercase tracking-widest">PRODUKSI KONTEN
                        SOSIAL</span>
                </div>
            </div>

        </div>
    </section>

    {{-- Alur Kerja --}}
    <section id="alur-kerja" class="tunggu-scroll py-20 px-6 max-w-7xl mx-auto scroll-mt-20">
        <div class="border-t border-tertiary pt-10 mb-16 grid grid-cols-1 md:grid-cols-3 gap-6">
            <p class="text-xs text-secondary uppercase tracking-[0.2em] font-semibold">05 / PROSES TIM</p>
            <h2 class="headline-lg text-primary uppercase md:col-span-2">Alur Kerja Kami</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <div
                class="bg-surface border border-tertiary rounded-framer-md p-8 relative flex flex-col justify-between overflow-hidden group hover:border-primary/30 transition-colors duration-500">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono text-secondary tracking-widest">PHASE 01</span>
                        <i
                            class="fa-solid fa-magnifying-glass text-secondary group-hover:text-primary transition-colors duration-500"></i>
                    </div>
                    <h3 class="headline-sm text-primary uppercase">Analisis & Strategi</h3>
                    <p class="body-md text-secondary leading-relaxed">
                        Konsultasi mendalam mengenai kebutuhan web, riset kata kunci kompetitor, serta pemetaan konsep
                        konten digital yang relevan.
                    </p>
                </div>
                <div
                    class="absolute bottom-0 right-0 transform translate-x-4 translate-y-4 text-neutral-80/40 text-8xl font-black select-none pointer-events-none group-hover:text-neutral-80/70 transition-colors duration-500">
                    1
                </div>
            </div>

            <div
                class="bg-surface border border-tertiary rounded-framer-md p-8 relative flex flex-col justify-between overflow-hidden group hover:border-primary/30 transition-colors duration-500">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono text-secondary tracking-widest">PHASE 02</span>
                        <i
                            class="fa-solid fa-palette text-secondary group-hover:text-primary transition-colors duration-500"></i>
                    </div>
                    <h3 class="headline-sm text-primary uppercase">Desain</h3>
                    <p class="body-md text-secondary leading-relaxed">
                        Pembuatan rancangan prototype UI/UX aplikasi web yang interaktif serta perencanaan struktur
                        kampanye iklan (Google Ads) yang matang.
                    </p>
                </div>
                <div
                    class="absolute bottom-0 right-0 transform translate-x-4 translate-y-4 text-neutral-80/40 text-8xl font-black select-none pointer-events-none group-hover:text-neutral-80/70 transition-colors duration-500">
                    2
                </div>
            </div>

            <div
                class="bg-surface border border-tertiary rounded-framer-md p-8 relative flex flex-col justify-between overflow-hidden group hover:border-primary/30 transition-colors duration-500">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono text-secondary tracking-widest">PHASE 03</span>
                        <i
                            class="fa-solid fa-terminal text-secondary group-hover:text-primary transition-colors duration-500"></i>
                    </div>
                    <h3 class="headline-sm text-primary uppercase">Eksekusi</h3>
                    <p class="body-md text-secondary leading-relaxed">
                        Proses penulisan kode (*coding*) website berbasis Laravel, konfigurasi teknis SEO, dan produksi
                        aset konten media sosial.
                    </p>
                </div>
                <div
                    class="absolute bottom-0 right-0 transform translate-x-4 translate-y-4 text-neutral-80/40 text-8xl font-black select-none pointer-events-none group-hover:text-neutral-80/70 transition-colors duration-500">
                    3
                </div>
            </div>

            <div
                class="bg-surface border border-tertiary rounded-framer-md p-8 relative flex flex-col justify-between overflow-hidden group hover:border-primary/30 transition-colors duration-500">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono text-secondary tracking-widest">PHASE 04</span>
                        <i
                            class="fa-solid fa-chart-line text-secondary group-hover:text-primary transition-colors duration-500"></i>
                    </div>
                    <h3 class="headline-sm text-primary uppercase">Optimasi</h3>
                    <p class="body-md text-secondary leading-relaxed">
                        Pemantauan performa iklan secara berkala, penyesuaian tren algoritma sosial terbaru, dan
                        pemeliharaan infrastruktur sistem.
                    </p>
                </div>
                <div
                    class="absolute bottom-0 right-0 transform translate-x-4 translate-y-4 text-neutral-80/40 text-8xl font-black select-none pointer-events-none group-hover:text-neutral-80/70 transition-colors duration-500">
                    4
                </div>
            </div>

        </div>
    </section>
    <footer id="kontak" class="bg-neutral text-secondary text-xs border-t border-tertiary pt-20 pb-12 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-12 pb-16 border-b border-tertiary">

            <div class="space-y-5 text-left">
                <h4 class="font-extrabold text-sm tracking-widest text-primary uppercase">
                    CV Lintas Tech Artomoro
                </h4>
                <a href="https://maps.app.goo.gl/ky8Ly6eq6xUhJbkv6" target="_blank"
                    class="leading-relaxed text-secondary hover:text-primary flex items-start gap-3 group transition-colors">
                    <i
                        class="fa-solid fa-location-dot text-primary mt-1 shrink-0 group-hover:scale-110 transition-transform"></i>
                    <span class="group-hover:underline body-md">
                        Jl. Sunan Muria No.25, Dami, Ampeldento, Kec. Pakis, Kabupaten Malang, Jawa Timur 65154
                    </span>
                </a>
                <a href="https://wa.me/+628563639797" target="_blank"
                    class="leading-relaxed text-secondary hover:text-primary flex items-start gap-3 group transition-colors">
                    <i
                        class="fa-solid fa-phone text-primary mt-1 shrink-0 group-hover:scale-110 transition-transform"></i>
                    <span class="group-hover:underline body-md">
                        +628563639797 / +6285791436300
                    </span>
                </a>
            </div>

            <div class="space-y-4 flex flex-col items-start md:pl-8">
                <h4 class="font-bold text-primary text-xs uppercase tracking-widest">Koneksi Sosial</h4>
                <div class="flex gap-6 text-lg pt-1">
                    <a href="https://instagram.com" target="_blank"
                        class="hover:text-primary transition-colors text-secondary">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="https://facebook.com" target="_blank"
                        class="hover:text-primary transition-colors text-secondary">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                    <a href="https://youtube.com" target="_blank"
                        class="hover:text-primary transition-colors text-secondary">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                </div>
            </div>

            <div class="space-y-4">
                <h4 class="font-bold text-primary text-xs uppercase tracking-widest">Kolaborasi Digital</h4>
                <p class="body-md text-secondary leading-relaxed">
                    Ajukan penawaran, rancangan konsep, atau konsultasi kebutuhan sistem informasi Anda langsung kepada
                    tim spesialis kami.
                </p>
                <div class="pt-2">
                    <a href="mailto:hello@lintastech.id"
                        class="h-10 px-4 inline-flex items-center justify-center bg-transparent border border-tertiary text-primary text-xs font-semibold rounded-framer-sm hover:bg-neutral-80 transition-colors uppercase tracking-widest">
                        Kirim Surat Elektronik
                    </a>
                </div>
            </div>

        </div>

        <div
            class="max-w-7xl mx-auto px-6 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4 text-[11px] text-secondary tracking-tight">
            <div class="text-center sm:text-left leading-relaxed">
                © 2026 CV Lintas Tech Artomoro. Seluruh Hak Cipta Dilindungi. <br>
                Direkayasa secara berkelanjutan.
            </div>
            <div class="flex gap-4">
                <a href="#" class="hover:text-primary transition-colors">Syarat Layanan</a>
                <span class="text-tertiary">/</span>
                <a href="#" class="hover:text-primary transition-colors">Kebijakan Privasi</a>
            </div>
        </div>
    </footer>
</body>

<script>
    // ===== LOADING SCREEN LOGIC =====
    const loadingScreen = document.getElementById('loading-screen');
    const loadingBar = document.getElementById('loading-bar');
    const loadingLabel = document.getElementById('loading-label');

    let currentPct = 0;
    let dismissed = false;

    function setBar(pct, label) {
        if (pct <= currentPct) return;
        currentPct = pct;
        loadingBar.style.transitionDuration = '500ms';
        loadingBar.style.width = pct + '%';
        if (label) loadingLabel.textContent = label.toUpperCase();
    }

    // Animasi simulasi loading bar modern
    setTimeout(() => setBar(25, 'Memetakan pustaka gaya...'), 200);
    setTimeout(() => setBar(50, 'Mendownload visual aset...'), 700);
    setTimeout(() => setBar(75, 'Merender struktur halaman...'), 1400);
    setTimeout(() => setBar(90, 'Optimalisasi visual selesai...'), 2200);

    function dismissLoading() {
        if (dismissed) return;
        dismissed = true;

        setBar(100, 'Memuat Selesai');

        setTimeout(() => {
            loadingScreen.style.transition = 'opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1)';
            loadingScreen.style.opacity = '0';
            setTimeout(() => {
                if (loadingScreen.parentNode) loadingScreen.remove();
            }, 700);
        }, 500);
    }

    window.addEventListener('load', dismissLoading);

    // Emergency fallback jika load terhambat koneksi lambat
    setTimeout(() => { if (!dismissed) dismissLoading(); }, 15000);

    // ===== SCROLL OBSERVER ANIMATION =====
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('muncul-scroll');
            }
        });
    }, {
        threshold: 0.1
    });

    const elemenAnimasi = document.querySelectorAll('.tunggu-scroll');
    elemenAnimasi.forEach((el) => observer.observe(el));

    // ===== NAVBAR SCROLL TRANSITION =====
    const navbar = document.querySelector("nav");

    function updateNavbar() {
        if (window.scrollY > 30) {
            navbar.classList.add("bg-neutral/95", "border-b", "border-tertiary");
        } else {
            navbar.classList.remove("bg-neutral/95");
        }
    }

    window.addEventListener("scroll", updateNavbar);

    // Mulai dari paling atas saat render selesai
    window.addEventListener("load", () => {
        if (history.scrollRestoration) {
            history.scrollRestoration = 'manual';
        }
        window.scrollTo(0, 0);
        updateNavbar();
    });

    // ===== LOGIKA MEMBERSIHKAN HASH URL SAAT REFRESH =====
    if (window.location.hash) {
        window.history.replaceState(null, null, window.location.pathname + window.location.search);
    }
</script>

</html>