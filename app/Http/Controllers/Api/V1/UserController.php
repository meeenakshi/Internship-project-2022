<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\SlaFilter;
use App\Filters\V1\UserFilter;
use App\Http\Controllers\Web\Controller;
use App\Models\Client;
use App\Models\Sla;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{


    //Used to get all user info from the database
    public function index(Request $request, ){


        $user = $request->user();

        if($user->tokenCan('admin') || $user->tokenCan('technician') || $user->tokenCan('sales'))
        {


            $filter = new UserFilter();
            $queryItems = $filter->transform($request);

            //check If request url contains query items
            if (count($queryItems) == 0) {


                return User::all();
            } else{

                return User::where($queryItems)->get();
            }

        } else {
            return response(["message"=>"unauthorized"]);
        }
    }

    /*public function technicians(){

        $technicians = User::where('designation', 'technician')->get();

        return response($technicians);
    }*/


    //find specific user
    public function find($id)
    {
        return User::find($id);
    }

    public function getUsersDatatable(Request $request)
    {

        $filter = new UserFilter();
        $queryItems = $filter->transform($request);

        //check if request url contains query items
        if (count($queryItems) == 0) {

            //return all users
            $data=User::all();

        } else{

            //return users based on query
            $data= User::where($queryItems);
        }





        return Datatables::of($data)

            ->addIndexColumn()

            ->addColumn('display',function($row){


                return with(new Carbon($row->updated_at))->format('j F Y');
            })

            ->rawColumns(['display'])

            ->make(true);

    }


}
