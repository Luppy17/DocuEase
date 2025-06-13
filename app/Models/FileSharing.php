<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileSharing extends Model
{
    use HasFactory;

    protected $table = 'filesharing';
    protected $primaryKey = 'filesharing_id';

    protected $fillable = [
        'document_id',
        'requested_by',
        'manager_approval_id',
        'manager_approval_datetime',
        'file_admin_approval_id',
        'file_admin_approval_datetime',
        'status',
        'filesharing_expiry_date',
        'created_by',
        'updated_by',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }

    public function folder()
    {
        return $this->belongsTo(DocumentFolder::class, 'document_id');
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }
}
