<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autores extends Model
{
    use HasFactory;

    protected $table = 'autores';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id' ,
        'nombre',
        'nickname',
        'email'
    ];
}
