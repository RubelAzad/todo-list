<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use Validator;
use Illuminate\Validation\Rule;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_task_categories=Categories::where('user_id','=',Auth::user()->id)->get();
        return view('task_categories',['task_categories'=> $all_task_categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add_task_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //dd(Auth::user()->id);
        $validators=Validator::make($request->all(),[
            'task_category_title'=>'required|unique:task_categories',
        ]);
        if($validators->fails()){
            return redirect()->route('task_category.create')->withErrors($validators)->withInput();
        }else{
            $task_category=new Categories();
            $task_category->task_category_title=$request->task_category_title;
            $task_category->user_id=Auth::user()->id;
            $task_category->save();
            return redirect()->route('task_category.index')->with('message','Task Category created successfully !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task_category=Categories::where('id',$id)->get();
        return view('edit_task_category',['task_category'=>$task_category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validators=Validator::make($request->all(),[
            'task_category_title'=>['required',Rule::unique('task_categories')->ignore($id)]
        ]);
        if($validators->fails()){
            return redirect()->route('task_category.edit',$id)->withErrors($validators)->withInput();
        }else{
            $task_category=Categories::find($id);
            $task_category->task_category_title=$request->task_category_title;
            $task_category->user_id=$request->user_id;
            $task_category->save();
            return redirect()->route('task_category.index')->with('message','Category updated successfully !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find_category=Categories::find($id);
        $find_category->delete();
        return redirect()->route('task_category.index')->with('message','Task Category removed successfully !');
    }
}
