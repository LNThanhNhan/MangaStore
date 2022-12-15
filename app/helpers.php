<?php
/**
 * Chuyển đổi chuỗi kí tự thành dạng slug dùng cho việc tạo friendly url.
 * @access    public
 * @param string
 * @return    string
 */

use App\Enums\ProductCategory;
use App\Enums\Province;

if (!function_exists('create_slug')) {
    function create_slug($string): string
    {
        $search = array(
            '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
            '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
            '#(ì|í|ị|ỉ|ĩ)#',
            '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
            '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
            '#(ỳ|ý|ỵ|ỷ|ỹ)#',
            '#(đ)#',
            '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
            '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
            '#(Ì|Í|Ị|Ỉ|Ĩ)#',
            '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
            '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
            '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
            '#(Đ)#',
            "/[^a-zA-Z0-9\-\_]/",
        );
        $replace = array(
            'a',
            'e',
            'i',
            'o',
            'u',
            'y',
            'd',
            'A',
            'E',
            'I',
            'O',
            'U',
            'Y',
            'D',
            '-',
        );
        $string = preg_replace($search, $replace, $string);
        $string = preg_replace('/(-)+/', '-', $string);
        $string = strtolower($string);
        return $string;
    }
}

/**
 * Chuyển đổi số tiền thành dạng tiền tệ Việt Nam.
 * @access    public
 * @param int
 * @return    string
 */
if (!function_exists('format_priceVND')) {

    function format_priceVND($price): string
    {
        return number_format($price) . ' đ';
    }
}

// Chuyển đổi mã tỉnh trong enum Tinh thành sang tên tỉnh
if (!function_exists('getProvinceName')) {
    function getProvinceName($provinceID): bool
    {
        return Province::getProvinceNameById($provinceID);
    }
}

//Trả về mã tỉnh khi truyền vào tên tỉnh
if (!function_exists('getProvinceID')) {
    function getProvinceID($provinceName): int
    {
        return Province::getProvinceIDByName($provinceName);
    }
}

//Lấy ra tên thể loại truyện từ giá trị của enum ProductCategory
if (!function_exists('getProductCategoryName')) {
    function getProductCategoryName($productCategoryID): string
    {
        return ProductCategory::getCategoryName($productCategoryID);
    }
}


