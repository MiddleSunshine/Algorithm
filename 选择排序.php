<?php

require_once __DIR__."/function.php";

$data=range(1,100);
// 把数组弄混乱
randArray($data);

print "数组开始前的值".PHP_EOL;
print_r($data);

const RAISE_UP=1;
const RAISE_DOWN=0;

// 下面开始选择排序
function sortArray($data,$raiseUp=RAISE_UP){
    $dataLength=count($data);
    for ($outsideIndex=0;$outsideIndex<$dataLength;$outsideIndex++){
        for ($insideIndex=$outsideIndex+1;$insideIndex<$dataLength;$insideIndex++){
            if(
                ($raiseUp==RAISE_UP && $data[$insideIndex]<$data[$outsideIndex])
                ||
                ($raiseUp==RAISE_DOWN && $data[$insideIndex]>$data[$outsideIndex])
            ){
                changeArrayData($data,$outsideIndex,$insideIndex);
            }
        }
    }
    return $data;
}

$data=sortArray($data,RAISE_DOWN);

print "数组排序后的值：".PHP_EOL;
print_r($data);