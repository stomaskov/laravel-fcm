<?php

namespace williamcruzme\FCM\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use williamcruzme\FCM\FcmDevice;

trait HasFcmDevices
{
    /**
     * Get the devices of the model.
     *
     * @return MorphMany
     */
    public function devices()
    {
        return $this->morphMany(FcmDevice::class, 'user');
    }
}
