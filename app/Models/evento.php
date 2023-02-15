<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;
class evento extends Model
{
    use HasFactory;
    use Softdeletes;

    protected $table = 'eventos';
    protected $primaryKey='id_evento';
    protected $fillable = ['id_evento','evento'];
}
