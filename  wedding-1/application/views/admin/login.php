<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
    <title>Log In</title>
    <link href="<?php echo base_url().'assets/css/logincss/'?>style.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url().'assets/jquery/'?>jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/'?>jquery.uniform.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/css/logincss/'?>login.js"></script>
    
    <!-- Place CSS bug fixes for IE 7 in this comment -->
    <!--[if IE 7]>
    <style type="text/css" media="screen">
        #login-logo { margin: 15px auto 15px auto; }
        .input-email { margin: -24px 0 0 10px;}
        .input-password { margin: -30px 0 0 14px; }
        body#login #login-box input { height: 20px; padding: 10px 4px 4px 35px; }
        body#login{ margin-top: 14%;}
    </style>
    <![endif]-->

</head>
<body id="login">

<div id="left"></div>
<div id="right"></div>
<div id="top"></div>
<div id="bottom"></div>
    <div id="login-box">
        <header id="main">
            <div id="login-logo"></div>
        </header>
        <?php $this->load->view('admin/notices') ?>
        <?php echo form_open('admin/login'); ?>
            <ul>
                <li>
                    <input type="text" name="email" value="Email Address" onblur="if (this.value == '') {this.value = 'Email Address';}"  onfocus="if (this.value == 'Email Address') {this.value = '';}" />
                    <img class="input-email" src="<?php echo base_url().'assets/css/logincss/'?>email-icon.png" alt="Email" />
                </li>
                
                <li>
                    <input type="password" name="password" value="Enter Password" onblur="if (this.value == '') {this.value = 'Enter Password';}"  onfocus="if (this.value == 'Enter Password') {this.value = '';}"  />
                    <img class="input-password" src="<?php echo base_url().'assets/css/logincss/'?>lock-icon.png" alt="Password" />
                </li>
                
                <li><center><input class="button" type="submit" name="submit" value="Login" /></center></li>
            </ul>
        <?php echo form_close(); ?>
        </div>
    <center>
        <ul id="login-footer">
            <li><a href="http://gidaff.com/">Powered by GIDAFF</a></li>
        </ul>
    </center>
</body></html>