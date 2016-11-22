<?php

namespace App\Models\entity;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\DAO\TrafficDAO;
use App\Models\DAO\ParameterDAO;



/**
 *
 * @author Jhon E. R. <jh0nx0901@gmail.com>
 */
class Util {
    const MINUTES_DAY    = 1440;   //array para llenar en GRID RIN01. Cantidad de minutos por día
    const VALUEUBIGEODEP = 14;     //Código ubigeo del departamento de Lambayeque
    const FORMAT_CSV     = 'csv';
    const FORMAT_EXCEL   = 'xlsx';
    const FORMAT_TXT     = 'txt';
    //const COUNT_HEADER_RIN01   = 4;
    const COUNT_HEADER_RIN01     = 11; //Cantidad de celdas que ocupa toda la cabecera y filtros para los reportes especificos

    const COUNT_HEADER_CSV = 14;
    const COUNT_HEADER_TXT = 5;


    public static function obtenerArray(Request $request, $type_filter, $in_out, $id, $rit)
    {

        $dataForGrid = Util::dataForGrid($request, $type_filter, $in_out, $id, $rit);
        $param_kb    = ParameterDAO::getParameters('TRAFFIC_VOLUMEN_KB', 1);
        $sum['HTTP_E'] = 0; $sum['FTP_E'] = 0; $sum['SMTP_E'] = 0; $sum['OTROS_E'] = 0;
        $sum['HTTP_S'] = 0; $sum['FTP_S'] = 0; $sum['SMTP_S'] = 0; $sum['OTROS_S'] = 0;
        $array = getDayMinutes( config('select-options.report-row-io') );
        $ipMatch = "";
        foreach ($dataForGrid as $value)
        {
            $ipMatch      = $value->IP_MATCH;
            $position     = $value->POSITION;
            $typeTraffic  = $value->TYPE_TRAFFIC;
            $typeProtocol = $value->TYPE_PROTOCOL;
            $valueKb      = round($value->BYTES/$param_kb['value_kilobytes'],4);

            for( $j = 0; $j < Util::MINUTES_DAY; $j++ )
            {
                if( $j == $position )
                {

                    if( $typeTraffic == 'ENTRANTE' )
                    {
                        $array[$j][$typeProtocol.'_E'] = $valueKb;
                        $sum[$typeProtocol.'_E']       = $sum[$typeProtocol.'_E'] + $valueKb;
                    }
                    else
                    {
                        if( $typeTraffic == 'SALIENTE' )
                        {
                            $array[$j][$typeProtocol.'_S'] = $valueKb;
                            $sum[$typeProtocol.'_S']       = $sum[$typeProtocol.'_S'] + $valueKb;
                        }
                    }
                }
            }
        }
        $array[Util::MINUTES_DAY]['MINUTE']   = "TOTAL";
        $array[Util::MINUTES_DAY]['HTTP_E']   = $sum['HTTP_E']  == 0 ? "N/D" : $sum['HTTP_E'];
        $array[Util::MINUTES_DAY]['FTP_E']    = $sum['FTP_E']   == 0 ? "N/D" : $sum['FTP_E'];
        $array[Util::MINUTES_DAY]['SMTP_E']   = $sum['SMTP_E']  == 0 ? "N/D" : $sum['SMTP_E'];
        $array[Util::MINUTES_DAY]['OTROS_E']  = $sum['OTROS_E'] == 0 ? "N/D" : $sum['OTROS_E'];
        $array[Util::MINUTES_DAY]['HTTP_S']   = $sum['HTTP_S']  == 0 ? "N/D" : $sum['HTTP_S'];
        $array[Util::MINUTES_DAY]['FTP_S']    = $sum['FTP_S']   == 0 ? "N/D" : $sum['FTP_S'];
        $array[Util::MINUTES_DAY]['SMTP_S']   = $sum['SMTP_S']  == 0 ? "N/D" : $sum['SMTP_S'];
        $array[Util::MINUTES_DAY]['OTROS_S']  = $sum['OTROS_S'] == 0 ? "N/D" : $sum['OTROS_S'];
        $array[Util::MINUTES_DAY]['IP_MATCH'] = $ipMatch;

        return $array;
    }

    public static function dataForGrid(Request $request, $type_filter, $in_out, $id, $rit)
    {

        $param['ports'] = ParameterDAO::getParameters('TRAFFIC_VOLUMEN_PORT');
        $param['ips']   = ParameterDAO::getParameters('TRAFFIC_VOLUMEN_IP', 1);
        $between        = [\Carbon::today()->startOfDay(),\Carbon::today()->endOfDay()];
        if ( $type_filter == "search" )
        {
            $filter = getFilterValues( $request->input('filter') );
        }
        else
        {
            if( $type_filter == "export" )
            {
                $filter = array();
                $filter['esn'] = $request->get('esn');
                $filter['department_id'] = $request->get('department_id');
                $filter['province_id'] = $request->get('province_id');
                $filter['district_id'] = $request->get('district_id');
            }
        }

        $filterEsn = true;

        if(empty($filter['esn']))
        {
            $filterEsn = false;
        }

        return TrafficDAO::getTrafficsForGrid($filter, $param, $between, $in_out, $filterEsn, $id, $rit);
    }

    public static function downloadExport(Request $request, $data, $reportView){

        //dd($data);
        $parametros = $request->all();
        $nameReport = isset($parametros['nameReport']) ? $parametros['nameReport']  : 'Reporte' ;
        $typeFile   = isset($parametros['typeFile'])   ? $parametros['typeFile']    : 'xlsx' ;
        $count_registros    = count($data);

        Excel::create($nameReport, function ($file) use ($nameReport,$data,$parametros,$reportView,$typeFile,$count_registros) {

            $file->sheet('Hoja 1', function ($sheet) use ($nameReport,$data,$parametros,$reportView,$typeFile,$count_registros) {


                //dd($sheet->loadView($reportView,compact('nameReport','typeFile','parametros')));
                if($typeFile == Util::FORMAT_EXCEL){
                    $sheet->setBorder('C4:J6', 'thin');
                    //dd($sheet->getHighestRow());
                    $sheet->setBorder('B8:J'.(Util::COUNT_HEADER_RIN01 + $count_registros), 'thin');

                    $sheet->cells('B8:J'.(Util::COUNT_HEADER_RIN01 + $count_registros), function($cells) {
                        $cells->setAlignment('center');
                    });
                    $sheet->mergeCells('C1:J1');
                    $sheet->mergeCells('C2:J2');
                    $sheet->mergeCells('C3:J3');
                    $sheet->mergeCells('B7:J7');

                    $sheet->fromArray($data, null, 'B'.(Util::COUNT_HEADER_RIN01+1), false, false);
                }else{
                    if($typeFile == Util::FORMAT_CSV){
                        $sheet->fromArray($data, null, 'A'.Util::COUNT_HEADER_CSV, false, false);
                    }else{
                        $sheet->fromArray($data, null, 'A'.Util::COUNT_HEADER_TXT, false, false);
                    }
                }
                $sheet->loadView($reportView,compact('nameReport','typeFile','parametros'));

            });

        })->export($typeFile);

    }

}
