@extends('master.app')
@section('title','Add New Tasks category')
@section('content')          
        <div class="my-3 my-md-5">
            <div class="container">
              <div class="page-header d-flex justify-content-center">
                <h1 class="page-title">Add New Tasks task_category</h1> 
              </div>
              <div class="row row-cards row-deck d-flex justify-content-center">
                <div class="col-6">
                  <div class="card">
                    <div class="card-status bg-green"></div>
                    <div class="card-header">Add Tasks Category</div>
                    <div class="card-body">
                        <form action="{{route('task_category.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="task_category_title" class="form-control {{($errors->has('task_category_title'))?'is-invalid':''}}" value="{{old('task_category_title')}}" placeholder="Enter task_category title..."> 
                                @if($errors->has('task_category_title'))
                                   <p class="text-danger">{{$errors->first('task_category_title')}}</p>
                                @endif
                            </div>             
                            <div class="card-footer float-right">
                                <a href="{{route('task_category.index')}}" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>              
            </div>            
          </div>
      </div>
    @endsection