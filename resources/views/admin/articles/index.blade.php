<h1>DANH SÁCH BÀI VIẾT TRÊN TRANG</h1>
<a href="{{route('article.create')}}">Thêm</a>
<table border="1" width="100%">
    <tr>
        <th>#</th>
        <th>title</th>
        <th>slug</th>
        <th>image</th>
        <th>content</th>
        <th>created</th>
    </tr>
    @foreach($articles as $article)
        <tr>
            <td>{{$article->id}}</td>
            <td>{{$article->title}}</td>
            <td>{{$article->slug}}</td>
            <td><img src="{{$article->thumbnail}}" alt="thumbnail"></td>
            <td>{{$article->content}}</td>
            <td>{{$article->created}}</td>
        </tr>
    @endforeach
</table>
