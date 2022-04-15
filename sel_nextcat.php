<?php 

require_once("config/config.php");
$objCommon 		= new Common;
?>
<?php 
$objMenu 		= new Menu;
$objNews 		= new News;
$objContent 	= new Content;
$objTemplate 	= new Template;
$objMail 		= new Mail;
$objCustomer 	= new Customer;
$objCart 	= new Cart;
$objAdminUser 	= new AdminUser;
$objManageLang 	= new ManageLang;
$objProduct 	= new Product;
$objValidate 	= new Validate;
$objOrder 		= new Order;
$objLog 		= new Log;
require_once('rs_lang.admin.php');
require_once('rs_lang.website.php');
require_once('rs_lang.eng.php');

if($_REQUEST['lang']=="4")
{

require_once('rs_lang.rus.php');
}
else
{
require_once('rs_lang.eng.php');
}
$objDb		= new Database;
$objDb2		= new Database;
?>
<?php
$user_cd	= $objAdminUser->user_cd;
$user_type	= $objAdminUser->user_type;
$user_right=$user_cd."_";

?>
<table width="90%"  cellspacing="1" cellpadding="1" align="center">
<?php 

$cat_id = intval($_GET['cat_id']);
if($cat_id!="")
{
if($user_type==1)
{
 $tquery = "select * from  rs_tbl_category where parent_cd = ".$cat_id . " order by category_cd ASC";
$tresult = $objDb->dbCon->query($tquery);
$mysql_rows=$tresult->rowCount();
}
else
{
$tquery1 = "select * from  rs_tbl_category where parent_cd = ".$cat_id . " order by category_cd ASC";
$tresult1 = $objDb->dbCon->query($tquery1);
$c_id1="";
$g=0;
while($cddata2=$tresult1->fetch())
{
$catt_cdd=$cddata2['category_cd'];
$arr_rst1=explode(",",$cddata2['user_ids']);
$len_rst21=count($arr_rst1);

for($ri1=0; $ri1<$len_rst21; $ri1++)
{ 

if($arr_rst1[$ri1]==$user_cd)
{
$g=$g+1;
	if($g==1)
	{ 
	$c_id1="category_cd=".$catt_cdd ;
	}
	else
	{
	
	$c_id1.=" OR category_cd=".$catt_cdd ;
	}

}

}
//$g=$g+1;

}	

	if($c_id1!="")
	{
	$tquery = "select * from  rs_tbl_category where ".$c_id1." order by category_cd ASC";
	$tresult = $objDb->dbCon->query($tquery);
	$mysql_rows=$tresult->rowCount();
	}
	else
	{
	$mysql_rows=0;
	?>
	
	<?php 
	}
}
if($mysql_rows>0)
{


?>


<tr>
<td width="12%" class="label"><?php echo "Sub Category";?> 
       <span style="color:#FF0000;">*</span>:</td>
<td width="38%">
<select name="subcatid_<?php echo $cat_id; ?>" id="subcatid_<?php echo $cat_id; ?>"  onchange="subcatlisting(this.value,'<?php echo $cat_id?>',<?php echo $cat_id; ?>)">
<option value="0">Select Sub Category..</option>
<?php

while ($tdata = $tresult->fetch()) {

?>
<option value="<?php echo $tdata['category_cd']; ?>"><?php echo $tdata['category_name']; ?></option>
<?php

}
?>
</select>
</td>
</tr>
<?php

}

?>

<?php

}
?>
</table>