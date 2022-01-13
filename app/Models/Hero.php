<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function clan()
    {
        return $this->belongsTo(Clan::class);
    }

    public function getFullnameAttribute()
    {
        return $this->name . ($this->clan ? ' (' . $this->clan->name . ')' : null);
    }
}
