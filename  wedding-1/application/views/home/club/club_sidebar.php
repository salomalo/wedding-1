<div class="grid_4 omega">
                            <div class="col_right">
                                <!-- box club category -->
                                <div class="box right_list_category" id="club_category">
                                    <h2>Club</h2>
                                    <ul>
                                        <?php foreach ($cat_list as $cats):?>
                                        <li><a href="<?php echo site_url('club/club_by_category')."/".$cats['id'];?> "><?php echo $cats['title'];?></a></li>
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