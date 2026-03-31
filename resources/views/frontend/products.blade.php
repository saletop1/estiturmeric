@extends('layouts.app')
@section('content')

{{-- ========== CREATIVE BANNER – TURMERIC EXCELLENCE ========== --}}
<section class="relative bg-cream overflow-hidden">
  <!-- Decorative gold line top -->
  <div class="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-gold/30 to-transparent"></div>

  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 py-12 md:py-20">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">

      <!-- Left Content -->
      <div class="reveal stagger-100">
        <!-- Subhead -->
        <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[.2em] text-gold mb-4">
          <span class="w-6 h-px bg-gold/70"></span>
          Rempah Pilihan Nusantara
          <span class="w-6 h-px bg-gold/70"></span>
        </div>

        <!-- Main Heading -->
        <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-ink leading-tight mb-5">
          Kunyit <span class="text-gold block sm:inline">Berkualitas</span>
          <span class="block text-2xl md:text-3xl font-normal text-slate-600 mt-2">Langsung Dari Kebun Terbaik Di Pulau Jawa</span>
        </h1>

        <!-- Description -->
        <p class="text-slate-500 text-base md:text-lg leading-relaxed mb-8 max-w-xl">
          Kunyit segar pilihan dengan kandungan kurkumin tinggi, langsung dari petani terbaik Jawa Tengah.
          Tersedia dalam bentuk segar, kering, bubuk, dan ekstrak &mdash;
          setiap partai telah <span class="font-semibold text-gold">diuji laboratorium</span> untuk kemurnian dan kualitas terjamin.
        </p>

        <!-- Trust badges -->
        <div class="flex flex-wrap gap-6 mb-8">
          <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-gold/10 rounded-full flex items-center justify-center">
              <i class="fas fa-flask text-gold text-sm"></i>
            </div>
            <div>
              <div class="text-sm font-bold text-ink">Kurkumin Tinggi</div>
              <div class="text-xs text-slate-500">hingga 28.270 mg/kg</div>
            </div>
          </div>
          <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-gold/10 rounded-full flex items-center justify-center">
              <i class="fas fa-leaf text-gold text-sm"></i>
            </div>
            <div>
              <div class="text-sm font-bold text-ink">100% Alami</div>
              <div class="text-xs text-slate-500">Tanpa bahan tambahan</div>
            </div>
          </div>
          <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-gold/10 rounded-full flex items-center justify-center">
              <i class="fas fa-truck text-gold text-sm"></i>
            </div>
            <div>
              <div class="text-sm font-bold text-ink">Ekspor Langsung</div>
              <div class="text-xs text-slate-500">Dari kebun ke pelabuhan</div>
            </div>
          </div>
        </div>

        <!-- CTA Buttons -->
        <div class="flex flex-wrap gap-4">
          <a href="{{ route('products') }}" class="btn-gold font-semibold text-sm px-8 py-4 rounded-full inline-flex items-center gap-2 transition-all hover:shadow-lg">
            <i class="fas fa-basket-shopping"></i> Lihat Semua Produk
          </a>
          <a href="{{ route('contact') }}" class="border border-slate-300 text-slate-700 hover:border-gold hover:text-gold px-8 py-4 rounded-full text-sm font-semibold inline-flex items-center gap-2 transition-all">
            <i class="fas fa-file-lines"></i> Minta COA & Spesifikasi
          </a>
        </div>

        <!-- Micro-trust -->
        <div class="mt-8 text-xs text-slate-400 flex items-center gap-2">
          <i class="fas fa-check-circle text-gold"></i> Minimum order berlaku – kualitas tetap terjamin &middot; Sertifikat internasional tersedia
        </div>
      </div>

      <!-- ===== RIGHT VISUAL – SLIDESHOW CARD ===== -->
      @php
        // Siapkan data slide dari $products atau fallback
        $fallbackSlides = [
            ['image' => 'https://images.unsplash.com/photo-1615485500834-bc10199bc727?w=800&q=80', 'name' => 'Kunyit Segar',           'category' => 'Fresh Turmeric'],
            ['image' => 'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?w=800&q=80', 'name' => 'Kunyit Kering & Bubuk', 'category' => 'Dried & Powdered'],
            ['image' => 'https://images.unsplash.com/photo-1615485291234-9d694218aeb3?w=800&q=80', 'name' => 'Ekstrak & Oleoresin',   'category' => 'Extracts & Oleoresins'],
        ];
        // Konversi $products ke array sederhana dengan URL gambar lengkap
        $slideData = isset($products) && $products->count()
            ? $products->map(fn($p) => [
                'image'    => $p->image ? asset('storage/'.$p->image) : 'https://images.unsplash.com/photo-1615485500834-bc10199bc727?w=800&q=80',
                'name'     => $p->name,
                'category' => $p->category ?? '',
              ])->values()->toArray()
            : $fallbackSlides;
      @endphp

      <div class="relative reveal stagger-200"
           x-data="{
              slides: {{ Js::from($slideData) }},
              current: 0,
              prev: -1,
              direction: 1,
              animating: false,
              autoplayInterval: null,
              go(n) {
                  if (this.animating) return;
                  this.animating = true;
                  this.prev = this.current;
                  this.direction = n > this.current || (n === 0 && this.current === this.slides.length - 1) ? 1 : -1;
                  this.current = n;
                  setTimeout(() => { this.prev = -1; this.animating = false; }, 600);
              },
              next() { this.go((this.current + 1) % this.slides.length); },
              goBack() { this.go((this.current - 1 + this.slides.length) % this.slides.length); },
              startAutoplay() {
                  this.autoplayInterval = setInterval(() => this.next(), 10000);
              },
              stopAutoplay() { clearInterval(this.autoplayInterval); }
           }"
           x-init="startAutoplay()"
           @mouseenter="stopAutoplay()"
           @mouseleave="startAutoplay()">

          <!-- Slideshow container -->
          <div class="relative rounded-[2rem] overflow-hidden shadow-2xl border-4 border-white bg-white"
               style="height:420px">

              <!-- Slide wrapper — semua slide ditumpuk, geser kiri/kanan via CSS -->
              <template x-for="(slide, index) in slides" :key="index">
                  <div class="absolute inset-0 w-full h-full transition-transform duration-[600ms] ease-in-out"
                       :style="{
                           transform: index === current
                               ? 'translateX(0)'
                               : (index === prev
                                   ? 'translateX(' + (direction * -100) + '%)'
                                   : 'translateX(' + (index < current ? '-100%' : '100%') + ')'),
                           zIndex: index === current ? 2 : (index === prev ? 1 : 0)
                       }">
                      <img :src="slide.image && slide.image.startsWith('http') ? slide.image : (slide.image ? '/storage/' + slide.image : 'https://images.unsplash.com/photo-1615485500834-bc10199bc727?w=800&q=80')"
                           :alt="slide.name"
                           class="w-full h-full object-cover">
                      <!-- Overlay teks -->
                      <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-5">
                          <p class="text-white/75 text-xs font-semibold uppercase tracking-wider mb-1" x-text="slide.category || 'Produk'"></p>
                          <p class="text-white text-lg font-bold leading-tight" x-text="slide.name"></p>
                      </div>
                  </div>
              </template>

              <!-- Dots navigasi -->
              <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-20">
                  <template x-for="(slide, index) in slides" :key="index">
                      <button @click="go(index)"
                              class="h-2.5 rounded-full transition-all duration-300"
                              :class="current === index ? 'bg-gold w-6' : 'bg-white/70 hover:bg-white w-2.5'"></button>
                  </template>
              </div>

              <!-- Tombol prev/next -->
              <button @click="goBack()"
                      class="absolute left-2 top-1/2 -translate-y-1/2 w-8 h-8 bg-white/80 rounded-full flex items-center justify-center text-ink hover:bg-gold hover:text-white transition-all z-20">
                  <i class="fas fa-chevron-left text-xs"></i>
              </button>
              <button @click="next()"
                      class="absolute right-2 top-1/2 -translate-y-1/2 w-8 h-8 bg-white/80 rounded-full flex items-center justify-center text-ink hover:bg-gold hover:text-white transition-all z-20">
                  <i class="fas fa-chevron-right text-xs"></i>
              </button>
          </div>

      </div>
    </div>
  </div>

  <!-- Decorative gold line bottom -->
  <div class="absolute bottom-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-gold/30 to-transparent"></div>
</section>

{{-- Heading Koleksi Produk --}}
<div class="bg-cream pt-14 pb-2">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 reveal">
    <div class="flex items-end justify-between">
      <div>
        <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-[.2em] mb-2" style="color:#c9a84c">
          <span class="w-4 h-px" style="background:#c9a84c"></span> Rangkaian Produk
        </div>
        <h2 class="font-display text-3xl md:text-4xl font-bold text-ink leading-tight">
          Koleksi <em class="not-italic" style="color:#c9a84c">Produk</em>
        </h2>
        <p class="text-slate-500 text-sm mt-2">Jelajahi seluruh varian kunyit premium kami.</p>
      </div>
      <div class="hidden sm:block w-16 h-px" style="background:linear-gradient(to right,rgba(201,168,76,.4),transparent)"></div>
    </div>
    <div class="mt-5 h-px" style="background:linear-gradient(to right,rgba(201,168,76,.25),transparent)"></div>
  </div>
</div>

{{-- Products Grid --}}
<section class="py-20 bg-cream">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

      @forelse($products ?? [] as $i => $product)
      <a href="{{ route('products.show', $product->slug) }}"
         class="group bg-white border border-slate-200 rounded-[1.25rem] overflow-hidden card-hover reveal"
         style="transition-delay:{{ ($i % 3) * 80 }}ms">
        <div class="relative aspect-[4/3] overflow-hidden bg-gold-pale">
          <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://images.unsplash.com/photo-1615485500834-bc10199bc727?w=600&q=80' }}"
               alt="{{ $product->name }}"
               class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
          @if($product->badge)
          <span class="absolute top-3 left-3 bg-gold text-white text-xs font-bold px-3 py-1 rounded-full">
            {{ $product->badge }}
          </span>
          @endif
          @if($product->lab_data)
          <span class="absolute top-3 right-3 bg-emerald-500 text-white text-xs font-medium px-2.5 py-1 rounded-full flex items-center gap-1">
            <i class="fas fa-flask text-[.55rem]"></i> Lab Tested
          </span>
          @endif
        </div>
        <div class="p-6">
          <div class="text-xs text-gold font-semibold uppercase tracking-[.12em] mb-1.5">{{ $product->category }}</div>
          <h3 class="font-display text-xl font-semibold text-ink leading-tight mb-2">{{ $product->name }}</h3>
          <p class="text-sm text-slate-500 leading-[1.6] mb-5 line-clamp-2">{{ $product->short_desc }}</p>
          <div class="flex items-center justify-between">
            @if($product->price)
            <span class="font-semibold text-ink text-sm">
              Rp {{ number_format($product->price, 0, ',', '.') }}
              <span class="text-xs font-normal text-slate-400">/{{ $product->unit }}</span>
            </span>
            @else
            <span class="text-xs text-slate-400 italic">Hubungi untuk harga</span>
            @endif
            <span class="text-xs font-semibold text-gold inline-flex items-center gap-1.5 group-hover:gap-2.5 transition-all">
              Detail <i class="fas fa-arrow-right text-[.55rem]"></i>
            </span>
          </div>
        </div>
      </a>
      @empty
      {{-- Fallback static products --}}
      @foreach([
        ['img'=>'https://images.unsplash.com/photo-1615485500834-bc10199bc727?w=700&q=80',
         'name'=>'Kunyit Segar','cat'=>'Fresh Turmeric','badge'=>'Terlaris','price'=>null,
         'desc'=>'Akar pilihan tangan dari petani Jawa Tengah, dipanen pada puncak kematangan. Kandungan kurkumin tinggi, aroma khas, warna oranye cerah. Min. order 100 kg.',
         'lab'=>true],
        ['img'=>'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?w=700&q=80',
         'name'=>'Kunyit Kering & Bubuk','cat'=>'Dried & Powdered','badge'=>'Featured','price'=>null,
         'desc'=>'Termasuk kunyit iris kering dan bubuk kunyit 100% murni tanpa campuran. Curcumin 28,270 mg/kg. Aroma kuat, warna kuning keemasan. Min. order 50 kg.',
         'lab'=>true],
        ['img'=>'https://images.unsplash.com/photo-1615485291234-9d694218aeb3?w=700&q=80',
         'name'=>'Ekstrak & Oleoresin','cat'=>'Extracts & Oleoresins','badge'=>'Premium','price'=>null,
         'desc'=>'Turunan khusus untuk aplikasi tingkat tinggi di industri makanan, minuman, farmasi, dan kosmetik. Berbagai konsentrasi kurkumin tersedia. Min. order 10 liter.',
         'lab'=>false],
      ] as $i => $p)
      <div class="group bg-white border border-slate-200 rounded-[1.25rem] overflow-hidden card-hover reveal"
           style="transition-delay:{{ $i * 80 }}ms">
        <div class="relative aspect-[4/3] overflow-hidden bg-gold-pale">
          <img src="{{ $p['img'] }}" alt="{{ $p['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
          <span class="absolute top-3 left-3 bg-gold text-white text-xs font-bold px-3 py-1 rounded-full">{{ $p['badge'] }}</span>
          @if($p['lab'])
          <span class="absolute top-3 right-3 bg-emerald-500 text-white text-xs font-medium px-2.5 py-1 rounded-full flex items-center gap-1">
            <i class="fas fa-flask text-[.55rem]"></i> Lab Tested
          </span>
          @endif
        </div>
        <div class="p-6">
          <div class="text-xs text-gold font-semibold uppercase tracking-[.12em] mb-1.5">{{ $p['cat'] }}</div>
          <h3 class="font-display text-xl font-semibold text-ink leading-tight mb-2">{{ $p['name'] }}</h3>
          <p class="text-sm text-slate-500 leading-[1.6] mb-5">{{ $p['desc'] }}</p>
          <div class="flex items-center justify-between">
            <span class="text-xs text-slate-400 italic">Hubungi untuk harga</span>
            <a href="{{ route('contact') }}" class="text-xs font-semibold text-gold inline-flex items-center gap-1.5 hover:gap-2.5 transition-all">
              Hubungi <i class="fas fa-arrow-right text-[.55rem]"></i>
            </a>
          </div>
        </div>
      </div>
      @endforeach
      @endforelse
    </div>
  </div>
</section>

{{-- Lab Spec CTA --}}
<section class="py-16 bg-white">
  <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center reveal">
    <div class="w-14 h-14 bg-gold/10 rounded-2xl flex items-center justify-center mx-auto mb-5">
      <i class="fas fa-file-lines text-gold text-xl"></i>
    </div>
    <h2 class="font-display text-3xl font-bold text-ink mb-3">
      Butuh <em class="not-italic text-gold">Spesifikasi Teknis</em>?
    </h2>
    <p class="text-slate-500 mb-7 leading-relaxed">
      Kami menyediakan Certificate of Analysis (COA), hasil uji lab lengkap, dan spesifikasi teknis
      untuk kebutuhan importir global. Hubungi tim kami sekarang.
    </p>
    @php $wa = \App\Models\Setting::get('wa_number','6282138280770'); @endphp
    <div class="flex flex-wrap justify-center gap-3">
      <a href="{{ route('contact') }}" class="btn-gold font-semibold text-sm px-7 py-3.5 rounded-full">
        <i class="fas fa-file-lines"></i> Minta Dokumen Teknis
      </a>
      <a href="https://wa.me/{{ $wa }}" target="_blank"
         class="inline-flex items-center gap-2 border border-slate-200 text-slate-600 hover:border-gold hover:text-gold px-7 py-3.5 rounded-full text-sm transition-all">
        <i class="fab fa-whatsapp"></i> Chat WhatsApp
      </a>
    </div>
  </div>
</section>

@endsection