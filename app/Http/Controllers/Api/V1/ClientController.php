<?php

namespace App\Http\Controllers\Api\V1;


use App\Filters\V1\ClientFilter;
use App\Filters\V1\WorkOrderFilter;
use App\Http\Controllers\Web\Controller;
use App\Models\Client;
use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{


    public function index()
    {

        return Client::paginate(15);
    }
    public function searchClient(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Client::where('name', 'LIKE', '%'. $query. '%')->get();
        return response()->json($filterResult);
    }






    public function getDatatable(Request $request)
    {




            \DB::statement("SET SQL_MODE=''");


            $data=Client::leftJoin('slas','clients.id','=','slas.client_id')->selectRaw('clients.*, SUM(slas.hours) AS total')->groupBy('clients.id')->get();





        return Datatables::of($data)

            ->addIndexColumn()

            ->addColumn('link',function($row){

                $route= route("admin.clients.details",['id'=>$row["id"]]);
                $action = '<a class="fw-semibold" href="'.$route.'">'.$row["id"].'</a>';

                return $action;
            })



            ->rawColumns(['link'])

            ->make(true);

    }


    public function store(Request $request){

        $request->validate(['name'=> ['required','unique:clients'],
            'email'=> ['required','email'],
            'phone' =>['nullable'],
            'quota'=> ['required','integer'],]);

        $client = Client::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'quota'=>$request->quota,
        ]);


        if($client)
        {
            return response()->json(['message'=>'success'],200);
        } else {
            return response()->json(['message'=>'failed'],200);
        }




    }

    public function find($id)
    {
      return Client::find($id);
    }

}
