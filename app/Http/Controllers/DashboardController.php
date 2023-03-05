<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use Auth;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(){ 
        // show all tasks count
        $total_tasks=Tasks::where('user_id','=',Auth::user()->id)->count();
        // show all pending tasks count
        $pending_tasks=Tasks::where('status','pending')->where('user_id','=',Auth::user()->id)->count();
        // show all tasks completed count
        $completed_tasks=Tasks::where('status','completed')->where('user_id','=',Auth::user()->id)->count();
        // show all tasks
        $all_tasks=Tasks::where('user_id','=',Auth::user()->id)->get();      
        return view('dashboard',['tasks'=>$all_tasks,'total_tasks'=>$total_tasks,'pending_tasks'=>$pending_tasks,'completed_tasks'=>$completed_tasks]);
    }
}
