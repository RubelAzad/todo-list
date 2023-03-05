<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tasks;

class Categories extends Model{

    protected $table = "task_categories";
    protected $fillable=['task_category_title'];

    public function tasks(){
        return $this->hasMany(Tasks::class,'task_category_id','id');
    }

}
