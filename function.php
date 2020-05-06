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

/**
 * 创建地图，双向的
 * @param $mapAmount
 * @param float $randLevel
 * @return array
 */
function createMap($mapAmount,$randLevel=RAND_LEVEL_THREE):array {
    // 先创建所有人
    $allPeople=range(1,$mapAmount);
    // 再来创建他们之间的认识关系，其中有 $randLevel 数量的人互相认识
    $randAmount=ceil($mapAmount*$randLevel);
    $friendShipMap=[];
    for ($count=1;$count<$randAmount;$count++){
        $oneFriend=rand(1,$mapAmount);
        $hisFriend=rand(1,$mapAmount);
        // 两个选出的是同一个值
        if($oneFriend==$hisFriend){
            continue;
        }
        // 两者构成朋友
        buildFriendship($friendShipMap,$oneFriend,$hisFriend);
    }
    $returnData=[];
    foreach ($allPeople as $key=>$number){
        // 删除一些人际关系
        if(rand(1,100)<=($randLevel*100)){
            continue;
        }
        $returnData[$number]=[];
        if(isset($friendShipMap[$number])){
            $returnData[$number]=$friendShipMap[$number];
        }
    }
    return $returnData;
}

/**
 * 记录友谊关系
 * @param $friendShipMap array
 * @param $oneFriend int
 * @param $hisFriend int
 * @return bool
 */
function buildFriendship(&$friendShipMap,$oneFriend,$hisFriend){
    if(checkIsFriendShip($friendShipMap,$oneFriend,$hisFriend)){
        return true;
    }
    if(isset($friendShipMap[$oneFriend]) && !in_array($hisFriend,$friendShipMap[$oneFriend])){
        $friendShipMap[$oneFriend][$hisFriend]=[];
    }else{
        $friendShipMap[$oneFriend]=[];
        $friendShipMap[$oneFriend][$hisFriend]=[];
    }
    return buildFriendship($friendShipMap,$hisFriend,$oneFriend);
}

/**
 * 检查两个人是否是朋友
 * @param $friendShipMap array
 * @param $oneFriend int
 * @param $hisFriend int
 * @return bool
 */
function checkIsFriendShip($friendShipMap,$oneFriend,$hisFriend){
    return (
        isset($friendShipMap[$oneFriend])
        &&
        isset($friendShipMap[$hisFriend])
        &&
        isset($friendShipMap[$oneFriend][$hisFriend])
        &&
        isset($friendShipMap[$hisFriend][$oneFriend])
    );
}

/**
 * 获取地图中随机的一个点
 * @param $map
 * @return mixed
 */
function getMapRandItem($map){
    $itemArray=array_slice($map,rand(1,count($map)-1)-1,1,true);
    $arrayKeys=array_keys($itemArray);
    return $arrayKeys[rand(0,count($arrayKeys)-1)];
}