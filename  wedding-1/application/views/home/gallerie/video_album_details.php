<div class="grid_12" id="content">
<div class="grid_8 alpha">
    <div class="col_left">
    
        <div class="box" id="box_video">
            <div class="box_header">
                <h2></h2>
            </div>    
            <div class="box_content">
                <div class="video">
                    <div class="youtube">
                        <?php 
                        if(!isset($current_video->file_path) || ($current_video->file_path == NULL)){
                            echo $newest_video->file_path;     
                        } else{
                            echo $current_video->file_path;
                        }
                        ?>                        
                    </div>
                    <p></p>
                    <div class="space"></div>

                </div>
                 <?php if(count($video) > 0 ){?>
                 
                  <?php }?> 
                <div class="video_content">
                    <ul>
                        <?php 
                        $i = 0; 
                        foreach($video as $videos): 
                        $thumbnail = get_youtube_thumb($videos['file_path'], "smaill"); 
                        $i = $i+1;
                        if($i%4 == 0) echo "<li class='last'>";
                        else echo "<li>"  
                        ?>
                        
                            <a href="<?php echo site_url('gallerie/video/').'/'.$videos['id'].'/'.$album_id;?>"><?php echo $thumbnail; ?></a>
                            <p><a href="<?php echo site_url('gallerie/video/').'/'.$videos['id'].'/'.$album_id;?>"><?php echo $videos['title'] ?></a></p>
                        </li>
                         <?php if($i%4 == 0):?>                            
                            <div class="clear"></div>  
                             <?php endif;?>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div class="clear"></div>
                <?php if(count($video) > 0 ){?>
                <div class="pag_nav">
                    <?php echo $pagination;?>
                </div>
                <?php }?>
            </div>
        </div>
    </div> 
</div>