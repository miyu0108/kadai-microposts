@extends('layouts.app')

@section('content')
    
    <form method="GET" action="{{ route('users.search') }}">
        @csrf
        
        <div class="flex my-4">
            <div class="form-control w-1/2">
                <input class="input input-bordered" type="text" placeholder="ユーザー名を入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
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
    {{-- ユーザ一覧 --}}
    @include('users.users')
@endsection