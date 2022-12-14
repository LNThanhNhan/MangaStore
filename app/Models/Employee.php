<?php

namespace App\Models;

use App\Enums\EmployeeStatus;
use App\Enums\ProductCategory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'birthday',
        'gender',
        'phone',
        'address',
        'province',
        'salary',
        'status',
    ];

    //Thiết lập quan hệ 1-1 thuộc về account
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    //Làm thuộc tính lấy tên giới tính nếu gender = 1 thì là Nam
    //nếu gender = 0 thì là Nữ
    protected function genderName(): Attribute
    {
        return Attribute::make(
            get: fn($value,$attribute)=>$attribute['gender'] === 1 ? 'Nam' : 'Nữ',
        );
    }

    //Làm thuộc tính lương theo định dạng VNĐ
    protected function salaryVND(): Attribute
    {
        return Attribute::make(
            get: fn($value,$attribute)=>number_format($attribute['salary']).' đ',
        );
    }

    //Làm thuộc tính tên trạng thái làm việc
    protected function statusName(): Attribute
    {
        return Attribute::make(
            get: fn($value,$attribute)=>EmployeeStatus::getStatusName($attribute['status']),
        );
    }
}
