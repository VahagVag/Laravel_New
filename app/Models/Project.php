<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable =[
        'title','thumbnail','description','skills','category_id','user_id'
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }

}
