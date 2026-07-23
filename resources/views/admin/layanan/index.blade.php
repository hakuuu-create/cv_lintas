{{-- resources/views/admin/layanan/index.blade.php --}}
@extends('layouts.sidebar')

@section('title', 'Layanan')
@section('page_title', 'Manajemen Layanan')

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
                <h3 class="text-sm font-bold text-slate-800">Daftar Layanan</h3>
                <p class="text-slate-400 mt-0.5">Total {{ $layanan->count() }} layanan terdaftar</p>
            </div>
            <button onclick="bukaModalTambah()"
                class="px-4 py-2.5 bg-blue-700 hover:bg-blue-800 text-white font-bold rounded-xl transition-all flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Layanan
            </button>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-3.5 font-bold text-slate-600 uppercase tracking-wider text-[10px] w-8">#</th>
                        <th class="px-5 py-3.5 font-bold text-slate-600 uppercase tracking-wider text-[10px]">Icon</th>
                        <th class="px-5 py-3.5 font-bold text-slate-600 uppercase tracking-wider text-[10px]">Nama Layanan
                        </th>
                        <th class="px-5 py-3.5 font-bold text-slate-600 uppercase tracking-wider text-[10px]">Deskripsi</th>
                        <th class="px-5 py-3.5 font-bold text-slate-600 uppercase tracking-wider text-[10px] text-right">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($layanan as $i => $item)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-5 py-4 text-slate-400 font-mono">{{ $i + 1 }}</td>
                            <td class="px-5 py-4">
                                @if($item->icon)
                                    <div
                                        class="w-9 h-9 bg-blue-50 border border-blue-100 rounded-lg flex items-center justify-center text-blue-700">
                                        <i class="{{ $item->icon }}"></i>
                                    </div>
                                @else
                                    <div class="w-9 h-9 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400">
                                        <i class="fa-solid fa-circle-question"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-5 py-4 font-semibold text-slate-800">{{ $item->nama_layanan }}</td>
                            <td class="px-5 py-4 text-slate-500 max-w-xs truncate">{{ $item->deskripsi_singkat }}</td>
                            <td class="px-5 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button
                                        onclick="bukaModalEdit({{ $item->id }}, '{{ addslashes($item->nama_layanan) }}', '{{ addslashes($item->deskripsi_singkat) }}', '{{ $item->icon }}')"
                                        class="px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 font-bold rounded-lg border border-amber-200 transition-all">
                                        <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                                    </button>
                                    <button onclick="bukaModalHapus({{ $item->id }}, '{{ addslashes($item->nama_layanan) }}')"
                                        class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold rounded-lg border border-rose-200 transition-all">
                                        <i class="fa-solid fa-trash mr-1"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-12 text-center text-slate-400">
                                <i class="fa-solid fa-briefcase text-3xl mb-3 block opacity-30"></i>
                                Belum ada layanan. Klik "Tambah Layanan" untuk memulai.
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
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md z-10 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div
                        class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center text-blue-700 border border-blue-100">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <h3 class="font-bold text-sm text-slate-800">Tambah Layanan Baru</h3>
                </div>
                <button onclick="tutupModalTambah()" class="text-slate-400 hover:text-slate-600 p-1">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <form action="{{ route('admin.layanan.store') }}" method="POST" class="p-6 space-y-4 text-xs" id="myForm">
                @csrf
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Nama Layanan <span
                            class="text-rose-500">*</span></label>
                    <input type="text" name="nama_layanan" required placeholder="Contoh: Web Development"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Deskripsi Singkat <span
                            class="text-rose-500">*</span></label>
                    <textarea name="deskripsi_singkat" rows="3" required
                        placeholder="Jelaskan layanan ini secara singkat..."
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all leading-relaxed"></textarea>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Icon FontAwesome
                        <span class="text-slate-400 font-normal">(opsional, contoh: fa-solid fa-code)</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm">
                            <i class="fa-solid fa-icons"></i>
                        </span>
                        <input type="text" name="icon" placeholder="fa-code"
                            class="w-full pl-9 pr-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                    </div>
                    <p class="text-[10px] text-slate-400 mt-1">Lihat daftar icon di <a href="https://fontawesome.com/icons"
                            target="_blank" class="text-blue-600 hover:underline">fontawesome.com/icons</a></p>
                </div>
                <div class="pt-2 flex justify-end gap-2">
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
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md z-10 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div
                        class="w-9 h-9 bg-amber-50 rounded-xl flex items-center justify-center text-amber-700 border border-amber-100">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                    <h3 class="font-bold text-sm text-slate-800">Edit Layanan</h3>
                </div>
                <button onclick="tutupModalEdit()" class="text-slate-400 hover:text-slate-600 p-1">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <form id="formEdit" action="" method="POST" class="p-6 space-y-4 text-xs">
                @csrf
                @method('PUT')
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Nama Layanan <span
                            class="text-rose-500">*</span></label>
                    <input type="text" id="edit_nama_layanan" name="nama_layanan" required
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Deskripsi Singkat <span
                            class="text-rose-500">*</span></label>
                    <textarea id="edit_deskripsi" name="deskripsi_singkat" rows="3" required
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all leading-relaxed"></textarea>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">Icon FontAwesome
                        <span class="text-slate-400 font-normal">(opsional, contoh: fa-solid fa-code)</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm">
                            <i class="fa-solid fa-icons"></i>
                        </span>
                        <input type="text" id="edit_icon" name="icon" placeholder="fa-code"
                            class="w-full pl-9 pr-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all">
                    </div>
                </div>
                <div class="pt-2 flex justify-end gap-2">
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
                    <h3 class="font-bold text-slate-800 text-sm">Hapus Layanan?</h3>
                    <p class="text-slate-500 mt-1">Layanan <span id="hapus_nama" class="font-bold text-slate-800"></span>
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
        function bukaModalEdit(id, nama, deskripsi, icon) {
            document.getElementById('formEdit').action = `/dashboard-admin/layanan/${id}`;
            document.getElementById('edit_nama_layanan').value = nama;
            document.getElementById('edit_deskripsi').value = deskripsi;
            document.getElementById('edit_icon').value = icon ?? '';
            document.getElementById('modalEdit').classList.remove('hidden');
            document.getElementById('modalEdit').classList.add('flex');
        }
        function tutupModalEdit() {
            document.getElementById('modalEdit').classList.add('hidden');
            document.getElementById('modalEdit').classList.remove('flex');
        }
        function bukaModalHapus(id, nama) {
            document.getElementById('formHapus').action = `/dashboard-admin/layanan/${id}`;
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