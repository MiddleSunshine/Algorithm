<?php
require_once __DIR__."/快速排序.php";

const WEIGHT='weight';
const PRICE='price';
$priceMap=[
    'a'=>[WEIGHT=>35,PRICE=>3200],
    'b'=>[WEIGHT=>30,PRICE=>3000],
    'c'=>[WEIGHT=>5,PRICE=>500]
];

$packageAmount=35;
/**
 * 贪婪算法
 * @param array $priceMap
 * @param int $packageAmount
 * @return int
 */
function greedyAlgorithm(array $priceMap,int $packageAmount){
    // 先将数组按照价格排序
    $newPriceMap=sortPriceMap($priceMap);
    $returnData=0;
    // 开始执行贪婪算法
    foreach ($newPriceMap as $commodity=>$setting){
        // 如果当前物品能塞进背包，就往里塞
        if($setting[WEIGHT]<=$packageAmount){
            putPackage($priceMap,$packageAmount,$commodity,$returnData);
        }
        if($packageAmount<=0){
            break;
        }
    }
    return $returnData;
}

print greedyAlgorithm($priceMap,$packageAmount);

/**
 * 将商品加入背包
 * @param array $priceMap
 * @param int $packageAmount
 * @param string $stuff
 * @param int $priceAmount
 */
function putPackage(array &$priceMap,int &$packageAmount,string $stuff,int &$priceAmount){
    // 减少背包重量
    $packageAmount-=$priceMap[$stuff][WEIGHT];
    // 增加获得的总成本
    $priceAmount+=$priceMap[$stuff][PRICE];
    // 将已选购商品移除出价目表
    unset($priceMap[$stuff]);
}

/**
 * 将价格按照降序进行排序
 * @param array $priceMap
 * @return array
 */
function sortPriceMap(array $priceMap){
    $prices=[];
    $priceMapTemplate=[];
    foreach ($priceMap as $commodity=>$setting){
        $prices[]=$setting[PRICE];
        $priceMapTemplate[$setting[PRICE]]=$commodity;
    }
    $sortedPrice=quickSortSecondVersion($prices,getRandItem($prices));
    $returnData=[];
    foreach ($sortedPrice as $price){
        $commodity=$priceMapTemplate[$price];
        $returnData[$commodity]=[];
        $returnData[$commodity]=$priceMap[$commodity];
    }
    return $returnData;
}



