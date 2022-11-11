<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\SlaFilter;
use App\Filters\V1\TechnicianWorkOrderFilter;
use App\Filters\V1\WorkOrderFilter;
use App\Http\Controllers\Web\Controller;
use App\Models\User;
use App\Models\WorkOrder;
use App\Models\WorkOrdersTechnician;
use App\Notifications\sendNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Yajra\DataTables\DataTables;

class WorkOrderController extends Controller
{

    //return all work orders or filtered work orders
    public function index(Request $request)
    {

        $user = $request->user();

        //check rights

        if ($user->tokenCan('admin') || $user->tokenCan('technician') || $user->tokenCan('helpdesk')) {

            $filter = new WorkOrderFilter();
            $queryItems = $filter->transform($request);

            //check if request url contains query items
            if (count($queryItems) == 0) {

                //return all work orders sorted by date created
                return WorkOrder::orderBy('created_at', 'desc')->paginate(15);

            } else{

                //return work orders based on query
                return WorkOrder::where($queryItems)->orderBy('created_at', 'desc')->paginate(15);
          }
        }

    }



    //Create new Work Order
    public function store(Request $request)
    {

        $user = $request->user();

        //Check rights
        if (($user->tokenCan('helpdesk')) || ($user->tokenCan('admin'))) {


            $request->validate([
                'name' => ['required'],
                'phone' => ['nullable'],
                'email' => ['nullable', 'email'],
                'product' => ['required'],
                'model' => ['required'],
                'serial_no' => ['required'],
                'cyber_serial_no_1' => ['nullable'],
                'cyber_serial_no_2' => ['nullable'],
                'warranty' => ['nullable'],
                'ticket_no' => ['nullable'],
                'invoice_no' => ['required_if:warranty,==,1'],
                'accessories' => ['nullable'],
                'problem' => ['required'],
                'taken_by' => ['required'],
                'client_sig_req' => ['required'],

            ],
                ['email.required' => 'email is required',
                    'email.email' => 'entered email is not valid', 'email.exists' => 'Email does not exist']);

            WorkOrder::create([
                'date' => date('Y-m-d H:i:s'),
                'client' => $request->name,
                'client_contact_no' => $request->phone,
                'client_email' => $request->email,
                'product' => $request->product,
                'model' => $request->model,
                'serial_no' => $request->serial_no,
                'cyber_serial_no1' => $request->cyber_serial_no_1,
                'cyber_serial_no2' => $request->cyber_serial_no_2,
                'warranty' => ($request->warranty == null) ? 0 : 1,
                'invoice_no' => $request->invoice_no,
                'accessories' => $request->accessories,
                'problem_desc' => $request->problem,
                'taken_by' => $request->taken_by,
                'ticket_no' => $request->ticket_no,
                'status' => ($request->warranty == null) ? 'Pending' : 'Warranty',
                'client_signature_request' => $request->client_sig_req,
                'picture'=>$request->picUrl

            ]);


            return response(["message" => "success"]);
        } else {
            return response(["message" => "unauthorized"], 403);
        }

    }



    //Get the details of a particular work order by ID
    public function find($id = null)
    {

       try{
           $assigned = WorkOrder::find($id)->assigned_to;
       }
       catch (\Exception $e)
       {

           $assigned = null;

       }

        // if it is assigned
        // get assigned technician name as well as the name of taken by else
        //get only the name of taken by

        if ($assigned!=null) {

            $workOrder = WorkOrder::join('users as u1', 'work_orders.taken_by', '=', 'u1.id')
                ->join('users as u2', 'work_orders.assigned_to', '=', 'u2.id')
                ->selectRaw('work_orders.*, u1.name as taken_by_name, u2.name as assigned_to_name')->where([
                    ['work_orders.id','=',$id]
                ])->first();
        } else {

            $workOrder = WorkOrder::join('users as u', 'work_orders.taken_by', '=', 'u.id')
                ->selectRaw('work_orders.*, u.name as taken_by_name')->where([
                    ['work_orders.id','=',$id]
                ])->first();

        }




        return $workOrder;


    }


//Used by the admin to assign a technician to perform diagnostic

    public function assignDiagnosticTechnician(Request $request, $id)
    {


        WorkOrder::where('id', $id)
            ->update([
                'assigned_to' => $request->technician,
                'status' => 'Assigned',
                'ticket_no' => $request->actualTicketNo
            ]);

    //Send a notification to the technician
        $user = User::find($request->technician);

        Notification::send($user, new sendNotification("New Diagnostic to Perform",$id));
        return response(["message" => "success"]);

    }


    /*public function filterStatus(Request $request, string $status)
    {

        $user = $request->user();

        if ($user->tokenCan('technician')) {
            return WorkOrder::where([['assigned_to', '=', $user->id], ['status', '=', $status]])->orderBy('updated_at','desc')->paginate(15);

        }
    }*/



    //Used by the technician to update the work order with his diagnostic
    public function addDiagnostic(Request $request, $id)
    {


        WorkOrder::where('id', $id)
            ->update([
                'diagnostic_date' => $request->diagnostic_date,
                'diagnostic' => $request->diagnostic,
                'status' => 'Diagnosed'
            ]);



        //send to all concerned users a notification

        $users = User::where('designation','admin')->orWhere('designation','helpdesk')->get();


        foreach ($users as $user)
        {
            Notification::send($user, new sendNotification("Diagnostic Added",$id));
        }




        return response(["message" => "success"]);
    }






 /*   public function getChargeable()
    {
        return WorkOrder::where([ ['chargeable','=', 1],['status','=','Diagnosed'],['quotation_approved','=',-1] ])->get();
    }*/



    //Used by helpdesk/admin to update the work order with approval received from sales
    public function addApproval(Request $request, $id)
    {


        $approved =$request->approved;

        WorkOrder::where('id', $id)
            ->update([
                'quotation_no' => $request->quotation_no,
                'quotation_approved' => $approved,

            ]);



        //if work order approved
        // status is set to Ready
        // else set to Cancelled

        $status="Cancelled";

        if($approved==1)
        {
                $status="Ready";
        }


        WorkOrder::where('id', $id)
            ->update([

                'status' => $status
            ]);



        return response(["message" => "success"]);
    }




/*    //Used by the technician to get All work orders assigned to him to perform intervention
    public function getInterventionWorkOrders(Request $request)
    {


        //get user id of technician
        $userId = auth()->user()->id;

        //Look for the work order ids linked with the user's id in the work_order_technicians table and then return the work orders having those ids
        //Check if work order not completed (WIP)
        $workOrders = WorkOrder::join('work_orders_technicians', 'work_orders.id', '=', 'work_orders_technicians.work_order_id')
                          ->select('work_orders.*')->where([
                              ['work_orders_technicians.user_id','=',$userId],
                ['work_orders.status','=','WIP'],
                ['work_orders_technicians.status','=','In Progress']])->paginate(15);


        return $workOrders;
    }*/


    //Used by the admin to finalize the work order

    public function closeWorkOrder(Request $request, $id)
    {

            WorkOrder::where('id', $id)
                ->update([
                    'status' => 'Closed'
                ]);


        return response(["message" => "success"]);
    }


    public function reAssign(Request $request,$id)
    {


        WorkOrder::where('id', $id)
            ->update([
                'status' => 'WIP'
            ]);


        $users = User::join('work_orders_technicians','users.id','=','work_orders_technicians.user_id')->where('work_orders_technicians.work_order_id',$id)->where('work_orders_technicians.status','<>','Removed')->selectRaw('users.*')->get();


        WorkOrdersTechnician::where('work_order_id',$id)->where('status','<>','Removed')->update([
            'status' => 'In Progress'
        ]);


        foreach ($users as $user)
        {
            Notification::send($user, new sendNotification("Reassigned Work Order",$id));
        }


        return response(["message" => 'success']);



    }



//Used by the admin/helpdesk to update the work order with chargeable information
    public function setChargeable(Request $request, $id)
    {


        $chargeable =$request->chargeable;

        WorkOrder::where('id', $id)
            ->update([
                'chargeable' => $chargeable,

            ]);


        //if not chargeable set status to READY

        $status="Ready";

        //if chargeable set status to WITH SALES

        if($chargeable==1)
        {
            $status="With Sales";
        }


        WorkOrder::where('id', $id)
            ->update([

                'status' => $status
            ]);



        return response(["message" => "success"]);
    }


    //Get the counts for each work order status
    public function getCount (){


        $result = WorkOrder::groupBy('status')
            ->selectRaw('count(id) as total, status')
            ->get();


        $returnArray['pending'] = 0;
        $returnArray['assigned'] = 0;
        $returnArray['ready'] = 0;
        $returnArray['completed'] = 0;
        $returnArray['warranty'] = 0;

        $returnArray['wip'] = 0;
        $returnArray['closed'] = 0;

        $sum=0;


        //calculate total
        foreach ($result as $row)
        {
            $returnArray[strtolower($row['status'])]=$row['total'];
            $sum = $sum + $row['total'];
        }

        $returnArray['total']= $sum;

        return $returnArray;


    }


    public function getTechnicianCount (Request $request){


        $userId= $request->user()->id;

        $data1 = WorkOrder::where('status', 'Assigned')
            ->where('assigned_to', $userId)

            ->get();


        $data2 = WorkOrder::join('work_orders_technicians', 'work_orders.id', '=', 'work_orders_technicians.work_order_id')
            ->select('work_orders.*')
            ->where([
                ['work_orders_technicians.user_id', '=', $userId],
                ['work_orders.status', '=', 'WIP'],
                ['work_orders_technicians.status', '=', 'In Progress']
            ])
            ->get();


        $returnArray['diagnostic']=count($data1);
        $returnArray['interventions']=count($data2);


        return $returnArray;


    }










//Get datatable for the admin
    public function getDatatable(Request $request)
    {



        $filter = new WorkOrderFilter();
        $queryItems = $filter->transform($request);

        //check if request url contains query items
        if (count($queryItems) == 0) {

            //return all work orders sorted by date created
            $data=WorkOrder::all();

        } else{

            //return work orders based on query
            $data= WorkOrder::where($queryItems);
        }








        return Datatables::of($data)
            ->addIndexColumn()



            ->addColumn('display',function($row){


                return with(new Carbon($row->updated_at))->diffForHumans();
            })



            ->addColumn('bell',function($row){

                if($row['notifiable']==1)
                {
                    $icon="fa-solid fa-bell";
                } else {
                    $icon="fa-regular fa-bell";
                }


                return '<a bi="'.$row['id'].'" onclick="toggleNotify(this)" notifiable="'.$row['notifiable'].'" class="'.$icon.'"></a>';
            })



            ->rawColumns(['display','bell'])


            ->make(true);

    }






//Get datatable for the technician

    public function getTechnicianDataTable(Request $request)
    {

        //get user id of technician
        $userId = $request->user()->id;


        $filter=$request->query('filter',null);



        if($filter==null) {

            $first = WorkOrder::join('work_orders_technicians', 'work_orders.id', '=', 'work_orders_technicians.work_order_id')
                ->select('work_orders.*')
                ->where([
                    ['work_orders_technicians.user_id', '=', $userId],
                    ['work_orders.status', '=', 'WIP'],
                    ['work_orders_technicians.status', '=', 'In Progress']
                ]);


            $data = WorkOrder::where('status', 'Assigned')
                ->where('assigned_to', $userId)
                ->union($first)
                ->get();
        }

        if($filter=='Interventions')
        {
            $data = WorkOrder::join('work_orders_technicians', 'work_orders.id', '=', 'work_orders_technicians.work_order_id')
                ->select('work_orders.*')
                ->where([
                    ['work_orders_technicians.user_id', '=', $userId],
                    ['work_orders.status', '=', 'WIP'],
                    ['work_orders_technicians.status', '=', 'In Progress']
                ])
                ->get();
        }

        if($filter=="Diagnostic") {

            $data = WorkOrder::where('status', 'Assigned')
                ->where('assigned_to', $userId)

                ->get();

        }






        return Datatables::of($data)
            ->addIndexColumn()


            ->addColumn('display',function($row){


                return with(new Carbon($row->updated_at))->diffForHumans();
            })

            ->addColumn('link',function($row){

                $route= route("technician.workorders.details",['id'=>$row["id"]]);
                $action = '<a class="fw-semibold" href="'.$route.'">BI '.$row["id"].'</a>';

                return $action;
            })



            ->rawColumns(['link','display'])


            ->make(true);




    }


    public function toggleNotify(Request $request)
    {

        $notifiable=$request->notifiable==1?0:1;

        WorkOrder::where('id', $request->id)
            ->update([
                'notifiable' => $notifiable ,
            ]);


        return response(["state" => $notifiable],200);
    }












}
