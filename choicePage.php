<!DOCTYPE html>
<head>
  <script type="text/javascript" src="js/jquery-latest.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="css/jquery-ui.min.css">
  <link rel="stylesheet" href="css/globalStyles.css">
  <link rel="stylesheet" href="css/pure-min.css">
  <?php
	session_start();
	
  ?>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
  <style>
 
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
<br/><br/>
<form id="formid" action="processChoice.php" method="post"  class="pure-form pure-form-aligned">
	<div id="searchPanel">
		 <div class="pure-control-group">
		   <label for="datepicker">Cheque Date : </label><input type="text" id="datepicker" name="datepicker">
		 </div>
		 <div class="pure-control-group">
		  <label for="circleMenu">Choose the circle : </label>
		 <select id="circleMenu" name="circleName">
		   <option value="Chennai">Chennai</option>
		   <option value="Hyderabad">Hyderabad</option>
		   <option value="Bangalore">Bangalore</option>
		   <option value="Bhuvaneshwar">Bhuvaneshwar</option>
		   <option value="Kolkata">Kolkata</option>
		 </select>
		 </div>
		 <div class="pure-controls">
		 <input type="submit" class="pure-button pure-button-primary" name="filterButton" id="filterButton" value="submit" />
		 </div>
	</div>
</form>
</body>