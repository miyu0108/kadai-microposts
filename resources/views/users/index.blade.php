@extends('layouts.app')

@section('content')
    
    <form method="GET" action="{{ route('users.search') }}">
        @csrf
        <input type="search" placeholder="ユーザー名を入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
        <div>
            <button class='btn btn-sm' type="submit">検索</button>
            <button>
                <a href="{{ route('users.index') }}" class="btn btn-sm bg-white text-black hover:bg-white hover:text-black">
                    クリア
                </a>
            </button>
        </div>
    </form>
    {{-- ユーザ一覧 --}}
    @include('users.users')
@endsection