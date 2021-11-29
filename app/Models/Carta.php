<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carta extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'ref', 'titulo', 'fecha', 'comentario', 'archivo'];
}
