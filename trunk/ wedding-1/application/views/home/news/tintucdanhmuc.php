 <div id="content" >
	<div id="content2_tin2">
	<br/>	<div id="otron"><img src="images/otron2.png" align="left" style="padding-left:10px;padding-bottom:5px;" /></div>
			<hr /><br/>
			<p id="TieuDE_tin2">MEMORY OF GHESTA</p>
			<hr /><br />
                        <?php foreach($list_news as $data):?>
	  		<div class="tbl1_tin2" onclick='window.location = "<?php echo site_url('tintuc/noi_dung_tin_tuc/').'/'.$data['id']?>"'>
				<table id="tbl2_tin2" cellpadding="0" cellspacing="0" >
						<tr><td width="10%" rowspan="2"><img src="images/anh ambum.png" style="vertical-align:top" width="70px" height="65px" /></td>
							<td width=""><a href="#"><?php echo $data['description'];?></a></td>
						</tr>
						<tr>
							<td></td><td></td>
						</tr>
						<tr>
							<td></td>
							<td style="text-align:right;padding-right:10px;color:#666666">
								<font size="-1">12:00 | 14/11/2011</font>&nbsp;&nbsp;So luong truy cap : <font color="#3366CC">20</font>&nbsp;So luong binh luan :  <font color="#3366CC">20</font>

							</td>
						</tr>
					</table>				
			</div>
                        <?php endforeach;?>
			
			<br />
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
			<!---------End tbl1---------------------> <br />	
  	</div> <!---------End content 2---------------------> 	
  </div> <!---------End content--------------------->

<!---------------------- End Slide_Image------------------------------->