<?php
// app/Http/Controllers/SitemapController.php
namespace App\Http\Controllers;

use App\Models\Product;

class SitemapController extends Controller
{
    public function index()
    {
        $products = Product::active()->get();
        return response()->view('sitemap', compact('products'))
            ->header('Content-Type', 'text/xml');
    }
}
