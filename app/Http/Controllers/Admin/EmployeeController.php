<?php

namespace App\Http\Controllers\Admin;

use App\Enums\EmployeeStatus;
use App\Enums\Province;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Models\Account;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class EmployeeController extends Controller
{
    private Builder $model;
    public function __construct()
    {
        $this->model = (new Employee())->query();
        View::share('arrProvince',Province::getArrayView());
    }

    public function index(Request $request)
    {
        $search = $request->query->get('q');
        $employees =$this->model
            ->where('name','like','%'.$search.'%')
            ->where('id','like','%'.$search.'%')
            ->paginate(10);

        //Append dùng để thêm vào phần tìm kiếm
        //nếu không thì khi sang trang sẽ bị mất
        $employees ->appends(['q'=>$search]);
        return view('admin.employees.index',[
            'employees' => $employees,
            'search' => $search,
        ]);
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(StoreEmployeeRequest $request)
    {
        //tạo tài khoản mới cho nhân viên với role =1
        //sau đó lấy id của tài khoản đó và thêm thông tin để lưu vào bảng nhân viên
        $account = new Account();
        $account->fill($request->validated());
        $account->password = bcrypt($request->password);
        $account->role = $request->get('role');
        $employee = new Employee();
        $account->save();
        $employee->fill($request->validated());
        $employee->account_id=$account->id;
        $employee->status=EmployeeStatus::DANG_LAM;
        $employee->save();
        return redirect(route('admin.employees.index'))->with('success','Thêm nhân viên mới thành công');
    }

    public function edit($employeeID)
    {
        $employee = $this->model->findOrFail($employeeID);
        return view('admin.employees.edit',[
            'employee' => $employee,
        ]);
    }

    public function update(UpdateEmployeeRequest $request, $employeeID)
    {
        $employee = $this->model->findOrFail($employeeID);
        if($employee->id===Auth::user()->employee->id){
            return redirect(route('admin.employees.index'))->with('error','Không thể sửa thông tin của chính mình');
        }
        $employee->fill($request->validated());
        $employee->account->role=$request->get('role');
        $employee->save();
        return redirect(route('admin.employees.index'))->with('success','Cập nhật nhân viên thành công');
    }

    public function destroy($employeeID)
    {
        $employee = $this->model->find($employeeID);
        if($employee->id===Auth::user()->employee->id){
            return redirect(route('admin.employees.index'))->with('error','Không thể xóa chính mình');
        }
        $employee->delete();
        $employee->account->delete();
        return redirect(route('admin.employees.index'))->with('success','Xóa nhân viên thành công');
    }
}
