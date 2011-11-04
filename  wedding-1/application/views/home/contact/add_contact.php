
<div class="grid_12" id="content">
                        <div class="grid_8 alpha">
                            <div class="col_left">
                                <!-- box club -->
                                <div class="box" id="box_contact">
                                    <h2>Contact</h2>
                                    <div class="info">
                                        <p><strong>Adress: </strong></p>
                                        <p><strong>Phone: </strong></p>
                                        <p><strong>Fax: </strong></p>
                                        <p><strong>Website: </strong><a href="#">http://www.bollywood-in.fr</a></p>
                                    </div>
                                    
                                    <div class="form_contact">
                                       
                                        <?php if ($this->session->flashdata('error')): ?>
                                            <div class="affiche_erreur">
                                                <?php echo $this->session->flashdata('error'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <form action="<?php echo site_url('home_contact/send_contact');?>" method="post">
                                            <p>
                                                <?php if (form_error('first_name')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('first_name'), '<p>', '</p>'); ?></div> <?php } ?>
                                                <label>Prénom</label>
                                                <input type="text" name="first_name" class="input_text" value="<?php echo set_value('first_name')?>"/>
                                                <span>*</span>
                                            </p>
                                            <p>
                                                <?php if (form_error('last_name')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('last_name'), '<p>', '</p>'); ?></div> <?php } ?>
                                                <label>Nom</label>
                                                <input type="text" name="last_name" class="input_text" value="<?php echo set_value('last_name')?>"/>
                                                <span>*</span>
                                            </p>
                                            <p>
                                                <?php if (form_error('email')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('email'), '<p>', '</p>'); ?></div> <?php } ?> 
                                                <label>Email</label>
                                                <input type="text" name="email" class="input_text" value="<?php echo set_value('email');?>"/>
                                                <span>*</span>
                                            </p>
                                            <p>
                                                <?php if (form_error('telephone')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('telephone'), '<p>', '</p>'); ?></div> <?php } ?>
                                                <label>Téléphone</label>
                                                <input type="text" name="telephone" class="input_text" value="<?php echo set_value('telephone');?>"/>
                                                <span>*</span>
                                            </p>
                                           
                                            <p>
                                                <?php if (form_error('content')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('content'), '<p>', '</p>'); ?></div> <?php } ?>
                                                <label>Texte</label>
                                                <textarea name="content" class="input_textarea"><?php echo set_value('content');?></textarea>
                                                <span>*</span> 
                                            </p>
                                            <p>
                                                <label><?php echo lang('captcha') ?></label>
                                                <?php echo $captcha_img; ?>
                                            </p>
                                            <p>
                                                <?php if (form_error('captcha')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('captcha'), '<p>', '</p>'); ?></div> <?php } ?>
                                                <label>Captcha</label>
                                                <input name="captcha" class="input_text" style="width: 140px;" size="35" value="<?php echo set_value('captcha'); ?>" />
                                                <span>*</span> 
                                            </p>
                                            <p class="required">
                                                <label>&nbsp;</label>
                                                <span>*</span>Required field
                                            </p>
                                            <p>
                                                <label>&nbsp;</label>
                                                <input type="submit" name="submit" value="Envoyer" class="btn_button" style="margin-right: 5px"/>
                                                <input type="reset" name="reset" value="Effacer" class="btn_button" />
                                            </p>
                                        </form>
                                    </div>
                                </div>
                                <!-- /end box club -->
                            </div>
                        </div>
                        <div class="grid_4 omega">
                            <div class="col_right">
                                <!-- box club category -->
                                <div class="box" id="contact_right">
                                    <div class="contact_content">
                                        <p>« Si vous avez des questions, n’hésitez pas à nous contacter pour de plus amples informations! »</p> 
                                    </div>
                                    <img src="<?php echo base_url()?>assets/front_end/images/contact.jpg" alt="contact" />
                                </div>
                                <!-- /end club category -->
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
        
        
      
       