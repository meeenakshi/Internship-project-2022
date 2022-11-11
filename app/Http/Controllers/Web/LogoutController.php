<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LogoutController extends ApiController
{
    public function index(Request $request)
    {


        $response = $this->getRequest("api_logout");


        if($response["message"]=="success")
        {
            Session::flush();

            return  redirect()->route('login');
        } else {
            redirect()->back();
        }

    }
}
