<?php

namespace App\Http\Controllers;

//Request 請求:當資料丟進來時的資料型態
use App\News;
use App\Newsimg;
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

        $news_id = News::create($data);

        if ($request->hasFile('newsimg')) {
            foreach ($request->newsimg as $item) {
                $file = $request->file('newsimg');
                $path = $this->fileUpload($item, 'news');
                $data['newsimg'] = $path;
                $newsimg =  new Newsimg;
                $newsimg ->news_id = $news_id['id'];
                $newsimg->img_url = $data['newsimg'];
                $newsimg->save();
            }
        }

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
        $data = News::where('id', $id)->with('newsimg')->first();

        return view('admin/news/edit', compact('data'));
    }
    public function update(Request $request, $id)
    {
        //except:例外處理(['xxx'])將request的XXX欄位去除
        // $tt = $request->except(['_token']);
        // News::where('id', $id)->update($tt);
        // return redirect('/home/news/');
        // ，在做舊圖片刪除 新圖片上傳 再更改資料庫圖片名
        $item = News::find($id);

        $requsetData = $request->all();
        // 先確定有沒有圖片上傳
        if ($request->hasFile('img')) {

            // 刪除照片
            $old_image = $item->img;
            File::delete(public_path() . $old_image);
            $file = $request->file('img');
            $path = $this->fileUpload($file, 'news');
            $requsetData['img'] = $path;
        }



        $item->update($requsetData);

        if ($request->hasFile('newsimg')) {
            foreach ($request->newsimg as $item) {
                $file = $request->file('newsimg');
                $path = $this->fileUpload($item, 'news');
                $data['newsimg'] = $path;
                $newsimg =  new Newsimg;
                $newsimg ->news_id = $id;
                $newsimg->img_url = $data['newsimg'];
                $newsimg->save();
            }
        }
        return redirect('/home/news/');
    }
    public function delete($id)
    {
        // news 圖片資料刪除
        $data = News::where('id', $id)->first();

        $old_image = $data->img;
        if (file_exists(public_path() . $old_image)) {
            File::delete(public_path() . $old_image);
        }
        $data->delete();

        // 多張圖片資料刪除
        $news_img = Newsimg::where('news_id',$id)->get();
        foreach($news_img as$new_img ){

            $old_image = $new_img->img_url;
            if (file_exists(public_path() . $old_image)) {
            File::delete(public_path() . $old_image);
            $new_img->delete();
        }
        }
        return redirect('/home/news/');
    }

    public function ajax_delete_newsimg(Request $request)
    {
        $newimgid = $request->newsimgid;
        $data = Newsimg::where('id', $newimgid)->first();
        $old_image = $data->img_url;
        if (file_exists(public_path() . $old_image)) {
            File::delete(public_path() . $old_image);
        }
        $data->delete();
        return 'successful';
    }
    public function ajax_newsimg_sort(Request $request)
    {

        $sort = $request->sort;
        $id = $request->id;
        $newsimg = Newsimg::find($id);
        $newsimg->sort = $sort;
        $newsimg->save();
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
