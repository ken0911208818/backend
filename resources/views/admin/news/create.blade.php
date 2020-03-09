@extends('layouts/app');


@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')




<div class="container">

    <form method="post" action="/home/news/store" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="img">主要照片</label>
            <input type="file" class="form-control" id="img" name="img">
        </div>
        <div class="form-group">
            <label for="newsimg">多張照片</label>
            <input type="file" class="form-control" id="newsimg" name="newsimg[]" multiple>
        </div>
        <div class="form-group">
            <label for="title">title</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
            <label for="content">content</label>
            <textarea type="text" class="form-control" id="content" name="content" cols="30" rows="10"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>


@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.js"></script>
<script src="{{ asset('js/summernote-zh-TW.js') }}" ></script>
<script>
    $('#content').summernote({
        placeholder: 'Hello Bootstrap 4',
        tabsize: 2,
        height: 300,
        minHeight: 300,
        lang: 'zh-TW',
        callbacks: {
            // 當圖片上傳時執行匿名含式
                    onImageUpload: function(files) {
                        // 計算上傳多少張圖片
                        for(let i=0; i < files.length; i++) {
                            // 執行upload這個函式
                            $.upload(files[i]);
                        }
                    },
                    // 當圖片刪除時執行匿名函式
                    onMediaDelete : function(target) {
                        $.delete(target[0].getAttribute("src"));
                    }
                },
      });

      $.upload = function (file) {
                // FormData  介紹https://developer.mozilla.org/zh-TW/docs/Web/API/FormData 介面為一個表單資料
                let out = new FormData();
                // 追加新值到 FormData 物件已有的對應鍵上；若該鍵不存在，則為其追加新的鍵
                // formData.append(欄位, value, 檔案名稱);
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
                        // summernote內的函式 可以插入圖片進content裡
                        $('#content').summernote('insertImage', img);
                    },
                    // 如果檔案類型有誤時，回傳錯誤訊息
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
                    // data:(欄位:值)
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
