<x-app-layout> {{-- fungsinya untuk menggunakan layout utama aplikasi (navbar, sidebar, dll) --}}
    <x-slot name="header">  {{-- fungsinya untuk mengisi bagian header pada layout --}}
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"> {{-- fungsinya untuk menampilkan judul halaman --}}
            {{ __('Dashboard') }} {{-- fungsinya untuk menampilkan teks "Dashboard" (bisa multi bahasa) --}}
        </h2>
    </x-slot>

    <div class="py-12"> {{-- fungsinya untuk memberi jarak atas dan bawah halaman --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> {{-- fungsinya untuk membuat container agar konten rapi dan di tengah --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"> {{-- fungsinya untuk membuat card (kotak) dengan background, shadow, dan sudut rounded --}}
                <div class="p-6 text-gray-900 dark:text-gray-100">  {{-- fungsinya untuk memberi padding dan warna teks --}}
                    Role: {{ auth()->user()->role }} {{-- fungsinya untuk menampilkan role user yang sedang login --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
