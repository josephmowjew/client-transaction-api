<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['client_id', 'amount', 'type', 'description'];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}