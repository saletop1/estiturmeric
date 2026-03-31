{{-- resources/views/frontend/contact.blade.php --}}
@extends('layouts.app')

@push('styles')
<style>
.photo-panel {
  position: relative;
  flex-shrink: 0;
  overflow: hidden;
  clip-path: polygon(12% 0%, 100% 0%, 88% 100%, 0% 100%);
  margin-left: -20px;
}
.photo-panel:first-child {
  clip-path: polygon(0% 0%, 100% 0%, 88% 100%, 0% 100%);
  margin-left: 0;
}
.photo-panel:last-child {
  clip-path: polygon(12% 0%, 100% 0%, 100% 100%, 0% 100%);
}
.photo-panel img {
  width: 100%; height: 100%; object-fit: cover; display: block;
  transition: transform .45s ease;
}
.photo-panel:hover img { transform: scale(1.08); }
.dot-grid {
  background-image: radial-gradient(circle, rgba(201,168,76,.5) 1.5px, transparent 1.5px);
  background-size: 10px 10px;
}
</style>
@endpush

@section('content')

{{-- ══════════ BANNER — Diagonal Panels ══════════ --}}
@php $bannerContact = \App\Models\Setting::get('banner_contact'); @endphp
<div class="relative overflow-hidden" style="background:#1a1410;padding-top:72px;padding-bottom:60px">

  {{-- Custom banner override jika diupload admin --}}
  @if($bannerContact)
  <div class="absolute inset-0 pointer-events-none" style="z-index:0">
    <img src="{{ asset('storage/'.$bannerContact) }}" alt="" class="w-full h-full object-cover opacity-30">
  </div>
  @endif

  {{-- Dot grid dekorasi --}}
  <div class="absolute dot-grid pointer-events-none" style="top:80px;left:12px;width:110px;height:110px;z-index:0;opacity:.6"></div>
  <div class="absolute dot-grid pointer-events-none" style="bottom:12px;right:220px;width:90px;height:90px;z-index:0;opacity:.4"></div>

  {{-- Konten --}}
  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 flex items-end" style="z-index:2;padding-top:2rem;padding-bottom:0;gap:0">

    {{-- 4 Panel foto diagonal — dari database produk --}}
    <div class="flex flex-1 min-w-0" style="height:230px">
      @php
        // Ambil 4 produk aktif dari database, prioritaskan yang punya gambar
        $contactPanels = \App\Models\Product::where('is_active', true)
            ->whereNotNull('image')
            ->orderBy('sort_order')
            ->limit(4)
            ->get();

        // Fallback jika produk di DB belum ada gambar
        $fallbackPanels = [
          ['src'=>'https://images.unsplash.com/photo-1615485500834-bc10199bc727?w=600&q=80', 'label'=>'Kunyit Segar'],
          ['src'=>'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?w=600&q=80',  'label'=>'Kunyit Kering'],
          ['src'=>'https://images.unsplash.com/photo-1615485291234-9d694218aeb3?w=600&q=80', 'label'=>'Ekstrak'],
          ['src'=>'https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=600&q=80',  'label'=>'Rempah Alam'],
        ];
      @endphp

      @if($contactPanels->count() >= 2)
        {{-- Gunakan gambar dari database --}}
        @foreach($contactPanels as $p)
        <div class="photo-panel" style="width:27%;height:100%">
          <img src="{{ asset('storage/'.$p->image) }}" alt="{{ $p->name }}">
          <div class="absolute inset-0" style="background:linear-gradient(to top,rgba(0,0,0,.55) 0%,rgba(0,0,0,.10) 60%)"></div>
          <div class="absolute bottom-0 left-0 right-0 px-3 pb-2.5">
            <span class="text-white font-semibold" style="font-size:.65rem;opacity:.85">{{ $p->name }}</span>
          </div>
        </div>
        @endforeach
      @else
        {{-- Fallback gambar default --}}
        @foreach($fallbackPanels as $p)
        <div class="photo-panel" style="width:27%;height:100%">
          <img src="{{ $p['src'] }}" alt="{{ $p['label'] }}">
          <div class="absolute inset-0" style="background:linear-gradient(to top,rgba(0,0,0,.55) 0%,rgba(0,0,0,.10) 60%)"></div>
          <div class="absolute bottom-0 left-0 right-0 px-3 pb-2.5">
            <span class="text-white font-semibold" style="font-size:.65rem;opacity:.85">{{ $p['label'] }}</span>
          </div>
        </div>
        @endforeach
      @endif
    </div>

    {{-- Kanan: Teks + Logo --}}
    <div class="flex-shrink-0 flex flex-col justify-between items-end pb-4" style="width:260px;height:230px;padding-left:2rem">

      {{-- Heading --}}
      <div class="text-right">
        <div class="text-xs font-bold uppercase tracking-[.22em] mb-1" style="color:#c9a84c">PT. Diyani Rempah Saketi</div>
        <div class="font-display font-black text-white leading-none" style="font-size:2.2rem">KONTAK</div>
        <div class="inline-block mt-1 px-3 py-0.5" style="background:#c9a84c">
          <span class="font-black text-white uppercase tracking-wider" style="font-size:1.35rem">KAMI</span>
        </div>
        <p class="font-display italic mt-1.5" style="font-size:1rem;color:rgba(255,255,255,.70)">Hubungi & Bekerjasama</p>
      </div>

      {{-- Logo --}}
      <img src="{{ asset('images/diyani.png') }}" alt="Logo Diyani"
           class="w-20 h-20 object-contain drop-shadow-xl"
           onerror="this.style.display='none'">
    </div>
  </div>

  {{-- Wave SVG pemisah — di luar konten agar tidak menutupi --}}
  <svg class="absolute inset-x-0 bottom-0 pointer-events-none" style="z-index:3"
       viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M0,30 C240,60 480,0 720,30 C960,60 1200,0 1440,30 L1440,60 L0,60 Z"
          fill="rgba(26,20,10,.55)"/>
    <path d="M0,42 C240,70 480,14 720,42 C960,70 1200,14 1440,42 L1440,60 L0,60 Z"
          fill="#ffffff"/>
  </svg>
</div>

{{-- ══════════ INFO + MAP ══════════ --}}
<section class="bg-white" style="padding-top:1rem;padding-bottom:5rem">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 grid md:grid-cols-5 gap-12">

    {{-- Info --}}
    <div class="md:col-span-2 reveal">
      <h2 class="font-display text-2xl font-bold text-ink mb-6">Informasi Kontak</h2>
      <div class="space-y-5">
        @foreach([
          ['icon'=>'fas fa-location-dot','label'=>'Alamat Kantor',     'val'=>'Tegalsari Barat II/30, Kota Semarang, Jawa Tengah, Indonesia 50251'],
          ['icon'=>'fab fa-whatsapp',    'label'=>'WhatsApp / Telepon','val'=>'+62 821-3828-0770 | +62 812-9059-7467'],
          ['icon'=>'fas fa-envelope',    'label'=>'Email',             'val'=>'rempahjowoje25@gmail.com'],
        ] as $c)
        <div class="flex gap-4">
          <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
               style="background:rgba(201,168,76,.15);border:1px solid rgba(201,168,76,.25)">
            <i class="{{ $c['icon'] }} text-sm" style="color:#c9a84c"></i>
          </div>
          <div>
            <div class="text-xs text-slate-400 uppercase tracking-wide font-medium mb-0.5">{{ $c['label'] }}</div>
            <div class="text-sm text-ink font-medium">{{ $c['val'] }}</div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="mt-8">
        <a href="https://wa.me/6282138280770" target="_blank"
           class="btn-gold inline-flex items-center gap-2 text-white font-semibold px-6 py-3 rounded-full text-sm w-full justify-center">
          <i class="fab fa-whatsapp text-lg"></i> Chat via WhatsApp
        </a>
      </div>
    </div>

    {{-- Map --}}
    <div class="md:col-span-3 reveal" style="transition-delay:.15s">
      <div class="rounded-2xl overflow-hidden h-80 bg-slate-100 border border-slate-200">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.395!2d110.4089!3d-6.9932!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sTegalsari+Barat+Semarang!5e0!3m2!1sid!2sid!4v1"
          width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
      </div>
    </div>
  </div>
</section>

@endsection