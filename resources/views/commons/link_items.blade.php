@if (Auth::check())
    {{-- ユーザ一覧ページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('users.index') }}">Users</a></li>
    {{-- ユーザ詳細ページへのリンク --}}
    <li>
        <a href="#">{{ Auth::user()->name }}
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
            </svg>
        </a>
        <ul class="p-2 bg-base-100 shadow z-50">
            <li><a class="link link-hover text-gray-700" href="{{ route('users.show', Auth::user()->id) }}">My profile</a></li>
            <li><a class="link link-hover text-gray-700" href="{{ route('users.favorites', Auth::user()->id) }}">Favorites</a></li>
            <li><a class="link link-hover text-red-500" href="#" onclick="event.preventDefault();this.closest('form').submit();">Logout</a></li>
        </ul>
    </li>
@else
    {{-- ユーザ登録ページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('register') }}">Signup</a></li>
    <li class="divider lg:hidden"></li>
    {{-- ログインページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('login') }}">Login</a></li>
@endif