<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $fillable = ['name', 'city', 'holes'];

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}