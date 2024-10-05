<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emision extends Model
{
    use HasFactory;
    protected $table = 'emisiones';
    protected $fillable = ['nombre', 'desc', 'obs','activa'];
}
