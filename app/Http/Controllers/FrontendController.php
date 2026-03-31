<?php
// app/Http/Controllers/FrontendController.php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Testimonial;
use App\Models\Setting;

class FrontendController extends Controller
{
    private function seo(string $defaultTitle, string $defaultDesc = ''): array
    {
        return [
            'site_name'  => (string) Setting::get('site_name', 'PT. Diyani Rempah Saketi'),
            'meta_title' => (string) $defaultTitle,
            'meta_desc'  => (string) $defaultDesc,
            'og_image'   => (string) Setting::get('og_image', asset('images/og-default.jpg')),
        ];
    }

    public function index()
    {
        $seo = $this->seo(
            (string) Setting::get('home_meta_title', 'PT. Diyani Rempah Saketi — Premium Turmeric Exporter'),
            (string) Setting::get('home_meta_desc',  'Producer and exporter of high-quality turmeric from Semarang, Indonesia.')
        );
        $products   = Product::active()->featured()->orderBy('sort_order')->limit(4)->get();
        $testimonials = Testimonial::approved()->latest()->limit(3)->get();
        return view('frontend.home', compact('seo','products','testimonials'));
    }

    public function about()
    {
        $seo = $this->seo('Tentang Kami — PT. Diyani Rempah Saketi',
            'Mengenal lebih dekat PT. Diyani Rempah Saketi, produsen dan eksportir kunyit premium dari Semarang.');
        return view('frontend.about', compact('seo'));
    }

    public function products()
    {
        $seo = $this->seo(
            Setting::get('products_meta_title', 'Produk Kami — Kunyit Premium | PT. Diyani Rempah Saketi'),
            Setting::get('products_meta_desc',  'Lihat rangkaian produk kunyit premium kami: segar, kering, bubuk, ekstrak & oleoresin.')
        );
        $products   = Product::active()->orderBy('sort_order')->get();
        return view('frontend.products', compact('seo','products'));
    }

    public function productDetail(string $slug)
    {
        $product = Product::active()->where('slug', $slug)->firstOrFail();
        $seo = $this->seo(
            $product->meta_title ?: $product->name . ' — PT. Diyani Rempah Saketi',
            $product->meta_description ?: $product->short_desc
        );
        $related = Product::active()->where('id', '!=', $product->id)->limit(3)->get();
        return view('frontend.product-detail', compact('seo','product','related'));
    }

    public function advantages()
    {
        $seo = $this->seo('Keunggulan Kami — PT. Diyani Rempah Saketi',
            'Keunggulan kompetitif PT. Diyani Rempah Saketi: kualitas lab, legalitas lengkap, ramah lingkungan.');
        return view('frontend.advantages', compact('seo'));
    }

    public function contact()
    {
        $seo = $this->seo('Hubungi Kami — PT. Diyani Rempah Saketi',
            'Kontak PT. Diyani Rempah Saketi: Tegalsari Barat II/30, Semarang. Telp/WA: +62 821-3828-0770');
        return view('frontend.contact', compact('seo'));
    }
}