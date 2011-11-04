<div class="grid_12" id="content">
                        <div class="grid_8 alpha">
                            <div class="col_left">
                                <!-- box video -->
                                <div class="box" id="box_video">
                                    <h2>Video</h2>
                                    <div class="box_content">
                                        <div class="video">
                                            <div class="youtube">
                                            <?php 
                                                if(isset($video_play->file_path) && ($video_play->file_path !=NULL)){
                                                    echo "'". $video_play -> file_path. "'";          
                                                }else{
                                                    echo "'". $lastest_videos -> file_path. "'"; 
                                                }
                                                
                                            ?>

                                            </div>
                                            <p>MUNNI BADNAAM HUI, DHAN TE NAN & CHAAN KE MOHALLA by Bollywood-In</p>
                                        </div>
                                        
                                        <div class="container_scroll">
                                            <div class="scroll_left">
                                                <div class="scroll_right">
                                                    <div class="box_scroll">
                                                        <ul>
                                                            <?php if(isset($other_videos) && !empty($other_videos)){?>
                                                            <?php foreach($other_videos as $video):
                                                               
                                                            ?>
                                                            <li>
                                                                <a href="<?php echo site_url('home/video').'/'.$video['id'];?>"> 
                                                                <?php echo $video_thumb; ?></a>
                                                            </li>
                                                            <?php endforeach; ?>
                                                            <?php }?>
                                                            
                                                            <?php foreach($videos as $video):
                                                             $video_thumb = get_youtube_thumb($video['file_path'], "small");
                                                             
                                                            ?>
                                                            <li>
                                                                <a href="<?php echo site_url('home/video').'/'.$video['id'];?>"> 
                                                                <?php echo $video_thumb; ?></a>
                                                            </li>
                                                            <?php endforeach; ?>
                                                            
                                                                                                      
                                                        </ul>
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /end box video -->
                                
                                <!-- box album -->
                                <div class="box" id="box_album">
                                    <h2>Album</h2>
                                    <ul>
                                        <?php 
                                        $i = 0;
                                        foreach ($lastest_album as $albums): 
                                            $thumbnail = $this->Media_m->defaul_photo_of_album($albums['id']);
                                            $thumbnail_path = base_url().'assets/media/images/'. $thumbnail->file_path;
                                        $i = $i+1;
                                        if($i%4 == 0) echo "<li class='last'>";
                                        else echo "<li>"
                                            
                                        
                                        ?>
                                        

                                            
                                            <div class="album_mid">
                                                <div class="album_top">
                                                    <div class="album_bottom">
                                                        <a href="<?php echo site_url('gallerie/albums').'/'.$albums['id'] ?>"><img src="<?php echo $thumbnail_path; ?>" width="112px" height="112px" /></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <p><a href="<?php echo site_url('gallerie/albums').'/'.$albums['id']; ?>"><?php echo character_limiter($albums['title'], 10);
;?>...</a></p>
                                        </li>
                                        <?php endforeach; ?>
                                       
                                    </ul>
                                </div>
                                <!-- /end box album -->
                            </div>
                        </div>
                             <div class="grid_4 omega">
                                <div class="col_right">
                                    <!-- box new -->
                                    <div class="box" id="new">
                                        <h2>New</h2>
                                        <ul>
                                            <?php foreach ($news_home as $news) :
                                                   $image_path = 'assets/photo_news/' . $news['img'];
                                                   if ($news['img'] != '') {
                                                        if (file_exists($image_path)) {
                                                            $image_path = base_url() . 'assets/photo_news/' . $news['img'];
                                                        } else {
                                                            $image_path = base_url() . 'assets/photo_news/nophoto/no_photo.jpg';
                                                        }
                                                    }  else {
                                                        $image_path = base_url() . 'assets/photo_news/nophoto/no_photo.jpg';
                                                    }
                                            ?>
                                            
                                            <li>
                                                <a href="" class="new_left">
                                                    <img src="<?php echo $image_path ?>" alt="" width="74px" height="74px"/>
                                                </a>
                                                <div class="new_right">
                                                    <small><?php echo date('d-m-Y', $news['posted']);?></small>
                                                    <h3><a href="<?php echo site_url('news/news_content').'/'.$news['id'];?>"><?php echo $news['title'];?></a></h3>
                                                    <p><?php echo get_short_description($news['description'], 12);?>...</p>
                                                </div>
                                                <div class="clear"></div>
                                            </li>
                                            <?php endforeach;?>
                                           
                                        </ul>
                                    </div>
                                    <!-- /end box new -->
                                    
                                    <div class="box_ads">
                                        <a href=""><img src="<?php echo base_url()?>assets/front_end/images/ads/ads.jpg" alt="ads" /></a>
                                    </div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
           </div>
     </div>
                       
            
