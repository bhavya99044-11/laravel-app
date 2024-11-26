<?php

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductReview;
use App\Models\ProductCart;
use App\Models\ColorSize;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use App\Models\CoupanDiscount;
use Carbon\Carbon;

$gstPercent = 18;
function cartCount()
{
    $count = Session::get('cart_count');
    if ($count == null) {
        $cartCount = ProductCart::whereUniqueToken(Cookie::get('cart_token'))->count();
        Session::put('cart_count', $cartCount);
        $count = $cartCount;
    }
    return $count;
}

function gstCalculator($amount)
{
    $gstPercent = 18;
    $tax = $amount * $gstPercent / 100;
    return $tax;
}

function discountCalculator($amount)
{
    $discount = [];
    $discount['integer'] = (int) $amount;
    $discount['discount'] = -round($amount - $discount['integer'], 4);

    return $discount;
}



function couponPercentCalculator($amount, $discount, $couponPercent)
{
    $data = [];
    $data['discount'] = round($amount * $couponPercent / 100, 2);
    $data['total'] = round($amount - $data['discount'], 2);
    return $data;
}

function couponPriceCalculator($amount, $discount, $couponPrice)
{
    $data = [];
    $data['discount'] = $couponPrice;
    $data['total'] = round($amount - $couponPrice, 2);
    return $data;

}

//Last seen functionality usenf user last_seen column date
function lastSeen($time)
{
    $currentdate = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());
    $time = Carbon::createFromFormat('Y-m-d H:i:s', $time);
    $timeDiff=$time->diff(date: $currentdate)->format('%H:%i');
    if ($time < $currentdate) {
        $string = '';

        //For show diff in years
        if($time->diffInYears($currentdate)>1){
            $years = $time->diff($currentdate)->format('%y');
            $string .= $years .' year';
            $string .= ' ago at '.$timeDiff;
            return $string;
        }
        //For Show diff in months and week name
        if($time->diffInMonths($currentdate)>1){
            $months = $time->diff($currentdate)->format('%M');
            $day=$time->format('l');
            $monthAgo = str_split($months, 1);
            if ($monthAgo[0] != 0) {
                $string .= $monthAgo[0][0];
            }
            $string .= $monthAgo[1] .' month';
            $string .= ' ago';
            if($day){
                $string.=' on ';
                $string.=$day;
            }
            $string.= ' at'. $timeDiff;
            return $string;
        }
        //For show difference in days
        if ($time->diffInDays($currentdate) > 1) {
            $days = $time->diff($currentdate)->format('%D%H');
            $dayAgo = str_split($days, 2);
            if ($dayAgo[0][0] != 0) {
                $string .= $dayAgo[0][0];
            }
            $string .= $dayAgo[0][1] . ' day ';
            if ($dayAgo[1] > 1) {
                if ($dayAgo[1][0] > 0) {
                    $string .= $dayAgo[1][0];
                }
                $string .= $dayAgo[1][1] . ' ' . 'hour';
            }
            $string .= ' ago ';
            $string .= ' at ' .$timeDiff;
            return $string;
        }
        else if ($time->diffInHours($currentdate) > 1) {
            $hours = explode(':', $time->diff($currentdate)->format('%H:%I:%S'));
            $string = '';
            $hourAgo = str_split($hours[0], 1);
            if ($hourAgo[0] != 0) {
                $string .= $hourAgo[0];
            }
            $string .= $hourAgo[1] . ' hour';
            if ($hours[1] != '00') {
                $string .= ' ' . $hours[1] . ' ' . 'minutes';
            }
            $string .= ' ago';
            return $string;
        } else if ($time->diffInMinutes($currentdate) > 1) {
                $minutes=str_split($time->diff($currentdate)->format('%I'),1);
                $string = '';
                if ($minutes[0]!= 0) {
                    $string .= $minutes[0];
                }
                $string .= $minutes[1] . ' minute';
                $string .= ' ago';
                return $string;
        } else {
            return 'last seen recently';
        }
    } else {
        return 'last seen recently';
    }
}
