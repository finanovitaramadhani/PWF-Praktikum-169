<x-app-layout> {{-- fungsinya untuk menggunakan layout utama aplikasi (navbar, dll) --}}
    <div class="py-12"> {{-- fungsinya untuk memberi jarak atas dan bawah halaman --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> {{-- fungsinya untuk membuat container lebar agar tabel muat banyak data --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"> {{-- fungsinya untuk membuat card dengan background, shadow, dan border radius --}}
                <div class="p-6 text-gray-900 dark:text-gray-100"> {{-- fungsinya untuk memberi padding dan warna teks --}}

                    {{-- Header --}}
                    <div class="flex items-center justify-between mb-6"> {{-- fungsinya untuk membuat header kiri (judul) dan kanan (button) sejajar --}}
                        <div> {{-- fungsinya untuk menampung judul dan deskripsi --}}
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 tracking-tight">
                                Product List
                            </h2>
                            {{-- fungsinya untuk menampilkan judul halaman --}}
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Manage your product inventory
                            </p>
                            {{-- fungsinya untuk deskripsi halaman --}}
                        </div>

                        @if(auth()->user()->role === 'admin')
                        {{-- fungsinya untuk menampilkan tombol tambah hanya jika user adalah admin --}}
                            <x-add-product :url="route('product.create')" :name="'Product'" /> {{-- fungsinya untuk tombol tambah product (komponen reusable) --}}
                        @endif
                    </div>

                    {{-- Flash Message --}}
                    @if (session('success')) 
                    {{-- fungsinya untuk menampilkan pesan sukses setelah aksi (create/update/delete) --}}
                        <div class="mb-4 px-4 py-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 text-green-700 dark:text-green-300 rounded-lg text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Table --}}
                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                        {{-- fungsinya untuk membuat tabel bisa scroll horizontal jika penuh --}}
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                            {{-- fungsinya untuk tabel utama data product --}}
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                {{-- fungsinya untuk header tabel --}}
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider w-8"> {{-- fungsinya untuk nomor urut --}}
                                        #
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider"> {{-- fungsinya untuk kolom nama product --}}
                                        Name
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider"> {{-- fungsinya untuk kolom jumlah --}}
                                        Quantity
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider"> {{-- fungsinya untuk kolom harga --}}
                                        Price
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider"> {{-- fungsinya untuk kolom kategori --}}
                                        Category
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider"> {{-- fungsinya untuk kolom pemilik product --}}
                                        Owner
                                    </th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider"> {{-- fungsinya untuk kolom aksi (view/edit/delete) --}}
                                        Actions
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700"> {{-- fungsinya untuk isi tabel --}}
                                @forelse ($products as $product)  {{-- fungsinya untuk looping data product --}}
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition duration-150"> {{-- fungsinya untuk efek hover pada baris --}}
                                        <td class="px-6 py-4 text-gray-400 dark:text-gray-500"> {{-- fungsinya untuk menampilkan nomor urut --}}
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 py-4 font-medium text-gray-800 dark:text-gray-100">{{-- fungsinya untuk menampilkan nama product --}}
                                            {{ $product->name }}
                                        </td>

                                        {{-- fungsinya untuk menampilkan quantity dengan warna (hijau = banyak, merah = sedikit) --}}
                                        <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $product->quantity > 10 ? 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-300' }}">
                                                {{ $product->quantity }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 text-gray-700 dark:text-gray-200 font-mono"> {{-- fungsinya untuk menampilkan harga dengan format rupiah --}}
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-500 dark:text-gray-400"> {{-- fungsinya untuk menampilkan nama kategori --}}
                                            {{ $product->category->name ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-500 dark:text-gray-400"> {{-- fungsinya untuk menampilkan pemilik product --}}
                                            {{ $product->user->name ?? '-' }}
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center gap-2"> {{-- fungsinya untuk menampung tombol aksi --}}

                                                {{-- View --}}
                                                {{-- fungsinya untuk melihat detail product --}}
                                                <a href="{{ route('product.show', $product->id) }}"
                                                   class="p-1.5 rounded-md text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 transition"
                                                   title="View">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="h-4 w-4"
                                                         fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke="currentColor">
                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M2.458 12C3.732 7.943 7.523 5 12 5
                                                                 c4.477 0 8.268 2.943 9.542 7
                                                                 -1.274 4.057-5.065 7-9.542 7
                                                                 -4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                </a>

                                                {{-- Edit --}}
                                                {{-- fungsinya untuk menampilkan tombol edit jika punya izin --}}
                                                @can('update', $product)
                                                    <a href="{{ route('product.edit', $product) }}"
                                                        class="p-1.5 rounded-md text-gray-400 hover:text-amber-600 hover:bg-amber-50 dark:hover:bg-amber-900/30 transition"
                                                        title="Edit">
                                                        ✏️
                                                    </a>
                                                @endcan

                                                {{-- Delete --}}
                                                {{-- fungsinya untuk menampilkan tombol delete jika punya izin --}}
                                                @can('delete', $product)
                                                    <form action="{{ route('product.delete', $product->id) }}" method="POST"
                                                            onsubmit="return confirm('Delete this product?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="p-1.5 rounded-md text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/30 transition"
                                                                title="Delete">
                                                            🗑️
                                                        </button>
                                                    </form>
                                                @endcan

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
                                            class="px-6 py-12 text-center text-gray-500 dark:text-gray-400"> {{-- fungsinya untuk menampilkan pesan jika tidak ada data --}}
                                            No products found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    {{-- fungsinya untuk menampilkan pagination jika data banyak --}}
                    @if ($products->hasPages())
                        <div class="mt-4">
                            {{ $products->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>