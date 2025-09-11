<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'name', 
        'activiy_domain', 
        'description', 
        'location', 
        'website', 
        'representative', 
        'postal_code', 
        'location', 
        'creation_date', 
        ];

    

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function missions() {
        return $this->hasMany(Mission::class);
    }
}
