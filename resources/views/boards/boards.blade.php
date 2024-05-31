<div class="mt-4">
    @if (isset($boards))
        <ul class="list-none">
            @foreach ($boards as $board)
                <div>
                    <div>
                        {{ $board->user_name }}
                        {{ (new \Carbon\Carbon($board->created_at))->format('Y年m月d日 h:i') }}
                    </div>
                    <div>
                        {{-- 投稿内容 --}}
                        <p class="mb-0">{{ nl2br(e($board->message)) }}</p>
                    </div>
                    <div>
                        @if (Auth::id() == $board->user_number)
                        {{-- 投稿削除ボタンのフォーム --}}
                        <form method="POST" action="{{ route('boards.destroy', $board->message_id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-error btn-sm normal-case" 
                                    onclick="return confirm('削除するメッセージは id {{ $board->message_id }} でよろしいですか?')">削除</button>
                        </form>
                        @endif
                    </div>
                    <div>
                        @if (Auth::id() !== $board->user_number)
                        {{-- お気に入り／お気に入り解除ボタン --}}
                        @include('user_favorite.favorite_button', ['id' => $board->message_id])
                        @endif
                    </div>
                </div>
            @endforeach
        </ul>
        {{-- ページネーションのリンク --}}
        {{ $boards->links() }}
    @endif
</div>