<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;


final class GoogleRecaptchaScore extends Enum
{
    public const DANG_KY = 0.7;
    public const DANG_NHAP = 0.5;
    public const DAT_HANG = 0.7;
}
