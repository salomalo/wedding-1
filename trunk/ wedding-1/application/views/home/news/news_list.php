<div class="grid_12" id="content">
                        <div class="grid_8 alpha">
                            <div class="col_left">
                                <!-- box club -->
                                <div class="box" id="box_list_new">
                                    <h2>News</h2>
                                    <ul>
                                        <?php foreach($list_news as $news) :
                                        
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
                                            <div class="new_left">
                                                <a href="<?php echo site_url('news/news_content').'/'.$news['id'];?>"><img src="<?php echo $image_path; ?>" width="172" height="111" /></a>
                                            </div>
                                            <div class="new_right">
                                                <small><?php echo date('d-m-y', $news['posted']);?></small>
                                                <h3><a href="<?php echo site_url('news/news_content').'/'.$news['id'];?>"><?php echo $news['title'];?></a></h3>
                                                <p><?php echo get_short_description($news['description'], 20).'...'; ?></p>
                                                <p><a href="<?php echo site_url('news/news_content').'/'.$news['id'];?>" class="read_more">[read more]</a></p>
                                            </div>
                                            <div class="clear"></div>
                                        </li>
                                        <?php endforeach;?>
                                        
                                    </ul>
                                    
                                    <div class="pag_nav">
                                       <?php echo $pagination;?>
                                    </div>
                                </div>
                                <!-- /end box club -->
                            </div>
                        </div>