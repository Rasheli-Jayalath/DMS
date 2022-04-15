 <link href="css/table-styling.css" rel="stylesheet">
<?php
$objDb		= new Database;

 $user_cd	= $objAdminUser->user_cd;
$objAdminUser->setProperty("user_cd", $user_cd);
$objAdminUser->lstAdminUser();
$data = $objAdminUser->dbFetchArray(1);
 $user_type= $data['user_type'];


$report_path = REPORT_PATH;

$category_cd = $_REQUEST['category_cd'];
$subcategory_cd = $_REQUEST['subcategory_cd'];
$cid = $_REQUEST['cid'];
if(isset($_GET['mode']) && $_GET['mode'] == "delete"){
				$report_cd = $_GET['report_cd'];
				$cid_del = $_GET['cid'];
				$cat_cd_del = $_GET['cat_cd'];
				$category_cd_del = $_GET['category_cd'];
				$sql2d="Select * from rs_tbl_documents where report_id='$report_cd'";
				$res2d=$objDb->dbCon->query($sql2d);
			    $row2d=$res2d->fetch();				
				$file_report=$row2d['report_file'];
				if($file_report!=""){
									@unlink(REPORT_PATH . $file_report);
										
									}
				$objProduct->resetProperty();
				$objProduct->setProperty("report_id", $report_cd);
				$objProduct->actReport("D");
				$objCommon->setMessage("Record deleted Successfully", 'Info');
				$activity="File deleted successfully";
	$sSQLlog_log = "INSERT INTO rs_tbl_user_log(user_id, epname, logintime, user_ip, user_pcname, url_capture) VALUES ('$uid', '$nameuser', '$nowdt', '$ipadd', '$hostname','$activity')";
	mysql_query($sSQLlog_log);	
				redirect('./?p=reports&category_cd='.$category_cd_del.'&cat_cd='.$cat_cd_del.'&cid='.$cid_del);
	
	
}
if(isset($_GET['mode']) && $_GET['mode'] == "cat_delete"){
				$category_cd_c = $_GET['category_cd'];
				$cid_c = $_GET['cid'];
				$cat_cd_c = $_GET['cat_cd'];
				$category_cd_cat = $_GET['sel_category_cd'];
				 $sql2c="Select * from rs_tbl_category where parent_cd='$category_cd_cat'";
				 $res2d=$objDb->dbCon->query($sql2c);
			   	if($res2d->rowCount()>=1)
				{
				
				$objCommon->setMessage("You should delete its sub category(s) first", 'Error');
				redirect('./?p=reports&category_cd='.$category_cd_c.'&cat_cd='.$cat_cd_c.'&cid='.$cid_c);
				}
				else
				{
			   	$sql2t="Select * from rs_tbl_documents where report_category='$category_cd_cat'";
			   	$res2t=$objDb->dbCon->query($sql2t);
			   
			   
					if($res2t->rowCount()>=1)
					{
					$objCommon->setMessage("You should delete its document(s) first", 'Error');
					redirect('./?p=reports&category_cd='.$category_cd_c.'&cat_cd='.$cat_cd_c.'&cid='.$cid_c);
					}
					else
					{
					 $sdeletet= "Delete from rs_tbl_category_template where cat_id='$category_cd_cat'";
					   $objDb->dbCon->query($sdeletet);
						$objProduct->resetProperty();
						$objProduct->setProperty("category_cd", $category_cd_cat);
						$objProduct->actCategory("D");
						$objCommon->setMessage(PRD_DELETE_SUCCESS, 'Info');
						$activity="Category deleted successfully";
	$sSQLlog_log = "INSERT INTO rs_tbl_user_log(user_id, epname, logintime, user_ip, user_pcname, url_capture) VALUES ('$uid', '$nameuser', '$nowdt', '$ipadd', '$hostname','$activity')";
	 $objDb->dbCon->query($sSQLlog_log);		
						
						redirect('./?p=reports&category_cd='.$category_cd_c.'&cat_cd='.$cat_cd_c.'&cid='.$cid_c);
					}				
				
				
				}
	
	
}
if(isset($_GET['mode']) && $_GET['mode'] == "task_delete"){
				$category_cd_c = $_GET['category_cd'];
				$cid_c = $_GET['cid'];
				$cat_cd_c = $_GET['cat_cd'];
				$sel_task_id = $_GET['sel_task_id'];
				$delete_task_msg= "Delete from rs_tbl_threads where thread_no='$sel_task_id'";
				 $objDb->dbCon->query($delete_task_msg);
				
				$delete_task_attach= "Delete from rs_tbl_attachments where thread_no='$sel_task_id'";
				$objDb->dbCon->query($delete_task_attach);
								
				$delete_task= "Delete from rs_tbl_threads_titles where tt_id='$sel_task_id'";
				$objDb->dbCon->query($delete_task);
				
				$activity="Task deleted successfully";
	$sSQLlog_log = "INSERT INTO rs_tbl_user_log(user_id, epname, logintime, user_ip, user_pcname, url_capture) VALUES ('$uid', '$nameuser', '$nowdt', '$ipadd', '$hostname','$activity')";
	$objDb->dbCon->query($sSQLlog_log);
		
				redirect('./?p=reports&category_cd='.$category_cd_c.'&cat_cd='.$cat_cd_c.'&cid='.$cid_c);
	
	
}

if(isset($_GET['mode']) && $_GET['mode'] == "lock"){
				$category_cd_c = $_GET['category_cd'];
				$cid_c = $_GET['cid'];
				$cat_cd_c = $_GET['cat_cd'];
				$sel_task_id = $_GET['sel_task_id'];
				$status="0";
				 $sql_pro="UPDATE rs_tbl_threads_titles SET status='$status' where tt_id='$sel_task_id'";
				$objDb->dbCon->query($sql_pro);
				$activity="Task has been locked";
	$sSQLlog_log = "INSERT INTO rs_tbl_user_log(user_id, epname, logintime, user_ip, user_pcname, url_capture) VALUES ('$uid', '$nameuser', '$nowdt', '$ipadd', '$hostname','$activity')";	
				$objDb->dbCon->query($sSQLlog_log);
				redirect('./?p=reports&category_cd='.$category_cd_c.'&cat_cd='.$cat_cd_c.'&cid='.$cid_c);
	
	
}
if(isset($_GET['mode']) && $_GET['mode'] == "active"){
				$category_cd_c = $_GET['category_cd'];
				$cid_c = $_GET['cid'];
				$cat_cd_c = $_GET['cat_cd'];
				$sel_task_id = $_GET['sel_task_id'];
				$status="1";
				 $sql_pro="UPDATE rs_tbl_threads_titles SET status='$status' where tt_id='$sel_task_id'";
				$objDb->dbCon->query($sql_pro);
				$activity="Task has been activated";
	$sSQLlog_log = "INSERT INTO rs_tbl_user_log(user_id, epname, logintime, user_ip, user_pcname, url_capture) VALUES ('$uid', '$nameuser', '$nowdt', '$ipadd', '$hostname','$activity')";
	$objDb->dbCon->query($sSQLlog_log);
				redirect('./?p=reports&category_cd='.$category_cd_c.'&cat_cd='.$cat_cd_c.'&cid='.$cid_c);
	
	
}
///Filter
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_REQUEST["go_submit"])){
$report_sts = $_POST['report_status'];

if(isset($_GET['cat_cd']))
{
$cat_cd_new='&cat_cd='.$_GET['cat_cd'];
}
if($report_sts=='6')
{
redirect('./?p=reports&cid='.$_GET['cid'].'&category_cd='.$_GET['category_cd'].$cat_cd_new);
}
else
{
redirect('./?p=reports&cid='.$_GET['cid'].'&category_cd='.$_GET['category_cd'].$cat_cd_new.'&status='.$report_sts );
}
}
///Filter End


///Task Filter
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_REQUEST["go_submit1"])){
$task_sts = $_POST['task_status'];

if(isset($_GET['cat_cd']))
{
$cat_cd_new='&cat_cd='.$_GET['cat_cd'];
}
if($task_sts=='7')
{
redirect('./?p=reports&cid='.$_GET['cid'].'&category_cd='.$_GET['category_cd'].$cat_cd_new);
}
else
{
redirect('./?p=reports&cid='.$_GET['cid'].'&category_cd='.$_GET['category_cd'].$cat_cd_new.'&t_status='.$task_sts );
}
}
///Task Filter End


if(isset($_GET['mode']) && $_GET['mode'] == "dgfDelete"){
	$report_cd = $_GET['report_cd'];
	
	$sdelete= "Delete from rs_tbl_documents where report_id='report_cd'";
	$objDb->dbCon->query($sdelete);
	
      $sdeletet= "Delete from rs_tbl_category_template where cat_id='$category_cd'";
	  $objDb->dbCon->query($sdeletet);
	  
		$objProduct->resetProperty();
		$objProduct->setProperty("category_cd", $category_cd);
		$objProduct->actCategory("D");
		
		 $sql2c="Select * from rs_tbl_category where parent_cd='$category_cd'";
				$res2c=$objDb->dbCon->query($sql2c);
				if($res2c->rowCount()>=1)
				{
				while($row2c=$res2c->fetch())
				{
		/**/
			 $sql2d="Select * from rs_tbl_documents";
			 $res2d=$objDb->dbCon->query($sSQLlog_log);
				
				while($row2d=$res2d->fetch())
				{
				$d_subcat=$row2d['report_subcategory'];
				/*if($d_subcat=="")
				{
				$sdelete= "Delete from rs_tbl_documents where report_id='$row2d[report_id]'";
	 			  mysql_query($sdelete);

				}
				else
				{*/
				$d_sub_cat=explode("_",$d_subcat);				
				$dl=count($d_sub_cat);
				for($h=0;$h<$dl;$h++)
				{
				$report_suby=$d_sub_cat[$h];
				if($report_suby==$row2c['category_cd'])
				{
				 $sdelete= "Delete from rs_tbl_documents where report_id='$row2d[report_id]'";
				 $objDb->dbCon->query($sdelete);
	 			
				}
				
				}
				//}
				
				}
				 $sdeletet= "Delete from rs_tbl_category_template where cat_id='$row2c[category_cd]'";
				 $objDb->dbCon->query($sdeletet);
	   
				$sdeletect= "Delete from rs_tbl_category where category_cd='$row2c[category_cd]'";
				$objDb->dbCon->query($sdeletect);
	 	 
		 		}
				}
				else
				{
				 $sql2d="Select * from rs_tbl_documents";
				 $res2d=$objDb->dbCon->query($sql2d);
				while($row2d=$res2d->fetch())
				{
				$d_subcat=$row2d['report_subcategory'];
				$d_sub_cat=explode("_",$d_subcat);				
				$dl=count($d_sub_cat);
				for($h=0;$h<$dl;$h++)
				{
				$report_suby=$d_sub_cat[$h];
				if($report_suby==$category_cd)
				{
				 $sdelete= "Delete from rs_tbl_documents where report_id='$row2d[report_id]'";
	 			 $objDb->dbCon->query($sdelete);
				}
				
				}
				
				}
				/* $sdeletet= "Delete from rs_tbl_category_template where cat_id='$category_cd'";
	   mysql_query($sdeletet);*/
				}
		
		
		$objCommon->setMessage(PRD_DELETE_SUCCESS, 'Info');
		redirect('./?p=category');
	
	
}
if(isset($_GET['cat_cd']))
	{
	 $cat_cd=$_GET['cat_cd'];
	}
	if(isset($_REQUEST['sort']))
	{
	 
	 if($_REQUEST['sort']=="asc")
	 {
	 $sort="asc";
	 $order="desc";
	 }
	 else if($_REQUEST['sort']=="desc")
	 {
	 $sort="desc";
	 $order="asc";
	 }
	 
	}
	else
	{
	$order="asc";
	}
	
	
	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["download_submit"])){

	 	$files_download =$_POST['file_download'];
		$category=$_GET['category_cd'];
		 if(isset($files_download)){ 
		$files_count=count($files_download); 
		 for($i=0;$i<$files_count;$i++)
		 {
		 $all_download[]=$files_download[$i];		
		 }
		 $out = '';
   $out .="category_name".",";
   $out .="report_title".",";
   $out .="report_file".",";
   $out .="doc_issue_date".",";
   $out .="report_status".",";
   $out .="doc_upload_date".",";
   $out .="doc_creater".",";
   $out .="doc_last_modified_by".",";
   $out .="\n";
		foreach ($all_download as $selected_file_id) {

 $getquery="SELECT category_cd,category_name,report_title,report_file,doc_issue_date,report_status,doc_upload_date,doc_creater,doc_last_modified_by FROM rs_tbl_documents INNER JOIN rs_tbl_category ON 
 (rs_tbl_documents.report_category = rs_tbl_category.category_cd) where report_category=$category and report_id=$selected_file_id";
 $result=$objDb->dbCon->query($getquery);
 
 $num_rows = $result->rowCount($result);

  $l = $result->fetch($result);
  
	$results[] = $l['report_file'];
    $cat_name=preg_replace('/\s+/','_',$l['category_name']);
    $out.=$l['category_name'].",";
    $out.=str_replace(',','',$l['report_title']).",";	
	$out.="<a href='" .$l['report_file'] . "'>".$l['report_file']."</a> ,";
    $out.=$l['doc_issue_date'].",";
	$out.=$l['report_status'].",";
    $out.=$l['doc_upload_date'].",";
	$out.=$l['doc_creater'].",";
    $out.=$l['doc_last_modified_by'].",";
    $out .="\n";
 

}
}
 $td = date('Y-m-d-h-m-s',time());
 $filename1 = $cat_name.$td.".zip";
 // $f = fopen ("data/".$filename,'w+');
 // fputs($f, $out);
  //fclose($f);
  
  
  $zip = new ZipArchive();
$filename = SITE_PATH."Zip/".$filename1;

if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
    exit("cannot open <$filename>\n");
}

$zip->addFromString("list-".$cat_name.$td.".csv", $out);
$zip->addFromString("instructions.txt", " The list of downloaded files is provided as csv in this archive.\n");

foreach ($results as $file) {
//echo $file
$zip->addFile("project_reports/".$file,"/".$file);
}

echo "numfiles: " . $zip->numFiles . "\n";
echo "status:" . $zip->status . "\n";
$zip->close();	


header('Content-Type: application/octet-stream');
header('Content-disposition: attachment; filename='.basename($filename1));
header('Content-Length: ' . filesize("Zip/".$filename1));
ob_clean();
flush();
readfile("Zip/".$filename1);
unlink("Zip/".$filename1);			


	
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["update_order"])){

	$category_order_list=$_POST["category_order"];
	$category_cd_list=$_POST["cat_cd"];
	$size_l=sizeof($category_cd_list);
	$size_a=sizeof($category_order_list);
	$msg="";
	if($size_l==$size_a)
	{
	for($i=0; $i<$size_a;$i++)
	{
		 $sq="Update rs_tbl_category SET category_order='".$category_order_list[$i]."' WHERE category_cd=".$category_cd_list[$i];
		 $result=$objDb->dbCon->query($sq);
	}
	$msg= "Order has been updated";
	}
	
}



?>
<script>
function atleast_onecheckbox(e) {
  if ($("input[type=checkbox]:checked").length === 0) {
      e.preventDefault();
      alert('Please check atleast on record');
      return false;
  }
}
</script>
<script>
function selectAllUnSelectAll(chkAll, strSelecting, frm){
if(chkAll.checked == true){
		for(var i = 0; i < frm.elements.length; i++){
			if(frm.elements[i].name == strSelecting){
				frm.elements[i].checked = true;
			}
		}
	}
	else{
		for(var i = 0; i < frm.elements.length; i++){
			if(frm.elements[i].name == strSelecting){
				frm.elements[i].checked = false;
			}
		}
	}
}

</script>

<div class="container" style="margin-top: 20px; margin-bottom: 50px;">

            <h3 class="bold">Folders</h3>
			<?php      
	
	$sqlss="select parent_group, category_status from rs_tbl_category where category_cd='$category_cd'";
	$sqlrwss=$objDb->dbCon->query($sqlss);
	$sqlrw1ss=$sqlrwss->fetch();
	$par_groups=$sqlrw1ss['parent_group'];
	$category_status=$sqlrw1ss['category_status'];
	$par_arr=explode("_",$par_groups);
	$lenns=count($par_arr);
	$category_name="";
	for($i=0;$i<$lenns;$i++)
	{
	 $sqlCN="select category_name,parent_cd,cid from rs_tbl_category where category_cd='$par_arr[$i]' ";
	$sqlrCN=$objDb->dbCon->query($sqlCN);
	$sqlCNrw=$sqlrCN->fetch();
	
	
	$category_name .='<a href="?p=reports&cid='.$sqlCNrw["cid"].'&cat_cd='.$sqlCNrw["parent_cd"].'&category_cd='.$par_arr[$i].'">'.$sqlCNrw["category_name"].'</a>';
	
	$category_name .="&nbsp;&raquo;&nbsp;";
	
	//$category_name .=$category_name;
	}
   $report_category=$category_name;
	$sql="Select * from rs_tbl_category where category_cd=".$category_cd;
	$res=$objDb->dbCon->query($sql);
	$row3=$res->fetch();
			
				//$report_category=$row3['category_name'];
				$parent_cd=$row3['parent_cd'];
				
			?>
            <h7 ><?php echo $report_category;?></h7>
            <!-- Action Buttons -->
            <div style="text-align: right; margin-bottom: 20px;">
			<?php if($objAdminUser->user_type==1 || $objAdminUser->user_type==2)
{
  ?>
               
                <a  href="javascript:void(null);" onclick="window.open('threads_input.php?cat_cd=<?php echo $category_cd;?>&cid=<?php echo $cid;?>', 'INV','width=870,height=550,scrollbars=yes');" class="btn btn-secondary commontextsize"  >
                    <i class="bi bi-plus-square" style="margin-right: 10px;"></i>Add Tasks
                </a>

                
                <a class="btn btn-secondary commontextsize" href="javascript:void(null);" onclick="window.open('category.php?cat_cd=<?php echo $category_cd;?>&cid=<?php echo $cid;?>', 'INV','width=870,height=550,scrollbars=yes');" >
                    <i class="bi bi-plus-square" style="margin-right: 10px;"></i>Add Category
                </a>
               
                <?php if($parent_cd!=0){?>
<a class="btn btn-secondary commontextsize" href="javascript:void(null);" onclick="window.open('upload_report.php?cat_cd=<?php echo $_REQUEST["cat_cd"];?>&category_cd=<?php echo $category_cd;?>&cid=<?php echo $cid;?>', 'INV','width=550,height=400,scrollbars=yes');" >
                    <i class="bi bi-plus-square" style="margin-right: 10px;"></i>Add Files
                </a>
               <?php
				}
}

else if($_REQUEST['category_cd'])
{
$cattid=$_REQUEST['category_cd'];
			$cqueryd = "select * from  rs_tbl_category  where category_cd='$cattid'";
			$cresultd=$objDb->dbCon->query($cqueryd);
			$cdatad=$cresultd->fetch();
			
			$p_cdd=$cdatad['parent_cd'];
			if($p_cdd==0)
			{
			?>
            <?php
			}
			else if($p_cdd!=0)
			{
			
			$u_right=$cdatad['user_right'];
			$arruright= explode(",",$u_right);
			$arr_right_users=count($arruright);		
			 foreach($arruright as $key => $val) 
			 	{
			   $arruright[$key] = trim($val);
			   $aright= explode("_", $arruright[$key]);
			    if($aright[0]==$user_cd)
						{
							if($aright[1]==1)
							{
							$read_right=1;
							?>
                             <a class="btn btn-secondary commontextsize" href="javascript:void(null);" onclick="window.open('category.php?cat_cd=<?php echo $category_cd;?>&cid=<?php echo $cid;?>', 'INV','width=870,height=550,scrollbars=yes');" >
                    <i class="bi bi-plus-square" style="margin-right: 10px;"></i>Add Category
                </a>
               
                
<a class="btn btn-secondary commontextsize" href="javascript:void(null);" onclick="window.open('upload_report.php?cat_cd=<?php echo $_REQUEST["cat_cd"];?>&category_cd=<?php echo $category_cd;?>&cid=<?php echo $cid;?>', 'INV','width=550,height=400,scrollbars=yes');">
                    <i class="bi bi-plus-square" style="margin-right: 10px;"></i>Add Files
                </a>
                <?php
							}
							else if($aright[1]==3)
							{
							$read_right=3;
							?>
                            <a class="btn btn-secondary commontextsize" href="javascript:void(null);" onclick="window.open('category.php?cat_cd=<?php echo $category_cd;?>&cid=<?php echo $cid;?>', 'INV','width=870,height=550,scrollbars=yes');" >
                    <i class="bi bi-plus-square" style="margin-right: 10px;"></i>Add Category
                </a>
               
                
<a class="btn btn-secondary commontextsize" href="javascript:void(null);" onclick="window.open('upload_report.php?cat_cd=<?php echo $_REQUEST["cat_cd"];?>&category_cd=<?php echo $category_cd;?>&cid=<?php echo $cid;?>', 'INV','width=550,height=400,scrollbars=yes');">
                    <i class="bi bi-plus-square" style="margin-right: 10px;"></i>Add Files
                </a>
                <?php
				
							}
							else if($aright[1]==2)
							{
							$read_right=2;
							
							
							}
					     }
				}
			
			}
}
?>
                <!-- <button type="button" class="btn btn-secondary commontextsize" aria-label="Left Align" style="margin-right: 10px;">
                    <i class="bi bi-plus-square" style="margin-right: 10px;"></i>Add Tasks</span>
              </butt1on>
              
              <button type="button" class="btn btn-secondary commontextsize" aria-label="Left Align">
                <i class="bi bi-plus-square" style="margin-right: 10px;"></i>Add Category </span>
                </button> -->

            </div>
             <!-- Action Buttons -->
<?php
	
			  
	$sql2="Select * from rs_tbl_category where parent_cd=".$category_cd. " order by category_order asc";
	$res2=$objDb->dbCon->query($sql2);
	$total_num=$res2->rowCount();
		
			if($total_num>=1)
			{
			?>
            <div class="table-responsive commontextsize">
            <form name="form_order" id="form_order" method="post" > 
                <table id="customers" class="table">
                    <thead>

                        <tr class="">
                        <th scope="col" class="semibold">#</th>
                        <th scope="col" class="semibold"><?php
 $temp2="select * from rs_tbl_category_template where cat_id='$category_cd' order by cat_temp_order asc";
 $res_temp=$objDb->dbCon->query($temp2);
$res_temp2=$res_temp->fetch();
 $res_temp2['cat_title_text'];
?><?php echo $res_temp2['cat_title_text'] ?></th>
                        <th scope="col" class="semibold">Created By</th>
                        <th scope="col" class="semibold">Last Modified By</th>
                        <?php 
if($user_type=='1' || $user_type=='2')
{				
?>
 <th scope="col" class="semibold" ><input type="submit" id="update_order" name="update_order"  value="Order"/></th>
 <?php
 }
 ?>
<th scope="col" class="semibold">Actions</th>
<?php

?>

                        
                        </tr>

                    </thead>

                <tbody>
                <?php
 $y=1;
 while($row2=$res2->fetch())
			 {
				$report_subcategory=$row2['category_name'];
				$category_order=$row2['category_order'];
				$subcategory_id=$row2['category_cd'];
			$sub_folder="Select * from rs_tbl_category where parent_cd=".$subcategory_id;
			$sub_folders=$objDb->dbCon->query($sub_folder);
			$total_subfolder=$sub_folders->rowCount();
		    $files="Select * from rs_tbl_documents where report_category=".$subcategory_id;
			$files1=$objDb->dbCon->query($files);
			$total_files=$files1->rowCount();
			
				if($user_type=='1' || $user_type=='2')
				{
				?>
                    <tr class="">                 
                        <td> <?php echo $y;?><input type="hidden" id="cat_cd[]" name="cat_cd[]" value="<?php echo $subcategory_id;?>" /></td>
                        <td><i class="bi bi-folder-fill iconblue" style="margin-right: 5px;"></i><a href="?p=reports&category_cd=<?php echo $subcategory_id; ?>&cat_cd=<?php echo $category_cd; ?>&cid=<?php echo $cid; ?>" style="text-decoration:none"><?php echo $report_subcategory?></a></td>
                        <td>
                        <?php echo $row2['creater'];?>
                        <small class="d-block"><?php echo "folders: ".$total_subfolder."&nbsp;&nbsp; Files: ".$total_files; ?></small>
                        </td>
                        <td><?php echo $row2['last_modified_by'];?></td>
                        <td><input type="text" value="<?php echo $category_order;?>"  id="category_order[]" name="category_order[]" style="width:25px"/></td>
                        <td style="text-align: center;"><i class="bi bi-pencil-fill iconorange" style="margin-right: 10px;"><a href="javascript:void(null);" onclick="window.open('category.php?category_cd=<?php echo $subcategory_id; ?>&cid=<?php echo $cid;?>', 'INV','width=850,height=700,scrollbars=yes');" >
</a></i><i class="bi bi-trash-fill iconred"><a href="?p=reports&sel_category_cd=<?php echo $subcategory_id; ?>&cid=<?php echo $_REQUEST['cid']; ?>&cat_cd=<?php if($_REQUEST['cat_cd'])
			 {
			 echo $_REQUEST['cat_cd'];
			 }
			 else
			 {
			 $cat=0;
			 
			 } ?>&category_cd=<?php echo $_REQUEST['category_cd']; ?>&mode=cat_delete"  onclick="return confirm('Are you sure, You want to delete category?')"></a></i></td>
                    </tr>
                    <?php
				$y++;
				}
				else
				{
			
				$u_rightr=$row2['user_right'];
			$arrurightr= explode(",",$u_rightr);
			$arr_right_usersr=count($arrurightr);		
			 foreach($arrurightr as $key => $val) 
			 	{
			   $arrurightr[$key] = trim($val);
			   $arightr= explode("_", $arrurightr[$key]);
			    if($arightr[0]==$user_cd)
						{
							if($arightr[1]==1)
							{
							$read_right=1;
							}
							else if($arightr[1]==2)
							{
							$read_right=2;
							}
							else if($arightr[1]==3)
							{
							$read_right=3;
							}
						
						
					
			
				?>
 <tr class="">                 
                        <td> <?php echo $y;?><input type="hidden" id="cat_cd[]" name="cat_cd[]" value="<?php echo $subcategory_id;?>" /></td>
                        <td><i class="bi bi-folder-fill iconblue" style="margin-right: 5px;"></i><a href="?p=reports&category_cd=<?php echo $subcategory_id; ?>&cat_cd=<?php echo $category_cd; ?>&cid=<?php echo $cid; ?>" style="text-decoration:none"><?php echo $report_subcategory?></a></td>
                        <td>
                        <?php echo $row2['creater'];?>
                        <small class="d-block"><?php echo "folders: ".$total_subfolder."&nbsp;&nbsp; Files: ".$total_files; ?></small>
                        </td>
                        <td><?php echo $row2['last_modified_by'];?></td>
                        <td><input type="text" value="<?php echo $category_order;?>"  id="category_order[]" name="category_order[]" style="width:25px"/></td>
                        <td style="text-align: center;">
                        <?php if($read_right==1)
{ ?>
                        <i class="bi bi-pencil-fill iconorange" style="margin-right: 10px;"><a href="javascript:void(null);" onclick="window.open('category.php?category_cd=<?php echo $subcategory_id; ?>&cid=<?php echo $cid;?>', 'INV','width=850,height=700,scrollbars=yes');" >
</a></i>
 <?php }
 if($read_right==3)
{ ?>
<i class="bi bi-pencil-fill iconorange" style="margin-right: 10px;"><a href="javascript:void(null);" onclick="window.open('category.php?category_cd=<?php echo $subcategory_id; ?>&cid=<?php echo $cid;?>', 'INV','width=850,height=700,scrollbars=yes');" >
</a></i>

<i class="bi bi-trash-fill iconred"><a href="?p=reports&sel_category_cd=<?php echo $subcategory_id; ?>&cid=<?php echo $_REQUEST['cid']; ?>&cat_cd=<?php if($_REQUEST['cat_cd'])
			 {
			 echo $_REQUEST['cat_cd'];
			 }
			 else
			 {
			 $cat=0;
			 
			 } ?>&category_cd=<?php echo $_REQUEST['category_cd']; ?>&mode=cat_delete"  onclick="return confirm('Are you sure, You want to delete category?')"></a></i>
             
             <?php
}
?></td>
                    </tr>
                 <?php
				$y++;
				}
				}
				}
				
			}
 ?>   

                    

                    

                    

                </tbody>
                </table>
               </form>
            </div>
            <?php
			}
			
				
	?>
            </div>

<div class="container" style=" margin-bottom: 50px;">

    
            <!-- Action Buttons -->
                

                <div class="row">
                    <div class=" col-md-5">
                       <h3 class="bold">Files</h3>
                    </div>
                    <div class=" col-md-3" style="text-align: right;" >
<form name="reports_cat" id="reports_cat" method="post" action="" onsubmit="return atleast_onecheckbox(event)"> </form>
                        <?php if($category_status==1){?> <?php } else { ?>
<?php } ?><input type="submit" class="btn btn-success commontextsize" name="download_submit" id="download_submit" value="Download Files" form="reports_cat" />
                        
                        <!--<button type="button" class="btn btn-success commontextsize"><i class="bi bi-download" style="margin-right: 10px;"></i>Download Files</button>-->

                    </div>
				<?php if($category_status==1){ ?>
                <?php if(isset($_GET['cat_cd']))
{
$cat_cd1="&cat_cd=".$_GET['cat_cd'];
} ?>


                    <div class="col-md-3 regular" style="text-align: right; ">
                    <form name="filter_1" id="filter_1" method="post" action="?p=reports&cid=<?php echo $_GET['cid']; ?>&category_cd=<?php echo $_GET['category_cd']?><?php echo $cat_cd1; ?>"> 
                        <select class="form-select" style="font-size: small;">
                        
		<option value="6" <?php if(!isset($_GET['status']))echo "selected";?>>All Files</option>
		 <option value="1" <?php if($_GET['status']=='1')echo "selected";?>>Initiated</option>
  		<option value="2" <?php if($_GET['status']=='2')echo "selected";?>>Approved</option>
  		<option value="3" <?php if($_GET['status']=='3')echo "selected";?>>Not Approved</option>
  		<option value="4" <?php if($_GET['status']=='4')echo "selected";?>>Under Review</option>
 		 <option value="5" <?php if($_GET['status']=='5')echo "selected";?>>Response Awaited</option>
		 <option value="7" <?php if($_GET['status']=='7')echo "selected";?>>Responded</option>
         <option value="8" <?php if($_GET['status']=='8')echo "selected";?>>For Information Only</option>

                      </select>
                      </form>
                    </div>

                    <div class=" col-md-1" style="text-align: right;" >
<input class="btn btn-primary commontextsize" type="submit" form="filter_1" name="go_submit" id="go_submit" value="GO" />
                       <!-- <button type="button" class="btn btn-primary commontextsize"><i class="bi bi-search" style="margin-right: 10px;"></i>Go</button>-->

                    </div>


<?php
				}
				?>
                </div>
             
            <!-- Action Buttons -->

            <div class="table-responsive commontextsize" style="margin-top: 10px;">
                <table id="customers" class="table">
                    <thead>

                        <tr class="">
                        <th scope="col" class="semibold">S#</th>
                        <th scope="col">
                            <label class="checkbox-wrap checkbox-primary">
                            <input  type="checkbox" name="chkAll" id=
          "chkAll" value="1" form="reports_cat" onclick="selectAllUnSelectAll(this,'file_download[]',reports_cat);"/>
                            <!-- <input type="checkbox">
                           <span class="checkmark"></span>-->
                            </label>
                        </th>
                        <?php
$templ="select * from rs_tbl_category_template where cat_id='$category_cd' order by cat_temp_order asc";
$res_temp=$objDb->dbCon->query($templ);
$total=$res_temp->rowCount();
while($res_temp1=$res_temp->fetch())
{
//echo $cat_field_namee. $res_temp1['cat_field_name'];
?>
<?php if(isset($_GET['status']))
{
$stats="&status=".$_GET['status'];
} ?>
                        <th scope="col" class="semibold"><?php echo $res_temp1['cat_title_text'] ?> 
 <a href="?p=reports&category_cd=<?php echo $category_cd; ?>&<?php if($cat_cd=="")
{
}
else
{ ?>cat_cd=<?php echo $cat_cd;}?>&cid=<?php echo $cid;?><?php echo $stats; ?>&field=<?php echo $res_temp1['cat_field_name'];?>&sort=<?php echo $order;?>"><?php if($order=="asc"){?><img src="images/asc.png" title="Ascending" alt="Ascending"/><?php }else{?> <img src="images/desc.png" title="Descending" alt="Descending"/><?php } ?> </a></th>
<?php
}

?>
                        
                        <th scope="col" class="semibold">Uploaded Date</th>
                        <th scope="col" class="semibold">Created By</th>
                        <th scope="col" class="semibold">LastModified By</th>
                        <?php if($category_status==1){ ?>
<th scope="col" class="semibold">Status</th>
<?php
}
?>
 <th scope="col" class="semibold">Actions</th>
                        
                       
                        </tr>

                    </thead>

                <tbody>
 <?php
	$objProduct->resetProperty();
	$objProduct->setProperty("limit", PERPAGE);
	//$objProduct->setProperty("report_status", "1");
	if(isset($_GET['cat_cd']))
	{
	 $cat_cd=$_GET['cat_cd'];
	 
	$sqls="select parent_group from rs_tbl_category where category_cd='$category_cd' and parent_cd='$cat_cd'";
	$sqlrws=$objDb->dbCon->query($sqls);
	$sqlrw1s=$sqlrws->fetch();
	$par_group=$sqlrw1s['parent_group'];
	$par_arr=explode("_",$par_group);
	$lenns=count($par_arr);
	$cat_cds=$par_arr[0];
	$str_ids1="";
	for($i=1;$i<$lenns;$i++)
	{
	if($i==($lenns-1))
	{
	$str_ids=$par_arr[$i];
	}
	else
	{
	$str_ids=$par_arr[$i]."_";
	}
	$str_ids1=$str_ids1.$str_ids;
	
	}
	//echo $str_ids1;
	$objProduct->setProperty("report_category", $_REQUEST["category_cd"]);
	if(isset($_REQUEST["status"]))
	{
	$objProduct->setProperty("report_status", $_REQUEST["status"]);
	}
	//$objProduct->setProperty("report_subcategory", $cat_cds);
	if(isset($sort) && isset($_REQUEST['field']))
	{
	$column_name=$_REQUEST['field'];
	$objProduct->setProperty("column_name", $column_name);
	$objProduct->setProperty("sort", $sort);
	$objProduct->lstReportSort();
	}
	else
	{
	$objProduct->lstReport();
	}
	//echo $objProduct->getSQL();
	}
	else
	{
	$report_subcategory12='is NULL';
	$objProduct->setProperty("report_category", $category_cd);
	$objProduct->setProperty("report_subcategory", $report_subcategory12);
	if(isset($_REQUEST["status"]))
	{
	$objProduct->setProperty("report_status", $_REQUEST["status"]);
	}
	if(isset($sort) && isset($_REQUEST['field']))
	{
	$column_name=$_REQUEST['field'];
	$objProduct->setProperty("column_name", $column_name);
	$objProduct->setProperty("sort", $sort);
	$objProduct->lstReportsub_nullSort();
	}
	else
	{
	$objProduct->lstReportsub_null();
	}
	}
	
	$i=0;
	$isno=0;
	$Sql = $objProduct->getSQL();
	$objProduct->totalRecords();
	
	if($objProduct->totalRecords() >= 1){
		while($rows = $objProduct->dbFetchArray(1)){
			$bgcolor = ($bgcolor == "#FFFFFF") ? "#f1f0f0" : "#FFFFFF";
			$i++;
			
			?>
                    <tr class="">                 
                        <td><?php $isno=$isno+1; echo  $isno;?></td>
                        <td> <label class="checkbox-wrap checkbox-primary">
                           <input type="checkbox"    name="file_download[]"  value="<?php echo $rows['report_id'];?>" form="reports_cat" />
                            </label></td>
                                                  <?php
$temp5="select * from rs_tbl_category_template where cat_id='$category_cd'order by cat_temp_order asc";
$res_temp5=$objDb->dbCon->query($temp5);
$total=$res_temp5->rowCount();
while($ress_temp5=$res_temp5->fetch())
{
 $cat_field_namee =$ress_temp5['cat_field_name'];
?>
                        <td>
  
                           
                            
                            <?php
				if ($cat_field_namee=="report_title")
				{
					if($rows['report_file']!="")
					{
					?>
					<i class="bi bi-file-earmark-fill iconblue" style="margin-right: 5px;"></i><a style="text-decoration:none" href="<?php echo REPORT_URL.$rows['report_file'] ;?>" target="_blank"><?php echo $rows['report_title'];?></a>
					<?php
					}
					else
					{
					echo $rows['report_title'];
					}
				}
				else if($cat_field_namee=="doc_issue_date")
				{
					if($rows['doc_issue_date']=="" || $rows['doc_issue_date']==NULL || $rows['doc_issue_date']=="0000-00-00" || $rows['doc_issue_date']=="1970-01-01")
					{
					echo "";
					}
					else
					{
					echo date('d F Y',strtotime($rows['doc_issue_date']));
					}
				}
				else if($cat_field_namee=="doc_closing_date")
				{
					
					if($rows['doc_closing_date']=="" || $rows['doc_closing_date']==NULL || $rows['doc_closing_date']=="0000-00-00" || $rows['doc_closing_date']=="1970-01-01")
					{
					echo "";
					}
					else
					{
					echo date('d F Y',strtotime($rows['doc_closing_date']));
					}
				}
				else if($cat_field_namee=="doc_upload_date")
				{
					
					if($rows['doc_upload_date']=="" || $rows['doc_upload_date']==NULL || $rows['doc_upload_date']=="0000-00-00" || $rows['doc_upload_date']=="1970-01-01")
					{
					echo "";
					}
					else
					{
					echo date('d F Y',strtotime($rows['doc_upload_date']));
					}
				}
				else if($cat_field_namee=="received_date")
				{
					
					if($rows['received_date']=="" || $rows['received_date']==NULL || $rows['received_date']=="0000-00-00" || $rows['received_date']=="1970-01-01")
					{
					echo "";
					}
					else
					{
					echo date('d F Y',strtotime($rows['received_date']));
					}
				}
				
				else
				{
				echo $rows[$cat_field_namee];
				}
				 
				 ?>
                        </td>
                        <?php }?>
                        <td><?php echo date('d F Y',strtotime($rows['uploading_file_date'])); ?></td>
                        <td><?php echo $rows['doc_creater']; ?></td>
                        <td>
                        <?php echo $rows['doc_last_modified_by']; ?>
                        </td>
                        <?php 
$sqldoc="Select * from rs_tbl_category where category_cd=".$_REQUEST['category_cd'];
$res2doc=$objDb->dbCon->query($sqldoc);
$total_numdd=$res2doc->rowCount();
			if($total_numdd>=1)
			{
				 $f=1;
 			while($row2doc=$res2doc->fetch())
			 {
			
			 ?>
			 <?php if($category_status==1){ ?>
                        <td><?php
			 		if($rows['report_status']=='1')
					{
					echo "Initiated <span style='float:right'><img width='15' height='15'  src='./images/initiated.png'  alt='Initiated' />";
					} 
					else if($rows['report_status']=='2')
					{
					echo "Approved <span style='float:right'><img width='15' height='15'  src='./images/approved.png'  alt='Approved' /></span>";
					}
					else if($rows['report_status']=='3')
					{
					echo  "Not Approved <span style='float:right'><img width='15' height='15'  src='./images/not_approved.png'  alt='Not Approved' /></span>";
					}
					else if($rows['report_status']=='4')
					{
					echo "Under Review <span style='float:right'><img width='15' height='15'  src='./images/under_review.png'  alt='Under Review' /></span>";
					}
					else if($rows['report_status']=='5')
					{
					echo "Response Awaited <span style='float:right'><img width='15' height='15'  src='./images/awaiting_decision.png'  alt='Awaiting Decision' /></span>";
					}
					else if($rows['report_status']=='7')
					{
					echo "Responded<span style='float:right'><img width='15' height='15'  src='./images/responded.png'  alt='Responded' /></span>";
					}
					
					else if($rows['report_status']=='8')
					{
					echo "For Information Only<span style='float:right'><img width='15' height='15'  src='./images/info.png'  alt='For Information Only' /></span>";
					}?></td><?php
					}
					?>
                       
                        <td style="text-align: center;">
						<?php	
			 if($user_type==1 || $user_type==2)
			 {
			 ?><i class="bi bi-pencil-fill iconorange" style="margin-right: 10px;"><a href="javascript:void(null);" onclick="window.open('upload_report.php?report_id=<?php echo $rows['report_id']; ?>', 'INV','width=650,height=400,scrollbars=yes');" ></a></i><i class="bi bi-trash-fill iconred"><a href="?p=reports&report_cd=<?php echo $rows['report_id']; ?>&cid=<?php echo $_REQUEST['cid']; ?>&cat_cd=<?php if($_REQUEST['cat_cd'])
			 {
			 echo $_REQUEST['cat_cd'];
			 }
			 else
			 {
			 $cat=0;
			 echo $cat;
			 } ?>&category_cd=<?php echo $_REQUEST['category_cd']; ?>&mode=delete"  onclick="return confirm('Are you sure, You want to delete this record?')"></a></i></td>
             <?php
			 }
			 else if($row2doc['parent_cd']==0)
			 {
			 ?>
			<td colspan="2"></td> 
			 <!--<td colspan="2"><a href="javascript:void(null);" onclick="window.open('upload_report.php?report_id=<?php //echo $rows['report_id']; ?>', 'INV','width=550,height=400,scrollbars=yes');" ><img src="./images/edit.gif" border="0" /></a></td>--> 
			 <?php
			 }
			
			 else
			 {
			$u_rightdoc=$row2doc['user_right'];
			$arruright_doc= explode(",",$u_rightdoc);
			$arr_right_docu=count($arruright_doc);		
			 foreach($arruright_doc as $key => $val) 
			 	{
			   $arruright_doc[$key] = trim($val);
			   $aright_doc= explode("_", $arruright_doc[$key]);
			    if($aright_doc[0]==$user_cd)
						{
							if($aright_doc[1]==1)
							{
							
							
?>
<td colspan="2">
<i class="bi bi-pencil-fill iconorange" style="margin-right: 10px;"><a href="javascript:void(null);" onclick="window.open('upload_report.php?report_id=<?php echo $rows['report_id']; ?>', 'INV','width=650,height=400,scrollbars=yes');" ></a></i>
<!--<a href="javascript:void(null);" onclick="window.open('upload_report.php?report_id=<?php echo $rows['report_id']; ?>', 'INV','width=650,height=400,scrollbars=yes');" ><img src="./images/edit.gif" border="0" /></a>--></td>
						
<?php
}
							else if($aright_doc[1]==3)
							{
							
							
?>
<td >
<i class="bi bi-pencil-fill iconorange" style="margin-right: 10px;"><a href="javascript:void(null);" onclick="window.open('upload_report.php?report_id=<?php echo $rows['report_id']; ?>', 'INV','width=650,height=400,scrollbars=yes');" ></a></i>
<i class="bi bi-trash-fill iconred"><a href="?p=reports&report_cd=<?php echo $rows['report_id']; ?>&cid=<?php echo $_REQUEST['cid']; ?>&cat_cd=<?php if($_REQUEST['cat_cd'])
			 {
			 echo $_REQUEST['cat_cd'];
			 }
			 else
			 {
			 $cat=0;
			 echo $cat;
			 } ?>&category_cd=<?php echo $_REQUEST['category_cd']; ?>&mode=delete"  onclick="return confirm('Are you sure, You want to delete this record?')"></a></i>

             </td>
						
<?php
}
							else if($aright_doc[1]==2)
							{
							?>
							<td></td>
							<?php
							}
					}
				}
				}
			
				$f++;
				}
			}
?>
                    </tr>
                    <?php		
			
		
			
		}
    }
	else{
	?>
    <tr>
	<?php $colspn=$total+7;?>
    	<td colspan="<?php echo $colspn; ?>" align="center" style="background-color:white"><?php echo "No record Found";?></td>
    </tr>
		<?php
        }
        ?>
                </tbody>
                </table>
            </div>

            </div>

  <!-- Footer -->

    <div class="container-fluid" style="margin-top: -250px; background-color: #222666; position: fixed; bottom: 0;">
        <div class="row">
            <div class="col-md">
                <p class="light basicfontsize" style="text-align: center; color:#fff; margin-top: 10px;">
                    Developed by SJ-SMEC © 2021</p>
            </div>

        </div>

    </div>



      