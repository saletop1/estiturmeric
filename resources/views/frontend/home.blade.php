@extends('layouts.app')
@section('content')

{{-- ======== HERO ======== --}}
<section class="relative flex items-center overflow-hidden bg-ink" style="height:calc(100vh - 52px)">

  {{-- Background photo --}}
  <div id="hero-parallax" class="absolute inset-0 bg-cover bg-center"
       style="background-image:url('{{ asset('images/turmeric.png') }}');
              transform:scale(1.12);will-change:transform;transition:transform .05s linear"></div>

  {{-- Overlays --}}
  <div class="absolute inset-0" style="background:rgba(26,20,16,.12)"></div>
  <div class="absolute inset-0" style="background:linear-gradient(to right,rgba(26,20,16,.45),rgba(26,20,16,.10),rgba(26,20,16,.02))"></div>
  <div class="absolute inset-0" style="background:linear-gradient(to top,rgba(26,20,16,.20),transparent)"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 py-20 w-full">
    <div class="max-w-2xl">

      {{-- Eyebrow --}}
      <div class="inline-flex items-center gap-2.5 text-xs font-bold uppercase tracking-[.18em] px-5 py-2.5 rounded-full mb-7"
           style="background:linear-gradient(135deg,rgba(201,168,76,.22),rgba(201,168,76,.08));border:1px solid rgba(201,168,76,.45);color:#e2c97e;box-shadow:0 0 18px rgba(201,168,76,.18),inset 0 1px 0 rgba(255,255,255,.10)">
        <span class="w-1.5 h-1.5 rounded-full" style="background:#c9a84c;box-shadow:0 0 6px #c9a84c"></span>
        <i class="fas fa-leaf" style="font-size:.6rem;color:#c9a84c"></i>
        Premium Indonesian Turmeric
        <i class="fas fa-leaf" style="font-size:.6rem;color:#c9a84c;transform:scaleX(-1)"></i>
        <span class="w-1.5 h-1.5 rounded-full" style="background:#c9a84c;box-shadow:0 0 6px #c9a84c"></span>
      </div>

      {{-- Title --}}
      <h1 class="font-display text-5xl md:text-6xl lg:text-[5.5rem] font-bold leading-[1.06] mb-6"
          style="color:#ffffff;text-shadow:0 2px 20px rgba(0,0,0,.55),0 1px 4px rgba(0,0,0,.35)">
        <span x-show="lang==='id'">Kunyit <em class="not-italic" style="color:#c9a84c">Terbaik</em><br>untuk Dunia</span>
        <span x-show="lang==='en'">The <em class="not-italic" style="color:#c9a84c">Finest</em> Turmeric<br>for the World</span>
      </h1>

      <p class="text-lg leading-[1.82] max-w-[460px] mb-10"
         style="color:rgba(255,255,255,.80);text-shadow:0 1px 8px rgba(0,0,0,.4)">
        <span x-show="lang==='id'">PT. Diyani Rempah Saketi — produsen dan eksportir kunyit premium dari Semarang, Jawa Tengah.
        Diekspor ke India, Amerika, Eropa, Timur Tengah &amp; Jepang.</span>
        <span x-show="lang==='en'">PT. Diyani Rempah Saketi — premium turmeric producer and exporter from Semarang, Central Java.
        Exported to India, America, Europe, Middle East &amp; Japan.</span>
      </p>

      <div class="flex flex-wrap gap-4">
        <a href="{{ route('products') }}" class="btn-gold font-semibold text-sm px-7 py-3.5 rounded-full">
          <i class="fas fa-boxes-stacked"></i>
          <span x-show="lang==='id'">Lihat Produk</span>
          <span x-show="lang==='en'">View Products</span>
        </a>
        <a href="{{ route('contact') }}"
           class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full text-sm transition-all"
           style="border:1px solid rgba(255,255,255,.22);color:rgba(255,255,255,.80);"
           onmouseover="this.style.color='#fff';this.style.borderColor='rgba(255,255,255,.45)'"
           onmouseout="this.style.color='rgba(255,255,255,.80)';this.style.borderColor='rgba(255,255,255,.22)'">
          <i class="fab fa-whatsapp" style="color:#4ade80"></i>
          <span x-show="lang==='id'">Hubungi Kami</span>
          <span x-show="lang==='en'">Contact Us</span>
        </a>
      </div>
    </div>
  </div>

  {{-- Stats bar --}}
  <div class="absolute bottom-0 inset-x-0 z-10"
       style="background:rgba(0,0,0,.62);backdrop-filter:blur(12px);border-top:1px solid rgba(255,255,255,.08)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 grid grid-cols-2 md:grid-cols-4">
      @foreach([
        ['icon'=>'fas fa-globe',      'num'=>'7+',   'id'=>'Negara Ekspor',      'en'=>'Export Countries'],
        ['icon'=>'fas fa-flask',      'num'=>'Lab',  'id'=>'SIG Laboratory',     'en'=>'SIG Laboratory'],
        ['icon'=>'fas fa-seedling',   'num'=>'100%', 'id'=>'Alami & Natural',    'en'=>'Natural & Pure'],
        ['icon'=>'fas fa-certificate','num'=>'NIB',  'id'=>'Izin Ekspor Resmi',  'en'=>'Official Export License'],
      ] as $s)
      <div class="flex items-center gap-3 px-4 py-4"
           style="border-right:1px solid rgba(255,255,255,.10)">
        <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0"
             style="background:rgba(201,168,76,.12);border:1px solid rgba(201,168,76,.25)">
          <i class="{{ $s['icon'] }} text-xs" style="color:#c9a84c"></i>
        </div>
        <div>
          <div class="font-display text-xl font-bold leading-tight" style="color:#ffffff">{{ $s['num'] }}</div>
          <div class="uppercase tracking-wide mt-0.5" style="font-size:.58rem;color:rgba(255,255,255,.58)">
            <span x-show="lang==='id'">{{ $s['id'] }}</span>
            <span x-show="lang==='en'">{{ $s['en'] }}</span>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ======== MARQUEE ======== --}}
<div class="bg-gold overflow-hidden py-2.5">
  <div class="marquee-track">
    @php
    $items_id = ['Kunyit Segar','Kunyit Kering','Bubuk Kunyit','Ekstrak & Oleoresin',
              'Tanpa Pengawet','Uji Lab SIG','Ekspor Global','Semarang, Indonesia'];
    $items_en = ['Fresh Turmeric','Dried Turmeric','Turmeric Powder','Extracts & Oleoresin',
              'No Preservatives','SIG Lab Tested','Global Export','Semarang, Indonesia'];
    $items_id = array_merge($items_id, $items_id);
    $items_en = array_merge($items_en, $items_en);
    @endphp
    <template x-if="lang==='id'">
      <div class="inline-flex">
        @foreach($items_id as $item)
        <span class="inline-flex items-center gap-3 px-6 text-xs font-bold uppercase tracking-[.15em]"
              style="color:rgba(255,255,255,.92)">
          <span class="w-1 h-1 rounded-full flex-shrink-0" style="background:rgba(255,255,255,.50)"></span>{{ $item }}
        </span>
        @endforeach
      </div>
    </template>
    <template x-if="lang==='en'">
      <div class="inline-flex">
        @foreach($items_en as $item)
        <span class="inline-flex items-center gap-3 px-6 text-xs font-bold uppercase tracking-[.15em]"
              style="color:rgba(255,255,255,.92)">
          <span class="w-1 h-1 rounded-full flex-shrink-0" style="background:rgba(255,255,255,.50)"></span>{{ $item }}
        </span>
        @endforeach
      </div>
    </template>
  </div>
</div>

{{-- ======== ABOUT ======== --}}
<section class="py-24 bg-white dark:bg-dark transition-colors duration-300">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 grid md:grid-cols-2 gap-16 items-center">

    {{-- Image stack --}}
    <div class="relative reveal">
      <div class="rounded-2xl overflow-hidden aspect-[4/5]">
        <img src="https://images.unsplash.com/photo-1615485500834-bc10199bc727?w=800&q=80&auto=format&fit=crop"
             alt="Kunyit Diyani" class="w-full h-full object-cover">
      </div>
      <div class="absolute -right-5 -bottom-5 bg-gold rounded-2xl p-4 shadow-2xl float-anim z-10">
        <div class="font-display text-3xl font-bold text-white leading-tight">2025</div>
        <div class="text-xs uppercase tracking-wider mt-0.5" style="color:rgba(255,255,255,.75)">
          <span x-show="lang==='id'">Didirikan</span>
          <span x-show="lang==='en'">Founded</span>
        </div>
      </div>
      <div class="absolute -left-4 top-8 bg-white dark:bg-dark-card rounded-xl px-4 py-2.5 shadow-xl border border-slate-100 dark:border-dark-border z-10 transition-colors duration-300">
        <div class="flex items-center gap-1.5">
          <i class="fas fa-star text-gold text-xs"></i>
          <span class="text-xs font-semibold text-slate-700 dark:text-gray-300">Lab Certified</span>
        </div>
        <div class="text-[.6rem] text-slate-400 dark:text-gray-500 mt-0.5">SIG.MARK.E.XII.2025</div>
      </div>
    </div>

    {{-- Copy --}}
    <div class="reveal" style="transition-delay:.15s">
      <div class="flex items-center gap-2 text-gold text-xs font-bold uppercase tracking-[.18em] mb-4">
        <span class="w-4 h-px bg-gold"></span>
        <span x-show="lang==='id'">Tentang Kami</span>
        <span x-show="lang==='en'">About Us</span>
      </div>
      <h2 class="font-display text-4xl md:text-5xl font-bold text-ink dark:text-white leading-tight mb-5 transition-colors">
        <span x-show="lang==='id'">Rempah <em class="not-italic text-gold">Terbaik</em><br>dari Jawa Tengah</span>
        <span x-show="lang==='en'">The <em class="not-italic text-gold">Finest</em> Spices<br>from Central Java</span>
      </h2>
      <p class="text-slate-500 dark:text-gray-400 leading-[1.85] mb-7 transition-colors">
        <span x-show="lang==='id'">PT. Diyani Rempah Saketi (AHU-066520.AH.01.30.Tahun 2025) adalah produsen dan eksportir kunyit premium berbasis di
        Semarang — menggabungkan keunggulan geografis Indonesia dengan keahlian budidaya leluhur.</span>
        <span x-show="lang==='en'">PT. Diyani Rempah Saketi (AHU-066520.AH.01.30.Year 2025) is a premium turmeric producer and exporter based in
        Semarang — combining Indonesia's geographical advantages with ancestral cultivation expertise.</span>
      </p>
      <div class="space-y-3 mb-8">
        @foreach([
          ['icon'=>'fas fa-medal',        'id_title'=>'Kualitas Teruji Lab',  'en_title'=>'Lab-Tested Quality',  'id_desc'=>'Setiap batch diuji SIG Laboratory dengan Certificate of Analysis resmi.', 'en_desc'=>'Every batch is tested by SIG Laboratory with an official Certificate of Analysis.'],
          ['icon'=>'fas fa-handshake',    'id_title'=>'Mitra Petani Lokal',   'en_title'=>'Local Farmer Partners', 'id_desc'=>'Bermitra langsung dengan petani Jawa Tengah untuk rantai pasokan berkelanjutan.', 'en_desc'=>'Direct partnership with Central Java farmers for a sustainable supply chain.'],
          ['icon'=>'fas fa-earth-americas','id_title'=>'Ekspor Global',       'en_title'=>'Global Export',        'id_desc'=>'Melayani India, Amerika, Malaysia, Jerman, China, UAE, dan Jepang.', 'en_desc'=>'Serving India, America, Malaysia, Germany, China, UAE, and Japan.'],
        ] as $f)
        <div class="flex gap-3 p-3.5 rounded-xl transition-colors cursor-default bg-gold-pale dark:bg-gold/10 border border-gold/20 dark:border-gold/25">
          <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5"
               style="background:rgba(201,168,76,.18)">
            <i class="{{ $f['icon'] }} text-gold text-xs"></i>
          </div>
          <div>
            <div class="text-sm font-semibold text-ink dark:text-white transition-colors">
              <span x-show="lang==='id'">{{ $f['id_title'] }}</span>
              <span x-show="lang==='en'">{{ $f['en_title'] }}</span>
            </div>
            <div class="text-xs text-slate-500 dark:text-gray-400 leading-[1.55] mt-0.5 transition-colors">
              <span x-show="lang==='id'">{{ $f['id_desc'] }}</span>
              <span x-show="lang==='en'">{{ $f['en_desc'] }}</span>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <a href="{{ route('about') }}" class="btn-gold font-semibold text-sm px-7 py-3.5 rounded-full">
        <span x-show="lang==='id'">Pelajari Lebih Lanjut</span>
        <span x-show="lang==='en'">Learn More</span>
        <i class="fas fa-arrow-right text-xs"></i>
      </a>
    </div>
  </div>
</section>

{{-- ======== PRODUCTS ======== --}}
<section class="py-24 bg-cream dark:bg-dark-surface transition-colors duration-300">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="flex items-end justify-between mb-11 flex-wrap gap-4 reveal">
      <div>
        <div class="flex items-center gap-2 text-gold text-xs font-bold uppercase tracking-[.18em] mb-3">
          <span class="w-4 h-px bg-gold"></span>
          <span x-show="lang==='id'">Produk Kami</span>
          <span x-show="lang==='en'">Our Products</span>
        </div>
        <h2 class="font-display text-4xl md:text-5xl font-bold text-ink dark:text-white leading-tight transition-colors">
          <span x-show="lang==='id'">Rangkaian Produk <em class="not-italic text-gold">Unggulan</em></span>
          <span x-show="lang==='en'">Our <em class="not-italic text-gold">Premium</em> Product Range</span>
        </h2>
      </div>
      <a href="{{ route('products') }}"
         class="inline-flex items-center gap-2 border border-slate-200 dark:border-dark-border text-slate-500 dark:text-gray-400
                hover:border-gold hover:text-gold px-5 py-2.5 rounded-full text-sm transition-all">
        <span x-show="lang==='id'">Semua Produk</span>
        <span x-show="lang==='en'">All Products</span>
        <i class="fas fa-arrow-right text-xs"></i>
      </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse($products ?? [] as $i => $product)
      <a href="{{ route('products.show', $product->slug) }}"
         class="group bg-white dark:bg-dark-card border border-slate-200 dark:border-dark-border rounded-[1.25rem] overflow-hidden card-hover transition-colors duration-300"
         style="transition-delay:{{ ($i % 3) * 80 }}ms">
        <div class="relative aspect-[4/3] overflow-hidden bg-gold-pale dark:bg-dark-surface">
          <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://images.unsplash.com/photo-1615485500834-bc10199bc727?w=600&q=80' }}"
               alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
          @if($product->badge)
          <span class="absolute top-3 left-3 bg-gold text-white text-xs font-bold px-3 py-1 rounded-full">
            {{ $product->badge }}
          </span>
          @endif
        </div>
        <div class="p-5">
          <div class="text-xs text-gold font-semibold uppercase tracking-[.12em] mb-1.5">{{ $product->category }}</div>
          <h3 class="font-display text-lg font-semibold text-ink dark:text-white leading-tight mb-2 transition-colors">{{ $product->name }}</h3>
          <p class="text-xs text-slate-500 dark:text-gray-400 leading-[1.6] mb-4 line-clamp-2 transition-colors">{{ $product->short_desc }}</p>
          <span class="text-xs font-semibold text-gold inline-flex items-center gap-1.5 group-hover:gap-2.5 transition-all">
            Detail <i class="fas fa-arrow-right text-[.55rem]"></i>
          </span>
        </div>
      </a>
      @empty
      @foreach([
        ['img'=>'https://images.unsplash.com/photo-1615485500834-bc10199bc727?w=600&q=80','name'=>'Kunyit Segar',         'cat'=>'Fresh Turmeric',       'id_desc'=>'Akar pilihan, dipanen puncak kematangan. Curcumin tinggi, aroma khas.','en_desc'=>'Hand-picked roots, harvested at peak maturity. High curcumin, distinctive aroma.','badge'=>'Terlaris'],
        ['img'=>'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?w=600&q=80', 'name'=>'Kunyit Kering & Bubuk','cat'=>'Dried & Powdered',     'id_desc'=>'100% murni, tanpa campuran. Curcumin 28,270 mg/kg. Warna kuning pekat.','en_desc'=>'100% pure, no additives. Curcumin 28,270 mg/kg. Deep yellow color.','badge'=>'Featured'],
        ['img'=>'https://images.unsplash.com/photo-1615485291234-9d694218aeb3?w=600&q=80','name'=>'Ekstrak & Oleoresin',  'cat'=>'Extracts & Oleoresins','id_desc'=>'Untuk industri makanan, farmasi, dan kosmetik. Konsentrasi kurkumin tinggi.','en_desc'=>'For food, pharmaceutical, and cosmetic industries. High curcumin concentration.','badge'=>'Premium'],
      ] as $i => $p)
      <a href="{{ route('products') }}"
         class="group bg-white dark:bg-dark-card border border-slate-200 dark:border-dark-border rounded-[1.25rem] overflow-hidden card-hover reveal transition-colors duration-300"
         style="transition-delay:{{ $i * 80 }}ms">
        <div class="relative aspect-[4/3] overflow-hidden bg-gold-pale dark:bg-dark-surface">
          <img src="{{ $p['img'] }}" alt="{{ $p['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
          <span class="absolute top-3 left-3 bg-gold text-white text-xs font-bold px-3 py-1 rounded-full">{{ $p['badge'] }}</span>
        </div>
        <div class="p-5">
          <div class="text-xs text-gold font-semibold uppercase tracking-[.12em] mb-1.5">{{ $p['cat'] }}</div>
          <h3 class="font-display text-lg font-semibold text-ink dark:text-white leading-tight mb-2 transition-colors">{{ $p['name'] }}</h3>
          <p class="text-xs text-slate-500 dark:text-gray-400 leading-[1.6] mb-4 transition-colors">
            <span x-show="lang==='id'">{{ $p['id_desc'] }}</span>
            <span x-show="lang==='en'">{{ $p['en_desc'] }}</span>
          </p>
          <span class="text-xs font-semibold text-gold inline-flex items-center gap-1.5 group-hover:gap-2.5 transition-all">
            Detail <i class="fas fa-arrow-right text-[.55rem]"></i>
          </span>
        </div>
      </a>
      @endforeach
      @endforelse
    </div>
  </div>
</section>

{{-- ======== EXPORT FLAGS ======== --}}
<section class="py-24" style="background:#3d3020">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
    <div class="flex items-center justify-center gap-2 text-gold text-xs font-bold uppercase tracking-[.18em] mb-3 reveal">
      <span class="w-4 h-px bg-gold"></span>
      <span x-show="lang==='id'">Jangkauan Global</span>
      <span x-show="lang==='en'">Global Reach</span>
      <span class="w-4 h-px bg-gold"></span>
    </div>
    <h2 class="font-display text-4xl md:text-5xl font-bold text-white mb-3 reveal">
      <span x-show="lang==='id'">Ekspor ke <em class="not-italic text-gold">7+ Negara</em></span>
      <span x-show="lang==='en'">Exporting to <em class="not-italic text-gold">7+ Countries</em></span>
    </h2>
    <p class="mb-12 reveal" style="color:rgba(255,255,255,.55)">
      <span x-show="lang==='id'">Dipercaya importir dari berbagai penjuru dunia</span>
      <span x-show="lang==='en'">Trusted by importers from around the world</span>
    </p>

    <div class="flex flex-wrap justify-center gap-4 reveal">
      @foreach([
        ['code'=>'in','name'=>'India',        'iso'=>'IND'],
        ['code'=>'us','name'=>'United States', 'iso'=>'USA'],
        ['code'=>'my','name'=>'Malaysia',      'iso'=>'MYS'],
        ['code'=>'de','name'=>'Germany',       'iso'=>'DEU'],
        ['code'=>'cn','name'=>'China',         'iso'=>'CHN'],
        ['code'=>'ae','name'=>'UAE',           'iso'=>'UAE'],
        ['code'=>'jp','name'=>'Japan',         'iso'=>'JPN'],
      ] as $c)
      <div class="flex flex-col items-center justify-center gap-3 cursor-default transition-all duration-200 hover:-translate-y-1"
           style="width:120px;height:120px;border-radius:1.25rem;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.10)"
           onmouseover="this.style.background='rgba(201,168,76,.10)';this.style.borderColor='rgba(201,168,76,.35)'"
           onmouseout="this.style.background='rgba(255,255,255,.05)';this.style.borderColor='rgba(255,255,255,.10)'">
        <img src="https://flagcdn.com/w80/{{ $c['code'] }}.png"
             srcset="https://flagcdn.com/w160/{{ $c['code'] }}.png 2x"
             alt="{{ $c['name'] }}"
             style="width:52px;height:34px;border-radius:4px;object-fit:cover;box-shadow:0 2px 8px rgba(0,0,0,.3)">
        <div>
          <div class="text-sm font-medium text-center" style="color:rgba(255,255,255,.75)">{{ $c['name'] }}</div>
          <div class="text-xs uppercase tracking-widest text-center mt-0.5" style="color:rgba(255,255,255,.40)">{{ $c['iso'] }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ======== TESTIMONIALS ======== --}}
<section class="py-24 bg-cream dark:bg-dark transition-colors duration-300">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="text-center mb-12 reveal">
      <div class="flex items-center justify-center gap-2 text-gold text-xs font-bold uppercase tracking-[.18em] mb-3">
        <span class="w-4 h-px bg-gold"></span>
        <span x-show="lang==='id'">Testimoni</span>
        <span x-show="lang==='en'">Testimonials</span>
        <span class="w-4 h-px bg-gold"></span>
      </div>
      <h2 class="font-display text-4xl md:text-5xl font-bold text-ink dark:text-white transition-colors">
        <span x-show="lang==='id'">Kata Mitra <em class="not-italic text-gold">Global Kami</em></span>
        <span x-show="lang==='en'">What Our <em class="not-italic text-gold">Global Partners</em> Say</span>
      </h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
      @forelse($testimonials ?? [] as $i => $t)
      <div class="bg-white dark:bg-dark-card border border-slate-200 dark:border-dark-border rounded-[1.25rem] p-6 relative overflow-hidden
                  hover:-translate-y-1.5 hover:shadow-xl hover:border-gold transition-all duration-200 reveal"
           style="transition-delay:{{ ($i % 3) * 80 }}ms">
        <div class="absolute top-0 left-2 font-display leading-none pointer-events-none select-none"
             style="font-size:5rem;color:rgba(201,168,76,.12)">"</div>
        <div class="flex gap-0.5 mb-3 relative z-10">
          @for($s=1; $s<=5; $s++)
            <i class="fas fa-star text-xs {{ $s <= $t->rating ? 'text-gold' : 'text-slate-200 dark:text-gray-600' }}"></i>
          @endfor
        </div>
        <p class="text-sm text-slate-600 dark:text-gray-300 leading-[1.72] mb-5 relative z-10 transition-colors">"{{ $t->comment }}"</p>
        <div class="flex items-center gap-2.5 border-t border-slate-100 dark:border-dark-border pt-4">
          <div class="w-9 h-9 rounded-full bg-gradient-to-br from-gold to-gold-dark text-white
                      font-display font-bold text-sm flex items-center justify-center flex-shrink-0">
            {{ strtoupper(substr($t->name, 0, 1)) }}
          </div>
          <div class="flex-1 min-w-0">
            <div class="text-sm font-semibold text-ink dark:text-white truncate transition-colors">{{ $t->name }}</div>
            <div class="text-xs text-slate-400 dark:text-gray-500 truncate">{{ $t->company }} · {{ $t->country }}</div>
          </div>
          <span class="text-xs bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800 px-2 py-0.5 rounded-full whitespace-nowrap">
            <i class="fas fa-circle-check text-[.45rem] mr-0.5"></i>Verified
          </span>
        </div>
      </div>
      @empty
      @foreach([
        ['init'=>'R','name'=>'Rajesh Kumar',  'co'=>'Spice Imports India',  'country'=>'India',   'r'=>5,'txt'=>'"Excellent quality turmeric with very high curcumin content. The lab certification gives us full confidence."'],
        ['init'=>'S','name'=>'Sarah Johnson', 'co'=>'Natural Foods USA',    'country'=>'USA',     'r'=>5,'txt'=>'"We have been sourcing from PT. Diyani for 6 months and quality is consistently outstanding."'],
        ['init'=>'A','name'=>'Ahmad Razali',  'co'=>'Herba Bumi Sdn Bhd',  'country'=>'Malaysia','r'=>5,'txt'=>'"Kualiti kunyit sangat baik dan aroma semulajadi. Proses eksport lancar dan responsif."'],
      ] as $i => $t)
      <div class="bg-white dark:bg-dark-card border border-slate-200 dark:border-dark-border rounded-[1.25rem] p-6 relative overflow-hidden
                  hover:-translate-y-1.5 hover:shadow-xl hover:border-gold transition-all duration-200 reveal"
           style="transition-delay:{{ $i * 80 }}ms">
        <div class="absolute top-0 left-2 font-display leading-none pointer-events-none"
             style="font-size:5rem;color:rgba(201,168,76,.12)">"</div>
        <div class="flex gap-0.5 mb-3">@for($s=1;$s<=5;$s++)<i class="fas fa-star text-xs {{ $s<=$t['r']?'text-gold':'text-slate-200 dark:text-gray-600' }}"></i>@endfor</div>
        <p class="text-sm text-slate-600 dark:text-gray-300 leading-[1.72] mb-5 transition-colors">{{ $t['txt'] }}</p>
        <div class="flex items-center gap-2.5 border-t border-slate-100 dark:border-dark-border pt-4">
          <div class="w-9 h-9 rounded-full bg-gradient-to-br from-gold to-gold-dark text-white font-display font-bold text-sm flex items-center justify-center flex-shrink-0">{{ $t['init'] }}</div>
          <div class="flex-1"><div class="text-sm font-semibold text-ink dark:text-white transition-colors">{{ $t['name'] }}</div><div class="text-xs text-slate-400 dark:text-gray-500">{{ $t['co'] }} · {{ $t['country'] }}</div></div>
          <span class="text-xs bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800 px-2 py-0.5 rounded-full whitespace-nowrap"><i class="fas fa-circle-check text-[.45rem] mr-0.5"></i>Verified</span>
        </div>
      </div>
      @endforeach
      @endforelse
    </div>

    <div class="text-center mt-8 reveal">
      <a href="{{ route('testimonials.index') }}"
         class="inline-flex items-center gap-2 border border-slate-200 dark:border-dark-border text-slate-500 dark:text-gray-400
                hover:border-gold hover:text-gold px-6 py-2.5 rounded-full text-sm transition-all">
        <span x-show="lang==='id'">Lihat Semua Testimoni</span>
        <span x-show="lang==='en'">View All Testimonials</span>
        <i class="fas fa-arrow-right text-xs"></i>
      </a>
    </div>
  </div>
</section>

{{-- ======== CTA BANNER ======== --}}
@php
$ctaImages = [
  'https://loremflickr.com/1600/900/office,professional?lock=10',
  'https://loremflickr.com/1600/900/office,business?lock=11',
  'https://loremflickr.com/1600/900/workspace,modern?lock=12',
  'https://loremflickr.com/1600/900/office,meeting?lock=13',
  'https://loremflickr.com/1600/900/corporate,office?lock=14',
];
$ctaImg = $ctaImages[array_rand($ctaImages)];
@endphp
<section class="py-14 bg-cream dark:bg-dark-surface transition-colors duration-300">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="relative rounded-[2rem] px-8 py-20 text-center overflow-hidden reveal"
         style="background-image:url('{{ $ctaImg }}');background-size:cover;background-position:center">

      <div class="absolute inset-0 rounded-[2rem]"
           style="background:linear-gradient(135deg,rgba(10,8,5,.62) 0%,rgba(10,8,5,.38) 50%,rgba(10,8,5,.65) 100%)"></div>

      <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[600px] h-40 pointer-events-none"
           style="background:radial-gradient(ellipse,rgba(201,168,76,.20),transparent 70%);filter:blur(18px)"></div>

      <h2 class="font-display text-4xl md:text-5xl font-bold text-white mb-4 relative z-10"
          style="text-shadow:0 2px 24px rgba(0,0,0,.65),0 1px 4px rgba(0,0,0,.4)">
        <span x-show="lang==='id'">Siap Bermitra<br>dengan <em class="not-italic" style="color:#e2c97e;text-shadow:0 0 28px rgba(201,168,76,.55)">Kami?</em></span>
        <span x-show="lang==='en'">Ready to <em class="not-italic" style="color:#e2c97e;text-shadow:0 0 28px rgba(201,168,76,.55)">Partner</em><br>with Us?</span>
      </h2>
      <p class="max-w-md mx-auto mb-8 leading-[1.78] relative z-10"
         style="color:rgba(255,255,255,.90);text-shadow:0 1px 10px rgba(0,0,0,.55)">
        <span x-show="lang==='id'">Hubungi tim kami untuk penawaran terbaik, spesifikasi produk, dan informasi ekspor lengkap.</span>
        <span x-show="lang==='en'">Contact our team for the best offers, product specifications, and complete export information.</span>
      </p>
      <div class="flex flex-wrap justify-center gap-4 relative z-10">
        @php $wa = \App\Models\Setting::get('wa_number', '6282138280770'); @endphp
        <a href="https://wa.me/{{ $wa }}" target="_blank" class="btn-cta-primary text-sm font-bold">
          <i class="fab fa-whatsapp text-base"></i>
          <span x-show="lang==='id'">WhatsApp Sekarang</span>
          <span x-show="lang==='en'">WhatsApp Now</span>
        </a>
        <a href="{{ route('contact') }}" class="btn-cta-secondary text-sm">
          <i class="fas fa-envelope"></i>
          <span x-show="lang==='id'">Kirim Email</span>
          <span x-show="lang==='en'">Send Email</span>
        </a>
      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
// Hero Parallax
(function(){
  const el = document.getElementById('hero-parallax');
  if (!el) return;
  let ticking = false;
  window.addEventListener('scroll', function(){
    if (!ticking) {
      requestAnimationFrame(function(){
        const scrollY = window.scrollY;
        el.style.transform = 'scale(1.12) translateY(' + (scrollY * 0.4) + 'px)';
        ticking = false;
      });
      ticking = true;
    }
  }, { passive: true });
})();
</script>
@endpush

@endsection
