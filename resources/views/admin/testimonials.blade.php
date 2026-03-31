{{-- resources/views/admin/testimonials.blade.php --}}
@extends('layouts.admin')
@section('title','Kelola Testimoni')
@section('content')

@if($pending->count())
<div class="bg-amber-50 border border-amber-200 rounded-2xl p-5 mb-6">
  <h3 class="font-semibold text-amber-800 mb-4 flex items-center gap-2"><i class="fas fa-clock"></i> Menunggu Persetujuan ({{ $pending->count() }})</h3>
  <div class="space-y-3">
    @foreach($pending as $t)
    <div class="flex gap-4 bg-white rounded-xl p-4 border border-amber-200">
      <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gold to-gold-dark flex items-center justify-center text-white font-bold text-sm flex-shrink-0">{{ strtoupper(substr($t->name,0,1)) }}</div>
      <div class="flex-1 min-w-0">
        <div class="flex items-center gap-2 flex-wrap">
          <span class="font-semibold text-sm text-slate-800">{{ $t->name }}</span>
          @if($t->company)<span class="text-xs text-slate-400">— {{ $t->company }}</span>@endif
          @if($t->country)<span class="text-xs bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full">{{ $t->country }}</span>@endif
        </div>
        <div class="flex gap-0.5 my-1">@for($s=1;$s<=5;$s++)<i class="fas fa-star {{ $s<=$t->rating?'text-gold':'text-slate-200' }} text-xs"></i>@endfor</div>
        <p class="text-sm text-slate-600 leading-relaxed">"{{ $t->comment }}"</p>
        <p class="text-xs text-slate-400 mt-1">{{ $t->created_at->diffForHumans() }}</p>
      </div>
      <div class="flex gap-2 flex-shrink-0">
        <form action="{{ route('admin.testimonials.approve',$t) }}" method="POST">@csrf
          <button class="text-xs bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded-lg transition-colors"><i class="fas fa-check mr-1"></i>Setujui</button>
        </form>
        <form action="{{ route('admin.testimonials.destroy',$t) }}" method="POST" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')
          <button class="text-xs bg-red-100 hover:bg-red-200 text-red-600 px-3 py-1.5 rounded-lg transition-colors"><i class="fas fa-trash"></i></button>
        </form>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endif

<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
  <div class="px-6 py-4 border-b border-slate-100 font-semibold text-slate-700 text-sm">Testimoni Disetujui ({{ $approved->total() }})</div>
  <div class="divide-y divide-slate-100">
    @forelse($approved as $t)
    <div class="flex gap-4 px-6 py-4">
      <div class="w-9 h-9 rounded-full bg-gradient-to-br from-gold to-gold-dark flex items-center justify-center text-white font-bold text-sm flex-shrink-0">{{ strtoupper(substr($t->name,0,1)) }}</div>
      <div class="flex-1 min-w-0">
        <div class="flex items-center gap-2 flex-wrap">
          <span class="font-medium text-sm text-slate-800">{{ $t->name }}</span>
          @if($t->company)<span class="text-xs text-slate-400">{{ $t->company }}</span>@endif
        </div>
        <div class="flex gap-0.5 my-0.5">@for($s=1;$s<=5;$s++)<i class="fas fa-star {{ $s<=$t->rating?'text-gold':'text-slate-200' }} text-xs"></i>@endfor</div>
        <p class="text-xs text-slate-500 line-clamp-2">"{{ $t->comment }}"</p>
      </div>
      <div class="flex gap-2 flex-shrink-0">
        <form action="{{ route('admin.testimonials.reject',$t) }}" method="POST">@csrf
          <button class="text-xs text-orange-500 hover:underline">Sembunyikan</button>
        </form>
        <form action="{{ route('admin.testimonials.destroy',$t) }}" method="POST" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')
          <button class="text-xs text-red-500 hover:underline ml-2">Hapus</button>
        </form>
      </div>
    </div>
    @empty
    <div class="text-center py-10 text-slate-400 text-sm">Belum ada testimoni yang disetujui.</div>
    @endforelse
  </div>
</div>
{{ $approved->links() }}
@endsection
