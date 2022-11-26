@extends('layout.master')
@section('content')
<h1>DANH SÁCH BÀI VIẾT TRÊN TRANG</h1>
<a class="btn btn-success" href="{{route('admin.articles.create')}}">Thêm</a>
<form class="float-end" action="">
    <label>
        Tìm kiếm:
    </label>
    <input type="search" name="q" id="" value="{{ $search }}">
</form>
<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>Tiêu đề</th>
        <th>Ảnh</th>
        <th>Mô tả</th>
        <th>Ngày đăng</th>
        <th>Sửa</th>
        <th>Xóa</th>
    </tr>
    @foreach($articles as $article)
        <tr>
            <td>{{$article->id}}</td>
            <td>{{$article->title}}</td>
            <td><img src="{{$article->image}}" width="160px" height="90px" alt="Ảnh đại diện cho bài viết"></td>
            <td>{{$article->description}}</td>
            <td>{{$article->created_date}}</td>
            <td>
                <a href="{{route('admin.articles.edit',$article->id)}}">Sửa</a>
            </td>
            <td>
                <form action="{{route('admin.articles.destroy',$article->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Xóa</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
<nav>
    <ul class="pagination pagination-rounded mb-0">
        <li>
            {{$articles->links()}}
        </li>
    </ul>
</nav>
@endsection
