<?php
  session_start();
  require("connect.php"); //optional
  if(!isset($_SESSION["getLogin"])){
     header("location:login.php");
  } else {
?>

<html>
<head><title>Add Menu and Combos</title></head>
<body bgcolor="#ffccff">


<h2> Add New Menu </h2>
<hr>
<form action='<?php echo $_SERVER["PHP_SELF"];?>' method='post'>
<table border='1' bgcolor='#ccccff' width='5%'>

<?php
  
  if(isset($_POST["foodBtn"])){
  
  $name = $_SESSION["foodname"];
  $category = $_POST["category"];
  $price = $_POST["price"];

  $studQuery = mysqli_query($conn, "SELECT MAX(foodCode)+1 AS max FROM food");
  $max = mysqli_fetch_assoc($studQuery);
  $max = $temp['max'];

  
  $insert = "INSERT INTO food VALUES ($max, '".$_SESSION["getLogin"]."', '$code') ";
  mysqli_query($conn, $insert);
  echo "Record has been successfully inserted! </br>";

  } else {
	  echo "Failed to insert record!!!</br>";
  }
  
?>
<?php

echo "Name of food: <input type=\"text\" name=\"foodname\" size=\"25\"/>";
echo "Category: <input type=\"text\" name=\"category\" size=\"25\"/>";
echo "Price: <input type=\"text\" name=\"price\" size=\"25\"/>";
?>

<tr><td colspan='1'><input type='submit' value='Add Food' name='foodBtn' /></td></tr>
</table>


<?php
}
?>

</form>
</body>
</html>