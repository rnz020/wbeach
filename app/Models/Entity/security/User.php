<?php

namespace App\Models\entity\security;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Support\Facades\Config;

use Carbon\Carbon;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use SoftDeletes;
    use EntrustUserTrait {
        EntrustUserTrait::restore insteadof SoftDeletes;
    }

    protected $dates = ['created_at', 'updated_at','deleted_at'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'username', 'email', 'password', 'phone', 'cellphone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Functions to disable Remember Token
     */
    
    public function getRememberToken()
    {
        return null; // not supported
    }

    public function setRememberToken($value)
    {
    // not supported
    }

    public function getRememberTokenName()
    {
        return null; // not supported
    }

    /**
    * Overrides the method to ignore the remember token.
    */
    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();

        if (!$isRememberTokenAttribute)
        {
            parent::setAttribute($key, $value);
        }
    }

    /**
     * Relationships between tables.
     *
     */

    // Re-write entrust relationship adding timestamps
    public function roles()
    {
        return $this->belongsToMany(Config::get('entrust.role'), Config::get('entrust.role_user_table'), Config::get('entrust.user_foreign_key'), Config::get('entrust.role_foreign_key'))->withTimestamps();
    }
    
    /**
     * Mutators.
     *
     */
    
    // public function setName($value)
    // {
    //     if ( ! empty ($value))
    //     {
    //       $this->attributes['name'] = trim($value);
    //     }
    // }

    // public function getFullnameAttribute()
    // {
    //     return $this->attributes['name'] . ' - ' . $this->attributes['username'];
    // }
    
    public function setPasswordAttribute($value)
    {
        if ( ! empty ($value))
        {
            $this->attributes['password'] = \Hash::make($value);
        }
    }
    
    /**
    * Scopes
    */

    // public function scopeToday($query)
    // {
    //     $query->where('created_at', '>=', Carbon::today());
    // }

    // public function scopeYesterday($query)
    // {
    //     $query->where( 'created_at', '>=', Carbon::yesterday() )->where( 'created_at', '<' , Carbon::today() );
    // }
    

}