<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //all() 是將所有關於product的資料拿出來
        $data = Product::all();
        return view('admin.product.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 回傳新增頁面
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // create 新增一個行資料 從$request(請求或要求)的所有資料 儲存起來
        Product::create($request->all())->save();
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
        $data = Product::where('id',$id)->first();

        return view('admin.product.edit',compact('data'));
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
        // 這筆request 含有 method 與token 這兩筆欄位資料
        // except 例外處理 將括號內的欄位去除
        // $tt = $request->except('_token','_method');
        // where(指定) id =$id 這筆 進行 更新內容($tt)
        // Product::where('id',$id)->update($tt);
        $data = Product::where('id',$id)->first();
        // 先做賦值得動作 在做儲存
        $data->img = $request->img;
        $data->kinds = $request->kinds;
        $data->save();
        return redirect('home/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 將要刪除的資料ID傳進function 再進行 搜尋這筆資料 在做刪除動作
        // find 是指尋找主鍵primary key 的含式 尋找主鍵為$id的資料進行delete
        Product::find($id)->delete();
        return redirect('home/product');
    }
}
