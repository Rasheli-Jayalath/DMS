 <div class="container" style="margin-top: 30px; margin-bottom: 30px;">

        <div class="row">
            <div class=" col-md-3" style="text-align: center; margin: auto;">
                <a class="navbar-brand" href="#"><img src="img/smec-logo.png" height="70px" alt="smec logo"></a>
            </div>
            <div class=" col-md-6" style="text-align: center;margin: auto;">
                <h3 class="semibold" style="color: #222666;">DOCUMENT MANAGEMENT SYSTEM</h3>
                <h6  style="color: #222666;"><?php echo HOME_MAIN_TITLE?></h6>
            </div>
            <div class="col-md-3" style="text-align: center; margin: auto;">
                <a style="font-size:small;"  href="./?p=my_profile" ><?php
echo  WELCOME." ".$objAdminUser->fullname_name."</b> ";?>
 
<?php 
/*echo   " [" ;
			if($objAdminUser->user_type==1)  
			echo "SuperAdmin";
			elseif($objAdminUser->user_type==2&&$objAdminUser->member_cd==0)
			echo "SubAdmin";
			else
			echo "User";
			echo "]";*/

	?> </a>
                <p style="font-size:small;"><?php $sSQL_u = "select max(uploading_file_date) as last_updated from rs_tbl_documents";
$objDb		= new Database;
$max_date=$objDb->dbCon->query($sSQL_u);
$sSQL_r1=$max_date->fetch();
	?>Last Updated on:<?php echo $sSQL_r1['last_updated'];?></p>
            </div>
        </div>
    </div>

