<?php

namespace App\Models\entity\alarms;

use Illuminate\Database\Eloquent\Model;
// use App\Models\entity\AbstractModel;

class AlarmSeverity extends Model
// class AlarmSeverity extends AbstractModel
{
    protected $table = "alarm_severity";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'severity_id', 'severity_name'
    ];

    public function severity()
    {
        return $this->belongsTo('App\Models\entity\alarms\Severity');
    }
}
