<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductTypes;
class ProductTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ProductTypes::all();
        return view('admin.producttypes.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.producttypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // 判斷是否有上傳圖片


        // create 新增一個行資料 從$request(請求或要求)的所有資料 儲存起來
        ProductTypes::create($data)->save();
        return redirect('home/ProductType');
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
        $data = ProductTypes::where('id', $id)->first();

        return view('admin.producttypes.edit', compact('data'));
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
        $data = ProductTypes::where('id', $id)->first();
        // 判斷是否上傳圖片

        $data->type = $request->type;
        $data->sort = $request->sort;
        $data->save();
        return redirect('home/ProductType');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ProductTypes::find($id)->first();
        // 將要刪除的資料ID傳進function 再進行 搜尋這筆資料 在做刪除動作
        // find 是指尋找主鍵primary key 的含式 尋找主鍵為$id的資料進行delete

        $data->delete();
        return redirect('home/ProductType');
    }
}
