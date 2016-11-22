<?php

function getSortValues($input, $default_field = 'id', $default_dir = 'desc'){
    
    if($input){
        $sort['field'] = $input[0]['field'];
        $sort['dir']   = $input[0]['dir'];
    }else{
        $sort['field'] = $default_field;
        $sort['dir']   = $default_dir;
    }

    return $sort;
}

function getFilterValues($filter){
    
    if($filter){
        foreach ($filter['filters'] as $filter){
            $fields[$filter['field']] = $filter['value'];
        }
        
        return $fields;
    }
    
    return null;
}

