<?php

namespace App\Http\Controllers;
//Request 請求:當資料丟進來時的資料型態
use Illuminate\Http\Request;
use App\News;
class NewsController extends Controller
{
    public function index()
    {
        return view('auth/news/index');
    }

    public function store(Request $request) {
        $data = $request->all();
        News::create($data)->save();

        return redirect('/home/news');
    }
}
