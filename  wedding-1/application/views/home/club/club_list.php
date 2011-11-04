<div class="grid_12" id="content">
                        <div class="grid_8 alpha">
                            <div class="col_left">
                                <!-- box club -->
                                <div class="box" id="box_club">
                                    <h2>Club</h2>
                                    <div class="box_content">
                                        <ul>
                                         <?php foreach($club_list as $club) :
                                        
                                         $image_path = 'assets/photo_news/' . $club['img'];
                                                   if ($club['img'] != '') {
                                                        if (file_exists($image_path)) {
                                                            $image_path = base_url() . 'assets/photo_club/' . $club['img'];
                                                        } else {
                                                            $image_path = base_url() . 'assets/photo_club/nophoto/no_photo.jpg';
                                                        }
                                                    }  else {
                                                        $image_path = base_url() . 'assets/photo_club/nophoto/no_photo.jpg';
                                                    }
                                                    
                                        ?>
                                            <li>
                                                <a href=" <?php echo site_url('club/club_content')."/".$club['id'] ?> "><img src=" <?php echo $image_path; ?>" alt="SEMAINE ASIATIQUE 2010.." width="250px" height="173px"/></a>
                                                <p><a href="<?php echo site_url('club/club_content')."/".$club['id'] ?>"><?php echo $club['title'];?></a></p>
                                            </li>
                                        <?php endforeach; ?>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <!-- /end box club -->
                            </div>
                        </div>