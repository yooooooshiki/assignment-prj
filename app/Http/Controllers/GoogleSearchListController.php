<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GoogleSearchListController extends Controller
{
     // 検索画面表示
    public function index()
    {
        //検索画面を表示
        return view('google_search_list');
        //return view('google_search_list', ['posts' => $posts]);
    }

    // google custom search apiでの検索結果一覧取得
    public function create(Request $request)
    {
        /*
        //テストデータ
        $posts = [
            ['kind' => 'customsearch#result', 'title' => '猫- 维基百科，自由的百科全书', 'link' => 'https://zh.wikipedia.org/wiki/%E7%8C%AB'],
            ['kind' => 'customsearch#result', 'title' => '白猫プロジェクト - Apps on Google Play', 'link' => 'https://play.google.com/store/apps/details?id=jp.colopl.wcat&hl=en_US'],
            ['kind' => 'customsearch#result', 'title' => '貓- Wiktionary', 'link' => 'https://play.google.com/store/apps/details?id=jp.colopl.wcat&hl=en_US']
        */

        // バリデーションチェック
        $request->validate([
            'keyword' => 'required',
        ]);

        //apiリクエスト用url作成
        $api_key = config('services.api.api_key');
        $engine_id = config('services.api.engine_id');
        $search_param = $request->input('keyword');
        $method = "GET";
        $url = "https://www.googleapis.com/customsearch/v1?key=".$api_key."&cx=".$engine_id."&q=".$search_param;

        //apiリクエスト
        $client = new Client();
        $response = $client->request($method, $url);
        $response_body = $response->getBody();
        $response_body = json_decode($response_body, true);

        //レスポンスボディのitemsを取得
        $posts = $response_body['items'];

        //データをビューに返却
        return view('google_search_list', ['posts' => $posts]);
    }
}
