<!DOCTYPE html>
<head>
  <script type="text/javascript" src="js/jquery-latest.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="css/jquery-ui.min.css">
  <link rel="stylesheet" href="css/globalStyles.css">
  <link rel="stylesheet" href="css/pure-min.css">
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
    border:solid 1px #BFBDBD;
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
   <div id="header">
       <div style="margin-left:40%;display:inline-block;">SBI CCPC,CHENNAI</div>
       <div style="display:inline-block;float:right;"> Sample PF No (<a>Logout</a>)</div>
   </div>
   <div>
     <iframe src='' style="height:5em;width:100%;" ></iframe>
   </div>
   <div id="searchPanel">
     <div style="display:inline-block;">
       Cheque Date: <input type="text" id="datepicker" style="width:40%">
     </div>
     <select id="circleMenu">
       <option value="Chennai">Chennai</option>
       <option value="Hyderabad">Hyderabad</option>
       <option value="Bangalore">Bangalore</option>
       <option value="Bhuvaneshwar">Bhuvaneshwar</option>
       <option value="Kolkata">Kolkata</option>
     </select>
     <input type="button" name="filterButton" id="filterButton" value="submit" />
   </div>

   <div id="chequeImagePanel">
     <img id="chequeImage" src="sample.jpg" height=300 width=660 />
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
     <select id="callStatus">
       <option value="cc">Contacted Customer</option>
       <option value=cbp>Contacted branch through phone</option>
       <option value="cbm">Contacted branch through mail</option>
       <option value="pb">Customer number busy</option>
       <option value="pnr">Customer number not reachable</option>
     </select>
   </div>
   <br/><br/>
   <div>
     <input type="button" name="prevButton" id="prevButton" value="Previous" />
     <input type="button" name="nextButton" id="nextButton" value="Next" />
   </div>
</body>
</html>
