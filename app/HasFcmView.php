<?php

namespace App;

use NotificationChannels\Fcm\FcmMessage;

interface HasFcmView
{
    public function toFcmMessage(): FcmMessage;
}
