@extends('layouts/app');

@section('css')
<style>
    .d-flex .col-2 .btn-danger {
        position: absolute;
        border-radius: 50%;
        top: -15px;
        right: -5px;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')



<div class="container">

    <form method="post" action="/home/news/update/{{$data->id}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="img">現有圖片</label>
            <img src="{{$data->img}}" alt="" class="img-fluid" width="200px">
            <br>
            <label for="img">重新上傳圖片</label>
            <input type="file" class="form-control" id="img" name="img">
        </div>
        <hr>
        <div class="form-group">
            <label for="img">內頁圖片</label>
            <div class="d-flex">
                @foreach ($data ->newsimg as $item)
                <div class="col-2" data-newsimgid="{{$item->id}}">
                    <button class="btn btn-danger" type="button" data-newsimgid="{{$item->id}}">X</button>
                    <img src="{{$item->img_url}}" alt="" class="img-fluid" width="200px">
                    <input type="text" value="{{$item->sort}}" onchange="ajax_newsimg_sort(this ,{{$item->id}})">
                </div>
                @endforeach
            </div>


            <br>
            <label for="img">重新上傳圖片</label>
            <input type="file" class="form-control" id="newsimg" name="newsimg[]" multiple>
        </div>
        <hr>
        <div class="form-group">
            <label for="title">title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$data->title}}">
        </div>
        <div class="form-group">
            <label for="sort">sort</label>
            <input type="number" class="form-control" id="sort" name="sort" value="{{$data->sort}}">
        </div>
        <div class="form-group">
            <label for="content">content</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{$data->content}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>


    </form>

</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.js"></script>
<script src="{{ asset('js/summernote-zh-TW.js') }}" ></script>
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });// 當col-2 .btn-danger 的按鈕 被按下時 執行一個匿名函式

    function ajax_newsimg_sort(aaa,bbb){
        let sort = aaa.value
        let id = bbb
        $.ajax({
            //   傳送路徑
              url: "{{ url('/home/ajax_newsimg_sort')}}",
            //   方法
              method: 'post',
            //   資料
              data: {
                sort: sort,
                id: id
              },
            //   如果成功回傳
              success: function(result){
                console.log(result);

              }
        });
    }
    $('.col-2 .btn-danger').click(function(){
        // 將綁在按鈕上的data-newsimgid的值取出
        let imgid = (this.getAttribute('data-newsimgid'));

        $.ajax({
            //   傳送路徑
              url: "{{ url('/home/ajax/deletenewsimg') }}",
            //   方法
              method: 'post',
            //   資料
              data: {
                 newsimgid: imgid,
              },
            //   如果成功回傳
              success: function(result){
                //   將col-2綁上ID 指定的ID做remove(移除)
                $(`.col-2[data-newsimgid=${imgid}]`).remove();
              }
        });

    })
    $('#content').summernote({
        placeholder: 'Hello Bootstrap 4',
        tabsize: 2,
        height: 300,
        minHeight: 300,
        lang: 'zh-TW',
        callbacks: {
                    onImageUpload: function(files) {
                        for(let i=0; i < files.length; i++) {
                            $.upload(files[i]);
                        }
                    },
                    onMediaDelete : function(target) {
                        $.delete(target[0].getAttribute("src"));
                    }
                },
      });

      $.upload = function (file) {
                let out = new FormData();
                out.append('file', file, file.name);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: 'POST',
                    url: '/home/ajax_upload_img',
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: out,
                    success: function (img) {
                        $('#content').summernote('insertImage', img);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error(textStatus + " " + errorThrown);
                    }
                });
            };

            $.delete = function (file_link) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: 'POST',
                    url: '/home/ajax_delete_img',
                    data: {file_link:file_link},
                    success: function (img) {
                        console.log("delete:",img);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error(textStatus + " " + errorThrown);
                    }
                });
            }





</script>
@endsection
