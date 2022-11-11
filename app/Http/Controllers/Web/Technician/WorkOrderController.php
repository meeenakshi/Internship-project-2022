<?php

namespace App\Http\Controllers\Web\Technician;

use App\Http\Controllers\Web\ApiController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class   WorkOrderController extends ApiController
{
    public function index()
    {


    }



    public function find($id)
    {

        $interventionStatusResponse = $this->getRequest("api_get_intervention_status", ["id" => $id, 'userId' => -1]);

        $workOrderResponse = $this->getRequest("api_find_work_order", ["id" => $id]);

        $assignedTechnicians = $this->getRequest("api_work_order_technicians", ["id" => $id]);

        $interventions = $this->getRequest("api_get_interventions", ["id" => $id]);


        $data['details'] = $workOrderResponse;
        $data['assigned'] = $assignedTechnicians;
        $data['interventions'] = $interventions;
        $data['status'] = $interventionStatusResponse['status'];



        if($interventionStatusResponse['status']=="Removed")
        {
            redirect()->back();
        }


        return view('technician.details')->with('data', $data);


    }



    public function performDiagnostic(Request $request)
    {
        $input = $request->input();


        $response = $this->patchRequest("api_add_diagnostic", $input, ['id' => $input['id']]);

        if ($response['message'] == "success") {
            return redirect()->back()->withSuccess('Diagnostic Added');
        } else {
            return redirect()->back()->withErrors($response['errors']);
        }
    }






    public function getAssignedDiagnostics()
    {
        $diagnostic = $this->getRequest("api_filter_status", ['status' => 'Assigned']);


            return view("technician.diagnostic-workorders")->with('data', $diagnostic);

    }

    public function getInterventionWorkOrders()
    {
        $workorders = $this->getRequest("api_workorders_intervention");

            return view("technician.intervention-workorders")->with('data', $workorders);

    }





}
