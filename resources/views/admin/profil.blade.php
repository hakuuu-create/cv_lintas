{{-- resources/views/admin/profil.blade.php --}}
@extends('layouts.admin')

@section('title', 'Profil Perusahaan')
@section('page_title', 'Pengaturan Profil CV Lintas Tech Artomoro')

@section('content')
<div class="max-w-4xl mx-auto space-y-6 text-xs">

    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 font-bold rounded-2xl shadow-sm flex items-center gap-2">
            <i class="fa-solid fa-circle-check text-base"></i>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 font-medium rounded-2xl shadow-sm space-y-1">
            <p class="font-bold"><i class="fa-solid fa-triangle-exclamation mr-1"></i> Periksa kembali isian Anda:</p>
            <ul class="list-disc list-inside text-[11px] opacity-90">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data"
          class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        @csrf
        @method('PUT')

        {{-- Header Form --}}
        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 flex items-center gap-4">
            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-700 border border-blue-100/50">
                <i class="fa-solid fa-building text-base"></i>
            </div>
            <div>
                <h3 class="font-bold text-sm text-slate-800 tracking-tight">Informasi Umum Perusahaan</h3>
                <p class="text-slate-400 text-[11px] mt-0.5 font-medium">Data ini akan tampil di Landing Page utama.</p>
            </div>
        </div>

        <div class="p-6 space-y-5">

            {{-- Nama Perusahaan & Logo --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pb-4 border-b border-slate-50">
                <div class="md:col-span-2">
                    <label class="block font-semibold text-slate-700 mb-1.5">Nama Resmi Perusahaan</label>
                    {{-- BUG FIX: nama field diubah dari nama_pesantren → nama_perusahaan --}}
                    <input type="text" name="nama_perusahaan"
                           value="{{ old('nama_perusahaan', $profil->nama_perusahaan) }}"
                           required
                           class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                </div>
                <div>
                    <label class="block font-semibold text-slate-600 mb-1.5">Ganti Logo Perusahaan</label>
                    {{-- BUG FIX: name diubah dari logo_pesantren → logo_perusahaan --}}
                    <input type="file" name="logo_perusahaan" id="input_logo"
                           class="w-full px-2 py-1.5 rounded-xl border border-slate-200 text-[11px] file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-[10px] file:font-semibold file:bg-slate-100 file:text-slate-700">
                    <p class="text-[10px] text-slate-400 mt-1">* Maks 2 MB (JPG, PNG)</p>
                    <div id="error_logo_lokal" class="hidden mt-1.5 text-[10px] text-rose-600 font-bold flex items-center gap-1">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span id="pesan_error_lokal"></span>
                    </div>
                    @if($profil->logo_perusahaan)
                        <span class="text-[10px] text-emerald-600 font-semibold mt-1 block">
                            <i class="fa-solid fa-circle-check"></i> Logo sudah terupload
                        </span>
                    @endif
                </div>
            </div>

            {{-- Sejarah Singkat --}}
            <div class="pb-4 border-b border-slate-50">
                <label class="block font-semibold text-slate-700 mb-1.5">Tentang / Sejarah Singkat Perusahaan</label>
                <textarea name="sejarah_singkat" rows="4" required
                          class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all leading-relaxed"
                          placeholder="Tuliskan latar belakang atau sejarah singkat perusahaan..."
                >{{ old('sejarah_singkat', $profil->sejarah_singkat) }}</textarea>
            </div>

            {{-- Visi & Misi --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pb-4 border-b border-slate-50">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Visi Perusahaan</label>
                    <textarea name="visi" rows="4" required
                              class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all leading-relaxed"
                              placeholder="Contoh: Menjadi mitra teknologi terpercaya di Indonesia..."
                    >{{ old('visi', $profil->visi) }}</textarea>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Misi Perusahaan <span class="text-slate-400 font-normal">(Per baris per poin)</span></label>
                    <textarea name="misi" rows="4" required
                              class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all leading-relaxed"
                              placeholder="1. Memberikan solusi digital terbaik...&#10;2. Mengutamakan kepuasan klien..."
                    >{{ old('misi', $profil->misi) }}</textarea>
                </div>
            </div>

            {{-- Alamat & WhatsApp --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pb-4 border-b border-slate-50">
                <div class="md:col-span-2">
                    <label class="block font-semibold text-slate-700 mb-1.5">Alamat Lengkap</label>
                    <input type="text" name="alamat"
                           value="{{ old('alamat', $profil->alamat) }}"
                           required
                           placeholder="Jl. Sunan Muria No.25, Malang..."
                           class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">No. WhatsApp</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-3 font-bold text-slate-400 bg-slate-100 px-2 py-1 rounded-md text-[10px]">62</span>
                        <input type="number" name="whatsapp_kontak"
                               value="{{ old('whatsapp_kontak', $profil->whatsapp_kontak) }}"
                               required
                               placeholder="8123456789"
                               class="w-full pl-12 pr-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                    </div>
                </div>
            </div>

            {{-- Sosial admin --}}
            <div class="space-y-3">
                <h4 class="font-bold text-[11px] uppercase tracking-wider text-slate-400">Tautan admin Sosial (Opsional)</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block font-semibold text-slate-600 mb-1.5">
                            <i class="fa-brands fa-instagram text-amber-700 mr-1"></i> Instagram
                        </label>
                        <input type="url" name="instagram_link"
                               value="{{ old('instagram_link', $profil->instagram_link) }}"
                               placeholder="https://instagram.com/akun"
                               class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-200 text-[11px]">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-600 mb-1.5">
                            <i class="fa-brands fa-facebook text-blue-700 mr-1"></i> Facebook
                        </label>
                        <input type="url" name="facebook_link"
                               value="{{ old('facebook_link', $profil->facebook_link) }}"
                               placeholder="https://facebook.com/pages"
                               class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-200 text-[11px]">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-600 mb-1.5">
                            <i class="fa-brands fa-youtube text-rose-600 mr-1"></i> YouTube
                        </label>
                        <input type="url" name="youtube_link"
                               value="{{ old('youtube_link', $profil->youtube_link) }}"
                               placeholder="https://youtube.com/c/channel"
                               class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-200 text-[11px]">
                    </div>
                </div>
            </div>

        </div>

        {{-- Tombol Simpan --}}
        <div class="px-6 py-4 bg-slate-50/60 border-t border-slate-100 flex justify-end">
            <button type="submit"
                    class="px-5 py-2.5 bg-blue-700 hover:bg-blue-800 text-white rounded-xl font-bold shadow-sm transition-all cursor-pointer">
                <i class="fa-solid fa-floppy-disk mr-1.5"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('input_logo').addEventListener('change', function () {
        const file = this.files[0];
        const errorBox  = document.getElementById('error_logo_lokal');
        const errorText = document.getElementById('pesan_error_lokal');
        const submitBtn = this.closest('form').querySelector('button[type="submit"]');

        if (file) {
            const fileSizeInKB = file.size / 1024;
            if (fileSizeInKB > 2048) {
                errorText.innerText = `File berukuran ${(fileSizeInKB / 1024).toFixed(2)} MB — melebihi batas 2 MB!`;
                errorBox.classList.remove('hidden');
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                this.value = '';
            } else {
                errorBox.classList.add('hidden');
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }
    });
</script>
@endpush