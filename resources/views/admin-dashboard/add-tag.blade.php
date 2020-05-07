@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      @if(count($errors)>0)
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
        </ul>
      </div>
      @endif
      <form action="{{url('admin-dashboard/add-tag')}}" method="POST">
        {{csrf_field()}}
        <div class="form-group">
          <label>Name:</label>
          <input type="text" class="form-control" name="name">
            
          </input>
        </div>
        <button class="btn btn-primary" type="submit">Add Tag</button>
      </form>
    </div>  
  </div>
</div>

@endsection