@extends('layouts.master')
@section('content')
<div class="container">
	<div class="card-columns">
	@foreach($products as $product)
		
			<div class="card">
				@foreach($product->images as $image)
				  <img class="card-img-top" src="{{asset('assets/uploads/'.$image->name)}}" alt="Card image cap">
				 @endforeach
				  <div class="card-body">
				    <h5 class="card-title">{{$product->name}}</h5>
				    <p class="card-text">Tags: @foreach($product->tags as $tag)
				    	<span class="badge badge-secondary">{{$tag->name}} </span>
				    @endforeach</p>
				    <p class="card-text"><small class="text-muted">Last Updated: {{$product->updated_at}}</small></p>
				  </div>
			</div>
		
	@endforeach
	</div>
	</div>
@endsection
