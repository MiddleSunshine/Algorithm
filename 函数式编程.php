<?php

/**
 * 下面是一般编程语言有 foreach 时的样子
 * @param $data array
 * @return float|int
 */
function hasForeach($data){
    $sum=0;
    foreach ($data as $value){
        $sum+=$value;
    }
    return $sum;
}

/**
 * 测试，当没有 foreach 时，该如何实现循环
 * @param $data
 * @return int
 */
function withoutForeach($data){
    return sumArray($data,0,0);
}

/**
 * 这里是使用了递归来实现的
 * @param $array array
 * @param $index int
 * @param int $baseAmount
 * @return int
 */
function sumArray($array,$index,$baseAmount=0){
    if(!isset($array[$index])){
        return $baseAmount;
    }
    $baseAmount+=$array[$index];
    return sumArray($array,$index+1,$baseAmount);
}

/**
 * 验证数据的准确性
 */
$testData=range(1,10);
print withoutForeach($testData).PHP_EOL;
print hasForeach($testData).PHP_EOL;