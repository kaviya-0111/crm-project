<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Document; // ← Assuming this exists

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Mass assignable fields
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Relationship: One user has one document
    public function document()
    {
        return $this->hasOne(Document::class);
    }
}
