<?php

namespace App\Http\Controllers;
//Request 請求:當資料丟進來時的資料型態
use Illuminate\Http\Request;
use App\News;
class NewsController extends Controller
{
    public function index()
    {
        //all()將所有資料撈出來
        $data = News::all();
        //compact將資料夾到去view
        return view('admin/news/index',compact('data'));
    }

    public function store(Request $request) {
        //request 將送過來的所有資料稱為request(請求或是要求)
        $data = $request->all();

        //save()指將資料表儲存起來
        News::create($data)->save();

        //redirect 將返回至XX頁面
        return redirect('/home/news/create');
    }
    public function create()
    {

        return view('admin/news/create');
    }
    public function edit($id)
    {
        // $data = News::find($id)->get();
        $data = News::where('id', $id)->get();
        return view('admin/news/edit',compact('data'));
    }
    public function update(Request $request,$id)
    {
        //except:例外處理(['xxx'])將request的XXX欄位去除
        $tt = $request->except(['_token']);
        News::where('id', $id)->update($tt);
        return redirect('/home/news/');
    }
    public function delete($id)
    {
        
        $data = News::where('id', $id)->delete();
        return redirect('/home/news/');
    }
}
