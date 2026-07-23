{{-- resources/views/admin/portofolio/index.blade.php --}}
@extends('layouts.sidebar')

@section('title', 'Portofolio')
@section('page_title', 'Manajemen Portofolio')

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
                <h3 class="text-sm font-bold text-slate-800">Daftar Portofolio</h3>
                <p class="text-slate-400 mt-0.5">
                    {{ $portofolios->count() }} total &mdash;
                    <span class="text-emerald-600 font-semibold">{{ $activeCount }} aktif</span>
                    <span class="text-slate-300">/</span>
                    <span class="text-slate-400">maks 3 tampil di landing page</span>
                </p>
            </div>
            <button onclick="bukaModalTambah()"
                class="px-4 py-2.5 bg-blue-700 hover:bg-blue-800 text-white font-bold rounded-xl transition-all flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Portofolio
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            @forelse($portofolios as $item)
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                    <div class="relative aspect-video bg-slate-100 overflow-hidden">
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full text-slate-300">
                                <i class="fa-solid fa-image text-4xl"></i>
                            </div>
                        @endif
                        <div class="absolute top-2 right-2">
                            @if($item->is_active)
                                <span class="px-2.5 py-1 bg-emerald-600 text-white text-[10px] font-bold rounded-full shadow">
                                    <i class="fa-solid fa-eye mr-1"></i>Aktif
                                </span>
                            @else
                                <span class="px-2.5 py-1 bg-slate-600 text-white text-[10px] font-bold rounded-full shadow">
                                    <i class="fa-solid fa-eye-slash mr-1"></i>Nonaktif
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="p-4 flex flex-col flex-1 space-y-2">
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">{{ $item->sub_judul }}</p>
                        <h4 class="font-bold text-slate-800 text-sm leading-tight">{{ $item->judul }}</h4>
                        <p class="text-slate-500 leading-relaxed line-clamp-2 flex-1">{{ $item->deskripsi }}</p>
                        <div class="flex gap-2 pt-2 border-t border-slate-100">
                            <button onclick="bukaModalEdit(
                                    {{ $item->id }},
                                    '{{ addslashes($item->judul) }}',
                                    '{{ addslashes($item->sub_judul) }}',
                                    '{{ addslashes($item->deskripsi) }}',
                                    {{ $item->is_active }},
                                    '{{ $item->foto ? asset('storage/' . $item->foto) : '' }}'
                                )"
                                class="flex-1 py-2 bg-amber-50 hover:bg-amber-100 text-amber-700 font-bold rounded-lg border border-amber-200 transition-all text-center">
                                <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                            </button>
                            <button onclick="bukaModalHapus({{ $item->id }}, '{{ addslashes($item->judul) }}')"
                                class="flex-1 py-2 bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold rounded-lg border border-rose-200 transition-all text-center">
                                <i class="fa-solid fa-trash mr-1"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="md:col-span-3 bg-white rounded-2xl border border-slate-200 py-16 text-center text-slate-400">
                    <i class="fa-solid fa-clipboard-list text-4xl mb-3 block opacity-30"></i>
                    Belum ada portofolio. Klik "Tambah Portofolio" untuk memulai.
                </div>
            @endforelse
        </div>
    </div>

    {{-- MODAL TAMBAH --}}
    <div id="modalTambah" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="tutupModalTambah()"></div>
        <div
            class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg z-10 overflow-hidden max-h-[90vh] flex flex-col">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50 flex items-center justify-between shrink-0">
                <div class="flex items-center gap-3">
                    <div
                        class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center text-blue-700 border border-blue-100">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <h3 class="font-bold text-sm text-slate-800">Tambah Portofolio Baru</h3>
                </div>
                <button onclick="tutupModalTambah()" class="text-slate-400 hover:text-slate-600 p-1">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <form action="{{ route('admin.portofolio.store') }}" method="POST" enctype="multipart/form-data" id="myForm"
                class="p-6 space-y-4 text-xs overflow-y-auto">
                @csrf
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Judul Proyek <span
                            class="text-rose-500">*</span></label>
                    <input type="text" name="judul" required placeholder="Contoh: Website Toko Online Batik"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Sub Judul <span
                            class="text-rose-500">*</span></label>
                    <input type="text" name="sub_judul" required placeholder="Contoh: E-Commerce / Web Development"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Deskripsi <span
                            class="text-rose-500">*</span></label>
                    <textarea name="deskripsi" rows="3" required placeholder="Jelaskan proyek ini..."
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all leading-relaxed"></textarea>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Foto Proyek <span
                            class="text-rose-500">*</span></label>
                    <input type="file" name="foto" accept="image/*" required
                        class="w-full px-2 py-1.5 rounded-xl border border-slate-200 text-[11px] file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-[10px] file:font-semibold file:bg-slate-100 file:text-slate-700">
                    <p class="text-[10px] text-slate-400 mt-1">Maks 5 MB (JPG, PNG, WEBP)</p>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Status Tampil</label>
                    <select name="is_active"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all bg-white">
                        <option value="1">Aktif (tampil di landing page)</option>
                        <option value="0">Nonaktif (disembunyikan)</option>
                    </select>
                    <p class="text-[10px] text-amber-600 font-semibold mt-1">
                        <i class="fa-solid fa-triangle-exclamation mr-1"></i>Maksimal 3 portofolio aktif yang bisa tampil.
                    </p>
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
            class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg z-10 overflow-hidden max-h-[90vh] flex flex-col">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50 flex items-center justify-between shrink-0">
                <div class="flex items-center gap-3">
                    <div
                        class="w-9 h-9 bg-amber-50 rounded-xl flex items-center justify-center text-amber-700 border border-amber-100">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                    <h3 class="font-bold text-sm text-slate-800">Edit Portofolio</h3>
                </div>
                <button onclick="tutupModalEdit()" class="text-slate-400 hover:text-slate-600 p-1">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <form id="formEdit" action="" method="POST" enctype="multipart/form-data"
                class="p-6 space-y-4 text-xs overflow-y-auto">
                @csrf
                @method('PUT')
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Judul Proyek <span
                            class="text-rose-500">*</span></label>
                    <input type="text" id="edit_judul" name="judul" required
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Sub Judul <span
                            class="text-rose-500">*</span></label>
                    <input type="text" id="edit_sub_judul" name="sub_judul" required
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Deskripsi <span
                            class="text-rose-500">*</span></label>
                    <textarea id="edit_deskripsi" name="deskripsi" rows="3" required
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all leading-relaxed"></textarea>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Ganti Foto
                        <span class="text-slate-400 font-normal">(kosongkan jika tidak ingin mengganti)</span>
                    </label>
                    <div id="edit_preview_wrap" class="mb-2 hidden">
                        <img id="edit_preview_img" src="" alt="Preview"
                            class="w-32 h-20 object-cover rounded-lg border border-slate-200">
                    </div>
                    <input type="file" name="foto" accept="image/*"
                        class="w-full px-2 py-1.5 rounded-xl border border-slate-200 text-[11px] file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-[10px] file:font-semibold file:bg-slate-100 file:text-slate-700">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Status Tampil</label>
                    <select id="edit_is_active" name="is_active"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all bg-white">
                        <option value="1">Aktif (tampil di landing page)</option>
                        <option value="0">Nonaktif (disembunyikan)</option>
                    </select>
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
                    <h3 class="font-bold text-slate-800 text-sm">Hapus Portofolio?</h3>
                    <p class="text-slate-500 mt-1">Proyek <span id="hapus_nama" class="font-bold text-slate-800"></span> dan
                        fotonya akan dihapus permanen.</p>
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
        function bukaModalEdit(id, judul, subJudul, deskripsi, isActive, fotoUrl) {
            document.getElementById('formEdit').action = `/dashboard-admin/portofolio/${id}`;
            document.getElementById('edit_judul').value = judul;
            document.getElementById('edit_sub_judul').value = subJudul;
            document.getElementById('edit_deskripsi').value = deskripsi;
            document.getElementById('edit_is_active').value = isActive;
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
            document.getElementById('formHapus').action = `/dashboard-admin/portofolio/${id}`;
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
    </script>
@endpush