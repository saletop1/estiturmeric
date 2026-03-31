@extends('layouts.app')
@section('content')

{{-- Page Header dengan judul produk --}}
<div class="relative pt-20 overflow-hidden"
     style="background:url('https://images.unsplash.com/photo-1596040033229-a9821ebd058d?w=1600&q=80&auto=format&fit=crop') center center / cover no-repeat;min-height:340px">
  <div class="absolute inset-0 pointer-events-none" style="background:rgba(0,0,0,.52)"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 py-20 text-center">
    <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[.2em] mb-5" style="color:#c9a84c">
      <span class="w-4 h-px" style="background:#c9a84c"></span> Detail Produk <span class="w-4 h-px" style="background:#c9a84c"></span>
    </div>
    <h1 class="font-display text-5xl md:text-6xl font-bold text-white leading-tight">
      {{ $product->name ?? 'Produk' }}
    </h1>
    <p class="mt-4 max-w-xl mx-auto leading-[1.78]" style="color:rgba(255,255,255,.65)">
      {{ $product->category ?? '' }}
    </p>
  </div>
  <div class="absolute bottom-0 inset-x-0 h-px"
       style="background:linear-gradient(to right,transparent,rgba(201,168,76,.45),transparent)"></div>
</div>

{{-- Konten Detail --}}
<section class="py-20 bg-cream">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
      {{-- Gambar Produk --}}
      <div class="relative reveal">
        <div class="rounded-2xl overflow-hidden border-4 border-white shadow-xl">
          <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://images.unsplash.com/photo-1615485500834-bc10199bc727?w=800&q=80' }}"
               alt="{{ $product->name }}"
               class="w-full h-auto object-cover">
        </div>
        @if($product->badge)
        <span class="absolute top-4 left-4 bg-gold text-white text-xs font-bold px-4 py-2 rounded-full">
          {{ $product->badge }}
        </span>
        @endif
      </div>

      {{-- Informasi Produk --}}
      <div class="reveal stagger-100">
        <h2 class="font-display text-4xl font-bold text-ink mb-4">{{ $product->name }}</h2>
        <div class="text-gold font-semibold text-sm uppercase tracking-wider mb-4">{{ $product->category }}</div>

        <div class="prose prose-slate max-w-none mb-6">
          @php
            $desc = $product->description ?? '<p>Deskripsi produk belum tersedia.</p>';
            if (is_array($desc)) {
                $desc = implode('<br>', $desc);
            }
          @endphp
          {!! $desc !!}
        </div>

        @if($product->price)
        <div class="flex items-baseline gap-2 mb-6">
          <span class="text-3xl font-bold text-ink">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
          <span class="text-slate-400">/{{ $product->unit ?? 'kg' }}</span>
        </div>
        @endif

        @if($product->stock)
        <div class="mb-6">
          <span class="text-sm text-slate-500">Stok tersedia: </span>
          <span class="font-semibold">{{ $product->stock }}</span>
        </div>
        @endif

        {{-- Spesifikasi / Data Lab --}}
        @if($product->lab_data)
        <div class="bg-gold-pale p-6 rounded-2xl border border-gold/20 mb-6">
          <div class="flex items-center gap-2 text-gold font-bold mb-3">
            <i class="fas fa-flask"></i> Data Laboratorium
          </div>
          <p class="text-sm text-slate-700">
            @php
              $lab = $product->lab_data;
              if (is_array($lab)) {
                  echo implode('<br>', $lab);
              } else {
                  echo $lab;
              }
            @endphp
          </p>
        </div>
        @endif

        {{-- Tombol Aksi --}}
        @php
          $wa = \App\Models\Setting::get('wa_number', '6282138280770');
          $message = "Halo, saya tertarik dengan produk *{$product->name}*. Bisa minta info lebih lanjut?";
        @endphp
        <div class="flex flex-wrap gap-4">
          <a href="https://wa.me/{{ $wa }}?text={{ urlencode($message) }}"
             target="_blank"
             class="btn-gold font-semibold px-8 py-4 rounded-full inline-flex items-center gap-2">
            <i class="fab fa-whatsapp"></i> Tanya & Pesan via WA
          </a>
          <a href="{{ route('products') }}"
             class="border border-slate-300 text-slate-700 hover:border-gold hover:text-gold px-8 py-4 rounded-full inline-flex items-center gap-2 transition-all">
            <i class="fas fa-arrow-left"></i> Kembali
          </a>
        </div>

        {{-- Metadata tambahan --}}
        <div class="mt-8 text-xs text-slate-400 border-t border-slate-200 pt-6">
          <p><i class="fas fa-tag mr-2"></i> Kategori: {{ $product->category }}</p>
          @if($product->sku)
          <p class="mt-1"><i class="fas fa-barcode mr-2"></i> SKU: {{ $product->sku }}</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Produk Terkait (opsional) --}}
@if(isset($related) && $related->count())
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <h2 class="font-display text-3xl font-bold text-ink text-center mb-10">Produk <em class="not-italic text-gold">Terkait</em></h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($related as $rel)
      <a href="{{ route('products.show', $rel->slug) }}" class="group bg-white border border-slate-200 rounded-2xl overflow-hidden hover:shadow-lg transition-all">
        <div class="aspect-[4/3] overflow-hidden bg-gold-pale">
          <img src="{{ $rel->image ? asset('storage/'.$rel->image) : 'https://images.unsplash.com/photo-1615485500834-bc10199bc727?w=600&q=80' }}"
               alt="{{ $rel->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        </div>
        <div class="p-4">
          <h3 class="font-display font-semibold text-ink">{{ $rel->name }}</h3>
          <p class="text-xs text-gold">{{ $rel->category }}</p>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- Lab Spec CTA (sama seperti halaman lain) --}}
<section class="py-16 bg-cream">
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