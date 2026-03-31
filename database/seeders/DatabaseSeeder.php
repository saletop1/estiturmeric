<?php
// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin user ──────────────────────────────────
        User::firstOrCreate(['email' => 'admin@diyani.com'], [
            'name'     => 'Admin Diyani',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
        ]);

        // ── Default Settings ────────────────────────────
        $defaults = [
            'site_name'    => 'PT. Diyani Rempah Saketi',
            'site_tagline' => 'Premium Indonesian Turmeric Exporter',
            'site_email'   => 'rempahjowoje25@gmail.com',
            'site_phone'   => '+62 821-3828-0770',
            'site_phone2'  => '+62 812-9059-7467',
            'site_address' => 'Tegalsari Barat II/30, Kota Semarang, Jawa Tengah, Indonesia 50251',
            'wa_number'    => '6282138280770',
            'footer_text'  => 'Produsen dan eksportir kunyit premium dari Semarang, Jawa Tengah, Indonesia. Melayani pasar global dengan standar kualitas internasional.',
            'home_meta_title' => 'PT. Diyani Rempah Saketi — Premium Turmeric Exporter from Indonesia',
            'home_meta_desc'  => 'Premium turmeric producer and exporter from Semarang, Indonesia. Lab-certified, no preservatives. Exporting to India, USA, Malaysia, Germany, China, UAE.',
            'products_meta_title' => 'Our Products — Fresh, Dried & Extract Turmeric | PT. Diyani Rempah Saketi',
            'products_meta_desc'  => 'Explore our premium turmeric range: fresh roots, dried slices, powder, and oleoresin extracts. Lab-certified and ready for global export.',
        ];
        foreach ($defaults as $k => $v) {
            Setting::firstOrCreate(['key' => $k], ['value' => $v]);
        }

        // ── Products ────────────────────────────────────
        $products = [
            [
                'name'        => 'Kunyit Segar (Fresh Turmeric)',
                'slug'        => 'kunyit-segar',
                'category'    => 'Fresh Turmeric',
                'short_desc'  => 'Hand-selected premium turmeric roots harvested at peak maturity.',
                'description' => 'Kunyit segar pilihan tangan dari petani Jawa Tengah. Dipanen pada puncak kematangan untuk memastikan kandungan kurkumin tertinggi. Siap diekspor ke seluruh dunia.',
                'badge'       => 'Terlaris',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 1,
                'unit'        => 'kg',
                'min_order'   => 100,
                'meta_title'  => 'Kunyit Segar Premium | PT. Diyani Rempah Saketi',
                'meta_description' => 'Fresh premium turmeric roots from Central Java Indonesia. High curcumin content, lab-certified, ready for global export.',
            ],
            [
                'name'        => 'Kunyit Kering & Bubuk',
                'slug'        => 'kunyit-kering-bubuk',
                'category'    => 'Dried & Powdered Turmeric',
                'short_desc'  => 'Sliced dried turmeric and 100% pure turmeric powder with potent aroma and deep golden color.',
                'description' => 'Kunyit iris kering dan bubuk kunyit 100% murni tanpa campuran apapun. Aroma kuat, warna kuning keemasan pekat. Cocok untuk industri makanan, minuman, dan farmasi.',
                'badge'       => 'Featured',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 2,
                'unit'        => 'kg',
                'min_order'   => 50,
                'lab_data'    => [
                    'Curcumin'                           => '28,270.40 mg/kg',
                    'Volatile Oil Content (VOC)'         => '5.38%',
                    'Protein Content'                    => '10.56%',
                    'Carbohydrate'                       => '69.87%',
                    'Total Energy'                       => '328.74 Kcal/100g',
                    'Moisture Content (Bidwell Sterling)' => '7.91%',
                    'Ash Content'                        => '10.88%',
                    'Total Fat Content'                  => '0.78%',
                    'Ochratoxin (Aflatoxin)'             => 'Not Detected',
                ],
                'meta_title'  => 'Kunyit Kering & Bubuk Premium | PT. Diyani Rempah Saketi',
            ],
            [
                'name'        => 'Ekstrak & Oleoresin Kunyit',
                'slug'        => 'ekstrak-oleoresin-kunyit',
                'category'    => 'Extracts & Oleoresins',
                'short_desc'  => 'Specialized turmeric derivatives for food, beverage, pharmaceutical, and cosmetic industries.',
                'description' => 'Turunan kunyit khusus berkadar kurkumin tinggi untuk aplikasi industri tingkat tinggi. Tersedia dalam berbagai konsentrasi sesuai kebutuhan importir.',
                'badge'       => 'Premium',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 3,
                'unit'        => 'liter',
                'min_order'   => 10,
                'meta_title'  => 'Turmeric Extract & Oleoresin | PT. Diyani Rempah Saketi',
            ],
        ];
        foreach ($products as $p) {
            Product::firstOrCreate(['slug' => $p['slug']], $p);
        }

        // ── Testimonials ────────────────────────────────
        $testimonials = [
            ['name'=>'Rajesh Kumar','company'=>'Spice Imports India','country'=>'India','comment'=>'Excellent quality turmeric with very high curcumin content. The lab certification gives us full confidence. Highly recommended supplier for consistent bulk orders.','rating'=>5,'is_approved'=>true],
            ['name'=>'Sarah Johnson','company'=>'Natural Foods USA','country'=>'United States','comment'=>'We have been sourcing from PT. Diyani for 6 months and the quality is consistently outstanding. Fast response from the team and smooth export documentation.','rating'=>5,'is_approved'=>true],
            ['name'=>'Ahmad Razali','company'=>'Herba Bumi Sdn Bhd','country'=>'Malaysia','comment'=>'Kualiti kunyit sangat baik dan aroma semulajadi. Proses eksport lancar dan pihak syarikat sangat responsif. Akan terus membeli.','rating'=>5,'is_approved'=>true],
        ];
        foreach ($testimonials as $t) {
            Testimonial::firstOrCreate(['name' => $t['name'], 'company' => $t['company']], $t);
        }
    }
}
