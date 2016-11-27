<?php

namespace App\Models\dao;
use App\Models\entity\configuration\Device;

class DeviceDAO
{
    public static function get($filters, $skip, $pageSize, $sort)
    {
        $query = Device::join('locations', 'locations.id', '=', 'location_id')->
                         join('districts','districts.id', '=', 'locations.district_id')->
                 select(['devices.id', 'description', 'brand', 'model', 'version', 'ip', 'esn', 'location_id', 'locations.district_id', 'districts.name as district_name' ]);
              
        if ($filters)
        {
           $operatorField = ['eq'=>['district_id']];
           
            foreach ($filters as $field => $filter)
            {
                if (trim($filter))
                {
                    if(in_array($field, $operatorField['eq'])){
                        $query = $query->where($field,$filter);
                    }else{
                        $query = $query->where($field, 'like', '%' . $filter . '%');
                    }
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
}