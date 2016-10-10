<?php
    $lastupdate = DB::table('allgamelog')
    ->select(DB::raw('DATE_FORMAT(DATE_SUB(updatetime,INTERVAL 1 DAY),"%a - %b %d, %Y") AS updatetime2'))
    ->orderBy('updatetime','desc')
    ->first();
    echo '<div> Last updated: ' .$lastupdate->updatetime2. '</div>';
?>
