@extends('layouts/app');
@csrf

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection


@section('content')
<div class="container">

    <a href="/home/ProductType/create" class="btn btn-success">新增</a>
    <table id="example" class="table table-striped table-bordered " style="width:100%">
        <thead>
            <tr>
                <th>type</th>
                <th>sort</th>
                <th width='80px'></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>

                <td>{{$item->type}}</td>
                <td>{{$item->sort}}</td>
                <td>
                    <a href="/home/ProductType/{{$item->id}}/edit" class="btn btn-success btn-sm">修改</a>
                    <button class="btn btn-danger btn-sm" onclick="show_confirm({{$item->id}})">刪除</button>

                <form id="news_delete{{$item->id}}" action="/home/ProductType/{{$item->id}}" method="POST" style="display: none;">

                        @csrf
                        @method('DELETE')
                    </form>
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
        $('#example').DataTable({
            "order": [ 1, 'desc' ]
        });
    } );
</script>
<script>
function show_confirm(id)
{
var r=confirm("你要刪除嗎!");
if (r==true)
  {
    document.getElementById('news_delete'+id).submit();
  }
else
  {

  }
}

</script>
@endsection
