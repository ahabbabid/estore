<?php

namespace App\Http\Controllers;
use  Illuminate\Support\Facades\Validator;
use App\Tag;

use Illuminate\Http\Request;

use App\Http\Requests;

class TagsController extends Controller
{
    public function create(){
    	return view('admin-dashboard.add-tag');
    }
    public function save(Request $request){
    	$validator= Validator::make($request->all(), [
    		'name'=> 'required'

    	]);
    	if($validator->fails()){
    		return redirect()->back()->withErrors($validator);
    	}else{
    		$tag= Tag::create(['name'=>$request->get('name')]);
    		$tag->save();
    		return redirect()->back();
    	}

    }
}
