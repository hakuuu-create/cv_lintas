<div id="modalCreate"
    class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4 transition-all duration-300">
    <div
        class="bg-white rounded-2xl w-full max-w-xl shadow-2xl border border-slate-100 overflow-hidden transform transition-all">

        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-start">
            <div class="flex gap-4">
                <div
                    class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-700 shrink-0 border border-emerald-100/50">
                    <i class="fa-solid fa-plus text-base"></i>
                </div>
                <div>
                    <h3 class="font-bold text-sm text-slate-800 tracking-tight">Tambah Baru</h3>
                    <p class="text-slate-400 text-[11px] mt-0.5 font-medium">Kirim portofolio baru ke web depan.
                    </p>
                </div>
            </div>
            <button type="button" onclick="closeModal('modalCreate')"
                class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-50 cursor-pointer">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>

        <form action="{{ route('portofolio.store') }}" method="POST" enctype="multipart/form-data" class="text-xs">
            @csrf
            <div class="px-6 py-4 space-y-4 max-h-[65vh] overflow-y-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pb-3 border-b border-slate-50">

                    {{-- Sub-judul --}}
                    <div class="md:col-span-2">
                        <label class="block font-semibold text-slate-700 mb-1.5">Sub Judul</label>
                        <input type="text" name="sub_judul" required
                            placeholder="Contoh: Rekayasa Akademik, Profil Digital, Sekolah Pintar"
                            class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/5 transition-all">
                    </div>

                    {{-- Judul --}}
                    <div class="md:col-span-2">
                        <label class="block font-semibold text-slate-700 mb-1.5">Judul</label>
                        <input type="text" name="judul" required
                            placeholder="Contoh: Sistem Akademik, Website Company Profile, E-Commerce"
                            class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/5 transition-all">
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="pb-3 border-b border-slate-50">
                    <label class="block font-semibold text-slate-700 mb-1.5">
                        Deskripsi <span class="text-slate-400 font-normal">(Maks 500 Karakter)</span>
                    </label>

                    <textarea name="deskripsi" id="input_deskripsi" rows="2" required maxlength="500"
                        placeholder="Tuliskan deskripsi untuk bagian kartu preview halaman depan..."
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/5 transition-all text-slate-800 leading-normal"></textarea>

                    <div class="flex justify-end mt-1">
                        <span class="text-xs text-slate-400">
                            <span id="hitung_karakter" class="font-medium text-slate-500">0</span> / 500 karakter
                        </span>
                    </div>
                </div>


                {{-- Foto --}}
                <div class="pb-3 border-b border-slate-50">
                    <label class="block font-semibold text-slate-700 mb-1.5">Foto <span
                            class="text-slate-400 font-normal">(Format Landscape Disarankan)</span></label>
                    <input type="file" name="foto" required accept="image/*"
                        class="w-full px-2 py-2 rounded-xl border border-slate-200 file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-[10px] file:font-semibold file:bg-emerald-50 file:text-emerald-700">
                </div>

                {{-- Status Penayangan --}}
                <div class="pb-1">
                    <label class="block font-semibold text-slate-700 mb-1.5">Status Penayangan di Landing Page</label>
                    <select name="is_active"
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/5 transition-all">
                        <option value="1" selected>Tampilkan (Aktif)</option>
                        <option value="0">Sembunyikan (Nonaktif)</option>
                    </select>
                </div>
            </div>

            {{-- Simpan --}}
            <div class="px-6 py-4 bg-slate-50/60 border-t border-slate-100 flex justify-end gap-2">
                <button type="button" onclick="closeModal('modalCreate')"
                    class="px-4 py-2.5 bg-white text-slate-600 border border-slate-200 rounded-xl font-bold cursor-pointer hover:bg-slate-50">Batal</button>
                <button type="submit"
                    class="px-4 py-2.5 bg-emerald-800 hover:bg-emerald-900 text-white rounded-xl font-bold shadow-sm cursor-pointer">Terbitkan
                    Berita</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const textarea = document.getElementById('input_deskripsi');
        const counter = document.getElementById('hitung_karakter');

        // Fungsi untuk menghitung dan memperbarui teks counter
        function perbaruiHitungan() {
            const jumlahKarakter = textarea.value.length;
            counter.innerText = jumlahKarakter;

            // Variasi UX Tambahan: Jika sudah mendekati batas (misal 450+), ubah warna tulisan jadi orange/merah
            if (jumlahKarakter >= 480) {
                counter.classList.remove('text-slate-500', 'text-amber-500');
                counter.classList.add('text-rose-600'); // Merah jika kritis
            } else if (jumlahKarakter >= 450) {
                counter.classList.remove('text-slate-500', 'text-rose-600');
                counter.classList.add('text-amber-500'); // Orange jika peringatan
            } else {
                counter.classList.remove('text-amber-500', 'text-rose-600');
                counter.classList.add('text-slate-500'); // Normal
            }
        }

        // Jalankan fungsi setiap kali ada ketikan (input) dari user
        textarea.addEventListener('input', perbaruiHitungan);

        // Jalankan sekali di awal untuk mengantisipasi jika form ini adalah form "Edit Data" 
        // sehingga angka counter tidak mulai dari 0 melainkan mendeteksi teks lama yang sudah ada.
        perbaruiHitungan();
    });
</script>