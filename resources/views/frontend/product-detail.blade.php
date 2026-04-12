@extends('layouts.app')
@section('content')

@php
  $wa = \App\Models\Setting::get('wa_number', '6282138280770');
  $productImg = $product->image
      ? asset('storage/'.$product->image)
      : 'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?w=1600&q=80&auto=format&fit=crop';
@endphp

{{-- ══════════ HERO BANNER — Product Image Background ══════════ --}}
<div class="relative pt-20 overflow-hidden" style="min-height:360px">
  {{-- Product image as background --}}
  <div class="absolute inset-0">
    <img src="{{ $productImg }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
  </div>
  <div class="absolute inset-0" style="background:linear-gradient(to top,rgba(10,8,4,.88) 0%,rgba(10,8,4,.45) 50%,rgba(10,8,4,.55) 100%)"></div>
  <div class="absolute inset-0" style="background:linear-gradient(135deg,rgba(10,8,4,.65),transparent 60%)"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 py-20">
    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-xs mb-6" style="color:rgba(255,255,255,.35)">
      <a href="{{ route('home') }}" class="hover:text-gold transition-colors">
        <span x-show="lang==='id'">Beranda</span><span x-show="lang==='en'">Home</span>
      </a>
      <i class="fas fa-chevron-right" style="font-size:.35rem;opacity:.5"></i>
      <a href="{{ route('products') }}" class="hover:text-gold transition-colors" style="color:rgba(255,255,255,.35)">
        <span x-show="lang==='id'">Produk</span><span x-show="lang==='en'">Products</span>
      </a>
      <i class="fas fa-chevron-right" style="font-size:.35rem;opacity:.5"></i>
      <span style="color:#c9a84c">{{ $product->name }}</span>
    </div>

    {{-- Label pill --}}
    <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[.2em] px-3.5 py-1.5 rounded-full mb-5"
         style="background:rgba(201,168,76,.10);border:1px solid rgba(201,168,76,.30);color:#c9a84c">
      <span class="w-1.5 h-1.5 rounded-full" style="background:#c9a84c;box-shadow:0 0 6px #c9a84c"></span>
      <span x-show="lang==='id'">Detail Produk</span>
      <span x-show="lang==='en'">Product Detail</span>
    </div>

    <h1 class="font-display font-bold text-white leading-tight mb-3"
        style="font-size:clamp(2.2rem,5vw,3.8rem);text-shadow:0 2px 20px rgba(0,0,0,.5)">
      {{ $product->name ?? 'Produk' }}
    </h1>

    @if($product->category)
    <div class="inline-flex items-center gap-2 text-sm font-semibold uppercase tracking-wider"
         style="color:rgba(201,168,76,.85)">
      <i class="fas fa-leaf text-xs"></i>
      {{ $product->category }}
    </div>
    @endif
  </div>

  <div class="absolute bottom-0 inset-x-0 h-px"
       style="background:linear-gradient(to right,transparent,rgba(201,168,76,.45),transparent)"></div>
</div>

{{-- ══════════ PRODUCT DETAIL ══════════ --}}
<section class="py-20 bg-cream dark:bg-dark-surface transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

      {{-- ===== LEFT — Product Image + Gallery ===== --}}
      <div class="relative reveal">
        <div class="rounded-2xl overflow-hidden border-4 border-white dark:border-dark-border shadow-xl transition-colors duration-300">
          <img src="{{ $productImg }}"
               alt="{{ $product->name }}"
               class="w-full h-auto object-cover">
        </div>

        @if($product->badge)
        <span class="absolute top-4 left-4 bg-gold text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg">
          {{ $product->badge }}
        </span>
        @endif

        @if($product->lab_data)
        <span class="absolute top-4 right-4 bg-emerald-500 text-white text-xs font-medium px-3 py-1.5 rounded-full flex items-center gap-1.5 shadow-lg">
          <i class="fas fa-flask text-[.6rem]"></i> Lab Tested
        </span>
        @endif
      </div>

      {{-- ===== RIGHT — Product Info ===== --}}
      <div class="reveal stagger-100">

        {{-- Name + Category --}}
        <div class="mb-5">
          <h2 class="font-display text-3xl md:text-4xl font-bold text-ink dark:text-white mb-2 transition-colors">
            {{ $product->name }}
          </h2>
          <div class="flex items-center gap-3">
            <span class="text-gold font-semibold text-sm uppercase tracking-wider">{{ $product->category }}</span>
            @if($product->badge)
            <span class="text-xs bg-gold/10 text-gold border border-gold/20 px-2.5 py-0.5 rounded-full font-semibold">{{ $product->badge }}</span>
            @endif
          </div>
        </div>

        {{-- Price --}}
        @if($product->price)
        <div class="flex items-baseline gap-2 mb-6 p-4 rounded-xl bg-gold/5 dark:bg-gold/10 border border-gold/15 transition-colors duration-300">
          <span class="text-xs font-semibold uppercase tracking-wider text-slate-400 dark:text-gray-500 mr-1">
            <span x-show="lang==='id'">Harga</span>
            <span x-show="lang==='en'">Price</span>
          </span>
          <span class="text-3xl font-bold text-ink dark:text-white transition-colors">
            Rp {{ number_format($product->price, 0, ',', '.') }}
          </span>
          <span class="text-slate-400 dark:text-gray-500 text-sm">/{{ $product->unit ?? 'kg' }}</span>
          @if($product->price_old)
          <span class="text-sm text-slate-400 line-through ml-1">Rp {{ number_format($product->price_old, 0, ',', '.') }}</span>
          @endif
        </div>
        @endif

        {{-- Description --}}
        <div class="mb-6">
          <h3 class="text-sm font-bold uppercase tracking-wider text-slate-500 dark:text-gray-400 mb-3 flex items-center gap-2 transition-colors">
            <i class="fas fa-align-left text-gold text-xs"></i>
            <span x-show="lang==='id'">Deskripsi Produk</span>
            <span x-show="lang==='en'">Product Description</span>
          </h3>
          <div class="prose prose-slate dark:prose-invert prose-sm max-w-none leading-[1.85]">
            @php
              $desc = $product->description ?? null;
              if (is_array($desc)) {
                  $desc = implode('<br>', $desc);
              }
            @endphp
            @if($desc)
              {!! $desc !!}
            @else
              <p class="text-slate-400 dark:text-gray-500 italic">
                <span x-show="lang==='id'">Deskripsi produk belum tersedia.</span>
                <span x-show="lang==='en'">Product description is not available yet.</span>
              </p>
            @endif
          </div>
        </div>

        {{-- Stock --}}
        @if($product->stock)
        <div class="flex items-center gap-3 mb-6 p-3.5 rounded-xl bg-emerald-50 dark:bg-emerald-900/15 border border-emerald-200 dark:border-emerald-800/30 transition-colors duration-300">
          <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
            <i class="fas fa-boxes-stacked text-emerald-600 dark:text-emerald-400 text-xs"></i>
          </div>
          <div>
            <span class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold uppercase tracking-wider">
              <span x-show="lang==='id'">Stok Tersedia</span>
              <span x-show="lang==='en'">Stock Available</span>
            </span>
            <div class="font-bold text-ink dark:text-white transition-colors">{{ $product->stock }}</div>
          </div>
        </div>
        @endif

        {{-- Min Order --}}
        @if($product->min_order)
        <div class="flex items-center gap-3 mb-6 p-3.5 rounded-xl bg-blue-50 dark:bg-blue-900/15 border border-blue-200 dark:border-blue-800/30 transition-colors duration-300">
          <div class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
            <i class="fas fa-cubes text-blue-600 dark:text-blue-400 text-xs"></i>
          </div>
          <div>
            <span class="text-xs text-blue-600 dark:text-blue-400 font-semibold uppercase tracking-wider">
              <span x-show="lang==='id'">Minimum Order</span>
              <span x-show="lang==='en'">Minimum Order</span>
            </span>
            <div class="font-bold text-ink dark:text-white transition-colors">{{ $product->min_order }}</div>
          </div>
        </div>
        @endif

        {{-- Lab Data --}}
        @if($product->lab_data)
        <div class="mb-6">
          <div class="bg-gold-pale dark:bg-gold/10 rounded-2xl border border-gold/20 overflow-hidden transition-colors duration-300">
            {{-- Header --}}
            <div class="flex items-center gap-2.5 px-5 py-3.5"
                 style="background:linear-gradient(135deg,rgba(201,168,76,.12),rgba(201,168,76,.05));border-bottom:1px solid rgba(201,168,76,.15)">
              <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:rgba(201,168,76,.18)">
                <i class="fas fa-flask text-gold text-xs"></i>
              </div>
              <div>
                <div class="text-sm font-bold text-gold">
                  <span x-show="lang==='id'">Data Laboratorium</span>
                  <span x-show="lang==='en'">Laboratory Data</span>
                </div>
                <div class="text-[.6rem] text-slate-400 dark:text-gray-500 uppercase tracking-wider">SIG Laboratory Certified</div>
              </div>
            </div>
            {{-- Data --}}
            <div class="px-5 py-4">
              @php
                $lab = $product->lab_data;
              @endphp
              @if(is_array($lab))
                <div class="space-y-2">
                  @foreach($lab as $key => $val)
                  <div class="flex items-center justify-between py-1.5 {{ !$loop->last ? 'border-b border-gold/10' : '' }}">
                    <span class="text-sm text-slate-600 dark:text-gray-400 transition-colors">{{ is_string($key) ? $key : $val }}</span>
                    @if(is_string($key))
                    <span class="text-sm font-semibold text-ink dark:text-white transition-colors">{{ $val }}</span>
                    @endif
                  </div>
                  @endforeach
                </div>
              @else
                <p class="text-sm text-slate-700 dark:text-gray-300 leading-relaxed transition-colors">{!! $lab !!}</p>
              @endif
            </div>
          </div>
        </div>
        @endif

        {{-- CTA Buttons --}}
        <div class="flex flex-wrap gap-3 mb-6">
          @php
            $waMsg_id = "Halo, saya tertarik dengan produk *{$product->name}*. Bisa minta info lebih lanjut?";
            $waMsg_en = "Hello, I'm interested in the product *{$product->name}*. Can I get more information?";
          @endphp
          <a :href="lang==='en'
                ? 'https://wa.me/{{ $wa }}?text={{ urlencode($waMsg_en) }}'
                : 'https://wa.me/{{ $wa }}?text={{ urlencode($waMsg_id) }}'"
             target="_blank"
             class="btn-gold font-semibold px-8 py-4 rounded-full inline-flex items-center gap-2.5 flex-1 sm:flex-none justify-center">
            <i class="fab fa-whatsapp text-lg"></i>
            <span x-show="lang==='id'">Tanya & Pesan via WA</span>
            <span x-show="lang==='en'">Inquire & Order via WA</span>
          </a>
          <a href="mailto:{{ \App\Models\Setting::get('site_email', 'rempahjowoje25@gmail.com') }}?subject={{ urlencode($product->name) }}"
             class="border border-slate-300 dark:border-dark-border text-slate-700 dark:text-gray-300 hover:border-gold hover:text-gold
                    px-6 py-4 rounded-full inline-flex items-center gap-2 transition-all text-sm font-semibold">
            <i class="fas fa-envelope text-xs"></i>
            <span x-show="lang==='id'">Kirim Email</span>
            <span x-show="lang==='en'">Send Email</span>
          </a>
        </div>

        <a href="{{ route('products') }}"
           class="inline-flex items-center gap-2 text-sm text-slate-500 dark:text-gray-400 hover:text-gold transition-colors">
          <i class="fas fa-arrow-left text-xs"></i>
          <span x-show="lang==='id'">Kembali ke Semua Produk</span>
          <span x-show="lang==='en'">Back to All Products</span>
        </a>

        {{-- Meta --}}
        <div class="mt-8 text-xs text-slate-400 dark:text-gray-500 border-t border-slate-200 dark:border-dark-border pt-5 space-y-1.5 transition-colors">
          <p class="flex items-center gap-2">
            <i class="fas fa-tag text-gold"></i>
            <span x-show="lang==='id'">Kategori: <span class="text-slate-600 dark:text-gray-300 font-medium">{{ $product->category }}</span></span>
            <span x-show="lang==='en'">Category: <span class="text-slate-600 dark:text-gray-300 font-medium">{{ $product->category }}</span></span>
          </p>
          @if($product->sku)
          <p class="flex items-center gap-2">
            <i class="fas fa-barcode text-gold"></i>
            SKU: <span class="text-slate-600 dark:text-gray-300 font-medium">{{ $product->sku }}</span>
          </p>
          @endif
          @if($product->unit)
          <p class="flex items-center gap-2">
            <i class="fas fa-scale-balanced text-gold"></i>
            <span x-show="lang==='id'">Satuan: <span class="text-slate-600 dark:text-gray-300 font-medium">{{ $product->unit }}</span></span>
            <span x-show="lang==='en'">Unit: <span class="text-slate-600 dark:text-gray-300 font-medium">{{ $product->unit }}</span></span>
          </p>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ══════════ RELATED PRODUCTS ══════════ --}}
@if(isset($related) && $related->count())
<section class="py-16 bg-white dark:bg-dark transition-colors duration-300">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="text-center mb-10 reveal">
      <div class="flex items-center justify-center gap-2 text-gold text-xs font-bold uppercase tracking-[.18em] mb-3">
        <span class="w-4 h-px bg-gold"></span>
        <span x-show="lang==='id'">Produk Lainnya</span>
        <span x-show="lang==='en'">Other Products</span>
        <span class="w-4 h-px bg-gold"></span>
      </div>
      <h2 class="font-display text-3xl font-bold text-ink dark:text-white transition-colors">
        <span x-show="lang==='id'">Produk <em class="not-italic text-gold">Terkait</em></span>
        <span x-show="lang==='en'">Related <em class="not-italic text-gold">Products</em></span>
      </h2>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($related as $i => $rel)
      <a href="{{ route('products.show', $rel->slug) }}"
         class="group bg-white dark:bg-dark-card border border-slate-200 dark:border-dark-border rounded-2xl overflow-hidden
                hover:-translate-y-1.5 hover:shadow-xl hover:border-gold/30 transition-all duration-300 reveal"
         style="transition-delay:{{ $i * 80 }}ms">
        <div class="aspect-[4/3] overflow-hidden bg-gold-pale dark:bg-dark-surface">
          <img src="{{ $rel->image ? asset('storage/'.$rel->image) : 'https://images.unsplash.com/photo-1615485500834-bc10199bc727?w=600&q=80' }}"
               alt="{{ $rel->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
          @if($rel->badge)
          <span class="absolute top-3 left-3 bg-gold text-white text-xs font-bold px-3 py-1 rounded-full">{{ $rel->badge }}</span>
          @endif
        </div>
        <div class="p-5">
          <div class="text-xs text-gold font-semibold uppercase tracking-[.12em] mb-1">{{ $rel->category }}</div>
          <h3 class="font-display text-lg font-semibold text-ink dark:text-white transition-colors leading-tight mb-2">{{ $rel->name }}</h3>
          @if($rel->price)
          <span class="text-sm font-bold text-ink dark:text-white transition-colors">
            Rp {{ number_format($rel->price, 0, ',', '.') }}
            <span class="text-xs font-normal text-slate-400">/{{ $rel->unit ?? 'kg' }}</span>
          </span>
          @else
          <span class="text-xs text-slate-400 italic">
            <span x-show="lang==='id'">Hubungi untuk harga</span>
            <span x-show="lang==='en'">Contact for price</span>
          </span>
          @endif
          <span class="float-right text-xs font-semibold text-gold inline-flex items-center gap-1.5 group-hover:gap-2.5 transition-all mt-1">
            Detail <i class="fas fa-arrow-right text-[.55rem]"></i>
          </span>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- ══════════ CTA SECTION ══════════ --}}
<section class="py-16 bg-cream dark:bg-dark-surface transition-colors duration-300">
  <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center reveal">
    <div class="w-14 h-14 bg-gold/10 rounded-2xl flex items-center justify-center mx-auto mb-5">
      <i class="fas fa-file-lines text-gold text-xl"></i>
    </div>
    <h2 class="font-display text-3xl font-bold text-ink dark:text-white mb-3 transition-colors">
      <span x-show="lang==='id'">Butuh <em class="not-italic text-gold">Spesifikasi Teknis</em>?</span>
      <span x-show="lang==='en'">Need <em class="not-italic text-gold">Technical Specifications</em>?</span>
    </h2>
    <p class="text-slate-500 dark:text-gray-400 mb-7 leading-relaxed transition-colors">
      <span x-show="lang==='id'">Kami menyediakan Certificate of Analysis (COA), hasil uji lab lengkap, dan spesifikasi teknis
      untuk kebutuhan importir global. Hubungi tim kami sekarang.</span>
      <span x-show="lang==='en'">We provide Certificate of Analysis (COA), complete lab test results, and technical specifications
      for global importer needs. Contact our team now.</span>
    </p>
    <div class="flex flex-wrap justify-center gap-3">
      <a href="{{ route('contact') }}" class="btn-gold font-semibold text-sm px-7 py-3.5 rounded-full">
        <i class="fas fa-file-lines"></i>
        <span x-show="lang==='id'">Minta Dokumen Teknis</span>
        <span x-show="lang==='en'">Request Technical Documents</span>
      </a>
      <a href="https://wa.me/{{ $wa }}" target="_blank"
         class="inline-flex items-center gap-2 border border-slate-200 dark:border-dark-border text-slate-600 dark:text-gray-400 hover:border-gold hover:text-gold px-7 py-3.5 rounded-full text-sm transition-all">
        <i class="fab fa-whatsapp"></i> Chat WhatsApp
      </a>
    </div>
  </div>
</section>

@endsection
