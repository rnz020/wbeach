<?php namespace App\Models\entity\security;

use Zizaco\Entrust\EntrustRole;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends EntrustRole
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name'
    ];

    /**
     * Assigned value field name
     * @param $value
     */
    public function setNameAttribute($value)
    {
            $this->attributes['name']   =  str_replace(' ','_',$this->attributes['display_name']);
    }

    public function perms()
    {
        return $this->belongsToMany(Config::get('entrust.permission'), Config::get('entrust.permission_role_table'), Config::get('entrust.role_foreign_key'), Config::get('entrust.permission_foreign_key'))->withTimestamps();
    }
}