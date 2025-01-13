<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'title',
        'price',
        'stock',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
