@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class="sm:grid sm:grid-cols-3 sm:gap-10">
            <aside class="mt-4">
                {{-- ユーザ情報 --}}
                @include('users.card')
            </aside>
            <div class="sm:col-span-2">
                {{-- 投稿フォーム --}}
                @include('microposts.form')
                {{-- 投稿一覧 --}}
                @include('microposts.microposts')
            </div>
        </div>
    @else
        <div class="prose hero mx-auto max-w-full rounded">
            <div class="hero-content text-center my-10">
                <div class="max-w-md mb-10">
                    <h2>Welcome to the Microposts!</h2>
                    <img src="https://cdn.pixabay.com/photo/2014/04/02/11/17/speech-bubbles-305824_1280.png" alt="chat">
                    {{-- ユーザ登録ページへのリンク --}}
                    <a class="btn btn-primary btn-lg normal-case" href="{{ route('register') }}">Sign up</a>
                    <a class="btn btn-primary btn-lg normal-case" href="{{ route('login') }}">Login</a>
                </div>
            </div>
        </div>
    @endif
@endsection