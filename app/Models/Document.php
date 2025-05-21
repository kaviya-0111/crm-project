<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Document;
class Document extends Model
{
    use HasFactory;

    // OPTIONAL: if your table name is not 'documents'
    // protected $table = 'your_table_name';

    protected $fillable = [
        'user_id',
        'document_type',
        'document_path',
        'status',
    ];

    // OPTIONAL: Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
