<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class materiales extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table = 'materiales';
    protected $primaryKey = 'id_material';
    protected $fillable = ['id_material','material','imagen'];
}
