<?php

$data=range(1,1000);

$searchData=rand(1,1000);

$start=ceil(count($data)/2);

$count=1;
/**
 * @param $data array 假设数据都是从小到大排列的
 * @param $searchData int 假设搜索的数据都是整数
 * @param int $start
 * @param int $end
 * @param int $count 统计值
 * @return int
 */
function search($data,$searchData,$start=0,$end=1,$count=1){
    $count++;
    if($count>count($data)){
        echo "脚本运行错误：".$start.PHP_EOL;
        return -1;// 表示发生了错误，防止陷入死循环
    }
    $middle=ceil(($end-$start)/2+$start);
    echo "Middle：".$middle."/start:$start/end:$end".PHP_EOL;
    if($data[$middle]>$searchData){
        // 数据在左边
        return search($data,$searchData,$start,$middle,$count);
    }else if($data[$middle]==$searchData){
        // 找到数据了
        return $middle;
    }else{
        // 数据在右边
        return search($data,$searchData,$middle,$end,$count);
    }
}

$result=search($data,$searchData,0,count($data));

// 检测结果对不对
if(($result+1)!=$searchData){
    echo "查询结果错误".PHP_EOL;
    echo "查询内容：".$searchData.PHP_EOL;
    echo "查询结果：".$result.PHP_EOL;
}else{
    echo "查询结果正确".PHP_EOL;
    echo "查询内容：".$searchData.PHP_EOL;
    echo "查询结果：".$result.PHP_EOL;
}

