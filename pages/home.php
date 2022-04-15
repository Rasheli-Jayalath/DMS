<div class="container" style="margin-top: 20px; margin-bottom: 50px;">
        <div class="row">
        <?php $sql_cms="Select * from rs_tbl_cms where cms_cd=1";
			$cms_data=$objDb->dbCon->query($sql_cms);
			$sql_cms_r=$cms_data->fetch();
			 ?>
            <div class="col-md">
                <p class="medium" style="font-size: large;"><?php echo $sql_cms_r['title'];?></p>
            </div>

        </div>

        <div class="row">
            <div class="col-md">
                <p class="regular" style="font-size:small;">
                    Welcome to the Document Management System (DMS) </p>
            </div>

        </div>

        <div class="row" style="margin-right: 1px; margin-left: 1px;">
            <div class="col-md-7" style="background-color: aliceblue; padding: 15px;">
                <p class="regular basicfontsize" style="text-align: justify;">
                    <?php echo $sql_cms_r['details'];?></p>

               
            </div>

            <div class="col-md-5" style=" padding: 20px;">
              <img src="<?php echo CMS_URL; ?>/<?php echo $sql_cms_r['cmsfile'];?>"  width="100%" />     </div>

        </div>
<div class="row" style="float:right">
            <div class="col-md">
                <p class="regular" style="font-size:small;">
                <?php
if($objAdminUser->user_type==1)  
{
echo "<b>Number of users login:</b>";
}
else
{
echo  "<b>Number of times login:</b>";
}?>
 
<?php 
$usercd=$objAdminUser->user_cd;
if($objAdminUser->user_type==1)  
{
	$sSQL_d = "select distinct user_id as d_user_id from rs_tbl_user_log where url_capture=''";
	$user_count=$objDb->dbCon->query($sSQL_d);
			$total_num=$user_count->rowCount();
	
	?>
	<a href="users_log_detail.php" style="text-decoration:none" target="_blank"><?php echo $total_num; ?></a>
	<?php
}
else
{
	
	$sSQL_s = "select count(user_id) as no_user_ids from rs_tbl_user_log where user_id=".$usercd." and url_capture=''";
		$sSQL_q=$objDb->dbCon->query($sSQL_s);
			$sSQL_q1=$sSQL_q->fetch();
	echo $no_user_ids=$sSQL_q1['no_user_ids'];
} ?></p>
            </div>

        </div>

    </div>

  <div style="clear:both"></div>
		

<div class="container-fluid" style="margin-top: -220px; background-color: #222666; position: fixed; bottom: 0;">
        <div class="row">
            <div class="col-md">
                <p class="light basicfontsize" style="text-align: center; color:#fff; margin-top: 10px;">
                    Developed by SJ-SMEC © 2021</p>
            </div>

        </div>

    </div>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>

        <!-- Nav bar scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>