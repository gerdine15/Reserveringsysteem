<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clubs extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number',
        'logo',
    ];

    public function setting()
    {
        return $this->belongsTo(Setting::class);
    }

    public function courts()
    {
        return $this->hasMany(Court::class);
    }
}
