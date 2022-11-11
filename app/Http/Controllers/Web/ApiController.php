<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

class ApiController extends Controller
{









    public function getRequest($url, $params=null)
    {
        $request= Request::create(route($url,$params),"GET");



        $request->headers->set('Accept', 'application/json') ;
        $request->headers->set('Authorization', 'Bearer '.session('token') );

        $response =  app()->handle($request);
        $response_json = json_decode($response->getContent(),true);

        return $response_json;
    }


    public function postRequest($url, $input, $params=null)
    {
        $request1= Request::create(route($url),"POST",$input);

        $request1->headers->set('Accept', 'application/json') ;
        $request1->headers->set('Authorization', 'Bearer '.session('token') );

        $response =  app()->handle($request1);
        $response_json = json_decode($response->getContent(),true);


        return $response_json;



    }

    public function patchRequest($url, $input=null,$params=null)

    {
        $request1 = Request::create(route($url,$params),"PATCH", $input);

        $request1->headers->set('Accept', 'application/json') ;
        $request1->headers->set('Authorization', 'Bearer '.session('token') );

        $response1 =  app()->handle($request1);
        $response_json = json_decode($response1->getContent(),true);

        return $response_json;
    }



}
