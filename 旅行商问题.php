<?php

require_once __DIR__."/选择排序.php";

// 假设早期模拟10个点
$n=10;

$map=range(1,$n);
/**
 * 生成随机地图
 * @param $storeData
 * @param int $step
 */
function randSortedMap(&$storeData,$step=10):void {
    $x=0;
    $y=0;
    foreach ($storeData as $key=>$value){
        if($key==0){
            $storeData[$key]=[$x,$y];
            continue;
        }
        $x+=rand(1,$step);
        $y+=rand(1,$step);
        $storeData[$key]=[$x,$y];
    }
}

/**
 * 下面开始在上面生成的地图中，开始玩旅行商
 */
