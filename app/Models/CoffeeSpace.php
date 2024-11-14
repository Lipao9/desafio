<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoffeeSpace extends Model
{
    use HasFactory;

    protected $table = 'coffee_spaces';

    protected $fillable = [
        'name',
        'capacity',
    ];

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
