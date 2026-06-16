@extends('layouts.sidebar')

@section('title', 'Kreator & Afiliasi')
@section('page_title', 'Pengaturan Section Kreator & Afiliasi')

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

        <form action="{{ route('media.creator.update') }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            @csrf
            @method('PUT')

            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 flex items-center gap-4">
                <div
                    class="w-10 h-10 bg-neutral-100 rounded-lg flex items-center justify-center text-neutral-700 border border-neutral-200">
                    <i class="fa-solid fa-clapperboard text-base"></i>
                </div>
                <div>
                    <h3 class="font-bold text-sm text-slate-900 tracking-tight">Kreator & Afiliasi</h3>
                    <p class="text-slate-400 text-[11px] mt-0.5 font-medium">Atur foto ilustrasi dan daftar akun kreator
                        yang tampil pada section "Optimasi & Tren Digital" di Landing Page.</p>
                </div>
            </div>

            <div class="p-6 space-y-5">

                {{-- Foto Section --}}
                <div class="pb-4 border-b border-slate-50">
                    <label class="block font-semibold text-slate-700 mb-1.5">Foto Ilustrasi Section</label>

                    @if($kreator->foto)
                        <img src="{{ asset('storage/' . $kreator->foto) }}" alt="Foto saat ini"
                            class="w-40 h-28 object-cover rounded-lg border border-slate-200 mb-2">
                    @endif

                    <input type="file" name="foto" accept="image/*"
                        class="w-full px-2 py-1.5 rounded-lg border border-slate-200 text-[11px] file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-[10px] file:font-semibold file:bg-slate-100 file:text-slate-700">
                    <p class="text-[10px] text-slate-400 mt-1">* Kosongkan jika tidak ingin mengganti foto. Maksimal 5 MB
                        (Format: JPG, JPEG, PNG, WEBP).</p>
                </div>

                {{-- Daftar Username Kreator --}}
                <div class="space-y-3">
                    <h4 class="font-bold text-slate-800 text-[11px] uppercase tracking-wider text-slate-400">Afiliasi
                        Kreator Resmi (Maks 3)</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-semibold text-slate-600 mb-1.5">Kreator 1</label>
                            <input type="text" name="username_1" value="{{ old('username_1', $kreator->username_1) }}"
                                placeholder="@anis_khaeriyah"
                                class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:border-neutral-800 focus:ring-4 focus:ring-neutral-800/5 transition-all">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-600 mb-1.5">Kreator 2</label>
                            <input type="text" name="username_2" value="{{ old('username_2', $kreator->username_2) }}"
                                placeholder="@apakatamiii"
                                class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:border-neutral-800 focus:ring-4 focus:ring-neutral-800/5 transition-all">
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-600 mb-1.5">Kreator 3</label>
                            <input type="text" name="username_3" value="{{ old('username_3', $kreator->username_3) }}"
                                placeholder="@uhuy"
                                class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:border-neutral-800 focus:ring-4 focus:ring-neutral-800/5 transition-all">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Simpan --}}
            <div class="px-6 py-4 bg-slate-50/60 border-t border-slate-100 flex justify-end">
                <button type="submit"
                    class="px-5 py-2.5 bg-neutral-900 hover:bg-neutral-800 text-white rounded-lg font-bold shadow-sm shadow-neutral-900/10 transition-all cursor-pointer">
                    <i class="fa-solid fa-floppy-disk mr-1.5"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection