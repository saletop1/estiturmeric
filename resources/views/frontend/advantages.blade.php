{{-- resources/views/frontend/advantages.blade.php --}}
@extends('layouts.app')
@section('content')

{{-- ══════════ BANNER — 2 foto + gradasi ══════════ --}}
<div class="relative pt-20 overflow-hidden" style="min-height:360px">

  {{-- Foto kiri: laboratorium --}}
  <div class="absolute inset-0 w-1/2"
       style="background:url('https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=900&q=80&auto=format&fit=crop') center center / cover no-repeat"></div>

  {{-- Foto kanan: customer service kantor --}}
  <div class="absolute inset-0 left-1/2"
       style="background:url('https://images.unsplash.com/photo-1521791136064-7986c2920216?w=900&q=80&auto=format&fit=crop') center center / cover no-repeat"></div>

  {{-- Overlay gelap rata + gradasi tengah agar teks terbaca --}}
  <div class="absolute inset-0"
       style="background:linear-gradient(to right,rgba(0,0,0,.68) 0%,rgba(0,0,0,.52) 45%,rgba(0,0,0,.52) 55%,rgba(0,0,0,.68) 100%)"></div>
  {{-- Garis gradasi tengah (pemisah halus) --}}
  <div class="absolute inset-y-0 left-1/2 -translate-x-1/2 w-px"
       style="background:linear-gradient(to bottom,transparent,rgba(201,168,76,.35),transparent)"></div>

  {{-- Konten teks --}}
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 py-20 text-center">
    <div class="flex items-center justify-center gap-2 text-xs font-semibold uppercase tracking-widest mb-4" style="color:#c9a84c">
      <span class="w-6 h-px" style="background:#c9a84c"></span>
      Keunggulan
      <span class="w-6 h-px" style="background:#c9a84c"></span>
    </div>
    <h1 class="font-display text-5xl font-bold text-white">
      Mengapa Memilih <em class="not-italic" style="color:#c9a84c">Kami?</em>
    </h1>
    <p class="mt-4 text-sm max-w-lg mx-auto leading-relaxed" style="color:rgba(255,255,255,.58)">
      Kualitas laboratorium bertemu layanan profesional — standar yang tidak kami kompromikan.
    </p>
  </div>

  {{-- Garis gold bawah --}}
  <div class="absolute bottom-0 inset-x-0 h-px"
       style="background:linear-gradient(to right,transparent,rgba(201,168,76,.45),transparent)"></div>
</div>

<section class="py-24 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-8 max-w-4xl mx-auto">
      @foreach([
        ['icon'=>'fas fa-flask',          'title'=>'Kualitas Teruji Lab',    'desc'=>'Keamanan dan kandungan dijamin terverifikasi oleh SIG Laboratory (Cert No: SIG.LHP.XII.2025.181616271). Setiap batch dilengkapi Certificate of Analysis.'],
        ['icon'=>'fas fa-scale-balanced', 'title'=>'Kepatuhan Legal Penuh',  'desc'=>'Entitas terdaftar resmi dengan izin ekspor lengkap (NIB & AHU). Dokumen legal siap untuk proses bea cukai internasional.'],
        ['icon'=>'fas fa-star',           'title'=>'Standar Premium',        'desc'=>'Pengolahan berstandar profesional dengan kebijakan ketat "tanpa pengawet". Produk kami 100% alami dan bersih.'],
        ['icon'=>'fas fa-leaf',           'title'=>'Pengelolaan Lingkungan', 'desc'=>'Komitmen terhadap produksi ramah lingkungan dan praktik pertanian berkelanjutan bersama petani lokal Jawa Tengah.'],
      ] as $i => $a)
      <div class="group flex gap-6 p-6 bg-slate-50 border border-slate-200 rounded-2xl hover:border-gold/40 hover:shadow-lg transition-all duration-300 reveal" style="transition-delay:{{ $i*80 }}ms">
        <div class="flex-shrink-0">
          <div class="w-12 h-12 rounded-xl bg-gold/15 border border-gold/25 flex items-center justify-center">
            <i class="{{ $a['icon'] }} text-gold text-base"></i>
          </div>
        </div>
        <div>
          <h3 class="font-display text-xl font-bold text-ink mb-2">{{ $a['title'] }}</h3>
          <p class="text-sm text-slate-500 leading-relaxed">{{ $a['desc'] }}</p>
        </div>
      </div>
      @endforeach
    </div>

    {{-- Lab Data --}}
    <div class="mt-20 reveal">
      <h2 class="font-display text-3xl font-bold text-ink text-center mb-10">Data <em class="not-italic text-gold">Laboratorium</em> — Kunyit Kering</h2>
      <div class="max-w-3xl mx-auto bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
        @foreach([
          ['label'=>'Kurkumin','val'=>'28.270,40 mg/kg'],
          ['label'=>'Kandungan Minyak Atsiri (VOC)','val'=>'5,38%'],
          ['label'=>'Kandungan Protein','val'=>'10,56%'],
          ['label'=>'Karbohidrat','val'=>'69,87%'],
          ['label'=>'Total Energi','val'=>'328,74 Kcal/100g'],
          ['label'=>'Kadar Air (Bidwell Sterling)','val'=>'7,91%'],
          ['label'=>'Kadar Abu','val'=>'10,88%'],
          ['label'=>'Total Lemak','val'=>'0,78%'],
          ['label'=>'Okratoksin (Aflatoksin)','val'=>'Tidak Terdeteksi ✓'],
        ] as $i => $d)
        <div class="flex items-center justify-between px-6 py-3.5 {{ $i%2===0?'bg-slate-50':'bg-white' }} border-b border-slate-100 last:border-0">
          <span class="text-sm font-medium text-slate-700">{{ $d['label'] }}</span>
          <span class="text-sm font-semibold {{ str_contains($d['val'],'✓')?'text-green-600':'text-ink' }}">{{ $d['val'] }}</span>
        </div>
        @endforeach
        <div class="px-6 py-4 bg-gold-pale border-t border-gold/20">
          <p class="text-xs text-gold font-medium"><i class="fas fa-certificate mr-1.5"></i>Sertifikat: SIG.LHP.XII.2025.181616271 — SIG Laboratory</p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection