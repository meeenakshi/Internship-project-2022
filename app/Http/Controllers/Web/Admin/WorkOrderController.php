<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Web\ApiController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class WorkOrderController extends ApiController
{
    public function index()
    {


            $response = $this->getRequest("api_get_work_orders", ['approved[ne]' => 0, 'status[ne]' => 'Warranty']);


            $count = $this->getRequest("api_status_count");

            $data[0] = $response;
            $data[1] = $count;



            return view('admin.workorders')->with('data', $data);




    }

    public function store(Request $request)
    {

        $response = $this->postRequest("api_create_work_order", $request->input());


        if ($response['message'] == "success") {
            return redirect()->back()->withSuccess('Work Order Created');
        } else {

            return redirect()->back()->withErrors($response['errors'])->withInput();
        }
    }


    public function find($id = null)
    {


        $workOrderResponse = $this->getRequest("api_find_work_order", ["id" => $id]);

        $assignedTechnicians = $this->getRequest("api_work_order_technicians", ["id" => $id]);

        $interventions = $this->getRequest("api_get_interventions", ["id" => $id]);

        $technicians = $this->getRequest('api_get_users', ['designation[eq]' => 'technician']);


        $data['details'] = $workOrderResponse;
        $data['assigned'] = $assignedTechnicians;
        $data['interventions'] = $interventions;
        $data['technicians'] = $technicians;




        return view('admin.details')->with('data', $data);





    }

    public function assignDiagnosticTechnician(Request $request)
    {

        $input = $request->input();

        $response = $this->patchRequest("api_assign_diagnostic_technician", $input, ['id' => $input['id']]);
        if ($response['message'] == "success") {

            $user = $this->getRequest("api_find_user", ["id" => $input['technician']]);


            return redirect()->back()->withSuccess('Technician Assigned');


        } else {
            return redirect()->back()->withErrors($response['errors']);
        }
    }




    public function addApproval(Request $request)
    {

        $input = $request->input();

        $response = $this->patchRequest("api_add_approval", $input, ['id' => $input['id']]);

        if ($response['message'] == "success") {
            return redirect()->back()->withSuccess('Approval status saved');
        } else {
            return redirect()->back()->withErrors($response['errors']);
        }
    }







    public function close(Request $request)
    {

        $input = $request->input();

        $response = $this->patchRequest("api_close_work_order", $input, ['id' => $input['work_id']]);

        if ($response['message'] == "success") {
            return redirect()->back()->withSuccess('Work Order Closed');
        } else {
            return redirect()->back()->withErrors($response['errors']);
        }
    }

    public function reAssign(Request $request)
    {

        $input = $request->input();

        $response = $this->patchRequest("api_reassign_work_order", $input, ['id' => $input['work_id']]);



        if ($response['message'] == "success") {
            return redirect()->back()->withSuccess('Work Order Updated');
        } else {
            return redirect()->back()->withErrors($response['errors']);
        }
    }



    public function testNotify()
    {




    }


    public function setChargeable(Request $request)
    {

        $input = $request->input();

        $response = $this->patchRequest("api_set_chargeable", $input, ['id' => $input['id']]);

        if ($response['message'] == "success") {
            return redirect()->back()->withSuccess('Update Success');
        } else {
            return redirect()->back()->withErrors($response['errors']);
        }
    }




    public function exportPdf($id)
    {

        $designation = strtolower(session()->get('designation'));

        $workOrderResponse = $this->getRequest("api_find_work_order", ["id" => $id]);


        $interventions = $this->getRequest("api_get_interventions", ["id" => $id]);



        $data[0] = $workOrderResponse;

        $data[1] = $interventions;


        $pdf = Pdf::loadView('pdf.detail',['data'=>$data]);
        return $pdf->download('workorder.pdf');


    }







                    // NAVIGATION


    public function showForm()
    {
        $data = $this->getRequest('api_get_users');



        return view('admin.create')->with('data',$data);
    }




}
