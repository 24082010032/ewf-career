{{-- Jendela detail lowongan. Butuh variabel $dataJs. Hanya dipasang untuk pengguna yang sudah login. --}}
<div id="modal" class="fixed inset-0 z-[60] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-primary/60 backdrop-blur-sm" data-close></div>
    <div class="relative w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-3xl bg-white shadow-2xl">
        <div class="sticky top-0 bg-white/95 backdrop-blur flex items-start justify-between gap-4 p-6 border-b border-surface-container">
            <div>
                <span id="m-kategori" class="px-2.5 py-1 rounded bg-surface-container text-primary text-xs font-semibold"></span>
                <h3 id="m-judul" class="text-2xl font-extrabold text-primary mt-3"></h3>
            </div>
            <button type="button" data-close class="w-10 h-10 shrink-0 rounded-full hover:bg-surface-container-low grid place-items-center" aria-label="Tutup">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="p-6 space-y-5">
            <div class="grid sm:grid-cols-2 gap-3 text-sm">
                <div class="p-4 rounded-xl bg-surface-container-low"><p class="text-xs text-on-surface-variant">Departemen</p><p id="m-dept" class="font-semibold text-primary"></p></div>
                <div class="p-4 rounded-xl bg-surface-container-low"><p class="text-xs text-on-surface-variant">Tipe</p><p id="m-tipe" class="font-semibold text-primary"></p></div>
                <div class="p-4 rounded-xl bg-surface-container-low"><p class="text-xs text-on-surface-variant">Pengalaman</p><p id="m-pengalaman" class="font-semibold text-primary"></p></div>
                <div class="p-4 rounded-xl bg-surface-container-low"><p class="text-xs text-on-surface-variant">Batas Lamaran</p><p id="m-batas" class="font-semibold text-primary"></p></div>
            </div>
            <div>
                <h4 class="font-bold text-primary mb-1">Deskripsi</h4>
                <p id="m-deskripsi" class="text-sm text-on-surface-variant leading-relaxed"></p>
            </div>
            <div>
                <h4 class="font-bold text-primary mb-1">Lokasi Penempatan</h4>
                <p class="text-sm text-on-surface-variant"><span id="m-lokasi" class="font-semibold text-primary"></span><br><span id="m-alamat"></span></p>
            </div>
            <button type="button" id="m-lamar" class="w-full py-3.5 rounded-lg bg-primary text-white font-bold hover:bg-primary-container transition-colors flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">send</span> Lamar Sekarang
            </button>
        </div>
    </div>
</div>

<div id="toast" class="fixed bottom-6 left-1/2 -translate-x-1/2 z-[70] hidden px-5 py-3 rounded-xl bg-primary text-white text-sm font-semibold shadow-2xl"></div>

@push('scripts')
<script>
    const DATA_LOWONGAN = @json($dataJs);

    (function () {
        var modal = document.getElementById('modal');
        var toast = document.getElementById('toast'), tt = null;
        function pesan(teks) {
            toast.textContent = teks; toast.classList.remove('hidden');
            clearTimeout(tt); tt = setTimeout(function () { toast.classList.add('hidden'); }, 3200);
        }
        function buka(id) {
            var d = DATA_LOWONGAN.find(function (x) { return x.id === id; });
            if (!d) return;
            var set = function (k, v) { document.getElementById(k).textContent = v || '-'; };
            set('m-kategori', d.kategori); set('m-judul', d.judul); set('m-dept', d.departemen);
            set('m-tipe', d.tipe); set('m-pengalaman', d.pengalaman);
            set('m-batas', d.batas + ' (' + d.sisa + ' hari lagi)');
            set('m-deskripsi', d.deskripsi); set('m-lokasi', d.lokasi); set('m-alamat', d.alamat);
            modal.classList.remove('hidden'); modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
        function tutup() {
            modal.classList.add('hidden'); modal.classList.remove('flex');
            document.body.style.overflow = '';
        }
        document.querySelectorAll('[data-detail]').forEach(function (b) {
            b.addEventListener('click', function () { buka(parseInt(b.getAttribute('data-detail'), 10)); });
        });
        modal.querySelectorAll('[data-close]').forEach(function (b) { b.addEventListener('click', tutup); });
        document.addEventListener('keydown', function (e) { if (e.key === 'Escape') tutup(); });
        document.getElementById('m-lamar').addEventListener('click', function () {
            pesan('Formulir lamaran sedang disiapkan dan segera tersedia.');
        });
    })();
</script>
@endpush
