<?php

namespace App\Models; 
// Namespace model (lokasi model dalam Laravel)

use Illuminate\Database\Eloquent\Model; 
// Menggunakan class Model (Eloquent ORM Laravel)

class Category extends Model
{
    // Menentukan field yang boleh diisi secara mass assignment
    // Artinya saat pakai Category::create(), hanya 'name' yang bisa diisi
    protected $fillable = ['name'];

    public function products()
    {
        // Relasi One to Many:
        // 1 category bisa memiliki banyak product
        // hasMany(Product::class) berarti:
        // - foreign key ada di tabel products (category_id)
        return $this->hasMany(Product::class);
    }
}