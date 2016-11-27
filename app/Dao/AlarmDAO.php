<?php

namespace App\Models\DAO;

use App\Models\entity\alarms\Alarm;
use App\Models\entity\alarms\AlarmSeverity;
use App\Models\entity\alarms\Severity;
use DB;

class AlarmDAO
{
    public static function getAlarmsForGrid($filters, $skip, $pageSize, $sort)
    {
        $query = Alarm::select(['alarms.id', 'severity', 'instance', 'event_detail', 'event_date', 'probable_cause', 'dev.esn as esn', 'dis.name as district', 'color'])
                        ->leftJoin('devices as dev', 'device_ip', '=' ,'dev.ip')
                        ->leftJoin('locations as loc', 'dev.location_id', '=', 'loc.id')
                        ->leftJoin('districts as dis', 'dis.id', '=', 'loc.district_id')
                        ->leftJoin('alarm_severity as asev', 'asev.severity_name', '=', 'severity')
                        ->leftJoin('severities as sev', 'asev.severity_id', '=', 'sev.id');

        if ($filters)
        {
            foreach ($filters as $field => $filter)
            {
                if (trim($filter))
                {
                    // if ($field == 'severity_id')
                    // {
                    //     $query = $query->where($field, $filter);
                    // }
                    // else
                    // {
                        $query = $query->where($field, 'like', '%' . $filter . '%');
                    // }
                }
            }
        }

        $count = $query->count();

        if($sort)
        {
            $query = $query->orderBy($sort['field'], $sort['dir']);
        }

        $query = $query->skip($skip)->take($pageSize)->get();

        $data['result'] = $query;
        $data['count']  = $count;
    
        return $data;
    }

    public static function getCurrentSeverities($severity_id)
    {
        $current_severities = AlarmSeverity::select('severity_name')->where('severity_id', $severity_id)->lists('severity_name');

        return $current_severities;
    }

    public static function getNewSeverities()
    {
        $current_severities = AlarmSeverity::select('severity_name')->lists('severity_name');

        $new_severities     = Alarm::select(['severity'])->distinct('severity')->whereNotIn('severity', $current_severities)->get();

        return $new_severities;
    }

    public static function getTotalQuantityBySeverityId($severity_id)
    {
        $total = Alarm::join('alarm_severity as as', 'severity', '=', 'as.severity_name')
                        ->leftJoin('severities as s', 'as.severity_id', '=', 's.id')
                        ->where('s.id', $severity_id)
                        ->count('alarms.id');

        return $total;
    }
}