<x-app-layout> {{-- Layout utama dari Laravel Breeze / Jetstream (template halaman) --}}

    <div class="min-h-screen bg-gradient-to-b from-[#0f172a] to-[#020617] flex items-center justify-center">
        {{-- 
            min-h-screen = tinggi full layar
            bg-gradient-to-b = background gradasi dari atas ke bawah
            from-[#0f172a] = warna awal (atas)
            to-[#020617] = warna akhir (bawah)
            flex = menggunakan flexbox
            items-center = posisi vertikal tengah
            justify-center = posisi horizontal tengah
        --}}

        <div class="w-full max-w-2xl px-6">
            {{-- 
                w-full = lebar penuh
                max-w-2xl = batas maksimal lebar container
                px-6 = padding kiri & kanan
            --}}
            
            {{-- CARD --}}
            <div class="bg-[#1e293b]/80 backdrop-blur-xl rounded-2xl shadow-xl p-8">
                {{-- 
                    bg-[#1e293b]/80 = warna card + transparansi (opacity 80%)
                    backdrop-blur-xl = efek blur background (glass effect)
                    rounded-2xl = sudut melengkung
                    shadow-xl = bayangan
                    p-8 = padding dalam
                --}}

                {{-- HEADER --}}
                <div class="flex items-center gap-3 mb-6">
                    {{-- 
                        flex = layout sejajar
                        items-center = rata tengah vertikal
                        gap-3 = jarak antar elemen
                        mb-6 = margin bawah
                    --}}

                    <a href="{{ route('category.index') }}"
                       class="text-gray-400 hover:text-white transition">
                        {{-- 
                            route('category.index') = kembali ke halaman list category
                            text-gray-400 = warna default
                            hover:text-white = berubah saat hover
                            transition = animasi halus
                        --}}
                        ← {{-- simbol panah kiri --}}
                    </a>

                    <h2 class="text-xl font-semibold text-white">
                        {{-- 
                            text-xl = ukuran judul
                            font-semibold = sedikit tebal
                            text-white = warna putih
                        --}}
                        Add Category {{-- Judul halaman --}}
                    </h2>
                </div>

                {{-- FORM --}}
                <form action="{{ route('category.store') }}" method="POST" class="space-y-6">
                    {{-- 
                        action = tujuan ke controller (method store)
                        method POST = kirim data
                        space-y-6 = jarak antar elemen dalam form
                    --}}

                    @csrf {{-- token keamanan Laravel (WAJIB untuk POST) --}}

                    {{-- INPUT --}}
                    <div>
                        <label class="block text-sm text-gray-400 mb-2">
                            {{-- 
                                block = satu baris penuh
                                text-sm = ukuran kecil
                                text-gray-400 = warna abu
                                mb-2 = jarak bawah
                            --}}
                            Category
                        </label>

                        <input type="text"
                               name="name" {{-- nama field yang dikirim ke database --}}
                               placeholder="Electronic" {{-- contoh isi input --}}
                               class="w-full px-4 py-3 rounded-lg bg-[#0f172a] border border-gray-700 text-white
                               focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        {{-- 
                            w-full = lebar penuh
                            px-4 py-3 = padding dalam
                            rounded-lg = sudut melengkung
                            bg = background input
                            border = garis input
                            text-white = warna teks
                            focus:ring = efek saat diklik
                        --}}

                        {{-- ERROR VALIDATION (DITARUH DI SINI) --}}
                        @error('name') {{-- cek jika validasi gagal --}}
                            <p class="text-red-500 text-xs mt-2">
                                {{ $message }} {{-- menampilkan pesan error --}}
                            </p>
                        @enderror
                    </div>

                    {{-- BUTTON --}}
                    <div class="flex justify-end gap-3 pt-2">
                        {{-- 
                            flex = layout sejajar
                            justify-end = rata kanan
                            gap-3 = jarak antar tombol
                            pt-2 = padding atas
                        --}}

                        <a href="{{ route('category.index') }}"
                           class="px-4 py-2 rounded-lg border border-gray-600 text-gray-300 hover:bg-gray-700 transition">
                            {{-- 
                                tombol Cancel:
                                kembali ke halaman index tanpa submit
                            --}}
                            Cancel
                        </a>

                        <button type="submit"
                                class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition">
                            {{-- 
                                type submit = mengirim data form ke controller
                                bg-indigo-600 = warna tombol
                                hover:bg-indigo-700 = efek hover
                            --}}
                            Save Category
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
</x-app-layout>