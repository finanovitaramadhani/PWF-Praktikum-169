<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryApiController extends Controller
{
    // GET ALL
    public function index()
    {
        try {
            $category = Category::all();

            return response()->json([
                'message' => 'Data category berhasil diambil',
                'data' => $category
            ], 200);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil category', [
                'message' => $e->getMessage()
            ]);
        }
    }

    // POST
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required'
            ]);

            $category = Category::create($validated);

            return response()->json([
                'message' => 'Category berhasil ditambahkan',
                'data' => $category
            ], 201);

        } catch (\Throwable $e) {
            Log::error('Gagal menambah category', [
                'message' => $e->getMessage()
            ]);
        }
    }

    // GET BY ID
    public function show($id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                    'message' => 'Category tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'message' => 'Detail category',
                'data' => $category
            ], 200);

        } catch (\Throwable $e) {
            Log::error('Gagal mengambil detail category', [
                'message' => $e->getMessage()
            ]);
        }
    }

    // PUT
    public function update(Request $request, $id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                    'message' => 'Category tidak ditemukan'
                ], 404);
            }

            $validated = $request->validate([
                'name' => 'required'
            ]);

            $category->update($validated);

            return response()->json([
                'message' => 'Category berhasil diupdate',
                'data' => $category
            ], 200);

        } catch (\Throwable $e) {
            Log::error('Gagal update category', [
                'message' => $e->getMessage()
            ]);
        }
    }

    // DELETE
    public function destroy($id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                    'message' => 'Category tidak ditemukan'
                ], 404);
            }

            $category->delete();

            return response()->json([
                'message' => 'Category berhasil dihapus'
            ], 200);

        } catch (\Throwable $e) {
            Log::error('Gagal menghapus category', [
                'message' => $e->getMessage()
            ]);
        }
    }
}