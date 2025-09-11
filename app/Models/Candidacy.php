<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candidacy extends Model
{
    use HasFactory;

    protected $fillable = [
        'benevole_id', 
        'mission_id', 
        'status'
    ];

    public function benevole() {
        return $this->belongsTo(Benevole::class);
    }

    public function mission() {
        return $this->belongsTo(Mission::class);
    }
}
