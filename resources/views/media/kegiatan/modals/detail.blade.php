<div id="modalDetail"
    class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4 transition-all duration-300">
    <div
        class="bg-white rounded-2xl w-full max-w-lg shadow-2xl border border-slate-100 overflow-hidden transform transition-all">

        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-start">
            <div class="flex gap-4">
                <div
                    class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-700 shrink-0 border border-blue-100/50">
                    <i class="fa-solid fa-newspaper text-base"></i>
                </div>
                <div>
                    <h3 class="font-bold text-sm text-slate-800 tracking-tight">Pratinjau portofolio</h3>
                    <p class="text-slate-400 text-[11px] mt-0.5 font-medium">Tampilan penuh portofolio</p>
                </div>
            </div>
            <button type="button" onclick="closeModal('modalDetail')"
                class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-50 cursor-pointer">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>

        <div class="p-6 text-xs space-y-4 max-h-[60vh] overflow-y-auto">
            <h2 id="detail_judul" class="font-bold text-base text-slate-800 tracking-tight"></h2>

            <div
                class="rounded-xl overflow-hidden bg-slate-100 border border-slate-200/60 max-h-48 flex items-center justify-center">
                <img id="detail_foto" src="" alt="Dokumentasi Acara" class="w-full h-full object-cover">
            </div>

            <div class="bg-slate-50 p-4 rounded-xl border border-slate-100/80">
                <p id="detail_konten" class="text-slate-600 leading-relaxed text-[11px] whitespace-pre-line">-</p>
            </div>
        </div>

        <div class="px-6 py-4 bg-slate-50/60 border-t border-slate-100 flex justify-end">
            <button type="button" onclick="closeModal('modalDetail')"
                class="w-full py-2.5 bg-slate-800 hover:bg-slate-900 text-white rounded-xl font-bold text-center cursor-pointer">Tutup
                Jendela</button>
        </div>
    </div>
</div>