@extends('layouts/app');

@section('content')




<div class="container">

    <form method="POST" action="/home/ProductType" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="type">種類</label>
            <input type="text" class="form-control" id="type" name="type">
        </div>
        <div class="form-group">
            <label for="sort">權重</label>
            <input type="number" class="form-control" id="sort" name="sort">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>


@endsection
