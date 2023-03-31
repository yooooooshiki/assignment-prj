<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\File;

class GoogleSearchListController extends Controller
{
     // 検索画面表示
    public function index()
    {
        //検索画面のルートを返却
        return view('google_search_list');
    }

    // google custom search apiでの検索結果一覧取得
    public function create(Request $request)
    {
        // バリデーションチェック
        $request->validate([
            'keyword' => 'required',
        ]);

        //apiリクエスト用url作成
        $api_key = config('services.api.api_key');
        $engine_id = config('services.api.engine_id');
        $search_param = $request->input('keyword');
        $language = $request->input('language');
        if (isset($language)) {
            $language = "&lr=lang_ja";
        };
        $method = "GET";
        $url = "https://www.googleapis.com/customsearch/v1?key=".$api_key."&cx=".$engine_id."&q=".$search_param.$language;
        

        //apiリクエスト
        $client = new Client();
        $response = $client->request($method, $url);
        $response_body = $response->getBody();
        $response_body = json_decode($response_body, true);

        //レスポンスボディのitemsを取得
        $posts = $response_body['items'];

        /*
        //テストデータを使用
        $posts = File::get('/Applications/XAMPP/xamppfiles/htdocs/assignment-prj/apidata');
        $posts = json_decode($posts, true);
        $posts = $posts['items'];
        */

        //データをビューに返却
        return view('google_search_list', ['posts' => $posts]);
    }
}
