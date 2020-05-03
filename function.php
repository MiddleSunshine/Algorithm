<?php
const RAND_LEVEL_ONE=0.3;
const RAND_LEVEL_TWO=0.5;
const RAND_LEVEL_THREE=0.8;

/**
 * 将一个数组弄混乱
 * @param $array array 数组
 * @param float $randLevel 混乱级别
 */
function randArray(&$array,$randLevel=RAND_LEVEL_ONE):void {
    $length=count($array);
    $randTimes=ceil($length*$randLevel);
    for ($i=1;$i<$randTimes;$i++){
        changeArrayData($array,rand(1,$length-1),rand(1,$length-1));
    }
}

/**
 * 替换数组中两个索引的位置
 * @param $array
 * @param $firstIndex
 * @param $nextIndex
 */
function changeArrayData(&$array,$firstIndex,$nextIndex){
    $temp=$array[$firstIndex];
    $array[$firstIndex]=$array[$nextIndex];
    $array[$nextIndex]=$temp;
}

function debugStart(&$record,$newItem){
    $record[]=$newItem;
}

function debugEnd($record,$fileName=''):void {
    $file=fopen(__DIR__."/".($fileName?$fileName:"debug.txt"),'w');
    $content="";
    foreach ($record as $key=>$value){
        if(is_array($value)){
            $content.=implode(PHP_EOL,$value);
        }else{
            $content.=$value;
        }
    }
    fwrite($file,$content);
    fclose($file);
}