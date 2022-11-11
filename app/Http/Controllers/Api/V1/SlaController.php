<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\SlaFilter;
use App\Filters\V1\WorkOrderFilter;
use App\Http\Controllers\Web\Controller;
use App\Models\Sla;
use App\Models\WorkOrder;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Passport\Passport;
use Yajra\DataTables\DataTables;

class SlaController extends Controller
{
    public function store(Request $request)
    {


        $request->validate([
            'client_id' => 'bail|required|exists:clients,id',
            'type' => 'required',
            'time_from' => 'required|date_format:H:i - d F Y',
            'time_to' => 'required|date_format:H:i - d F Y|after:time_from',
            'location' => 'required',
            'tasks' => 'required',
            'client_sig' => 'required'
        ]);





        $user = $request->user();

            $old_from = DateTime::createFromFormat('H:i - d F Y', $request->time_from);        // returns Saturday, January 30 10 02:06:34
            $old_to = DateTime::createFromFormat('H:i - d F Y', $request->time_to);



        $timeFrom = $old_from->format('Y-m-d H:i:s');
        $timeTo = $old_to->format('Y-m-d H:i:s');



        $hourdiff = round((strtotime($timeTo) - strtotime($timeFrom))/3600, 1);




        if ($user->tokenCan('technician')) {


            $query = Sla::create([
                'type' => $request->type,
                'client_id' => $request->client_id,
                'location' => $request->location,
                'time_from' => $timeFrom,
                'time_to' => $timeTo,
                'tasks' => $request->tasks,
                'hours' => $hourdiff,
                'user_id' => $user->id,
                'client_signature' => $request->client_sig,
            ]);

            if($query)
            {
                return response(["message" => "success"]);
            } else
            {
                return response(["message" => "failed"]);
            }


        } else {
            return response(["message" => "unauthorized"], 403);
        }

    }

    public function find($id){


        return Sla::join('users','slas.user_id','=','users.id')->join('clients','slas.client_id','=','clients.id')->selectRaw('slas.*,users.name as tech_name,clients.name as client_name')->where('slas.id',$id)->first();
    }





    public function getHours($id)
    {

       $hours = Sla::groupBy('client_id')->selectRaw('sum(hours) as total')->where('client_id',$id)->first();

       if($hours)
       {
           return $hours;
       } else {
           return null;
       }
    }






    public function getSlaDatatable(Request $request,$id=null)
    {

        $filter = new SlaFilter();
        $queryItems = $filter->transform($request);

        $query=Sla::join('users', 'slas.user_id', '=', 'users.id');

        if($id!=null) {
            //check if request url contains query items

            $query=$query->selectRaw('slas.*,users.name as techName');
            if (count($queryItems) == 0) {

                //return all work orders sorted by date created
                $data = $query->where('client_id', $id);

            } else {

                //return work orders based on query
                $data = $query>where($queryItems)->where('client_id', $id);
            }


        } else {


            $query=$query->join('clients', 'slas.client_id', '=', 'clients.id')->selectRaw('slas.*,users.name as techName,clients.name as clientName');;
            $designation = $request->user()->designation;

            if($designation=="technician")
            {
                $userId =  $request->user()->id;


                //check if request url contains query items
                if (count($queryItems) == 0) {

                    //return all work orders sorted by date created
                    $data=$query->where('slas.user_id',$userId);

                } else{

                    //return work orders based on query
                    $data= $query->where($queryItems)->where('slas.user_id',$userId);
                }

            } else {


                //check if request url contains query items
                if (count($queryItems) == 0) {

                    //return all work orders sorted by date created
                    $data=$query;

                } else{

                    //return work orders based on query
                    $data= $query->where($queryItems);
                }


            }


        }




        return Datatables::of($data)
            ->addIndexColumn()


            ->addColumn('display',function($row){


                return with(new Carbon($row->updated_at))->format('j F Y');
            })



            ->editColumn('user_id', function ($row) {
                return [
                    'display' => $row->techName,
                    'id' => $row->user_id
                ];
            })



            ->rawColumns(['display'])


            ->make(true);
    }



}
