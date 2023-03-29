<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleController extends Controller
{
    // indexメソッド
    public function index()
  {
    $array = [
            ['kind' => 'customsearch#result', 'title' => '猫- 维基百科，自由的百科全书'],
            ['kind' => 'customsearch#result', 'title' => '白猫プロジェクト - Apps on Google Play'],
            ['kind' => '3', 'customsearch#result' => '貓- Wiktionary']
        ];
        $array = $array[0];
        
        /*
        echo('<pre>');
        var_dump($array);exit;
        echo('</pre>');
        */

      return view('sample', ['array' => $array]);
  }
}
