<?php

namespace App\Http\Controllers;


use App\Product;
use App\ProductTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
// php artisan storage:link
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //order('欄位','排序方式')記得一定要加->get()
        $data = Product::orderBy('sort','desc')->get();
        return view('admin.product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 回傳新增頁面
        $type =ProductTypes::all();
        return view('admin.product.create',compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //
        $data = $request->all();
        // 判斷是否有上傳圖片
        if ($request->hasFile('img')) {
            // $requset->file是指檔案儲存的地方 用store的方始存到public的資料夾
            $file_name = $request->file('img')->store('', 'public');
            // 再將存到的檔名改成要存入資料的IMG
            $data['img'] = $file_name;
        }

        // create 新增一個行資料 從$request(請求或要求)的所有資料 儲存起來
        Product::create($data)->save();
        return redirect('home/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // where條件式 當ID 等於 $id 的資料 first是指第一筆資料
        $data = Product::where('id', $id)->first();
        $type = ProductTypes::all();
        return view('admin.product.edit', compact('data'),compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = Product::where('id', $id)->first();
        // 判斷是否上傳圖片
        if ($request->hasFile('img')) {

            // 刪除照片
            // 用一個變數代替要刪除的圖片名
            $old_image = $data->img;
            //public_path()指從public這個路徑開始
            File::delete(public_path() . '/storage/' . $old_image);
            // 儲存新照片
            $file_name = $request->file('img')->store('', 'public');
            // 將新照片的路徑存起來 回存
            $data->img = $file_name;
        }

        $data->kinds = $request->kinds;
        $data->sort = $request->sort;
        $data->save();
        return redirect('home/product');

        // 這筆request 含有 method 與token 這兩筆欄位資料
        // except 例外處理 將括號內的欄位去除
        // $tt = $request->except('_token','_method');
        // where(指定) id =$id 這筆 進行 更新內容($tt)
        // Product::where('id',$id)->update($tt);
        // $data = Product::where('id', $id)->first();
        // // 先做賦值得動作 在做儲存
        // $data->img = $request->img;
        // $data->kinds = $request->kinds;
        // $data->save();
        // return redirect('home/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::find($id)->first();
        // 將要刪除的資料ID傳進function 再進行 搜尋這筆資料 在做刪除動作
        // find 是指尋找主鍵primary key 的含式 尋找主鍵為$id的資料進行delete
        $old_image = $data->img;
        File::delete(public_path() . '/storage/' . $old_image);
        $data->delete();
        return redirect('home/product');
    }
}
