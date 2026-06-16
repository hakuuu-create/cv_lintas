@extends('layouts.sidebar')

@section('title', 'Portofolio')
@section('page_title', 'Manajemen Publikasi Portofolio')

@section('content')
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm text-xs">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
            <div>
                <h3 class="text-sm font-bold text-slate-800">Arsip </h3>
                <p class="text-slate-400 mt-0.5">Kelola seluruh konten</p>
                <p
                    class="mt-1.5 inline-flex items-center gap-1.5 text-[11px] font-bold {{ $activeCount >= 3 ? 'text-rose-600' : 'text-emerald-600' }}">
                    <i class="fa-solid fa-circle-dot text-[8px]"></i>
                    Portofolio Aktif di Landing Page: {{ $activeCount }}/3
                </p>
            </div>
            <button type="button" @if($activeCount >= 3) disabled
                title="Batas maksimal 3 portofolio aktif sudah tercapai. Nonaktifkan salah satu untuk menambah yang baru."
                class="px-4 py-2.5 bg-slate-200 text-slate-400 font-bold rounded-xl shadow-sm flex items-center gap-1.5 self-start sm:self-auto cursor-not-allowed"
            @else onclick="openModal('modalCreate')"
                    class="px-4 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white font-bold rounded-xl shadow-sm flex items-center gap-1.5 self-start sm:self-auto cursor-pointer transition-all"
                @endif>
                Tambah Portofolio Baru
            </button>
        </div>

        @if(session('success'))
            <div class="p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 font-bold rounded-xl mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="p-3 bg-rose-50 border border-rose-200 text-rose-800 font-bold rounded-xl mb-4 flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto border border-slate-100 rounded-xl">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 font-bold border-b border-slate-100">
                        <th class="p-3" width="6%">No</th>
                        <th class="p-3" width="15%">Foto</th>
                        <th class="p-3">Sub Judul</th>
                        <th class="p-3">Judul</th>
                        <th class="p-3" width="14%">Deskripsi</th>
                        <th class="p-3 text-center" width="16%">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-slate-600 divide-y divide-slate-50">
                    @forelse($portofolios as $index => $row)
                        <tr class="hover:bg-slate-50/50 transition-colors">

                            {{-- Looping penomoran --}}
                            <td class="p-3 font-medium">{{ $loop->iteration }}</td>

                            {{-- foto --}}
                            <td class="p-3">
                                <div class="w-16 h-10 bg-slate-100 rounded-md overflow-hidden border border-slate-200/60">
                                    @if($row->foto)
                                        <img src="{{ asset('storage/' . $row->foto) }}" class="w-full h-full object-cover">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-400 text-[10px]">
                                            No Image</div>
                                    @endif
                                </div>
                            </td>

                            {{-- sub-judul --}}
                            <td class="p-3 font-semibold text-slate-800 max-w-xs truncate">{{ $row->sub_judul }}</td>

                            {{-- judul --}}
                            <td class="p-3 font-semibold text-slate-800 max-w-xs truncate">{{ $row->judul }}</td>

                            {{-- deskripsi --}}
                            <td class="p-3 font-medium text-slate-500">{{ $row->deskripsi }}</td>

                            {{-- Aksi: Preview, Edit, Hapus --}}
                            <td class="p-3">
                                <div class="flex justify-center gap-1.5">
                                    <button type="button" onclick="showKegiatan({{ $row->id }})"
                                        class="p-2 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg cursor-pointer"
                                        title="Pratinjau"><i class="fa-solid fa-eye"></i></button>

                                    <button type="button" onclick="editKegiatan({{ $row->id }})"
                                        class="p-2 text-amber-600 bg-amber-50 hover:bg-amber-100 rounded-lg cursor-pointer"
                                        title="Edit"><i class="fa-solid fa-pen-to-square"></i></button>

                                    <form action="{{ route('portofolio.destroy', $row->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumentasi kegiatan pondok ini?')"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-lg cursor-pointer"
                                            title="Hapus"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-5 text-center text-slate-400 bg-slate-50/20">Belum ada publikasi berita
                                atau kegiatan pondok pesantren saat ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    @include('media.kegiatan.modals.create')

    @include('media.kegiatan.modals.edit')

    @include('media.kegiatan.modals.detail')

    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            modal.classList.remove('hidden');
            setTimeout(() => { modal.classList.add('opacity-100'); }, 20);
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            modal.classList.remove('opacity-100');
            setTimeout(() => { modal.classList.add('hidden'); }, 150);
        }

        // Ajax Handler Detail Preview Jendela
        function showKegiatan(id) {
            fetch(`/dashboard/portofolio/${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('detail_judul').innerText = data.judul;
                    document.getElementById('detail_konten').innerText = data.deskripsi;
                    document.getElementById('detail_foto').src = data.foto ? `/storage/${data.foto}` : 'https://placehold.co/600x400?text=No+Image';
                    openModal('modalDetail');
                });
        }

        // Ajax Handler Form Pengisian Koreksi Edit
        function editKegiatan(id) {
            fetch(`/dashboard/portofolio/${id}`)
                .then(res => res.json())
                .then(data => {
                    console.log('Data diterima dari API:', data);

                    document.getElementById('edit_sub_judul').value = data.sub_judul;
                    document.getElementById('edit_judul').value = data.judul;

                    // GANTI 'input_deskripsi' MENJADI 'edit_deskripsi' DISINI
                    const deskripsiField = document.getElementById('edit_deskripsi');

                    console.log('Elemen textarea ditemukan?', deskripsiField);
                    deskripsiField.value = data.deskripsi; // Sekarang data deskripsi akan masuk dengan sempurna!

                    deskripsiField.dispatchEvent(new Event('input')); // Memicu text counter di modal edit

                    document.getElementById('edit_is_active').value = data.is_active;

                    const fotoPreview = document.getElementById('edit_foto_preview');
                    if (data.foto) {
                        fotoPreview.src = `/storage/${data.foto}`;
                        fotoPreview.classList.remove('hidden');
                    } else {
                        fotoPreview.classList.add('hidden');
                    }

                    document.getElementById('formEditKegiatan').action = `/dashboard/portofolio/${id}`;
                    openModal('modalEdit');
                });
        }
    </script>
@endsection