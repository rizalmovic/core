<?php


if (! function_exists('sitename')) {
    function sitename()
    {
        $sitename = cache()->remember('sitename', 1440, function(){
            $q = DB::table('settings')->where('slug','sitename')->first();
            return $q->value;
        });

        return $sitename;
    }
}

if (! function_exists('company')) {
    function company()
    {
        $company = cache()->remember('company', 1440, function(){
            $q = DB::table('settings')->where('slug','company')->first();
            return $q->value;
        });

        return $company;
    }
}