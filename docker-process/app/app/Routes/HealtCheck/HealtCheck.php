<?php

namespace App\Routes\HealtCheck;

class HealtCheck
{
    public static function group(&$app, ?string $version = 'v1', ?string $prefix = null, ?array $middelwares = null)
    {
        $prefix ? $prefix = '/'. $version . '/' . $prefix : $prefix = '/'. $version;

        $setMiddelwares = array();
        $middelwares ? array_merge($setMiddelwares, $middelwares) : $middelwares = [];
        $controllerGet = '\App\Controllers\\' . $version .'\\\HealtCheckControllers\HealtCheckGetController'::class;
        $controllerPost = '\App\Controllers\\' . $version .'\\\HealtCheckControllers\HealtCheckPostController'::class;

        $app->get(
            $prefix . '/healt',
            $controllerGet,
            'check',
            $middelwares
        );
        
        $app->post(
            $prefix . '/healt',
            $controllerPost,
            'check',
            $middelwares
        );
    }
}