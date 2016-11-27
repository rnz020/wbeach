<?php

namespace App\Models\DAO;

use App\Models\entity\configuration\Parameter;
use DB;

class ParameterDAO
{

    public static function get($filters, $skip, $pageSize, $sort)
    {
        $query = Parameter::select()->where('text_value', '<>', 'MENU_CUSTOMIZATION');
        
        if ($filters)
        {
            foreach ($filters as $field => $filter)
            {
                if (trim($filter))
                {
                    $query = $query->where($field, 'like', '%' . $filter . '%');
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
    
    public static function getById($id)
    {
        return Parameter::where('id', $id)->first();
    }

    public static function getCustomizationOptions()
    {
        return Parameter::where('text_value', 'MENU_CUSTOMIZATION')->lists('numeric_value', 'description');
    }

    public static function getStyleStatus()
    {
        return Parameter::where('text_value', 'MENU_CUSTOMIZATION')->where('description', 'DEFAULT')->first();
    }

    public static function getParameters($text_value, $type_list = null)
    {
        if ($type_list == 1)
        {
            return Parameter::where('text_value', $text_value)->lists('numeric_value', 'description');
        }
        
        return Parameter::where('text_value', $text_value)->lists('description', 'numeric_value');
    }
    
    public static function getParametersByTextValue($text_value)
    {
        return Parameter::where('text_value', $text_value)->get();
    }

}