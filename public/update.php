<?php
  session_start();
  require("connect.php"); //optional
  if(!isset($_SESSION["getLogin"])){
     header("location:login.php");
  } else {
?>

<html>
<head><title>Update Menu and Combos</title></head>
<body bgcolor="#ffccff">


<h2> Update Food Data </h2>
<hr>
<form action='<?php echo $_SERVER["PHP_SELF"];?>' method='post'>
<table border='1' bgcolor='#ccccff' width='5%'>

<?php
  
    if(isset($_POST["updFoodBtn"])){

    $foodCode = $_POST["foodCode"];
    $name = $_POST["foodname"];
    $category = $_POST["category"];
    $price = $_POST["price"];
    $image = $_POST["image"];

    $update = "UPDATE food SET name = \"$name\", category = \"$category\", price = \"$price\", imageID = $image WHERE foodCode = $foodCode";
    mysqli_query($conn, $update);
    echo "Record has been successfully modified! </br>";

    } else {
        echo "Failed to update record!!!</br>";
    }
  
?>


<?php

echo "foodID to edit: <select name=\"foodCode\">";
$studQuery = mysqli_query($conn, "SELECT f.foodCode AS foodCode, f.name AS name, f.category AS category, f.price AS price, f.imageID as imageID FROM food f");
while($studResult = mysqli_fetch_assoc($studQuery)){
    echo "<option value=\"".$studResult['foodCode']."\">".$studResult['foodCode']."</option>";
}
echo "</select>";

echo "Name of food: <input type=\"text\" name=\"foodname\" size=\"25\" required/>";
echo "Category: <select name=\"category\" required>";
echo "<option value=\"M\">Main</option>";
echo "<option value=\"S\">Side</option>";
echo "<option value=\"D\">Dessert</option>";
echo "</select>";
echo "Price: <input type=\"number\" step=\"0.01\" min=\"0\" name=\"price\" size=\"25\" required/>";

echo "Image: <select name=\"image\" required>";
echo "<option value=\"\"></option>";
$studQuery = mysqli_query($conn, "SELECT i.imageID AS imageID, i.originalName AS originalName, i.mime_type AS mime_type, i.image_data AS image_data FROM images i");
while($studResult = mysqli_fetch_assoc($studQuery)){
  echo "<option value=\"".$studResult['imageID']."\">".$studResult['imageID']."</option>";
}
echo "</select>";
?>

<tr><td colspan='1'><input type='submit' value='Update Food' name='updFoodBtn' /></td></tr>
</table>

</form>



<form action='<?php echo $_SERVER["PHP_SELF"];?>' method='post'>
<table border='1' bgcolor='#ccccff' width='5%'>

<h2> Update Combo Data </h2>
<hr>

<?php

if(isset($_POST["updComboBtn"])){
  
    $comboID = $_POST["comboID"];
    $comboName = $_POST["comboName"];
    $main = $_POST["main"];
    $side = $_POST["side"];
    $drink = $_POST["drink"];
    $comboPrice = $_POST["comboPrice"];


    $update = "UPDATE combos SET name = \"$comboName\", mainCode = \"$main\", sideCode = \"$side\", drinkCode = \"$drink\", comboPrice = \"$comboPrice\" WHERE comboID = $comboID";
    mysqli_query($conn, $update);
    echo "Record has been successfully updated! </br>";

    } else {
        echo "Failed to update record!!!</br>";
    }

?>

<?php
echo "comboID to edit: <select name=\"comboID\" required>";
$studQuery = mysqli_query($conn, "SELECT c.comboID AS comboID, c.name AS name, c.mainCode AS mainCode, c.sideCode AS sideCode, c.drinkCode AS drinkCode, c.comboPrice as comboPrice FROM combos c");
while($studResult = mysqli_fetch_assoc($studQuery)){
    echo "<option value=\"".$studResult['comboID']."\">".$studResult['comboID']."</option>";
}
echo "</select>";

echo "Name of combo: <input type=\"text\" name=\"comboName\" size=\"25\" required />";

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

echo "Drink: <select name=\"drink\" required>";
$studQuery = mysqli_query($conn, "SELECT f.foodCode AS foodCode, f.name AS name, f.category AS category, f.price AS price FROM food f WHERE f.category = 'D'");
while($studResult = mysqli_fetch_assoc($studQuery)){
    echo "<option value=\"".$studResult['foodCode']."\">".$studResult['name']."</option>";
}
echo "</select>";


echo "Price: <input type=\"number\" step=\"0.01\" min=\"0\" name=\"comboPrice\" size=\"25\" required/>";
?>

<tr><td colspan='1'><input type='submit' value='Update Combo' name='updComboBtn' /></td></tr>
</table>

</form>


<?php
$studQuery = mysqli_query($conn, "SELECT f.foodCode AS foodCode, f.name AS name, f.category AS category, f.price AS price, imageID as imageID FROM food f");
?>
            <h2>Food Record</h2>
        <table border="1" width="50%">
            <tr bgcolor="#FLE5EB">
                <th>foodCode</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>imageID</th>
            </tr>
            <?php
            while($studResult = mysqli_fetch_assoc($studQuery)){
                echo "<tr>";
                echo "<td>".$studResult['foodCode']."</td>";
                echo "<td>".$studResult['name']."</td>";
                echo "<td>".$studResult['category']."</td>";
                echo "<td>".$studResult['price']."</td>";
                echo "<td>".$studResult['imageID']."</td>";
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

        <h2>Images</h2>
        <table border="1" width="50%">
            <tr bgcolor="#FLE5EB">
                <th>imageID</th>
                <th>originalName</th>
                <th>mime_type</th>
                <th>image_data</th>
            </tr>

            <?php
            $studQuery = mysqli_query($conn, "SELECT i.imageID AS imageID, i.originalName AS originalName, i.mime_type AS mime_type, i.image_data AS image_data FROM images i");
            while($studResult = mysqli_fetch_assoc($studQuery)){
                echo "<tr>";
                echo "<td>".$studResult['imageID']."</td>";
                echo "<td>".$studResult['originalName']."</td>";
                echo "<td>".$studResult['mime_type']."</td>";
                echo "<td>".$studResult['image_data']."</td>";
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