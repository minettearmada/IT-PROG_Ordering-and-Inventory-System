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

<h3>Add New Menu Item</h3>
    <form method="post">
        Item Name: <input type="text" name="item_name" required><br>
        Category: <input type="text" name="item_category" required><br>
        Price: <input type="number" step="0.01" name="item_price" required><br>
        <input type="submit" name="add_item" value="Add Item">
    </form>

    <!-- Form to upload XML data -->
    <h3>Upload Menu Items via XML</h3>
    <form method="post" enctype="multipart/form-data">
        Select XML File: <input type="file" name="xml_file" accept=".xml" required><br>
        <input type="submit" value="Upload XML">
    </form>


    


<?php
}
?>

</form>
</body>
</html>