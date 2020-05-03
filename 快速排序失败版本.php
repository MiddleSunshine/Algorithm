<?php

require_once __DIR__."/function.php";

$record=[];

function quickSort($data,$baseLine,$count=1,$record=[]){
    if($count>100){
        debugEnd($record);
        return [];
    }
    $count++;
    // 基线条件，数组元素 <=1
    if(count($data)<=1){
        return $data;
    }
    // 遍历数组，将数组分为两份
    $smallerData=[];
    $biggerData=[];
    foreach ($data as $key=>$value){
        if($value>$baseLine){
            $biggerData[]=$value;
        }else{
            $smallerData[]=$value;
        }
    }
    debugStart($record,
        array_merge(
            array_merge(
                $smallerData,
                ["分界值：".$baseLine."/"]
            ),
            array_merge(
                $biggerData,
                ["循环次数：".$count.PHP_EOL]
            )
        )
    );
    return
        array_merge(
            quickSort($biggerData,getMiddleItem($biggerData),$count,$record),
            quickSort($smallerData,getMiddleItem($smallerData),$count,$record)
        );
}

/**
 * 这段代码错误的原因就在于这里，具体情况可以见 debug.txt 中的结果，总的来说，是因为陷入了死循环
 * @param $array
 * @return mixed
 */
function getMiddleItem($array){
    return $array[
        ceil(
            count($array)/2
        )
    ];
}

// 获取一个随机数组
$data=range(1,10);
randArray($data);

// 开始排序
$result=quickSort($data,getMiddleItem($data));

// 输出结果
print_r($result);

