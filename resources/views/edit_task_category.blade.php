@extends('master.app')
@section('title','Edit Task Category')
@section('content')          
        <div class="my-3 my-md-5">
            <div class="container">
              <div class="page-header d-flex justify-content-center">
                <h1 class="page-title">Edit Tasks Category</h1> 
              </div>
              <div class="row row-cards row-deck d-flex justify-content-center">
                <div class="col-6">
                  <div class="card">
                    <div class="card-status bg-green"></div>
                    <div class="card-header">Edit Tasks Category</div>
                    <div class="card-body">
                        @foreach($task_category as $each)
                        <form action="{{route('task_category.update',$each->id)}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="user_id" value="{{$each->user_id}}"/>
                                <input type="text" name="task_category_title" class="form-control {{($errors->has('task_category_title'))?'is-invalid':''}}" value="{{$each->task_category_title}}" placeholder="Enter Task Category title..."> 
                                @if($errors->has('task_category_title'))
                                   <p class="text-danger">{{$errors->first('task_category_title')}}</p>
                                @endif
                            </div>             
                            <div class="card-footer float-right">
                                <a href="{{route('task_category.index')}}" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                        @endforeach
                    </div>
                  </div>
                </div>
              </div>              
            </div>            
          </div>
      </div>
    @endsection