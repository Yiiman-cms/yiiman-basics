<?php
/**
 * Created by PhpStorm.
 * User: hamed
 * Date: 3/1/17
 * Time: 8:21 PM
 */

namespace YiiMan\YiiBasics\lib;


class Helper
{
    public static function getFriendlyCurrency($price)
    {
        return self::getFriendlyNumber($price) . ' تومان';
    }

    public static function getFriendlyNumber($number)
    {
        return number_format($number);
    }

    public static function isValidMobileNumber($mobile)
    {
        return preg_match('/^989[0-9]{9}$/', $mobile);
    }

    public static function checkJalaliDate($date)
    {
        if (preg_match("/^[1-9][0-9]{3}\/(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
            return true;
        } else {
            return false;
        }
    }

    public static function isValidEmail($string)
    {
        $emailValidator = new EmailValidator();
        return $emailValidator->validate($string);
    }

    public static function unifyMobileNumber($mobile)
    {
        if (preg_match("/^(9)\d{9}$/", $mobile)) {
            $mobile = "98" . $mobile;
        } else if (preg_match("/^(09)\d{9}$/", $mobile)) {
            $mobile = "98" . substr($mobile, 1, strlen($mobile));
        }
        return $mobile;
    }

    public static function isNumeric($username)
    {
        return is_numeric($username);
    }


}