<?php
$objDb		= new Database;
if($_SERVER['REQUEST_METHOD'] == "POST"){
	 $username 	= trim($_POST['username']);
	 $passwd 	= trim($_POST['password']);
	//$user_type	= trim($_POST['user_type']);
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("username", LOGIN_FLD_VAL_USERNAME, "S");
	$objValidate->setCheckField("password", LOGIN_FLD_VAL_PASSWD, "S");
	$vResult = $objValidate->doValidate();
	
	if(!$vResult){
		$objAdminUser->setProperty("username", $username);
//		$objAdminUser->setProperty("passwd", md5($passwd));
		$objAdminUser->setProperty("passwd", $passwd);
		
		$objAdminUser->lstAdminUser();
		if($objAdminUser->totalRecords() >= 1){
			
		//$objAdminUser->setProperty("user_type", $user_type);
		$objAdminUser->lstAdminUser();
		if($objAdminUser->totalRecords() >= 1){
			$rows = $objAdminUser->dbFetchArray(1);
			$fullname = $rows['first_name'] . " " . $rows['last_name'];
			$objAdminUser->setProperty("user_cd", $rows['user_cd']);
			$objAdminUser->setProperty("username", $rows['username']);
			$objAdminUser->setProperty("fullname_name", $fullname);
			$objAdminUser->setProperty("user_type", $rows['user_type']);
			$log_time= date('Y-m-d H:i:s');
			$objAdminUser->setProperty("logged_in_time", date('Y-m-d H:i:s'));
			$objAdminUser->setProperty("member_cd", $rows['member_cd']);
			$objAdminUser->setProperty("designation", $rows['designation']);
			$objAdminUser->setAdminLogin();
		/***** Log Entry *****/
		
			$ip = $_SERVER['REMOTE_ADDR'];
			$ipadd = $ip;
			$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			$nowdt = date("Y-m-d H:i:s");
			$sSQLlog = "INSERT INTO rs_tbl_user_log(user_id, epname, logintime, user_ip, user_pcname) VALUES ('$rows[user_cd]', '$rows[username]', '$nowdt', '$ipadd', '$hostname')";
			$idres=$objDb->dbCon->query($sSQLlog);
			//$urid=$idres->lastInsertId();
			//$_SESSION['urid']=$urid;
		
		/*
		 //$this->dbCon->$sSQLlog->query();
			 //echo "test";
			echo $urid=$this->dbCon->lastInsertId();
			$_SESSION['urid']=$urid;*/
	/*	$log_desc 	= "User <strong>" . $fullname . "</strong> is login at.". $log_time;
			$log_module = "Login";
			$log_title 	= "User Login";
			doLog($log_module, $log_title, $log_desc,$rows['user_cd']);*/
				if(isset($_SERVER["REQUEST_URI"]))
			{
			$url="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			header("location:".$url);
			}
			else
			{
			header("location: index.php");
			}
			
		}
		else
		{
			$objCommon->setMessage("Invalid User Accesss Rights! Please try again", 'Error');
		}
		}
		else{
			$objCommon->setMessage(LOGIN_FLD_INVALID, 'Error');
		}
	}
}
?>

<script>
function frmValidate(frm){
	var msg = "<?php echo _JS_FORM_ERROR;?>\r\n-----------------------------------------";
	var flag = true;
	if(frm.username.value == ""){
		msg = msg + "\r\n<?php echo LOGIN_FLD_VAL_USERNAME;?>";
		flag = false;
	}
	if(frm.password.value == ""){
		msg = msg + "\r\n<?php echo LOGIN_FLD_VAL_PASSWD;?>";
		flag = false;
	}
	if(flag == false){
		alert(msg);
		return false;
	}
	
}
</script>
<script type="text/javascript">
function toggleDiv(divId) {
 /*  $("#"+divId).toggle();*/
   $("#"+divId).hide(800);
/*   $("p").hide("slow");*/

}
</script>



<div class="wrapper">

        <div class="container" style="margin-top: 30px; margin-bottom: 30px;">

            <div class="row">

                <div  style="text-align: center; margin: auto;">
                    <a class="navbar-brand" href="#"><img src="img/smec-logo-white.png" height="70px" alt="smec logo"></a>
                </div>

                </div>
           
            <div class="row" style="margin-top: 25px;">

                <div style="text-align: center;margin: auto;">
                    <h2 class="semibold" style="color: #fff;">DOCUMENT MANAGEMENT SYSTEM</h2>
                    <h7  style="color: #fff;"><?php echo HOME_MAIN_TITLE?></h7>
                </div>
            </div>
        </div>


       
        <form name="frmlogin" onsubmit="return frmValidate(this);" method="post" action="" class="login">
          <p class="title"><?php echo LOGIN_H1;?></p>
          <input name="username" type="text" id="username" value="<?php echo $_POST['username'];?>" placeholder="Username" style="font-size: 13px;" autofocus/>
          <input name="password" id="password" type="password" placeholder="Password" style="font-size: 13px;" />
         <!-- <a href="#">Forgot your password?</a><br>--><br>
          <div style="text-align: center;"> 
           <input type="submit" name="Submit" value="<?php echo LOGIN_BTN_LOGIN;?>" class="btn btn-warning" style="display: inline-block;
    font-weight: 400;
    line-height: 1.5;
    
    text-align: center;
    text-decoration: none;
    vertical-align: middle;
   color:black;
    user-select: none;
    
    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    border-radius: .25rem;
    width:77px; height:38px" />
         
          </div>
         
        </form>
        <!--<footer><a target="blank" href="https://www.smec.com/en_lk">Developed by SJ-SMEC © 2021</a></footer>-->
       
      </div>
       <script src="js/loginjs.js"></script>


