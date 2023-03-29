<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GoogleSerchListController extends Controller
{
    //
     // indexメソッド
     public function index()
     {
        // 実際のソースコード
        $api_key = config('services.api.api_key');
        $engine_id = config('services.api.engine_id');
        $search_param = "猫";
        $method = "GET";

        $url = "https://www.googleapis.com/customsearch/v1?key=".$api_key."&cx=".$engine_id."&q=".$search_param;

        //apiリクエスト
        $client = new Client();
        $response = $client->request($method, $url);
        $posts_a = $response->getBody();
        $posts_a = json_decode($posts_a, true);

        //レスポンスボディのitemsを取得
        $posts = $posts_a['items'];
        
        /*
        //テストデータ
        $posts = [
            ['kind' => 'customsearch#result', 'title' => '猫- 维基百科，自由的百科全书', 'link' => 'https://zh.wikipedia.org/wiki/%E7%8C%AB'],
            ['kind' => 'customsearch#result', 'title' => '白猫プロジェクト - Apps on Google Play', 'link' => 'https://play.google.com/store/apps/details?id=jp.colopl.wcat&hl=en_US'],
            ['kind' => 'customsearch#result', 'title' => '貓- Wiktionary', 'link' => 'https://play.google.com/store/apps/details?id=jp.colopl.wcat&hl=en_US']
        ];
        */
        
       return view('google_serch_list', ['posts' => $posts]);
     }
}
