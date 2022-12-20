<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Enums\Province;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        $this->model = (new User())->query();
    }

    //Hàm trả về view index của tất cả user trong hệ thống
    public function index(Request $request)
    {
        $search = $request->query->get('q');
        $users =$this->model
            ->where('name','like','%'.$search.'%')
            ->paginate(10);

        //Append dùng để thêm vào phần tìm kiếm
        //nếu không thì khi sang trang sẽ bị mất
        $users ->appends(['q'=>$search]);
        return view('admin.users.index',[
            'users' => $users,
            'search' => $search,
        ]);
    }

    //Hàm trả về view edit của user
    public function edit($id)
    {
        $user = $this->model->findOrFail($id);
        return view('admin.users.edit',[
            'user' => $user,
        ]);
    }

    //Hàm cập nhật thông tin user và cập nhật mật khẩu nếu có
//    public function update(UpdateUserRequest $request,User $user)
//    {
//        if($request->get('province')===0){
//            $request['province']=null;
//        }
//        $user->update($request->all());
//        return redirect(route('user.profile.info'))->with('success', 'Cập nhật thông tin thành công');
//    }

    //Hàm xóa user
    public function destroy($userId)
    {
        $user = $this->model->findOrFail($userId);
        //Kiểm tra xem người dùng có đơn hàng nào đang gioa hàng không
        //nếu có thì báo lỗi
        if($user->orders->where('status',OrderStatus::DANG_GIAO_HANG)->count()>0){
            return redirect(route('admin.users.index'))->with('error', 'Không thể xóa tài khoản khi đang có đơn hàng đang giao');
        }
        $user->delete();
        $user->account->delete();
        return redirect(route('admin.users.index'))->with('success', 'Xóa tài khoản thành công');
    }
}
