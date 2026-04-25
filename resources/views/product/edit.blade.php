<x-app-layout>
    {{-- fungsinya untuk menggunakan layout utama aplikasi (navbar, dll) --}}

    <div class="py-12">
        {{-- fungsinya untuk memberi jarak atas dan bawah halaman --}}

        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            {{-- fungsinya untuk membuat container agar form berada di tengah dan rapi --}}

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                {{-- fungsinya untuk membuat card dengan background, shadow, dan sudut rounded --}}

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- fungsinya untuk memberi padding dan warna teks --}}

                    {{-- Header --}}
                    <div class="flex items-center gap-3 mb-6">
                        {{-- fungsinya untuk membuat header sejajar horizontal --}}

                        <a href="{{ route('product.show', $product) }}"
                           class="p-1.5 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition">
                            {{-- fungsinya untuk tombol kembali ke halaman detail product --}}
                            ←
                        </a>

                        <div>
                            {{-- fungsinya untuk menampung judul dan deskripsi --}}

                            <h2 class="text-xl font-bold">
                                Edit Product
                            </h2>
                            {{-- fungsinya untuk menampilkan judul halaman --}}

                            <p class="text-sm text-gray-500">
                                Update {{ $product->name }}
                            </p>
                            {{-- fungsinya untuk menampilkan nama product yang sedang diedit --}}
                        </div>
                    </div>

                    {{-- ERROR DARI isDirty --}}
                    @if (session('error'))
                        {{-- fungsinya untuk menampilkan error dari proses update (misalnya data tidak berubah) --}}
                        <div class="mb-4 px-4 py-2 bg-red-100 text-red-700 rounded-lg text-sm">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- ERROR GLOBAL --}}
                    @if ($errors->any())
                        {{-- fungsinya untuk mengecek apakah ada error validasi --}}
                        <div class="mb-4 px-4 py-2 bg-red-100 text-red-700 rounded-lg text-sm">
                            Semua field wajib diisi dengan benar!
                        </div>
                    @endif

                    {{-- Delete Form --}}
                    <form id="delete-product-form"
                          action="{{ route('product.delete', $product->id) }}"
                          method="POST">
                        {{-- fungsinya untuk form khusus delete product --}}
                        @csrf {{-- fungsinya untuk keamanan --}}
                        @method('DELETE') {{-- fungsinya untuk mengubah method menjadi DELETE --}}
                    </form>

                    {{-- Form --}}
                    <form action="{{ route('product.update', $product) }}"
                          method="POST"
                          class="space-y-5">
                        {{-- fungsinya untuk form update product --}}
                        @csrf {{-- fungsinya untuk keamanan --}}
                        @method('PUT') {{-- fungsinya untuk method update --}}

                        {{-- Name --}}
                        <div>
                            {{-- fungsinya untuk input nama product --}}

                            <label class="block text-sm font-medium mb-1">
                                Product Name *
                            </label>

                            <input type="text"
                                    name="name"
                                    value="{{ old('name', $product->name) }}"
                                    class="w-full px-4 py-2.5 rounded-lg border text-sm
                                    {{ $errors->has('name') ? 'border-red-400 bg-red-50 dark:bg-red-900/20' : 'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700' }}
                                    text-gray-900 dark:text-gray-100
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            {{-- fungsinya untuk input nama + menampilkan value lama + value dari database --}}

                            @error('name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                {{-- fungsinya untuk menampilkan error name --}}
                            @enderror
                        </div>

                        {{-- Quantity --}}
                        <div>
                            {{-- fungsinya untuk input jumlah product --}}

                            <label class="block text-sm font-medium mb-1">
                                Quantity *
                            </label>

                            <input type="number"
                                    name="quantity"
                                    value="{{ old('quantity', $product->quantity) }}"
                                    min="0"
                                    class="w-full px-4 py-2.5 rounded-lg border text-sm
                                    {{ $errors->has('quantity') ? 'border-red-400 bg-red-50 dark:bg-red-900/20' : 'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700' }}
                                    text-gray-900 dark:text-gray-100
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            {{-- fungsinya untuk input quantity dengan nilai default dari database --}}

                            @error('quantity')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                {{-- fungsinya untuk menampilkan error quantity --}}
                            @enderror
                        </div>

                        {{-- Price --}}
                        <div>
                            {{-- fungsinya untuk input harga product --}}

                            <label class="block text-sm font-medium mb-1">
                                Price (Rp) *
                            </label>

                            <input type="number"
                                    name="price"
                                    value="{{ old('price', $product->price) }}"
                                    class="w-full px-4 py-2.5 rounded-lg border text-sm
                                    {{ $errors->has('price') ? 'border-red-400 bg-red-50 dark:bg-red-900/20' : 'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700' }}
                                    text-gray-900 dark:text-gray-100
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            {{-- fungsinya untuk input harga dengan nilai lama atau dari database --}}

                            @error('price')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                {{-- fungsinya untuk menampilkan error price --}}
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div>
                            {{-- fungsinya untuk memilih kategori product --}}

                            <label class="block text-sm font-medium mb-1">
                                Category *
                            </label>

                            <select name="category_id"
                                    class="w-full px-4 py-2.5 rounded-lg border text-sm
                                    {{ $errors->has('category_id') ? 'border-red-400 bg-red-50 dark:bg-red-900/20' : 'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700' }}
                                    text-gray-900 dark:text-gray-100
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                {{-- fungsinya untuk dropdown kategori --}}

                                @foreach($categories as $cat)
                                    {{-- fungsinya untuk looping data kategori --}}
                                    
                                    <option value="{{ $cat->id }}"
                                        {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                        {{-- fungsinya untuk memilih kategori sesuai data product --}}
                                        {{ $cat->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        {{-- Actions --}}
                        <div class="flex justify-between pt-2">
                            {{-- fungsinya untuk mengatur posisi tombol kiri dan kanan --}}

                            {{-- Delete --}}
                            <button type="submit"
                                    form="delete-product-form"
                                    onclick="return confirm('Are you sure?')"
                                    class="text-red-500 text-sm">
                                {{-- fungsinya untuk tombol hapus product dengan konfirmasi --}}
                                🗑 Delete
                            </button>

                            <div class="flex gap-3">
                                {{-- fungsinya untuk mengelompokkan tombol kanan --}}

                                <a href="{{ route('product.show', $product) }}"
                                   class="px-4 py-2 border rounded text-sm">
                                    {{-- fungsinya untuk tombol cancel --}}
                                    Cancel
                                </a>

                                <button type="submit"
                                        class="px-5 py-2 bg-indigo-600 text-white rounded text-sm">
                                    {{-- fungsinya untuk tombol update product --}}
                                    Update
                                </button>
                            </div>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>