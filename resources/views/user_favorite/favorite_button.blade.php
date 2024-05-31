<!DOCTYPE html>
<html lang="jp">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .favorite-button {
            background: none;
            border: none;
            color: lightgray;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        .favorite-button svg {
            width: 25px; /* アイコンのサイズを調整 */
            height: 25px;
            margin-right: 1px; /* アイコンとテキストの間のスペース */
        }
        .favorite-button:hover {
            color: darkgray; /* ホバー時の背景色を変更 */
        }
        .unfavorite-button {
            background: none;
            border: none;
            color: orange;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        .unfavorite-button svg {
            width: 25px; /* アイコンのサイズを調整 */
            height: 25px;
            margin-right: 1px; /* アイコンとテキストの間のスペース */
        }
        .unfavorite-button:hover {
            color: darkorange; /* ホバー時の背景色を変更 */
        }
    </style>
</head>
<body>
@if (Auth::user()->is_favorite($id))
    {{-- お気に入り解除ボタンのフォーム --}}
    <form method="POST" action="{{ route('user.unfavorite', $id) }}">
        @csrf
        @method('DELETE')
        <!--<button type="submit" class="btn btn-error btn-sm normal-case">Unfavorite</button>-->
        <button type="submit" class="unfavorite-button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
            </svg>
        </button>
    </form>
@else
    {{-- お気に入り登録ボタンのフォーム --}}
    <form method="POST" action="{{ route('user.favorite', $id) }}">
        @csrf
        <!--<button type="submit" class="btn btn-primary btn-sm normal-case">Favorite</button>-->
        <button type="submit" class="favorite-button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
            </svg>
        </button>
    </form>
@endif
</body>
</html>