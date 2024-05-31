@if (Auth::user()->is_favorite($id))
    {{-- お気に入り解除ボタンのフォーム --}}
    <form method="POST" action="{{ route('user.unfavorite', $id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-error btn-sm normal-case">Unfavorite</button>
    </form>
@else
    {{-- お気に入り登録ボタンのフォーム --}}
    <form method="POST" action="{{ route('user.favorite', $id) }}">
        @csrf
        <button type="submit" class="btn btn-primary btn-sm normal-case">Favorite</button>
    </form>
@endif