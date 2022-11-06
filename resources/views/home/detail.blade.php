<h1>{{$product->name}}</h1>
<img src="{{ $product->image}}" alt="Ảnh minh họa sản phẩm" width="250" height="300">
<p>{{ $product->description }}</p>
<p>{{$product->price_VND}}</p>
<p>Tác giả</p>
<a href="{{ route('home.author',$product->author_slug)}}">{{$product->author}}</a>
<p>Thể loại</p>
<p>{{$product->category_name}}</p>
<a href="{{route('home.collection',$product->collection_slug)}}">{{$product->collection}}</a>
