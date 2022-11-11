<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Web\Controller;
use App\Models\User;
use App\Models\WorkOrder;
use App\Models\WorkOrdersTechnician;
use App\Notifications\sendNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class WorkOrderTechnicianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'work_id' => ['required','integer'],
            'json.*.tech_id' => ['required','integer','distinct'],

        ]);


        $data = json_decode($request->json);


        $workOrderId = $request->work_id;

        $user = $request->user();

        if ($user->tokenCan('admin')) {

            foreach ($data as $dat) {

                WorkOrdersTechnician::create([
                    'work_order_id' => $workOrderId,
                    'user_id' => $dat->tech_id,

                ]);



                $user = User::find($dat->tech_id);



                Notification::send($user, new sendNotification("New Repair Work Order",$workOrderId));


            }


            WorkOrder::where('id', $workOrderId)
                ->update([

                    'status' => 'WIP'
                ]);





            return response(["message" => "success"]);

        } else {

            return response(["message" => "unauthorized"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkOrdersTechnician  $workOrderTechnician
     * @return \Illuminate\Http\Response
     */
    public function show(WorkOrdersTechnician $workOrderTechnician)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkOrdersTechnician  $workOrderTechnician
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkOrdersTechnician $workOrderTechnician)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkOrdersTechnician  $workOrderTechnician
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkOrdersTechnician $workOrderTechnician)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkOrdersTechnician  $workOrderTechnician
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkOrdersTechnician $workOrderTechnician)
    {
        //
    }


    //get All technician assigned to a work order

    public function getTechniciansAssigned(Request $request)
    {
        $workOrderId = $request->id;


            return WorkOrdersTechnician::join('users','work_orders_technicians.user_id','=','users.id')->selectRaw('users.name,users.id,work_orders_technicians.status,work_orders_technicians.reason,work_orders_technicians.updated_at')
                -> where([ ['work_order_id','=', $workOrderId] ]) ->orderBy('updated_at', 'asc')->get();


    }




    //function used by technician to mark their work as complete
    public function completeIntervention(Request $request, $id)
    {

        $user_id = auth()->user()->id;

        WorkOrdersTechnician::where('work_order_id', $id)
            ->where('user_id', $user_id)
            ->update([
                'status' => 'Done'
            ]);


       $status = WorkOrdersTechnician::where('work_order_id', $id)->where('status','In Progress')->get();


       if(count($status)==0)
       {
           WorkOrder::where('id', $id)
               ->update([
                   'status' => 'Complete'
               ]);


           $users = User::where('designation','admin')->orWhere('designation','helpdesk')->get();


           foreach ($users as $user)
           {
               Notification::send($user, new sendNotification("Repair Completed",$id));
           }

       }



        return response(["message" => "success"]);
    }



    public function getStatus($userId,$id)
    {


        if($userId==-1)
        {

            $userId = auth()->user()->id;
        }



       $status = WorkOrdersTechnician::where('work_order_id', $id)
            ->where('user_id', $userId)
            ->value('status');

       return response(["status" => $status]);
    }



    public function removeTechnician(Request $request)
    {

        WorkOrdersTechnician::where('work_order_id', $request->work_id)
            ->where('user_id',$request->tech_id)
            ->update([
                'status' => 'Removed',
                'reason' => $request->reason,

            ]);

        return response(['message'=>'success'],200);



    }



}
