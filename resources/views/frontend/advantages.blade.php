{{-- resources/views/frontend/advantages.blade.php --}}
@extends('layouts.app')
@section('content')

{{-- ======== BANNER ======== --}}
<div class="relative pt-20 overflow-hidden" style="min-height:360px">
  <div class="absolute inset-0 w-1/2"
       style="background:url('https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=900&q=80&auto=format&fit=crop') center center / cover no-repeat"></div>
  <div class="absolute inset-0 left-1/2"
       style="background:url('https://images.unsplash.com/photo-1521791136064-7986c2920216?w=900&q=80&auto=format&fit=crop') center center / cover no-repeat"></div>
  <div class="absolute inset-0"
       style="background:linear-gradient(to right,rgba(0,0,0,.68) 0%,rgba(0,0,0,.52) 45%,rgba(0,0,0,.52) 55%,rgba(0,0,0,.68) 100%)"></div>
  <div class="absolute inset-y-0 left-1/2 -translate-x-1/2 w-px"
       style="background:linear-gradient(to bottom,transparent,rgba(201,168,76,.35),transparent)"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 py-20 text-center">
    <div class="flex items-center justify-center gap-2 text-xs font-semibold uppercase tracking-widest mb-4" style="color:#c9a84c">
      <span class="w-6 h-px" style="background:#c9a84c"></span>
      <span x-show="lang==='id'">Keunggulan</span>
      <span x-show="lang==='en'">Advantages</span>
      <span class="w-6 h-px" style="background:#c9a84c"></span>
    </div>
    <h1 class="font-display text-5xl font-bold text-white">
      <span x-show="lang==='id'">Mengapa Memilih <em class="not-italic" style="color:#c9a84c">Kami?</em></span>
      <span x-show="lang==='en'">Why Choose <em class="not-italic" style="color:#c9a84c">Us?</em></span>
    </h1>
    <p class="mt-4 text-sm max-w-lg mx-auto leading-relaxed" style="color:rgba(255,255,255,.58)">
      <span x-show="lang==='id'">Kualitas laboratorium bertemu layanan profesional — standar yang tidak kami kompromikan.</span>
      <span x-show="lang==='en'">Laboratory quality meets professional service — standards we never compromise.</span>
    </p>
  </div>

  <div class="absolute bottom-0 inset-x-0 h-px"
       style="background:linear-gradient(to right,transparent,rgba(201,168,76,.45),transparent)"></div>
</div>

<section class="py-24 bg-white dark:bg-dark transition-colors duration-300">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-8 max-w-4xl mx-auto">
      @foreach([
        ['icon'=>'fas fa-flask',
         'id_title'=>'Kualitas Teruji Lab','en_title'=>'Lab-Tested Quality',
         'id_desc'=>'Keamanan dan kandungan dijamin terverifikasi oleh SIG Laboratory (Cert No: SIG.LHP.XII.2025.181616271). Setiap batch dilengkapi Certificate of Analysis.',
         'en_desc'=>'Safety and content guaranteed verified by SIG Laboratory (Cert No: SIG.LHP.XII.2025.181616271). Every batch includes a Certificate of Analysis.'],
        ['icon'=>'fas fa-scale-balanced',
         'id_title'=>'Kepatuhan Legal Penuh','en_title'=>'Full Legal Compliance',
         'id_desc'=>'Entitas terdaftar resmi dengan izin ekspor lengkap (NIB & AHU). Dokumen legal siap untuk proses bea cukai internasional.',
         'en_desc'=>'Officially registered entity with complete export licenses (NIB & AHU). Legal documents ready for international customs processes.'],
        ['icon'=>'fas fa-star',
         'id_title'=>'Standar Premium','en_title'=>'Premium Standards',
         'id_desc'=>'Pengolahan berstandar profesional dengan kebijakan ketat "tanpa pengawet". Produk kami 100% alami dan bersih.',
         'en_desc'=>'Professional standard processing with strict "no preservatives" policy. Our products are 100% natural and clean.'],
        ['icon'=>'fas fa-leaf',
         'id_title'=>'Pengelolaan Lingkungan','en_title'=>'Environmental Stewardship',
         'id_desc'=>'Komitmen terhadap produksi ramah lingkungan dan praktik pertanian berkelanjutan bersama petani lokal Jawa Tengah.',
         'en_desc'=>'Commitment to environmentally friendly production and sustainable farming practices with local Central Java farmers.'],
      ] as $i => $a)
      <div class="group flex gap-6 p-6 bg-slate-50 dark:bg-dark-card border border-slate-200 dark:border-dark-border rounded-2xl hover:border-gold/40 hover:shadow-lg transition-all duration-300 reveal" style="transition-delay:{{ $i*80 }}ms">
        <div class="flex-shrink-0">
          <div class="w-12 h-12 rounded-xl bg-gold/15 border border-gold/25 flex items-center justify-center">
            <i class="{{ $a['icon'] }} text-gold text-base"></i>
          </div>
        </div>
        <div>
          <h3 class="font-display text-xl font-bold text-ink dark:text-white mb-2 transition-colors">
            <span x-show="lang==='id'">{{ $a['id_title'] }}</span>
            <span x-show="lang==='en'">{{ $a['en_title'] }}</span>
          </h3>
          <p class="text-sm text-slate-500 dark:text-gray-400 leading-relaxed transition-colors">
            <span x-show="lang==='id'">{{ $a['id_desc'] }}</span>
            <span x-show="lang==='en'">{{ $a['en_desc'] }}</span>
          </p>
        </div>
      </div>
      @endforeach
    </div>

    {{-- Lab Data --}}
    <div class="mt-20 reveal">
      <h2 class="font-display text-3xl font-bold text-ink dark:text-white text-center mb-10 transition-colors">
        <span x-show="lang==='id'">Data <em class="not-italic text-gold">Laboratorium</em> — Kunyit Kering</span>
        <span x-show="lang==='en'"><em class="not-italic text-gold">Laboratory</em> Data — Dried Turmeric</span>
      </h2>
      <div class="max-w-3xl mx-auto bg-white dark:bg-dark-card border border-slate-200 dark:border-dark-border rounded-2xl overflow-hidden shadow-sm transition-colors duration-300">
        @foreach([
          ['id_label'=>'Kurkumin','en_label'=>'Curcumin','val'=>'28.270,40 mg/kg'],
          ['id_label'=>'Kandungan Minyak Atsiri (VOC)','en_label'=>'Essential Oil Content (VOC)','val'=>'5,38%'],
          ['id_label'=>'Kandungan Protein','en_label'=>'Protein Content','val'=>'10,56%'],
          ['id_label'=>'Karbohidrat','en_label'=>'Carbohydrates','val'=>'69,87%'],
          ['id_label'=>'Total Energi','en_label'=>'Total Energy','val'=>'328,74 Kcal/100g'],
          ['id_label'=>'Kadar Air (Bidwell Sterling)','en_label'=>'Moisture Content (Bidwell Sterling)','val'=>'7,91%'],
          ['id_label'=>'Kadar Abu','en_label'=>'Ash Content','val'=>'10,88%'],
          ['id_label'=>'Total Lemak','en_label'=>'Total Fat','val'=>'0,78%'],
          ['id_label'=>'Okratoksin (Aflatoksin)','en_label'=>'Ochratoxin (Aflatoxin)','id_val'=>'Tidak Terdeteksi ✓','en_val'=>'Not Detected ✓'],
        ] as $i => $d)
        <div class="flex items-center justify-between px-6 py-3.5 {{ $i%2===0?'bg-slate-50 dark:bg-dark-surface':'bg-white dark:bg-dark-card' }} border-b border-slate-100 dark:border-dark-border last:border-0 transition-colors duration-300">
          <span class="text-sm font-medium text-slate-700 dark:text-gray-300 transition-colors">
            <span x-show="lang==='id'">{{ $d['id_label'] }}</span>
            <span x-show="lang==='en'">{{ $d['en_label'] }}</span>
          </span>
          <span class="text-sm font-semibold {{ isset($d['id_val']) && str_contains($d['id_val'],'✓') ? 'text-green-600 dark:text-green-400' : 'text-ink dark:text-white' }} transition-colors">
            @if(isset($d['id_val']))
              <span x-show="lang==='id'">{{ $d['id_val'] }}</span>
              <span x-show="lang==='en'">{{ $d['en_val'] }}</span>
            @else
              {{ $d['val'] }}
            @endif
          </span>
        </div>
        @endforeach
        <div class="px-6 py-4 bg-gold-pale dark:bg-gold/10 border-t border-gold/20 transition-colors duration-300">
          <p class="text-xs text-gold font-medium">
            <i class="fas fa-certificate mr-1.5"></i>
            <span x-show="lang==='id'">Sertifikat: SIG.LHP.XII.2025.181616271 — SIG Laboratory</span>
            <span x-show="lang==='en'">Certificate: SIG.LHP.XII.2025.181616271 — SIG Laboratory</span>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
