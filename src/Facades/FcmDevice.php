<?php

namespace williamcruzme\FCM\Facades;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Facade;
use williamcruzme\FCM\Http\Controllers\FcmDeviceController;

class FcmDevice extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'fcm_device';
    }

    /**
     * Register the typical notifications routes for an application.
     *
     * @param string $namespace
     * @return void
     */
    public static function routes($namespace = '\\williamcruzme\\FCM\\Http\\Controllers')
    {
        Route::prefix('fcm-devices')->namespace($namespace)->group(function () {
            Route::post('/', [FcmDeviceController::class, 'store']);
            Route::delete('/', [FcmDeviceController::class, 'destroy']);
        });
    }
}
