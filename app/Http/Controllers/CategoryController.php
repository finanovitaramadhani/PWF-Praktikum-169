<?php

namespace App\Http\Controllers; 
// Menentukan namespace (lokasi file controller dalam struktur Laravel)

use Illuminate\Http\Request; 
// Menggunakan class Request untuk menangani input dari user (form, dll)

use App\Models\Category; 
// Menghubungkan controller dengan model Category (database tabel categories)

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data category + menghitung jumlah relasi product tiap category
        $categories = Category::withCount('products')->get();

        // Mengirim data $categories ke view category.index
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan halaman form tambah category
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input:
        // - name wajib diisi
        // - name harus unik di tabel categories
        $request->validate([
            'name' => 'required|unique:categories'
        ]);

        // Menyimpan data category baru ke database
        Category::create([
            'name' => $request->name
        ]);

        // Redirect ke halaman index + kirim pesan sukses
        return redirect()->route('category.index')
                         ->with('success', 'Category berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Mencari data category berdasarkan ID
        // Jika tidak ditemukan, otomatis error 404
        $category = Category::findOrFail($id);

        // Menampilkan halaman edit + mengirim data category
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Ambil data category berdasarkan ID
        $category = Category::findOrFail($id);

        // Validasi:
        // - name wajib
        // - name harus unik, kecuali untuk data yang sedang diedit
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id
        ]);

        // Update data category di database
        $category->update([
            'name' => $request->name
        ]);

        // Redirect kembali ke index + pesan sukses
        return redirect()->route('category.index')
                         ->with('success', 'Category berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Ambil data category berdasarkan ID
        $category = Category::findOrFail($id);

        // Menghapus data category dari database
        $category->delete();

        // Redirect ke halaman index + pesan sukses
        return redirect()->route('category.index')
                         ->with('success', 'Category berhasil dihapus');
    }
}