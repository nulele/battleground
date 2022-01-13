<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function heroes()
    {
        return $this->hasMany(Hero::class);
    }
}
