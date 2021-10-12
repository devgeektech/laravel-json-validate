<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index(){
        $jsonFile = public_path('/storage/jsonfile/'.env('FILE_STORE_NAME',null).'.json');
        if($jsonFile){
            $jsonRead = file_get_contents($jsonFile);
        }
        return view('table',[
            'data' => json_decode($jsonRead)
        ]);
    }
}
