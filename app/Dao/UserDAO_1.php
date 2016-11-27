<?php

namespace App\Models\DAO;
use App\Models\entity\security\User;

class UserDAO
{
    public static function getUsersForGrid($filters, $skip, $pageSize, $sort)
    {
        $query = User::select(['id', 'fullname', 'email', 'username']);

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
}