<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Province extends Enum
{
    //set each province name as a constant with numeric value
    public const ANGIANG = 1;
    public const BA_RIA_VUNG_TAU = 2;
    public const BACGIANG = 3;
    public const BACKAN = 4;
    public const BACLIEU = 5;
    public const BACNINH = 6;
    public const BENTRE = 7;
    public const BINHDINH = 8;
    public const BINHDUONG = 9;
    public const BINHPHUOC = 10;
    public const BINHTHUAN = 11;
    public const CAMAU = 12;
    public const CANTHO = 13;
    public const CAOBANG = 14;
    public const DANANG = 15;
    public const DAKLAK = 16;
    public const DAKNONG = 17;
    public const DIENBIEN = 18;
    public const DONGNAI = 19;
    public const DONGTHAP = 20;
    public const GIALAI = 21;
    public const HAGIANG = 22;
    public const HANAM = 23;
    public const HANOI = 24;
    public const HATINH = 25;
    public const HAIDUONG = 26;
    public const HAIPHONG = 27;
    public const HAUGIANG = 28;
    public const HOABINH = 29;
    public const HOCHIMINH = 30;
    public const HUNGYEN = 31;
    public const KHANHHOA = 32;
    public const KIENGIANG = 33;
    public const KONTUM = 34;
    public const LAICHAU = 35;
    public const LAMDONG = 36;
    public const LANGSON = 37;
    public const LAOCAI = 38;
    public const LONGAN = 39;
    public const NAMDINH = 40;
    public const NGHEAN = 41;
    public const NINHBINH = 42;
    public const NINHTHUAN = 43;
    public const PHUTHO = 44;
    public const PHUYEN = 45;
    public const QUANGBINH = 46;
    public const QUANGNAM = 47;
    public const QUANGNGAI = 48;
    public const QUANGNINH = 49;
    public const QUANGTRI = 50;
    public const SOC_TRANG = 51;
    public const SONLA = 52;
    public const TAYNINH = 53;
    public const THAIBINH = 54;
    public const THAINGUYEN = 55;
    public const THANHHOA = 56;
    public const THUATHIENHUE = 57;
    public const TIENGIANG = 58;
    public const TRAVINH = 59;
    public const TUYENQUANG = 60;
    public const VINHLONG = 61;
    public const VINHPHUC = 62;
    public const YENBAI = 63;

    //get array view function to return an array of province name as string key and numeric value as value
    public static function getArrayView(): array
    {
        return [
            'An Giang' => self::ANGIANG,
            'Bà Rịa - Vũng Tàu' => self::BA_RIA_VUNG_TAU,
            'Bắc Giang' => self::BACGIANG,
            'Bắc Kạn' => self::BACKAN,
            'Bạc Liêu' => self::BACLIEU,
            'Bắc Ninh' => self::BACNINH,
            'Bến Tre' => self::BENTRE,
            'Bình Định' => self::BINHDINH,
            'Bình Dương' => self::BINHDUONG,
            'Bình Phước' => self::BINHPHUOC,
            'Bình Thuận' => self::BINHTHUAN,
            'Cà Mau' => self::CAMAU,
            'Cần Thơ' => self::CANTHO,
            'Cao Bằng' => self::CAOBANG,
            'Đà Nẵng' => self::DANANG,
            'Đắk Lắk' => self::DAKLAK,
            'Đắk Nông' => self::DAKNONG,
            'Điện Biên' => self::DIENBIEN,
            'Đồng Nai' => self::DONGNAI,
            'Đồng tháp' => self::DONGTHAP,
            'Gia Lai' => self::GIALAI,
            'Hà Giang' => self::HAGIANG,
            'Hà Nam' => self::HANAM,
            'Hà Nội' => self::HANOI,
            'Hà Tĩnh' => self::HATINH,
            'Hải Dương' => self::HAIDUONG,
            'Hải Phòng' => self::HAIPHONG,
            'Hậu Giang' => self::HAUGIANG,
            'Hòa Bình' => self::HOABINH,
            'Hồ Chí Minh' => self::HOCHIMINH,
            'Hưng Yên' => self::HUNGYEN,
            'Khánh Hòa' => self::KHANHHOA,
            'Kiên Giang' => self::KIENGIANG,
            'Kon Tum' => self::KONTUM,
            'Lai Châu' => self::LAICHAU,
            'Lâm Đồng' => self::LAMDONG,
            'Lạng Sơn' => self::LANGSON,
            'Lào Cai' => self::LAOCAI,
            'Long An' => self::LONGAN,
            'Nam Định' => self::NAMDINH,
            'Nghệ An' => self::NGHEAN,
            'Ninh Bình' => self::NINHBINH,
            'Ninh Thuận' => self::NINHTHUAN,
            'Phú Thọ' => self::PHUTHO,
            'Phú Yên' => self::PHUYEN,
            'Quảng Bình' => self::QUANGBINH,
            'Quảng Nam' => self::QUANGNAM,
            'Quảng Ngãi' => self::QUANGNGAI,
            'Quảng Ninh' => self::QUANGNINH,
            'Quảng Trị' => self::QUANGTRI,
            'Sóc Trăng' => self::SOC_TRANG,
            'Sơn La' => self::SONLA,
            'Tây Ninh' => self::TAYNINH,
            'Thái Bình' => self::THAIBINH,
            'Thái Nguyên' => self::THAINGUYEN,
            'Thanh Hóa' => self::THANHHOA,
            'Thừa Thiên Huế' => self::THUATHIENHUE,
            'Tiền Giang' => self::TIENGIANG,
            'Trà Vinh' => self::TRAVINH,
            'Tuyên Quang' => self::TUYENQUANG,
            'Vĩnh Long' => self::VINHLONG,
            'Vĩnh Phúc' => self::VINHPHUC,
            'Yên Bái' => self::YENBAI,
        ];
    }

    //trả về tên tỉnh khi truyền vào mã tỉnh
    public static function getProvinceNameById($provinceId): string
    {
        $provinces = self::getArrayView();
        return array_search($provinceId, $provinces,true);
    }

    //Trả về mã tỉnh khi truyền vào tên tỉnh
    public static function getProvinceIdByName($provinceName): int
    {
        $provinces = self::getArrayView();
        return $provinces[$provinceName];
    }

    public static function getProvincesArray(): array
    {
        return [
            "An Giang","Bà Rịa – Vũng Tàu","Bắc Giang",
            "Bắc Kạn","Bạc Liêu","Bắc Ninh","Bến Tre","Bình Định","Bình Dương",
            "Bình Phước","Bình Thuận","Cà Mau","Cần Thơ","Cao Bằng","Đà Nẵng",
            "Đắk Lắk","Đắk Nông","Điện Biên","Đồng Nai","Đồng Tháp","Gia Lai",
            "Hà Giang","Hà Nam","Hà Nội","Hà Tĩnh","Hải Dương","Hải Phòng","Hậu Giang",
            "Hòa Bình","Hồ Chí Minh","Hưng Yên","Khánh Hòa","Kiên Giang","Kon Tum","Lai Châu",
            "Lâm Đồng","Lạng Sơn","Lào Cai","Long An","Nam Định","Nghệ An",
            "Ninh Bình","Ninh Thuận","Phú Thọ","Phú Yên","Quảng Bình","Quảng Nam",
            "Quảng Ngãi","Quảng Ninh","Quảng Trị","Sóc Trăng","Sơn La","Tây Ninh",
            "Thái Bình","Thái Nguyên","Thanh Hóa","Thừa Thiên Huế","Tiền Giang",
            "Trà Vinh","Tuyên Quang","Vĩnh Long","Vĩnh Phúc","Yên Bái"
        ];
    }
}
