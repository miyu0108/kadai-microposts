@extends('layouts.app')

@section('content')
    <div class="sm:grid sm:grid-cols-3 sm:gap-10">
        <aside class="mt-4">
            {{-- ユーザ情報 --}}
            @include('users.card')
        </aside>
        <div class="sm:col-span-2 mt-4">
            {{-- タブ --}}  
            @include('users.navtabs')
            {{-- 投稿フォーム --}}
            @include('microposts.form')
            {{-- 検索フォーム --}}
            <form method="GET" action="{{ route('microposts.user_search', $user->id) }}">
                @csrf
                
                <div class="flex my-4">
                    <div class="form-control w-1/2">
                        <input class="input input-bordered" type="text" placeholder="{{ $user->name }}のmicropostを検索" name="search" value="@if (isset($search)) {{ $search }} @endif">
                    </div>
                    <div>
                        <button class='btn' type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
            {{-- 投稿一覧 --}}
            @include('microposts.microposts')
        </div>
    </div>
@endsection