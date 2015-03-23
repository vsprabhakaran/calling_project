<!DOCTYPE html>
<head>
  <script type="text/javascript" src="js/jquery-latest.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="css/jquery-ui.min.css">
  <link rel="stylesheet" href="css/globalStyles.css">
  <link rel="stylesheet" href="css/pure-min.css">
  <?php
	session_start();
  ini_set('display_errors','On');
  error_reporting(E_ALL | E_STRICT);
  require_once("db/dbConnection.php");
  //$chequeDate=$_SESSION["chequeDate"];
  //$circle=$_SESSION["circle"];
  //$pfNo=$_SESSION["pfNo"];
	$_SESSION["pfNo"] = "6716547";
	$_SESSION["emp_name"] = "Prabhakaran S";
  $pfNo="6716679";
  $chequeDate="2015-03-19";
  $circle="chennai";
  ?>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
  <style>
  input[type=text],select
{
    border:solid 1px #BFBDBD;
}
input[type=button]{
    background-color: #02aca3;
    color: #979797;
    color: #fff;
    text-transform:uppercase;
    border:solid 1px #02aca3;
}
  #chequeDetailsPanel,#searchPanel{
    text-align:center;
  }
  #chequeListPanel,#chequeImage{
    display:table;
    margin:0 auto;
  }
  #prevButton{
    margin-left:15%;
  }
  #nextButton{
    float:right;
    margin-right:15%;
  }
  </style>

</head>
<body>
	<script type="text/javascript">
	var pf;
	$(document).ready(function () {
		$('#formid').bind("keyup keypress", function (e) {
			var code = e.keyCode || e.which;
			if (code == 13) {
				e.preventDefault();
				return false;
			}
		});
		
	});
	</script>

   <div id="header">
       <div style="margin-left:40%;display:inline-block;">SBI CCPC,CHENNAI</div>
       <div style="display:inline-block;float:right;"> <?php echo $_SESSION["pf_index"];?> (<a>Logout</a>)</div>
   </div>
   <div>
     <iframe src='' style="height:5em;width:100%;" ></iframe>
   </div>
   

   <form name="chequeProcessingForm" id="chequeProcessingForm" method="post" action="">
   	<!-- Storing the processing state-->
	<input type="hidden" name="date_chosen" value="none"/>
	<input type="hidden" name="circle_chosen" value="none"/>
	
   <div id="chequeImagePanel">
     <img id="chequeImage" src="img/StateBankofIndia_IN.png" height=300 width=660 />
   </div>
   <div id="chequeListPanel">
     <table id="chequeList" border=1 style="border-collapse:collapse">
       <tr>
         <th>Sno</th>
         <th>Cheque No.</th>
         <th>Account No.</th>
         <th>Beneficiary name</th>
         <th>Amount</th>
       </tr>
       <?php
       $con=null;
       db_prelude($con);
       //fetches account numbers with aggregate cheque amount  > X in desc order which are not in status_Table(i.e)not fetched already
       $query1=mysqli_query($con,"SELECT accountno,sum(amount) from ccpc_hvt_instruments_calling where (accountno NOT IN (select accountno from status_table)) group by accountno order by sum(amount) DESC LIMIT 0,1");
       $accountNoRow=mysqli_fetch_array($query1);
       $accNo= $accountNoRow['accountno'];
       $query2=mysqli_query($con,"SELECT * from ccpc_hvt_instruments_calling where accountno='$accNo'");
       $sno=1;
       while($row=mysqli_fetch_Array($query2)){
        $lockQuery=mysqli_query($con,"INSERT INTO status_table(MICRCODE, CHEQUENO, TC, ACCOUNTNO, CHEQUEDATE, STATUS_FLAG, LOCK_PF, COMMENTS)
                     VALUES ('$row[MICRCODE]','$row[CHEQUENO]','$row[TC]','$row[ACCOUNTNO]','$row[CHEQUEDATE]','WL','$pfNo','')" );
        $query3=mysqli_query($con,"SELECT amount,name from ccpc_hvt_instruments_calling
                where MICRCODE='$row[MICRCODE]'AND CHEQUENO='$row[CHEQUENO]'AND TC='$row[TC]'AND ACCOUNTNO='$row[ACCOUNTNO]'AND CHEQUEDATE='$row[CHEQUEDATE]'");
        $newRow=mysqli_fetch_Array($query3);
        $amount=$newRow["amount"];
        $name=$newRow["name"];
         if($lockQuery){
           echo "<tr><td>".$sno."</td>";$sno++;
           echo "<td>".$row['CHEQUENO']."</td>";
           echo "<td>".$row['ACCOUNTNO']."</td>";
           echo "<td>".$name."</td>";
           echo "<td>".$amount."</td>";
         }
       }
       ?>
     </table>
   </div>
   <br/>
   <div id="chequeDetailsPanel">
     <label for="branchCode">Branch Code:</label>
     <input type="text" id="branchCode" name="branchCode" disabled style="width:5%"/>
     <label for="branchName">Branch Name:</label>
     <input type="text" id="branchName" name="branchName" disabled/>
     <label for="accountNumber">Account Number:</label>
     <input type="text" id="accountNumber" name="accountNumber" disabled style="width:10%"/>
     <label for="aggregateAmount">Aggregate Amount:</label>
     <input type="text" id="aggregateAmount" name="aggregateAmount" disabled style="width:7%"/>
     <br/><br/>
     <label for="phoneNumber">Phone Number:</label>
     <input type="text" id="phoneNumber" name="phoneNumber" style="width:10%"/>
     <label for="callStatus">Call Status:</label>
     <select id="callStatus" name="callStatus">
       <option value="CC">Confirmed by Customer</option>
       <option value="CBP">Confirmed by branch through phone</option>
       <option value="CBM">Confirmed by branch through mail</option>
	   <option value="DC">Denied by Customer</option>
	   <option value="DBP">Denied by branch through phone</option>
	   <option value="DBM">Denied by branch through mail</option>
       <option value="PB">Customer number busy</option>
       <option value="PNR">Customer number not reachable</option>
     </select>

	<br/><br/>

   </div>
   	<div id="chequeButtonPanel">
     <input type="button" name="prevButton" id="prevButton" value="Previous" />
     <input type="button" name="nextButton" id="nextButton" value="Next" onClick="validateAndLoadNextAccount()"/>
	</div>
	</form>
</body>
</html>
