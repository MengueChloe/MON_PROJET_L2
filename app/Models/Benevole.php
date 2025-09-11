<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Benevole extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'phone', 
        'skills', 
        'name',
        'date_birth',
        'availability',
        'why_to_volonteer',
        'location',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function candidatures() {
        return $this->hasMany(Candidature::class);
    }
}
