{{-- resources/views/frontend/about.blade.php --}}
@extends('layouts.app')

@push('styles')
<style>
/* -- Card lift -- */
.card-lift { transition: transform .25s ease, box-shadow .25s ease; }
.card-lift:hover { transform: translateY(-6px); box-shadow: 0 20px 48px rgba(0,0,0,.12); }

/* -- Timeline -- */
.timeline-item { position: relative; padding-left: 2.5rem; }
.timeline-item::before {
  content: ''; position: absolute;
  left: .55rem; top: 1.5rem; bottom: -1.5rem;
  width: 1px;
  background: linear-gradient(to bottom, rgba(201,168,76,.5), transparent);
}
.timeline-item:last-child::before { display: none; }
.timeline-dot {
  position: absolute; left: 0; top: .3rem;
  width: 1.2rem; height: 1.2rem; border-radius: 50%;
  background: #c9a84c; box-shadow: 0 0 0 4px rgba(201,168,76,.18);
  display: flex; align-items: center; justify-content: center;
}

/* -- Visi/Misi -- */
.vm-panel { display: none; }
.vm-panel.active { display: block; }

/* -- Banner animations -- */
@keyframes rotateSlow { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }
@keyframes fadeUp    { from{opacity:0;transform:translateY(24px)} to{opacity:1;transform:translateY(0)} }

@keyframes wave { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-11px)} }
.badge-w1 { animation: wave 3.0s ease-in-out infinite 0.00s; }
.badge-w2 { animation: wave 3.0s ease-in-out infinite 0.55s; }
.badge-w3 { animation: wave 3.0s ease-in-out infinite 1.10s; }
.badge-w4 { animation: wave 3.0s ease-in-out infinite 1.65s; }

.banner-ring-1 { animation: rotateSlow 32s linear infinite; }
.banner-ring-2 { animation: rotateSlow 22s linear infinite reverse; }

.banner-fade-up  { animation: fadeUp .7s ease forwards; }
.banner-fade-up2 { animation: fadeUp .7s ease .15s forwards; opacity: 0; }
.banner-fade-up3 { animation: fadeUp .7s ease .30s forwards; opacity: 0; }
</style>
@endpush

@section('content')

{{-- ======== BANNER ======== --}}
<div id="about-banner" class="relative overflow-hidden pt-[72px]"
     style="background:url('https://images.unsplash.com/photo-1497366216548-37526070297c?w=1600&q=80&auto=format&fit=crop') center center / cover no-repeat;
            min-height:420px">

  <div class="absolute inset-0 pointer-events-none" style="background:rgba(0,0,0,.45)"></div>
  <canvas id="dust-canvas" class="absolute inset-0 pointer-events-none" style="z-index:2;width:100%;height:100%"></canvas>

  <div class="absolute pointer-events-none"
       style="left:-5rem;top:50%;transform:translateY(-50%);width:440px;height:440px;border-radius:50%;
              background:radial-gradient(circle,rgba(201,168,76,.22),transparent 65%);filter:blur(28px)"></div>
  <div class="absolute pointer-events-none"
       style="right:-3rem;bottom:-2rem;width:320px;height:320px;border-radius:50%;
              background:radial-gradient(circle,rgba(180,120,30,.15),transparent 65%);filter:blur(24px)"></div>

  <div class="absolute pointer-events-none hidden lg:flex items-center justify-content-center"
       style="right:1rem;top:50%;transform:translateY(-50%);width:200px;height:200px">
    <div class="banner-ring-1" style="position:absolute;width:200px;height:200px;border-radius:50%;border:1px solid rgba(201,168,76,.10)"></div>
    <div class="banner-ring-2" style="position:absolute;width:148px;height:148px;border-radius:50%;border:1px dashed rgba(201,168,76,.07)"></div>
    <div style="width:60px;height:60px;border-radius:50%;background:rgba(201,168,76,.06);border:1px solid rgba(201,168,76,.14);display:flex;align-items:center;justify-content:center">
      <i class="fas fa-leaf" style="color:rgba(201,168,76,.38);font-size:1.1rem"></i>
    </div>
  </div>

  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 banner-fade-up" style="z-index:5;padding-top:3rem">

    <div class="flex items-center gap-2 text-xs mb-4" style="color:rgba(255,255,255,.35)">
      <a href="{{ route('home') }}" class="hover:text-gold transition-colors" style="color:rgba(255,255,255,.35)">
        <span x-show="lang==='id'">Beranda</span><span x-show="lang==='en'">Home</span>
      </a>
      <i class="fas fa-chevron-right" style="font-size:.4rem;opacity:.5"></i>
      <span style="color:#c9a84c">
        <span x-show="lang==='id'">Tentang Kami</span><span x-show="lang==='en'">About Us</span>
      </span>
    </div>

    <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[.2em] px-3 py-1.5 rounded-full mb-4"
         style="background:rgba(201,168,76,.11);border:1px solid rgba(201,168,76,.32);color:#c9a84c">
      <span class="w-1.5 h-1.5 rounded-full" style="background:#c9a84c;box-shadow:0 0 6px #c9a84c"></span>
      <span x-show="lang==='id'">Tentang Perusahaan</span>
      <span x-show="lang==='en'">About the Company</span>
    </div>

    <h1 class="font-display font-bold leading-[1.08] mb-3 banner-fade-up2"
        style="font-size:clamp(2.2rem,5vw,3.8rem);color:#fff;text-shadow:0 2px 24px rgba(0,0,0,.5)">
      <span x-show="lang==='id'">Mengenal <em class="not-italic" style="color:#c9a84c">PT. Diyani</em><br>
      <span style="color:rgba(255,255,255,.90)">Rempah Saketi</span></span>
      <span x-show="lang==='en'">Discover <em class="not-italic" style="color:#c9a84c">PT. Diyani</em><br>
      <span style="color:rgba(255,255,255,.90)">Rempah Saketi</span></span>
    </h1>

    <p class="text-sm max-w-lg leading-relaxed mb-5 banner-fade-up3" style="color:rgba(255,255,255,.52)">
      <span x-show="lang==='id'">Produsen & Eksportir Kunyit Premium berbasis di Semarang, Jawa Tengah —
      menggabungkan kearifan lokal dengan standar ekspor global.</span>
      <span x-show="lang==='en'">Premium Turmeric Producer & Exporter based in Semarang, Central Java —
      combining local wisdom with global export standards.</span>
    </p>

    <div class="flex flex-wrap gap-2 banner-fade-up3">
      @foreach([
        ['icon'=>'fas fa-building', 'class'=>'badge-w1', 'bg'=>'rgba(255,255,255,.07)', 'border'=>'rgba(201,168,76,.28)', 'color'=>'rgba(255,255,255,.88)', 'id'=>'Berdiri 2025', 'en'=>'Founded 2025'],
        ['icon'=>'fas fa-globe',    'class'=>'badge-w2', 'bg'=>'rgba(201,168,76,.14)',  'border'=>'rgba(201,168,76,.38)', 'color'=>'#e0c06a',                'id'=>'7+ Negara Ekspor', 'en'=>'7+ Export Countries'],
        ['icon'=>'fas fa-flask',    'class'=>'badge-w3', 'bg'=>'rgba(255,255,255,.07)', 'border'=>'rgba(201,168,76,.28)', 'color'=>'rgba(255,255,255,.88)', 'id'=>'SIG Certified', 'en'=>'SIG Certified'],
        ['icon'=>'fas fa-id-card',  'class'=>'badge-w4', 'bg'=>'rgba(201,168,76,.14)',  'border'=>'rgba(201,168,76,.38)', 'color'=>'#e0c06a',                'id'=>'NIB Terdaftar', 'en'=>'NIB Registered'],
      ] as $b)
      <div class="{{ $b['class'] }} flex items-center gap-2 whitespace-nowrap"
           style="padding:.48rem .9rem;border-radius:.75rem;
                  background:{{ $b['bg'] }};border:1px solid {{ $b['border'] }};backdrop-filter:blur(8px)">
        <i class="{{ $b['icon'] }}" style="color:#c9a84c;font-size:.7rem"></i>
        <span style="font-size:.72rem;font-weight:600;color:{{ $b['color'] }}">
          <span x-show="lang==='id'">{{ $b['id'] }}</span>
          <span x-show="lang==='en'">{{ $b['en'] }}</span>
        </span>
      </div>
      @endforeach
    </div>
  </div>

  <div class="absolute bottom-0 inset-x-0 h-px"
       style="background:linear-gradient(to right,transparent,rgba(201,168,76,.45),transparent)"></div>
</div>

{{-- ======== SIAPA KAMI ======== --}}
<section class="py-20 bg-white dark:bg-dark transition-colors duration-300">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 grid md:grid-cols-2 gap-16 items-center">

    <div class="relative reveal">
      <div class="rounded-[1.5rem] overflow-hidden shadow-2xl aspect-[4/5]">
        <img src="https://images.unsplash.com/photo-1615485500834-bc10199bc727?w=800&q=80&auto=format&fit=crop"
             alt="Kunyit Diyani"
             class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
      </div>
      <div class="absolute -left-4 top-8 bg-white dark:bg-dark-card rounded-2xl px-4 py-3 shadow-xl z-10 card-lift transition-colors duration-300"
           style="border:1px solid #f1ece0">
        <div class="flex items-center gap-2">
          <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#fdf5e0">
            <i class="fas fa-certificate" style="color:#c9a84c;font-size:.7rem"></i>
          </div>
          <div>
            <div class="text-xs font-bold text-ink dark:text-white transition-colors">NIB Resmi</div>
            <div class="text-[.6rem] text-slate-400 dark:text-gray-500">0812250009634</div>
          </div>
        </div>
      </div>
      <div class="absolute -right-4 -bottom-4 rounded-2xl p-4 shadow-2xl z-10 card-lift" style="background:#c9a84c">
        <div class="font-display text-3xl font-bold text-white leading-tight">2025</div>
        <div class="text-xs uppercase tracking-wider" style="color:rgba(255,255,255,.80)">
          <span x-show="lang==='id'">Didirikan</span><span x-show="lang==='en'">Founded</span>
        </div>
      </div>
      <div class="absolute -right-4 top-1/3 bg-ink rounded-2xl px-3 py-2.5 shadow-xl z-10 card-lift">
        <div class="flex items-center gap-2">
          <i class="fas fa-flask" style="color:#c9a84c;font-size:.72rem"></i>
          <div>
            <div class="text-xs font-bold text-white">SIG Lab</div>
            <div class="text-[.6rem]" style="color:rgba(255,255,255,.55)">
              <span x-show="lang==='id'">Tersertifikasi</span><span x-show="lang==='en'">Certified</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="reveal" style="transition-delay:.15s">
      <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-[.18em] mb-4" style="color:#c9a84c">
        <span class="w-4 h-px" style="background:#c9a84c"></span>
        <span x-show="lang==='id'">Profil Perusahaan</span>
        <span x-show="lang==='en'">Company Profile</span>
      </div>
      <h2 class="font-display text-4xl font-bold text-ink dark:text-white leading-tight mb-5 transition-colors">
        <span x-show="lang==='id'">Siapa <em class="not-italic" style="color:#c9a84c">Kami?</em></span>
        <span x-show="lang==='en'">Who Are <em class="not-italic" style="color:#c9a84c">We?</em></span>
      </h2>
      <p class="text-slate-500 dark:text-gray-400 leading-[1.85] mb-4 transition-colors">
        <span x-show="lang==='id'">PT. Diyani Rempah Saketi didirikan pada 2025
        <span class="text-slate-400 text-xs">(SK No: AHU-066520.AH.01.30.Tahun 2025)</span>
        sebagai produsen dan eksportir kunyit berkualitas premium berkedudukan di Semarang, Jawa Tengah.</span>
        <span x-show="lang==='en'">PT. Diyani Rempah Saketi was established in 2025
        <span class="text-slate-400 text-xs">(Decree No: AHU-066520.AH.01.30.Year 2025)</span>
        as a premium quality turmeric producer and exporter based in Semarang, Central Java.</span>
      </p>
      <p class="text-slate-500 dark:text-gray-400 leading-[1.85] mb-8 transition-colors">
        <span x-show="lang==='id'">Berlokasi di salah satu daerah penghasil kunyit terbaik di dunia, kami menggabungkan keunggulan
        geografis alam Indonesia dengan keahlian budidaya dan pengolahan turun-temurun untuk memenuhi
        standar ketat pasar ekspor global.</span>
        <span x-show="lang==='en'">Located in one of the world's best turmeric-producing regions, we combine Indonesia's natural
        geographical advantages with generational cultivation and processing expertise to meet
        the strict standards of the global export market.</span>
      </p>

      <div class="grid grid-cols-2 gap-3 mb-8">
        @foreach([
          ['icon'=>'fas fa-certificate','id_label'=>'AHU Terdaftar','en_label'=>'AHU Registered','val'=>'2025'],
          ['icon'=>'fas fa-id-card',    'id_label'=>'NIB',          'en_label'=>'NIB',           'val'=>'0812250009634'],
          ['icon'=>'fas fa-flask',      'id_label'=>'SIG Lab',      'en_label'=>'SIG Lab',       'id_val'=>'Tersertifikasi','en_val'=>'Certified'],
          ['icon'=>'fas fa-globe',      'id_label'=>'Pasar Ekspor', 'en_label'=>'Export Market',  'id_val'=>'7+ Negara','en_val'=>'7+ Countries'],
        ] as $s)
        <div class="flex items-center gap-3 p-3.5 rounded-xl card-lift bg-gold-pale dark:bg-gold/10 transition-colors duration-300"
             style="border:1px solid rgba(201,168,76,.18)">
          <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0"
               style="background:rgba(201,168,76,.15)">
            <i class="{{ $s['icon'] }}" style="color:#c9a84c;font-size:.8rem"></i>
          </div>
          <div>
            <div class="text-[.65rem] uppercase tracking-wide text-slate-400 dark:text-gray-500">
              <span x-show="lang==='id'">{{ $s['id_label'] }}</span>
              <span x-show="lang==='en'">{{ $s['en_label'] }}</span>
            </div>
            <div class="font-semibold text-sm text-ink dark:text-white mt-0.5 transition-colors">
              @if(isset($s['id_val']))
                <span x-show="lang==='id'">{{ $s['id_val'] }}</span>
                <span x-show="lang==='en'">{{ $s['en_val'] }}</span>
              @else
                {{ $s['val'] }}
              @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <a href="{{ route('contact') }}" class="btn-gold font-semibold text-sm px-7 py-3.5 rounded-full inline-flex items-center gap-2">
        <i class="fas fa-envelope text-xs"></i>
        <span x-show="lang==='id'">Hubungi Kami</span>
        <span x-show="lang==='en'">Contact Us</span>
      </a>
    </div>
  </div>
</section>

{{-- ======== TIMELINE ======== --}}
<section class="py-20 bg-cream dark:bg-dark-surface transition-colors duration-300">
  <div class="max-w-4xl mx-auto px-4 sm:px-6">
    <div class="text-center mb-10 reveal">
      <div class="flex items-center justify-center gap-2 text-xs font-bold uppercase tracking-[.18em] mb-3" style="color:#c9a84c">
        <span class="w-4 h-px" style="background:#c9a84c"></span>
        <span x-show="lang==='id'">Perjalanan Kami</span>
        <span x-show="lang==='en'">Our Journey</span>
        <span class="w-4 h-px" style="background:#c9a84c"></span>
      </div>
      <h2 class="font-display text-4xl font-bold text-ink dark:text-white transition-colors">
        <span x-show="lang==='id'">Milestone <em class="not-italic" style="color:#c9a84c">Perusahaan</em></span>
        <span x-show="lang==='en'">Company <em class="not-italic" style="color:#c9a84c">Milestones</em></span>
      </h2>
    </div>

    <div class="space-y-6">
      @foreach([
        ['year'=>'2025 Q1','id_title'=>'Pendirian Perusahaan','en_title'=>'Company Establishment',
         'id_desc'=>'PT. Diyani Rempah Saketi resmi berdiri dengan SK AHU dan NIB lengkap di Semarang, Jawa Tengah.',
         'en_desc'=>'PT. Diyani Rempah Saketi officially established with complete AHU Decree and NIB in Semarang, Central Java.'],
        ['year'=>'2025 Q2','id_title'=>'Sertifikasi SIG Laboratory','en_title'=>'SIG Laboratory Certification',
         'id_desc'=>'Produk mendapatkan Certificate of Analysis dari SIG Laboratory — jaminan kualitas ekspor.',
         'en_desc'=>'Products received Certificate of Analysis from SIG Laboratory — export quality guarantee.'],
        ['year'=>'2025 Q3','id_title'=>'Ekspor Perdana','en_title'=>'First Export',
         'id_desc'=>'Pengiriman perdana ke India & Malaysia. Kualitas curcumin 28.270 mg/kg diterima importir premium.',
         'en_desc'=>'First shipment to India & Malaysia. Curcumin quality of 28,270 mg/kg accepted by premium importers.'],
        ['year'=>'2025 Q4','id_title'=>'Ekspansi 7+ Negara','en_title'=>'Expansion to 7+ Countries',
         'id_desc'=>'Memperluas jaringan ke Amerika, Jerman, China, UAE, dan Jepang. Izin ekspor NIB aktif.',
         'en_desc'=>'Expanded network to America, Germany, China, UAE, and Japan. Active NIB export license.'],
      ] as $i => $t)
      <div class="timeline-item reveal" style="transition-delay:{{ $i * 100 }}ms">
        <div class="timeline-dot">
          <i class="fas fa-check" style="color:#fff;font-size:.42rem"></i>
        </div>
        <div class="flex items-start gap-4 bg-white dark:bg-dark-card rounded-2xl p-5 shadow-sm card-lift transition-colors duration-300"
             style="border:1px solid #f1ece0">
          <div class="text-xs font-bold uppercase tracking-wider px-3 py-1.5 rounded-full flex-shrink-0 mt-0.5"
               style="background:#fdf5e0;color:#c9a84c;white-space:nowrap">{{ $t['year'] }}</div>
          <div>
            <div class="font-semibold text-ink dark:text-white mb-1 transition-colors">
              <span x-show="lang==='id'">{{ $t['id_title'] }}</span>
              <span x-show="lang==='en'">{{ $t['en_title'] }}</span>
            </div>
            <div class="text-sm text-slate-500 dark:text-gray-400 leading-relaxed transition-colors">
              <span x-show="lang==='id'">{{ $t['id_desc'] }}</span>
              <span x-show="lang==='en'">{{ $t['en_desc'] }}</span>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ======== VISI & MISI ======== --}}
<section class="py-20 bg-white dark:bg-dark transition-colors duration-300">
  <div class="max-w-4xl mx-auto px-4 sm:px-6">
    <div class="text-center mb-8 reveal">
      <div class="flex items-center justify-center gap-2 text-xs font-bold uppercase tracking-[.18em] mb-3" style="color:#c9a84c">
        <span class="w-4 h-px" style="background:#c9a84c"></span>
        <span x-show="lang==='id'">Arah Perusahaan</span>
        <span x-show="lang==='en'">Company Direction</span>
        <span class="w-4 h-px" style="background:#c9a84c"></span>
      </div>
      <h2 class="font-display text-4xl font-bold text-ink dark:text-white transition-colors">
        <span x-show="lang==='id'">Visi & <em class="not-italic" style="color:#c9a84c">Misi</em></span>
        <span x-show="lang==='en'">Vision & <em class="not-italic" style="color:#c9a84c">Mission</em></span>
      </h2>
    </div>

    {{-- Tab toggle --}}
    <div class="flex justify-center mb-6 reveal">
      <div class="inline-flex rounded-full p-1" style="background:#f3ede0;border:1px solid rgba(201,168,76,.20)">
        <button onclick="switchVM('visi')" id="tab-visi"
                class="px-8 py-2 rounded-full text-sm font-semibold transition-all"
                style="background:#c9a84c;color:#fff">
          <i class="fas fa-eye mr-1.5"></i>
          <span x-show="lang==='id'">Visi</span><span x-show="lang==='en'">Vision</span>
        </button>
        <button onclick="switchVM('misi')" id="tab-misi"
                class="px-8 py-2 rounded-full text-sm font-semibold transition-all"
                style="background:transparent;color:#c9a84c">
          <i class="fas fa-bullseye mr-1.5"></i>
          <span x-show="lang==='id'">Misi</span><span x-show="lang==='en'">Mission</span>
        </button>
      </div>
    </div>

    {{-- Visi Panel --}}
    <div id="panel-visi" class="vm-panel active reveal">
      <div class="relative rounded-[2rem] overflow-hidden p-10 text-center"
           style="background:linear-gradient(135deg,#1a140a 0%,#2d2010 100%)">
        <div class="absolute top-0 right-0 pointer-events-none"
             style="width:220px;height:220px;border-radius:50%;
                    background:radial-gradient(circle,rgba(201,168,76,.15),transparent 70%);
                    transform:translate(30%,-30%)"></div>
        <div class="absolute bottom-0 left-0 pointer-events-none"
             style="width:160px;height:160px;border-radius:50%;
                    background:radial-gradient(circle,rgba(201,168,76,.10),transparent 70%);
                    transform:translate(-30%,30%)"></div>
        <div class="relative z-10">
          <div class="w-14 h-14 rounded-full mx-auto mb-5 flex items-center justify-content-center"
               style="background:rgba(201,168,76,.15);border:2px solid rgba(201,168,76,.35);
                      display:flex;align-items:center;justify-content:center">
            <i class="fas fa-eye" style="color:#c9a84c;font-size:1.3rem"></i>
          </div>
          <h3 class="font-display text-3xl font-bold text-white mb-4">
            <span x-show="lang==='id'">Visi Kami</span>
            <span x-show="lang==='en'">Our Vision</span>
          </h3>
          <p class="text-base leading-[1.85] max-w-2xl mx-auto" style="color:rgba(255,255,255,.72)">
            <span x-show="lang==='id'">Menjadi <span style="color:#c9a84c;font-weight:600">kekuatan dominan</span> dalam industri ekspor kunyit global
            dengan menghadirkan produk premium yang secara konsisten melampaui standar internasional
            dan menjadi kebanggaan Indonesia di pasar dunia.</span>
            <span x-show="lang==='en'">To become a <span style="color:#c9a84c;font-weight:600">dominant force</span> in the global turmeric export industry
            by delivering premium products that consistently exceed international standards
            and become Indonesia's pride in the world market.</span>
          </p>
          <div class="flex items-center justify-center gap-3 mt-5">
            <span class="w-10 h-px" style="background:rgba(201,168,76,.4)"></span>
            <i class="fas fa-leaf" style="color:#c9a84c;font-size:.65rem"></i>
            <span class="w-10 h-px" style="background:rgba(201,168,76,.4)"></span>
          </div>
        </div>
      </div>
    </div>

    {{-- Misi Panel --}}
    <div id="panel-misi" class="vm-panel reveal">
      <div class="rounded-[2rem] overflow-hidden border border-slate-100 dark:border-dark-border">
        <div class="px-8 py-5 flex items-center gap-4"
             style="background:linear-gradient(135deg,#c9a84c,#a8863c)">
          <div class="w-11 h-11 rounded-xl flex items-center justify-content-center"
               style="background:rgba(255,255,255,.20);display:flex;align-items:center;justify-content:center">
            <i class="fas fa-bullseye text-white text-lg"></i>
          </div>
          <div>
            <h3 class="font-display text-2xl font-bold text-white">
              <span x-show="lang==='id'">Misi Kami</span>
              <span x-show="lang==='en'">Our Mission</span>
            </h3>
            <p class="text-xs" style="color:rgba(255,255,255,.75)">
              <span x-show="lang==='id'">Langkah nyata menuju visi bersama</span>
              <span x-show="lang==='en'">Concrete steps towards our shared vision</span>
            </p>
          </div>
        </div>
        <div class="divide-y bg-white dark:bg-dark-card transition-colors duration-300">
          @foreach([
            ['icon'=>'fas fa-leaf',     'id_title'=>'Produksi Berkualitas',   'en_title'=>'Quality Production',
             'id_desc'=>'Memproduksi kunyit melalui standar kualitas tinggi dan proses ramah lingkungan.',
             'en_desc'=>'Producing turmeric through high quality standards and environmentally friendly processes.'],
            ['icon'=>'fas fa-handshake','id_title'=>'Kemitraan Petani Lokal', 'en_title'=>'Local Farmer Partnership',
             'id_desc'=>'Menjalin kemitraan kuat dengan petani lokal untuk rantai pasokan yang berkelanjutan.',
             'en_desc'=>'Building strong partnerships with local farmers for a sustainable supply chain.'],
            ['icon'=>'fas fa-globe',    'id_title'=>'Ekspansi Global',        'en_title'=>'Global Expansion',
             'id_desc'=>'Memperluas jejak global dengan fokus pada integritas produk dan kepuasan pelanggan.',
             'en_desc'=>'Expanding our global footprint with focus on product integrity and customer satisfaction.'],
            ['icon'=>'fas fa-flask',    'id_title'=>'Inovasi Pengolahan',     'en_title'=>'Processing Innovation',
             'id_desc'=>'Mendorong inovasi pengolahan kunyit sesuai kebutuhan industri global.',
             'en_desc'=>'Driving innovation in turmeric processing to meet global industry needs.'],
          ] as $m)
          <div class="flex items-start gap-4 px-8 py-4 group hover:bg-amber-50 dark:hover:bg-gold/5 transition-colors duration-200 cursor-default"
               style="border-bottom:1px solid #f5efe2">
            <div class="w-10 h-10 rounded-xl flex items-center justify-content-center flex-shrink-0 mt-0.5 group-hover:scale-110 transition-transform"
                 style="background:#fdf5e0;display:flex;align-items:center;justify-content:center">
              <i class="{{ $m['icon'] }}" style="color:#c9a84c;font-size:.78rem"></i>
            </div>
            <div>
              <div class="font-semibold text-ink dark:text-white mb-0.5 transition-colors">
                <span x-show="lang==='id'">{{ $m['id_title'] }}</span>
                <span x-show="lang==='en'">{{ $m['en_title'] }}</span>
              </div>
              <div class="text-sm text-slate-500 dark:text-gray-400 leading-relaxed transition-colors">
                <span x-show="lang==='id'">{{ $m['id_desc'] }}</span>
                <span x-show="lang==='en'">{{ $m['en_desc'] }}</span>
              </div>
            </div>
            <div class="ml-auto self-center opacity-0 group-hover:opacity-100 transition-opacity">
              <i class="fas fa-arrow-right" style="color:#c9a84c;font-size:.65rem"></i>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
function switchVM(tab) {
  ['visi','misi'].forEach(function(t) {
    document.getElementById('panel-'+t).classList.toggle('active', t === tab);
    var btn = document.getElementById('tab-'+t);
    if (t === tab) { btn.style.background='#c9a84c'; btn.style.color='#fff'; }
    else           { btn.style.background='transparent'; btn.style.color='#c9a84c'; }
  });
}

(function() {
  var cv  = document.getElementById('dust-canvas');
  if (!cv) return;
  var ban = document.getElementById('about-banner');
  var cx  = cv.getContext('2d');
  var pts = [];

  function resize() {
    cv.width  = ban.offsetWidth;
    cv.height = ban.offsetHeight;
  }
  resize();
  window.addEventListener('resize', resize);

  for (var i = 0; i < 65; i++) {
    pts.push({
      x:  Math.random(),
      y:  Math.random(),
      r:  Math.random() * 1.8 + .25,
      vx: (Math.random() - .5) * .15,
      vy: -(Math.random() * .22 + .06),
      a:  Math.random() * .40 + .06,
      ph: Math.random() * Math.PI * 2
    });
  }

  (function tick() {
    cx.clearRect(0, 0, cv.width, cv.height);
    var W = cv.width, H = cv.height;
    pts.forEach(function(p) {
      p.x  += p.vx / W;
      p.y  += p.vy / H;
      p.ph += .012;
      if (p.x < 0) p.x = 1; if (p.x > 1) p.x = 0;
      if (p.y < 0) p.y = 1; if (p.y > 1) p.y = 0;
      var alpha = p.a * (.65 + .35 * Math.sin(p.ph));
      cx.beginPath();
      cx.arc(p.x * W, p.y * H, p.r, 0, Math.PI * 2);
      cx.fillStyle = 'rgba(201,168,76,' + alpha.toFixed(3) + ')';
      cx.fill();
    });
    requestAnimationFrame(tick);
  })();
})();
</script>
@endpush

@endsection
