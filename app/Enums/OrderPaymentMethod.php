<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderPaymentMethod extends Enum
{
    public const COD = 1;
    public const NGAN_HANG = 2;
    public const ZALO_PAY = 3;
    public const MOMO = 4;

    //array view
    public static function getArrayView(): array
    {
        return [
            'Thanh toán khi nhận hàng' => self::COD,
            'Thanh toán qua ngân hàng' => self::NGAN_HANG,
            'Thanh toán qua Zalo Pay' => self::ZALO_PAY,
            'Thanh toán qua Momo' => self::MOMO,
        ];
    }

    //short array view
    public static function getShortArrayView(): array
    {
        return [
            'COD' => self::COD,
            'Ngân hàng' => self::NGAN_HANG,
            'Zalo Pay' => self::ZALO_PAY,
            'Momo' => self::MOMO,
        ];
    }

    //Trả về tên phương thức thanh toán
    public static function getPaymentMethodName($value): string
    {
        return array_search($value, self::getShortArrayView(), true);
    }
}
