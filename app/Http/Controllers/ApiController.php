<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{


    public function getInfo(){
        return response()->json(['data'=>'Hello world'],401);
    }


}
