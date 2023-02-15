<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class admin extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ='admins';
    protected $primaryKey='id_admin';
    protected $fillable=['id_admin','nombre','apellido_paterno','apellido_materno','edad','sexo','telefono','direccion',
    'id_estado','id_puesto','imagen','email','password'];
}
