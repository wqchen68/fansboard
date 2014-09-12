<div class="insidemove" style="color:#fff">

	<div class="onepcssgrid-1p-1200">		
		
		<div class="onerow">

			<div class="col-1p12 last">
                
                <div style="float:left;padding:0 0 10px 0">
                   
                    <?=Form::select('', array(
                    'page1' => 'Rank 1 - 25',
                    'page2' => 'Rank 26 - 50',
                    'page3' => 'Rank 51 - 75',
                    'page4' => 'Rank 76 - 100',
                    'page5' => 'Rank 101 - 125',
                    'page6' => 'Rank 126 - 150',
                    ), Input::get('page', 'page1'), array('class' => 'selectForm player_season', 'style' => 'color:#000;box-shadow:0 0 20px rgba(255,0,0,0.9)'))?>                    
                    
                </div>
            </div>    
            


                    

                        
                        
                        
    @for ($i = 0; $i < 25; $i++)
        <div class="col-1p12 last" style="margin:1px; background-color: rgba(0,0,0,0.4)">
                        
                        <div class="col-1p6">
                                                <div style="float:left;margin: 10px;width:30px">
                                                    {{ $i+1 }}
                                                </div>
                                                <div class="playercardbig highlight" style="float:left;box-shadow:0 0 20px rgba(255,255,255,0.9); margin: 5px 0 0 5px">

                                                    <div style="width:25%;float:left">
                                                        <div style="background-color:rgba(0,0,0,0.8);width:60px">
                                                            <div style="height:20px">
                                                                <img style="width:16px;line-height:16px;float:left" src="/images/medal_gold_1.png" />
                                                                <div class="rank1" style="font-size:12px;margin:0 0 0 5px;line-height:20px;float:left;text-align:center"></div>
                                                            </div>
                                                            <div class="face player0" style="width:60px;height:72px;background:url(/images/help1.png) no-repeat center"></div>																		
                                                            <div style="height:0;clear:both"></div>
                                                        </div>
                                                        <div class="basic00" style="font-size:12px;text-align:left;margin:0px 0 0 0"></div>
                                                        <div class="basic01" style="font-size:12px;text-align:left;margin:0px 0 0 0"></div>
                                                        <div class="basic02" style="font-size:12px;text-align:left;margin:0px 0 0 0;font-weight:bold;color:red"></div>								
                                                    </div>
                                                    <div style="height:0;clear:both"></div>
                                                </div>
                            <div style="height:0;clear:both"></div>
                        </div>
            
                        <div class="col-1p3 modelCol">
                            <div class="modelBox" mid="3"></div>
                        </div>

                        <div class="col-1p3 last">
                            <!--gamelog-->
                            <div style="background-color: #fff;margin: 5px;width: 100px;height: 100px "></div>
                        </div>
            
                        <div class="col-1p3 last">
                            <!--gamelog-->
                            <div style="background-color: #fff;margin: 5px;width: 100px;height: 100px "></div>
                        </div>
                        
        </div>
     @endfor                        
                        
                        
                        


          
                   
                    

            <div style="height:0;clear:both"></div>
		</div>		
	</div>
</div>

<style>
</style>


<span class="javascript" src="/js/hightchart.orankList.js"></span>

<script src="/js/hightchart.creatRadarChart.js"></script>











