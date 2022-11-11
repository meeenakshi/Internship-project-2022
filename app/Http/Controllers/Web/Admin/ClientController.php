<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\ApiController;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends ApiController
{

    public function index()
    {

        $clientsResponse= $this->getRequest("api_get_clients");


        $data['clients']=$clientsResponse;


        return view('admin.clients')->with('data', $data);


    }

    public function createClient(Request $request)
    {
        $response= $this->postRequest("api_create_client",$request->input());

        if($response['message']=="success")
        {
            return redirect()->back()->withSuccess('Client Created');
        } else {

            return redirect()->back()->withErrors($response['errors'])->withInput();
        }
    }


    public function showForm()
    {

        return view('admin.create-client');
    }


    public function find($id)
    {



      $hoursResponse = $this->getRequest("api_get_client_hours_spent", ["id" => $id]);

        $data['details'] = $this->getRequest("api_find_client", ["id" => $id]);



        if($hoursResponse==null)
        {
            $data['hours']=0;
        } else {
            $data['hours']=$hoursResponse['total'];
        }



        return view('admin.client-details')->with('data', $data);



    }






}
