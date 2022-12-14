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
            'B?? R???a - V??ng T??u' => self::BA_RIA_VUNG_TAU,
            'B???c Giang' => self::BACGIANG,
            'B???c K???n' => self::BACKAN,
            'B???c Li??u' => self::BACLIEU,
            'B???c Ninh' => self::BACNINH,
            'B???n Tre' => self::BENTRE,
            'B??nh ?????nh' => self::BINHDINH,
            'B??nh D????ng' => self::BINHDUONG,
            'B??nh Ph?????c' => self::BINHPHUOC,
            'B??nh Thu???n' => self::BINHTHUAN,
            'C?? Mau' => self::CAMAU,
            'C???n Th??' => self::CANTHO,
            'Cao B???ng' => self::CAOBANG,
            '???? N???ng' => self::DANANG,
            '?????k L???k' => self::DAKLAK,
            '?????k N??ng' => self::DAKNONG,
            '??i???n Bi??n' => self::DIENBIEN,
            '?????ng Nai' => self::DONGNAI,
            '?????ng th??p' => self::DONGTHAP,
            'Gia Lai' => self::GIALAI,
            'H?? Giang' => self::HAGIANG,
            'H?? Nam' => self::HANAM,
            'H?? N???i' => self::HANOI,
            'H?? T??nh' => self::HATINH,
            'H???i D????ng' => self::HAIDUONG,
            'H???i Ph??ng' => self::HAIPHONG,
            'H???u Giang' => self::HAUGIANG,
            'H??a B??nh' => self::HOABINH,
            'H??? Ch?? Minh' => self::HOCHIMINH,
            'H??ng Y??n' => self::HUNGYEN,
            'Kh??nh H??a' => self::KHANHHOA,
            'Ki??n Giang' => self::KIENGIANG,
            'Kon Tum' => self::KONTUM,
            'Lai Ch??u' => self::LAICHAU,
            'L??m ?????ng' => self::LAMDONG,
            'L???ng S??n' => self::LANGSON,
            'L??o Cai' => self::LAOCAI,
            'Long An' => self::LONGAN,
            'Nam ?????nh' => self::NAMDINH,
            'Ngh??? An' => self::NGHEAN,
            'Ninh B??nh' => self::NINHBINH,
            'Ninh Thu???n' => self::NINHTHUAN,
            'Ph?? Th???' => self::PHUTHO,
            'Ph?? Y??n' => self::PHUYEN,
            'Qu???ng B??nh' => self::QUANGBINH,
            'Qu???ng Nam' => self::QUANGNAM,
            'Qu???ng Ng??i' => self::QUANGNGAI,
            'Qu???ng Ninh' => self::QUANGNINH,
            'Qu???ng Tr???' => self::QUANGTRI,
            'S??c Tr??ng' => self::SOC_TRANG,
            'S??n La' => self::SONLA,
            'T??y Ninh' => self::TAYNINH,
            'Th??i B??nh' => self::THAIBINH,
            'Th??i Nguy??n' => self::THAINGUYEN,
            'Thanh H??a' => self::THANHHOA,
            'Th???a Thi??n Hu???' => self::THUATHIENHUE,
            'Ti???n Giang' => self::TIENGIANG,
            'Tr?? Vinh' => self::TRAVINH,
            'Tuy??n Quang' => self::TUYENQUANG,
            'V??nh Long' => self::VINHLONG,
            'V??nh Ph??c' => self::VINHPHUC,
            'Y??n B??i' => self::YENBAI,
        ];
    }

    //tr??? v??? t??n t???nh khi truy???n v??o m?? t???nh
    public static function getProvinceNameById($provinceId): string
    {
        $provinces = self::getArrayView();
        return array_search($provinceId, $provinces,true);
    }

    //Tr??? v??? m?? t???nh khi truy???n v??o t??n t???nh
    public static function getProvinceIdByName($provinceName): int
    {
        $provinces = self::getArrayView();
        return $provinces[$provinceName];
    }

    public static function getProvincesArray(): array
    {
        return [
            "An Giang","B?? R???a ??? V??ng T??u","B???c Giang",
            "B???c K???n","B???c Li??u","B???c Ninh","B???n Tre","B??nh ?????nh","B??nh D????ng",
            "B??nh Ph?????c","B??nh Thu???n","C?? Mau","C???n Th??","Cao B???ng","???? N???ng",
            "?????k L???k","?????k N??ng","??i???n Bi??n","?????ng Nai","?????ng Th??p","Gia Lai",
            "H?? Giang","H?? Nam","H?? N???i","H?? T??nh","H???i D????ng","H???i Ph??ng","H???u Giang",
            "H??a B??nh","H??? Ch?? Minh","H??ng Y??n","Kh??nh H??a","Ki??n Giang","Kon Tum","Lai Ch??u",
            "L??m ?????ng","L???ng S??n","L??o Cai","Long An","Nam ?????nh","Ngh??? An",
            "Ninh B??nh","Ninh Thu???n","Ph?? Th???","Ph?? Y??n","Qu???ng B??nh","Qu???ng Nam",
            "Qu???ng Ng??i","Qu???ng Ninh","Qu???ng Tr???","S??c Tr??ng","S??n La","T??y Ninh",
            "Th??i B??nh","Th??i Nguy??n","Thanh H??a","Th???a Thi??n Hu???","Ti???n Giang",
            "Tr?? Vinh","Tuy??n Quang","V??nh Long","V??nh Ph??c","Y??n B??i"
        ];
    }
}
