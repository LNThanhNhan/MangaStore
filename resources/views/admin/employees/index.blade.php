@extends('layout.master')
@section('content')
    <h1>Quản lý nhân viên</h1>
    <a class="btn btn-success" href="{{route('admin.employees.create')}}">Thêm</a>
    <form class="float-end" action="">
        <label>
            Tìm kiếm:
        </label>
        <input type="search" name="q" id="" value="{{ $search }}">
    </form>
    <table class="table table-striped">
        <tr>
            <th>#</th>
            <th>Tên nhân viên</th>
            <th>Giới tính</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Lương</th>
            <th>Trạng thái</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
        @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->id }}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->gender_name }}</td>
                <td>{{ $employee->account->email }}</td>
                <td>{{ $employee->phone }}</td>
                <td>{{ $employee->salary_VND }}</td>
                <td>{{ $employee->status_name }}</td>

                <td>
                    <a href="{{route('admin.employees.edit',$employee)}}">
                        Sửa
                    </a>
                </td>
                <td>
                    <form action="{{route('admin.employees.destroy',$employee)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <nav>
        <ul class="pagination pagination-rounded mb-0">
            <li>
                {{$employees->links()}}
            </li>
        </ul>
    </nav>
@endsection
