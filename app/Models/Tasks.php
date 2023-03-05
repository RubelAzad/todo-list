<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;

class Tasks extends Model
{
    protected $fillable=['title','task_category_id','description','status'];

    public function category(){
        return $this->belongsTo(Categories::class,'task_category_id','id');
    }
}
