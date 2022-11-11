<?php

namespace App\Http\Controllers\Web\Technician;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\ApiController;
use Illuminate\Http\Request;

class SlaController extends ApiController
{
    public function store(Request $request)
    {

        $response = $this->postRequest("api_create_sla", $request->input());


        if ($response['message'] == "success") {
            return redirect()->back()->withSuccess('SLA Created');
        } else {


            return redirect()->back()->withErrors($response['errors'])->withInput();
        }
    }

    public function showForm()
    {
        return view('technician.sla');
    }

    public function slas()
    {
        return view('technician.slas');
    }


    public function find($id = null)
    {
        $slaResponse = $this->getRequest("api_find_sla", ["id" => $id]);

        $data['details'] = $slaResponse;


        return view('technician.sla-details')->with('data', $data);


    }
}

