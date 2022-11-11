<?php

namespace App\Http\Controllers\Web\Technician;

use App\Http\Controllers\Web\ApiController;

class DashboardController extends ApiController
{
    public function index()

    {


                $count = $this->getRequest("api_technician_count");


            return view('technician.dashboard')->with('data', $count);


    }
}
