@extends('layout.admin.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách mã </h1>

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Danh sách mã khuyến mãi</li>
                    </ol>
                </div>
            </div>
            <a href="{{route('admin.discounts.create')}}" type="submit" class="btn btn-primary">+ Thêm mã</a>
            <form class="float-end" action="">
                Tìm kiếm
                <input type="search" name="q" id="" value="{{ $search }}">
                <button type="submit" class="btn btn-primary">Tìm</button>
            </form>
            @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                        <tr>
                            <th>Tên mã</th>
                            <th>Mã code</th>
                            <th>Từ ngày</th>
                            <th>Đến ngày</th>
                            <th>Loại mã giảm</th>
                            <th>Giá trị giảm(%/đ)</th>
                            <th><span class="MuiIconButton-label"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" font-size="24" style="color: rgb(163, 168, 175);">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Zm-2 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" fill="currentColor"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="m2.43 8.576 1.82-3.152a1 1 0 0 1 1.17-.453l1.836.585a7.971 7.971 0 0 1 1.535-.886l.412-1.884A1 1 0 0 1 10.18 2h3.64a1 1 0 0 1 .977.786l.412 1.884a7.973 7.973 0 0 1 1.535.886l1.837-.585a1 1 0 0 1 1.17.453l1.82 3.152a1 1 0 0 1-.193 1.24l-1.425 1.298a7.981 7.981 0 0 1 0 1.772l1.425 1.299a1 1 0 0 1 .192 1.239l-1.82 3.152a1 1 0 0 1-1.17.453l-1.836-.585a7.967 7.967 0 0 1-1.535.886l-.412 1.884a1 1 0 0 1-.977.786h-3.64a1 1 0 0 1-.977-.786l-.412-1.884a7.967 7.967 0 0 1-1.535-.886l-1.837.585a1 1 0 0 1-1.17-.453l-1.82-3.152a1 1 0 0 1 .193-1.24l1.425-1.298a7.973 7.973 0 0 1 0-1.772L2.622 9.815a1 1 0 0 1-.192-1.239ZM13.015 4l.458 2.092.933.41c.211.092.416.196.614.312l.003.002c.184.107.363.224.536.351l.82.604 2.042-.65 1.015 1.758-1.583 1.443.112 1.012c.024.221.037.442.036.663v.004c0 .222-.012.443-.036.665l-.112 1.012 1.583 1.443-1.015 1.758-2.041-.65-.821.604a5.99 5.99 0 0 1-.543.355l-.003.002a5.97 5.97 0 0 1-.607.309l-.933.409L13.015 20h-2.03l-.458-2.092-.933-.41a5.991 5.991 0 0 1-.573-.288l-.003-.002a5.975 5.975 0 0 1-.577-.375l-.82-.604-2.042.65-1.015-1.758 1.583-1.443-.112-1.012a5.973 5.973 0 0 1-.036-.664v-.004c0-.221.011-.443.036-.664l.112-1.012-1.583-1.443L5.58 7.121l2.041.65.821-.604a5.97 5.97 0 0 1 .57-.371l.004-.002a5.97 5.97 0 0 1 .58-.293l.932-.409L10.985 4h2.03Z" fill="currentColor"></path>
                                        </svg></span></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($discounts as $discount)

                            <tr>
                            <td>{{$discount->name}}</td>
                            <td>{{$discount->code}}</td>
                            <td>{{ $discount->begin_at }}</td>
                            <td>{{ $discount->end_at }}</td>
                            <td>{{ $discount->type_name }}</td>
                            <td>
                                @if($discount->value < 100)
                                {{ $discount->value }}%
                                @else
                                {{ format_priceVND($discount->value) }}
                                @endif
                            </td>

                            <td class="project-actions text-right">
                                <a href="{{route('admin.discounts.edit',$discount)}}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>

                                </a>
                                <form action="{{route('admin.discounts.destroy',$discount->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button id="btn1" class="btn btn-danger" onclick="return confirm('Mã giảm giá sẽ bị xóa')">
                                        <i class="fas fa-trash"> </i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
{{--@extends('layout.master')--}}
{{--@section('content')--}}
{{--<h1>Quản lý mã giảm giá</h1>--}}
{{--<a class="btn btn-success" href="{{route('admin.discounts.create')}}">Thêm</a>--}}
{{--<form class="float-end" action="">--}}
{{--    <label>--}}
{{--        Tìm kiếm:--}}
{{--    </label>--}}
{{--    <input type="search" name="q" id="" value="{{ $search }}">--}}
{{--</form>--}}
{{--<table class="table table-striped">--}}
{{--    <tr>--}}
{{--        <th>#</th>--}}
{{--        <th>Tên mã giảm giá</th>--}}
{{--        <th>Mã giảm giá</th>--}}
{{--        <th>Loại mã giảm</th>--}}
{{--        <th>Đơn hàng tối thiểu</th>--}}
{{--        <th>Giảm</th>--}}
{{--        <th>Giảm tối đa</th>--}}
{{--        <th>Số lượng</th>--}}
{{--        <th>Thời gian bắt đầu</th>--}}
{{--        <th>Thời gian kết thúc</th>--}}
{{--        <th>Sửa</th>--}}
{{--        <th>Xóa</th>--}}
{{--    </tr>--}}
{{--    @foreach($discounts as $discount)--}}
{{--    <tr>--}}
{{--        <td>{{ $discount->id }}</td>--}}
{{--        <td>{{ $discount->name }}</td>--}}
{{--        <td>{{ $discount->code }}</td>--}}
{{--        <td>{{ $discount->type_name }}</td>--}}
{{--        <td>{{ $discount->min_order }}</td>--}}
{{--        <td>{{ $discount->value }}</td>--}}
{{--        <td>{{ $discount->max_discount }}</td>--}}
{{--        <td>{{ $discount->quantity }}</td>--}}
{{--        <td>{{ $discount->begin_at }}</td>--}}
{{--        <td>{{ $discount->end_at }}</td>--}}
{{--        <td>--}}
{{--            <a href="{{route('admin.discounts.edit',$discount)}}">--}}
{{--                Sửa--}}
{{--            </a>--}}
{{--        </td>--}}
{{--        <td>--}}
{{--            <form action="{{route('admin.discounts.destroy',$discount)}}" method="post">--}}
{{--                @csrf--}}
{{--                @method('DELETE')--}}
{{--                <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Xóa</button>--}}
{{--            </form>--}}
{{--        </td>--}}
{{--    </tr>--}}
{{--    @endforeach--}}
{{--</table>--}}
{{--<nav>--}}
{{--    <ul class="pagination pagination-rounded mb-0">--}}
{{--        <li>--}}
{{--            {{$discounts->links()}}--}}
{{--        </li>--}}
{{--    </ul>--}}
{{--</nav>--}}
{{--@endsection--}}
