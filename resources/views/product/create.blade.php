<x-app-layout>
    {{-- fungsinya untuk menggunakan layout utama dari Laravel (header, navbar, dll) --}}

    <div class="py-12">
        {{-- fungsinya untuk memberi jarak atas dan bawah halaman --}}

        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            {{-- fungsinya untuk membuat container form agar di tengah dan tidak terlalu lebar --}}

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                {{-- fungsinya untuk membuat card (kotak) dengan background, shadow, dan rounded --}}

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- fungsinya untuk memberi padding dan warna teks --}}

                    {{-- Header --}}
                    <div class="flex items-center gap-3 mb-6">
                        {{-- fungsinya untuk membuat header sejajar horizontal dengan jarak antar elemen --}}

                        <a href="{{ route('product.index') }}"
                           class="p-1.5 rounded-md text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                            {{-- fungsinya untuk tombol kembali ke halaman product --}}

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-5 w-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                {{-- fungsinya untuk icon panah kembali --}}
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>

                        <div>
                            {{-- fungsinya untuk menampung judul dan deskripsi --}}

                            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 tracking-tight">
                                Add Product
                            </h2>
                            {{-- fungsinya untuk menampilkan judul halaman --}}

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">
                                Fill in the details to add a new product
                            </p>
                            {{-- fungsinya untuk menampilkan deskripsi --}}
                        </div>
                    </div>

                    {{-- 🔥 ERROR GLOBAL --}}
                    @if ($errors->any())
                        {{-- fungsinya untuk mengecek apakah ada error validasi --}}
                        
                        <div class="mb-4 px-4 py-2 bg-red-100 text-red-700 rounded-lg text-sm">
                            {{-- fungsinya untuk menampilkan pesan error global --}}
                            Semua field wajib diisi dengan benar!
                        </div>
                    @endif

                    {{-- Form --}}
                    <form action="{{ route('product.store') }}" method="POST" class="space-y-5">
                        {{-- fungsinya untuk mengirim data ke route product.store dengan method POST --}}
                        @csrf {{-- fungsinya untuk keamanan form Laravel --}}

                        {{-- Name --}}
                        <div>
                            {{-- fungsinya untuk input nama produk --}}

                            <label class="block text-sm font-medium mb-1">
                                Product Name <span class="text-red-500">*</span>
                            </label>
                            {{-- fungsinya untuk label input --}}

                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="w-full px-4 py-2.5 rounded-lg border text-sm
                                   {{ $errors->has('name') ? 'border-red-400 bg-red-50 dark:bg-red-900/20' : 'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700' }}
                                    text-gray-900 dark:text-gray-100
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            {{-- fungsinya untuk input nama + mempertahankan value lama + menampilkan error style jika salah --}}

                            @error('name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                {{-- fungsinya untuk menampilkan pesan error pada field name --}}
                            @enderror
                        </div>

                        {{-- Quantity --}}
                        <div>
                            {{-- fungsinya untuk input jumlah produk --}}

                            <label class="block text-sm font-medium mb-1">
                                Quantity <span class="text-red-500">*</span>
                            </label>

                            <input type="number" name="quantity" value="{{ old('quantity') }}" min="0"
                                    class="w-full px-4 py-2.5 rounded-lg border text-sm
                                    {{ $errors->has('quantity') ? 'border-red-400 bg-red-50 dark:bg-red-900/20' : 'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700' }}
                                    text-gray-900 dark:text-gray-100
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            {{-- fungsinya untuk input angka quantity dengan validasi minimal 0 --}}

                            @error('quantity')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                {{-- fungsinya untuk menampilkan error quantity --}}
                            @enderror
                        </div>

                        {{-- Price --}}
                        <div>
                            {{-- fungsinya untuk input harga produk --}}

                            <label class="block text-sm font-medium mb-1">
                                Price (Rp) <span class="text-red-500">*</span>
                            </label>

                            <input type="number" name="price" value="{{ old('price') }}"
                                    class="w-full px-4 py-2.5 rounded-lg border text-sm
                                    {{ $errors->has('price') ? 'border-red-400 bg-red-50 dark:bg-red-900/20' : 'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700' }}
                                    text-gray-900 dark:text-gray-100
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            {{-- fungsinya untuk input harga dalam bentuk angka --}}

                            @error('price')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                {{-- fungsinya untuk menampilkan error price --}}
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div>
                            {{-- fungsinya untuk memilih kategori produk --}}

                            <label class="block text-sm font-medium mb-1">
                                Category <span class="text-red-500">*</span>
                            </label>

                            <select name="category_id"
                                    class="w-full px-4 py-2.5 rounded-lg border text-sm
                                    {{ $errors->has('category_id') ? 'border-red-400 bg-red-50 dark:bg-red-900/20' : 'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700' }}
                                    text-gray-900 dark:text-gray-100
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                {{-- fungsinya untuk dropdown kategori --}}

                                <option value="">Pilih Kategori</option>
                                {{-- fungsinya untuk default option --}}

                                @foreach($categories as $cat)
                                    {{-- fungsinya untuk looping data kategori dari database --}}
                                    
                                    <option value="{{ $cat->id }}"
                                        {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{-- fungsinya untuk menyimpan pilihan sebelumnya --}}
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('category_id')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                {{-- fungsinya untuk menampilkan error category --}}
                            @enderror
                        </div>

                        {{-- Actions --}}
                        <div class="flex justify-end gap-3 pt-2">
                            {{-- fungsinya untuk tombol aksi di kanan (cancel & submit) --}}

                            <a href="{{ route('product.index') }}"
                               class="px-4 py-2 rounded-lg border text-sm">
                                {{-- fungsinya untuk tombol batal kembali ke halaman product --}}
                                Cancel
                            </a>

                            <button type="submit"
                                    class="px-5 py-2 bg-indigo-600 text-white rounded-lg text-sm">
                                {{-- fungsinya untuk submit form --}}
                                Save Product
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>