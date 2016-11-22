<?php

namespace App\Models\dao;

use App\Models\entity\ubigeo\Location;
use App\Models\entity\ubigeo\Department;
use App\Models\entity\ubigeo\Province;
use App\Models\entity\ubigeo\District;
use App\Models\entity\ubigeo\locality;
use DB;
class UbigeoDAO
{ 
    
    public static function getDepartment()
    {
        $query = Department::select()
                 ->orderBy('name')
                 ->get();
        
        return $query;
    }
    
    public static function getDepartmentProvince()
    {
        $query = Department::join('provinces', 'provinces.department_id', '=', 'departments.id')
                 ->select('provinces.id as province_id', 'departments.id as department_id', 'departments.name as department_name', 'provinces.name as province_name',
                 DB::raw("CONCAT(departments.name, ' - ', provinces.name) as department_province_name"))                 
                 ->orderBy('department_province_name', 'asc')    
                 ->get();
        
        return $query;
    }
    
    public static function getProvinceByDepartmentId($departmentId)
    {
        $query = Province::where("department_id", $departmentId)
                 ->orderBy('name')
                 ->get();
        
        return $query;
    }
    
    public static function getDistrictByProvinceId($provinceId)
    {
        $query = District::where('province_id', $provinceId)
                  ->orderBy('name')
                  ->get();
        
        return $query;
    }
    
    public static function getLocalityByDistrictId($districtId)
    {
        $query = locality::where('district_id', $districtId)
                  ->orderBy('name')
                  ->get();
        
        return $query;
    }
    
    
    
    //***
    public static function getDistrictByProvince($idProvince)
    {
        $query = DB::table('districts')
                    ->select('id','name')
                    ->whereNotNull('name')
                    ->where('name','<>','')
                    ->where('province_id','=',$idProvince)
                    ->groupBy('name')
                    ->orderBy('name')
                    ->get();
        return $query;
    }
    
    
    //*locations
    public static function getLocationById($id)
    {
        $query = Location::where('locations.id', $id)
                 ->first();
        
        return $query;
    }
    
    public static function getLocationAreasByLocationId($id)
    {
        $query = Location::join('localities', 'localities.id', '=', 'locations.localitie_id')
                ->join('districts', 'districts.id', '=', 'locations.district_id')
                ->join('provinces', 'provinces.id', '=', 'locations.province_id')
                ->select('locations.id as location_id', 'locations.province_id', 'provinces.name as province_name', 
                          'locations.district_id',   'districts.name as district_name',
                          'locations.localitie_id as locality_id', 'localities.name as locality_name',
                          'ubigeo')  
                ->where('locations.id', $id)
                ->first();
        
        return $query;
    }
    
    public static function getLocationByUbigeo($ubigeo)
    {
        $query = Location::where('ubigeo', $ubigeo)->first();
        
        return $query;
    }
    
    public static function getLocationByLocalityId($localityId)
    {
        $query = Location::where('localitie_id', $localityId)->first();
        
        return $query;
    }
    
    
    
    

    public static function getCmbDependentByCmb($idValue, $idCmb, $idCmbDependent)
    {
        $query = DB::table(str_plural($idCmbDependent))
                    ->select('id','name')
                    ->whereNotNull('name')
                    ->where('name','<>',' ')
                    ->where($idCmb."_id",'=',$idValue)
                    ->groupBy('name')
                    ->orderBy('name')
                    ->get();
        return $query;
    }
    
    /**
     * Listado de departamentos en grilla.
     *
     * @return departamentos
     */
    public static function getDepartmentForGrid($code){
        $query = DB::table('departments')
                    ->select('id','name')
                    ->whereNotNull('name')
                    ->where('name','<>','')
                    ->groupBy('name')
                    ->orderBy('name');
        if(!empty($code)){
            $query = $query->where('code','=',$code);
        }            
        $query = $query->get();
        return $query;
    }

    /**
     * Listado de provincias en grilla.
     *
     * @return provincias
     */
    public static function getProvinceForGrid($code){
        $query = DB::table('provinces')
                    ->select('id','name')
                    ->whereNotNull('name')
                    ->where('name','<>','')
                    ->groupBy('name')
                    ->orderBy('name');
        if(!empty($code)){
            $query = $query->where('department_id','=',$code);
        }                       
        $query = $query->get();
        return $query;
    }
    
  
    public static function getDistrictByDepartmentId($department_id)
    {
        $provinces = UbigeoDAO::getProvincesByDepartmentIdSelect2($department_id)->lists('id');
        $query     = District::whereIn('province_id', $provinces)->orderBy('name')->get();
        
        return $query;
    }

    public static function getProvincesByDepartmentIdSelect2($department_id)
    {
        return Province::where('department_id', $department_id)->select('id','name as text')->orderBy('name')->get();
    }
    
}


