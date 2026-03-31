<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
{{-- resources/views/sitemap.blade.php --}}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url><loc>{{ url('/') }}</loc><changefreq>weekly</changefreq><priority>1.0</priority></url>
  <url><loc>{{ route('about') }}</loc><changefreq>monthly</changefreq><priority>0.8</priority></url>
  <url><loc>{{ route('products') }}</loc><changefreq>weekly</changefreq><priority>0.9</priority></url>
  <url><loc>{{ route('advantages') }}</loc><changefreq>monthly</changefreq><priority>0.7</priority></url>
  <url><loc>{{ route('testimonials.index') }}</loc><changefreq>weekly</changefreq><priority>0.7</priority></url>
  <url><loc>{{ route('contact') }}</loc><changefreq>yearly</changefreq><priority>0.6</priority></url>
  @foreach($products as $product)
  <url>
    <loc>{{ route('products.show',$product->slug) }}</loc>
    <lastmod>{{ $product->updated_at->toAtomString() }}</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  @endforeach
</urlset>
