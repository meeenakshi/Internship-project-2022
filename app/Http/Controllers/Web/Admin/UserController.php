<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Web\ApiController;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    public function index()
    {

        $usersResponse= $this->getRequest("api_get_users");


        $technicianResponse = $this->getRequest('api_get_users',['designation[eq]'=>'technician']);

        $data[0]=$usersResponse;
        $data[1]=count($technicianResponse);


            return view('admin.users')->with('data', $data);


    }


    public function createUser(Request $request)
    {
        $response= $this->postRequest("api_register",$request->input());

        if($response['message']=="success")
        {
            return redirect()->back()->withSuccess('User Created');
        } else {

            return redirect()->back()->withErrors($response['errors'])->withInput();
        }
    }


    public function showForm()
    {

        return view('admin.create-user');
    }

    public function find($id)
    {
        return "hello";
    }
}
