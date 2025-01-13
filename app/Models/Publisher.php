<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $table = 'publishers';

    protected $fillable = [
        'name',
        'address',
        'phone',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
