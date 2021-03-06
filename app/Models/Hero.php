<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clan()
    {
        return $this->belongsTo(Clan::class);
    }

    public function getFullnameAttribute()
    {
        return $this->name . ($this->clan ? ' (' . $this->clan->name . ')' : null);
    }

    public function scopeOfUser($query, $user)
    {
        return $query->where('user_id', $user->id);
    }

    public function scopeSearch($query, $search = null)
    {
        return $query->when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                return $query->orWhere('heroes.name', 'like', "%$search%")
                    ->orWhere('clans.name', 'like', "%$search%");
            });
        });
    }
}
