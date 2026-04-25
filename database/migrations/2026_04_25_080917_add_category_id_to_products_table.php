<?php

use Illuminate\Database\Migrations\Migration; 
// Class dasar untuk migration (perubahan struktur database)

use Illuminate\Database\Schema\Blueprint; 
// Digunakan untuk mendefinisikan kolom tabel

use Illuminate\Support\Facades\Schema; 
// Digunakan untuk manipulasi tabel database

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Method untuk MENAMBAH / MENGUBAH struktur tabel
        Schema::table('products', function (Blueprint $table) {

            // Menambahkan kolom foreign key 'category_id'
            $table->foreignId('category_id')

                  // Boleh kosong (nullable)
                  ->nullable()

                  // Posisi kolom setelah 'user_id'
                  ->after('user_id')

                  // Menghubungkan ke tabel 'categories' kolom 'id'
                  ->constrained('categories')

                  // Jika category dihapus, maka product ikut terhapus
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Method untuk MENGEMBALIKAN perubahan (rollback)
        Schema::table('products', function (Blueprint $table) {

            // Menghapus relasi foreign key terlebih dahulu
            $table->dropForeign(['category_id']);

            // Menghapus kolom category_id
            $table->dropColumn('category_id');
        });
    }
};