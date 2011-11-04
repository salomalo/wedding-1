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
                                                    <h3><a href=""><?php echo $news['title'];?></a></h3>
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