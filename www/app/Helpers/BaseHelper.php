<?php

function genCustomId($length){
    $complete_array = "";
    $feedback_id = openssl_random_pseudo_bytes($length);
    $feedback_id = bin2hex($feedback_id);
    $tempId = str_split($feedback_id);
    foreach ($tempId as $symbol){
        $i = random_int(1,2);
        if($i === 1) $symbol=strtoupper($symbol);
        $complete_array = $complete_array.$symbol;
    }
    return $complete_array;
}

function epochToDate($epoch_time){
    return date('Y-m-d H:i', $epoch_time);
}

function getIp() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) $ret = $_SERVER['HTTP_CLIENT_IP'];
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) $ret = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else $ret = $_SERVER['REMOTE_ADDR'];
    $exp = explode(',', $ret);
    return $exp['0'];
}

function getRealIp(){
    return file_get_contents('http://icanhazip.com/');
}
