<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Web\ApiController;

class DashboardController extends ApiController
{
    public function index()

    {

            $data = $this->getRequest("api_status_count");


            return view('admin.dashboard')->with('data', $data);


    }
}
