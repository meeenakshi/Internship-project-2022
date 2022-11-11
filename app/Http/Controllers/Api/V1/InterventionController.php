<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Web\Controller;
use App\Models\Intervention;
use App\Models\WorkOrdersTechnician;
use DateTime;
use Illuminate\Http\Request;

//use App\Http\Resources\Resources;

class InterventionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    //get all interventions
    public function index()
    {
        return Intervention::paginate(15);
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



    //get the interventions for a particular work order
    public function getInterventions(Request $request, $id){


        $work_order_technician_ids =   WorkOrdersTechnician::where('work_order_id', $id)
            ->pluck('id');




        $interventions = Intervention::join('work_orders_technicians', 'interventions.work_orders_technicians_id', '=', 'work_orders_technicians.id')
            ->join('users','users.id','=','work_orders_technicians.user_id')
            ->select('interventions.*','users.name','work_orders_technicians.user_id')->whereIn('interventions.work_orders_technicians_id',$work_order_technician_ids)->get();


        return $interventions;


    }




    public function findByWorkTechId(Request $request, $id){
        $user_id = auth()->user()->id;

        $work_order_technician_id =   WorkOrdersTechnician::where('work_order_id', $id)
            ->where('user_id', $user_id)
            ->value('id');

        $interventions = Intervention::where('work_orders_technicians_id',$work_order_technician_id)->paginate(15);

        return $interventions;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user_id = auth()->user()->id;

        $work_order_technician_id =   WorkOrdersTechnician::where('work_order_id', $request->work_id)
            ->where('user_id', $user_id)
            ->value('id');


        $old_from = DateTime::createFromFormat('H:i - d F Y', $request->time_from);        // returns Saturday, January 30 10 02:06:34
        $old_to = DateTime::createFromFormat('H:i - d F Y', $request->time_to);



        $timeFrom = $old_from->format('Y-m-d H:i:s');
        $timeTo = $old_to->format('Y-m-d H:i:s');


        $hourdiff = round((strtotime($timeTo) - strtotime($timeFrom))/3600, 1);

        Intervention::create([
            'work_orders_technicians_id' => $work_order_technician_id,
            'date' => date('Y-m-d H:i:s'),
            'time_from' => $timeFrom,
            'time_to' => $timeTo,
            'remarks' => $request->remarks,
            'hours'=>$hourdiff
        ]);


        return response(["message" => "success"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }




}
