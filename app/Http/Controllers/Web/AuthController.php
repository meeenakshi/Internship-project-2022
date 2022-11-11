<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AuthController extends ApiController
{

    public function login(Request $request)
    {

        if (Auth::check()) {

            $role = session()->get('designation');

            $route = $role.'.dashboard';
            return redirect()->route($route);
        }



      if($request->isMethod("post"))
      {

            $response = $this->postRequest('api_login',$request->input());



          if($response["message"]=="success")
          {
              $token = ($response["token"]);

              $user =  Auth::user();



             session()->put('designation',$response['designation']);
             session()->put('name',$response['name']);
             session()->put('id',$response['id']);

             session()->put('token',$token);

              $role = session()->get('designation');

              $route = $role.'.dashboard';

              return redirect()->route($route);

          } else if ($response['message']=="failed") {
              return  redirect()->back()->withErrors("Credentials dont match");
          } else {

              return  redirect()->back()->withErrors($response["errors"]);
          }


      } else {
          return view('auth.login');

      }

    }


    public function logout(Request $request)
    {


        $response = $this->getRequest("api_logout");


        if($response["message"]=="success")
        {
            Session::flush();

            return  redirect()->route('login');
        } else {
            redirect()->back();
        }

    }



}
