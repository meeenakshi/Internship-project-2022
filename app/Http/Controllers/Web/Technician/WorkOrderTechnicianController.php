<?php

namespace App\Http\Controllers\Web\Technician;

use App\Http\Controllers\Web\ApiController;
use Illuminate\Http\Request;

class WorkOrderTechnicianController extends ApiController
{


    public function update(Request $request){

        $input=$request->input();

        $response = $this->patchRequest("api_complete_intervention",$input,['id'=>$input['work_id']]);

        if($response['message']=="success")
        {
            return redirect()->back()->withSuccess('You have completed your Intervention');
        } else {
            return redirect()->back()->withErrors($response['errors']);
        }

    }

}
