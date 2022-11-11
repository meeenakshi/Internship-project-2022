<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

class NotificationController extends ApiController
{

    public function readNotification(Request $request)
    {
        $response = $this->getRequest("api_read_notifications");


       return $response;
    }



}
