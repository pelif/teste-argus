<?php 

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users'; 
    protected $fillable = ['id','name','email','password','created_at']; 
    
}