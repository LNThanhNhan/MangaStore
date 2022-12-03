<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class EmployeeStatus extends Enum
{
    public const DANG_LAM = 0;
    public const DA_NGHI = 1;

    //hàm static trả về mảng array view với key là tên trạng thái
    //value là giá trị của trạng thái
    public static function getArrayView(): array
    {
        return [
            'Đang làm' => self::DANG_LAM,
            'Đã nghỉ' => self::DA_NGHI,
        ];
    }

    //Tham số đầu vào phải là kiểu int
    public static function getStatusName($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }
}

