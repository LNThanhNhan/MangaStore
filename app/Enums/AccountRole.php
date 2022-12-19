<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;


final class AccountRole extends Enum
{
    public const USER=0;
    public const ADMIN=1;
    public const EMPLOYEE=2;

    public static function getArrayView(): array
    {
        return [
            self::USER => 'Khách hàng',
            self::ADMIN => 'Quản lý',
            self::EMPLOYEE => 'Nhân viên',
        ];
    }

    //Hàm lấy tên quyền
    public static function getRoleName(int $role): string
    {
        return self::getArrayView()[$role];
    }
}
