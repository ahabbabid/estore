<?php

namespace App\Http\Controllers;
use App\Image;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

use App\Http\Requests;

class ImagesController extends Controller
{
    public function get(Request $request){
    	return view('admin-dashboard.add-image', ['product_id'=>$request->get('product_id')]);

    }
    public function save(Request $request){
 
        $image=$request->file('file');
        $imageName=$image->getClientOriginalName();
        $location=public_path('/assets/uploads/');
        $image->move($location, $imageName);
        $newImage=new Image;
        $newImage->name=$imageName;
        $newImage->product_id=$request->get('product_id');
        $newImage->save();
        
        return back()->with('success', 'Image Upload Successful');
    

    }

    
}
