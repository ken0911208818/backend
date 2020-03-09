@extends('layouts/app');

@section('content')




<div class="container">

    <form method="post" action="/home/ProductType/{{$data->id}}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf

        <div class="form-group">
            <label for="type">type</label>
            <input type="text" class="form-control" id="type" name="type" value="{{$data->type}}">
        </div>
        <div class="form-group">
            <label for="sort">sort</label>
            <input type="number" class="form-control" id="sort" name="sort" value="{{$data->sort}}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>


    </form>

</div>


@endsection
