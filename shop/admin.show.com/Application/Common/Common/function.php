<?php

function showError ( $model )
{
    $error = $model->getError ();
    $ul = "<ul>";
    if ( is_array ( $error ) ) {
        foreach ( $error as $value ) {
            $ul .= "<li>{$value}</li>";
        }
    } else {
        $ul .= "<li>{$error}</li>";
    }
    $ul .= "</ul>";
    return $ul;
}
function array_column($id,$column_key){
    $temp=array();
    foreach($id as $v){
        $temp[]=$v[$column_key];
    }
    return $temp;
}

/**
 * @param $name
 * @param $rows
 * @param $defaultValue
 * @param string $fieldValue
 * @param string $fieldName
 */
function arr2select($name,$rows,$defaultValue,$fieldValue='id',$fieldName='name'){
    $html ="<select name='{$name}' class='{$name}'>";
    $html .="<option value=''>--请选择--</option>";
    foreach($rows as $row){
        $selected  = '';
        if($row[$fieldValue]==$defaultValue){
            $selected = "selected='selected'";
        }
        $html.="<option value='{$row[$fieldValue]}' {$selected}>{$row[$fieldName]}</option>";
    }
    echo $html;


}