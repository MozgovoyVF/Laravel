<div class="container header__container">
    <header class="blog-header lh-1 py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">

            </div>
            <div class="col-4 text-center">
                <a class="blog-header-logo text-dark" href="/">Skillbox Laravel</a>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                {{-- <a class="link-secondary" href="#" aria-label="Search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="mx-3" role="img" viewBox="0 0 24 24">
                        <title>Search</title>
                        <circle cx="10.5" cy="10.5" r="7.5"></circle>
                        <path d="M21 21l-5.2-5.2"></path>
                    </svg>
                </a> --}}
                @guest
                    <a class="btn btn-sm btn-outline-secondary me-3 {{request()->is('login') ? 'active' : ''}}" href="/login">Войти</a>
                    <a class="btn btn-sm btn-outline-secondary {{request()->is('register') ? 'active' : ''}}" href="/register">Регистрация</a>
                @endguest
                @auth
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                          this.closest('form').submit();">
                                        {{ __('Выйти') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endauth
            </div>
        </div>
    </header>
    
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-start">
            <a class="p-2 link-secondary {{request()->is('/') ? 'active' : ''}}" href="{{route('index')}}">Главная</a>
            <a class="p-2 link-secondary {{request()->is('about') ? 'active' : ''}}" href="{{route('about')}}">О нас</a>
            <a class="p-2 link-secondary {{request()->is('contacts') ? 'active' : ''}}" href="{{route('contacts')}}">Контакты</a>
            <a class="p-2 link-secondary {{request()->is('articles/create') ? 'active' : ''}}" href="{{route('article.create')}}">Создать статью</a>
            <a class="p-2 link-secondary {{request()->is('news/*') ? 'active' : ''}}" href="{{route('news.index')}}">Новости</a>
            @admin
            <a class="p-2 link-secondary {{request()->is('admin/*') ? 'active' : ''}}" href="{{route('admin.article.index')}}">Админ. раздел</a>
            @endadmin
        </nav>
    </div>
</div>
