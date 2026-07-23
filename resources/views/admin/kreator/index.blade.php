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
                        <div class="absolute top-2 left-2">
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
                        <h4 class="font-bold text-slate-800 text-sm">{{ $item->nama }}</h4>
                        <p class="text-slate-400 font-medium">&#64;{{ $item->username }}</p>
                        @if($item->judul)
                            <p class="text-slate-500 text-[11px] mt-1 line-clamp-2">{{ $item->judul }}</p>
                        @endif
                        <div class="flex gap-2 pt-3 mt-auto border-t border-slate-100">
                            <button onclick="bukaModalEdit(
                                    {{ $item->id }},
                                    '{{ addslashes($item->nama) }}',
                                    '{{ addslashes($item->judul ?? '') }}',
                                    '{{ addslashes($item->sub_judul ?? '') }}',
                                    '{{ addslashes($item->deskripsi ?? '') }}',
                                    '{{ addslashes($item->username) }}',
                                    '{{ $item->platform }}',
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
            class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md z-10 overflow-hidden flex flex-col max-h-[90vh]">
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
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Judul
                        <span class="text-slate-400 font-normal">(opsional)</span>
                    </label>
                    <input type="text" name="judul" placeholder="Contoh: Konten Kreator Digital"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Sub Judul
                        <span class="text-slate-400 font-normal">(opsional)</span>
                    </label>
                    <input type="text" name="sub_judul" placeholder="Contoh: Strategi & Kreativitas"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Deskripsi
                        <span class="text-slate-400 font-normal">(opsional)</span>
                    </label>
                    <textarea name="deskripsi" rows="3" placeholder="Jelaskan peran atau kontribusi kreator ini..."
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all leading-relaxed"></textarea>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Nama Lengkap <span
                            class="text-rose-500">*</span></label>
                    <input type="text" name="nama" required placeholder="Contoh: Budi Santoso"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Username / Handle <span
                            class="text-rose-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 font-bold">@</span>
                        <input type="text" name="username" required placeholder="budisantoso"
                            class="w-full pl-7 pr-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                    </div>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Platform <span
                            class="text-rose-500">*</span></label>
                    <select name="platform"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all bg-white">
                        <option value="TikTok">TikTok</option>
                        <option value="Instagram">Instagram</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Foto Profil
                        <span class="text-slate-400 font-normal">(opsional)</span>
                    </label>
                    <input type="file" id="fotoTambah" name="foto" accept="image/*"
                        class="w-full px-2 py-1.5 rounded-xl border border-slate-200 text-[11px] file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-[10px] file:font-semibold file:bg-slate-100 file:text-slate-700">
                    <p class="text-[10px] text-slate-400 mt-1" id="errorTambahFoto">Maks 2 MB (JPG, PNG)</p>
                </div>
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
            class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md z-10 overflow-hidden flex flex-col max-h-[90vh]">
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
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Judul
                        <span class="text-slate-400 font-normal">(opsional)</span>
                    </label>
                    <input type="text" id="edit_judul" name="judul"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Sub Judul
                        <span class="text-slate-400 font-normal">(opsional)</span>
                    </label>
                    <input type="text" id="edit_sub_judul" name="sub_judul"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Deskripsi
                        <span class="text-slate-400 font-normal">(opsional)</span>
                    </label>
                    <textarea id="edit_deskripsi" name="deskripsi" rows="3"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all leading-relaxed"></textarea>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Nama Lengkap <span
                            class="text-rose-500">*</span></label>
                    <input type="text" id="edit_nama" name="nama" required
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Username / Handle <span
                            class="text-rose-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 font-bold">@</span>
                        <input type="text" id="edit_username" name="username" required
                            class="w-full pl-7 pr-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                    </div>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Platform <span
                            class="text-rose-500">*</span></label>
                    <select id="edit_platform" name="platform"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all bg-white">
                        <option value="TikTok">TikTok</option>
                        <option value="Instagram">Instagram</option>
                    </select>
                </div>
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
                    <p class="text-[10px] text-slate-400 mt-1" id="errorEditFoto">Maks 2 MB (JPG, PNG)</p>
                </div>
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
        function bukaModalTambah() {
            document.getElementById('modalTambah').classList.remove('hidden');
            document.getElementById('modalTambah').classList.add('flex');
        }
        function tutupModalTambah() {
            document.getElementById('modalTambah').classList.add('hidden');
            document.getElementById('modalTambah').classList.remove('flex');
        }
        function bukaModalEdit(id, nama, judul, subJudul, deskripsi, username, platform, fotoUrl) {
            document.getElementById('formEdit').action = `/dashboard-admin/kreator/${id}`;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_judul').value = judul;
            document.getElementById('edit_sub_judul').value = subJudul;
            document.getElementById('edit_deskripsi').value = deskripsi;
            document.getElementById('edit_username').value = username;
            document.getElementById('edit_platform').value = platform;
            const wrap = document.getElementById('edit_preview_wrap');
            const img = document.getElementById('edit_preview_img');
            if (fotoUrl) { img.src = fotoUrl; wrap.classList.remove('hidden'); }
            else { wrap.classList.add('hidden'); }
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

        /**
            * Function untuk mengatasi double submit
            **/

        // Tambah / Add
        const formTambah = document.getElementById('myForm');
        const btnTambah = document.getElementById('btnAdd');

        if (formTambah && btnTambah) {
            formTambah.addEventListener('submit', function () {
                btnTambah.disabled = true;
                btnTambah.innerHTML =
                    `
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Menyimpan...
                    `;
            });
        }

        // Edit 
        const formEdit = document.getElementById('formEdit');
        const btnEdit = document.getElementById('btnEdit');

        if (formEdit && btnEdit) {
            formEdit.addEventListener('submit', function () {
                btnEdit.disabled = true;
                btnEdit.innerHTML =
                    `
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Menyimpan...
                    `;
            });
        }

        // Validasi ukuran file foto
        const fotoTambahInput = document.getElementById('fotoTambah');
        const errorTambahFotoMsg = document.getElementById('errorTambahFoto');
        if (fotoTambahInput && errorTambahFotoMsg) {
            fotoTambahInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file && file.size > 2 * 1024 * 1024) {
                    errorTambahFotoMsg.textContent = 'Foto maksimal 2MB';
                    errorTambahFotoMsg.className = 'text-[10px] text-rose-500 font-bold mt-1 animate-pulse';
                    this.value = ''; // Reset input agar tidak dikirim
                } else {
                    errorTambahFotoMsg.textContent = 'Maks 2 MB (JPG, PNG)';
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
                    errorEditFotoMsg.textContent = 'foto terlalu besar 2mb';
                    errorEditFotoMsg.className = 'text-[10px] text-rose-500 font-bold mt-1 animate-pulse';
                    this.value = ''; // Reset input agar tidak dikirim
                } else {
                    errorEditFotoMsg.textContent = 'Maks 2 MB (JPG, PNG)';
                    errorEditFotoMsg.className = 'text-[10px] text-slate-400 mt-1';
                }
            });
        }
    </script>
@endpush