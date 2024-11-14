<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'people';

    protected $fillable = [
        'name',
        'surname',
    ];

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function getRoomIdInStep($step)
    {
        $assignment = $this->assignments()
            ->where('step', $step)
            ->first();

        if ($assignment->room) {
            return $assignment->room->id;
        }

        return null;
    }

    public function getCoffeeIdInStep($step)
    {
        $assignment = $this->assignments()
            ->where('step', $step)
            ->first();

        if ($assignment->coffeeSpace) {
            return $assignment->coffeeSpace->id;
        }

        return null;
    }
}
