<?php

namespace App\Http\Controllers\Web\Technician;

use App\Http\Controllers\Web\ApiController;
use Illuminate\Http\Request;

class InterventionController extends ApiController
{
    public function store(Request $request){

        $response= $this->postRequest("api_add_intervention",$request->input());

        if($response['message']=="success")
        {
            return redirect()->back()->withSuccess('Intervention Added');
        } else {

            dd($response);
        }

    }





}
