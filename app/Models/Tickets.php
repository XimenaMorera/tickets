<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;
    protected $table='tickets';
    protected $primaryKey='id';
    public $timestamps=false;

      // Relación con el usuario que creó el ticket
      public function creator()
      {
          return $this->belongsTo(User::class, 'created_by');
      }
  
      // Relación con el usuario asignado al ticket
      public function assignee()
      {
          return $this->belongsTo(User::class, 'assigned_to');
      }
}
