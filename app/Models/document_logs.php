<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class document_logs extends Model
{
    use HasFactory;

    protected $table = 'document_logs';
    protected $primaryKey = 'logs_id';

    protected $fillable = [
 'logs_id', 'document_id', 'action', 'filepath', 'owner_id', 'created_by', 'created_at','reference'
    ];

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
