{{-- resources/views/admin/profil_perusahaan/index.blade.php --}}
@extends('layouts.sidebar')

@section('title', 'Profil Perusahaan')
@section('page_title', 'Profil Perusahaan')

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

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm font-bold text-slate-800">Profil Perusahaan</h3>
                <p class="text-slate-400 mt-0.5">Konten yang tampil di section profil landing page</p>
            </div>
            <button onclick="bukaModalTambah()"
                class="px-4 py-2.5 bg-blue-700 hover:bg-blue-800 text-white font-bold rounded-xl transition-all flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Profil
            </button>
        </div>

        {{-- Tabel --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-3.5 font-bold text-slate-600 uppercase tracking-wider text-[10px] w-8">#</th>
                        <th class="px-5 py-3.5 font-bold text-slate-600 uppercase tracking-wider text-[10px]">Foto</th>
                        <th class="px-5 py-3.5 font-bold text-slate-600 uppercase tracking-wider text-[10px]">Judul</th>
                        <th class="px-5 py-3.5 font-bold text-slate-600 uppercase tracking-wider text-[10px]">Sub Judul</th>
                        <th class="px-5 py-3.5 font-bold text-slate-600 uppercase tracking-wider text-[10px]">Konten</th>
                        <th class="px-5 py-3.5 font-bold text-slate-600 uppercase tracking-wider text-[10px] text-right">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($profils as $i => $item)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-5 py-4 text-slate-400 font-mono">{{ $i + 1 }}</td>
                            <td class="px-5 py-4">
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}"
                                        class="w-14 h-10 object-cover rounded-lg border border-slate-200">
                                @else
                                    <div class="w-14 h-10 bg-slate-100 rounded-lg flex items-center justify-center text-slate-300">
                                        <i class="fa-solid fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-5 py-4 font-semibold text-slate-800">{{ $item->judul }}</td>
                            <td class="px-5 py-4 text-slate-500">{{ $item->sub_judul ?? '-' }}</td>
                            <td class="px-5 py-4 text-slate-500 max-w-xs truncate">{{ $item->konten }}</td>
                            <td class="px-5 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button onclick="bukaModalEdit(
                                                                                                                    {{ $item->id }},
                                                                                                                    '{{ addslashes($item->judul) }}',
                                                                                                                    '{{ addslashes($item->sub_judul ?? '') }}',
                                                                                                                    '{{ addslashes($item->konten) }}',
                                                                                                                    '{{ $item->foto ? asset('storage/' . $item->foto) : '' }}'
                                                                                                                )"
                                        class="px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 font-bold rounded-lg border border-amber-200 transition-all">
                                        <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                                    </button>
                                    <button onclick="bukaModalHapus({{ $item->id }}, '{{ addslashes($item->judul) }}')"
                                        class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold rounded-lg border border-rose-200 transition-all">
                                        <i class="fa-solid fa-trash mr-1"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center text-slate-400">
                                <i class="fa-solid fa-building-user text-3xl mb-3 block opacity-30"></i>
                                Belum ada profil. Klik "Tambah Profil" untuk memulai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
                    <h3 class="font-bold text-sm text-slate-800">Tambah Profil Baru</h3>
                </div>
                <button onclick="tutupModalTambah()" class="text-slate-400 hover:text-slate-600 p-1">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <form action="{{ route('admin.profil.store') }}" method="POST" enctype="multipart/form-data" id="myForm"
                class="p-6 space-y-4 text-xs overflow-y-auto">
                @csrf
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Judul <span
                            class="text-rose-500">*</span></label>
                    <input type="text" name="judul" required placeholder="Contoh: Tentang Kami"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Sub Judul
                        <span class="text-slate-400 font-normal">(opsional)</span>
                    </label>
                    <input type="text" name="sub_judul" placeholder="Contoh: Siapa Kami"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Konten <span
                            class="text-rose-500">*</span></label>
                    <textarea name="konten" rows="5" required placeholder="Isi konten profil perusahaan..."
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all leading-relaxed"></textarea>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Foto
                        <span class="text-slate-400 font-normal">(opsional)</span>
                    </label>
                    <input type="file" name="foto" accept="image/*"
                        class="w-full px-2 py-1.5 rounded-xl border border-slate-200 text-[11px] file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-[10px] file:font-semibold file:bg-slate-100 file:text-slate-700">
                    <p class="text-[10px] text-slate-400 mt-1">Maks 5 MB (JPG, PNG, WEBP)</p>
                </div>
                <div class="pt-2 flex justify-end gap-2 border-t border-slate-100">
                    <button type="button" onclick="tutupModalTambah()"
                        class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-all">Batal</button>
                    <button type="submit" id="btnSubmit"
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
                    <h3 class="font-bold text-sm text-slate-800">Edit Profil</h3>
                </div>
                <button onclick="tutupModalEdit()" class="text-slate-400 hover:text-slate-600 p-1">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <form id="formEdit" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 text-xs overflow-y-auto">
                @csrf
                @method('PUT')
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Judul <span
                            class="text-rose-500">*</span></label>
                    <input type="text" id="edit_judul" name="judul" required
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
                    <label class="block font-semibold text-slate-700 mb-1.5">Konten <span
                            class="text-rose-500">*</span></label>
                    <textarea id="edit_konten" name="konten" rows="5" required
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
                    <h3 class="font-bold text-slate-800 text-sm">Hapus Profil?</h3>
                    <p class="text-slate-500 mt-1">Data <span id="hapus_nama" class="font-bold text-slate-800"></span> akan
                        dihapus permanen.</p>
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
        function bukaModalEdit(id, judul, subJudul, konten, fotoUrl) {
            document.getElementById('formEdit').action = `/dashboard-admin/profil/${id}`;
            document.getElementById('edit_judul').value = judul;
            document.getElementById('edit_sub_judul').value = subJudul;
            document.getElementById('edit_konten').value = konten;
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
            document.getElementById('formHapus').action = `/dashboard-admin/profil/${id}`;
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
        const btnTambah = document.getElementById('btnSubmit');

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