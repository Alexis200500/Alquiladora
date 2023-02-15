<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class puesto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ='puestos';
    protected $primaryKey='id_puesto';
    protected $fillable=['id_puesto','puesto'];

}
