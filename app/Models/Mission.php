<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mission extends Model {
    use HasFactory;

    protected $fillable = [
        'organisation_id', 
        'title', 
        'description', 
        'start_date', 
        'end_date', 
        'location', 
        'skills_required', 
        'is_published'
    ];

    public function organisation() {
        return $this->belongsTo(Organisation::class);
    }

    public function candidatures() {
        return $this->hasMany(Candidature::class);
    }
}