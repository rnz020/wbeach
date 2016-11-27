<?php

namespace App\Models\entity\alarms;

use App\Models\entity\AbstractModel;

class Severity extends AbstractModel
{
    public function alarm_severities()
    {
        return $this->hasMany('App\Models\entity\alarms\AlarmSeverity');
    }
}
