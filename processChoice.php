<?php
if( isset($_POST['datepicker']) && isset($_POST["circleName"]) && $_POST["datepicker"] != "" && $_POST["circleName"] != "")
{
     $_SESSION["chequeDate"] = $_POST['datepicker'];
	 $_SESSION["circleName"] = $_POST["circleName"];
	 ?> <meta http-equiv="refresh" content="0;URL=mainpage.php"> <?php
}
else
{
	?> <meta http-equiv="refresh" content="0;URL=choicePage.php"> <?php
}
?>