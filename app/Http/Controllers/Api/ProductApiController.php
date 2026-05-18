<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $product = Product::with('category')->get();

            return response()->json([
                'message' => 'Data product berhasil diambil',
                'data' => $product
            ], 200);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil product', [
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'name' => 'required',
                'quantity' => 'required',
                'price' => 'required',
                'category_id' => 'required'
            ]);

            $validated['user_id'] = Auth::id();

            $product = Product::create($validated);

            Log::info('Menambah data produk', [
                'list' => $product
            ]);

            return response()->json([
                'message' => 'Produk berhasil ditambahkan',
                'data' => $product,
            ], 201);

        } catch (\Throwable $e) {

            Log::error('Error saat menambah product', [
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $product = Product::with('category')->find($id);

            if (!$product) {

                return response()->json([
                    'message' => 'Product tidak ditemukan',
                ], 404);
            }

            return response()->json([
                'message' => 'Product berhasil ditemukan',
                'data' => $product
            ], 200);

        } catch (\Throwable $e) {

            Log::error('Gagal mengambil data product', [
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $product = Product::find($id);

            if (!$product) {

                return response()->json([
                    'message' => 'Product tidak ditemukan'
                ], 404);
            }

            $validated = $request->validate([
                'name' => 'required',
                'quantity' => 'required',
                'price' => 'required',
                'category_id' => 'required'
            ]);

            $product->update($validated);

            return response()->json([
                'message' => 'Product berhasil diupdate',
                'data' => $product
            ], 200);

        } catch (\Throwable $e) {

            Log::error('Gagal update product', [
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $product = Product::find($id);

            if (!$product) {

                return response()->json([
                    'message' => 'Product tidak ditemukan'
                ], 404);
            }

            $product->delete();

            return response()->json([
                'message' => 'Product berhasil dihapus'
            ], 200);

        } catch (\Throwable $e) {

            Log::error('Gagal menghapus product', [
                'message' => $e->getMessage()
            ]);
        }
    }
}