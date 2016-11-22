<?php

namespace App\Models\dao;
use DB;
use App\Models\entity\Util;
use App\Models\entity\reports\Traffic;
class TrafficDAO{

    public static function getTrafficsForGrid($filters, $param, $between, $in_out = true, $filterEsn = true, $id = false, $rit = false)
    {
        $case = 'CASE ';

        foreach ($param['ports'] as $key => $value)
        {
            $case .= 'WHEN traffic.source_port = '.$key.' OR traffic.destination_port = '.$key.' THEN "'.$value.'" ';
        }

        $case .= 'ELSE "OTROS" END TYPE_PROTOCOL';

        if ($in_out)
        {
            $case_in_out = "CASE coalesce(dev1.ip,dev2.ip) WHEN traffic.source_ip THEN 'SALIENTE' ELSE 'ENTRANTE' END TYPE_TRAFFIC";

            $groupBy     = "POSITION, TYPE_PROTOCOL, TYPE_TRAFFIC";

        }
        else
        {
            $case_in_out = "null";
            $groupBy     = "POSITION, TYPE_PROTOCOL";
        }

        if ($filterEsn)
        {
            $row_filterEsn = "coalesce(dev1.ip,dev2.ip) as IP_MATCH";
        }
        else
        {
            $row_filterEsn = "null as IP_MATCH";
        }
        if($id){
            $groupBy     = "POSITION_DAY, TYPE_PROTOCOL, TYPE_TRAFFIC";
        }
        $query = DB::table('traffic')
                        ->select(
                            'date_flow_start as FECHA',
                            DB::raw('day(date_flow_start) as POSITION_DAY'),
                            DB::raw($row_filterEsn),
                            DB::raw("(CONVERT(SUBSTRING(date_flow_start,12,13),UNSIGNED INTEGER))*60+CONVERT(SUBSTRING(date_flow_start,15,16),UNSIGNED INTEGER) AS POSITION"),
                            DB::raw($case_in_out),
                            DB::raw($case),
                            DB::raw("sum(traffic.bytes) as BYTES"))
                        ->leftJoin('devices as dev1', 'traffic.source_ip', '=', 'dev1.ip')   
                        ->leftJoin('devices as dev2', 'traffic.destination_ip', '=', 'dev2.ip')
                        ->leftJoin('locations as loc', 'loc.id', '=', DB::raw('coalesce(dev1.location_id,dev2.location_id)') );
                        
                        if($rit){
                            $query = $query->whereBetween(DB::raw("CASE coalesce(dev1.ip,dev2.ip) WHEN traffic.source_ip THEN traffic.destination_ip ELSE traffic.source_ip END"),[$param['ips']['ip_start_intranet'],$param['ips']['ip_end_intranet']]);
                        }else {
                            $query = $query->whereNotBetween(DB::raw("CASE coalesce(dev1.ip,dev2.ip) WHEN traffic.source_ip THEN traffic.destination_ip ELSE traffic.source_ip END"), [$param['ips']['ip_start_intranet'], $param['ips']['ip_end_intranet']]);
                        }
                            $query=$query->whereBetween('date_flow_start',$between)
                                    ->whereNotNull(DB::raw("coalesce(dev1.ip,dev2.ip)"))
                                    ->groupBy(DB::raw($groupBy))
                                    ->orderBy(DB::raw('date_flow_start'),'asc');

        if($id && $id!='TODOS'){
            $case_protocol = '(CASE ';
            foreach ($param['ports'] as $key => $value)
            {
                $case_protocol .= 'WHEN traffic.source_port = '.$key.' OR traffic.destination_port = '.$key.' THEN "'.$value.'" ';
            }
            $case_protocol .= 'ELSE "OTROS" END ';
            $case_protocol.=' )';
            $query=$query->where(DB::raw($case_protocol),'=',"$id");
        }
        if ($filters)
        {
            foreach ($filters as $field => $filter)
            {
                if ( trim($filter) )
                {
                    if($field == "esn")
                    {
                        $field = DB::raw("coalesce(dev1.esn,dev2.esn)");
                    }   
                    
                    $query = $query->where($field,'=',$filter);
                }
            }
        }

        return  $query->get();   // QUERY CON DATA
    }

    public static function getTraffics($filters, $formatDateNow=null){

                        $query = Traffic::select('traffic.id','date_flow_start', 'ub.department_id', 'ub.province_id', 'ub.district_id','dev1.esn as dec' ,
                                            DB::raw("date(date_flow_start) as date"),
                                            DB::raw("year(date_flow_start) as year"), 
                                            DB::raw("month(date_flow_start) as month"),
                                            DB::raw("day(date_flow_start) as day"),
                                            DB::raw("DATE_FORMAT(date_flow_start,'%k:%i') as time"),
                                            DB::raw("round(TIME_TO_SEC(DATE_FORMAT(date_flow_start,'%k:%i')) / 60) as time_to_minutes"),
                                            DB::raw("coalesce(dev1.ip,dev2.ip) ip_coincide"), 
                                            DB::raw("traffic.source_ip"),
                                            DB::raw("traffic.source_port"),
                                            DB::raw("traffic.destination_ip"), 
                                            DB::raw("traffic.destination_port"), 
                                            DB::raw("traffic.bytes"),
                                            DB::raw("traffic.session"),
                                            DB::raw("traffic.bytes as bytes1"))
                                     ->leftJoin('devices as dev1', 'traffic.source_ip', '=', 'dev1.ip')   
                                     ->leftJoin('devices as dev2', 'traffic.destination_ip', '=', 'dev2.ip')  
                                     ->leftJoin('locations as ub', 'dev1.location_id', '=', 'ub.id')   
                                     ->whereNotNull(DB::raw("coalesce(dev1.ip,dev2.ip)"))
                                     ->orderBy(DB::raw('date_flow_start'),'asc');
        if($formatDateNow){            
            $query = $query->where(DB::raw("DATE_FORMAT(traffic.date_flow_start,'".$formatDateNow."')"), DB::raw("DATE_FORMAT(now(),'".$formatDateNow."')"));
        }
        
        if ($filters)
        {
           $operatorField = [
                    'eq'=>['dev1.esn', 'department_id', 'province_id', 'district_id']
               ];
           
            foreach ($filters as $field => $filter)
            {
                if (trim($filter))
                {
                    if(in_array($field, $operatorField['eq'])){
                        $query = $query->where($field, $filter);
                    }else{
                        $query = $query->where($field, 'like', '%' . $filter . '%');
                    }
                }
            }
        }
                                      
            $query = $query->get(); 
             return $query;
    }


    public static function loadUrlVisited($filters, $skip, $pageSize ,$sort){

        $query = "SELECT URL,count(*) VISITAS FROM traffic";

        if ($filters)
        {
            foreach ($filters as $field => $filter)
            {
                if ( trim($filter) )
                {
                    if($field == "anio")
                    {
                        $query .= " WHERE year(date_flow_start)=".$filter;
                    }
                    if($field == "mes")
                    {

                        $query .= " AND month(date_flow_start)=".$filter;
                    }

                }
            }
        }


        $query.= " group by URL ";

        if($sort && $sort['field']!='id')
        {

            $query  .= " ORDER BY ".$sort['field'] . $sort['dir'];
        }
        else{
            $query  .= " ORDER BY VISITAS desc ";
        }

        $query_count  =  count(DB::select($query." LIMIT 20 OFFSET 0"));

        $query_data  =   DB::Select("SELECT * FROM (".$query." LIMIT 20 OFFSET 0) Pagination limit ".$pageSize." offset ".$skip);


        $data['result'] =   $query_data;
        $data['count']  =   $query_count;

        return $data;

    }

}


