<?php


if (! function_exists('sitename')) {
    function sitename()
    {
        $sitename = cache()->remember('settings.sitename', 1440, function(){
            $q = DB::table('settings')->where('slug','sitename')->first();
            return $q->value;
        });

        return $sitename;
    }
}

if (! function_exists('company')) {
    function company()
    {
        $company = cache()->remember('settings.company', 1440, function(){
            $q = DB::table('settings')->where('slug','company')->first();
            return $q->value;
        });

        return $company;
    }
}

if (! function_exists('getMenu')) {
    function getMenu($menu)
    {
        $menus = cache()->remember('menus.'.$menu, 1440, function() use ($menu){
            return config('menus.'.$menu, []);
        });

        usort($menus, function($prev, $next){
            if($prev['order'] == $next['order']) return 0;

            return ($prev['order'] < $next['order']) ? -1 : 1;
        });

        return $menus;
    }
}