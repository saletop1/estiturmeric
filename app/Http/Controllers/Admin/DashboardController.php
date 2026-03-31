<?php
// app/Http/Controllers/Admin/DashboardController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\Visit;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalProducts'     => Product::count(),
            'activeProducts'    => Product::active()->count(),
            'pendingTestimonials' => Testimonial::pending()->count(),
            'totalTestimonials' => Testimonial::approved()->count(),
            'totalVisits'       => Visit::count(),
            'visitsToday'       => Visit::whereDate('visited_at', today())->count(),
            'recentTestimonials'=> Testimonial::pending()->latest()->limit(5)->get(),
        ]);
    }
}
