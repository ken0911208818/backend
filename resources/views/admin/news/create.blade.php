@extends('layouts/app');

@section('content')




<div class="container">

   <form method="post" action="/home/news/store" enctype="multipart/form-data">

    @csrf
    <div class="form-group">
      <label for="img">IMG</label>
    <input type="file" class="form-control" id="img" name="img" >
    </div>
    <div class="form-group">
        <label for="title">title</label>
    <input type="text" class="form-control" id="title" name="title" >
      </div>
    <div class="form-group">
      <label for="content">content</label>
      <textarea type="text" class="form-control" id="content" name="content" cols="30" rows="10"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

</div>


@endsection
