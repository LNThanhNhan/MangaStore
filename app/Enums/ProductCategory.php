<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProductCategory extends Enum
{
    public const HAI_HUOC = 1;
    public const KINH_DI = 2;
    public const LANG_MAN = 3;
    public const HOC_DUONG = 4;
    public const GIA_TUONG = 5;
    public const SIEU_NHIEN = 6;
    public const TAM_LY = 7;
    public const THE_THAO = 8;
    public const DOI_THUONG = 9;
    public const HANH_DONG = 10;
    public const PHIEU_LUU = 11;
    public const NGUOI_TRUONG_THANH = 12;
    public const THANH_THIEU_NIEN = 13;

    public static function getArrayView(): array
    {
        return [
            'Hài hước' => self::HAI_HUOC,
            'Kinh dị' => self::KINH_DI,
            'Lãng mạn' => self::LANG_MAN,
            'Học đường' => self::HOC_DUONG,
            'Giả tưởng' => self::GIA_TUONG,
            'Siêu nhiên' => self::SIEU_NHIEN,
            'Tâm lý' => self::TAM_LY,
            'Thể thao' => self::THE_THAO,
            'Đời thường' => self::DOI_THUONG,
            'Hành động' => self::HANH_DONG,
            'Phiêu lưu' => self::PHIEU_LUU,
            'Người trưởng thành' => self::NGUOI_TRUONG_THANH,
            'Thanh thiếu niên' => self::THANH_THIEU_NIEN,
        ];
    }

    //Tham số đầu vào phải là kiểu int
    public static function getCategoryName($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }
    public const ARRAY_NAME=[
        'Hài hước',
        'Kinh dị' ,
        'Lãng mạn',
        'Học đường',
        'Giả tưởng',
        'Siêu nhiên',
        'Tâm lý' ,
        'Thể thao',
        'Đời thường',
        'Hành động' ,
        'Phiêu lưu',
        'Người trưởng thành',
        'Thanh thiếu niên',
    ];
}

