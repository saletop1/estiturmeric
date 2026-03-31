<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title','Dashboard') — Admin Diyani</title>
<script src="https://cdn.tailwindcss.com"></script>
<script>tailwind.config={theme:{extend:{colors:{gold:{DEFAULT:'#c9a84c',light:'#e8c97a',dark:'#9e7c2a',pale:'#fdf6e3'},ink:{DEFAULT:'#1a1410',soft:'#3d3020'}}}}}</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
body{font-family:system-ui,sans-serif;}
.sidebar-link{display:flex;align-items:center;gap:.75rem;padding:.625rem 1rem;border-radius:.625rem;font-size:.82rem;font-weight:500;color:rgba(255,255,255,.6);transition:all .2s;}
.sidebar-link:hover,.sidebar-link.active{background:rgba(201,168,76,.15);color:#e8c97a;}
.sidebar-link i{width:1.1rem;text-align:center;font-size:.875rem;}
</style>
@stack('styles')
</head>
<body class="bg-slate-100 text-slate-800 flex min-h-screen">

{{-- SIDEBAR --}}
<aside class="w-60 bg-ink min-h-screen flex flex-col fixed left-0 top-0 z-30 shadow-2xl">
  <div class="p-5 border-b border-white/10">
    <div class="font-bold text-white text-base leading-tight">
      Diyani <span class="text-gold">Admin</span>
    </div>
    <div class="text-xs text-white/30 mt-0.5">Panel Manajemen</div>
  </div>

  <nav class="flex-1 p-3 space-y-0.5">
    @php
    $links = [
      ['route'=>'admin.dashboard',           'icon'=>'fas fa-gauge-high',      'label'=>'Dashboard'],
      ['route'=>'admin.products.index',      'icon'=>'fas fa-boxes-stacked',   'label'=>'Produk'],
      ['route'=>'admin.testimonials.index',  'icon'=>'fas fa-star',            'label'=>'Testimoni'],
      ['route'=>'admin.stats',               'icon'=>'fas fa-chart-line',      'label'=>'Statistik'],
      ['route'=>'admin.settings.index',      'icon'=>'fas fa-gear',            'label'=>'Pengaturan & SEO'],
    ];
    @endphp
    @foreach($links as $l)
    <a href="{{ route($l['route']) }}"
       class="sidebar-link {{ request()->routeIs($l['route']) ? 'active' : '' }}">
      <i class="{{ $l['icon'] }}"></i> {{ $l['label'] }}
      @if($l['route']==='admin.testimonials.index')
        @php $pending = \App\Models\Testimonial::pending()->count(); @endphp
        @if($pending > 0)
        <span class="ml-auto text-[.6rem] bg-red-500 text-white rounded-full px-1.5 py-0.5 leading-none">{{ $pending }}</span>
        @endif
      @endif
    </a>
    @endforeach
  </nav>

  <div class="p-3 border-t border-white/10 space-y-0.5">
    <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
      <i class="fas fa-globe"></i> Lihat Website
    </a>
    <form action="{{ route('admin.logout') }}" method="POST">
      @csrf
      <button type="submit" class="sidebar-link w-full text-left hover:text-red-400">
        <i class="fas fa-right-from-bracket"></i> Keluar
      </button>
    </form>
  </div>
</aside>

{{-- MAIN --}}
<main class="ml-60 flex-1 flex flex-col min-h-screen">

  {{-- Top bar --}}
  <div class="bg-white border-b border-slate-200 px-6 py-3 flex items-center justify-between sticky top-0 z-20">
    <h1 class="font-semibold text-slate-700 text-sm">@yield('title','Dashboard')</h1>
    <div class="flex items-center gap-3 text-xs text-slate-500">
      <i class="fas fa-user-shield text-gold"></i>
      {{ Auth::user()->name }}
    </div>
  </div>

  <div class="p-6 flex-1">

    {{-- Flash messages --}}
    @if(session('success'))
    <div class="mb-5 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
      <i class="fas fa-circle-check flex-shrink-0"></i> {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="mb-5 flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
      <i class="fas fa-circle-xmark flex-shrink-0"></i> {{ session('error') }}
    </div>
    @endif

    @yield('content')
  </div>
</main>

@stack('scripts')
</body>
</html>
