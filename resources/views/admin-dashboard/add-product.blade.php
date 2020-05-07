@extends('layouts.dashboard')
@section('content')

<div class="container-fluid" id="vue-container">
          <div class="container-fluid">
            <div v-show="errorsExist==true" class="alert alert-danger">
              <ul>
                <li v-for="error in errors">@{{error}}</li>
              </ul>
            </div>

            <div class="card card-plain">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Add a Product</h4>
                
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="card-body">
                      <div class="row">
                          <div class="col-md-12">
                    <form action="{{url('admin-dashboard/add-product')}}" method='post'>
                      {{csrf_field()}}
                      <div class="form-group">
                        <label for="name">Name:</label>
                        <input class="form-control" type="text" name="name" v-model="name">
                      </div>
                      <div class="form-group">
                        <label for="numberinstock">Number In Stock</label>
                        <input class= "form-control" type="text" name="numberinstock" v-model="numberinstock  ">
                      </div>
                      
                      
                      <template v-for="(tag,index) in tags">
                        <div class="form-group">
                          <label>Tags:</label>
                          <select  class="form-control" v-model="tags[index].id">
                          @foreach($tags as $tag)
                          <option value="{{$tag->id}}" >{{$tag->name}}</option>

                          @endforeach
                        </select>
                        <button class="btn" @click.prevent="removeTagClicked(index)">x</button>
                        </div>
                        
                        </template>
                        <button class="btn" @click.prevent="addTagClicked">Add Tag</button>
                        
                        <button class="btn" @click.prevent="addImageClicked" type="submit" name="Add Image">Add Image</button>

                        
                    </form>
                    </div>
                    </div>

                    


                 
                    
                  
                    <div v-show="requestSuccessful==true" class="row">
                      <div class="col-md-12">
                      <div class="card-body">
                      <form action="{{url('admin-dashboard/add-image')}}"
                          class="dropzone"
                          id="my-awesome-dropzone">
                          {{csrf_field()}}
                          <input type="hidden" name="product_id" v-model="response.id">
                      </form>
                    

                    </div>
                    </div>
                    <a href="{{url('/')}}">
                    <button class="btn btn-primary">Save and Exit</button>
                  </a>  
                  </div>
                                    
                  
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>




@endsection
@section('page-specific-scripts')
<script type="text/javascript">
  var vue = new Vue({
  el: '#vue-container',
  data: {
    name:"",
    numberinstock :"",
    tags: [
      { id: "" }

      
    ],
    response:{},
    requestSuccessful:false, 
    errors:[],
    errorsExist:false

  },
    methods:{
      addTagClicked:function(){
       
        this.tags.push({id: ""});

      },
      removeTagClicked:function(index){
        this.tags.splice(index,1);
      },

      
        addImageClicked:function(){

          var formData = new FormData();
          var token = "{{csrf_token()}}";
                    formData.append('name', this.name);
                    formData.append('numberinstock', this.numberinstock );
                    formData.append('tags', JSON.stringify(this.tags));
                    
                    formData.append('_token', token);


                    var request = $.ajax({
                        url: "{{url('admin-dashboard/add-product')}}",
                        type: "POST",
                        data: formData,
                        contentType: false,      
                        cache: false,             
                        processData: false,
                        headers: {'X-CSRF-TOKEN': token}

                        });
                    request.done(function (data){
                      console.log(data);
                      if(data.responseCode==200){

                        console.log(data);
                        this.requestSuccessful=true;
                        this.response=data.responseBody;
                        this.errorsExist=false;

                      }else if(data.responseCode==412 || data.responseCode==500){
                        this.errorsExist= true;
                        this.errors=data.responseBody;
                      }
                      
                      
                    }.bind(this));
                    request.fail(function (data){
                      console.log(data);
                    });
                      
                    
    }
    }
    


    
  
  })


</script>
@endsection