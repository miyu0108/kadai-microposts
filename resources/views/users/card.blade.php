<div class="card border border-base-300">
    <div class="card-body bg-base-200 text-4xl">
        <table class="table-fixed">
            <tr>
                <th class="text-lg text-center normal-case">name</th>
                <td class="text-lg text-center normal-case">{{ $user->name }}</td>
            </tr>
            @if (Auth::id() == $user->id)
                <tr>
                    <th class="text-lg text-center normal-case">email</th>
                    <td class="text-lg text-center normal-case">{{ $user->email }}</td>
                </tr>
            @endif
            <tr>
                <th class="text-lg text-center normal-case">message</th>
                <td class="text-base text-center normal-case">{{ $user->profile_message }}</td>
            </tr>
        </table>
        @if (Auth::id() == $user->id)
            <div class="flex">
                {{-- プロフィール修正ボタンのフォーム --}}
                <a type="submit" class="btn btn-sm normal-case" href="{{ route('profile.edit', $user) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                      <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                    </svg>
                </a>
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
            onclick="return confirm('Delete user: {{ $user->name }} ?')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
            </svg>
            Acount Delete
        </button>
    </form>
@endif
{{-- フォロー／アンフォローボタン --}}
@include('user_follow.follow_button')