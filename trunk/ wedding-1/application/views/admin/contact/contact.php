
<div id="content">
	<div id="title_content">Contact</div>
        <p>Ajoutez les adresses emails que vous voulez recevoir les contacts !</p>
        <?php if ($this->session->flashdata('error')): ?>
<div class="affiche_erreur">
	<?php echo $this->session->flashdata('error'); ?>
</div>
<?php endif; ?>
       <form method="POST" action="<?php echo site_url('admin_contact/list_destination')?>">
 	<table class="form_content" width="100%">
             <tr>
                <td>Destination <span style="color:red">*</span></td><td>
              <?php if (form_error('destination')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('destination'), '<p>', '</p>'); ?></div> <?php } ?>
                    <textarea cols="51" rows="10" name="destination"><?php echo $query['destination'] ?></textarea>
                </td>
             </tr>
            <tr>
                <td></td><td>
                 <input type="submit" name="submit" class="submit" value="Enregistrer"/>

                 </td>
            </tr>
        </table>
        </form>
	</div>
<!--END content-->
