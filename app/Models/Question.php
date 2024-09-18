<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'image',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
