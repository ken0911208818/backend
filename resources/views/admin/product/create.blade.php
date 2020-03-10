@extends('layouts/app');

@section('content')




<div class="container">

    <form method="POST" action="/home/product" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="img">img-url</label>
            <input type="file" class="form-control" id="img" name="img">
        </div>
        <div class="form-group">

            <label for="kinds">種類</label>
            <select name="kinds">
                    @foreach ($type as $item)
                        <option value="{{$item->id}}">{{$item->type}}</option>
                        
                    @endforeach                　
            </select>
        </div>
        <div class="form-group">
            <label for="content">content</label>
            <input type="text" class="form-control" id="content" name="content">
        </div>
        <div class="form-group">
            <label for="title">title</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>


@endsection
