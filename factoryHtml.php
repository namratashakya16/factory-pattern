<?php 
/* 
Template Name: Factory design
*/

get_header();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Factory Design Pattern</title>
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
<center><h3>welcome to Veg Restaurant</h3>
	<br><br>
	<form>
<div class="form-group col-md-6">
  <label for="sel1">Thali list:</label>
  <select class="form-control thali" id="thali">
    <option value="GujaratiThali">Gujarati Thali</option>
    <option value="PunjabiThali">Punjabi Thali</option>    
  </select>
</div>  
<button type="button" class="orderThali btn btn-primary">Thali</button>
</form>
<center><div class="form-group res col-md-6">	
</div></center>
</body>
</html>
<?php
get_footer();

