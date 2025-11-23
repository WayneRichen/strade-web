<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Strategy extends Model
{
    protected $fillable = [
        'name',
        'unified_symbol',
        'description',
        'class_name',
        'is_active',
    ];
}
