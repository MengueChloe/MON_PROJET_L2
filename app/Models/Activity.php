<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'mission_id',
        'benevole_id',
        'title',
        'description',
        'location',
        'start_time',
        'end_time',
        'objective',
        'responsable_id',
    ];

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    public function benevole()
    {
        return $this->belongsTo(Benevole::class);
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }
}
