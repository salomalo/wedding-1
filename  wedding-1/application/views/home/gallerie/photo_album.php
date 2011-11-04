<?php $image_path = base_url() . 'assets/photo_news/nophoto/no_photo.jpg';  ?>                                              
<div class="grid_12" id="content">
        <div class="grid_8 alpha">
            <div class="col_left">
                <!-- box club -->
                <div class="box" id="box_galerie">
                    <h2>Galerie</h2>
                    <ul>
                    <?php 
                    $i = 0;    
                    foreach($list_photo_album as $album) : 
                    
                    $thumbnail = $this->Media_m->defaul_photo_of_album($album['id']);
                    $thumbnail_path = base_url().'assets/media/images/'. $thumbnail->file_path;
                    
                    $i = $i+1;
                    if($i%4 == 0) echo "<li class='last'>";
                    else echo "<li>"                      
                    ?> 
                        
                          
                            <div class="album_mid">
                                <div class="album_top">
                                    <div class="album_bottom">
                                        <a href=" <?php echo site_url('gallerie/albums/').'/'.$album['id']?> "><img src="<?php echo $thumbnail_path;?>" width="112" height="112" /></a>
                                    </div>
                                </div>
                            </div>
                            <p><a href=" <?php echo site_url('gallerie/albums/').'/'.$album['id']?> "><?php echo character_limiter($album['title'], 4);?></a></p>
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