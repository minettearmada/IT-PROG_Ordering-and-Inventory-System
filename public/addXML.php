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

    

    

    
    


    ?>


    <h2>Add via XML file containing food data:</h2>
    <form method="post" action='<?php echo $_SERVER["PHP_SELF"];?>' enctype="multipart/form-data">
    <?php

    $count = 0;
    if(isset($_POST["uploadFood"])){
        if(isset($_FILES["xmlFilefood"])) {
        $xmlFile = $_FILES["xmlFilefood"]["tmp_name"];
        $foodexists = false;
        $imageIDexists = false;
            if(file_exists($xmlFile)){
            $xml = simplexml_load_file($xmlFile);
            foreach($xml->food as $food){
                $studQuery = mysqli_query($conn, "SELECT f.foodCode AS foodCode, f.name AS name, f.category AS category, f.price AS price, f.imageID as imageID FROM food f");
                $studQuery2 = mysqli_query($conn, "SELECT i.imageID AS imageID, i.originalName AS originalName, i.mime_type AS mime_type, i.image_data AS image_data FROM images i");   
                $foodexists = false;
                $imageIDexists = false;           
                while($studResult = mysqli_fetch_assoc($studQuery)){
                    if($food->name == $studResult['name']){
                    echo $food->name." STUDRESULT ".$studResult['name']."<br>";
                    echo "Food already exists <br>";
                    $foodexists = true;
                    break;
                    }else{
                    echo "Food does not exist <br>";
                    }

                }

                
                while($studResult2 = mysqli_fetch_assoc($studQuery2)){
                    if($food->imageID == $studResult2['imageID']){
                        echo $food->imageID." STUDRESULT ".$studResult2['imageID']."<br>";
                        echo "Image exists <br>";
                        $imageIDexists = true;
                        break;
                        }else{
                        echo "Image does not exist <br>";
                        }
                }
                
                if($foodexists == false && $imageIDexists == true){
                    $foodCode = $food->foodCode;
                    $name = $food->name;
                    $category = $food->category;
                    $price = $food->price;
                    $imageID = $food->imageID;
                    $insert = "INSERT INTO food VALUES ($foodCode, '$name', '$category', $price, $imageID)";
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

    ?>


        <input type="file" name="xmlFilefood" required>
        <input type="submit" name="uploadFood" value="Upload Food Data">
    </form>



    <h2>Add via XML file containing combo data:</h2>
    <form method="post" action='<?php echo $_SERVER["PHP_SELF"];?>' enctype="multipart/form-data">


    <?php
    if(isset($_POST["uploadCombo"])){
        if(isset($_FILES["xmlFilecombo"])) {
        $xmlFile = $_FILES["xmlFilecombo"]["tmp_name"];
        $comboexists = false;
            if(file_exists($xmlFile)){
            $xml = simplexml_load_file($xmlFile);
            foreach($xml->combos as $combos){
                $comboexists = false;
                $studQuery = mysqli_query($conn, "SELECT c.comboID AS comboID, c.name AS name, c.mainCode AS mainCode, c.sideCode AS sideCode, c.drinkCode AS drinkCode, c.comboPrice as comboPrice FROM combos c");
                while($studResult = mysqli_fetch_assoc($studQuery)){
                    if($combos->name == $studResult['name']){
                    echo $combos." STUDRESULT ".$studResult['name']."<br>";
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

                    $comboID = $combos->comboID;
                    $name = $combos->name;
                    $mainCode = $combos->mainCode;
                    $sideCode = $combos->sideCode;
                    $drinkCode = $combos->drinkCode;
                    while($studResult = mysqli_fetch_assoc($studQuery)){
                        if($mainCode == $studResult['foodCode'] && $mainexists == false){
                            $mainexists = true;           
                        }

                        if($sideCode == $studResult['foodCode'] && $sideexists == false){
                            $sideexists = true;
                        }

                        if($drinkCode == $studResult['foodCode'] && $drinkexists == false){
                            $drinkexists = true;
                        }

                    }
                    $comboPrice = $combos->comboPrice;

                    if($mainexists == true && $sideexists == true && $drinkexists == true){
                        $insert = "INSERT INTO combos VALUES ($comboID, '$name', $mainCode, $sideCode, $drinkCode, $comboPrice)";
                        if(mysqli_query($conn, $insert)){
                            echo "Record has been successfully inserted! </br>";
                        }else{
                            echo "Failed to insert record!!!</br>";
                        }
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

    ?>


        <input type="file" name="xmlFilecombo" required>
        <input type="submit" name="uploadCombo" value="Upload Combo Data">
    </form>


    <?php
    $studQuery = mysqli_query($conn, "SELECT f.foodCode AS foodCode, f.name AS name, f.category AS category, f.price AS price, f.imageID as imageID FROM food f");
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