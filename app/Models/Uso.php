<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uso extends Model
{
    use HasFactory;
    protected $table = 'usos';
    protected $fillable = ['nombre', 'desc', 'obs','activo'];
}
