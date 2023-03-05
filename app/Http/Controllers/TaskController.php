<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Models\Categories;
use Response;
use Validator;
use Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_tasks=Tasks::where('user_id','=',Auth::user()->id)->get();        
        return view('tasks',['tasks'=>$all_tasks]);
    }

    // show all pending tasks
    public function pending(){
        $pending_task=Tasks::where('status','pending')->where('user_id','=',Auth::user()->id)->get();
        return view('pending_tasks',['pendings'=>$pending_task]);
    }

    // show all completed tasks
    public function completed(){
        $completed_task=Tasks::where('status','completed')->where('user_id','=',Auth::user()->id)->get();
        return view('completed_tasks',['completed'=>$completed_task]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_categories=Categories::where('user_id','=',Auth::user()->id)->get();
        $count_categories=Categories::count();
        return view('add_task',['categories'=>$all_categories,'count'=>$count_categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validators=Validator::make($request->all(),[
            'task_title'=>'required',
            'task_category_id'=>'required'           
        ]);
        if($validators->fails()){
            return redirect()->route('task.create')->withErrors($validators)->withInput();
        }else{
            $task=new Tasks();
            $task->title=$request->task_title;
            $task->task_category_id=$request->task_category_id;
            $task->user_id=Auth::user()->id;
            $task->description=$request->description;
            $task->save();
            return redirect()->route('task.ongoing')->with('message','Task created successfully !');
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
        $find_task=Tasks::where('id',$id)->get();
        $all_categories=Categories::where('user_id','=',Auth::user()->id)->get();
        return view('edit_task',['task'=>$find_task,'categories'=>$all_categories]);
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
            'task_title'=>'required',
            'task_category_id'=>'required'            
        ]);
        if($validators->fails()){
            return redirect()->route('task.edit',$id)->withErrors($validators)->withInput();
        }else{
            $task=Tasks::find($id);
            $task->title=$request->task_title;
            $task->task_category_id=$request->task_category_id;
            $task->user_id=Auth::user()->id;
            $task->description=$request->description;
            $task->save();
            return redirect()->route('task.ongoing')->with('message','Task updated successfully !');
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
        $find_task=Tasks::find($id);
        $find_task->delete();
        return redirect()->route('task.ongoing')->with('message','Task removed successfully !');
    }

    // mark a specific task as completed 
    public function makeCompleted($id){
        $find_task=Tasks::find($id);
        $find_task->status='completed';
        $find_task->save();
        return redirect()->route('task.ongoing')->with('message','Task marked as completed successfully !');
    }

    // mark a specific task as pending 
    public function makePending($id){
        $find_task=Tasks::find($id);
        $find_task->status='pending';
        $find_task->save();
        return redirect()->route('task.ongoing')->with('message','Task marked as pending successfully !');
    }
}
