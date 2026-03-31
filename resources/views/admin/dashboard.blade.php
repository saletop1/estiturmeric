{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')
@section('title','Dashboard')
@section('content')
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
  @foreach([
    ['label'=>'Total Produk',    'val'=>$totalProducts,    'icon'=>'fas fa-boxes-stacked','color'=>'bg-blue-50 text-blue-600'],
    ['label'=>'Produk Aktif',    'val'=>$activeProducts,   'icon'=>'fas fa-check-circle', 'color'=>'bg-green-50 text-green-600'],
    ['label'=>'Menunggu Approve','val'=>$pendingTestimonials,'icon'=>'fas fa-clock',       'color'=>'bg-amber-50 text-amber-600'],
    ['label'=>'Kunjungan Hari Ini','val'=>$visitsToday,    'icon'=>'fas fa-eye',          'color'=>'bg-purple-50 text-purple-600'],
  ] as $s)
  <div class="bg-white rounded-2xl border border-slate-200 p-5 flex items-center gap-4">
    <div class="w-11 h-11 rounded-xl {{ $s['color'] }} flex items-center justify-center flex-shrink-0 text-base">
      <i class="{{ $s['icon'] }}"></i>
    </div>
    <div>
      <div class="text-2xl font-bold text-slate-800">{{ $s['val'] }}</div>
      <div class="text-xs text-slate-400 mt-0.5">{{ $s['label'] }}</div>
    </div>
  </div>
  @endforeach
</div>

{{-- Pending testimonials --}}
@if($recentTestimonials->count())
<div class="bg-white rounded-2xl border border-slate-200 p-6">
  <div class="flex items-center justify-between mb-5">
    <h2 class="font-semibold text-slate-700">Testimoni Menunggu Persetujuan</h2>
    <a href="{{ route('admin.testimonials.index') }}" class="text-xs text-gold hover:underline">Lihat semua</a>
  </div>
  <div class="space-y-3">
    @foreach($recentTestimonials as $t)
    <div class="flex items-start gap-4 p-4 bg-amber-50 border border-amber-200 rounded-xl">
      <div class="w-9 h-9 rounded-full bg-gradient-to-br from-gold to-gold-dark flex items-center justify-center text-white font-bold text-sm flex-shrink-0">{{ strtoupper(substr($t->name,0,1)) }}</div>
      <div class="flex-1 min-w-0">
        <div class="font-medium text-sm text-slate-700">{{ $t->name }} @if($t->company)<span class="text-slate-400 font-normal">— {{ $t->company }}</span>@endif</div>
        <div class="text-xs text-slate-500 mt-0.5 truncate">"{{ $t->comment }}"</div>
        <div class="flex gap-0.5 mt-1">@for($s=1;$s<=5;$s++)<i class="fas fa-star {{ $s<=$t->rating?'text-gold':'text-slate-300' }} text-[.6rem]"></i>@endfor</div>
      </div>
      <div class="flex gap-2 flex-shrink-0">
        <form action="{{ route('admin.testimonials.approve',$t) }}" method="POST">@csrf
          <button class="text-xs bg-green-100 hover:bg-green-200 text-green-700 px-3 py-1.5 rounded-lg transition-colors"><i class="fas fa-check mr-1"></i>Setujui</button>
        </form>
        <form action="{{ route('admin.testimonials.destroy',$t) }}" method="POST">@csrf @method('DELETE')
          <button class="text-xs bg-red-100 hover:bg-red-200 text-red-600 px-3 py-1.5 rounded-lg transition-colors"><i class="fas fa-trash"></i></button>
        </form>
      </div>
    </div>
    @endforeach
  </div>
</div>
@else
<div class="bg-white rounded-2xl border border-slate-200 p-10 text-center">
  <i class="fas fa-check-double text-3xl text-green-400 mb-3 block"></i>
  <p class="text-slate-500 text-sm">Tidak ada testimoni yang menunggu persetujuan.</p>
</div>
@endif
@endsection
