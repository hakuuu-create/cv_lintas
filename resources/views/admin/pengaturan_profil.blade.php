{{-- resources/views/admin/profil.blade.php --}}
@extends('layouts.sidebar')

@section('title', 'Profil Perusahaan')
@section('page_title', 'Pengaturan Profil Perusahaan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6 text-xs">

    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 font-bold rounded-2xl flex items-center gap-2">
            <i class="fa-solid fa-circle-check text-base"></i> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 font-medium rounded-2xl space-y-1">
            <p class="font-bold"><i class="fa-solid fa-triangle-exclamation mr-1"></i> Periksa kembali isian Anda:</p>
            <ul class="list-disc list-inside text-[11px] opacity-90">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data"
          class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        @csrf
        @method('PUT')

        {{-- ===== SECTION 1: IDENTITAS ===== --}}
        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 flex items-center gap-4">
            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-700 border border-blue-100">
                <i class="fa-solid fa-building text-base"></i>
            </div>
            <div>
                <h3 class="font-bold text-sm text-slate-800 tracking-tight">Identitas Perusahaan</h3>
                <p class="text-slate-400 text-[11px] mt-0.5">Nama, logo, dan foto tampilan utama.</p>
            </div>
        </div>

        <div class="p-6 space-y-5 border-b border-slate-100">

            {{-- Nama --}}
            <div>
                <label class="block font-semibold text-slate-700 mb-1.5">
                    Nama Resmi Perusahaan <span class="text-rose-500">*</span>
                </label>
                <input type="text" name="nama_perusahaan"
                       value="{{ old('nama_perusahaan', $profil->nama_perusahaan) }}"
                       required placeholder="CV Lintas Tech Artomoro"
                       class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
            </div>

            <!-- {{-- Logo & Gambar --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- Logo --}}
                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50 space-y-3">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-image text-slate-400"></i>
                        <span class="font-semibold text-slate-700">Logo Perusahaan</span>
                        <span class="text-slate-400 font-normal">(opsional)</span>
                    </div>
                    @if($profil->logo_perusahaan)
                        <div class="flex items-center gap-3 p-3 bg-white rounded-lg border border-slate-200">
                            <img src="{{ asset('storage/' . $profil->logo_perusahaan) }}"
                                 alt="Logo" class="w-12 h-12 object-contain rounded-lg bg-slate-50 p-1 border border-slate-100">
                            <div>
                                <p class="font-semibold text-slate-700 text-[11px]">Logo aktif</p>
                                <p class="text-slate-400 text-[10px]">Upload baru untuk mengganti</p>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center justify-center p-4 bg-white rounded-lg border border-dashed border-slate-300 text-slate-400 gap-2">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <span class="text-[11px]">Belum ada logo</span>
                        </div>
                    @endif
                    <input type="file" name="logo_perusahaan" accept="image/*"
                           class="w-full px-2 py-1.5 rounded-lg border border-slate-200 text-[11px] file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-[10px] file:font-semibold file:bg-slate-100 file:text-slate-700">
                    <p class="text-[10px] text-slate-400">Maks 2 MB · JPG, PNG, WEBP</p>
                </div>

                {{-- Gambar Perusahaan --}}
                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50 space-y-3">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-panorama text-slate-400"></i>
                        <span class="font-semibold text-slate-700">Foto Perusahaan</span>
                        <span class="text-slate-400 font-normal">(opsional)</span>
                    </div>
                    @if($profil->gambar_perusahaan)
                        <div class="relative rounded-lg overflow-hidden border border-slate-200">
                            <img src="{{ asset('storage/' . $profil->gambar_perusahaan) }}"
                                 alt="Gambar Perusahaan" class="w-full h-24 object-cover">
                            <div class="absolute bottom-0 inset-x-0 bg-black/40 px-2 py-1">
                                <p class="text-white text-[10px] font-semibold">Foto aktif · Upload baru untuk mengganti</p>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center justify-center p-4 bg-white rounded-lg border border-dashed border-slate-300 text-slate-400 gap-2">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <span class="text-[11px]">Belum ada foto perusahaan</span>
                        </div>
                    @endif
                    <input type="file" name="gambar_perusahaan" accept="image/*"
                           class="w-full px-2 py-1.5 rounded-lg border border-slate-200 text-[11px] file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-[10px] file:font-semibold file:bg-slate-100 file:text-slate-700">
                    <p class="text-[10px] text-slate-400">Maks 5 MB · JPG, PNG, WEBP · Tampil di section Profil</p>
                </div>
            </div> -->
        </div>

        {{-- ===== SECTION 2: TENTANG ===== --}}
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/30 flex items-center gap-3">
            <div class="w-8 h-8 bg-violet-50 rounded-lg flex items-center justify-center text-violet-600 border border-violet-100">
                <i class="fa-solid fa-align-left text-sm"></i>
            </div>
            <h3 class="font-bold text-sm text-slate-700">Tentang & Visi Misi</h3>
        </div>

        <div class="p-6 space-y-5 border-b border-slate-100">

            {{-- Sejarah --}}
            <div>
                <label class="block font-semibold text-slate-700 mb-1.5">
                    Tentang / Sejarah Singkat <span class="text-rose-500">*</span>
                </label>
                <textarea name="sejarah_singkat" rows="4" required
                          placeholder="Tuliskan latar belakang atau sejarah singkat perusahaan..."
                          class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all leading-relaxed"
                >{{ old('sejarah_singkat', $profil->sejarah_singkat) }}</textarea>
                <p class="text-[10px] text-slate-400 mt-1">Tampil sebagai deskripsi utama di section Hero & Profil.</p>
            </div>

            {{-- Visi & Misi --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">
                        Visi <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="visi" rows="5" required
                              placeholder="Menjadi mitra teknologi terpercaya di Indonesia..."
                              class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all leading-relaxed"
                    >{{ old('visi', $profil->visi) }}</textarea>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Misi</label>
                    <textarea name="misi" rows="5"
                              placeholder="1. Memberikan solusi digital terbaik...&#10;2. Mengutamakan kepuasan klien..."
                              class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all leading-relaxed"
                    >{{ old('misi', $profil->misi) }}</textarea>
                    <p class="text-[10px] text-slate-400 mt-1">
                        <i class="fa-solid fa-circle-info mr-1"></i>
                        Setiap baris = satu poin misi di landing page.
                    </p>
                </div>
            </div>
        </div>

        {{-- ===== SECTION 3: KONTAK ===== --}}
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/30 flex items-center gap-3">
            <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-600 border border-emerald-100">
                <i class="fa-solid fa-address-card text-sm"></i>
            </div>
            <h3 class="font-bold text-sm text-slate-700">Kontak & Lokasi</h3>
        </div>

        <div class="p-6 space-y-5 border-b border-slate-100">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="md:col-span-2">
                    <label class="block font-semibold text-slate-700 mb-1.5">
                        Alamat Lengkap <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="alamat"
                           value="{{ old('alamat', $profil->alamat) }}"
                           required placeholder="Jl. Sunan Muria No.25, Malang..."
                           class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">
                        No. WhatsApp <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-[11px] bg-slate-100 px-1.5 py-0.5 rounded">+62</span>
                        <input type="text" name="whatsapp_kontak"
                               value="{{ old('whatsapp_kontak', $profil->whatsapp_kontak) }}"
                               required placeholder="8123456789"
                               class="w-full pl-14 pr-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                    </div>
                    <p class="text-[10px] text-slate-400 mt-1">Tanpa angka 0 di depan</p>
                </div>
            </div>
        </div>

        {{-- ===== SECTION 4: SOSIAL MEDIA ===== --}}
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/30 flex items-center gap-3">
            <div class="w-8 h-8 bg-pink-50 rounded-lg flex items-center justify-center text-pink-600 border border-pink-100">
                <i class="fa-solid fa-share-nodes text-sm"></i>
            </div>
            <h3 class="font-bold text-sm text-slate-700">Sosial Media <span class="text-slate-400 font-normal text-xs">(Opsional)</span></h3>
        </div>

        <div class="p-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label class="block font-semibold text-slate-600 mb-1.5">
                        <i class="fa-brands fa-instagram text-pink-500 mr-1"></i> Instagram
                    </label>
                    <input type="url" name="instagram_link"
                           value="{{ old('instagram_link', $profil->instagram_link) }}"
                           placeholder="https://instagram.com/akun"
                           class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-pink-400 focus:ring-4 focus:ring-pink-400/5 transition-all">
                </div>
                <div>
                    <label class="block font-semibold text-slate-600 mb-1.5">
                        <i class="fa-brands fa-facebook text-blue-600 mr-1"></i> Facebook
                    </label>
                    <input type="url" name="facebook_link"
                           value="{{ old('facebook_link', $profil->facebook_link) }}"
                           placeholder="https://facebook.com/pages"
                           class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition-all">
                </div>
                <div>
                    <label class="block font-semibold text-slate-600 mb-1.5">
                        <i class="fa-brands fa-youtube text-rose-600 mr-1"></i> YouTube
                    </label>
                    <input type="url" name="youtube_link"
                           value="{{ old('youtube_link', $profil->youtube_link) }}"
                           placeholder="https://youtube.com/c/channel"
                           class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-rose-400 focus:ring-4 focus:ring-rose-400/5 transition-all">
                </div>
            </div>

            {{-- Preview sosmed aktif --}}
            @if($profil->instagram_link || $profil->facebook_link || $profil->youtube_link)
            <div class="flex flex-wrap gap-2 pt-2">
                <p class="w-full text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Link aktif:</p>
                @if($profil->instagram_link)
                    <a href="{{ $profil->instagram_link }}" target="_blank"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-pink-50 border border-pink-200 text-pink-700 rounded-lg text-[11px] font-semibold hover:bg-pink-100 transition-colors">
                        <i class="fa-brands fa-instagram"></i> Instagram
                    </a>
                @endif
                @if($profil->facebook_link)
                    <a href="{{ $profil->facebook_link }}" target="_blank"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 border border-blue-200 text-blue-700 rounded-lg text-[11px] font-semibold hover:bg-blue-100 transition-colors">
                        <i class="fa-brands fa-facebook"></i> Facebook
                    </a>
                @endif
                @if($profil->youtube_link)
                    <a href="{{ $profil->youtube_link }}" target="_blank"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-rose-50 border border-rose-200 text-rose-700 rounded-lg text-[11px] font-semibold hover:bg-rose-100 transition-colors">
                        <i class="fa-brands fa-youtube"></i> YouTube
                    </a>
                @endif
            </div>
            @endif
        </div>

        {{-- Tombol Simpan --}}
        <div class="px-6 py-4 bg-slate-50/60 border-t border-slate-100 flex items-center justify-between">
            <p class="text-[11px] text-slate-400">
                <i class="fa-solid fa-circle-info mr-1"></i>
                Field bertanda <span class="text-rose-500 font-bold">*</span> wajib diisi.
            </p>
            <button type="submit"
                    class="px-6 py-2.5 bg-blue-700 hover:bg-blue-800 text-white rounded-xl font-bold shadow-sm transition-all flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
            </button>
        </div>
    </form>

</div>
@endsection