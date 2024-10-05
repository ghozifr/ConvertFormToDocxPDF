<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConvertedForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_mitra',
        'file_path'
    ];

    // Define the relationship to the User model (a form belongs to a user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

