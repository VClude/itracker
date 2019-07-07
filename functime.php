<?php
function time_ago($datetime)
{
    if (is_numeric($datetime)) {
      $timestamp = $datetime;
    } else {
      $timestamp = strtotime($datetime);
    }
    $diff=time()-$timestamp;

    $min=60;
    $hour=60*60;
    $day=60*60*24;
    $month=$day*30;

    if($diff<60) //Under a min
    {
        $timeago = $diff . " seconds";
    }elseif ($diff<$hour) //Under an hour
    {
        $timeago = round($diff/$min) . " mins";
    }elseif ($diff<$day) //Under a day
    {
        $timeago = round($diff/$hour) . " hours";
    }elseif ($diff<$month) //Under a day
    {
        $timeago = round($diff/$day) . " days";
    }else 
    {
        $timeago = round($diff/$month) ." months";
    }

    return $timeago;

}
?>
