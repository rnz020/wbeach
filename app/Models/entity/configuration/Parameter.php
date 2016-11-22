<?php

namespace App\Models\entity\configuration;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    protected $fillable = [
        'description', 'text_value', 'numeric_value'
    ];
}