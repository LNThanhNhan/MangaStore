<form action="{{route('article-store')}}" method="post">
    @csrf
    Title
    <input type="text" name="title" >
    <br>
    Content
    <textarea name="content" cols="50" rows="10" >    </textarea>
    <br>
    {{--    Chỗ này sau này đổi phần nhập đường link thành chọn file--}}
    Thumbnail
    <input type="text" name="thumbnail" >
    <br>
    Created
    <input type="date" name="created">
    <br>
    <button>
        <input type="submit" value="Save">
    </button>
</form>
