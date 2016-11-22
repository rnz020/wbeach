<?php namespace App\Models\entity\security;

use Zizaco\Entrust\EntrustPermission;
use Illuminate\Database\Eloquent\SoftDeletes;


class Permission extends EntrustPermission
{

    use SoftDeletes;
    protected $table = 'permissions';

    protected $fillable = [
        'id', 'name', 'display_name', 'parent_id', 'icon', 'url'
    ];

//    public function role(){
//        return $this->belongsToMany('Role','roles')->withTimestamps();
//    }
}