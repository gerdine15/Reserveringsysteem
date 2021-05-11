<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'starttime',
        'endtime',
        'nameEvent',
    ];

    public function clubnummer()
    {
        return $this->belongsTo(Clubnumber::class);
    }

    public function lane()
    {
        return $this->belongsTo(Lane::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'reservations_users');
    }
}
