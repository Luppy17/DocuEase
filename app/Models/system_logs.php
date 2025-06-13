<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class system_logs extends Model
{
    protected $table = 'system_logs';
    protected $primaryKey = 'logs_id';

    protected $fillable = ['logs_id', 'log', 'user_id', 'created_at', 'updated_at'];
}
