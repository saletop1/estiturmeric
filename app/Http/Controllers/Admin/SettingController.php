<?php
// app/Http/Controllers/Admin/SettingController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    private array $keys = [
        'site_name','site_tagline','site_email','site_phone','site_phone2',
        'site_address','site_maps_embed',
        'og_image','logo','favicon',
        'home_meta_title','home_meta_desc',
        'products_meta_title','products_meta_desc',
        'ga_id','fb_pixel',
        'wa_number','instagram','facebook','linkedin',
        'footer_text',
    ];

    public function index()
    {
        $settings = [];
        foreach ($this->keys as $k) {
            $settings[$k] = Setting::get($k, '');
        }
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        foreach ($this->keys as $k) {
            if ($request->has($k)) {
                Setting::set($k, $request->input($k));
            }
        }

        // Handle file uploads
        foreach (['og_image','logo','favicon'] as $field) {
            if ($request->hasFile($field)) {
                $old = Setting::get($field);
                if ($old && Storage::disk('public')->exists($old)) {
                    Storage::disk('public')->delete($old);
                }
                $path = $request->file($field)->store('settings', 'public');
                Setting::set($field, $path);
            }
        }

        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }

    public function updateSeo(Request $request)
    {
        $seoKeys = ['home_meta_title','home_meta_desc','products_meta_title','products_meta_desc','ga_id','fb_pixel'];
        foreach ($seoKeys as $k) {
            if ($request->has($k)) Setting::set($k, $request->input($k));
        }
        return back()->with('success', 'Pengaturan SEO berhasil disimpan!');
    }
}
