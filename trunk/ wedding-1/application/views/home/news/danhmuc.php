 <div id="content">
	  	<div id="content2"><br/>
		<div id="otron"><img src="<?php echo base_url()?>assets/front_end/css/images/otron2.png" align="left" style="padding-left:10px;padding-bottom:5px;" /></div>
			<hr /><br/>
			<p id="TieuDE">Diễn Đàn Sáng Tác Và Giao Lưu Nghệ Thuật</p>
			<hr /><br />
	  		<div id="tbl1">
			<table width="45%">
				<tr>
					<td>Mục trên trang</td>
					<td><select><option>5</option></select></td>
					<td style="padding:8px;">Tìm theo tên</td>
					<td><input type="text" /></td>
					<td><input type="button" value="  Tìm kiếm  " /></td>
				</tr>
			</table><br />
                                <?php foreach($list_news as $data):?>
				<div class= "BlockTin" >
					<p class="Even" style="font-weight:bold;">Hot trends</p>
					<h5><?php echo $data['name'] ?></h5>
					<table class="tbl2" cellpadding="0" cellspacing="0" >
						<tr><td width="10%"><img src="images/anh ambum.png" width="70px" height="60px" /></td>
							<td width=""><?php echo $data['description'] ?></td></tr>
					</table>
					<p class="xemtin" style="color:#585858">Số lượng truy cập: <font color="#3366CC"><?php echo $data['total_views'];?></font>&nbsp;&nbsp;&nbsp;Số tin: <font color="#3366CC"><?php echo count_news_of_category($data['id']);?></font>&nbsp;&nbsp;&nbsp;<a href="<?php echo site_url("tintuc/tin_tuc_theo_danh_muc")."/".$data['id']; ?>">Xem tất cả tin....</a></p>
				</div><br /><br /><!--_______End Block Tin______--> 
                                <?php endforeach; ?>
				<table id="PhanTrangNewList" cellspacing="1" cellpadding="1"  width="30%">
					<tbody>
						<tr>
							<td>
								<a id="ctl00_ContentPlaceHolder1_NewsList1_lbFirst" href="#" disabled="disabled">First Page</a>
							</td>
							<td>
								<a id="ctl00_ContentPlaceHolder1_NewsList1_lbPrevious" href="#" disabled="disabled">&lt;&lt; Previous</a>
							</td>
							<td>
								<table id="ctl00_ContentPlaceHolder1_NewsList1_dlPaging" cellspacing="1" border="0" style="border-collapse:collapse;">
									<tbody>
										<tr>
											<td>
												<a id="ctl00_ContentPlaceHolder1_NewsList1_dlPaging_ctl00_lbPaging" href="#" style="font-weight:bold;" disabled="disabled">1</a>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
							<td>
								<a id="ctl00_ContentPlaceHolder1_NewsList1_lbNext" href="#" disabled="disabled">Next &gt;&gt;</a>
							</td>
							<td>
								<a id="ctl00_ContentPlaceHolder1_NewsList1_LbLast" href="#" disabled="disabled">Last Page</a>
							</td>
						</tr>
					</tbody>
				</table>
				<hr /><br />				
			</div><!---------End tbl1---------------------> 	
  	</div> <!---------End content 2---------------------> 	
  </div> <!---------End content--------------------->

<!---------------------- End Slide_Image------------------------------->