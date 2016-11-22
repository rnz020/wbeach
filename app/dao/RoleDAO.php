<?php

namespace App\Models\DAO;
use App\Models\entity\security\Role;
use DB;

class RoleDAO
{
    public static function selectRoles($filters, $skip, $pageSize,$sort)
    {
       $query = Role::select(['id','display_name','created_at']);

        if($filters)
        {
            foreach($filters as $field => $filter)
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
            $query = $query->orderBy($sort['field'],$sort['dir']);
        }

        $query = $query->skip($skip)->take($pageSize)->get();

        $data['result'] = $query;
        $data['count']  = $count;

        return $data;
    }

    public static function getAll()
    {
        return Role::select('id', 'display_name')->orderBy('id', 'asc')->get();
    }

    public static function getMenuTree()
    {
        $query = DB::table('permissions')
                    ->select('id',
                        DB::raw("IF(parent_id<1,'#',ifnull(parent_id,'#')) as parent"),
                        'display_name as text',
                        'icon'
                    )->get();

        return $query;
    }

    public static function getMenuTreeSelected($permissions)
    {
        $query = DB::table('permissions')
                    ->select(
                        'id',
                        DB::raw("IF(parent_id<1,'#',ifnull(parent_id,'#')) as parent"),
                        'display_name as text',
                        'icon',
                        DB::raw("CASE WHEN id in(".$permissions.")
                                 then if(parent_id=0 || sub_parent=0,'{selected:false}','{selected:true}')
                                 else '{selected:false}' end as state"
                                )
                        )->get();

        return $query;
    }

    public static function getMenuTreeDetail(array $permissions)
    {
        $query= DB::table('permissions')
                    ->select(
                        'id',
                        DB::raw("IF(parent_id<1,'#',ifnull(parent_id,'#')) as parent"),
                        'display_name as text',
                        'icon'
                        )->whereIn('id', $permissions)->get();
        return $query;
    }
}