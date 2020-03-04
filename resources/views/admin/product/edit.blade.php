@extends('layouts/app');

@section('content')




<div class="container">

    <form method="post" action="/home/product/{{$data->id}}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="img">現在圖片</label>
            <img src="{{asset('storage/'.$data->img)}}" alt="" srcset="" class="img-fluid" width="200px">
        </div>
        <div class="form-group">
            <label for="img">重新上傳圖片</label>
            <input type="file" class="form-control" id="img" name="img" >
        </div>

        <div class="form-group">
            <label for="kinds">kinds</label>
            <input type="text" class="form-control" id="kinds" name="kinds" value="{{$data->kinds}}">
        </div>
        <div class="form-group">
            <label for="sort">sort</label>
            <input type="number" class="form-control" id="sort" name="sort" value="{{$data->sort}}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>


    </form>

</div>


@endsection
