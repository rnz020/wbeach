<?php namespace App\Models\dao;

use App\Models\entity\security\Permission;
class MenuDAO {
    
    public static function getAll(){
           
        $query = Permission::select()->get();
 
       return $query;
    }
    
    public static function getByType($type){
           
        $query = Permission::where(["type"=>$type])->get();
 
       return $query;
    }
    
    
    
    
    
}