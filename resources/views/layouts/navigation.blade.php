<nav x-data="{ open: false }" class="gradient-bg border-b border-emerald-200/20 shadow-soft">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a :href="Auth::user()->is_admin ? route('admin.dashboard') : route('user.dashboard')" class="hover-lift">
                        <x-application-logo class="block h-10 w-auto fill-current text-white hover:text-emerald-100 transition-colors duration-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link 
                        :href="Auth::user()->is_admin ? route('admin.dashboard') : route('user.dashboard')" 
                        :active="request()->routeIs('admin.dashboard') || request()->routeIs('user.dashboard')"
                        class="text-white hover:text-emerald-100 border-emerald-300/30 hover:border-emerald-200/50">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link 
                        :href="route('profile.edit')" 
                        :active="request()->routeIs('profile.edit')"
                        class="text-white hover:text-emerald-100 border-emerald-300/30 hover:border-emerald-200/50">
                        {{ __('Profile') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-emerald-200/30 text-sm leading-4 font-medium rounded-xl text-white bg-white/10 hover:bg-white/20 hover:border-emerald-200/50 focus:outline-none focus:ring-2 focus:ring-emerald-200/50 transition ease-in-out duration-200 backdrop-blur-sm">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-emerald-200/20 rounded-full flex items-center justify-center">
                                    <span class="text-emerald-800 font-semibold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                            </div>

                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-white/95 backdrop-blur-sm border border-emerald-200/20 rounded-xl shadow-soft">
                            <x-dropdown-link :href="route('profile.edit')" class="text-emerald-800 hover:bg-emerald-50 hover:text-emerald-900">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                        class="text-red-600 hover:bg-red-50 hover:text-red-700">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-3 rounded-xl text-white hover:text-emerald-100 hover:bg-white/10 focus:outline-none focus:bg-white/10 focus:text-emerald-100 transition duration-200 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white/95 backdrop-blur-sm border-t border-emerald-200/20">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link 
                :href="Auth::user()->is_admin ? route('admin.dashboard') : route('user.dashboard')" 
                :active="request()->routeIs('admin.dashboard') || request()->routeIs('user.dashboard')"
                class="text-emerald-800 hover:bg-emerald-50 hover:text-emerald-900">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-emerald-200/20">
            <div class="px-4">
                <div class="font-medium text-base text-emerald-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-emerald-600">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" class="text-emerald-800 hover:bg-emerald-50 hover:text-emerald-900">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="text-red-600 hover:bg-red-50 hover:text-red-700">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
