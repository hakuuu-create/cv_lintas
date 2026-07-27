{{-- resources/views/admin/kreator/index.blade.php --}}
@extends('layouts.sidebar')

@section('title', 'Kreator')
@section('page_title', 'Manajemen Kreator')

@section('content')
    <div class="space-y-5 text-xs">

        @if(session('success'))
            <div
                class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 font-bold rounded-xl flex items-center gap-2">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 font-bold rounded-xl flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
            </div>
        @endif

        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm font-bold text-slate-800">Daftar Kreator</h3>
                <p class="text-slate-400 mt-0.5">Total {{ $kreator->count() }} kreator terdaftar</p>
            </div>
            <button onclick="bukaModalTambah()"
                class="px-4 py-2.5 bg-blue-700 hover:bg-blue-800 text-white font-bold rounded-xl transition-all flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Kreator
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @forelse($kreator as $item)
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                    <div class="relative aspect-square bg-slate-100 overflow-hidden">
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="flex flex-col items-center justify-center h-full text-slate-300 gap-2">
                                <i class="fa-solid fa-user text-5xl"></i>
                            </div>
                        @endif
                        <div class="absolute top-2 left-2flex flex-col gap-1">
                            @if($item->platform === 'TikTok')
                                <span
                                    class="px-2.5 py-1 bg-black text-white text-[10px] font-bold rounded-full shadow flex items-center gap-1">
                                    <i class="fa-brands fa-tiktok"></i> TikTok
                                </span>
                            @else
                                <span
                                    class="px-2.5 py-1 bg-gradient-to-r from-purple-600 to-pink-500 text-white text-[10px] font-bold rounded-full shadow flex items-center gap-1">
                                    <i class="fa-brands fa-instagram"></i> Instagram
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="p-4 flex flex-col gap-1 flex-1">
                        <h4 class="font-bold text-slate-800 text-sm">{{ $item->judul ?? $item->nama }}</h4>

                        {{-- Affiliated Creators List --}}
                        <div class="mt-2 flex flex-wrap gap-1.5">
                            <span class="px-2 py-0.5 bg-slate-100 text-slate-700 rounded-md font-mono text-[10px]">
                                &#64;{{ $item->username }}
                            </span>
                            @if($item->username_2)
                                <span class="px-2 py-0.5 bg-slate-100 text-slate-700 rounded-md font-mono text-[10px]">
                                    &#64;{{ $item->username_2 }}
                                </span>
                            @endif
                            @if($item->username_3)
                                <span class="px-2 py-0.5 bg-slate-100 text-slate-700 rounded-md font-mono text-[10px]">
                                    &#64;{{ $item->username_3 }}
                                </span>
                            @endif
                        </div>

                        @if($item->deskripsi)
                            <p class="text-slate-500 text-[11px] mt-2 line-clamp-2">{{ $item->deskripsi }}</p>
                        @endif

                        <div class="flex gap-2 pt-3 mt-auto border-t border-slate-100">
                            <button onclick="bukaModalEdit(
                                                                            {{ $item->id }},
                                                                            '{{ addslashes($item->nama) }}',
                                                                            '{{ addslashes($item->username) }}',
                                                                            '{{ $item->platform }}',
                                                                            '{{ addslashes($item->nama_2 ?? '') }}',
                                                                            '{{ addslashes($item->username_2 ?? '') }}',
                                                                            '{{ $item->platform_2 ?? '' }}',
                                                                            '{{ addslashes($item->nama_3 ?? '') }}',
                                                                            '{{ addslashes($item->username_3 ?? '') }}',
                                                                            '{{ $item->platform_3 ?? '' }}',
                                                                            '{{ addslashes($item->judul ?? '') }}',
                                                                            '{{ addslashes($item->sub_judul ?? '') }}',
                                                                            '{{ addslashes($item->deskripsi ?? '') }}',
                                                                            '{{ $item->foto ? asset('storage/' . $item->foto) : '' }}'
                                                                        )"
                                class="flex-1 py-2 bg-amber-50 hover:bg-amber-100 text-amber-700 font-bold rounded-lg border border-amber-200 transition-all text-center">
                                <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                            </button>
                            <button onclick="bukaModalHapus({{ $item->id }}, '{{ addslashes($item->nama) }}')"
                                class="flex-1 py-2 bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold rounded-lg border border-rose-200 transition-all text-center">
                                <i class="fa-solid fa-trash mr-1"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="sm:col-span-2 lg:col-span-3 xl:col-span-4 bg-white rounded-2xl border border-slate-200 py-16 text-center text-slate-400">
                    <i class="fa-solid fa-clapperboard text-4xl mb-3 block opacity-30"></i>
                    Belum ada kreator. Klik "Tambah Kreator" untuk memulai.
                </div>
            @endforelse
        </div>
    </div>

    {{-- MODAL TAMBAH --}}
    <div id="modalTambah" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="tutupModalTambah()"></div>
        <div
            class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg z-10 overflow-hidden flex flex-col max-h-[90vh]">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50 flex items-center justify-between shrink-0">
                <div class="flex items-center gap-3">
                    <div
                        class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center text-blue-700 border border-blue-100">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <h3 class="font-bold text-sm text-slate-800">Tambah Kreator Baru</h3>
                </div>
                <button onclick="tutupModalTambah()" class="text-slate-400 hover:text-slate-600 p-1">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <form action="{{ route('admin.kreator.store') }}" method="POST" enctype="multipart/form-data" id="myForm"
                class="p-6 space-y-4 text-xs overflow-y-auto custom-scrollbar">
                @csrf

                {{-- Judul --}}
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Judul <span
                            class="text-slate-400 font-normal">(opsional)</span></label>
                    <input type="text" name="judul" placeholder="Contoh: Konten Kreator Digital"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                </div>

                {{-- Sub judul --}}
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Sub Judul <span
                            class="text-slate-400 font-normal">(opsional)</span></label>
                    <input type="text" name="sub_judul" placeholder="Contoh: Strategi & Kreativitas"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Deskripsi <span
                            class="text-slate-400 font-normal">(opsional)</span></label>
                    <textarea name="deskripsi" rows="2" placeholder="Jelaskan peran atau kontribusi..."
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all leading-relaxed"></textarea>
                </div>

                <hr class="border-slate-100">

                {{-- KREATOR 1 (WAJIB) --}}
                <div class="p-3 bg-slate-50 border border-slate-200 rounded-xl space-y-3">
                    <span class="font-bold text-slate-700 block">Kreator 1 (Utama) <span
                            class="text-rose-500">*</span></span>

                    <div>
                        <label class="block font-medium text-slate-600 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama" required placeholder="Contoh: Budi Santoso"
                            class="w-full px-3 py-2 rounded-lg border border-slate-200 bg-white focus:outline-none focus:border-blue-600">
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block font-medium text-slate-600 mb-1">Username Media Sosial</label>
                            <div class="relative">
                                <span
                                    class="absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 font-bold">&#64;</span>
                                <input type="text" name="username" required placeholder="budisantoso"
                                    class="w-full pl-6 pr-2 py-2 rounded-lg border border-slate-200 bg-white focus:outline-none focus:border-blue-600">
                            </div>
                        </div>

                        <div>
                            <label class="block font-medium text-slate-600 mb-1">Platform</label>
                            <select name="platform"
                                class="w-full px-2 py-2 rounded-lg border border-slate-200 bg-white focus:outline-none focus:border-blue-600">
                                <option value="TikTok">TikTok</option>
                                <option value="Instagram">Instagram</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- KREATOR 2 (OPSIONAL) --}}
                <div id="wrapper_creator_2"
                    class="hidden p-3 bg-slate-50 border border-slate-200 rounded-xl space-y-3 relative">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-slate-700">Kreator 2 (Opsional)</span>
                        <button type="button" onclick="hapusCreator(2)"
                            class="text-rose-500 hover:text-rose-700 font-bold text-[11px]">Hapus</button>
                    </div>

                    <div>
                        <label class="block font-medium text-slate-600 mb-1">Nama Lengkap</label>
                        <input type="text" id="nama_2" name="nama_2" placeholder="Nama Kreator Kedua"
                            class="w-full px-3 py-2 rounded-lg border border-slate-200 bg-white focus:outline-none focus:border-blue-600">
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block font-medium text-slate-600 mb-1">Username Media Sosial</label>
                            <div class="relative">
                                <span
                                    class="absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 font-bold">&#64;</span>
                                <input type="text" id="username_2" name="username_2" placeholder="username"
                                    class="w-full pl-6 pr-2 py-2 rounded-lg border border-slate-200 bg-white focus:outline-none focus:border-blue-600">
                            </div>
                        </div>

                        <div>
                            <label class="block font-medium text-slate-600 mb-1">Platform</label>
                            <select id="platform_2" name="platform_2"
                                class="w-full px-2 py-2 rounded-lg border border-slate-200 bg-white focus:outline-none focus:border-blue-600">
                                <option value="TikTok">TikTok</option>
                                <option value="Instagram">Instagram</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- KREATOR 3 (OPSIONAL) --}}
                <div id="wrapper_creator_3"
                    class="hidden p-3 bg-slate-50 border border-slate-200 rounded-xl space-y-3 relative">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-slate-700">Kreator 3 (Opsional)</span>
                        <button type="button" onclick="hapusCreator(3)"
                            class="text-rose-500 hover:text-rose-700 font-bold text-[11px]">Hapus</button>
                    </div>

                    <div>
                        <label class="block font-medium text-slate-600 mb-1">Nama Lengkap</label>
                        <input type="text" id="nama_3" name="nama_3" placeholder="Nama Kreator Ketiga"
                            class="w-full px-3 py-2 rounded-lg border border-slate-200 bg-white focus:outline-none focus:border-blue-600">
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block font-medium text-slate-600 mb-1">Username Media Sosial</label>
                            <div class="relative">
                                <span
                                    class="absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 font-bold">&#64;</span>
                                <input type="text" id="username_3" name="username_3" placeholder="username"
                                    class="w-full pl-6 pr-2 py-2 rounded-lg border border-slate-200 bg-white focus:outline-none focus:border-blue-600">
                            </div>
                        </div>

                        <div>
                            <label class="block font-medium text-slate-600 mb-1">Platform</label>
                            <select id="platform_3" name="platform_3"
                                class="w-full px-2 py-2 rounded-lg border border-slate-200 bg-white focus:outline-none focus:border-blue-600">
                                <option value="TikTok">TikTok</option>
                                <option value="Instagram">Instagram</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Tombol Tambah Kreator Tambahan -->
                <button type="button" id="btnTambahCreator" onclick="tambahInputCreator()"
                    class="w-full py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 font-bold rounded-xl border border-blue-200 transition-all text-center">
                    + Tambah Kreator Lainnya
                </button>

                <hr class="border-slate-100">

                {{-- Foto Profil --}}
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Foto Profil <span
                            class="text-slate-400 font-normal">(opsional)</span></label>
                    <input type="file" id="fotoTambah" name="foto" accept="image/*"
                        class="w-full px-2 py-1.5 rounded-xl border border-slate-200 text-[11px] file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-[10px] file:font-semibold file:bg-slate-100 file:text-slate-700">
                    <p class="text-[10px] text-slate-400 mt-1" id="errorTambahFoto">Maks 2 MB (JPG, PNG, JPEG)</p>
                </div>

                {{-- Button simpan --}}
                <div class="pt-2 flex justify-end gap-2 border-t border-slate-100">
                    <button type="button" onclick="tutupModalTambah()"
                        class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-all">Batal</button>
                    <button type="submit" id="btnAdd"
                        class="px-5 py-2.5 bg-blue-700 hover:bg-blue-800 text-white font-bold rounded-xl transition-all">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div id="modalEdit" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="tutupModalEdit()"></div>
        <div
            class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg z-10 overflow-hidden flex flex-col max-h-[90vh]">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50 flex items-center justify-between shrink-0">
                <div class="flex items-center gap-3">
                    <div
                        class="w-9 h-9 bg-amber-50 rounded-xl flex items-center justify-center text-amber-700 border border-amber-100">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                    <h3 class="font-bold text-sm text-slate-800">Edit Kreator</h3>
                </div>
                <button onclick="tutupModalEdit()" class="text-slate-400 hover:text-slate-600 p-1">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <form id="formEdit" action="" method="POST" enctype="multipart/form-data"
                class="p-6 space-y-4 text-xs overflow-y-auto custom-scrollbar">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Judul <span
                            class="text-slate-400 font-normal">(opsional)</span></label>
                    <input type="text" id="edit_judul" name="judul"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600">
                </div>

                {{-- Sub judul --}}
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Sub Judul <span
                            class="text-slate-400 font-normal">(opsional)</span></label>
                    <input type="text" id="edit_sub_judul" name="sub_judul"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600">
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Deskripsi <span
                            class="text-slate-400 font-normal">(opsional)</span></label>
                    <textarea id="edit_deskripsi" name="deskripsi" rows="2"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 leading-relaxed"></textarea>
                </div>

                <hr class="border-slate-100">

                {{-- EDIT KREATOR 1 --}}
                <div class="p-3 bg-slate-50 border border-slate-200 rounded-xl space-y-3">
                    <span class="font-bold text-slate-700 block">Kreator 1 (Utama) <span
                            class="text-rose-500">*</span></span>

                    <div>
                        <label class="block font-medium text-slate-600 mb-1">Nama Lengkap</label>
                        <input type="text" id="edit_nama" name="nama" required
                            class="w-full px-3 py-2 rounded-lg border border-slate-200 bg-white focus:outline-none focus:border-blue-600">
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block font-medium text-slate-600 mb-1">Username Media Sosial</label>
                            <div class="relative">
                                <span
                                    class="absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 font-bold">&#64;</span>
                                <input type="text" id="edit_username" name="username" required
                                    class="w-full pl-6 pr-2 py-2 rounded-lg border border-slate-200 bg-white focus:outline-none focus:border-blue-600">
                            </div>
                        </div>

                        <div>
                            <label class="block font-medium text-slate-600 mb-1">Platform</label>
                            <select id="edit_platform" name="platform"
                                class="w-full px-2 py-2 rounded-lg border border-slate-200 bg-white focus:outline-none focus:border-blue-600">
                                <option value="TikTok">TikTok</option>
                                <option value="Instagram">Instagram</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- EDIT KREATOR 2 --}}
                <div id="edit_wrapper_creator_2"
                    class="p-3 bg-slate-50 border border-slate-200 rounded-xl space-y-3 relative">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-slate-700">Kreator 2 (Opsional)</span>
                        <button type="button" onclick="resetEditCreator(2)"
                            class="text-rose-500 hover:text-rose-700 font-bold text-[11px] flex items-center gap-1">
                            <i class="fa-solid fa-trash-can"></i> Kosongkan
                        </button>
                    </div>

                    <div>
                        <label class="block font-medium text-slate-600 mb-1">Nama Lengkap</label>
                        <input type="text" id="edit_nama_2" name="nama_2"
                            class="w-full px-3 py-2 rounded-lg border border-slate-200 bg-white focus:outline-none focus:border-blue-600">
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block font-medium text-slate-600 mb-1">Username / Handle</label>
                            <div class="relative">
                                <span
                                    class="absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 font-bold">&#64;</span>
                                <input type="text" id="edit_username_2" name="username_2"
                                    class="w-full pl-6 pr-2 py-2 rounded-lg border border-slate-200 bg-white focus:outline-none focus:border-blue-600">
                            </div>
                        </div>

                        <div>
                            <label class="block font-medium text-slate-600 mb-1">Platform</label>
                            <select id="edit_platform_2" name="platform_2"
                                class="w-full px-2 py-2 rounded-lg border border-slate-200 bg-white focus:outline-none focus:border-blue-600">
                                <option value="TikTok">TikTok</option>
                                <option value="Instagram">Instagram</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- EDIT KREATOR 3 --}}
                <div id="edit_wrapper_creator_3"
                    class="p-3 bg-slate-50 border border-slate-200 rounded-xl space-y-3 relative">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-slate-700">Kreator 3 (Opsional)</span>
                        <button type="button" onclick="resetEditCreator(3)"
                            class="text-rose-500 hover:text-rose-700 font-bold text-[11px] flex items-center gap-1">
                            <i class="fa-solid fa-trash-can"></i> Kosongkan
                        </button>
                    </div>

                    <div>
                        <label class="block font-medium text-slate-600 mb-1">Nama Lengkap</label>
                        <input type="text" id="edit_nama_3" name="nama_3"
                            class="w-full px-3 py-2 rounded-lg border border-slate-200 bg-white focus:outline-none focus:border-blue-600">
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block font-medium text-slate-600 mb-1">Username / Handle</label>
                            <div class="relative">
                                <span
                                    class="absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 font-bold">&#64;</span>
                                <input type="text" id="edit_username_3" name="username_3"
                                    class="w-full pl-6 pr-2 py-2 rounded-lg border border-slate-200 bg-white focus:outline-none focus:border-blue-600">
                            </div>
                        </div>

                        <div>
                            <label class="block font-medium text-slate-600 mb-1">Platform</label>
                            <select id="edit_platform_3" name="platform_3"
                                class="w-full px-2 py-2 rounded-lg border border-slate-200 bg-white focus:outline-none focus:border-blue-600">
                                <option value="TikTok">TikTok</option>
                                <option value="Instagram">Instagram</option>
                            </select>
                        </div>
                    </div>
                </div>

                <hr class="border-slate-100">

                {{-- Foto --}}
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Ganti Foto
                        <span class="text-slate-400 font-normal">(kosongkan jika tidak ingin mengganti)</span>
                    </label>
                    <div id="edit_preview_wrap" class="mb-2 hidden">
                        <img id="edit_preview_img" src="" alt="Preview"
                            class="w-20 h-20 object-cover rounded-full border-2 border-slate-200">
                    </div>
                    <input type="file" id="fotoEdit" name="foto" accept="image/*"
                        class="w-full px-2 py-1.5 rounded-xl border border-slate-200 text-[11px] file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-[10px] file:font-semibold file:bg-slate-100 file:text-slate-700">
                    <p class="text-[10px] text-slate-400 mt-1" id="errorEditFoto">Maks 2 MB (JPG, PNG, JPEG)</p>
                </div>

                {{-- Button simpan --}}
                <div class="pt-2 flex justify-end gap-2 border-t border-slate-100">
                    <button type="button" onclick="tutupModalEdit()"
                        class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-all">Batal</button>
                    <button type="submit" id="btnEdit"
                        class="px-5 py-2.5 bg-amber-600 hover:bg-amber-700 text-white font-bold rounded-xl transition-all">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL HAPUS --}}
    <div id="modalHapus" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="tutupModalHapus()"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm z-10">
            <div class="p-6 text-center space-y-4 text-xs">
                <div
                    class="w-14 h-14 bg-rose-50 rounded-2xl flex items-center justify-center text-rose-600 mx-auto border border-rose-100">
                    <i class="fa-solid fa-trash text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-slate-800 text-sm">Hapus Kreator?</h3>
                    <p class="text-slate-500 mt-1">Kreator <span id="hapus_nama" class="font-bold text-slate-800"></span>
                        akan dihapus permanen.</p>
                </div>
                <form id="formHapus" action="" method="POST" class="flex gap-2 justify-center pt-2">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="tutupModalHapus()"
                        class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-all">Batal</button>
                    <button type="submit"
                        class="px-5 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-xl transition-all">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let currentCreatorCount = 1;

        function tambahInputCreator() {
            if (currentCreatorCount === 1) {
                document.getElementById('wrapper_creator_2').classList.remove('hidden');
                currentCreatorCount = 2;
            } else if (currentCreatorCount === 2) {
                document.getElementById('wrapper_creator_3').classList.remove('hidden');
                document.getElementById('btnTambahCreator').classList.add('hidden');
                currentCreatorCount = 3;
            }
        }

        function hapusCreator(number) {
            if (number === 2) {
                document.getElementById('wrapper_creator_2').classList.add('hidden');
                document.getElementById('nama_2').value = '';
                document.getElementById('username_2').value = '';
                if (currentCreatorCount === 2) {
                    currentCreatorCount = 1;
                }
            } else if (number === 3) {
                document.getElementById('wrapper_creator_3').classList.add('hidden');
                document.getElementById('nama_3').value = '';
                document.getElementById('username_3').value = '';
                currentCreatorCount = 2;
            }
            document.getElementById('btnTambahCreator').classList.remove('hidden');
        }

        function resetEditCreator(number) {
            if (number === 2) {
                document.getElementById('edit_nama_2').value = '';
                document.getElementById('edit_username_2').value = '';
                document.getElementById('edit_platform_2').value = 'TikTok';
            } else if (number === 3) {
                document.getElementById('edit_nama_3').value = '';
                document.getElementById('edit_username_3').value = '';
                document.getElementById('edit_platform_3').value = 'TikTok';
            }
        }

        function bukaModalTambah() {
            document.getElementById('modalTambah').classList.remove('hidden');
            document.getElementById('modalTambah').classList.add('flex');
        }

        function tutupModalTambah() {
            document.getElementById('modalTambah').classList.add('hidden');
            document.getElementById('modalTambah').classList.remove('flex');
        }

        function bukaModalEdit(id, nama, username, platform, nama2, username2, platform2, nama3, username3, platform3, judul, subJudul, deskripsi, fotoUrl) {
            document.getElementById('formEdit').action = `/dashboard-admin/kreator/${id}`;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_username').value = username;
            document.getElementById('edit_platform').value = platform;

            document.getElementById('edit_nama_2').value = nama2 || '';
            document.getElementById('edit_username_2').value = username2 || '';
            document.getElementById('edit_platform_2').value = platform2 || 'TikTok';

            document.getElementById('edit_nama_3').value = nama3 || '';
            document.getElementById('edit_username_3').value = username3 || '';
            document.getElementById('edit_platform_3').value = platform3 || 'TikTok';

            document.getElementById('edit_judul').value = judul;
            document.getElementById('edit_sub_judul').value = subJudul;
            document.getElementById('edit_deskripsi').value = deskripsi;

            const wrap = document.getElementById('edit_preview_wrap');
            const img = document.getElementById('edit_preview_img');
            if (fotoUrl) {
                img.src = fotoUrl;
                wrap.classList.remove('hidden');
            } else {
                wrap.classList.add('hidden');
            }

            document.getElementById('modalEdit').classList.remove('hidden');
            document.getElementById('modalEdit').classList.add('flex');
        }

        function tutupModalEdit() {
            document.getElementById('modalEdit').classList.add('hidden');
            document.getElementById('modalEdit').classList.remove('flex');
        }

        function bukaModalHapus(id, nama) {
            document.getElementById('formHapus').action = `/dashboard-admin/kreator/${id}`;
            document.getElementById('hapus_nama').textContent = nama;
            document.getElementById('modalHapus').classList.remove('hidden');
            document.getElementById('modalHapus').classList.add('flex');
        }

        function tutupModalHapus() {
            document.getElementById('modalHapus').classList.add('hidden');
            document.getElementById('modalHapus').classList.remove('flex');
        }

        // Anti double submit
        const formTambah = document.getElementById('myForm');
        const btnTambah = document.getElementById('btnAdd');
        if (formTambah && btnTambah) {
            formTambah.addEventListener('submit', function () {
                btnTambah.disabled = true;
                btnTambah.innerHTML = `
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg> Menyimpan...`;
            });
        }

        const formEdit = document.getElementById('formEdit');
        const btnEdit = document.getElementById('btnEdit');
        if (formEdit && btnEdit) {
            formEdit.addEventListener('submit', function () {
                btnEdit.disabled = true;
                btnEdit.innerHTML = `
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg> Menyimpan...`;
            });
        }

        // Validasi ukuran file foto
        const fotoTambahInput = document.getElementById('fotoTambah');
        const errorTambahFotoMsg = document.getElementById('errorTambahFoto');
        if (fotoTambahInput && errorTambahFotoMsg) {
            fotoTambahInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file && file.size > 2 * 1024 * 1024) {
                    errorTambahFotoMsg.textContent = 'Foto maksimal 2 MB';
                    errorTambahFotoMsg.className = 'text-[10px] text-rose-500 font-bold mt-1 animate-pulse';
                    this.value = ''; // Reset input agar tidak dikirim
                } else {
                    errorTambahFotoMsg.textContent = 'Maks 2 MB (JPG, PNG, JPEG)';
                    errorTambahFotoMsg.className = 'text-[10px] text-slate-400 mt-1';
                }
            });
        }

        const fotoEditInput = document.getElementById('fotoEdit');
        const errorEditFotoMsg = document.getElementById('errorEditFoto');
        if (fotoEditInput && errorEditFotoMsg) {
            fotoEditInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file && file.size > 2 * 1024 * 1024) {
                    errorEditFotoMsg.textContent = 'Foto maksimal 2 MB';
                    errorEditFotoMsg.className = 'text-[10px] text-rose-500 font-bold mt-1 animate-pulse';
                    this.value = ''; // Reset input agar tidak dikirim
                } else {
                    errorEditFotoMsg.textContent = 'Maks 2 MB (JPG, PNG, JPEG)';
                    errorEditFotoMsg.className = 'text-[10px] text-slate-400 mt-1';
                }
            });
        }
    </script>
@endpush