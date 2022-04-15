 <script>

function ref_Search(reference_no) {

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	document.getElementById("livesearch").style.display="none"; 
	document.getElementById("advsearch").style.display="block"; 
      document.getElementById("advsearch").innerHTML=xmlhttp.responseText;
      document.getElementById("advsearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","ref_search.php?reference_no="+reference_no,true);
  xmlhttp.send();

}

</script>

   <script>
  $(function() {
    $( "#doc_issue_date" ).datepicker();
	
  });
  $(function() {
    $( "#doc_upload_datef" ).datepicker();
	
  });
   $(function() {
    $( "#doc_upload_datet" ).datepicker();
	
  });
   $(function() {
    $( "#received_date" ).datepicker();
	
  });
 
  </script>
  
  
<form name="searchfrm" id="searchfrm" action="reports_search.php"  method="post"  style=" border:1px solid #FFFFFF" >

        <h4 class="semibold"  style="text-align: center; margin: auto; margin-bottom: 20px; margin-top: 20px;">Reference Tracking</h4>
               
        <div class="container" style=" margin-top: 20px; margin-bottom: 50px;  border-radius: 15px; border: 2px solid #dfdfdf;padding: 20px; ">
            <div class="row">

                 
                    <div class="col-md-4 regular" style="font-size: small; text-align: right;; margin: auto;">
                      <label  class="sr-only">Reference No</label>
                      </div>

                    <div class=" col-md-4 regular" style="font-size: small; text-align: center; margin: auto; margin-top: 10px;">
                     <input type="text" value="" name="reference_no"  id="reference_no" class="form-control"  style="font-size: small;" placeholder="Reference No"/>
                   <!--  <input type="text" class="form-control" id="inputReferenceNo" style="font-size: small;" placeholder="Reference No">-->
                    </div>

                    <div class=" col-md-4 regular" style="font-size: small; margin: auto; margin-top: 10px;">
                       <!-- <button type="submit" class="btn btn-primary mb-2">Go</button>-->
                        <input type="button" onclick="ref_Search(reference_no.value)" value="Go"  class="btn btn-primary mb-2"/>
                      </div>

        </div>

    </div>

</form>

		




<div id="livesearch"></div>
<div id="advsearch"></div>
	
 <!-- Footer -->

    <div class="container-fluid" style="margin-top: -250px; background-color: #222666; position: fixed; bottom: 0;">
        <div class="row">
            <div class="col-md">
                <p class="light basicfontsize" style="text-align: center; color:#fff; margin-top: 10px;">
                    Developed by SJ-SMEC © 2021</p>
            </div>

        </div>

    </div>

      