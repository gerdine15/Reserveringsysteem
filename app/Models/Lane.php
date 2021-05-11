<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lane extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'type',
    ];

    public function clubnumber()
    {
        return $this->belongsTo(Clubnumber::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
