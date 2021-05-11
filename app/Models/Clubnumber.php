<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clubnumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'number',
    ];

    public function lane()
    {
        return $this->belongsTo(Lane::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
