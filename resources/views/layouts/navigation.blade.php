<style>
    .header h1 {
        font-size: 20px;
        background: linear-gradient(90deg, yellow, black);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        margin-left: 20px !important;
        padding: 0;
    }
    
    .header {
        margin-left: 0 !important;
        padding-left: 0; /* Para asegurarte de que no haya padding */
    }
</style>

<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    
    <!-- Primary Navigation Menu -->
    <div class="max-w-9xl mx-20 px-0 sm:px-0 lg:px-0"> <!-- Cambiar px a 0 para eliminar padding horizontal -->
        <div class="flex items-center justify-between h-16">
           
             <!-- Logo y T�tulo alineados a la izquierda -->
             <div class="flex items-center header pl-0 me-auto">
                
                <img src="{{ asset('img/iconos/radiacion.png') }}" class="w-6 h-6 rounded-full" style="margin-left:10px">&nbsp;<h1>Fuentes Radiactivas</h1>
            </div>

            

            <div class="flex justify-center flex-grow">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:flex">                    
                    <!-- Nueva pesta�a Fuentes -->
                    <x-nav-link :href="route('fuentes.index')" :active="request()->routeIs('fuentes.index')">
                        {{ __('Fuentes') }}
                    </x-nav-link>
                                        
                                           
                    
                    @if (auth()->user()->role === 1)
                        <!-- Nueva pesta�a Geometrias -->
                        <x-nav-link :href="route('geometrias.index')" :active="request()->routeIs('geometrias.index')">
                            {{ __('Geometrias/Soportes') }}
                        </x-nav-link> 
                        
                        <!-- Nueva pestaña Depositos -->
                        <x-nav-link :href="route('depositos.index')" :active="request()->routeIs('depositos.index')">
                            {{ __('Depósitos') }}
                        </x-nav-link> 

                        <!-- Nueva pestaña Tipos -->
                        <x-nav-link :href="route('tipos.index')" :active="request()->routeIs('tipos.index')">
                            {{ __('Tipos') }}
                        </x-nav-link> 

                        <!-- Nueva pestaña Unidades -->
                        <x-nav-link :href="route('unidades.index')" :active="request()->routeIs('unidades.index')">
                            {{ __('Unidades') }}
                        </x-nav-link> 

                        <!-- Nueva pestaña Emision -->
                        <x-nav-link :href="route('emisiones.index')" :active="request()->routeIs('emisiones.index')">
                            {{ __('Emisiones') }}
                        </x-nav-link> 

                        <!-- Nueva pestaña Uso -->
                        <x-nav-link :href="route('usos.index')" :active="request()->routeIs('usos.index')">
                            {{ __('Usos') }}
                        </x-nav-link> 
                    @endif
                    
                </div>
            </div>

            <!-- Settings Dropdown -->
<div class="hidden sm:flex sm:items-center sm:ms-6" style="float:right">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                <!-- Imagen del usuario -->
                <img src="{{ asset('img/iconos/user.png') }}" alt="User Icon" class="w-6 h-6 rounded-full me-2">
                
                <!-- Nombre del usuario -->
                <div>{{ Auth::user()->name }}</div>

                <div class="ms-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')">
                {{ __('Profile') }}
            </x-dropdown-link>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </x-slot>
    </x-dropdown>
</div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('fuentes.index')" :active="request()->routeIs('fuentes.index')">
                {{ __('Fuentes') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>