
<div>
    <form action="{{ route('google_search.create') }}" method="POST">
        @csrf
        <p>検索キーワード：<input type="text" name="keyword" value=""></p>
        <p>日本語のみ：<input type="radio" name="language" value="日本語" >※検索範囲の言語を日本語のみに制限する場合はチェックをしてください</p>

        <input type="submit" value="検索">
    </form>
    @if ($errors->has('keyword'))
        {{$errors->first('keyword')}}
    @endif
    <br>

@isset($posts)
    <p><b>検索結果一覧</b></p>
    <table border = "1">
        <tr>
            <th>タイトル</th>
            <th>リンク</title></th>
        </tr>
        @foreach($posts as $num)
        <tr>
            <td>{{ $num['title'] }}</td>
            <td>{{ $num['link'] }}</td>
        </tr>
        @endforeach
    </table>
    <p><button type="button" onclick="location.href='{{ route('google.index') }}' ">リセット</button><p>
@endisset
</div>
