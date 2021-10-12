<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class FileUploadController extends Controller
{
    public function UploadJsonFile(Request $request){
        
        $request->validate([
            'jsonfile' => 'required|file|mimetypes:application/json,text/plain'
        ]);
    
        if ($request->hasFile('jsonfile')) {
            $fileJson = file_get_contents($request->file('jsonfile'));
            $validateJson = json_decode($fileJson);
            if($validateJson){
                $jsonfile = $request->file('jsonfile');
                $name = env('FILE_STORE_NAME',null).'.'.$jsonfile->getClientOriginalExtension();
                $destinationPath = public_path('/storage/jsonfile/');
                $jsonfile->move($destinationPath, $name);
                return back()->with('success','File has been uploaded.');
            }
            else{
                return back()->with('error','Not a valid JSON file');
            }
        }
        else{
            return back()->with('error','File Not uploaded');
        }        
    }
}

