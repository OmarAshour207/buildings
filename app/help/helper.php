<?php

if(!function_exists('setting')) {
    function setting()
    {
        return \App\Setting::first();
    }
}

if(!function_exists('building_type')) {
    function building_type()
    {
        $array = [
            'شقه',
            'فيلا',
            'شاليه',
        ];
        return $array;
    }
}

if(!function_exists('building_rent')) {
    function building_rent()
    {
        $array = [
            'ايجار',
            'تمليك'
        ];
        return $array;
    }
}

if(!function_exists('contact_type')) {
    function contact_type()
    {
        $array = [
            ' خدمه عملاء',
            ' أقتراحات ',
            ' دعم تطبيق ',
        ];
        return $array;
    }
}

if (!function_exists('places')){
    function places()
    {
        return [
            '1'  => 'القاهره',
            '2'  => 'الاسكندريه',
            '3'  => 'اسيوط',
            '4'  => 'المنيا',
            '5'  => 'الجيزه',
        ];
    }
}

if (!function_exists('searchNameField')) {
    function searchNameField()
    {
        return [
            'price_from' => 'السعر من',
            'price_to'   => 'السعر الي',
            'place'      => 'المنطقه',
            'rooms'      => 'عدد الغرف',
            'type'       => 'نوع العقار',
            'rent'       => 'نوع العمليه',
            'square'     => 'المساحه',
            'name'       => 'الاسم'
        ];
    }
}

if (!function_exists('unReadMessages')) {
    function unReadMessages()
    {
        return \App\Contact::where('view', 0)->get();
    }
}

if (!function_exists('unReadMessagesCount')) {
    function unReadMessagesCount()
    {
        return \App\Contact::where('view', 0)->count();
    }
}


if (!function_exists('setActive')) {
    function setActive($array, $class = 'active')
    {
        if(!empty($array)) {
            $seg_array = [];
            foreach ($array as $key => $url) {
                if(Request::segment($key+1) == $url) {
                    $seg_array[] = $key;
                }
            }
            if(count($seg_array) == count($array)) {
                return $class;
            }
        }
    }
}

if (!function_exists('provedBuildings')) {
    function provedBuildings()
    {
        return \App\Building::where('status', '1')->count();
    }
}

if (!function_exists('unProvedBuildings')) {
    function unProvedBuildings()
    {
        $user_id = \Illuminate\Support\Facades\Auth::user()->id ?? '0' ;
        return \App\Building::where('user_id', $user_id)->where('status', '0')->count();
    }
}

if (!function_exists('waitingBuildings')) {
    function waitingBuildings()
    {
        return \App\Building::where('status', '0')->count();
    }
}
