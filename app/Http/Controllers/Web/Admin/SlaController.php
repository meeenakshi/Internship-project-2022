<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\ApiController;
use Illuminate\Http\Request;

class SlaController extends ApiController
{
    public function find($id = null)
    {
        $slaResponse = $this->getRequest("api_find_sla", ["id" => $id]);

        $data['details'] = $slaResponse;


        return view('admin.sla-details')->with('data', $data);


    }

    public function slas()
    {
        return view('admin.slas');
    }


}
