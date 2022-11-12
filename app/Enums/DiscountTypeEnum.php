<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class DiscountTypeEnum extends Enum
{
    public const PHAN_TRAM = 0;
    public const SO_TIEN = 1;

    public static function getArrayView(): array
    {
        return [
            'Phần trăm' =>self::PHAN_TRAM,
            'Số tiền' => self::SO_TIEN,
        ];
    }

    //Tham số đầu vào phải là kiểu int
    public static function getDiscountTypeName($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }

    //Trả về mảng các loại giảm giá
    public static function getArrayDiscountType(): array
    {
        return [
            'Phần trăm',
            'Số tiền',
        ];
    }
}
