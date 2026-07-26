@extends('layouts.sidebar')

@section('title', 'Dashboard admin')
@section('page_title', 'Dashboard Konten & admin')

@section('content')
    <div class="space-y-6">
        <div
            class="bg-gradient-to-r from-[#2563eb] to-blue-950 p-6 sm:p-8 rounded-2xl text-white shadow-sm relative overflow-hidden">
            <div class="relative z-10 space-y-2">
                <span class="px-3 py-1 bg-white/20 rounded-full text-[10px] font-bold uppercase tracking-wider">Ruang Kerja
                    admin</span>
                <h3 class="text-xl sm:text-2xl font-black tracking-tight">Selamat Datang!</h3>
                <p class="text-xs text-emerald-100/90 max-w-xl leading-relaxed">
                    Melalui halaman ini, Anda dapat memperbarui informasi.
                </p>
            </div>
            <div
                class="absolute right-0 bottom-0 translate-y-4 translate-x-4 opacity-10 text-9xl font-black select-none pointer-events-none">
                <i class="fa-solid fa-bullhorn"></i>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 text-xs">
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between space-y-4">
                <div class="flex items-start gap-4">
                    <div
                        class="w-10 h-10 bg-amber-50 border border-amber-100 rounded-xl flex items-center justify-center text-amber-600 text-base shadow-inner">
                        <i class="fa-solid fa-hotel"></i>
                    </div>
                    <div class="space-y-1">
                        <h4 class="font-bold text-slate-900 text-sm">Identitas Perusahaan</h4>
                        <p class="text-[#2563eb] leading-relaxed">Kelola informasi utama perusahaan seperti nama, sejarah,
                            visi dan misi, kontak WhatsApp, serta tautan media sosial resmi.
                        </p>
                    </div>
                </div>
                <a href="{{ route('admin.pengaturan.edit') }}"
                    class="w-full text-center py-2.5 bg-slate-950 hover:bg-slate-800 text-white font-bold rounded-xl transition-all">
                    Buka Pengaturan Profil
                </a>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between space-y-4">
                <div class="flex items-start gap-4">
                    <div
                        class="w-10 h-10 bg-blue-50 border border-blue-100 rounded-xl flex items-center justify-center text-blue-700 text-base shadow-inner">
                        <i class="fa-solid fa-building"></i>
                    </div>

                    <div class="space-y-1">
                        <h4 class="font-bold text-slate-900 text-sm">
                            Profil Perusahaan
                        </h4>

                        <p class="text-slate-500 leading-relaxed">
                            Kelola informasi profil perusahaan, mulai dari sejarah, visi dan misi, nilai perusahaan, hingga
                            informasi yang ditampilkan kepada pengunjung website.
                        </p>
                    </div>
                </div>

                <a href="{{ route('admin.profil.index') }}"
                    class="w-full text-center py-2.5 bg-blue-700 hover:bg-blue-800 text-white font-bold rounded-xl transition-all shadow-md shadow-blue-700/10">
                    Kelola Profil Perusahaan
                </a>
            </div>
        </div>
    </div>
@endsection