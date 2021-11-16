<?php

use Illuminate\Support\Facades\Session;

if (!function_exists('getLang')) {
    function getLang($key)
    {
        $lang = __($key);

        if ($lang == $key)
            $lang = str_replace('_', ' ', $lang);
        return $lang;
    }
}

if (!function_exists('universalDateFormatter')) {
    function universalDateFormatter($date)
    {
        return $date ? $date->format('Y/m/d h:i:s') : '';
    }
}

if (!function_exists('calenderDateFormatter')) {
    function calenderDateFormatter($date)
    {
        $date = explode(' ', $date);
        return $date[0] . ' ' . $date[2] . ' ' . $date[1] . ' ' . $date[3] . ' ';
    }
}

if (!function_exists('calenderDateDbFormatter')) {
    function calenderDateDbFormatter($date)
    {
        $date = explode(' ', $date);
        return date('Y-m-d', strtotime($date[2] . ' ' . $date[1] . ' ' . $date[3]));
    }
}

if (!function_exists('calenderTimeFormatter')) {
    function calenderTimeFormatter($date)
    {
        $date = explode(' ', $date);
        return $date[4];
    }
}

if (!function_exists('flashSession')) {
    function flashSession($message, $type = 'success')
    {
        Session::flash('message', $message);
        Session::flash('alert-class', 'alert-' . $type);
    }
}

if (!function_exists('flashSuccess')) {
    function flashSuccess($message)
    {
        flashSession($message);
    }
}
if (!function_exists('flashError')) {
    function flashError($message)
    {
        flashSession($message, 'error');
    }
}
if (!function_exists('flashInfo')) {
    function flashInfo($message)
    {
        flashSession($message, 'info');
    }
}
if (!function_exists('flashWarning')) {
    function flashWarning($message)
    {
        flashSession($message, 'warning');
    }
}
if (!function_exists('getClientCategories')) {
    function getClientCategories()
    {
        return \App\Models\Category::all();
    }
}
if (!function_exists('getAppointementImages')) {
    function getAppointementImages($id)
    {
        return \App\Models\AppointmentBook::where('id',$id)->first();
    }
}
if (!function_exists('getProductCategories')) {
    function getProductCategories()
    {
        return \App\Models\ProductCategory::all();
    }
}
if (!function_exists('getProducts')) {
    function getProducts()
    {
        return \App\Models\Product::all();
    }
}
if (!function_exists('getServices')) {
    function getServices()
    {
        return \App\Models\Service::all();
    }
}
if (!function_exists('getPackages')) {
    function getPackages()
    {
        return \App\Models\Package::all();
    }
}

if (!function_exists('getReferrals')) {
    function getReferrals()
    {
        return \App\Models\Client::all();
    }
}
if (!function_exists('getBranches')) {
    function getBranches()
    {
        return \App\Models\Branch::all();
    }
}
if (!function_exists('getReferrals')) {
    function getReferrals()
    {
        return \App\Models\Client::all();
    }
}
if (!function_exists('lgUId')) {
    function lgUId(): int
    {
        return \Illuminate\Support\Facades\Auth::user()->id ?? 0;
    }
}

if (!function_exists('getMinutesDifference')) {
    function getMinutesDifference($start, $end)
    {
        $to_time = strtotime($start);
        $from_time = strtotime($end);
        return (int)round(abs($to_time - $from_time) / 60, 2);
    }
}
if (!function_exists('getAppointmentType')) {
    function getAppointmentType()
    {
       $appointment = \App\Models\AppointmentType::get();
       return $appointment;
    }
}
