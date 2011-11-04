<div class="grid_12" id="content">
<div class="grid_8 alpha">
    <div class="col_left">
        
        <div class="box" id="box_galerie">
            <h2>Photo</h2>
        </div>
        <div id="view_photo">
            <h3></h3>
            <div class="image_view">
                <img src="<?php echo base_url().'assets/media/images/'. $default_photo->file_path;?>" />
                <div class="image_shadown"></div>
            </div>
            <div class="box_nav">
            <div class="list_nav" >
                <ul id="mycarousel" class="jcarousel-skin-tango">
                    <?php foreach($current_photo_album as $photos) : 
                        $filepath = base_url() . 'assets/media/images/' . $photos['file_path'];
                    
                    ?>
                    <li>   
                        
                        <a href="<?php echo $filepath ?>"><img src="<?php echo base_url() . 'assets/media/images/thumbs/' . $photos['file_path']; ?>"/></a>
                    </li>
                    <?php endforeach; ?>                       
                </ul>
                </div>
                
                <div class="clear"></div>
            </div>
        </div>
    
        <div class="space"></div>
        
        <!-- box club -->
        <div class="box" id="box_album">
            <ul>
                <?php 
                $i = 0; 
                foreach($list_other_album as $other_albums):
                    
                    $thumbnail = $this->Media_m->defaul_photo_of_album($other_albums['id']);
                    $thumbnail_path = base_url().'assets/media/images/'. $thumbnail->file_path;
                     
                     $i = $i+1;
                     if($i%4 == 0) echo "<li class='last'>";
                     else echo "<li>"                      
                    
                ?>
                    
                    <div class="album_mid">
                        <div class="album_top">
                            <div class="album_bottom">
                                <a href="<?php echo site_url('gallerie/albums').'/'.$other_albums['id'];?>"><img src="<?php echo $thumbnail_path;?>" width="112" height="112" /></a>
                            </div>
                        </div>
                    </div>
                    <p><a href="<?php echo site_url('gallerie/albums').'/'.$other_albums['id'];?>"><?php echo character_limiter($other_albums['title'], 4);?></a></p>
                </li>
                 <?php if($i%4 == 0):?>                            
                            <div class="clear"></div>  
                 <?php endif;?>
                <?php endforeach;?>
                
            </ul>
             <div class="clear"></div>
             <div class="pag_nav">
                            <?php echo $pagination;?>
                        </div>
        </div>
        <!-- /end box club -->
    </div>
</div>