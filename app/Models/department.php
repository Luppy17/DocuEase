<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    protected $table = 'department';
    protected $primaryKey = 'dept_id';

    protected $fillable = ['dept_id', 'dept_name', 'created_at', 'updated_at'];


    public function users(){
        return $this->hasMany(User::class, 'dept_id');
    }
    
    public function documents(){
        return $this->hasMany(Document::class, 'dept_id');
    }
    
}
