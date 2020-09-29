<?php 

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model 
{
    protected $table = 'patients'; 
    protected $fillable = ['id','name','age','telephone','created_at','updated_at']; 
} 