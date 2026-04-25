<?php

namespace App\Models; 
// Namespace model (lokasi model dalam Laravel)

use Illuminate\Database\Eloquent\Model; 
// Menggunakan Eloquent Model (ORM Laravel untuk database)

class Product extends Model
{
    // Field yang boleh diisi secara mass assignment
    // Digunakan saat Product::create() atau update massal
    protected $fillable = [
        'name',        // nama produk
        'quantity',    // jumlah stok produk
        'price',       // harga produk
        'user_id',     // relasi ke user (pemilik/pembuat produk)
        'category_id', // relasi ke category
    ];

    public function user()
    {
        // Relasi Many to One:
        // Banyak product dimiliki oleh 1 user
        // foreign key: user_id ada di tabel products
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        // Relasi Many to One:
        // Banyak product masuk ke 1 category
        // foreign key: category_id ada di tabel products
        return $this->belongsTo(Category::class);
    }
}