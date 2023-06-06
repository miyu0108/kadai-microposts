<div class="card border border-base-300">
    <div class="card-body bg-base-200 text-4xl">
        <table class="table w-full">
        <tr>
            <th class="text-2xl text-center normal-case">name</th>
            <td class="text-2xl text-center normal-case">{{ $user->name }}</td>
        </tr>
        @if (Auth::id() == $user->id)
            <tr>
                <th class="text-2xl text-center normal-case">email</th>
                <td class="text-2xl text-center normal-case">{{ $user->email }}</td>
            </tr>
        @endif
        </table>
        @if (Auth::id() == $user->id)
            <div class="flex">
                {{-- プロフィール修正ボタンのフォーム --}}
                <a type="submit" class="btn btn-primary btn-sm normal-case" href="{{ route('profile.edit', $user) }}">Edit</a>
            </div>
        @endif
    </div>
    <figure>
        {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
        <img src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="">
    </figure>
</div>
{{-- アカウント削除ボタンのフォーム --}}
@if (Auth::id() == $user->id)
    <form method="POST" action="{{ route('profile.destroy', $user->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline btn-sm normal-case"
            onclick="return confirm('Delete user: {{ $user->name }} ?')">Acount Delete</button>
    </form>
@endif
{{-- フォロー／アンフォローボタン --}}
@include('user_follow.follow_button')