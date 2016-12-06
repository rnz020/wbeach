<?php

namespace App\Repositories;

use App\Entities\Holding;

class HoldingRepository  extends Repository
{
    public function getModel()
    {
        return new Holding();
    }
   
     public function searchPagine($filters, $skip, $pageSize, $sort) 
    {
        $query = $this->newQuery()->select(['id', 'group_name', 'legal_name', 'ruc', 'address', 'subscription_date']);

        if ($filters){
            foreach ($filters as $field => $filter){
                if (trim($filter)){
                    $query = $query->where($field, 'like', '%' . $filter . '%');
                }
            }
        }

        $count = $query->count();

        if($sort){
            $query = $query->orderBy($sort['field'], $sort['dir']);
        }

        $query = $query->skip($skip)->take($pageSize)->get();

        $data['result'] = $query;
        $data['count']  = $count;
    
            return $data;
    }

}
