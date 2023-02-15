<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class cliente extends Model
{
  use HasFactory;

  use softDeletes;

  protected $table = 'clientes';
  
  protected $primaryKey = 'id_cliente';

  protected $fillable = ['id_cliente','nombre','apellido_paterno','apellido_materno','edad','sexo','telefono','direccion','imagen','email','password','id_estado'];

}
