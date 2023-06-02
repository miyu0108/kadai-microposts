<div class="card border border-base-300">
    <div class="card-body bg-base-200 text-4xl">
        <h2 class="card-title">{{ $user->name }}</h2>
        <li class="card-email">{{ $user->email }}</li>
        @if (Auth::id() == $user->id)
        {{-- プロフィール修正ボタンのフォーム --}}
            <a class="btn btn-primary" href="{{ route('profile.edit', $user) }}">edit</a>
            {{-- 投稿削除ボタンのフォーム --}}
            <form method="POST" action="{{ route('profile.destroy', $user->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline btn-sm normal-case"
                    onclick="return confirm('Delete user: {{ $user->name }} ?')">Delete</button>
            </form>
        @endif
    </div>
    <figure>
        {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
        <img src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="">
    </figure>
</div>
{{-- フォロー／アンフォローボタン --}}
@include('user_follow.follow_button')