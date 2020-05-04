<?php

require_once __DIR__."/function.php";

function checkExit($map,$searchContent):bool {
    $checkList=[];
    foreach ($map as $number=>$nextMap){
        if(isset($checkList[$number])){
            continue;
        }
    }
}