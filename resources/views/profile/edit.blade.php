@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2>{{ $user->name }} のプロフィール編集ページ</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('profile.update', $user) }}" class="w-1/2">
            @csrf
            @method('PUT')
            <input type="hidden" name="redirect_url" value="{{ request()->query()['redirect_url'] }}">
            <div class="form-control my-4">
                <label for="name" class="label">
                    <span class="label-text">名前:</span>
                </label>
                <input type="text" name="name" value="{{ $user->name }}" class="input input-bordered w-full">
            </div>
            
            <div class="form-control my-4">
                <label for="profile_message" class="label">
                    <span class="label-text">メッセージ:</span>
                </label>
                <input type="text" name="profile_message" value="{{ $user->profile_message }}" class="input input-bordered w-full">
            </div>

            <button type="submit" class="btn btn-primary btn-outline">更新</button>
        </form>
    </div>

@endsection