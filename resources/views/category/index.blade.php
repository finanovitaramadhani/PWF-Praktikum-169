<x-app-layout> {{-- Layout utama dari Laravel Breeze / Jetstream --}}

    <div class="min-h-screen bg-gradient-to-b from-[#0f172a] to-[#020617] py-12">
        {{--
            min-h-screen = tinggi full layar
            bg-gradient-to-b = background gradasi atas ke bawah
            from = warna awal
            to = warna akhir
            py-12 = padding atas & bawah
        --}}

        <div class="max-w-6xl mx-auto px-6">
            {{--
                max-w-6xl = lebar maksimal container
                mx-auto = posisi tengah horizontal
                px-6 = padding kiri kanan
            --}}

            {{-- CARD --}}
            <div class="bg-[#1e293b]/80 backdrop-blur-xl rounded-2xl shadow-xl p-6">
                {{--
                    bg = warna card transparan
                    backdrop-blur = efek glass
                    rounded-2xl = sudut melengkung
                    shadow-xl = bayangan
                    p-6 = padding dalam
                --}}

                {{-- HEADER --}}
                <div class="flex justify-between items-center mb-6">
                    {{--
                        flex = layout sejajar
                        justify-between = kiri & kanan
                        items-center = rata tengah vertikal
                        mb-6 = margin bawah
                    --}}

                    <div>
                        <h2 class="text-lg font-semibold text-white">
                            {{-- Judul halaman --}}
                            Category List
                        </h2>

                        <p class="text-sm text-gray-400">
                            {{-- Subjudul/deskripsi --}}
                            Manage your category
                        </p>
                    </div>

                    <a href="{{ route('category.create') }}"
                       class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm shadow-lg shadow-indigo-500/20">
                        {{--
                            route('category.create') = menuju halaman tambah category
                            tombol untuk create data baru
                        --}}
                        + Add Category
                    </a>
                </div>

                {{-- TABLE --}}
                <div class="overflow-hidden rounded-xl border border-gray-700">
                    {{--
                        overflow-hidden = agar isi tidak keluar dari border
                        rounded-xl = sudut tabel
                        border = garis tabel
                    --}}

                    <table class="w-full text-sm text-gray-300">
                        {{--
                            w-full = lebar penuh
                            text-sm = ukuran teks kecil
                            text-gray-300 = warna teks default
                        --}}

                        {{-- HEADER TABLE --}}
                        <thead class="bg-[#334155] text-gray-400 uppercase text-xs">
                            {{--
                                bg = background header tabel
                                uppercase = huruf besar semua
                                text-xs = ukuran kecil
                            --}}
                            <tr>
                                <th class="px-5 py-3 text-left w-12">
                                    {{-- Kolom nomor --}}
                                    1
                                </th>

                                <th class="px-5 py-3 text-left">
                                    {{-- Kolom nama category --}}
                                    Name
                                </th>

                                <th class="px-5 py-3 text-left">
                                    {{-- Kolom jumlah produk --}}
                                    Total Product
                                </th>

                                <th class="px-5 py-3 text-center">
                                    {{-- Kolom aksi --}}
                                    Action
                                </th>
                            </tr>
                        </thead>

                        {{-- BODY --}}
                        <tbody class="divide-y divide-gray-700">
                            {{--
                                divide-y = garis antar baris
                                divide-gray-700 = warna garis
                            --}}

                            @forelse($categories as $index => $category)
                                {{-- 
                                    loop data categories
                                    $index = nomor urutan
                                    $category = data category
                                --}}

                                <tr class="hover:bg-white/5 transition">
                                    {{-- efek hover pada baris --}}

                                    <td class="px-5 py-4 text-gray-500">
                                        {{-- nomor urut --}}
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-5 py-4 text-gray-200">
                                        {{-- menampilkan nama category --}}
                                        {{ $category->name }}
                                    </td>

                                    <td class="px-5 py-4 text-gray-400">
                                        {{-- jumlah produk (relasi count) --}}
                                        {{ $category->products_count }}
                                    </td>

                                    <td class="px-5 py-4">
                                        <div class="flex justify-center gap-4">
                                            {{-- tombol aksi sejajar dan di tengah --}}

                                            {{-- EDIT --}}
                                            <a href="{{ route('category.edit', $category->id) }}"
                                               class="text-gray-400 hover:text-indigo-400 transition">
                                                {{-- 
                                                    menuju halaman edit category
                                                    parameter id dikirim
                                                --}}
                                                ✏️
                                            </a>

                                            {{-- DELETE --}}
                                            <form action="{{ route('category.destroy', $category->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin hapus?')">
                                                {{--
                                                    form delete data
                                                    confirm() = konfirmasi sebelum hapus
                                                --}}

                                                @csrf {{-- keamanan --}}
                                                @method('DELETE') {{-- method spoofing ke DELETE --}}

                                                <button class="text-gray-400 hover:text-red-500 transition">
                                                    {{-- tombol hapus --}}
                                                    🗑️
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @empty
                                {{-- jika data kosong --}}
                                <tr>
                                    <td colspan="4"
                                        class="text-center py-10 text-gray-500">
                                        Tidak ada data category
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>