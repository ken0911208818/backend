@extends('layouts/app');
@csrf

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection


@section('content')
<div class="container">

    <a href="/home/product/create" class="btn btn-success">新增</a>
    <table id="example" class="table table-striped table-bordered " style="width:100%">
        <thead>
            <tr>
                <th>img</th>
                <th>title</th>
                <th  width='80px'></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>
                    <img src="{{$item->img}}" alt="" srcset="" style="width:50px; height=50px;">
                </td>
                <td>
                    {{$item->kinds}}
                </td>
                <td>
                    <a href="/home/news/update/{{$item->id}}" class="btn btn-success btn-sm">修改</a>
                    <a href="" class="btn btn-danger btn-sm">刪除</a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>



@endsection


@section('js')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
@endsection
