{{-- Slider otomatis. Butuh variabel $slides (array). --}}
<section class="relative bg-primary text-white overflow-hidden" data-slider>
    <div class="relative h-[540px] md:h-[580px]">
        @foreach ($slides as $i => $s)
            <div data-slide class="absolute inset-0 transition-opacity duration-700 {{ $i === 0 ? 'opacity-100' : 'opacity-0 pointer-events-none' }}">
                @if ($s['foto'])
                    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset($s['foto']) }}')"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-primary via-primary/85 to-primary/40"></div>
                @else
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-container via-primary to-primary"></div>
                    <div class="absolute -right-24 -top-24 w-96 h-96 rounded-full bg-tertiary-fixed/10 blur-3xl"></div>
                    <div class="absolute right-10 bottom-10 w-64 h-64 rounded-full bg-white/5 blur-2xl"></div>
                @endif

                <div class="relative max-w-6xl mx-auto h-full px-6 flex items-center">
                    <div class="max-w-2xl space-y-5">
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 text-tertiary-fixed text-xs font-semibold uppercase tracking-wide">
                            <span class="w-2 h-2 rounded-full bg-tertiary-fixed animate-pulse"></span>{{ $s['badge'] }}
                        </span>
                        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight leading-tight">{{ $s['judul'] }}</h1>
                        <p class="text-lg text-primary-fixed-dim leading-relaxed">{{ $s['isi'] }}</p>
                        <div class="flex flex-wrap gap-3 pt-2">
                            <a href="{{ $s['cta'][1] }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-tertiary-fixed text-primary font-bold shadow-md hover:bg-tertiary-fixed-dim hover:text-white transition-colors">
                                {{ $s['cta'][0] }} <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                            </a>
                            @if (!empty($s['cta2']))
                                <a href="{{ $s['cta2'][1] }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-white/10 font-semibold hover:bg-white/20 transition-colors">{{ $s['cta2'][0] }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <button type="button" data-prev class="absolute left-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/10 hover:bg-white/25 backdrop-blur grid place-items-center transition-colors" aria-label="Sebelumnya">
            <span class="material-symbols-outlined">chevron_left</span>
        </button>
        <button type="button" data-next class="absolute right-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-white/10 hover:bg-white/25 backdrop-blur grid place-items-center transition-colors" aria-label="Berikutnya">
            <span class="material-symbols-outlined">chevron_right</span>
        </button>

        <div class="absolute bottom-8 inset-x-0 flex items-center justify-center gap-2">
            @foreach ($slides as $i => $s)
                <button type="button" data-dot class="h-2 rounded-full bg-white/40 transition-all {{ $i === 0 ? 'w-8 !bg-tertiary-fixed' : 'w-2' }}" aria-label="Slide {{ $i + 1 }}"></button>
            @endforeach
        </div>
        <div class="absolute bottom-0 inset-x-0 h-1 bg-white/10"><div data-bar class="h-full bg-tertiary-fixed-dim w-0"></div></div>
    </div>
</section>

@push('scripts')
<script>
    (function () {
        var root = document.querySelector('[data-slider]');
        if (!root) return;
        var slides = [].slice.call(root.querySelectorAll('[data-slide]'));
        var dots = [].slice.call(root.querySelectorAll('[data-dot]'));
        var bar = root.querySelector('[data-bar]');
        var DURASI = 5500, i = 0, timer = null;

        function tampil(n) {
            i = (n + slides.length) % slides.length;
            slides.forEach(function (s, k) {
                s.classList.toggle('opacity-100', k === i);
                s.classList.toggle('opacity-0', k !== i);
                s.classList.toggle('pointer-events-none', k !== i);
            });
            dots.forEach(function (d, k) {
                d.classList.toggle('w-8', k === i); d.classList.toggle('w-2', k !== i);
                d.classList.toggle('!bg-tertiary-fixed', k === i);
            });
            if (bar) {
                bar.style.transition = 'none'; bar.style.width = '0%'; void bar.offsetWidth;
                bar.style.transition = 'width ' + DURASI + 'ms linear'; bar.style.width = '100%';
            }
        }
        function berhenti() { if (timer) clearInterval(timer); timer = null; }
        function mulai() { berhenti(); timer = setInterval(function () { tampil(i + 1); }, DURASI); tampil(i); }

        root.querySelector('[data-next]').addEventListener('click', function () { tampil(i + 1); mulai(); });
        root.querySelector('[data-prev]').addEventListener('click', function () { tampil(i - 1); mulai(); });
        dots.forEach(function (d, k) { d.addEventListener('click', function () { tampil(k); mulai(); }); });
        root.addEventListener('mouseenter', function () { berhenti(); if (bar) bar.style.transition = 'none'; });
        root.addEventListener('mouseleave', mulai);

        var x0 = null;
        root.addEventListener('touchstart', function (e) { x0 = e.touches[0].clientX; }, { passive: true });
        root.addEventListener('touchend', function (e) {
            if (x0 === null) return;
            var dx = e.changedTouches[0].clientX - x0;
            if (Math.abs(dx) > 50) { tampil(dx < 0 ? i + 1 : i - 1); mulai(); }
            x0 = null;
        });
        mulai();
    })();
</script>
@endpush
