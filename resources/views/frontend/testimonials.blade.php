{{-- resources/views/frontend/testimonials.blade.php --}}
@extends('layouts.app')

@push('styles')
<style>
/* -- Marquee -- */
@keyframes scrollLeft { from{transform:translateX(0)} to{transform:translateX(-50%)} }
.marquee-inner { animation: scrollLeft 38s linear infinite; display:flex; gap:1.5rem; width:max-content; }
.marquee-wrap:hover .marquee-inner { animation-play-state:paused; }

/* -- Card hover -- */
.t-card { transition: transform .35s cubic-bezier(.16,1,.3,1), box-shadow .35s; }
.t-card:hover { transform: translateY(-7px); box-shadow: 0 24px 48px -14px rgba(0,0,0,.14); }

/* -- Star interactive -- */
.star-btn { cursor:pointer; transition: transform .15s, color .15s; display:inline-block; }
.star-btn:hover { transform:scale(1.3); }

/* -- Form input -- */
.field-input:focus {
  outline:none;
  border-color:#c9a84c !important;
  box-shadow:0 0 0 3px rgba(201,168,76,.15);
}

/* -- Pulse ring -- */
@keyframes pulseRing { 0%{transform:scale(.85);opacity:.7} 100%{transform:scale(1.7);opacity:0} }
.pulse-ring { animation: pulseRing 2.4s ease-out infinite; }

/* -- Particle drift -- */
@keyframes drift {
  0%,100%{transform:translate(0,0) rotate(0deg) scale(1)}
  33%{transform:translate(14px,-20px) rotate(120deg) scale(1.1)}
  66%{transform:translate(-10px,12px) rotate(240deg) scale(.9)}
}
.particle { position:absolute; border-radius:50%; pointer-events:none; animation:drift linear infinite; }
</style>
@endpush

@section('content')

{{-- ======== BANNER ======== --}}
<div class="relative pt-20 overflow-hidden"
     style="background:url('https://images.unsplash.com/photo-1521791136064-7986c2920216?w=1600&q=80&auto=format&fit=crop') center 40% / cover no-repeat;min-height:380px">
  <div class="absolute inset-0" style="background:rgba(0,0,0,.62)"></div>

  @php
    $particles = [[10,20,4,'8s'],[80,55,3,'12s'],[25,75,5,'10s'],[65,30,3,'14s'],[45,60,4,'9s'],[88,80,3,'11s']];
  @endphp
  @foreach($particles as $p)
  <div class="particle" style="left:{{$p[0]}}%;top:{{$p[1]}}%;width:{{$p[2]}}px;height:{{$p[2]}}px;
       background:rgba(201,168,76,{{ $p[2]===5 ? .30 : .18 }});
       animation-duration:{{$p[3]}};animation-delay:-{{ round($p[0]/10,1) }}s"></div>
  @endforeach

  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 py-24 text-center">

    <div class="relative inline-flex items-center justify-center mb-5">
      <div class="pulse-ring absolute w-12 h-12 rounded-full" style="border:1px solid rgba(201,168,76,.4)"></div>
      <div class="w-10 h-10 rounded-full flex items-center justify-center"
           style="background:rgba(201,168,76,.15);border:1px solid rgba(201,168,76,.40)">
        <i class="fas fa-quote-left" style="color:#c9a84c;font-size:.75rem"></i>
      </div>
    </div>

    <div class="flex items-center justify-center gap-2 text-xs font-bold uppercase tracking-[.22em] mb-4" style="color:#c9a84c">
      <span class="w-8 h-px" style="background:#c9a84c"></span>
      <span x-show="lang==='id'">Testimoni Mitra</span>
      <span x-show="lang==='en'">Partner Testimonials</span>
      <span class="w-8 h-px" style="background:#c9a84c"></span>
    </div>
    <h1 class="font-display text-5xl md:text-6xl font-bold text-white mb-4">
      <span x-show="lang==='id'">Kata Mitra <em class="not-italic" style="color:#c9a84c">Global Kami</em></span>
      <span x-show="lang==='en'">What Our <em class="not-italic" style="color:#c9a84c">Global Partners</em> Say</span>
    </h1>
    <p class="text-sm max-w-md mx-auto leading-relaxed" style="color:rgba(255,255,255,.55)">
      <span x-show="lang==='id'">Kepercayaan dari importir dan mitra bisnis di lebih dari 7 negara.</span>
      <span x-show="lang==='en'">Trust from importers and business partners in more than 7 countries.</span>
    </p>

    <div class="flex flex-wrap justify-center gap-10 mt-10">
      @foreach([
        ['7+','id'=>'Negara','en'=>'Countries'],
        ['100%','id'=>'Terverifikasi','en'=>'Verified'],
        ['★ 5.0','id'=>'Rating','en'=>'Rating']
      ] as $s)
      <div class="text-center">
        <div class="font-display text-3xl font-bold" style="color:#c9a84c">{{ $s[0] }}</div>
        <div class="text-xs uppercase tracking-wider mt-0.5" style="color:rgba(255,255,255,.45)">
          <span x-show="lang==='id'">{{ $s['id'] }}</span>
          <span x-show="lang==='en'">{{ $s['en'] }}</span>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <div class="absolute bottom-0 inset-x-0 h-px"
       style="background:linear-gradient(to right,transparent,rgba(201,168,76,.45),transparent)"></div>
</div>

{{-- ======== MARQUEE STRIP ======== --}}
<div class="overflow-hidden py-3 marquee-wrap" style="background:#c9a84c">
  <div class="marquee-inner">
    @php
      $items = ['Kunyit Premium','★ Terverifikasi','Ekspor Global','Lab Tested','Mitra Terpercaya','SIG Certified','NIB Terdaftar'];
      $loop  = array_merge($items,$items,$items,$items);
    @endphp
    @foreach($loop as $item)
    <span class="flex items-center gap-3 text-white font-semibold text-xs uppercase tracking-[.14em] whitespace-nowrap">
      {{ $item }}<span style="color:rgba(255,255,255,.35)">&bull;</span>
    </span>
    @endforeach
  </div>
</div>

{{-- ======== TESTIMONI GRID ======== --}}
<section class="py-20 bg-cream dark:bg-dark-surface transition-colors duration-300">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">

    @if(session('success'))
    <div class="mb-8 flex items-center gap-3 px-5 py-4 rounded-2xl text-sm reveal"
         style="background:#f0fdf4;border:1px solid #bbf7d0;color:#15803d">
      <i class="fas fa-circle-check flex-shrink-0"></i> {{ session('success') }}
    </div>
    @endif

    @if($testimonials->count())

    <div class="text-center mb-12 reveal">
      <h2 class="font-display text-3xl font-bold text-ink dark:text-white transition-colors">
        <span x-show="lang==='id'">Ulasan <em class="not-italic" style="color:#c9a84c">Terbaru</em></span>
        <span x-show="lang==='en'">Latest <em class="not-italic" style="color:#c9a84c">Reviews</em></span>
      </h2>
      <p class="text-sm text-slate-400 dark:text-gray-500 mt-2">
        <span x-show="lang==='id'">Ditampilkan setelah verifikasi tim kami</span>
        <span x-show="lang==='en'">Displayed after verification by our team</span>
      </p>
    </div>

    <div class="columns-1 sm:columns-2 lg:columns-3 gap-5 mb-10" style="column-gap:1.25rem">
      @foreach($testimonials as $i => $t)
      <div class="break-inside-avoid t-card bg-white dark:bg-dark-card rounded-[1.5rem] p-6 border border-slate-100 dark:border-dark-border mb-5 reveal transition-colors duration-300"
           style="transition-delay:{{ ($i%3)*80 }}ms">

        <div class="flex items-center justify-between mb-4">
          <div>
            <div class="flex gap-0.5 mb-1">
              @for($s=1;$s<=5;$s++)
              <i class="fas fa-star text-sm" style="{{ $s<=$t->rating ? 'color:#c9a84c' : 'color:#e2e8f0' }}"></i>
              @endfor
            </div>
            <div class="flex items-center gap-1.5" style="color:rgba(100,116,139,.55)">
              <i class="fas fa-clock" style="font-size:.55rem"></i>
              <span class="text-xs">{{ $t->updated_at->locale('id')->diffForHumans() }}</span>
            </div>
          </div>
          <span class="text-[.6rem] font-semibold uppercase tracking-wider px-2.5 py-1 rounded-full"
                style="background:#f0fdf4;color:#16a34a;border:1px solid #bbf7d0">
            <i class="fas fa-circle-check text-[.5rem] mr-1"></i>Verified
          </span>
        </div>

        <p class="text-slate-600 dark:text-gray-300 text-sm leading-[1.8] mb-5 transition-colors">"{{ $t->comment }}"</p>

        <div class="flex items-center gap-3 pt-4 border-t border-slate-100 dark:border-dark-border">
          <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0"
               style="background:linear-gradient(135deg,#c9a84c,#9e7c2a)">
            {{ strtoupper(substr($t->name,0,1)) }}
          </div>
          <div class="flex-1 min-w-0">
            <div class="text-sm font-semibold text-ink dark:text-white truncate transition-colors">{{ $t->name }}</div>
            <div class="text-xs text-slate-400 dark:text-gray-500 truncate">{{ $t->company }}{{ $t->country ? ' · '.$t->country : '' }}</div>
          </div>
          @if($t->country)
          <div class="text-xs px-2 py-1 rounded-lg flex-shrink-0 bg-gold-pale dark:bg-gold/10 text-gold border border-gold/20">
            <i class="fas fa-globe text-[.55rem] mr-1"></i>{{ $t->country }}
          </div>
          @endif
        </div>

      </div>
      @endforeach
    </div>

    <div class="flex justify-center">{{ $testimonials->links() }}</div>

    @else
    <div class="text-center py-24 reveal">
      <div class="w-16 h-16 rounded-full mx-auto mb-4 flex items-center justify-center"
           style="background:rgba(201,168,76,.10);border:1px solid rgba(201,168,76,.2)">
        <i class="fas fa-comment-dots" style="color:#c9a84c;font-size:1.3rem"></i>
      </div>
      <p class="text-slate-400 dark:text-gray-500 text-sm">
        <span x-show="lang==='id'">Belum ada testimoni yang disetujui.</span>
        <span x-show="lang==='en'">No approved testimonials yet.</span>
      </p>
      <p class="text-slate-300 dark:text-gray-600 text-xs mt-1">
        <span x-show="lang==='id'">Jadilah yang pertama berbagi pengalaman!</span>
        <span x-show="lang==='en'">Be the first to share your experience!</span>
      </p>
    </div>
    @endif

  </div>
</section>

{{-- ======== FORM SECTION ======== --}}
<section class="py-20" style="background:#1a1410">
  <div class="max-w-2xl mx-auto px-4 sm:px-6">

    <div class="text-center mb-10 reveal">
      <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[.2em] mb-3" style="color:#c9a84c">
        <span class="w-6 h-px" style="background:#c9a84c"></span>
        <span x-show="lang==='id'">Bagikan Pengalaman</span>
        <span x-show="lang==='en'">Share Your Experience</span>
      </div>
      <h2 class="font-display text-4xl font-bold text-white">
        <span x-show="lang==='id'">Tulis <em class="not-italic" style="color:#c9a84c">Testimoni</em></span>
        <span x-show="lang==='en'">Write a <em class="not-italic" style="color:#c9a84c">Testimonial</em></span>
      </h2>
      <p class="text-sm mt-2" style="color:rgba(255,255,255,.35)">
        <span x-show="lang==='id'">Ditampilkan setelah moderasi admin</span>
        <span x-show="lang==='en'">Displayed after admin moderation</span>
      </p>
    </div>

    <div class="rounded-[2rem] p-8 reveal"
         style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.09)">
      <form method="POST" action="{{ route('testimonials.store') }}">
        @csrf

        <div class="grid sm:grid-cols-2 gap-4 mb-4">
          <div>
            <label class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color:rgba(255,255,255,.45)">
              <span x-show="lang==='id'">Nama *</span>
              <span x-show="lang==='en'">Name *</span>
            </label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   class="field-input w-full rounded-xl px-4 py-3 text-sm text-white transition-all"
                   style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.10);color:#fff"
                   :placeholder="lang==='id' ? 'Nama Anda' : 'Your Name'">
            @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
          </div>
          <div>
            <label class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color:rgba(255,255,255,.45)">
              <span x-show="lang==='id'">Perusahaan</span>
              <span x-show="lang==='en'">Company</span>
            </label>
            <input type="text" name="company" value="{{ old('company') }}"
                   class="field-input w-full rounded-xl px-4 py-3 text-sm transition-all"
                   style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.10);color:#fff"
                   :placeholder="lang==='id' ? 'Nama Perusahaan' : 'Company Name'">
          </div>
        </div>

        <div class="mb-4">
          <label class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color:rgba(255,255,255,.45)">
            <span x-show="lang==='id'">Negara</span>
            <span x-show="lang==='en'">Country</span>
          </label>
          <input type="text" name="country" value="{{ old('country') }}"
                 class="field-input w-full rounded-xl px-4 py-3 text-sm transition-all"
                 style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.10);color:#fff"
                 :placeholder="lang==='id' ? 'Contoh: Indonesia, India, USA...' : 'e.g. Indonesia, India, USA...'">
        </div>

        <div class="mb-5">
          <label class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color:rgba(255,255,255,.45)">
            <span x-show="lang==='id'">Testimoni *</span>
            <span x-show="lang==='en'">Testimonial *</span>
          </label>
          <textarea name="comment" rows="4" required
                    class="field-input w-full rounded-xl px-4 py-3 text-sm transition-all resize-none"
                    style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.10);color:#fff"
                    :placeholder="lang==='id' ? 'Ceritakan pengalaman Anda bersama produk kami...' : 'Share your experience with our products...'">{{ old('comment') }}</textarea>
          @error('comment')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-7">
          <label class="block text-xs font-semibold uppercase tracking-wider mb-3" style="color:rgba(255,255,255,.45)">Rating</label>
          <div class="flex items-center gap-1.5" id="starRating">
            @for($s=1;$s<=5;$s++)
            <span class="star-btn text-3xl" data-val="{{ $s }}"
                  style="color:{{ old('rating',5)>=$s ? '#c9a84c' : 'rgba(255,255,255,.15)' }}">
              <i class="fas fa-star"></i>
            </span>
            @endfor
            <input type="hidden" name="rating" id="ratingInput" value="{{ old('rating',5) }}">
            <span id="ratingLabel" class="ml-3 text-xs" style="color:rgba(255,255,255,.38)">
              <span x-show="lang==='id'">Sangat Bagus</span>
              <span x-show="lang==='en'">Excellent</span>
            </span>
          </div>
        </div>

        <button type="submit"
                class="w-full font-bold py-4 rounded-xl text-white text-sm uppercase tracking-wider transition-all hover:-translate-y-0.5 inline-flex items-center justify-center gap-2"
                style="background:linear-gradient(135deg,#c9a84c,#9e7c2a);box-shadow:0 4px 20px rgba(201,168,76,.25)">
          <i class="fas fa-paper-plane text-xs"></i>
          <span x-show="lang==='id'">Kirim Testimoni</span>
          <span x-show="lang==='en'">Submit Testimonial</span>
        </button>

        <p class="text-center text-xs mt-4" style="color:rgba(255,255,255,.22)">
          <i class="fas fa-shield-halved mr-1"></i>
          <span x-show="lang==='id'">Data Anda aman dan tidak dibagikan ke pihak ketiga.</span>
          <span x-show="lang==='en'">Your data is safe and not shared with third parties.</span>
        </p>
      </form>
    </div>
  </div>
</section>

@push('scripts')
<script>
(function() {
  var labels_id = ['','Buruk','Kurang','Cukup','Bagus','Sangat Bagus'];
  var labels_en = ['','Poor','Below Average','Average','Good','Excellent'];
  var stars   = document.querySelectorAll('#starRating .star-btn');
  var input   = document.getElementById('ratingInput');
  var lbl     = document.getElementById('ratingLabel');
  var current = parseInt(input.value) || 5;

  function getLabels() {
    try { return document.documentElement.__x.$data.lang === 'en' ? labels_en : labels_id; } catch(e) { return labels_id; }
  }

  function paint(val, hover) {
    stars.forEach(function(s) {
      s.style.color = parseInt(s.dataset.val) <= val ? '#c9a84c' : 'rgba(255,255,255,.15)';
    });
  }

  stars.forEach(function(s) {
    s.addEventListener('mouseenter', function() { paint(parseInt(s.dataset.val), true); });
    s.addEventListener('mouseleave', function() { paint(current, false); });
    s.addEventListener('click',      function() {
      current = parseInt(s.dataset.val);
      input.value = current;
      paint(current, false);
    });
  });

  paint(current, false);
})();
</script>
@endpush

@endsection
