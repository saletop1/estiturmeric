{{-- resources/views/admin/products/form.blade.php --}}
@extends('layouts.admin')
@section('title', isset($product->id) ? 'Edit Produk' : 'Tambah Produk')
@section('content')
<div class="max-w-3xl">
<form action="{{ isset($product->id) ? route('admin.products.update',$product) : route('admin.products.store') }}"
      method="POST" enctype="multipart/form-data" class="space-y-6">
  @csrf
  @if(isset($product->id)) @method('PUT') @endif

  <div class="bg-white rounded-2xl border border-slate-200 p-6">
    <h3 class="font-semibold text-slate-700 mb-5 pb-3 border-b border-slate-100">Informasi Dasar</h3>
    <div class="grid sm:grid-cols-2 gap-4">
      <div class="sm:col-span-2">
        <label class="block text-xs font-medium text-slate-600 mb-1.5">Nama Produk *</label>
        <input type="text" name="name" value="{{ old('name',$product->name) }}" required
               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-gold focus:ring-2 focus:ring-gold/15">
        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-xs font-medium text-slate-600 mb-1.5">Kategori</label>
        <input type="text" name="category" value="{{ old('category',$product->category) }}" placeholder="Fresh Turmeric, Dried Turmeric..."
               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-gold focus:ring-2 focus:ring-gold/15">
      </div>
      <div>
        <label class="block text-xs font-medium text-slate-600 mb-1.5">Badge</label>
        <input type="text" name="badge" value="{{ old('badge',$product->badge) }}" placeholder="Baru, Terlaris..."
               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-gold focus:ring-2 focus:ring-gold/15">
      </div>
      <div>
        <label class="block text-xs font-medium text-slate-600 mb-1.5">Harga (Rp)</label>
        <input type="number" name="price" value="{{ old('price',$product->price) }}" step="0.01"
               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-gold focus:ring-2 focus:ring-gold/15">
      </div>
      <div>
        <label class="block text-xs font-medium text-slate-600 mb-1.5">Harga Lama (Rp)</label>
        <input type="number" name="price_old" value="{{ old('price_old',$product->price_old) }}" step="0.01"
               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-gold focus:ring-2 focus:ring-gold/15">
      </div>
      <div>
        <label class="block text-xs font-medium text-slate-600 mb-1.5">Satuan</label>
        <input type="text" name="unit" value="{{ old('unit',$product->unit ?? 'kg') }}" placeholder="kg, ton, liter..."
               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-gold focus:ring-2 focus:ring-gold/15">
      </div>
      <div>
        <label class="block text-xs font-medium text-slate-600 mb-1.5">Min. Order</label>
        <input type="number" name="min_order" value="{{ old('min_order',$product->min_order ?? 1) }}" min="1"
               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-gold focus:ring-2 focus:ring-gold/15">
      </div>
      <div class="sm:col-span-2">
        <label class="block text-xs font-medium text-slate-600 mb-1.5">Deskripsi Singkat</label>
        <textarea name="short_desc" rows="2"
                  class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-gold focus:ring-2 focus:ring-gold/15 resize-none">{{ old('short_desc',$product->short_desc) }}</textarea>
      </div>
      <div class="sm:col-span-2">
        <label class="block text-xs font-medium text-slate-600 mb-1.5">Deskripsi Lengkap</label>
        <textarea name="description" rows="5"
                  class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-gold focus:ring-2 focus:ring-gold/15 resize-none">{{ old('description',$product->description) }}</textarea>
      </div>
    </div>
  </div>

  {{-- Image --}}
  <div class="bg-white rounded-2xl border border-slate-200 p-6">
    <h3 class="font-semibold text-slate-700 mb-5 pb-3 border-b border-slate-100">Foto Produk</h3>
    @if($product->image)
    <div class="mb-4">
      <img src="{{ $product->image_url }}" alt="Current" class="w-32 h-32 object-cover rounded-xl border border-slate-200">
      <p class="text-xs text-slate-400 mt-1">Foto saat ini. Upload baru untuk mengganti.</p>
    </div>
    @endif
    <input type="file" name="image" accept="image/*"
           class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-gold/10 file:text-gold file:text-xs file:font-medium">
  </div>

  {{-- Lab Data --}}
  <div class="bg-white rounded-2xl border border-slate-200 p-6">
    <h3 class="font-semibold text-slate-700 mb-5 pb-3 border-b border-slate-100">Data Laboratorium (Opsional)</h3>
    <div id="labRows" class="space-y-3 mb-4">
      @php $labData = old('lab_data') ? [] : ($product->lab_data ?? []); @endphp
      @if($labData)
        @foreach($labData as $k => $v)
        <div class="flex gap-3">
          <input type="text" name="lab_keys[]" value="{{ $k }}" placeholder="Nama parameter" class="flex-1 border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-gold">
          <input type="text" name="lab_values[]" value="{{ $v }}" placeholder="Nilai" class="flex-1 border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-gold">
          <button type="button" onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-600 px-2"><i class="fas fa-times"></i></button>
        </div>
        @endforeach
      @else
        <div class="flex gap-3">
          <input type="text" name="lab_keys[]" placeholder="Contoh: Curcumin" class="flex-1 border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-gold">
          <input type="text" name="lab_values[]" placeholder="Contoh: 28.270,40 mg/kg" class="flex-1 border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-gold">
          <button type="button" onclick="this.parentElement.remove()" class="text-red-400 px-2"><i class="fas fa-times"></i></button>
        </div>
      @endif
    </div>
    <button type="button" id="addLabRow" class="text-xs text-gold hover:underline">
      <i class="fas fa-plus mr-1"></i>Tambah Baris
    </button>
  </div>

  {{-- SEO --}}
  <div class="bg-white rounded-2xl border border-slate-200 p-6">
    <h3 class="font-semibold text-slate-700 mb-5 pb-3 border-b border-slate-100">SEO</h3>
    <div class="space-y-4">
      <div>
        <label class="block text-xs font-medium text-slate-600 mb-1.5">Meta Title</label>
        <input type="text" name="meta_title" value="{{ old('meta_title',$product->meta_title) }}"
               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-gold focus:ring-2 focus:ring-gold/15">
      </div>
      <div>
        <label class="block text-xs font-medium text-slate-600 mb-1.5">Meta Description</label>
        <textarea name="meta_description" rows="2"
                  class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-gold resize-none">{{ old('meta_description',$product->meta_description) }}</textarea>
      </div>
    </div>
  </div>

  {{-- Options --}}
  <div class="bg-white rounded-2xl border border-slate-200 p-6">
    <div class="flex flex-wrap gap-6">
      <label class="flex items-center gap-2 cursor-pointer">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active',$product->is_active ?? true) ? 'checked' : '' }} class="accent-gold w-4 h-4">
        <span class="text-sm text-slate-700">Aktif</span>
      </label>
      <label class="flex items-center gap-2 cursor-pointer">
        <input type="hidden" name="is_featured" value="0">
        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured',$product->is_featured) ? 'checked' : '' }} class="accent-gold w-4 h-4">
        <span class="text-sm text-slate-700">Tampilkan di Halaman Utama</span>
      </label>
      <div class="flex items-center gap-2">
        <label class="text-sm text-slate-700">Urutan:</label>
        <input type="number" name="sort_order" value="{{ old('sort_order',$product->sort_order ?? 0) }}" min="0"
               class="w-20 border border-slate-200 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:border-gold">
      </div>
    </div>
  </div>

  <div class="flex gap-3">
    <button type="submit" class="bg-gradient-to-r from-gold to-gold-dark text-white font-semibold px-6 py-3 rounded-xl text-sm hover:opacity-90 transition-all">
      <i class="fas fa-save mr-2"></i>{{ isset($product->id) ? 'Perbarui' : 'Simpan' }} Produk
    </button>
    <a href="{{ route('admin.products.index') }}" class="border border-slate-200 text-slate-600 hover:bg-slate-50 px-6 py-3 rounded-xl text-sm transition-all">
      Batal
    </a>
  </div>
</form>
</div>

@push('scripts')
<script>
document.getElementById('addLabRow').addEventListener('click', () => {
  const row = `<div class="flex gap-3">
    <input type="text" name="lab_keys[]" placeholder="Nama parameter" class="flex-1 border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-gold">
    <input type="text" name="lab_values[]" placeholder="Nilai" class="flex-1 border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-gold">
    <button type="button" onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-600 px-2"><i class="fas fa-times"></i></button>
  </div>`;
  document.getElementById('labRows').insertAdjacentHTML('beforeend', row);
});
</script>
@endpush
@endsection
