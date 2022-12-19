@extends('layout.admin.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">

                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$orderCreatedToday}}</h3>

                            <p>Đơn hàng mới</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{format_priceVND($revenueToday)}}</h3>

                            <p>Doanh thu hôm nay</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$userCreatedToday}}</h3>

                            <p>Đăng ký mới</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$productQuantity}}</h3>

                            <p>Sản phẩm sắp hết</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-book"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!<div class="col-md-12">
                <div class="tile">
                    <div class="row">
                        <div class="col-md-3">
                            <div>
                                <br><br>
                                <h5 class="tile-title">TOP 10 SẢN PHẨM BÁN CHẠY</h5>
                            </div>
                        </div>
                        <div class="col-md-9">

                        <form action="{{route('admin.home.index')}}">
                                <br>
                                <br>
                                <div class="row" style="display:inline-flex">
                                    <div class="col-1" style="display:inline-flex">Từ</div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <input type="date" name="fromDate" id="input" class="form-control" value="{{ $fromDate  }}"  title="">
                                        </div>
                                    </div>
                                    <div class="col-1" style="display:inline-flex">đến</div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <input type="date" name="toDate" id="input" class="form-control" value="{{ $toDate }}"  title="">
                                        </div>
                                    </div>
                                    <div class="col-1" style="display:inline-flex">Thể loại</div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <select name="category" id="" class="form-control custom-select">
                                                <option value="">Tất cả</option>
                                                @foreach($arrCategory as $key => $value)
                                                <option value="{{ $value }}" {{ $value === $category ? 'selected' : '' }}>{{ $key }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary " >Xem</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Doanh thu</th>
                            <th>Thể loại</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($topProducts as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ format_priceVND($product->total_price) }}</td>
                                    <td>{{ getProductCategoryName($product->category)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

{{--@extends('layout.master')--}}
{{--@section('content')--}}
{{--<form action="{{ route('logout') }}" method="post">--}}
{{--    @csrf--}}
{{--    <button type="submit">Đăng xuất</button>--}}
{{--</form>--}}
{{--<form action="{{route('admin.home.index')}}" >--}}
{{--    Từ ngày--}}
{{--    <input type="date" name="fromDate" value="{{ $fromDate  }}">--}}
{{--    Đến ngày--}}
{{--    <input type="date" name="toDate" value="{{ $toDate }}">--}}
{{--    Thể loại--}}
{{--    <select name="category" id="">--}}
{{--        <option value=0>Tất cả</option>--}}
{{--        @foreach($arrCategory as $key => $value)--}}
{{--        <option value="{{ $value }}" {{ $value === $category ? 'selected' : '' }}>{{ $key }}</option>--}}
{{--        @endforeach--}}
{{--    </select>--}}

{{--    <button type="submit">Tìm kiếm</button>--}}
{{--</form>--}}
{{--<table>--}}
{{--    <tr>--}}
{{--        <th>Mã sản phẩm</th>--}}
{{--        <th>Tên sản phẩm</th>--}}
{{--        <th>Doanh thu</th>--}}
{{--        <th>Danh mục</th>--}}
{{--    </tr>--}}
{{--    @foreach($topProducts as $product)--}}
{{--    <tr>--}}
{{--        <td>{{ $product->id }}</td>--}}
{{--        <td>{{ $product->name }}</td>--}}
{{--        <td>{{ $product->total_price }}</td>--}}
{{--        <td>{{ getProductCategoryName($product->category)}}</td>--}}
{{--    </tr>--}}
{{--    @endforeach--}}
{{--</table>--}}
{{--@endsection--}}
