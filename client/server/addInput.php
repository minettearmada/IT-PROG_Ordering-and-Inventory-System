<?php
  session_start();
  require("connect.php"); //optional
  if(!isset($_SESSION["getLogin"])){
     header("location:login.php");
  } else {
?>

<html>
<head><title>Add Menu and Combos via Input</title></head>
<body bgcolor="#ffccff">


<h2> Add New Menu </h2>
<hr>
<form action='<?php echo $_SERVER["PHP_SELF"];?>' method='post'>
<table border='1' bgcolor='#ccccff' width='5%'>

<?php
  
  if(isset($_POST["foodBtn"])){
  
  $name = $_POST["foodname"];
  $category = $_POST["category"];
  $price = $_POST["price"];


  
  $insert = "INSERT INTO food VALUES ('$name', '$category', $price)";
  mysqli_query($conn, $insert);
  echo "Record has been successfully inserted! </br>";

  } else {
	  echo "Failed to insert record!!!</br>";
  }
  
?>
<?php

echo "Name of food: <input type=\"text\" name=\"foodname\" size=\"25\" required/>";
echo "Category: <select name=\"category\" required>";
echo "<option value=\"M\">Main</option>";
echo "<option value=\"S\">Side</option>";
echo "<option value=\"D\">Dessert</option>";
echo "</select>";
echo "Price: <input type=\"number\" step=\"0.01\" min=\"0\" name=\"price\" size=\"25\" required/>";
?>

<tr><td colspan='1'><input type='submit' value='Add Food' name='foodBtn' /></td></tr>
</table>

</form>



<h2> Add New Combos </h2>
<hr>
<form action='<?php echo $_SERVER["PHP_SELF"];?>' method='post'>
<table border='1' bgcolor='#ccccff' width='5%'>

<?php
  
  if(isset($_POST["comboBtn"])){
  
  $comboName = $_POST["comboName"];
  $main = $_POST["main"];
  $side = $_POST["side"];
  $dessert = $_POST["dessert"];
  $comboPrice = $_POST["comboPrice"];

  
  $insert = "INSERT INTO combos VALUES ('$name', '$main', '$side', '$dessert', $comboPrice)";
  mysqli_query($conn, $insert);
  echo "Record has been successfully inserted! </br>";

  } else {
	  echo "Failed to insert record!!!</br>";
  }
  
?>
<?php

echo "Name of combo: <input type=\"text\" name=\"comboName\" size=\"25\" required/>";

echo "Main: <select name=\"main\" required>";
$studQuery = mysqli_query($conn, "SELECT f.foodCode AS foodCode, f.name AS name, f.category AS category, f.price AS price FROM food f WHERE f.category = 'M'");
while($studResult = mysqli_fetch_assoc($studQuery)){
    echo "<option value=\"".$studResult['foodCode']."\">".$studResult['name']."</option>";
}
echo "</select>";

echo "Side: <select name=\"side\" required>";
$studQuery = mysqli_query($conn, "SELECT f.foodCode AS foodCode, f.name AS name, f.category AS category, f.price AS price FROM food f WHERE f.category = 'S'");
while($studResult = mysqli_fetch_assoc($studQuery)){
    echo "<option value=\"".$studResult['foodCode']."\">".$studResult['name']."</option>";
}
echo "</select>";

echo "Main: <select name=\"dessert\" required>";
$studQuery = mysqli_query($conn, "SELECT f.foodCode AS foodCode, f.name AS name, f.category AS category, f.price AS price FROM food f WHERE f.category = 'D'");
while($studResult = mysqli_fetch_assoc($studQuery)){
    echo "<option value=\"".$studResult['foodCode']."\">".$studResult['name']."</option>";
}
echo "</select>";


echo "Price: <input type=\"number\" step=\"0.01\" min=\"0\" name=\"comboPrice\" size=\"25\" required/>";
?>

<tr><td colspan='1'><input type='submit' value='Add Combo' name='comboBtn' /></td></tr>
</table>

</form>

<?php
    $studQuery = mysqli_query($conn, "SELECT f.foodCode AS foodCode, f.name AS name, f.category AS category, f.price AS price FROM food f");
    ?>
            <h2>Food Record</h2>
        <table border="1" width="50%">
            <tr bgcolor="#FLE5EB">
                <th>foodCode</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
            </tr>
            <?php
            while($studResult = mysqli_fetch_assoc($studQuery)){
                echo "<tr>";
                echo "<td>".$studResult['foodCode']."</td>";
                echo "<td>".$studResult['name']."</td>";
                echo "<td>".$studResult['category']."</td>";
                echo "<td>".$studResult['price']."</td>";
            }


        ?>
        </table>
        <h2>Combos</h2>
        <table border="1" width="50%">
            <tr bgcolor="#FLE5EB">
                <th>comboID</th>
                <th>Name</th>
                <th>mainCode</th>
                <th>sideCode</th>
                <th>drinkCode</th>
                <th>comboPrice</th>
            </tr>

            <?php
            $studQuery = mysqli_query($conn, "SELECT c.comboID AS comboID, c.name AS name, c.mainCode AS mainCode, c.sideCode AS sideCode, c.drinkCode AS drinkCode, c.comboPrice as comboPrice FROM combos c");
            while($studResult = mysqli_fetch_assoc($studQuery)){
                echo "<tr>";
                echo "<td>".$studResult['comboID']."</td>";
                echo "<td>".$studResult['name']."</td>";
                echo "<td>".$studResult['mainCode']."</td>";
                echo "<td>".$studResult['sideCode']."</td>";
                echo "<td>".$studResult['drinkCode']."</td>";
                echo "<td>".$studResult['comboPrice']."</td>";
            }

        ?>
        </table>


<form action='main.php' method='post'>
    <tr><td colspan='1'><input type='submit' value='Back to Main Page' name='backBtn' /></td></tr>
</form>

<?php
}
?>
</body>
</html>