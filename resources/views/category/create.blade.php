<x-app-layout> {{-- Komponen layout utama dari Laravel Breeze/Jetstream (template dasar halaman) --}}

    <div class="min-h-screen bg-[#0f172a] flex items-center justify-center p-6">
        {{-- 
            min-h-screen = tinggi minimal 1 layar penuh
            bg-[#0f172a] = warna background gelap
            flex = menggunakan flexbox
            items-center = posisi vertikal tengah
            justify-center = posisi horizontal tengah
            p-6 = padding 6
        --}}
        
        <div class="w-full max-w-2xl bg-[#1e293b] rounded-2xl p-8 border border-slate-700/50 shadow-2xl">
            {{-- 
                w-full = lebar penuh
                max-w-2xl = batas maksimal lebar
                bg-[#1e293b] = warna card
                rounded-2xl = sudut melengkung
                p-8 = padding dalam
                border = garis tepi
                shadow-2xl = bayangan
            --}}
            
            {{-- Header dengan Tombol Back --}}
            <div class="flex items-center gap-4 mb-8">
                {{-- 
                    flex = layout sejajar
                    items-center = rata tengah vertikal
                    gap-4 = jarak antar elemen
                    mb-8 = margin bawah
                --}}

                <a href="{{ route('category.index') }}" 
                   class="text-slate-400 hover:text-white transition-colors">
                    {{-- 
                        route('category.index') = menuju halaman daftar category
                        text-slate-400 = warna teks default
                        hover:text-white = berubah putih saat hover
                        transition-colors = animasi perubahan warna
                    --}}

                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="h-6 w-6" 
                         fill="none" 
                         viewBox="0 0 24 24" 
                         stroke="currentColor">
                        {{-- 
                            SVG icon panah kiri
                            h-6 w-6 = ukuran icon
                        --}}

                        <path stroke-linecap="round" 
                              stroke-linejoin="round" 
                              stroke-width="2" 
                              d="M15 19l-7-7 7-7" />
                        {{-- path = bentuk panah kiri --}}
                    </svg>
                </a>

                <h2 class="text-2xl font-bold text-white">
                    {{-- 
                        text-2xl = ukuran besar
                        font-bold = teks tebal
                        text-white = warna putih
                    --}}
                    Add Category {{-- Judul halaman --}}
                </h2>
            </div>

            <form action="{{ route('category.store') }}" method="POST">
                {{-- 
                    form = untuk input data
                    route('category.store') = tujuan ke controller method store
                    method POST = mengirim data ke server
                --}}

                @csrf {{-- token keamanan Laravel untuk mencegah CSRF (WAJIB di form POST) --}}
                
                {{-- Field Input --}}
                <div class="mb-8">
                    {{-- mb-8 = margin bawah --}}

                    <label class="block text-sm font-medium text-slate-400 mb-2">
                        {{-- 
                            block = tampil satu baris penuh
                            text-sm = ukuran kecil
                            font-medium = ketebalan sedang
                            text-slate-400 = warna abu
                            mb-2 = jarak bawah
                        --}}
                        Category {{-- teks label --}}
                    </label>

                    <input type="text" 
                           name="name" {{-- name = key data yang dikirim ke controller --}}
                           placeholder="Electronic" {{-- placeholder = contoh input --}}
                           
                           class="w-full 
                                  bg-[#0f172a] 
                                  border border-slate-700 
                                  text-white 
                                  rounded-lg 
                                  px-4 py-3 
                                  focus:outline-none 
                                  focus:ring-2 focus:ring-indigo-500 
                                  focus:border-transparent 
                                  transition-all 
                                  placeholder-slate-600">
                    {{-- 
                        w-full = lebar penuh
                        bg = warna background input
                        border = garis input
                        text-white = teks putih
                        rounded-lg = sudut melengkung
                        px-4 py-3 = padding dalam
                        focus:ring = efek saat diklik
                        transition-all = animasi
                        placeholder-slate-600 = warna placeholder
                    --}}
                    
                    @error('name') {{-- cek jika ada error validasi untuk field name --}}
                        <p class="text-red-500 text-xs mt-2">
                            {{ $message }} {{-- menampilkan pesan error --}}
                        </p>
                    @enderror
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end gap-3">
                    {{-- 
                        flex = layout sejajar
                        justify-end = rata kanan
                        gap-3 = jarak antar tombol
                    --}}

                    <a href="{{ route('category.index') }}" 
                       class="px-6 py-2.5 
                              rounded-lg 
                              border border-slate-700 
                              text-slate-300 
                              hover:bg-slate-800 
                              transition-colors 
                              font-medium text-sm">
                        {{-- 
                            tombol Cancel:
                            kembali ke halaman index tanpa submit
                        --}}
                        Cancel
                    </a>

                    <button type="submit" 
                            class="px-6 py-2.5 
                                   rounded-lg 
                                   bg-[#5850ec] 
                                   hover:bg-[#4d45d1] 
                                   text-white 
                                   font-semibold text-sm 
                                   transition-all 
                                   shadow-lg shadow-indigo-500/20">
                        {{-- 
                            type="submit" = mengirim form
                            tombol ini akan menjalankan controller (store)
                        --}}
                        Save Category
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>