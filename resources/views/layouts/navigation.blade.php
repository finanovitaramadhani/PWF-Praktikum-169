<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    {{-- fungsinya untuk membuat state (open) menggunakan Alpine.js untuk mengatur buka/tutup menu mobile --}}

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- fungsinya untuk membuat container navbar agar rapi, terpusat, dan responsive --}}

        <div class="flex justify-between h-16">
            {{-- fungsinya untuk mengatur layout navbar menjadi horizontal dan memberi tinggi navbar --}}

            <div class="flex">
                {{-- fungsinya untuk mengelompokkan bagian kiri (logo dan menu) --}}

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    {{-- fungsinya untuk menampilkan logo agar tidak mengecil dan posisinya di tengah vertikal --}}
                    
                    <a href="{{ route('dashboard') }}">
                        {{-- fungsinya untuk mengarahkan ke halaman dashboard saat logo diklik --}}
                        
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                        {{-- fungsinya untuk menampilkan komponen logo aplikasi --}}
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    {{-- fungsinya untuk menampilkan menu navigasi (hanya di desktop, disembunyikan di mobile) --}}

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{-- fungsinya untuk membuat link ke dashboard dan menandai jika sedang aktif --}}
                        {{ __('Dashboard') }} {{-- fungsinya untuk menampilkan teks Dashboard --}}
                    </x-nav-link>

                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
                        {{-- fungsinya untuk membuat link ke halaman About --}}
                        {{ __('About') }}
                    </x-nav-link>

                    <x-nav-link :href="route('product.index')" :active="request()->routeIs('product.*')">
                        {{-- fungsinya untuk membuat link ke halaman Product --}}
                        {{ __('Product') }}
                    </x-nav-link>

                    @can('isAdmin')
                    {{-- fungsinya untuk membatasi menu hanya tampil untuk user dengan role admin --}}
                    
                    <x-nav-link :href="route('category.index')" :active="request()->routeIs('category.*')">
                        {{-- fungsinya untuk membuat link ke halaman Category --}}
                        {{ __('Category') }}
                    </x-nav-link>
                    @endcan
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                {{-- fungsinya untuk menampilkan dropdown user di bagian kanan (hanya desktop) --}}

                <x-dropdown align="right" width="48">
                    {{-- fungsinya untuk membuat dropdown menu user --}}

                    <x-slot name="trigger">
                        {{-- fungsinya untuk bagian tombol yang diklik untuk membuka dropdown --}}

                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            {{-- fungsinya untuk tombol dropdown dengan styling Tailwind --}}

                            <div>
                                {{ Auth::user()->name }}
                                {{-- fungsinya untuk menampilkan nama user yang login --}}

                                <span style="font-size: 12px; color: gray;">
                                    ({{ Auth::user()->role }})
                                </span>
                                {{-- fungsinya untuk menampilkan role user --}}
                            </div>

                            <div class="ms-1">
                                {{-- fungsinya untuk memberi jarak dan menampilkan icon dropdown --}}
                                
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    {{-- fungsinya untuk icon panah dropdown --}}
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        {{-- fungsinya untuk isi dari dropdown menu --}}

                        <x-dropdown-link :href="route('profile.edit')">
                            {{-- fungsinya untuk link ke halaman profile --}}
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            {{-- fungsinya untuk proses logout --}}
                            @csrf {{-- fungsinya untuk keamanan form Laravel --}}

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{-- fungsinya untuk menjalankan logout saat diklik --}}
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                {{-- fungsinya untuk menampilkan tombol hamburger di tampilan mobile --}}

                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    {{-- fungsinya untuk toggle menu (buka/tutup) saat tombol diklik --}}

                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        {{-- fungsinya untuk icon hamburger --}}

                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex"
                              d="M4 6h16M4 12h16M4 18h16" />
                        {{-- fungsinya untuk menampilkan icon garis saat menu tertutup --}}

                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                              class="hidden"
                              d="M6 18L18 6M6 6l12 12" />
                        {{-- fungsinya untuk menampilkan icon X saat menu terbuka --}}
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        {{-- fungsinya untuk menampilkan menu mobile ketika open = true --}}

        <div class="pt-2 pb-3 space-y-1">
            {{-- fungsinya untuk list menu versi mobile --}}

            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{-- fungsinya untuk link dashboard di mobile --}}
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">
                {{-- fungsinya untuk link about di mobile --}}
                {{ __('About') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('product.index')" :active="request()->routeIs('product.*')">
                {{-- fungsinya untuk link product di mobile --}}
                {{ __('Product') }}
            </x-responsive-nav-link>
            
            @can('isAdmin')
            {{-- fungsinya untuk menampilkan menu khusus admin --}}
            
            <x-responsive-nav-link :href="route('category.index')" :active="request()->routeIs('category.*')">
                {{-- fungsinya untuk link category di mobile --}}
                {{ __('Category') }}
            </x-responsive-nav-link>
            @endcan
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            {{-- fungsinya untuk bagian info user di mobile --}}

            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                    {{ Auth::user()->name }} ({{ Auth::user()->role }})
                </div>
                {{-- fungsinya untuk menampilkan nama dan role user --}}

                <div class="font-medium text-sm text-gray-500">
                    {{ Auth::user()->email }}
                </div>
                {{-- fungsinya untuk menampilkan email user --}}
            </div>

            <div class="mt-3 space-y-1">
                {{-- fungsinya untuk menu tambahan di mobile --}}

                <x-responsive-nav-link :href="route('profile.edit')">
                    {{-- fungsinya untuk link profile --}}
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    {{-- fungsinya untuk logout --}}
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{-- fungsinya untuk menjalankan logout --}}
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>