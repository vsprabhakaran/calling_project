<!DOCTYPE html>
  <?php
	session_start();
	$dateAvailable = FALSE;
	$PFAvailable = FALSE;
	$chosen_date = "";
	$login_pfIndex = "";
	
	$_SESSION["ccpc_calling_pfIndex"] = '6716547';
	$_SESSION["ccpc_calling_chequeDate"] = '2015-03-19';
	
	if(isset($_SESSION["ccpc_calling_chequeDate"])) {
		$chosen_date = $_SESSION["ccpc_calling_chequeDate"];
		$dateAvailable = TRUE;
	}
	if(isset($_SESSION["ccpc_calling_pfIndex"])) {
		$login_pfIndex = $_SESSION["ccpc_calling_pfIndex"];
		$PFAvailable = TRUE;
	}	
	//$dateAvailable = FALSE;
  ?>
<head>
  <script type="text/javascript" src="js/jquery-latest.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="css/jquery-ui.min.css">
  <link rel="stylesheet" href="css/globalStyles.css">
  <link rel="stylesheet" href="css/pure-min.css">

<style type="text/css">
	.banner_headLine{
		width:100%;
		height:1.5em;
		background-color:rgb(185, 245, 101);
		padding:0.2em;
	}
	.banner_headLine div{
		margin-top:0.1em;
		width:19%;
		display:inline;
		float:left;
		height:1em;
	}
	.banner_CircleStatus{
		width:100%;
		display: table-cell;
		background-color:rgb(203, 203, 203);
		padding:0.2em;
		
	}
	.banner_CircleStatus div{
		height:1em;
		margin-top:0.1em;
		display:inline;
		float:left;
		margin-right:0.2em;
		margin-left : 0.2em;
		background-color: beige;
		padding: 0.5em;
	}
</style>
</head>
<body>
	<div>
		<?php if($PFAvailable){ ?>
		<div class="banner_headLine">
			<div><b>Your Status</b></div>
			<div>PF Index : <?php echo $login_pfIndex; ?> </div>
			<div>Date : </div>
			<div>Pending : <?php echo getPFPending($login_pfIndex); ?></div>
			<div>Completed : <?php echo getPFCompleted($login_pfIndex); ?> </div>
		</div>
		<?php } 
		if($dateAvailable){ ?>
		<div class="banner_CircleStatus">
			<div>Chennai : <?php echo getCircleStatus("Chennai"); ?></div>
			<div>Bangalore : <?php echo getCircleStatus("Bangalore"); ?></div>
			<div>Hyderabad : <?php echo getCircleStatus("Hyderabad"); ?></div>
			<div>Kerala : <?php echo getCircleStatus("Kerala"); ?></div>
			<div>Chandigarh : <?php echo getCircleStatus("Chandigarh"); ?></div>
			<div>Ahmedabad : <?php echo getCircleStatus("Ahmedabad"); ?></div>
			<div>West Bengal : <?php echo getCircleStatus("West Bengal"); ?></div>
			<div>Bhuvaneshwar : <?php echo getCircleStatus("Bhuvaneshwar"); ?></div>
			<div>Guwahati : <?php echo getCircleStatus("Guwahati"); ?></div>
			<div>Patna : <?php echo getCircleStatus("Patna"); ?></div>
			<div>Delhi : <?php echo getCircleStatus("Delhi"); ?></div>
			<div>Mumbai : <?php echo getCircleStatus("Mumbai"); ?></div>
			<div>Bhopal : <?php echo getCircleStatus("Bhopal"); ?></div>
			<div>Lucknow : <?php echo getCircleStatus("Lucknow"); ?></div>
		</div>
		<?php } 
		
		?>
	</div>
<body>
<?php
function getCircleStatus($circleName)
{
	$con = NULL;
    getConnection($con); 
	global $chosen_date;
	//Note that we have to include date in this SQL to be complete
	$sqlQuery_Total = "SELECT count(*) as 'NO_OF_CHEQUE' from ccpc_hvt_instruments_calling ic_full, micr_circles mc where  mc.circle_name = '".$circleName."' and ic_full.chequedate = '".$chosen_date."' and ic_full.MICRCODE  between  RPAD(mc.from, 9, '0') and RPAD(mc.to, 9, '0')";
	//echo $sqlQuery_Total;
	$query=mysqli_query($con,$sqlQuery_Total);
	$row = mysqli_fetch_array($query);
	$no_entries_all = $row['NO_OF_CHEQUE'];
	
	$sqlQuery_Confirmed = "SELECT count(*) as 'CNF_CHEQUE' from micr_circles mc, status_table st, status_flag_values sfv where  st.status_flag = sfv.status_flag and sfv.status_type = 'Confirmed' and mc.circle_name = '".$circleName."' and st.chequedate = '".$chosen_date."' and st.MICRCODE between RPAD(mc.from, 9, '0') and RPAD(mc.to, 9, '0')";
	//echo $sqlQuery_Confirmed;
	$query=mysqli_query($con,$sqlQuery_Confirmed);
	$row = mysqli_fetch_array($query);
	$no_entries_cnf = $row['CNF_CHEQUE'];
	mysqli_close($con);
	return $no_entries_cnf."/".$no_entries_all;
}
function getPFPending($PFIndex)
{
    $con = NULL;
    getConnection($con);
	global $chosen_date;
	//Note that we have to include date in this SQL to be complete
	$sqlQuery = "SELECT count(*) as 'PENDING' from status_table st, status_flag_values sfv where sfv.status_type = 'Pending' and st.chequedate = '".$chosen_date."' and sfv.status_flag = st.status_flag and st.lock_pf = '".$PFIndex."'";
	$query=mysqli_query($con,$sqlQuery);
	$row = mysqli_fetch_array($query);
    $no_entries = $row['PENDING'];
	mysqli_close($con);
	return $no_entries;
}
function getPFCompleted($PFIndex)
{
    $con = NULL;
    getConnection($con);
	global $chosen_date;
	//Note that we have to include date in this SQL to be complete
	$sqlQuery = "SELECT count(*) as 'CONFIRMED' from status_table st, status_flag_values sfv where sfv.status_type = 'Confirmed' and st.chequedate = '".$chosen_date."' and sfv.status_flag = st.status_flag and st.lock_pf = '".$PFIndex."'";
	$query=mysqli_query($con,$sqlQuery);
	$row = mysqli_fetch_array($query);
    $no_entries = $row['CONFIRMED'];
	mysqli_close($con);
	return $no_entries;
}
function getConnection(&$con)
{
	$con = new mysqli("localhost", "root", "", "ccpc_hvt_instruments");
    if ($con->connect_errno) {
        die("Connection failed: " . $conn->connect_error);
    }
}
?>
</html>