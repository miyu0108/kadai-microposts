@if (Auth::check())
    {{-- 検索ページへのリンク --}}
    <li>
        <a class="link link-hover" href=#>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
              <path d="M8.25 10.875a2.625 2.625 0 115.25 0 2.625 2.625 0 01-5.25 0z" />
              <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.125 4.5a4.125 4.125 0 102.338 7.524l2.007 2.006a.75.75 0 101.06-1.06l-2.006-2.007a4.125 4.125 0 00-3.399-6.463z" clip-rule="evenodd" />
            </svg>
            Search
        </a>
        <ul class="p-2 bg-base-100 shadow z-50">
            <li>
                <a class="link link-hover text-gray-700" href="{{ route('users.search') }}">
                    Users
                </a>
            </li>
            <li>
                <a class="link link-hover text-gray-700" href="{{ route('microposts.search') }}">
                    Microposts
                </a>
            </li>
        </ul>
    </li>
    
    {{-- ユーザ詳細ページへのリンク --}}
    <li>
        <a href="#">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-6 h-6 inline">
                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
            </svg>
            {{ Auth::user()->name }}
        </a>
        <ul class="p-2 bg-base-100 shadow z-50">
            <li>
                <a class="link link-hover text-gray-700" href="{{ route('users.show', Auth::user()->id) }}">
                    My profile
                </a>
            </li>
            <li>
                <a class="link link-hover text-gray-700" href="{{ route('users.favorites', Auth::user()->id) }}">
                    Favorites
                </a>
            </li>
            <li>
                <a class="link link-hover text-red-500" href="#" onclick="event.preventDefault();this.closest('form').submit();">Logout</a>
            </li>
        </ul>
    </li>
@else
    {{-- ユーザ登録ページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('register') }}">Signup</a></li>
    <li class="divider lg:hidden"></li>
    {{-- ログインページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('login') }}">Login</a></li>
@endif