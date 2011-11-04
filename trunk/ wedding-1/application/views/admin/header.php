<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Bollywood-In</title>
        <meta name="description" content="avec Sport et Business, vous développez votre réseau professionnel et rencontrez de nouveaux partenaires pour pratiquer votre sport préféré. " />

        <link href="<?php echo base_url() ?>assets/admin/styles.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url() ?>assets/js/jquery-1.4.3.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?php echo base_url() ?>assets/js/header.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.MultiFile.min.js" type="text/javascript" charset="utf-8"></script>
    </head>
    <body >
        <div id="background_confirmer"></div>
        <div id="confirmer" align="center">
            <span>Bạn có muốn xóa không ?</span>
            <table width="100%">
                <tr>
                    <td align="center"><a id="oui" href="#">Có</a></td>
                    <td align="center"><a id="non" href="#">Không</a></td>
                </tr>
            </table>
        </div>
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td width="270px" id="wrapper_menu_left" valign="top">
                    <div id="menu_left">
                        <div id="profil" align="center">
                            <div id="logo"><img src="<?php echo base_url() ?>assets/admin/images/logo.png"/></div>
                            <!--END logo-->
                            <div id="compte">
                                <a href="<?php echo site_url('admin/edit_profile/'.$this->session->userdata('user_id')) ?>">Profile </a> | <a href="<?php echo site_url('admin/change_pass/'.$this->session->userdata('user_id')) ?>">Đổi mật khẩu</a> | <a href="<?php echo site_url('admin/logout') ?>"> Logout </a>
                            </div>
                            <!--END compte-->

                        </div>
                        <!--END profil-->
                        <div id="list_menu" align="right">
                            <ul>
                                <li class="nav_link_non_sub"><a href="<?php echo site_url('admin/list_admin') ?>">Quản lý người dùng</a></li>
                                <li class="nav_link_non_sub"><a href="<?php echo site_url('admin_news') ?>"> Tin tức</a></li>
                                <li class="nav_link_non_sub"><a href="<?php echo site_url('admin_media') ?>"> Hình ảnh</a></li>
                                <li class="nav_link_non_sub"><a href="<?php echo site_url('admin_contact') ?>"> Liên hệ</a></li>
                      
                            </ul>
                        </div>
                        <!--END list_menu-->
                    </div>
                    <!--END menu_left-->
                </td>
                <td valign="top" align="left">
                    <div id="wrapper_content">