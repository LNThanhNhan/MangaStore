<?php

namespace App\Http\Controllers\User;

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

    //Hàm trả về view profile của user với biến user
    public function profile()
    {
        $user = Auth::user()->user;
        $provinces=Province::getArrayView();
        return view('user.info',[
            'user' => $user,
            'provinces'=>$provinces,
        ]);
    }

    //Hàm cập nhật thông tin user và cập nhật mật khẩu nếu có
    public function update(UpdateUserRequest $request, $userId)
    {
        if($request->get('province')===0){
            $request['province']=null;
        }
        $user = $this->model->findOrFail($userId);
        $user->update($request->validated());
        if($request->has('new_password')){
            $user->account->password = bcrypt($request->get('new_password'));
            $user->account->save();
        }
        $user->save();
        return redirect(route('user.profile.info'))->with('success', 'Cập nhật thông tin thành công');
    }
}
