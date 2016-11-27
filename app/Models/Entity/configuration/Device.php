<?php

namespace App\Models\entity\configuration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use SoftDeletes;
    
    protected $table = 'devices';
     
    protected $dates = ['created_at', 'updated_at','deleted_at'];
         
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'location_id', 'description', 'brand', 'model', 'version', 'esn','ip'
    ];

}
