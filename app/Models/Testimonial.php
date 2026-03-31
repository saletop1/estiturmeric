<?php
// app/Models/Testimonial.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['name','company','country','comment','rating','is_approved','ip_address'];
    protected $casts = ['is_approved' => 'boolean', 'rating' => 'integer'];

    public function scopeApproved($q) { return $q->where('is_approved', true); }
    public function scopePending($q)  { return $q->where('is_approved', false); }
}
