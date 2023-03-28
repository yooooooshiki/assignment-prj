<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleController extends Controller
{
    // indexメソッド
    public function index()
  {
    return view('sample');
  }
}
