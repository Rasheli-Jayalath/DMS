<?php 

	
	function getSubM($parent_cd){
		//$spaces .= '';
	$objProductN = new Product;
	$objProductN->setProperty("parent_cd", $parent_cd);
	$objProductN->lstCategory();
	if($objProductN->totalRecords() >= 1){
		echo '<ul >' . "\n";
					while($rows = $objProductN->dbFetchArray(1)){
					echo '<li>
					<a href="./?p=reports&cid='.$rows['cid'].'&category_cd='.$rows['category_cd'].'" ';
					if($rows['menu_cd']==1 || $rows['menu_cd']==2 || $rows['menu_cd']==4 || $rows['menu_cd']==81)
		{
		echo $target="target='_blank'";
		}
					echo '>' . $rows['category_name'] . '</a>';
					getSubM($rows['category_cd']);
					echo '</li>' . "\n";
					}
					echo '</ul>' . "\n";
    		
		}
    }
?>

<!-- Nav Bar -->
    <nav class="navbar sticky-top navbar-expand-lg navbar-custom">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li ><a href="./index.php" class="nav-link navbasicfontsize" aria-current="page"><?php echo HOME ?></a></li>
			<?php
	if($objAdminUser->user_type==3)
	{ 
	$objMenu->setProperty("user_cd", $objAdminUser->user_cd);
	$objMenu->setProperty("parent_cd", "0");
  //  $objMenu->lstUserMenu();
  $objMenu->lstMenu();
	}
	else
	{
	$objMenu->setProperty("parent_cd", "0");
    $objMenu->lstMenu();
	}
	if($objMenu->totalRecords() >= 1){
		$counter = 100000;
		$counter++;
		# Print parent menus
		while($rows_p = $objMenu->dbFetchArray(1)){

			echo '<li  class="nav-item dropdown" id="' . $rows_p['menu_cd'] . '">
			
			<a  class="nav-link navbasicfontsize" href="' . str_replace("USER_TYPE", $objAdminUser->user_type, $rows_p['menu_link']). '">';  
			
			if(($rows_p['menu_cd']==84) && (($objAdminUser->user_type)!=1))
	{
	}
	else
	{
	if($_REQUEST['lang']=="4")
						{
						echo $rows_p['menu_title_rus'];
						
						}
						else
						{
						echo $rows_p['menu_title'];
						}
	} 
	echo '</a>' . "\n";
				if($rows_p['menu_cd']==5)
				{
				$objProduct->resetProperty();
				$objProduct->setProperty("limit", PERPAGE);
				$objProduct->setProperty("parent_cd", 0);
				$objProduct->setProperty("cid", 1);
				$objProduct->lstCategory();
				$Sql = $objProduct->getSQL();
				if($objProduct->totalRecords() >= 1){
					echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">' . "\n";
					while($rows = $objProduct->dbFetchArray(1)){
					echo '<li ><a class="dropdown-item navbasicfontsize" href="./?p=reports&cid='.$rows['cid'].'&category_cd='.$rows['category_cd'].'" ';
						if($rows['menu_cd']==1 || $rows['menu_cd']==2 || $rows['menu_cd']==4 || $rows['menu_cd']==81)
		{
		echo $target="target='_blank'";
		}
					echo '>';
					echo $rows['category_name'];
					echo '</a>';
					//getSubM($rows['category_cd']);
					echo '</li>' . "\n";
					}
					echo '</ul>' . "\n";
					
				}
					
					}
				elseif($rows_p['menu_cd']==54)
				{
				$objProduct->resetProperty();
				$objProduct->setProperty("limit", PERPAGE);
				$objProduct->setProperty("parent_cd", 0);
				$objProduct->setProperty("cid", 2);
				$objProduct->lstCategory();
				$Sql = $objProduct->getSQL();
				if($objProduct->totalRecords() >= 1){
					echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">' . "\n";
					while($rows = $objProduct->dbFetchArray(1)){
					
					echo '<li><a class="dropdown-item navbasicfontsize" href="./?p=reports&cid='.$rows['cid'].'&category_cd='.$rows['category_cd'].'" ';
						if($rows['menu_cd']==1 || $rows['menu_cd']==2 || $rows['menu_cd']==4 || $rows['menu_cd']==81)
		{
		echo $target="target='_blank'";
		}
					echo '>';
					echo  $rows['category_name'];
					echo  '</a>';
					//getSubM($rows['category_cd']);
					echo '</li>' . "\n";
					}
					echo '</ul>' . "\n";
					
				}
					
					}
				else
				{
			$objMenuNew = new Menu;
			$objMenuNew->setProperty("parent_cd", $rows_p['menu_cd']);
			$objMenuNew->lstMenu();
			if($objMenuNew->totalRecords() >= 1){
				echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">' . "\n";
				while($rows = $objMenuNew->dbFetchArray(1)){
					if(($rows['menu_cd']==80) && (($objAdminUser->user_type)!=1))
						{
						}
						else if(($rows['menu_cd']==87) && (($objAdminUser->user_type)!=1))
						{
						}
						else if(($rows['menu_cd']==39) && (($objAdminUser->user_type)!=1))
						{
						}
						else if(($rows['menu_cd']==22) && (($objAdminUser->user_type)==1))
						{
						}
						
						else{
						echo '<li  id="' . $rows['menu_cd'] . '"><a class="dropdown-item navbasicfontsize"';
						
						echo 'href="' . $rows['menu_link'] ;
						if($rows_p['menu_cd']!=5)
						{
						 "&menu_cd=".$rows_p['menu_cd'];
						}
						echo '" ';
					if($rows['menu_cd']==1 || $rows['menu_cd']==2 || $rows['menu_cd']==4 || $rows['menu_cd']==81)
		{
		echo $target="target='_blank'";
		}
						echo '>' ;
						if($_REQUEST['lang']=="4")
						{
						echo $rows['menu_title_rus'];
						}
						else
						{
						echo $rows['menu_title'];
						}
						 echo  '</a>';
					$objMenu1 = new Menu;
					$objMenu1->setProperty("parent_cd", $rows['menu_cd']);
					$objMenu1->lstMenu();
					if($objMenu1->totalRecords() >= 1){
						echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">' . "\n";
						while($rows1 = $objMenu1->dbFetchArray(1)){
							
				echo '<li  id="' . $rows1['menu_cd'] . '"><a class="dropdown-item navbasicfontsize" href="' . $rows1['menu_link'] . '" ';
				
				if($rows1['menu_cd']==1 || $rows1['menu_cd']==2 || $rows1['menu_cd']==4 || $rows1['menu_cd']==81)
		{
		echo $target="target='_blank'";
		}
								echo '>';
						if($_REQUEST['lang']=="4")
						{
						echo $rows_p['menu_title_rus'];
						
						}
						else
						{
						echo $rows_p['menu_title'];
						} 
								echo  '</a></li>' . "\n";
						}
						echo '</ul>' . "\n";
						echo '</li>' . "\n";
					}
					}
				}
				echo '</ul>' . "\n";
			}
			echo '</li>' . "\n";
				}
			$counter++;
		}
	}
	?> 

 </ul>
  
            </div>
        </div>
    </nav>

      <!-- Scripts.... -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
    crossorigin="anonymous"></script>

     <!-- Nav bar scripts -->
     <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
     

    <!-- <script>
        $(".nav .nav-link").on("click", function(){
        $(".nav").find(".active").removeClass("active");
        $(this).addClass("active");
        });
    </script> -->

    <script type="text/javascript">
        const currentlocation = location.href;
        const menuitem = document.querySelectorAll('a');
        const menuLength = menuitem.length;
        for( let i = 0; i<menuLength  ;i++)
        {
            if(menuitem[i].href === currentlocation)
            {
                menuitem[i].className = "nav-link active navbasicfontsize";
            }

        }

    </script>


