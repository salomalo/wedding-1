 <?php
 $image_path = 'assets/photo_news/' . $club_content->img;
 if ($club_content->img != '') {
        if (file_exists($image_path)) {
            $image_path = base_url() . 'assets/photo_club/' . $club_content->img;
        } else {
            $image_path = base_url() . 'assets/photo_club/nophoto/no_photo.jpg';
        }
    }  else {
        $image_path = base_url() . 'assets/photo_club/nophoto/no_photo.jpg';
    }
 ?> 
<div class="grid_12" id="content">
                        <div class="grid_8 alpha">
                            <div class="col_left">
                                <!-- box club -->
                                <div class="box" id="box_presentation">
                                    <h2>Presentation</h2>
                                    <div class="presentation_image">

                                    </div>
                                    <div class="presentation_title">
                                        <h4> <?php echo $club_content->title; ?> </h4>
                                    </div>
                                    <div class="presenlation_content">
                                        <?php echo $club_content->content; ?> 
                                       
                                    </div>
                                </div>
                                <!-- /end box club -->
                            </div>
                        </div>