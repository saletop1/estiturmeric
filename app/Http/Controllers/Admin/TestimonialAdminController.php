<?php
// app/Http/Controllers/Admin/TestimonialAdminController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;

class TestimonialAdminController extends Controller
{
    public function index()
    {
        $pending  = Testimonial::pending()->latest()->get();
        $approved = Testimonial::approved()->latest()->paginate(10);
        return view('admin.testimonials', compact('pending','approved'));
    }

    public function approve(Testimonial $testimonial)
    {
        $testimonial->update(['is_approved' => true]);
        return back()->with('success', "Testimoni dari \"{$testimonial->name}\" disetujui.");
    }

    public function reject(Testimonial $testimonial)
    {
        $testimonial->update(['is_approved' => false]);
        return back()->with('success', "Testimoni dari \"{$testimonial->name}\" ditolak.");
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return back()->with('success', 'Testimoni dihapus.');
    }
}
