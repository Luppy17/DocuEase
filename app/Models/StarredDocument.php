<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StarredDocument extends Model
{
    use HasFactory;

    protected $table = 'starred_documents'; // Specify the table name
    protected $primaryKey = 'starred_id'; // Specify the primary key

    protected $fillable = [
        'user_id',
        'document_id',
    ];

    // Optional: Define relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }
}