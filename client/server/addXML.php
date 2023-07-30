<?php
  session_start();
  require("connect.php"); //optional
  if(!isset($_SESSION["getLogin"])){
     header("location:login.php");
  } else {
?>


<html>
<head>
    <title>Upload XML and Insert Data</title>
</head>
<body>




    <?php
    if(isset($_POST["uploadFood"])){
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["xmlFilefood"])) {
        $xmlFile = $_FILES["xmlFilefood"]["tmp_name"];
        $foodexists = false;
        $studQuery = mysqli_query($conn, "SELECT f.foodCode AS foodCode, f.name AS name, f.category AS category, f.price AS price FROM food f");
        if(isset($POST_["xmlFilefood"])){
            if(file_exists($xmlFile)){
            $xml = simplexml_load_file($xmlFile);
            foreach($xml->food as $food){
                $foodexists = false;
                while($studResult = mysqli_fetch_assoc($studQuery)){
                    if($food->name == $studResult['name']){
                    echo $food." STUDRESULT ".$studResult['name']."<br>";
                    echo "Food already exists <br>";
                    $foodexists = true;
                    break;
                    }else{
                    echo "Subject does not exist <br>";
                    }
                }
                
                if($foodexists == false){
                    $name = $food->name;
                    $category = $food->category;
                    $price = $food->price;
                    $insert = "INSERT INTO food VALUES ('$name', '$category', '$price')";
                    mysqli_query($conn, $insert);
                    echo "Record has been successfully inserted! </br>";
                }
                    
    
            }
            echo "XML file has been successfully uploaded and inserted! </br>";

            }else{
                echo "File does not exist";
            }
    
        }


        }
    }
    

    

    if(isset($_POST["uploadCombo"])){
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["xmlFilecombo"])) {
        $xmlFile = $_FILES["xmlFilecombo"]["tmp_name"];
        $comboexists = false;
        $studQuery = mysqli_query($conn, "SELECT c.comboID AS comboID, c.name AS name, c.mainCode AS mainCode, c.sideCode AS sideCode, c.drinkCode AS drinkCode, c.comboPrice as comboPrice FROM combos c");
        if(isset($POST_["xmlFilecombo"])){
            if(file_exists($xmlFile)){
            $xml = simplexml_load_file($xmlFile);
            foreach($xml->combo as $combo){
                $comboexists = false;
                while($studResult = mysqli_fetch_assoc($studQuery)){
                    if($combo->name == $studResult['name']){
                    echo $combo." STUDRESULT ".$studResult['name']."<br>";
                    echo "Combo already exists <br>";
                    $comboexists = true;
                    break;
                    }else{
                    echo "Combo does not exist <br>";
                    }
                }
                
                if($comboexists == false){
                    $studQuery = mysqli_query($conn, "SELECT f.foodCode AS foodCode, f.name AS name, f.category AS category, f.price AS price FROM food f");
                    $mainexists = false;
                    $sideexists = false;
                    $drinkexists = false;
                    $name = $combo->name;
                    $mainCode = $combo->mainCode;
                    $sideCode = $combo->sideCode;
                    $drinkCode = $combo->drinkCode;
                    while($studResult = mysqli_fetch_assoc($studQuery)){
                        if($mainCode == $studResult['foodCode']){
                            $mainexists = true;                        
                        }else{
                            $mainexists = false;
                            echo $mainCode." foodCode does not exist in food data <br>";
                        }
                        if($sideCode == $studResult['foodCode']){
                            $sideexists = true;
                        }else{
                            $sideexists = false;
                            echo $sideCode." foodCode does not exist in food data <br>";
                        }
                        if($drinkCode == $studResult['foodCode']){
                            $drinkexists = true;
                        }else{
                            $drinkexists = false;
                            echo $drinkCode." foodCode does not exist in food data <br>";
                        }
                    }
                    $comboPrice = $combo->comboPrice;

                    if($mainexists == true && $sideexists == true && $drinkexists == true){
                        $insert = "INSERT INTO combos VALUES ('$name', '$mainCode', '$sideCode', '$drinkCode', '$comboPrice')";
                        mysqli_query($conn, $insert);
                        echo "Record has been successfully inserted! </br>";
                    }
                    
                }
                    
    
            }
            echo "XML file has been successfully uploaded and inserted! </br>";

            }else{
                echo "File does not exist";
            }
    
        }


        }
    }


    


    ?>


    <h2>Add via XML file containing food data:</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="xmlFilefood" required>
        <input type="submit" name="uploadFood" value="Upload Food Data">
    </form>

    <h2>Add via XML file containing combo data:</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="xmlFile" required>
        <input type="submit" name="uploadCombo" value="Upload Combo Data">
    </form>


    <?php
    $studQuery = mysqli_query($conn, "SELECT f.foodCode AS foodCode, f.name AS name, f.category AS category, f.price AS price FROM food f");
    ?>
            <h2>Food Record</h2>
        <table border="1" width="50%">
            <tr bgcolor="#FLE5EB">
                <th>foodID</th>
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