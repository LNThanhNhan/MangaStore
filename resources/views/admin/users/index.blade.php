@extends('layout.master')
@section('content')
    <h1>Quản lý khách hàng</h1>
    <form class="float-end" action="">
        <label>
            Tìm kiếm:
        </label>
        <input type="search" name="q" id="" value="{{ $search }}">
    </form>
    <table class="table table-striped">
        <tr>
            <th>#</th>
            <th>Tên khách hàng</th>
            <th>Giới tính</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->gender_name }}</td>
                <td>{{ $user->account->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>
                    <a href="{{route('admin.users.edit',$user->id)}}">
                        Sửa
                    </a>
                </td>
                <td>
                    <form action="{{route('admin.users.destroy',$user)}}" method="post">
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
                {{$users->links()}}
            </li>
        </ul>
    </nav>
@endsection
