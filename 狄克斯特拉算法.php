<?php

//require_once __DIR__."/function.php";

// 地图图片：https://tva1.sinaimg.cn/large/007S8ZIlgy1gey3i65belj30em080dg1.jpg

$map=[
    'a'=>['b'=>6,'d'=>1],
    'b'=>['a'=>6,'d'=>2,'e'=>2,'c'=>5],
    'c'=>['b'=>5,'e'=>5],
    'd'=>['a'=>1,'e'=>1,'b'=>2],
    'e'=>['b'=>2,'d'=>1,'c'=>5]
];


const PRE_POINT='pre_point';
const COST='cost';

/**
 * 获取最短距离
 * @param array $map
 * @param string $start
 * @param string $end
 * @return int
 */
function getShortestDistance(array $map,string $start,string $end):int{
    $selectedPoint=[];
    $mapResult=setResultMap($map);
    $mapResult[$start][PRE_POINT]=null;
    $mapResult[$start][COST]=0;
    $nextPoint=$start;
    $round=1;
    while ($nextPoint && $round<50){
        $round++;
        // 获得当前最短距离
        $nextPoint=getShortestIndexBetweenPoint($mapResult,$selectedPoint);
        // 更新其临近值列表
        if($nextPoint){
            $selectedPoint[$nextPoint]=1;
            foreach ($map[$nextPoint] as $neighborPoint=>$cost){
                $newCost=$mapResult[$nextPoint][COST]+$cost;
                if($newCost<$mapResult[$neighborPoint][COST]){
                    $mapResult[$neighborPoint][PRE_POINT]=$nextPoint;
                    $mapResult[$neighborPoint][COST]=$newCost;
                }
            }
        }
    }
    return $mapResult[$end][COST];
}

/**
 * 获取一个数组中最小的那个值
 * @param array $mapResult
 * @param array $selectedPoint
 * @return string|null
 */
function getShortestIndexBetweenPoint(array $mapResult,array $selectedPoint) {
    $smallData=null;
    $smallIndex=null;
    foreach ($mapResult as $point=>$value){
        if(isset($selectedPoint[$point])){
            continue;
        }
        if(is_null($smallIndex)){
            $smallIndex=$point;
            $smallData=$value[COST];
        }
        if($value[COST]<$smallData){
            $smallData=$value[COST];
            $smallIndex=$point;
        }
    }
    return $smallIndex;
}

/**
 * 生成保存结果的数组
 * @param array $map
 * @return array
 */
function setResultMap(array $map):array {
    $returnData=[];
    foreach ($map as $point=>$neighbor){
        $returnData[$point]=[];
        $returnData[$point]=[
            PRE_POINT=>null,
            COST=>PHP_INT_MAX
        ];
    }
    return $returnData;
}