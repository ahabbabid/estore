<?php

namespace App\Http\Controllers;

use App\Product;
use App\Tag;
use  Illuminate\Support\Facades\Validator;
use App\Utilities\ResponseProvider;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProductsController extends Controller
{
    public function save(Request $request){

    	$validator = Validator::make($request->all(), [
            'name' =>'required',
            'numberinstock' => 'required'
        ]);
        if($validator->fails()){
        	$responseObject = ResponseProvider::buildResponseMessage(ResponseProvider::PRECONDITION_FAILED_CODE,$validator->errors()->all());

           	return $responseObject;

        }else{
        	try{
        		$product=Product::create(['name'=>$request->get('name'), 'number_in_stock'=>$request->get('numberinstock')]);
    			$tags=json_decode($request->get('tags'));
    	
    	
    	foreach($tags as $tag){
    		$singletag=Tag::find($tag->id);
    		$product->tags()->attach($singletag);

    	}
    	$product->save();
    	$responseObject = ResponseProvider::buildResponseMessage(ResponseProvider::OK_CODE,$product);
    	return $responseObject;
    	
    }catch(\Exception $e){
        dd("error");
    		$responseObject = ResponseProvider::buildResponseMessage(ResponseProvider::INTERNAL_SERVER_ERROR_CODE, $e);
            return $responseObject;

    }
        
        }

        
	
        
    }
    public function index(){

    	$products=Product::all();
    	return view('products.index', ['products'=>$products]);
    }
    public function getTags(){
    	$tags=Tag::all();
    	return view('admin-dashboard.add-product',['tags'=>$tags]);
    }
}
