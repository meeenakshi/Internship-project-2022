<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Web\ApiController;
use Illuminate\Http\Request;

class WorkOrderTechnicianController extends ApiController
{
    public function store(Request $request)
    {


        $response= $this->postRequest("api_assign_technician_work_order",$request->input());



        if($response['message']=="success")
        {
            return redirect()->back()->withSuccess('Technician(s) Assigned');
        } else {

            return redirect()->back()->withErrors($response['errors'])->withInput();
        }
    }

    public function removeTechnician(Request $request)
    {




        $response= $this->postRequest("api_remove_assigned_technician",$request->dat);


        if($response['message']=="success")
        {
            return response('success');
        } else {

            return $response;
        }


    }



}
