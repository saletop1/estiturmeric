<?php
// app/Http/Controllers/TestimonialController.php
namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\Setting;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $seo = [
            'site_name'  => Setting::get('site_name', 'PT. Diyani Rempah Saketi'),
            'meta_title' => 'Testimoni Pelanggan — PT. Diyani Rempah Saketi',
            'meta_desc'  => 'Baca ulasan dan testimoni pelanggan kami dari seluruh dunia.',
            'og_image'   => Setting::get('og_image', asset('images/og-default.jpg')),
        ];
        $testimonials = Testimonial::approved()->latest()->paginate(9);
        return view('frontend.testimonials', compact('seo','testimonials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|max:100',
            'company' => 'nullable|max:100',
            'country' => 'nullable|max:80',
            'comment' => 'required|max:1000',
            'rating'  => 'required|integer|min:1|max:5',
        ]);

        Testimonial::create([
            'name'       => $request->name,
            'company'    => $request->company,
            'country'    => $request->country,
            'comment'    => $request->comment,
            'rating'     => $request->rating,
            'is_approved'=> false,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('testimonials.index')
            ->with('success', 'Terima kasih! Testimoni Anda akan ditampilkan setelah ditinjau.');
    }
}
