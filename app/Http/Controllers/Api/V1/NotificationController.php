<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Web\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function readNotifications(Request $request)
    {

        $user = auth()->user();

        $user->unreadNotifications->markAsRead();

        return response(['message'=>'success']);
    }

    public function getUnreadNotifications(Request $request)
    {

        return auth()->user()->unreadNotifications;
    }

    public function getNotifications(Request $request)
    {

        return auth()->user()->notifications->slice(0, 10);
    }


}
