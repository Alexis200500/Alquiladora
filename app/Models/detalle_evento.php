<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class detalle_evento extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='detalle_eventos';
    protected $primaryKey='id_detalle_evento';
    protected $fillable=[
        'id_detalle_evento',
        'id_cliente',
        'id_evento',
        'direccion',
        'id_estado',
        'fecha_evento',
        'costo',
        'cantidad_personas',
        'id_admin'
    ];
}
