<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'document';
    protected $primaryKey = 'document_id';

    protected $fillable = [
        'document_title',
        'document_file',
        'manager_approval_id',
        'manager_approval_datetime',
        'file_admin_approval_id',
        'file_admin_approval_datetime',
        'status',
        'document_folder',
        'dept_id',
        'created_by',
        'updated_by',
    ];

    public function folder()
    {
        return $this->belongsTo(DocumentFolder::class, 'document_folder', 'df_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }
}
