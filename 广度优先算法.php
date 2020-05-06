<?php

require_once __DIR__."/function.php";

/**
 * 广度优先算法实现问题1：是否存在
 * @param $map
 * @param $searchContent
 * @param $resultStore
 * @return bool
 */
function checkExit($map,$searchContent,&$resultStore):bool {
    foreach ($map as $number=>$nextMap){
        if($number==$searchContent){
            $resultStore=true;
            break;
        }else{
            checkExit($nextMap,$searchContent,$resultStore);
        }
    }
    return $resultStore;
}

$resultStore=false;
$map=createMap(10);
$searchContent=getMapRandItem($map);
checkExit($map,$searchContent,$resultStore);
print ( $resultStore?"代码运行正确":"代码运行错误").PHP_EOL;

$checkExistFalse=false;
checkExit(createMap(10),15,$checkExistFalse);
print ($checkExistFalse ?"代码运行错误":"代码运行正常").PHP_EOL;



