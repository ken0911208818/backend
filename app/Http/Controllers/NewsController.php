<?php

namespace App\Http\Controllers;

//Request 請求:當資料丟進來時的資料型態
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    public function index()
    {
        //all()將所有資料撈出來
        $data = News::all();
        //compact將資料夾到去view
        return view('admin/news/index', compact('data'));
    }

    public function store(Request $request)
    {
        //request 將送過來的所有資料稱為request(請求或是要求)
        $data = $request->all();

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $path = $this->fileUpload($file, 'news');
            $data['img'] = $path;
        }

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
        return view('admin/news/edit', compact('data'));
    }
    public function update(Request $request, $id)
    {
        //except:例外處理(['xxx'])將request的XXX欄位去除
        // $tt = $request->except(['_token']);
        // News::where('id', $id)->update($tt);
        // return redirect('/home/news/');

        $item = News::find($id);

        $requsetData = $request->all();
        if ($request->hasFile('img')) {

            // 刪除照片
            $old_image = $item->img;
            File::delete(public_path() . $old_image);

            $file = $request->file('img');
            $path = $this->fileUpload($file, 'news');
            $requsetData['img'] = $path;

        }

        $item->update($requsetData);

        return redirect('/home/news/');
    }
    public function delete($id)
    {

        $data = News::where('id', $id)->first();
        $old_image = $data->img;
        if (file_exists(public_path() . $old_image)) {
            File::delete(public_path() . $old_image);
        }
        $data->delete();
        return redirect('/home/news/');
    }

    private function fileUpload($file, $dir)
    {
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if (!is_dir('upload/')) {
            mkdir('upload/');
        }
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if (!is_dir('upload/' . $dir)) {
            mkdir('upload/' . $dir);
        }
        //取得檔案的副檔名
        $extension = $file->getClientOriginalExtension();
        //檔案名稱會被重新命名
        $filename = strval(time() . md5(rand(100, 200))) . '.' . $extension;
        //移動到指定路徑
        move_uploaded_file($file, public_path() . '/upload/' . $dir . '/' . $filename);
        //回傳 資料庫儲存用的路徑格式
        return '/upload/' . $dir . '/' . $filename;
    }
}
