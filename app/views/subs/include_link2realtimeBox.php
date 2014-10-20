<div style="float:left;padding:0 0 10px 10px;height:35px">
    <a  href="<?=asset('realtimeBox')?>" class="link-realtimeBox" title='Real-Time Efficiency Rank Box'>
        <?
            $hotcold_data = Player::gethotcoldPlayer()->getData();
            $livevalue = $hotcold_data->livemark;
            if (count($livevalue)==0){ //RTB清空時($livevalue不是NULL，所以只好用count)
                echo '<div class="newsbox-icon" style="background-image:url('.asset('images/fig_3_realtimeBox2.png').')"></div>';
            }else{
               if (count($livevalue)==1 & $livevalue[0]->livemark=='Final'){
                    echo '<div class="newsbox-icon" style="background-image:url('.asset('images/fig_3_realtimeBox2.png').')"></div>';
                }else{
                    echo '<div class="newsbox-icon" style="background-image:url('.asset('images/fig_3_realtimeBox3.png').');box-shadow:0 0 50px rgba(255,0,0,0.9);padding:0px"></div>';
                }
            }
        ?>
    </a>
</div>