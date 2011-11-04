                                           
<div class="grid_12" id="content">
        <div class="grid_8 alpha">
            <div class="col_left">
                <!-- box club -->
                <div class="box" id="box_video_album">
                    <h2>Galerie</h2>
                    <ul>
                    <?php 
                    $i = 0;    
                     foreach($video_albums as $valbums): 
                        $video_id = $this->Media_m->get_newest_video_in_album($valbums['id']); 
                        $video_thumbnail = get_youtube_thumb($video_id->file_path, "small", 112, 112);  
                    
                    $i = $i+1;
                    if($i%4 == 0) echo "<li class='last'>";
                    else echo "<li>"                      
                    ?> 
                        
                          
                            <div class="album_mid">
                                <div class="album_top">
                                    <div class="album_bottom">
                                        <a href="<?php echo site_url('gallerie/album_video/').'/'.$valbums['id'];?>"><?php echo $video_thumbnail; ?></a> 
                                    </div>
                                </div>
                            </div>
                             <p><a href="<?php echo site_url('gallerie/album_video/').'/'.$valbums['id'];?>"><?php echo character_limiter($valbums['title'], 10) ?></a></p> 
                        </li>
                        <?php if($i%4 == 0):?>                            
                            <div class="clear"></div>  
                        <?php endif;?>
                        
                    <?php endforeach; ?>
                      <div class="clear"></div>  
                    </ul>
                        <div class="pag_nav">
                            <?php echo $pagination;?>
                        </div>
                        
                 
                </div>
                
                <!-- /end box club -->
                
            </div>

        </div>                                           
