<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class estado extends Model
{
    use HasFactory;
    use Softdeletes;

    protected $table = 'estados';

    protected $primaryKey='id_estado';

    protected $fillable = ['id_estado','estado'];

}
