
<div id="content">
    <div id="title_content">Contact Contenu</div>
        <form method="POST" action="<?php echo site_url('admin_content/update_content').'/'.$query['id'].'/'.$perpage.'/'.$offset;?>">
     <table class="form_content" width="100%">
            <tr>
                <td>Nom </td><td>
                   
                   <?php echo $query['last_name'] ?></td>
            </tr>
            <tr>
                <td>Prenom </td><td>
                   
                   <?php echo $query['first_name'] ?></td>
            </tr>
            <tr>
                <td>E-mail </td><td>
                   
                   <?php echo $query['email'] ?></td>
            </tr>
            <tr>
                <td>Telephone </td><td>
                   
                   <?php echo $query['telephone'] ?></td>
            </tr>
            <tr>
                <td>Posted Date </td><td>
                   
                   <?php echo mdate('%d/%m/%Y', $query['posted_time']); ?></td>
            </tr>
            <tr>
                <td>Contenu</td><td>
                 
                    <textarea name="content" cols="80" rows="8"> <?php echo $query['content']?></textarea>
                </td>
            </tr>
              <tr>
                <td></td><td>
                <input type="button" name="button" class="submit" value="Annuler et revenir" onclick="document.location.href='<?php echo site_url('admin_contact/list_customer_contact').'/'.$perpage.'/'.$offset;?>'"/>
                </td>
            </tr>
        </table>
        </form>
    </div>
<!--END content-->
