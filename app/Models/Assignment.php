<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $table = 'assignments';

    protected array $enum = [
        'step' => ['Etapa 1', 'Etapa 2'],
    ];
    protected $fillable = [
        'person_id',
        'room_id',
        'coffee_space_id',
        'step'
    ];

    // Relacionamento com Pessoa
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    // Relacionamento com Sala
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // Relacionamento com EspacoCafe
    public function coffeeSpace()
    {
        return $this->belongsTo(CoffeeSpace::class);
    }

}
