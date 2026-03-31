<?php
// app/Models/Product.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'name','slug','category','short_desc','description',
        'image','gallery','price','price_old','unit','min_order',
        'badge','is_active','is_featured','sort_order','lab_data',
        'meta_title','meta_description',
    ];

    protected $casts = [
        'gallery'  => 'array',
        'lab_data' => 'array',
        'is_active'   => 'boolean',
        'is_featured' => 'boolean',
        'price'     => 'decimal:2',
        'price_old' => 'decimal:2',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    public function scopeActive($q)   { return $q->where('is_active', true); }
    public function scopeFeatured($q) { return $q->where('is_featured', true); }

    public function getImageUrlAttribute(): string
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('images/product-placeholder.jpg');
    }
}
