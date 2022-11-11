<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Web\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    // Used by the Admin to create new user
    public function register(Request $request){

        $request->validate(['email'=> ['required','email','unique:users'],
            'password'=> ['required','min:6','confirmed'],
            'uname' =>['unique:users'] ]);

        $user = User::create([
            'name'=>$request->name,
            'uname'=>$request->uname,
            'email'=>$request->email,
            'designation'=>$request->designation,
            'password'=> Hash::make($request->password)
        ]);

        $token= $user->createToken('Token')->accessToken;
        /*return response()->json(['token'=>$token, 'user'=>$user]);*/

        return response()->json(['message'=>'success'],200);
    }



    //Login function
    public function login(Request $request)
    {


       $request->validate(['email'=> ['required','email','exists:users'], 'password'=> ['required']],


            ['email.required' =>'The email field is required',
                'email.email'=>'The entered email is not valid','email.exists'=>'Email does not exist']);

        $data =[
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        //if login successful
        if(Auth::attempt($data)){


            $user = Auth::user();

            //get logged in user designation
           $designation= Auth::user()->designation;


           //Assign rights based on permissions
           if($designation=="admin")
           {
               $permission= ['admin'];
           } else if ($designation=="helpdesk")
           {
               $permission= ['helpdesk'];
           } else if ($designation=="technician"){

               $permission= ['technician'];
           } else {

               $permission= ['sales'];
           }


           //create token based on permission
            $token = $user->createToken("MyToken",$permission)->accessToken;
            $id = Auth::user()->id;
            $name = Auth::user()->name;

           //return token and designation
            return response()->json(['token'=>$token,'message'=>'success','designation'=>$designation,'id'=>$id,'name'=>$name],200);


        } else {


            return response()->json(['message'=>'failed'],401);
        }
    }




    //Logout

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();


        return response(["message"=>"success"]);



    }
}
