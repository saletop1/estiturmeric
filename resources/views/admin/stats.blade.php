{{-- resources/views/admin/stats.blade.php --}}
@extends('layouts.admin')
@section('title','Statistik Kunjungan')
@section('content')

<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
  @foreach([
    ['label'=>'Total Kunjungan', 'val'=>number_format($totalVisits),      'icon'=>'fas fa-eye',         'color'=>'text-blue-600 bg-blue-50'],
    ['label'=>'Hari Ini',        'val'=>number_format($visitsToday),       'icon'=>'fas fa-calendar-day','color'=>'text-teal-600 bg-teal-50'],
    ['label'=>'Minggu Ini',      'val'=>number_format($visitsThisWeek),    'icon'=>'fas fa-calendar-week','color'=>'text-purple-600 bg-purple-50'],
    ['label'=>'Unik Hari Ini',   'val'=>number_format($uniqueVisitorsToday),'icon'=>'fas fa-users',      'color'=>'text-amber-600 bg-amber-50'],
  ] as $s)
  <div class="bg-white rounded-2xl border border-slate-200 p-5 flex items-center gap-3">
    <div class="w-10 h-10 rounded-xl {{ $s['color'] }} flex items-center justify-center flex-shrink-0"><i class="{{ $s['icon'] }} text-sm"></i></div>
    <div><div class="text-2xl font-bold text-slate-800">{{ $s['val'] }}</div><div class="text-xs text-slate-400">{{ $s['label'] }}</div></div>
  </div>
  @endforeach
</div>

<div class="grid md:grid-cols-2 gap-6">
  {{-- Popular pages --}}
  <div class="bg-white rounded-2xl border border-slate-200 p-6">
    <h3 class="font-semibold text-slate-700 mb-4 flex items-center gap-2"><i class="fas fa-fire text-gold text-sm"></i>Halaman Terpopuler</h3>
    @php $maxPop = $popularPages->max('total') ?: 1; @endphp
    <div class="space-y-3">
      @foreach($popularPages as $i => $page)
      <div>
        <div class="flex justify-between text-sm mb-1">
          <span class="text-slate-600 truncate flex-1 mr-2">{{ $page->url ?: '/' }}</span>
          <span class="font-semibold text-slate-800 flex-shrink-0">{{ number_format($page->total) }}</span>
        </div>
        <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
          <div class="h-full bg-gradient-to-r from-gold to-gold-dark rounded-full" style="width:{{ ($page->total/$maxPop)*100 }}%"></div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  {{-- Recent visits --}}
  <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 font-semibold text-slate-700 text-sm flex items-center gap-2">
      <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>Kunjungan Terbaru
    </div>
    <div class="overflow-x-auto">
      <table class="w-full text-xs">
        <thead class="bg-slate-50 border-b border-slate-100">
          <tr>
            <th class="text-left px-4 py-2.5 text-slate-500 font-medium">IP</th>
            <th class="text-left px-3 py-2.5 text-slate-500 font-medium">Halaman</th>
            <th class="text-right px-4 py-2.5 text-slate-500 font-medium">Waktu</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
          @foreach($recentVisits as $v)
          <tr class="hover:bg-slate-50">
            <td class="px-4 py-2.5 font-mono text-slate-500">{{ $v->ip_address }}</td>
            <td class="px-3 py-2.5 text-slate-600 max-w-[120px] truncate">{{ $v->url }}</td>
            <td class="px-4 py-2.5 text-right text-slate-400">{{ \Carbon\Carbon::parse($v->visited_at)->diffForHumans() }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
