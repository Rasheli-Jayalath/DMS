 <link href="css/table-styling.css" rel="stylesheet">
<?php
if($_GET['mode'] == 'Delete')
{
	$member_cd = $_GET['member_cd'];
	
	$objAdminUser->setProperty("member_cd", $member_cd);
	$objAdminUser->actStaffMember('D');
	$objCommon->setMessage('Member account deleted successfully.', 'Error');
	$activity="Staff member  deleted successfully";
	$sSQLlog_log = "INSERT INTO rs_tbl_user_log(user_id, epname, logintime, user_ip, user_pcname, url_capture) VALUES ('$uid', '$nameuser', '$nowdt', '$ipadd', '$hostname','$activity')";
	mysql_query($sSQLlog_log);		
	redirect('./?p=staff_dir');
	
}


if(!empty($_GET['search_by'])){
	$search_by = urldecode($_GET['search_by']);
	$search_value = urldecode($_GET['search_value']);
	if($search_by=="firstname")
	{
	$objAdminUser->setProperty("first_name", strtolower($search_value));
	}
	if($search_by=="lastname")
	{
	$objAdminUser->setProperty("last_name", strtolower($search_value));
	}
	if($search_by=="position")
	{
	$objAdminUser->setProperty("position", strtolower($search_value));
	}
	if($search_by=="cellno")
	{
	$objAdminUser->setProperty("cell_no", strtolower($search_value));
	}if($search_by=="landline")
	{
	$objAdminUser->setProperty("landline", strtolower($search_value));
	}
	if($search_by=="email")
	{
	$objAdminUser->setProperty("email", strtolower($search_value));
	}
	if($search_by=="address")
	{
	$objAdminUser->setProperty("address", strtolower($search_value));
	}
}
if(!empty($_GET['search_value'])){
	$search_value = urldecode($_GET['search_value']);
	$objAdminUser->setProperty("search_value", strtolower($search_value));
}
?>
<script type="text/javascript">
function doFilter(frm){
	var qString = '';
	if(frm.search_value.value=='')
	{
	alert("Please enter search value");
	}
	else
	{
	if(frm.search_by.value == "firstname"){
		qString += '&search_by=firstname&search_value=' + escape(frm.search_value.value);
	}
	if(frm.search_by.value == "lastname"){
		qString += '&search_by=lastname&search_value=' + escape(frm.search_value.value);
	}
	if(frm.search_by.value == "position"){
		qString += '&search_by=position&search_value=' + escape(frm.search_value.value);
	}
	if(frm.search_by.value == "cellno"){
		qString += '&search_by=cellno&search_value=' + escape(frm.search_value.value);
	}
	if(frm.search_by.value == "landline"){
		qString += '&search_by=landline&search_value=' + escape(frm.search_value.value);
	}
	if(frm.search_by.value == "email"){
		qString += '&search_by=email&search_value=' + escape(frm.search_value.value);
	}
	if(frm.search_by.value == "address"){
		qString += '&search_by=address&search_value=' + escape(frm.search_value.value);
	}
	document.location = '?p=staff_dir' + qString;
	}
}
</script>
<form class="form-inline">


        <h4 class="semibold"  style="text-align: center; margin: auto; margin-bottom: 20px; margin-top: 25PX;">Staff Directory Management</h4>
             
        <?php if($objAdminUser->user_type==1){?>
        <div class="container" style="text-align: right;">

            <a href="add_newstaffmem.html" class="btn btn-warning commontextsize">
                <i class="bi bi-person-plus-fill" style="margin-right: 10px;"></i>Add New Staff Member
            </a>
        </div>
<?php
			}
			?>
    <div class="container" style="margin-top: 20px; margin-bottom: 50px;  border-radius: 15px; border: 2px solid #dfdfdf;padding: 20px; ">
        <div class="row">

            
                    <div class="col-md-3 regular" style="text-align: right; margin: auto; font-size: small;">
                      <label  class="sr-only">Search By</label>
                      </div>

                    <div class=" col-md-3 regular" style="text-align: center; margin: auto; margin-top: 10px;">
                       <select name="search_by"  class="form-select" style="font-size: small;">
			<option value="firstname" >First Name</option>
			 <option value="lastname" >Last Name</option>
			<option value="position" >Position</option>
			<option value="cellno" >Cell No.</option>
			<option value="landline" >Landline</option>
			 <option value="email">Email</option>
			 <option value="address">Address</option>
			</select>
           
                    </div>

                    <div class=" col-md-3 regular" style="text-align: center; margin: auto; margin-top: 10px;">
                        <input type="text" size="40" name="search_value" id="search_value" value=""  style="font-size: small;" class="form-control"  placeholder="Enter">
                      </div>

                    <div class=" col-md-3 regular" style="text-align: left;  margin-top: 8px;">
                    <input type="button" onClick="doFilter(this.form);" class="btn btn-primary mb-2 commontextsize" name="Submit" id="Submit" value=" GO " />
                        <!--<button type="submit" class="btn btn-primary mb-2 commontextsize"><i class="bi bi-search" style="margin-right: 10px;"></i>Search</button>-->
                      </div>

        </div>

    </div>

    <div class="container" style="margin-top: 20px; margin-bottom: 50px;">
            

        <div class="table-responsive">
            <table id="customers" class="table" style="font-size: small;">
                <thead>

                    <tr class="">
                
                    <th scope="col" class="semibold">Name</th>
                    <th scope="col" class="semibold">Position</th>
                    <th scope="col" class="semibold">Cell No</th>
                    <th scope="col" class="semibold">Landline</th>
                    <th scope="col" class="semibold">Email</th>
                    <th scope="col" class="semibold">Address</th>
                    <th scope="col" class="semibold">Action</th>
                    </tr>

                </thead>

            <tbody>

                <tr class="">                 
                    <td>Sample Name</td>
                    <td>Sample Position</td>
                    <td>Sample Cell No</td>
                    <td>Sample Landline</td>
                    <td>Sample Email</td> 
                    <td>Sample Address</td> 
                    <td>Sample Action</td> 
                </tr>



               

            </tbody>
            </table>
        </div>
        </div>

</form>
<?php /*?><div id="wrapperPRight">
		<div id="pageContentName"><?php echo "Staff Directory Management";?></div>
		<div id="pageContentRight">
		<?php if($objAdminUser->user_type==1){?>
			<div class="menu1">
				<ul>
				<li><a href="./?p=update_staff_detail" class="lnkButton"><?php echo "Add New Staff Member";?>
					</a></li>
					</ul>
				<br style="clear:left"/>
			</div>
			<?php
			}
			?>
		</div>
		<div class="clear"></div>
			<form name="frmCustomer" id="frmCustomer">
<div id="divfilteration">
    <div class="holder">
        
        <div>
        	<label>Search By</label>
			<select name="search_by" >
			<option value="firstname" >First Name</option>
			 <option value="lastname" >Last Name</option>
			<option value="position" >Position</option>
			<option value="cellno" >Cell No.</option>
			<option value="landline" >Landline</option>
			 <option value="email">Email</option>
			 <option value="address">Address</option>
			</select>
			<input type="text" size="40" name="search_value" id="search_value" value="" />
        </div>
    </div>
    <div class="holder">
       
        <div><input type="button" onClick="doFilter(this.form);" class="rr_buttonsearch" name="Submit" id="Submit" value=" GO " /></div>
    </div>
</div>
</form>
		<?php echo $objCommon->displayMessage();?>
        
		<form name="prd_frm" id="prd_frm" method="post" action="">	
		<?php if(isset($_REQUEST['search_by']) && isset($_REQUEST['search_value']))
		{
		?>
		<p style="margin-left:10px;"><b>Search Results of:</b> <?php echo $_REQUEST['search_value']; ?></p>
		<?php
		}?>
		<table id="tblList" width="100%" border="0" cellspacing="1" cellpadding="5" style="padding:3px; margin:3px">
        <tr>
		<th style="text-align:center"><?php echo "Name";?></th>
		<th style="text-align:center"><?php echo "Position";?></th>
        <th style="text-align:center"><?php echo "Cell No.";?></th>
		<th style="text-align:center"><?php echo "Landline";?></th>
        <th style="text-align:center"><?php echo "Email";?></th>
		<th style="text-align:center"><?php echo "Address";?></th>
		<th colspan="3">Action</th>
		</tr>
		<?php
	//$objAdminUser->setProperty("ORDER BY", "a.first_name");
	$objAdminUser->setProperty("limit", PERPAGE);
	$objAdminUser->setProperty("GROUP BY", "b.member_cd");
	$objAdminUser->lstStaffMember();
	$Sql = $objAdminUser->getSQL();
	if($objAdminUser->totalRecords() >= 1){
		$sno = 1;
		while($rows = $objAdminUser->dbFetchArray(1)){
			$bgcolor = ($bgcolor == "#FFFFFF") ? "#f1f0f0" : "#FFFFFF";
			?>
			<!-- Start Your Php Code her For Display Record's -->
			<tr style="background-color:<?php echo $bgcolor;?>">
				<td><?php echo $rows['fullname'];?></td>
                <td><?php echo $rows['position'];?></td>
				<td><?php echo $rows['cell_no'];?></td>
				<td><?php echo $rows['landline'];?></td>
				<td><?php echo $rows['email'];?></td>
				<td><?php echo $rows['address'];?></td>
				
				<td align="center">
				<?php if($objAdminUser->user_type==1){?>
				<a href="./?p=update_staff_detail&member_cd=<?php echo $rows['member_cd'];?>" title="Edit"><img src="images/iconedit.png" border="0" /></a><?php	} ?></td>
				
				<td align="center">
				<?php if($objAdminUser->user_type==1){?>
				<a class="lnk" href="./?p=staff_dir&amp;mode=Delete&amp;member_cd=<?php echo $rows['member_cd'];?>" onclick="return doConfirm('Are you sure you want to Delete Permanently this member ?');" title="Delete Member"><img src="<?php echo IMAGES_URL;?>icondelete.png" border="0" /></a>
				<?php	} ?>
				</td>
				</tr>
			<?php
			
		}
    }
	else{
	?>
	<tr>
	<td colspan="9">
  <div align="center" style="padding:5px 5px 5px 5px"> <?php echo "No Staff Member Found";?></div>
   </td></tr>
    <?php
	}
	?>
	<tr>
	<td colspan="9" style="padding:0">		
	<div id="tblFooter">
			<?php
if($objAdminUser->totalRecords() >= 1){
	$objPaginate = new Paginate($Sql, PERPAGE, OFFSET, "./?p=user_mgmt");
	?>
	
	<div style="float:left;width:170px;font-weight:bold"><?php $objPaginate->recordMessage();?></div>
	<div id="paging" style="float:right;text-align:right; padding-right:5px;  font-weight:bold">
	    <?php $objPaginate->showpages();?>
	</div>
<?php }?>
			</div>
	</td></tr>
		 </table>
	  </form>
	</div><?php */?>
	
    <!-- Footer -->

    <div class="container-fluid" style="margin-top: -250px; background-color: #222666; position: fixed; bottom: 0;">
        <div class="row">
            <div class="col-md">
                <p class="light basicfontsize" style="text-align: center; color:#fff; margin-top: 10px;">
                    Developed by SJ-SMEC © 2021</p>
            </div>

        </div>

    </div>