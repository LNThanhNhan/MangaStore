<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ShippingFee extends Enum
{
    public const HN_HCM = 20000;
    public const OTHER = 30000;

    public static function getArray(): array
    {
        return [
            'hn_hcm' => self::HN_HCM,
            'tinh_thanh'=>self::OTHER,
        ];
    }
}
