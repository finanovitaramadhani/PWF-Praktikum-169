<?php

namespace App\Http\Controllers; 
// Namespace controller (lokasi file dalam Laravel)

use App\Models\Product; 
// Menggunakan model Product (tabel products)

use App\Models\Category; 
// Menggunakan model Category (tabel categories)

use App\Http\Requests\StoreProductRequest; 
// Form Request khusus untuk validasi saat create product

use App\Http\Requests\UpdateProductRequest; 
// Form Request khusus untuk validasi saat update product

class ProductController extends Controller
{
    public function index()
    {
        // Mengambil data product + relasi category dan user
        // paginate(10) artinya ditampilkan 10 data per halaman
        $products = Product::with('category', 'user')->paginate(10);

        // Mengirim data ke view product.index
        return view('product.index', compact('products'));
    }

    public function create()
    {
        // Mengambil semua data category untuk dropdown di form
        $categories = Category::all();

        // Menampilkan halaman form tambah product
        return view('product.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        // Mengambil data yang sudah tervalidasi dari Form Request
        $validated = $request->validated();

        // Menambahkan user_id otomatis dari user yang sedang login
        $validated['user_id'] = auth()->id();

        // Menyimpan data product ke database
        Product::create($validated);

        // Redirect ke halaman index + pesan sukses
        return redirect()->route('product.index')
            ->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        // Mengambil 1 product berdasarkan ID
        // Jika tidak ditemukan -> error 404
        $product = Product::findOrFail($id);

        // Menampilkan halaman detail product
        return view('product.view', compact('product'));
    }

    public function edit(Product $product)
    {
        // Authorization (Policy):
        // Mengecek apakah user punya izin untuk update product ini
        $this->authorize('update', $product);

        // Mengambil semua category untuk dropdown edit
        $categories = Category::all();

        // Menampilkan halaman edit + kirim data product & categories
        return view('product.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        // Mengambil product berdasarkan ID
        $product = Product::findOrFail($id);

        // Ambil data yang sudah tervalidasi
        $validated = $request->validated();

        // Mengisi data baru ke object product (BELUM disimpan ke DB)
        $product->fill($validated);

        // Mengecek apakah ada perubahan data
        if (!$product->isDirty()) {
            // Jika tidak ada perubahan, kembali ke halaman sebelumnya
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Tidak ada perubahan data!');
        }

        // Jika ada perubahan, simpan ke database
        $product->save();

        // Redirect ke index + pesan sukses
        return redirect()->route('product.index')
            ->with('success', 'Product updated successfully.');
    }

    public function delete($id)
    {
        // Mengambil product berdasarkan ID
        $product = Product::findOrFail($id);

        // Authorization (Policy):
        // Mengecek apakah user punya izin untuk menghapus
        $this->authorize('delete', $product);

        // Menghapus data dari database
        $product->delete();

        // Redirect + pesan sukses
        return redirect()->route('product.index')
            ->with('success', 'Product berhasil dihapus');
    }

    public function export()
    {
        // Fungsi export (biasanya untuk download data)
        // Saat ini hanya contoh sederhana
        return "Export berhasil (hanya admin yang bisa akses)";
    }
}