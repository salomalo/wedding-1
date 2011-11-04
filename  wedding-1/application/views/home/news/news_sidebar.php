<div class="grid_4 omega">
                            <div class="col_right">
                                <!-- box club category -->
                                <div class="box right_list_category" id="new">
                                    <h2>Club</h2>
                                    <ul>
                                        <?php foreach($categories as $cats) :?>
                                        <li><a href="<?php echo site_url('news/news_category')."/".$cats['id'];?>"><?php echo $cats['name']?></a></li>
                                        <?php endforeach;?>
                                    </ul>
                                </div>
                                <!-- /end club category -->
                                
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