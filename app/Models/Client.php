<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'surname', 'email', 'phone', 'income'];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
