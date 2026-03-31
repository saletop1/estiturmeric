{{-- resources/views/admin/settings.blade.php --}}
@extends('layouts.admin')
@section('title','Pengaturan & SEO')
@section('content')

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-3xl">
  @csrf

  {{-- Site Identity --}}
  <div class="bg-white rounded-2xl border border-slate-200 p-6">
    <h3 class="font-semibold text-slate-700 mb-5 pb-3 border-b border-slate-100 flex items-center gap-2">
      <i class="fas fa-globe text-gold text-sm"></i> Identitas Website
    </h3>
    <div class="grid sm:grid-cols-2 gap-4">
      @foreach([
        ['key'=>'site_name',   'label'=>'Nama Website', 'type'=>'text'],
        ['key'=>'site_tagline','label'=>'Tagline',       'type'=>'text'],
        ['key'=>'site_email',  'label'=>'Email',         'type'=>'email'],
        ['key'=>'site_phone',  'label'=>'Telepon Utama', 'type'=>'text'],
        ['key'=>'site_phone2', 'label'=>'Telepon 2',     'type'=>'text'],
      ] as $f)
      <div>
        <label class="block text-xs font-medium text-slate-600 mb-1.5">{{ $f['label'] }}</label>
        <input type="{{ $f['type'] }}" name="{{ $f['key'] }}" value="{{ $settings[$f['key']] }}"
               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-gold focus:ring-2 focus:ring-gold/15">
      </div>
      @endforeach
      <div class="sm:col-span-2">
        <label class="block text-xs font-medium text-slate-600 mb-1.5">Alamat Lengkap</label>
        <textarea name="site_address" rows="2"
                  class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-gold resize-none">{{ $settings['site_address'] }}</textarea>
      </div>
      <div class="sm:col-span-2">
        <label class="block text-xs font-medium text-slate-600 mb-1.5">Teks Footer</label>
        <textarea name="footer_text" rows="2"
                  class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-gold resize-none">{{ $settings['footer_text'] }}</textarea>
      </div>
    </div>
  </div>

  {{-- Media --}}
  <div class="bg-white rounded-2xl border border-slate-200 p-6">
    <h3 class="font-semibold text-slate-700 mb-5 pb-3 border-b border-slate-100 flex items-center gap-2">
      <i class="fas fa-image text-gold text-sm"></i> Logo & Gambar
    </h3>
    <div class="grid sm:grid-cols-3 gap-6">
      @foreach([['key'=>'logo','label'=>'Logo'],['key'=>'favicon','label'=>'Favicon'],['key'=>'og_image','label'=>'OG Image (Share)']] as $f)
      <div>
        <label class="block text-xs font-medium text-slate-600 mb-2">{{ $f['label'] }}</label>
        @if($settings[$f['key']])
        <img src="{{ asset('storage/'.$settings[$f['key']]) }}" alt="{{ $f['label'] }}" class="w-20 h-20 object-contain border border-slate-200 rounded-xl mb-2 p-2">
        @endif
        <input type="file" name="{{ $f['key'] }}" accept="image/*"
               class="w-full text-xs border border-slate-200 rounded-xl px-3 py-2 file:mr-2 file:py-1 file:px-2 file:rounded-lg file:border-0 file:bg-gold/10 file:text-gold file:text-xs">
      </div>
      @endforeach
    </div>
  </div>

  {{-- Social --}}
  <div class="bg-white rounded-2xl border border-slate-200 p-6">
    <h3 class="font-semibold text-slate-700 mb-5 pb-3 border-b border-slate-100 flex items-center gap-2">
      <i class="fas fa-share-nodes text-gold text-sm"></i> Media Sosial
    </h3>
    <div class="grid sm:grid-cols-2 gap-4">
      @foreach([
        ['key'=>'wa_number', 'label'=>'WhatsApp Number','placeholder'=>'628213828xxxx'],
        ['key'=>'instagram', 'label'=>'Instagram',       'placeholder'=>'username saja'],
        ['key'=>'facebook',  'label'=>'Facebook',        'placeholder'=>'username/page'],
        ['key'=>'linkedin',  'label'=>'LinkedIn',        'placeholder'=>'company-name'],
      ] as $f)
      <div>
        <label class="block text-xs font-medium text-slate-600 mb-1.5">{{ $f['label'] }}</label>
        <input type="text" name="{{ $f['key'] }}" value="{{ $settings[$f['key']] }}" placeholder="{{ $f['placeholder'] }}"
               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-gold focus:ring-2 focus:ring-gold/15">
      </div>
      @endforeach
    </div>
  </div>

  {{-- SEO --}}
  <div class="bg-white rounded-2xl border border-slate-200 p-6">
    <h3 class="font-semibold text-slate-700 mb-5 pb-3 border-b border-slate-100 flex items-center gap-2">
      <i class="fas fa-magnifying-glass text-gold text-sm"></i> SEO & Analytics
    </h3>
    <div class="space-y-4">
      @foreach([
        ['key'=>'home_meta_title',     'label'=>'Home — Meta Title',    'rows'=>1],
        ['key'=>'home_meta_desc',      'label'=>'Home — Meta Desc',     'rows'=>2],
        ['key'=>'products_meta_title', 'label'=>'Produk — Meta Title',  'rows'=>1],
        ['key'=>'products_meta_desc',  'label'=>'Produk — Meta Desc',   'rows'=>2],
      ] as $f)
      <div>
        <label class="block text-xs font-medium text-slate-600 mb-1.5">{{ $f['label'] }}</label>
        @if($f['rows'] > 1)
        <textarea name="{{ $f['key'] }}" rows="{{ $f['rows'] }}"
                  class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-gold resize-none">{{ $settings[$f['key']] }}</textarea>
        @else
        <input type="text" name="{{ $f['key'] }}" value="{{ $settings[$f['key']] }}"
               class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-gold focus:ring-2 focus:ring-gold/15">
        @endif
      </div>
      @endforeach
      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="block text-xs font-medium text-slate-600 mb-1.5">Google Analytics ID</label>
          <input type="text" name="ga_id" value="{{ $settings['ga_id'] }}" placeholder="G-XXXXXXXXXX"
                 class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-gold focus:ring-2 focus:ring-gold/15">
        </div>
        <div>
          <label class="block text-xs font-medium text-slate-600 mb-1.5">Facebook Pixel ID</label>
          <input type="text" name="fb_pixel" value="{{ $settings['fb_pixel'] }}" placeholder="123456789"
                 class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-gold focus:ring-2 focus:ring-gold/15">
        </div>
      </div>
    </div>
  </div>

  <div class="flex gap-3">
    <button type="submit" class="bg-gradient-to-r from-gold to-gold-dark text-white font-semibold px-6 py-3 rounded-xl text-sm hover:opacity-90 transition-all">
      <i class="fas fa-save mr-2"></i>Simpan Semua Pengaturan
    </button>
  </div>
</form>
@endsection
