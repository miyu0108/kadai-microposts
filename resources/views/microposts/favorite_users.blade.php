<div class="dropdown">
    <a class="badge shadow" href=#>{{ $micropost->favorite_users->count() }}</a>
    <ul class="dropdown-content menu p-2 bg-base-100 shadow z-50 list-none">
        @if (isset($micropost->favorite_users($micropost->id)))
            @foreach ($micropost->favorite_users($micropost->id) as $user)
            <li class="flex items-center gap-x-2 mb-4">
                {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                <div class="avatar">
                    <div class="w-12 rounded">
                        <img src="{{ Gravatar::get($user->email) }}" alt="" />
                    </div>
                </div>
                <div>
                    <div>
                        {{ $user->name }}
                    </div>
                    <div>
                        {{-- ユーザ詳細ページへのリンク --}}
                        <p><a class="link link-hover text-info" href="{{ route('users.show', $user->id) }}">View profile</a></p>
                    </div>
                </div>
            </li>
            @endforeach
        @endif
    </ul>
</div>