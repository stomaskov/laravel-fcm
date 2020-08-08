<?php

namespace williamcruzme\FCM\Http\Controllers;

use App\Http\Controllers\Controller;
use williamcruzme\FCM\Traits\ManageFcmDevices;

class FcmDeviceController extends Controller
{
    use ManageFcmDevices;
}
