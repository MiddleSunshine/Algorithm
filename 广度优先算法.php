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

/**
 * @param $map array
 * @param $searchPerson int
 * @return bool
 */
function getClosetFriend($map,$searchPerson){
    $searchQueue=new \SplQueue();
    $searched=[];
    enqueue($searchQueue,$map);
    // 重点是这里
    while (!$searchQueue->isEmpty()){
        $friend=$searchQueue->dequeue();
        if(!isset($searched[$friend])){
            if($friend==$searchPerson){
                print "Success:".$searchPerson;
                return true;
            }else{
                enqueue($searchQueue,$map[$friend]);
                $searched[$friend]=true;
            }
        }
    }
}

/**
 * @param SplQueue $queue
 * @param array $friends
 */
function enqueue(\SplQueue $queue,array $friends){
    foreach ($friends as $name=>$hisFriends){
        $queue->enqueue($name);
    }
}

$map=createMap(10,RAND_LEVEL_THREE,false);
getClosetFriend($map,getMapRandItem($map));