<?php

namespace App\Http\Requests; 
// Namespace untuk Form Request (digunakan untuk validasi input di Laravel)

use Illuminate\Foundation\Http\FormRequest; 
// Menggunakan class FormRequest bawaan Laravel

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Menentukan apakah user boleh melakukan request ini
        // true = semua user boleh akses
        return true;
    }

    /**
     * Rules validasi untuk STORE
     */
    public function rules(): array
    {
        // Aturan validasi input dari form
        return [
            // name wajib, harus string, maksimal 255 karakter
            'name' => 'required|string|max:255',

            // quantity wajib, harus angka bulat, minimal 0 (tidak boleh negatif)
            'quantity' => 'required|integer|min:0',

            // price wajib, harus angka (boleh desimal), minimal 0
            'price' => 'required|numeric|min:0',

            // category_id wajib dan harus ada di tabel categories kolom id
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        // Custom pesan error untuk setiap validasi
        return [
            // VALIDASI NAME
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',

            // VALIDASI QUANTITY
            'quantity.required' => 'Jumlah produk wajib diisi.',
            'quantity.integer' => 'Jumlah produk harus berupa angka bulat.',
            'quantity.min' => 'Jumlah produk tidak boleh negatif.',

            // VALIDASI PRICE
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga produk harus berupa angka.',
            'price.min' => 'Harga produk tidak boleh negatif.',

            // VALIDASI CATEGORY
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori tidak valid.',
        ];
    }
}