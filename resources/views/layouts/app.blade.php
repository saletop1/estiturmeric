<!DOCTYPE html>
<html lang="id" class="scroll-smooth" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true', lang: localStorage.getItem('lang') || 'id' }"
      x-init="$watch('darkMode', v => { localStorage.setItem('darkMode', v); document.documentElement.classList.toggle('dark', v) });
              $watch('lang', v => localStorage.setItem('lang', v));
              if(darkMode) document.documentElement.classList.add('dark')"
      :class="{ 'dark': darkMode }">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- SEO --}}
<title>{{ $seo['meta_title'] ?? config('app.name', 'PT. Diyani Rempah Saketi') }}</title>
<meta name="description" content="{{ $seo['meta_desc'] ?? '' }}">
<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ url()->current() }}">

{{-- Open Graph --}}
<meta property="og:type"        content="website">
<meta property="og:title"       content="{{ $seo['meta_title'] ?? '' }}">
<meta property="og:description" content="{{ $seo['meta_desc'] ?? '' }}">
<meta property="og:url"         content="{{ url()->current() }}">
<meta property="og:image"       content="{{ $seo['og_image'] ?? asset('images/og-default.jpg') }}">
<meta property="og:site_name"   content="{{ $seo['site_name'] ?? 'PT. Diyani Rempah Saketi' }}">

{{-- Fonts --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

{{-- Tailwind CDN --}}
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        gold:  { DEFAULT:'#c9a84c', light:'#e8c97a', dark:'#9e7c2a', pale:'#fdf8ee' },
        ink:   { DEFAULT:'#1a1410' },
        cream: '#faf7f2',
        dark:  { DEFAULT:'#121212', card:'#1e1e1e', surface:'#181818', border:'#2a2a2a' },
      },
      fontFamily: {
        display: ['"Playfair Display"','Georgia','serif'],
        body:    ['"Plus Jakarta Sans"','system-ui','sans-serif'],
      },
    }
  }
}
</script>

{{-- Icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
/* -- BASE -- */
*, *::before, *::after { box-sizing: border-box; }
body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; -webkit-font-smoothing: antialiased; }
.font-display { font-family: 'Playfair Display', Georgia, serif; }

/* -- SCROLL REVEAL -- */
.reveal {
  opacity: 0;
  transform: translateY(28px);
  transition: opacity .75s cubic-bezier(.16,1,.3,1), transform .75s cubic-bezier(.16,1,.3,1);
}
.reveal.visible { opacity: 1; transform: translateY(0); }

/* -- NAVBAR — FROSTED GLASS -- */
#navbar {
  background: rgba(20,14,10,.30);
  backdrop-filter: blur(24px) saturate(160%);
  -webkit-backdrop-filter: blur(24px) saturate(160%);
  border-bottom: 1px solid rgba(255,255,255,.08);
  transition: all .4s cubic-bezier(.16,1,.3,1);
}
#navbar.scrolled {
  background: rgba(20,14,10,.85);
  backdrop-filter: blur(28px) saturate(200%);
  -webkit-backdrop-filter: blur(28px) saturate(200%);
  border-bottom-color: rgba(201,168,76,.2);
  box-shadow: 0 2px 32px rgba(0,0,0,.45);
  padding-top: .65rem;
  padding-bottom: .65rem;
}
.nav-link { color: rgba(255,255,255,.82); letter-spacing: .1em; transition: color .2s; }
.nav-link:hover  { color: #fff; }
.nav-link.active { color: #c9a84c; }

/* -- BUTTONS -- */
.btn-gold {
  display: inline-flex; align-items: center; gap: .55rem;
  background: linear-gradient(135deg,#c9a84c,#9e7c2a);
  color: #fff;
  transition: opacity .2s, transform .2s, box-shadow .2s;
}
.btn-gold:hover { opacity: .92; transform: translateY(-2px); box-shadow: 0 12px 28px -8px rgba(201,168,76,.5); }

.btn-cta-primary {
  display: inline-flex; align-items: center; gap: .55rem;
  background: #fff; color: #9e7c2a;
  font-weight: 700; padding: .875rem 2rem; border-radius: 999px;
  border: 2px solid #fff; box-shadow: 0 4px 20px rgba(0,0,0,.15);
  transition: all .25s cubic-bezier(.16,1,.3,1);
}
.btn-cta-primary:hover { background: transparent; color: #fff; transform: translateY(-2px); box-shadow: 0 10px 28px rgba(0,0,0,.25); }
.btn-cta-secondary {
  display: inline-flex; align-items: center; gap: .55rem;
  background: rgba(255,255,255,.12); color: #fff;
  font-weight: 600; padding: .875rem 2rem; border-radius: 999px;
  border: 2px solid rgba(255,255,255,.45); backdrop-filter: blur(8px);
  transition: all .25s cubic-bezier(.16,1,.3,1);
}
.btn-cta-secondary:hover { background: rgba(255,255,255,.22); border-color: rgba(255,255,255,.75); transform: translateY(-2px); }

/* -- MARQUEE -- */
@keyframes marquee { from{transform:translateX(0)} to{transform:translateX(-50%)} }
.marquee-track { animation: marquee 24s linear infinite; display: inline-flex; white-space: nowrap; }

/* -- FLOAT -- */
@keyframes floatY { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
.float-anim { animation: floatY 5s ease-in-out infinite; }

/* -- CARD HOVER -- */
.card-hover { transition: transform .3s cubic-bezier(.16,1,.3,1), box-shadow .3s; }
.card-hover:hover { transform: translateY(-6px); box-shadow: 0 24px 48px -12px rgba(26,20,16,.14); }

/* -- DARK MODE TRANSITIONS -- */
.dark body, .dark .bg-white, .dark .bg-cream, .dark footer { transition: background-color .3s ease, color .3s ease; }
</style>
@stack('styles')

{{-- Google Analytics --}}
@php $ga = \App\Models\Setting::get('ga_id'); @endphp
@if($ga)
<script async src="https://www.googletagmanager.com/gtag/js?id="{{ $ga }}"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','{{ $ga }}');</script>
@endif

{{-- Alpine.js - load early for x-cloak --}}
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style>[x-cloak] { display: none !important; }</style>
</head>

<body class="bg-white dark:bg-dark text-ink dark:text-gray-200 antialiased transition-colors duration-300">

{{-- ====== NAVBAR ====== --}}
<nav id="navbar" class="fixed top-0 inset-x-0 z-50 py-4">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 flex items-center justify-between">

    {{-- Logo --}}
    <a href="{{ route('home') }}" class="flex items-center gap-2.5 flex-shrink-0">
      @php $logo = \App\Models\Setting::get('logo'); @endphp
      @if($logo)
        <img src="{{ asset('storage/'.$logo) }}" alt="Logo" class="h-10 w-auto">
      @else
        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-gold to-gold-dark flex items-center justify-center flex-shrink-0">
          <i class="fas fa-seedling text-white text-sm"></i>
        </div>
        <span class="font-display text-white text-lg font-bold leading-none">
          Diyani<span class="text-gold">.</span>
        </span>
      @endif
    </a>

    {{-- Desktop Links --}}
    <ul class="hidden md:flex items-center gap-7 list-none m-0 p-0">
      @foreach([
        ['route'=>'home',              'id'=>'Beranda',       'en'=>'Home'],
        ['route'=>'about',             'id'=>'Tentang',       'en'=>'About'],
        ['route'=>'products',          'id'=>'Produk',        'en'=>'Products'],
        ['route'=>'advantages',        'id'=>'Keunggulan',    'en'=>'Advantages'],
        ['route'=>'testimonials.index','id'=>'Testimoni',     'en'=>'Testimonials'],
        ['route'=>'contact',           'id'=>'Kontak',        'en'=>'Contact'],
      ] as $link)
      <li>
        <a href="{{ route($link['route']) }}"
           class="nav-link text-xs font-semibold uppercase tracking-widest {{ request()->routeIs($link['route']) ? 'active' : '' }}">
          <span x-show="lang==='id'" x-cloak>{{ $link['id'] }}</span>
          <span x-show="lang==='en'" x-cloak>{{ $link['en'] }}</span>
        </a>
      </li>
      @endforeach
    </ul>

    {{-- Right: Toggles + Hamburger --}}
    <div class="flex items-center gap-2">

      {{-- Language Toggle --}}
      <button @click="lang = lang === 'id' ? 'en' : 'id'"
              class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider
                     bg-white/10 hover:bg-white/20 text-white/80 hover:text-white border border-white/15 hover:border-white/30
                     backdrop-blur-sm transition-all duration-200"
              :title="lang === 'id' ? 'Switch to English' : 'Ganti ke Indonesia'">
        <i class="fas fa-globe text-gold text-[.6rem]"></i>
        <span x-text="lang === 'id' ? 'EN' : 'ID'"></span>
      </button>

      {{-- Dark Mode Toggle --}}
      <button @click="darkMode = !darkMode"
              class="w-9 h-9 rounded-full flex items-center justify-center
                     bg-white/10 hover:bg-white/20 text-white/80 hover:text-white border border-white/15 hover:border-white/30
                     backdrop-blur-sm transition-all duration-200"
              :title="darkMode ? 'Light Mode' : 'Dark Mode'">
        <i x-show="!darkMode" class="fas fa-moon text-sm text-gold" x-cloak></i>
        <i x-show="darkMode" class="fas fa-sun text-sm text-gold" x-cloak></i>
      </button>

      {{-- Hamburger (mobile) --}}
      <button id="hamburger" class="md:hidden text-white/80 hover:text-white transition-colors ml-1" aria-label="Menu">
        <i class="fas fa-bars text-xl"></i>
      </button>
    </div>
  </div>

  {{-- Mobile Menu --}}
  <div id="mobile-menu" class="hidden md:hidden bg-ink/95 backdrop-blur-lg border-t border-white/10 mt-3">
    <div class="px-4 py-4 flex flex-col gap-1">
      @foreach([
        ['route'=>'home',              'id'=>'Beranda',       'en'=>'Home'],
        ['route'=>'about',             'id'=>'Tentang Kami',  'en'=>'About Us'],
        ['route'=>'products',          'id'=>'Produk',        'en'=>'Products'],
        ['route'=>'advantages',        'id'=>'Keunggulan',    'en'=>'Advantages'],
        ['route'=>'testimonials.index','id'=>'Testimoni',     'en'=>'Testimonials'],
        ['route'=>'contact',           'id'=>'Hubungi Kami',  'en'=>'Contact Us'],
      ] as $link)
      <a href="{{ route($link['route']) }}"
         class="text-sm py-2.5 px-2 border-b border-white/8 transition-colors
                {{ request()->routeIs($link['route']) ? 'text-gold font-medium' : 'text-white/70 hover:text-gold' }}">
        <span x-show="lang==='id'">{{ $link['id'] }}</span>
        <span x-show="lang==='en'">{{ $link['en'] }}</span>
      </a>
      @endforeach
    </div>
  </div>
</nav>

{{-- ====== CONTENT ====== --}}
@yield('content')

{{-- ====== FOOTER ====== --}}
<footer class="bg-ink dark:bg-dark-surface text-white/45 transition-colors duration-300">
  <div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10 pt-16 pb-10 border-b border-white/8">

      {{-- Brand --}}
      <div class="sm:col-span-2">
        <div class="font-display text-xl font-bold text-white mb-3">
          PT. Diyani Rempah <span class="text-gold">Saketi</span>
        </div>
        <p class="text-sm leading-[1.8] max-w-xs mb-5">
          <span x-show="lang==='id'">{{ \App\Models\Setting::get('footer_text', 'Produsen dan eksportir kunyit premium dari Semarang, Jawa Tengah, Indonesia.') }}</span>
          <span x-show="lang==='en'">Premium turmeric producer and exporter from Semarang, Central Java, Indonesia.</span>
        </p>
        <div class="flex gap-2.5">
          @foreach([
            ['key'=>'wa_number', 'icon'=>'fab fa-whatsapp',   'pre'=>'https://wa.me/'],
            ['key'=>'instagram', 'icon'=>'fab fa-instagram',  'pre'=>'https://instagram.com/'],
            ['key'=>'facebook',  'icon'=>'fab fa-facebook-f', 'pre'=>'https://facebook.com/'],
            ['key'=>'linkedin',  'icon'=>'fab fa-linkedin-in','pre'=>'https://linkedin.com/company/'],
          ] as $s)
          @php $sv = \App\Models\Setting::get($s['key']); @endphp
          @if($sv)
          <a href="{{ $s['pre'].$sv }}" target="_blank" rel="noopener"
             class="w-9 h-9 rounded-full bg-white/6 border border-white/10 flex items-center justify-center text-sm
                    hover:bg-gold hover:text-white hover:border-gold transition-all">
            <i class="{{ $s['icon'] }}"></i>
          </a>
          @endif
          @endforeach
        </div>
      </div>

      {{-- Nav links --}}
      <div>
        <div class="text-xs uppercase tracking-[.14em] text-white font-semibold mb-4">
          <span x-show="lang==='id'">Halaman</span>
          <span x-show="lang==='en'">Pages</span>
        </div>
        <ul class="space-y-2 list-none p-0 m-0">
          @foreach([
            ['route'=>'home',              'id'=>'Beranda',       'en'=>'Home'],
            ['route'=>'about',             'id'=>'Tentang Kami',  'en'=>'About Us'],
            ['route'=>'products',          'id'=>'Produk',        'en'=>'Products'],
            ['route'=>'advantages',        'id'=>'Keunggulan',    'en'=>'Advantages'],
            ['route'=>'testimonials.index','id'=>'Testimoni',     'en'=>'Testimonials'],
            ['route'=>'contact',           'id'=>'Kontak',        'en'=>'Contact'],
          ] as $l)
          <li>
            <a href="{{ route($l['route']) }}"
               class="flex items-center gap-2 text-sm transition-colors group
                      {{ request()->routeIs($l['route']) ? 'text-gold font-medium' : 'text-white/42 hover:text-white' }}">
              <span class="w-3 h-px flex-shrink-0 transition-colors
                           {{ request()->routeIs($l['route']) ? 'bg-gold' : 'bg-transparent group-hover:bg-white/30' }}"></span>
              <span x-show="lang==='id'">{{ $l['id'] }}</span>
              <span x-show="lang==='en'">{{ $l['en'] }}</span>
            </a>
          </li>
          @endforeach
        </ul>
      </div>

      {{-- Contact --}}
      <div>
        <div class="text-xs uppercase tracking-[.14em] text-white font-semibold mb-4">
          <span x-show="lang==='id'">Kontak</span>
          <span x-show="lang==='en'">Contact</span>
        </div>
        <div class="space-y-3 text-sm">
          <div class="flex gap-2.5">
            <i class="fas fa-location-dot text-gold text-xs mt-0.5 flex-shrink-0"></i>
            <span>{{ \App\Models\Setting::get('site_address', 'Tegalsari Barat II/30, Kota Semarang, Jawa Tengah 50251') }}</span>
          </div>
          <div class="flex gap-2.5">
            <i class="fab fa-whatsapp text-gold text-xs mt-0.5 flex-shrink-0"></i>
            <span>{{ \App\Models\Setting::get('site_phone', '+62 821-3828-0770') }}</span>
          </div>
          <div class="flex gap-2.5">
            <i class="fas fa-envelope text-gold text-xs mt-0.5 flex-shrink-0"></i>
            <span>{{ \App\Models\Setting::get('site_email', 'rempahjowoje25@gmail.com') }}</span>
          </div>
        </div>
      </div>
    </div>

    {{-- Bottom bar --}}
    <div class="py-5 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
      <span>
        <span x-show="lang==='id'">&copy; {{ date('Y') }} PT. Diyani Rempah Saketi. Seluruh hak dilindungi.</span>
        <span x-show="lang==='en'">&copy; {{ date('Y') }} PT. Diyani Rempah Saketi. All rights reserved.</span>
      </span>
      <a href="/admin"
         class="inline-flex items-center gap-1.5 text-white/28 hover:text-gold border border-white/9
                hover:border-gold/30 px-3 py-1.5 rounded-full transition-all">
        <i class="fas fa-lock text-[.55rem]"></i> Admin Panel
      </a>
    </div>
  </div>
</footer>

{{-- Admin Float Button --}}
<a href="/admin" id="afb"
   class="fixed bottom-6 right-6 z-50 w-11 h-11 rounded-full bg-ink/75 hover:bg-gold
          border border-white/10 hover:border-gold flex items-center justify-center
          text-white/38 hover:text-white backdrop-blur-sm shadow-lg transition-all duration-200 group">
  <i class="fas fa-lock text-xs group-hover:scale-110 transition-transform"></i>
  <span class="absolute right-full mr-2.5 whitespace-nowrap text-xs bg-ink text-white/70
               px-2.5 py-1 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity
               pointer-events-none border border-white/10">Admin Login</span>
</a>

<script>
// Navbar scroll effect
const nb = document.getElementById('navbar');
window.addEventListener('scroll', () => nb.classList.toggle('scrolled', scrollY > 60));

// Hamburger
document.getElementById('hamburger')?.addEventListener('click', () =>
  document.getElementById('mobile-menu').classList.toggle('hidden')
);

// Scroll reveal
const obs = new IntersectionObserver(
  entries => entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); } }),
  { threshold: 0.1, rootMargin: '0px 0px -40px 0px' }
);
document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
</script>
@stack('scripts')
</body>
</html>
