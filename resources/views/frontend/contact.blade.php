{{-- resources/views/frontend/contact.blade.php --}}
@extends('layouts.app')

@push('styles')
<style>
/* -- Contact card glow on hover -- */
.contact-card {
  position: relative;
  overflow: hidden;
  transition: transform .35s cubic-bezier(.16,1,.3,1), box-shadow .35s, border-color .35s;
}
.contact-card::before {
  content: '';
  position: absolute;
  inset: 0;
  opacity: 0;
  border-radius: inherit;
  background: radial-gradient(ellipse at 50% 0%, rgba(201,168,76,.08), transparent 70%);
  transition: opacity .4s;
}
.contact-card:hover::before { opacity: 1; }
.contact-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 20px 50px -15px rgba(201,168,76,.18);
  border-color: rgba(201,168,76,.35);
}

/* -- Form field -- */
.form-field {
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.10);
  color: #fff;
  transition: border-color .25s, box-shadow .25s, background .25s;
}
.form-field:focus {
  outline: none;
  border-color: #c9a84c;
  box-shadow: 0 0 0 3px rgba(201,168,76,.12);
  background: rgba(255,255,255,.06);
}
.dark .form-field-light {
  background: rgba(0,0,0,.25);
  border-color: rgba(255,255,255,.08);
  color: #e5e7eb;
}
.form-field-light {
  background: #fff;
  border: 1px solid #e2e8f0;
  color: #1a1410;
  transition: border-color .25s, box-shadow .25s;
}
.form-field-light:focus {
  outline: none;
  border-color: #c9a84c;
  box-shadow: 0 0 0 3px rgba(201,168,76,.12);
}

/* -- Floating particles -- */
@keyframes floatParticle {
  0%, 100% { transform: translate(0, 0) scale(1); opacity: .3; }
  50%      { transform: translate(12px, -18px) scale(1.15); opacity: .6; }
}
.float-particle {
  position: absolute;
  border-radius: 50%;
  background: rgba(201,168,76,.25);
  pointer-events: none;
  animation: floatParticle ease-in-out infinite;
}

/* -- Map overlay border glow -- */
.map-wrapper {
  position: relative;
}
.map-wrapper::after {
  content: '';
  position: absolute;
  inset: -1px;
  border-radius: 1.25rem;
  pointer-events: none;
  border: 1px solid rgba(201,168,76,.15);
  opacity: 0;
  transition: opacity .4s;
}
.map-wrapper:hover::after { opacity: 1; }

/* -- Hero product image pan/zoom -- */
@keyframes heroPanZoom0 {
  0%   { transform: scale(1.15) translate(0, 0); }
  100% { transform: scale(1.25) translate(-3%, -2%); }
}
@keyframes heroPanZoom1 {
  0%   { transform: scale(1.10) translate(0, 0); }
  100% { transform: scale(1.20) translate(3%, -2%); }
}
@keyframes heroPanZoom2 {
  0%   { transform: scale(1.15) translate(0, 0); }
  100% { transform: scale(1.22) translate(-2%, 3%); }
}
@keyframes heroPanZoom3 {
  0%   { transform: scale(1.10) translate(0, 0); }
  100% { transform: scale(1.18) translate(2%, 2%); }
}
</style>
@endpush

@section('content')

{{-- ══════════ HERO BANNER ══════════ --}}
@php
  $bannerContact = \App\Models\Setting::get('banner_contact');

  // Ambil 4 gambar produk acak dari database
  $heroBgProducts = \App\Models\Product::where('is_active', true)
      ->whereNotNull('image')
      ->inRandomOrder()
      ->limit(4)
      ->get();

  // Fallback jika produk kurang dari 4
  $fallbackImages = [
    'https://images.unsplash.com/photo-1615485500834-bc10199bc727?w=800&q=80',
    'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?w=800&q=80',
    'https://images.unsplash.com/photo-1615485291234-9d694218aeb3?w=800&q=80',
    'https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=800&q=80',
  ];

  $heroImages = [];
  foreach ($heroBgProducts as $p) {
      $heroImages[] = asset('storage/' . $p->image);
  }
  // Fill remaining slots with fallback
  $idx = 0;
  while (count($heroImages) < 4) {
      $heroImages[] = $fallbackImages[$idx % count($fallbackImages)];
      $idx++;
  }
@endphp
<section class="relative overflow-hidden pt-[72px]"
         style="min-height:460px;background:#1a140a">

  {{-- 4 Product images as background collage --}}
  <div class="absolute inset-0 pointer-events-none grid grid-cols-2 grid-rows-2" style="z-index:0">
    @foreach($heroImages as $i => $img)
    <div class="relative overflow-hidden">
      <img src="{{ $img }}" alt=""
           class="w-full h-full object-cover transition-transform duration-[12s] ease-linear"
           style="transform:scale({{ $i % 2 === 0 ? '1.15' : '1.1' }});
                  animation: heroPanZoom{{ $i }} {{ 18 + $i * 4 }}s ease-in-out infinite alternate">
      {{-- Per-image dark overlay --}}
      <div class="absolute inset-0" style="background:rgba(16,12,6,.72)"></div>
    </div>
    @endforeach
  </div>

  {{-- Cross overlay — dark lines between the 4 images --}}
  <div class="absolute inset-y-0 left-1/2 -translate-x-1/2 pointer-events-none" style="width:2px;z-index:1;
       background:linear-gradient(to bottom,transparent,rgba(201,168,76,.18) 30%,rgba(201,168,76,.18) 70%,transparent)"></div>
  <div class="absolute inset-x-0 top-1/2 -translate-y-1/2 pointer-events-none" style="height:2px;z-index:1;
       background:linear-gradient(to right,transparent,rgba(201,168,76,.18) 30%,rgba(201,168,76,.18) 70%,transparent)"></div>

  {{-- Global dark gradient overlay for text readability --}}
  <div class="absolute inset-0 pointer-events-none" style="z-index:1;
       background:linear-gradient(135deg,rgba(10,8,4,.82) 0%,rgba(10,8,4,.55) 50%,rgba(10,8,4,.75) 100%)"></div>

  {{-- Decorative glow --}}
  <div class="absolute pointer-events-none" style="z-index:2;
       left:-8rem;top:20%;width:500px;height:500px;border-radius:50%;
       background:radial-gradient(circle,rgba(201,168,76,.12),transparent 65%);filter:blur(40px)"></div>
  <div class="absolute pointer-events-none" style="z-index:2;
       right:-5rem;bottom:0;width:400px;height:400px;border-radius:50%;
       background:radial-gradient(circle,rgba(201,168,76,.08),transparent 65%);filter:blur(30px)"></div>

  {{-- Floating particles --}}
  <div class="float-particle" style="z-index:3;width:5px;height:5px;left:15%;top:30%;animation-duration:6s"></div>
  <div class="float-particle" style="z-index:3;width:3px;height:3px;left:75%;top:25%;animation-duration:8s;animation-delay:-2s"></div>
  <div class="float-particle" style="z-index:3;width:4px;height:4px;left:55%;top:65%;animation-duration:7s;animation-delay:-4s"></div>
  <div class="float-particle" style="z-index:3;width:3px;height:3px;left:85%;top:55%;animation-duration:9s;animation-delay:-1s"></div>
  <div class="float-particle" style="z-index:3;width:4px;height:4px;left:25%;top:70%;animation-duration:5s;animation-delay:-3s"></div>

  {{-- Subtle grid pattern --}}
  <div class="absolute inset-0 pointer-events-none" style="z-index:2;opacity:.03;
       background-image:linear-gradient(rgba(201,168,76,.5) 1px, transparent 1px),
                         linear-gradient(90deg, rgba(201,168,76,.5) 1px, transparent 1px);
       background-size:60px 60px"></div>

  {{-- Content --}}
  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 py-20 md:py-28" style="z-index:10">
    <div class="max-w-2xl">

      {{-- Breadcrumb --}}
      <div class="flex items-center gap-2 text-xs mb-6" style="color:rgba(255,255,255,.30)">
        <a href="{{ route('home') }}" class="hover:text-gold transition-colors">
          <span x-show="lang==='id'">Beranda</span><span x-show="lang==='en'">Home</span>
        </a>
        <i class="fas fa-chevron-right" style="font-size:.35rem;opacity:.5"></i>
        <span style="color:#c9a84c">
          <span x-show="lang==='id'">Kontak</span><span x-show="lang==='en'">Contact</span>
        </span>
      </div>

      {{-- Label --}}
      <div class="inline-flex items-center gap-2.5 text-xs font-bold uppercase tracking-[.2em] px-4 py-2 rounded-full mb-6"
           style="background:rgba(201,168,76,.10);border:1px solid rgba(201,168,76,.30);color:#c9a84c">
        <span class="w-1.5 h-1.5 rounded-full" style="background:#c9a84c;box-shadow:0 0 6px #c9a84c"></span>
        <span x-show="lang==='id'">Hubungi Kami</span>
        <span x-show="lang==='en'">Get in Touch</span>
      </div>

      {{-- Heading --}}
      <h1 class="font-display font-bold leading-[1.08] mb-5"
          style="font-size:clamp(2.5rem,5.5vw,4.2rem);color:#fff;text-shadow:0 2px 24px rgba(0,0,0,.4)">
        <span x-show="lang==='id'">Mari <em class="not-italic" style="color:#c9a84c">Terhubung</em><br>
        & Bermitra Bersama</span>
        <span x-show="lang==='en'">Let's <em class="not-italic" style="color:#c9a84c">Connect</em><br>
        & Partner Together</span>
      </h1>

      <p class="text-base leading-[1.8] max-w-md mb-8" style="color:rgba(255,255,255,.52)">
        <span x-show="lang==='id'">Kami siap menjawab pertanyaan Anda tentang produk, spesifikasi, harga, dan peluang kerja sama ekspor.</span>
        <span x-show="lang==='en'">We're ready to answer your questions about products, specifications, pricing, and export partnership opportunities.</span>
      </p>

      {{-- Quick stats --}}
      <div class="flex flex-wrap gap-6">
        @foreach([
          ['icon'=>'fas fa-clock','id'=>'Respon < 24 Jam','en'=>'Response < 24 Hours'],
          ['icon'=>'fas fa-globe','id'=>'7+ Negara Dilayani','en'=>'7+ Countries Served'],
          ['icon'=>'fas fa-file-certificate','id'=>'COA Tersedia','en'=>'COA Available'],
        ] as $q)
        <div class="flex items-center gap-2.5">
          <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:rgba(201,168,76,.12);border:1px solid rgba(201,168,76,.22)">
            <i class="{{ $q['icon'] }}" style="color:#c9a84c;font-size:.65rem"></i>
          </div>
          <span class="text-xs font-medium" style="color:rgba(255,255,255,.55)">
            <span x-show="lang==='id'">{{ $q['id'] }}</span>
            <span x-show="lang==='en'">{{ $q['en'] }}</span>
          </span>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  {{-- Bottom gold line --}}
  <div class="absolute bottom-0 inset-x-0 h-px" style="z-index:10;
       background:linear-gradient(to right,transparent,rgba(201,168,76,.45),transparent)"></div>
</section>

{{-- ══════════ CONTACT CARDS ══════════ --}}
<section class="bg-white dark:bg-dark transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 -mt-12 relative z-20">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
      @foreach([
        ['icon'=>'fas fa-location-dot','color'=>'#c9a84c',
         'id_label'=>'Alamat Kantor','en_label'=>'Office Address',
         'val'=>'Tegalsari Barat II/30, Semarang, Jawa Tengah 50251',
         'link'=>null],
        ['icon'=>'fab fa-whatsapp','color'=>'#25d366',
         'id_label'=>'WhatsApp','en_label'=>'WhatsApp',
         'val'=>'+62 821-3828-0770',
         'link'=>'https://wa.me/6282138280770'],
        ['icon'=>'fas fa-phone','color'=>'#3b82f6',
         'id_label'=>'Telepon','en_label'=>'Phone',
         'val'=>'+62 812-9059-7467',
         'link'=>'tel:+6281290597467'],
        ['icon'=>'fas fa-envelope','color'=>'#ef4444',
         'id_label'=>'Email','en_label'=>'Email',
         'val'=>'rempahjowoje25@gmail.com',
         'link'=>'mailto:rempahjowoje25@gmail.com'],
      ] as $i => $c)
      <div class="contact-card bg-white dark:bg-dark-card rounded-2xl p-5 border border-slate-100 dark:border-dark-border shadow-lg shadow-black/5 reveal transition-colors duration-300"
           style="transition-delay:{{ $i * 80 }}ms">
        <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-4"
             style="background:{{ $c['color'] }}12;border:1px solid {{ $c['color'] }}30">
          <i class="{{ $c['icon'] }}" style="color:{{ $c['color'] }};font-size:.85rem"></i>
        </div>
        <div class="text-[.65rem] uppercase tracking-[.14em] font-semibold text-slate-400 dark:text-gray-500 mb-1.5">
          <span x-show="lang==='id'">{{ $c['id_label'] }}</span>
          <span x-show="lang==='en'">{{ $c['en_label'] }}</span>
        </div>
        @if($c['link'])
        <a href="{{ $c['link'] }}" target="{{ str_starts_with($c['link'], 'http') ? '_blank' : '_self' }}"
           class="text-sm font-semibold text-ink dark:text-white hover:text-gold transition-colors break-all leading-snug">
          {{ $c['val'] }}
        </a>
        @else
        <p class="text-sm font-medium text-ink dark:text-gray-200 leading-snug transition-colors">{{ $c['val'] }}</p>
        @endif
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ══════════ MAP + FORM SECTION ══════════ --}}
<section class="py-20 bg-white dark:bg-dark transition-colors duration-300">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">

    <div class="grid lg:grid-cols-5 gap-10 items-start">

      {{-- LEFT — Map + Business Hours --}}
      <div class="lg:col-span-3 space-y-6">

        {{-- Map --}}
        <div class="reveal">
          <div class="flex items-center gap-2 text-gold text-xs font-bold uppercase tracking-[.18em] mb-4">
            <span class="w-4 h-px bg-gold"></span>
            <span x-show="lang==='id'">Lokasi Kami</span>
            <span x-show="lang==='en'">Our Location</span>
          </div>
          <div class="map-wrapper rounded-2xl overflow-hidden shadow-lg">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.395!2d110.4089!3d-6.9932!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sTegalsari+Barat+Semarang!5e0!3m2!1sid!2sid!4v1"
              width="100%" height="340" style="border:0;display:block" allowfullscreen="" loading="lazy"
              class="rounded-2xl"></iframe>
          </div>
        </div>

        {{-- Business Hours --}}
        <div class="reveal" style="transition-delay:.1s">
          <div class="bg-slate-50 dark:bg-dark-card rounded-2xl p-6 border border-slate-100 dark:border-dark-border transition-colors duration-300">
            <div class="flex items-center gap-3 mb-5">
              <div class="w-10 h-10 rounded-xl flex items-center justify-center"
                   style="background:rgba(201,168,76,.12);border:1px solid rgba(201,168,76,.22)">
                <i class="fas fa-clock text-gold text-sm"></i>
              </div>
              <div>
                <h3 class="font-semibold text-ink dark:text-white transition-colors">
                  <span x-show="lang==='id'">Jam Operasional</span>
                  <span x-show="lang==='en'">Business Hours</span>
                </h3>
                <p class="text-xs text-slate-400 dark:text-gray-500">
                  <span x-show="lang==='id'">Waktu Indonesia Barat (WIB)</span>
                  <span x-show="lang==='en'">Western Indonesia Time (WIB)</span>
                </p>
              </div>
            </div>

            <div class="space-y-2">
              @foreach([
                ['id_day'=>'Senin - Jumat','en_day'=>'Monday - Friday','time'=>'08:00 - 17:00','active'=>true],
                ['id_day'=>'Sabtu','en_day'=>'Saturday','time'=>'08:00 - 12:00','active'=>true],
                ['id_day'=>'Minggu & Hari Libur','en_day'=>'Sunday & Holidays','id_time'=>'Tutup','en_time'=>'Closed','active'=>false],
              ] as $h)
              <div class="flex items-center justify-between py-2.5 px-3 rounded-lg {{ $h['active'] ? 'bg-white dark:bg-dark-surface' : 'bg-red-50/50 dark:bg-red-900/10' }} transition-colors duration-300">
                <div class="flex items-center gap-2.5">
                  <span class="w-2 h-2 rounded-full {{ $h['active'] ? 'bg-emerald-400' : 'bg-red-400' }}"></span>
                  <span class="text-sm text-slate-700 dark:text-gray-300 font-medium transition-colors">
                    <span x-show="lang==='id'">{{ $h['id_day'] }}</span>
                    <span x-show="lang==='en'">{{ $h['en_day'] }}</span>
                  </span>
                </div>
                <span class="text-sm font-semibold {{ $h['active'] ? 'text-ink dark:text-white' : 'text-red-500 dark:text-red-400' }} transition-colors">
                  @if(isset($h['id_time']))
                    <span x-show="lang==='id'">{{ $h['id_time'] }}</span>
                    <span x-show="lang==='en'">{{ $h['en_time'] }}</span>
                  @else
                    {{ $h['time'] }}
                  @endif
                </span>
              </div>
              @endforeach
            </div>

            <div class="mt-4 pt-4 border-t border-slate-200 dark:border-dark-border flex items-start gap-2.5">
              <i class="fas fa-info-circle text-gold text-xs mt-0.5"></i>
              <p class="text-xs text-slate-400 dark:text-gray-500 leading-relaxed">
                <span x-show="lang==='id'">WhatsApp tetap bisa dihubungi di luar jam kerja. Respons akan diberikan pada hari kerja berikutnya.</span>
                <span x-show="lang==='en'">WhatsApp is still reachable outside business hours. Responses will be provided on the next business day.</span>
              </p>
            </div>
          </div>
        </div>
      </div>

      {{-- RIGHT — Contact Form --}}
      <div class="lg:col-span-2 reveal" style="transition-delay:.15s">
        <div class="bg-slate-50 dark:bg-dark-card rounded-2xl p-7 border border-slate-100 dark:border-dark-border shadow-sm transition-colors duration-300 sticky top-28">

          <div class="mb-6">
            <h3 class="font-display text-2xl font-bold text-ink dark:text-white transition-colors mb-1.5">
              <span x-show="lang==='id'">Kirim Pesan</span>
              <span x-show="lang==='en'">Send a Message</span>
            </h3>
            <p class="text-xs text-slate-400 dark:text-gray-500">
              <span x-show="lang==='id'">Isi formulir di bawah dan tim kami akan segera menghubungi Anda.</span>
              <span x-show="lang==='en'">Fill out the form below and our team will contact you shortly.</span>
            </p>
          </div>

          <form action="https://wa.me/6282138280770" method="get" target="_blank"
                x-data="{ name: '', company: '', msg: '' }"
                @submit.prevent="
                  let text = `Halo PT. Diyani Rempah Saketi,%0A%0ANama: ${name}%0APerusahaan: ${company}%0A%0A${msg}`;
                  window.open(`https://wa.me/6282138280770?text=${text}`, '_blank');
                ">
            <div class="space-y-4">

              <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-gray-400 mb-1.5">
                  <span x-show="lang==='id'">Nama Lengkap *</span>
                  <span x-show="lang==='en'">Full Name *</span>
                </label>
                <input type="text" x-model="name" required
                       class="form-field-light dark:form-field-light w-full rounded-xl px-4 py-3 text-sm"
                       :placeholder="lang==='id' ? 'Nama Anda' : 'Your Name'">
              </div>

              <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-gray-400 mb-1.5">
                  <span x-show="lang==='id'">Perusahaan</span>
                  <span x-show="lang==='en'">Company</span>
                </label>
                <input type="text" x-model="company"
                       class="form-field-light dark:form-field-light w-full rounded-xl px-4 py-3 text-sm"
                       :placeholder="lang==='id' ? 'Nama Perusahaan' : 'Company Name'">
              </div>

              <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-gray-400 mb-1.5">
                  <span x-show="lang==='id'">Pesan *</span>
                  <span x-show="lang==='en'">Message *</span>
                </label>
                <textarea x-model="msg" rows="4" required
                          class="form-field-light dark:form-field-light w-full rounded-xl px-4 py-3 text-sm resize-none"
                          :placeholder="lang==='id' ? 'Tulis pesan atau pertanyaan Anda...' : 'Write your message or question...'"></textarea>
              </div>

              <button type="submit"
                      class="w-full py-3.5 rounded-xl text-white text-sm font-bold uppercase tracking-wider
                             inline-flex items-center justify-center gap-2.5
                             transition-all hover:-translate-y-0.5"
                      style="background:linear-gradient(135deg,#c9a84c,#9e7c2a);box-shadow:0 4px 20px rgba(201,168,76,.25)">
                <i class="fab fa-whatsapp text-base"></i>
                <span x-show="lang==='id'">Kirim via WhatsApp</span>
                <span x-show="lang==='en'">Send via WhatsApp</span>
              </button>
            </div>
          </form>

          <div class="mt-5 pt-5 border-t border-slate-200 dark:border-dark-border">
            <p class="text-xs text-slate-400 dark:text-gray-500 text-center flex items-center justify-center gap-1.5">
              <i class="fas fa-shield-halved text-gold"></i>
              <span x-show="lang==='id'">Pesan dikirim langsung ke WhatsApp kami. Data Anda aman.</span>
              <span x-show="lang==='en'">Message sent directly to our WhatsApp. Your data is safe.</span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ══════════ CTA — WHY PARTNER ══════════ --}}
<section class="py-20 transition-colors duration-300" style="background:linear-gradient(135deg,#1a140a,#2a1f12)">
  <div class="max-w-5xl mx-auto px-4 sm:px-6">

    <div class="text-center mb-14 reveal">
      <div class="flex items-center justify-center gap-2 text-gold text-xs font-bold uppercase tracking-[.18em] mb-3">
        <span class="w-4 h-px bg-gold"></span>
        <span x-show="lang==='id'">Mengapa Bermitra</span>
        <span x-show="lang==='en'">Why Partner With Us</span>
        <span class="w-4 h-px bg-gold"></span>
      </div>
      <h2 class="font-display text-3xl md:text-4xl font-bold text-white mb-3">
        <span x-show="lang==='id'">Keuntungan <em class="not-italic text-gold">Bermitra</em> Bersama Kami</span>
        <span x-show="lang==='en'">Benefits of <em class="not-italic text-gold">Partnering</em> With Us</span>
      </h2>
      <p class="text-sm max-w-lg mx-auto" style="color:rgba(255,255,255,.42)">
        <span x-show="lang==='id'">Kami memastikan setiap mitra mendapatkan layanan dan produk terbaik.</span>
        <span x-show="lang==='en'">We ensure every partner receives the best service and products.</span>
      </p>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
      @foreach([
        ['icon'=>'fas fa-file-certificate',
         'id_title'=>'Dokumen Ekspor Lengkap','en_title'=>'Complete Export Documents',
         'id_desc'=>'NIB, AHU, COA, dan semua dokumen yang dibutuhkan untuk bea cukai internasional.',
         'en_desc'=>'NIB, AHU, COA, and all documents needed for international customs.'],
        ['icon'=>'fas fa-flask',
         'id_title'=>'Uji Lab Setiap Batch','en_title'=>'Lab Tested Every Batch',
         'id_desc'=>'Certificate of Analysis dari SIG Laboratory untuk setiap pengiriman.',
         'en_desc'=>'Certificate of Analysis from SIG Laboratory for every shipment.'],
        ['icon'=>'fas fa-tags',
         'id_title'=>'Harga Kompetitif','en_title'=>'Competitive Pricing',
         'id_desc'=>'Langsung dari produsen — tanpa perantara, harga terbaik untuk kualitas premium.',
         'en_desc'=>'Direct from producer — no middlemen, best prices for premium quality.'],
        ['icon'=>'fas fa-truck-fast',
         'id_title'=>'Pengiriman Tepat Waktu','en_title'=>'On-Time Delivery',
         'id_desc'=>'Jaringan logistik terkelola untuk memastikan pengiriman sesuai jadwal.',
         'en_desc'=>'Managed logistics network to ensure delivery on schedule.'],
        ['icon'=>'fas fa-headset',
         'id_title'=>'Dukungan Dedikasi','en_title'=>'Dedicated Support',
         'id_desc'=>'Tim khusus siap melayani kebutuhan Anda dari inquiry hingga after-sales.',
         'en_desc'=>'Dedicated team ready to serve your needs from inquiry to after-sales.'],
        ['icon'=>'fas fa-handshake',
         'id_title'=>'Kemitraan Jangka Panjang','en_title'=>'Long-Term Partnership',
         'id_desc'=>'Kami membangun hubungan bisnis yang berkelanjutan, bukan transaksi satu kali.',
         'en_desc'=>'We build sustainable business relationships, not one-time transactions.'],
      ] as $i => $b)
      <div class="group rounded-2xl p-5 reveal transition-all duration-300 cursor-default hover:-translate-y-1"
           style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);transition-delay:{{ $i * 60 }}ms"
           onmouseover="this.style.background='rgba(201,168,76,.06)';this.style.borderColor='rgba(201,168,76,.20)'"
           onmouseout="this.style.background='rgba(255,255,255,.03)';this.style.borderColor='rgba(255,255,255,.06)'">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3"
             style="background:rgba(201,168,76,.10);border:1px solid rgba(201,168,76,.22)">
          <i class="{{ $b['icon'] }} text-gold text-sm"></i>
        </div>
        <h4 class="font-semibold text-white text-sm mb-1.5">
          <span x-show="lang==='id'">{{ $b['id_title'] }}</span>
          <span x-show="lang==='en'">{{ $b['en_title'] }}</span>
        </h4>
        <p class="text-xs leading-relaxed" style="color:rgba(255,255,255,.40)">
          <span x-show="lang==='id'">{{ $b['id_desc'] }}</span>
          <span x-show="lang==='en'">{{ $b['en_desc'] }}</span>
        </p>
      </div>
      @endforeach
    </div>

    {{-- Bottom CTA --}}
    <div class="text-center mt-14 reveal">
      <div class="inline-flex flex-col sm:flex-row items-center gap-4">
        @php $wa = \App\Models\Setting::get('wa_number', '6282138280770'); @endphp
        <a href="https://wa.me/{{ $wa }}" target="_blank"
           class="btn-gold font-semibold text-sm px-8 py-4 rounded-full inline-flex items-center gap-2.5">
          <i class="fab fa-whatsapp text-lg"></i>
          <span x-show="lang==='id'">Mulai Konsultasi Gratis</span>
          <span x-show="lang==='en'">Start Free Consultation</span>
        </a>
        <a href="{{ route('products') }}"
           class="inline-flex items-center gap-2 text-sm font-medium transition-colors"
           style="color:rgba(255,255,255,.45)"
           onmouseover="this.style.color='#c9a84c'" onmouseout="this.style.color='rgba(255,255,255,.45)'">
          <span x-show="lang==='id'">Lihat Produk Kami</span>
          <span x-show="lang==='en'">View Our Products</span>
          <i class="fas fa-arrow-right text-xs"></i>
        </a>
      </div>
    </div>
  </div>
</section>

@endsection
