@extends('layouts.app')

@section('content')
    <div class="sm:grid sm:grid-cols-3 sm:gap-10">
        @if (isset($favorites))
            <ul class="list-none">
                @foreach ($favorites as $favorite)
                <li class="p-4 bg-white mb-4 rounded shadow">
                    <div>
                        <div class="bg-gray-100 p-2">
                            <span class="text-sm">
                                {{ $favorite->user->user_name }}
                                {{ (new \Carbon\Carbon($favorite->created_at))->format('Y年m月d日 h:i') }}
                            </span>
                        </div>

                        <div class="p-2 rounded">
                            {{-- 投稿内容 --}}
                            <p class="mb-0 text-lg">{{ nl2br(e($favorite->message)) }}</p>
                        </div>
                        
                        <div class="sm:col-span-2">
                            {{-- お気に入り一覧 --}}
                            @include('boards.boards')
                        </div>
                        
                        <div>
                        {{-- お気に入り／お気に入り解除ボタン --}}
                        @include('user_favorite.favorite_button', ['id' => $favorite->message_id])
                        </div>
                    </div>
                    </li>
                 @endforeach
            </ul>
        @endif
    </div>
@endsection