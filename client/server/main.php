
<?php
  session_start();
  require("connect.php"); //optional
  if(!isset($_SESSION["getLogin"])){
     header("location:login.php");
  } else {
?>

<html>
    <head><title>Admin Page</title></head>
    <body>

    <form action='addInput.php' method='post'>
        <input type="submit" name="addInput" value="Add via Input"/>
    </form>

    <form action='addXML.php' method='post'>
        <input type="submit" name="addXML" value="Add via XML file"/>
    </form>

    <form action='update.php' method='post'>
        <input type="submit" name="update" value="Update Record"/>
    </form>

    <form action='delete.php' method='post'>
        <input type="submit" name="delete" value="Delete Record"/>
    </form>

    <form action='report.php' method='post'>
        <input type="submit" name="report" value="Generate a Report"/>
    </form>

        <form action="login.php" method="get">

        <?php
        error_reporting(E_ERROR | E_PARSE);
        $user_id = $_SESSION['getLogin'];

        echo "USER ID:".$user_id;
        

        $studQuery = mysqli_query($conn, "SELECT f.foodCode AS foodCode, f.name AS name, f.category AS category, f.price AS price FROM food f");
        if($user_id != null){
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
            <?php
        }else{
            echo "<h2> User ID Not found! </h2> </br>";
        }
        ?>
                

        </table>

        <input type="submit" value="Logout" name="LogoutBtn">
        </form>
<?php
  }
?>
</body>
</html>