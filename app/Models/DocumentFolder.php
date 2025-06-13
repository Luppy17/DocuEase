<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentFolder extends Model
{
    use HasFactory;

    protected $table = 'document_folder';
    protected $primaryKey = 'df_id';

    protected $fillable = [
        'folder_name',
        'created_by',
        'updated_by',
    ];

    public function documents()
    {
        return $this->hasMany(Document::class, 'document_folder');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
