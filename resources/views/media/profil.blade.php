@extends('layouts.sidebar')

@section('title', 'Profil')
@section('page_title', 'Pengaturan Profil Perusahaan')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6 text-xs">

        @if(session('success'))
            <div
                class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 font-bold rounded-xl shadow-sm flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-base"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 font-medium rounded-xl shadow-sm space-y-1">
                <p class="font-bold"><i class="fa-solid fa-triangle-exclamation mr-1"></i> Periksa kembali isian Anda:</p>
                <ul class="list-disc list-inside text-[11px] opacity-90">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('media.profil.update') }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            @csrf
            @method('PUT')

            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 flex items-center gap-4">
                <div
                    class="w-10 h-10 bg-neutral-100 rounded-lg flex items-center justify-center text-neutral-700 border border-neutral-200">
                    <i class="fa-solid fa-sliders text-base"></i>
                </div>
                <div>
                    <h3 class="font-bold text-sm text-slate-900 tracking-tight">Informasi Umum & Identitas</h3>
                    <p class="text-slate-400 text-[11px] mt-0.5 font-medium">Atur data pokok publikasi yang akan tampil pada
                        Landing Page utama.</p>
                </div>
            </div>

            <div class="p-6 space-y-5">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pb-4 border-b border-slate-50">

                    {{-- Nama perusahaan / Name Company --}}
                    {{-- <div class="md:col-span-1">
                        <label class="block font-semibold text-slate-700 mb-1.5">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan"
                            value="{{ old('nama_perusahaan', $profil->nama_perusahaan) }}" required
                            class="w-full px-3 py-2.5 rounded-lg border border-slate-200 focus:outline-none focus:border-neutral-800 focus:ring-4 focus:ring-neutral-800/5 transition-all">
                    </div> --}}

                    {{-- Ganti Logo / Change Logo --}}
                    <div>
                        <label class="block font-semibold text-slate-600 mb-1.5">Ganti Logo</label>
                        <input type="file" name="logo_perusahaan" id="input_logo"
                            class="w-full px-2 py-1.5 rounded-lg border border-slate-200 text-[11px] file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-[10px] file:font-semibold file:bg-slate-100 file:text-slate-700">
                        <p class="text-[10px] text-slate-400 mt-1">* Maksimal ukuran file logo adalah 5 MB (Format: JPG,
                            JPEG, PNG).</p>

                        <div id="error_logo_lokal"
                            class="hidden mt-1.5 text-[10px] text-rose-600 font-bold flex items-center gap-1">
                            <i class="fa-solid fa-triangle-exclamation"></i> <span id="pesan_error_lokal"></span>
                        </div>
                        @if($profil->logo_perusahaan)
                            <span class="text-[10px] text-emerald-600 font-semibold mt-1 block"><i
                                    class="fa-solid fa-circle-check"></i> Logo sudah terupload</span>
                        @endif
                    </div>

                    {{-- Ganti Gambar perusahaan / Change Image Company --}}
                    <div>
                        <label class="block font-semibold text-slate-600 mb-1.5">Ganti gambar Perusahaan</label>
                        <input type="file" name="gambar_perusahaan" id="input_gambar"
                            class="w-full px-2 py-1.5 rounded-lg border border-slate-200 text-[11px] file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-[10px] file:font-semibold file:bg-slate-100 file:text-slate-700">
                        <p class="text-[10px] text-slate-400 mt-1">* Maksimal ukuran file gambar adalah 5 MB (Format: JPG,
                            JPEG, PNG).</p>

                        <div id="error_logo_lokal"
                            class="hidden mt-1.5 text-[10px] text-rose-600 font-bold flex items-center gap-1">
                            <i class="fa-solid fa-triangle-exclamation"></i> <span id="pesan_error_lokal"></span>
                        </div>
                        @if($profil->gambar_perusahaan)
                            <span class="text-[10px] text-emerald-600 font-semibold mt-1 block"><i
                                    class="fa-solid fa-circle-check"></i> Gambar Perusahaan sudah terupload</span>
                        @endif
                    </div>
                </div>

                {{-- Tentang / About --}}
                {{-- <div class="pb-4 border-b border-slate-50">
                    <label class="block font-semibold text-slate-700 mb-1.5">Tentang Perusahaan</label>
                    <textarea name="sejarah_singkat" rows="4" required
                        class="w-full px-3 py-2.5 rounded-lg border border-slate-200 focus:outline-none focus:border-neutral-800 focus:ring-4 focus:ring-neutral-800/5 transition-all leading-relaxed"
                        placeholder="Latar Belakang...">{{ old('sejarah_singkat', $profil->sejarah_singkat) }}</textarea>
                </div> --}}


                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pb-4 border-b border-slate-50">

                    {{-- Alamat Lengkap --}}
                    {{-- <div class="md:col-span-2">
                        <label class="block font-semibold text-slate-700 mb-1.5">Alamat Lengkap</label>
                        <textarea name="alamat" required placeholder="Jl Raya...." rows="2"
                            class="w-full px-3 py-2.5 rounded-lg border border-slate-200 focus:outline-none focus:border-neutral-800 focus:ring-4 focus:ring-neutral-800/5 transition-all resize-y min-h-[46px] text-slate-800 leading-normal">{{ old('alamat', $profil->alamat) }}</textarea>
                    </div> --}}

                    {{-- No. WhatsApp --}}
                    {{-- <div class="md:col-span-1">
                        <label class="block font-semibold text-slate-700 mb-1.5">No. WhatsApp Humas / Kontak</label>
                        <div class="relative flex items-center">
                            <span
                                class="absolute left-3 font-bold text-slate-400 bg-slate-100 px-2 py-1 rounded-md text-[10px]">62</span>
                            <input type="contact" name="whatsapp_kontak"
                                value="{{ old('whatsapp_kontak', $profil->whatsapp_kontak) }}" required
                                placeholder="8123456789"
                                class="w-full pl-12 pr-3 py-2.5 rounded-lg border border-slate-200 focus:outline-none focus:border-neutral-800 focus:ring-4 focus:ring-neutral-800/5 transition-all">
                        </div>
                    </div> --}}

                </div>

                {{-- Media Social --}}
                <div class="space-y-3">
                    <h4 class="font-bold text-slate-800 text-[11px] uppercase tracking-wider text-slate-400">Tautan Jejaring
                        Sosial (Opsional)</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-600 mb-1.5"><i
                                    class="fa-brands fa-instagram text-amber-700 mr-1"></i> Instagram Link</label>
                            <input type="url" name="instagram_link"
                                value="{{ old('instagram_link', $profil->instagram_link) }}"
                                placeholder="https://instagram.com/akun"
                                class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-200 text-[11px]">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-600 mb-1.5"><i
                                    class="fa-brands fa-facebook text-blue-700 mr-1"></i> Facebook Page</label>
                            <input type="url" name="facebook_link"
                                value="{{ old('facebook_link', $profil->facebook_link) }}"
                                placeholder="https://facebook.com/pages"
                                class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-200 text-[11px]">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-600 mb-1.5"><i
                                    class="fa-brands fa-youtube text-rose-600 mr-1"></i> YouTube Channel</label>
                            <input type="url" name="youtube_link" value="{{ old('youtube_link', $profil->youtube_link) }}"
                                placeholder="https://youtube.com/c/channel"
                                class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-200 text-[11px]">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Simpan / Save --}}
            <div class="px-6 py-4 bg-slate-50/60 border-t border-slate-100 flex justify-end">
                <button type="submit"
                    class="px-5 py-2.5 bg-neutral-900 hover:bg-neutral-800 text-white rounded-lg font-bold shadow-sm shadow-neutral-900/10 transition-all cursor-pointer">
                    <i class="fa-solid fa-floppy-disk mr-1.5"></i> Simpan Perubahan Profil
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // 1. Buat satu fungsi validasi yang menerima parameter dinamis
        function batasiUkuranGambar(inputId, errorBoxId, errorTextId) {
            document.getElementById(inputId).addEventListener('change', function () {
                const file = this.files[0];
                const errorBox = document.getElementById(errorBoxId);
                const errorText = document.getElementById(errorTextId);
                const submitBtn = this.closest('form').querySelector('button[type="submit"]');

                if (file) {
                    const fileSizeInKB = file.size / 1024; // Hitungan KB

                    if (fileSizeInKB > 5048) { // Batas 5 MB
                        errorText.innerText = "File yang Anda pilih berukuran " + (fileSizeInKB / 1024).toFixed(2) + " MB. Ukuran ini melebihi batas maksimal 5 MB!";
                        errorBox.classList.remove('hidden');
                        submitBtn.disabled = true;
                        submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                        this.value = ""; // Kosongkan input
                    } else {
                        errorBox.classList.add('hidden');
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    }
                }
            });
        }

        // 2. Cukup panggil fungsi di atas untuk masing-masing input gambar Anda
        // Parameter: (id_input, id_box_error, id_text_error)
        batasiUkuranGambar('input_logo', 'error_logo_lokal', 'pesan_error_lokal');
        batasiUkuranGambar('input_gambar', 'error_gambar_lokal', 'pesan_error_gambar_lokal');
    </script>
@endpush