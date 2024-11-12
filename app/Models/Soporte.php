<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soporte extends Model
{
    use HasFactory;
    protected $table='tickets';
    protected $primaryKey='id';
    public $timestamps=false;
}
