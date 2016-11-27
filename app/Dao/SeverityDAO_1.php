<?php

namespace App\Models\DAO;
use App\Models\entity\alarms\Severity;

class SeverityDAO
{
    public static function getSeveritiesForGrid($sort)
    {
        $query = Severity::select(['id', 'name', 'description', 'color']);

        $count = $query->count();

        if($sort)
        {
            $query = $query->orderBy($sort['field'], $sort['dir']);
        }

        $query = $query->get();

        $data['result'] = $query;
        $data['count']  = $count;
    
        return $data;
    }
}