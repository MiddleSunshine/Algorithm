<?php

require_once __DIR__."/function.php";

$data=range(1,100);

function quickSort($data){
    
}

function getMiddleItem($array){
    return $array[
        ceil(
            count($array)/2
        )
    ];
}