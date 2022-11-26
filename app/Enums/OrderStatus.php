<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStatus extends Enum
{
    public const CHO_XAC_NHAN = 0;
    public const DANG_GIAO_HANG = 1;
    public const DA_GIAO_HANG = 2;
    public const GIAO_HANG_THAT_BAI = 3;
    public const DA_HUY = 4;

    public static function getArray(): array
    {
        return [
            self::CHO_XAC_NHAN => 'Chờ xác nhận',
            self::DANG_GIAO_HANG => 'Đang giao hàng',
            self::DA_GIAO_HANG => 'Đã giao hàng',
            self::GIAO_HANG_THAT_BAI => 'Giao hàng thất bại',
            self::DA_HUY => 'Đã hủy',
        ];
    }

    //Lấy tên trạng thái đơn hàng
    public static function getName(int $value): string
    {
        return self::getArray()[$value];
    }
}
