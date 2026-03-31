{{-- resources/views/admin/products/index.blade.php --}}
@extends('layouts.admin')
@section('title','Kelola Produk')
@section('content')
<div class="flex items-center justify-between mb-6">
  <div></div>
  <a href="{{ route('admin.products.create') }}"
     class="inline-flex items-center gap-2 bg-gradient-to-r from-gold to-gold-dark text-white font-semibold px-5 py-2.5 rounded-xl text-sm hover:opacity-90 transition-all">
    <i class="fas fa-plus"></i> Tambah Produk
  </a>
</div>

<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
  <table class="w-full text-sm">
    <thead class="bg-slate-50 border-b border-slate-200">
      <tr>
        <th class="text-left px-5 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wide">Produk</th>
        <th class="text-left px-4 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wide hidden sm:table-cell">Kategori</th>
        <th class="text-left px-4 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wide hidden md:table-cell">Harga</th>
        <th class="text-center px-4 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wide">Status</th>
        <th class="text-right px-5 py-3.5 text-xs font-semibold text-slate-500 uppercase tracking-wide">Aksi</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-slate-100">
      @forelse($products as $product)
      <tr class="hover:bg-slate-50 transition-colors">
        <td class="px-5 py-4">
          <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl overflow-hidden bg-gold-pale flex-shrink-0">
              <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            </div>
            <div>
              <div class="font-medium text-slate-800">{{ $product->name }}</div>
              <div class="text-xs text-slate-400 mt-0.5 hidden sm:block">{{ Str::limit($product->short_desc,50) }}</div>
            </div>
          </div>
        </td>
        <td class="px-4 py-4 text-slate-500 hidden sm:table-cell">{{ $product->category }}</td>
        <td class="px-4 py-4 font-medium text-slate-700 hidden md:table-cell">
          {{ $product->price ? 'Rp '.number_format($product->price,0,',','.') : '—' }}
        </td>
        <td class="px-4 py-4 text-center">
          <form action="{{ route('admin.products.toggle',$product) }}" method="POST">
            @csrf
            <button type="submit" class="text-xs px-3 py-1.5 rounded-full font-medium {{ $product->is_active?'bg-green-100 text-green-700':'bg-slate-100 text-slate-500' }}">
              {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
            </button>
          </form>
        </td>
        <td class="px-5 py-4 text-right">
          <div class="flex items-center justify-end gap-2">
            <a href="{{ route('admin.products.edit',$product) }}" class="text-xs bg-blue-50 hover:bg-blue-100 text-blue-700 px-3 py-1.5 rounded-lg transition-colors">
              <i class="fas fa-pen"></i>
            </a>
            <form action="{{ route('admin.products.destroy',$product) }}" method="POST"
                  onsubmit="return confirm('Hapus produk ini?')">
              @csrf @method('DELETE')
              <button class="text-xs bg-red-50 hover:bg-red-100 text-red-600 px-3 py-1.5 rounded-lg transition-colors">
                <i class="fas fa-trash"></i>
              </button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="5" class="text-center py-12 text-slate-400">Belum ada produk.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
{{ $products->links() }}
@endsection
