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


<h2> Delete Food Data </h2>
<hr>
<form action='<?php echo $_SERVER["PHP_SELF"];?>' method='post'>
<table border='1' bgcolor='#ccccff' width='5%'>

<?php
  
    if(isset($_POST["delFoodBtn"])){

    $foodCode = $_POST["foodCode"];
    $deleteQuery = "DELETE FROM food WHERE foodCode = $foodCode";
    mysqli_query($conn, $deleteQuery);
    echo "Record has been successfully deleted! </br>";

    } else {
        echo "Failed to delete record!!!</br>";
    }
  
?>


<?php

echo "foodID to delete: <select name=\"foodCode\">";
$studQuery = mysqli_query($conn, "SELECT f.foodCode AS foodCode, f.name AS name, f.category AS category, f.price AS price, f.imageID as imageID FROM food f");
while($studResult = mysqli_fetch_assoc($studQuery)){
    echo "<option value=\"".$studResult['foodCode']."\">".$studResult['foodCode']."</option>";
}
echo "</select>";
?>

<tr><td colspan='1'><input type='submit' value='Delete Food Data' name='delFoodBtn' /></td></tr>
</table>

</form>



<form action='<?php echo $_SERVER["PHP_SELF"];?>' method='post'>
<table border='1' bgcolor='#ccccff' width='5%'>

<h2> Delete Combo Data </h2>
<hr>

<?php

if(isset($_POST["delComboBtn"])){
  
    $comboID = $_POST["comboID"];
    $deleteQuery = "DELETE FROM combos WHERE comboID = $comboID";
    mysqli_query($conn, $deleteQuery);
    echo "Record has been successfully deleted! </br>";

    } else {
        echo "Failed to delete record!!!</br>";
    }

?>

<?php
echo "comboID to edit: <select name=\"comboID\" required>";
$studQuery = mysqli_query($conn, "SELECT c.comboID AS comboID, c.name AS name, c.mainCode AS mainCode, c.sideCode AS sideCode, c.drinkCode AS drinkCode, c.comboPrice as comboPrice FROM combos c");
while($studResult = mysqli_fetch_assoc($studQuery)){
    echo "<option value=\"".$studResult['comboID']."\">".$studResult['comboID']."</option>";
}
echo "</select>";
?>

<tr><td colspan='1'><input type='submit' value='Delete Combo Data' name='delComboBtn' /></td></tr>
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