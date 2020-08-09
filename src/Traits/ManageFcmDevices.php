<?php

namespace williamcruzme\FCM\Traits;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait ManageFcmDevices
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate($this->createRules(), $this->validationErrorMessages());

        $device = $this->guard()->user()->devices()->whereToken($request->token)->first();

        if ($device) {
            $device->touch();
        } else {
            $device = $this->guard()->user()->devices()->create($request->all());
        }

        return $this->sendResponse($device);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request)
    {
        $request->validate($this->deleteRules(), $this->validationErrorMessages());

        $this->guard()->user()->devices()->whereToken($request->token)->delete();

        return response()->json('', 204);
    }

    /**
     * Get the validation rules that apply to the create a device.
     *
     * @return array
     */
    protected function createRules()
    {
        return [
            'token' => ['required', 'string'],
        ];
    }

    /**
     * Get the validation rules that apply to the delete a device.
     *
     * @return array
     */
    protected function deleteRules()
    {
        return [
            'token' => ['required', 'string', 'exists:fcm_devices,token'],
        ];
    }

    /**
     * Get the device management validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [];
    }

    /**
     * Get the response for a successful storing devices.
     *
     * @param  array  $response
     * @return JsonResponse
     */
    protected function sendResponse($response)
    {
        return response()->json($response);
    }

    /**
     * Get the guard to be used during device management.
     *
     * @return StatefulGuard
     */
    protected function guard()
    {
        return auth()->guard();
    }
}
