<?php

use App\Http\Controllers\ProfileController;
// fungsinya untuk menggunakan controller profile 

use App\Http\Controllers\AboutController;
// fungsinya untuk menggunakan controller about 

use App\Http\Controllers\ProductController;
// fungsinya untuk menggunakan controller product 

use Illuminate\Support\Facades\Route;
// fungsinya untuk menggunakan fitur routing Laravel 

use App\Http\Controllers\CategoryController;
// fungsinya untuk menggunakan controller category 


Route::get('/', function () {
    return view('welcome');
});
// fungsinya untuk menampilkan halaman welcome saat pertama buka website 


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// fungsinya untuk menampilkan dashboard 
// middleware auth = harus login 
// middleware verified = harus verifikasi email
// name = memberi nama route dashboard 


Route::middleware('auth')->group(function () {
    // fungsinya untuk membatasi semua route di dalam hanya untuk user login --}}


    Route::get('/about', [AboutController::class, 'index'])
        ->name('about');
    // fungsinya untuk menampilkan halaman about 


    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
   // fungsinya untuk menampilkan daftar product 


    Route::get('/product/export', [ProductController::class, 'export'])
        ->middleware('can:export-product')
        ->name('product.export');
    // fungsinya untuk export data product 
    // middleware can = hanya user tertentu yang bisa akses 


    Route::resource('category', CategoryController::class);
    // fungsinya untuk membuat semua route CRUD category otomatis 


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // fungsinya untuk menampilkan halaman edit profile 

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // fungsinya untuk update data profile 

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // fungsinya untuk menghapus akun/profile 


    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    // fungsinya untuk menyimpan product baru 

    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    // fungsinya untuk menampilkan form tambah product 

    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
    // fungsinya untuk menampilkan detail product 

    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    // fungsinya untuk update product 

    Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    // fungsinya untuk menampilkan form edit product 

    Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    // fungsinya untuk menghapus product 
});


require __DIR__.'/auth.php';
// fungsinya untuk memuat route authentication (login, register, dll) 