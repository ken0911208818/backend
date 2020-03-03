@extends('layouts/app');

@section('content')




<div class="container">

<form method="post" action="/home/product/{{$data->id}}">
    @method('PATCH')
    @csrf

    <div class="form-group">
        <label for="img">IMG</label>
        <input type="text" class="form-control" id="img" name="img" value="{{$data->img}}">
    </div>

    <div class="form-group">
            <label for="title">kinds</label>
        <input type="text" class="form-control" id="title" name="kinds" value="{{$data->kinds}}">
    </div>


    <button type="submit" class="btn btn-primary">Submit</button>


  </form>

</div>


@endsection
