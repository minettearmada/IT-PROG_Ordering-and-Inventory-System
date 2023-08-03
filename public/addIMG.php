<?php
  session_start();
  require("connect.php"); //optional
  if(!isset($_SESSION["getLogin"])){
     header("location:login.php");
  } else {
?>

<html>
<head><title> Add Food Images </title></head>
<link rel="stylesheet" href="style3.css">

<body>
    <header> 
        <img class="logo" src="logo.svg" alt="logo" height="80">
        <h1 style="color: white; text-align: center;"> &nbsp; Bite-By-Bytes </h1>
    </header>

<h2> Upload an image: </h2>
<hr>
<form action='<?php echo $_SERVER["PHP_SELF"];?>' method='post' enctype="multipart/form-data">
<table border='1' bgcolor='#ccccff' width='5%'>

<input type="file" name="imageFile" required>
<input type="submit" name="uploadBtn" value="Upload">

<?php

if (isset($_POST['uploadBtn']) && isset($_FILES["imageFile"])) {
    echo "Uploading an image...<br>";

    $targetDirectory = "assets/"; // Relative path to the directory where you want to save the uploaded images
    $targetFile = $targetDirectory . basename($_FILES["imageFile"]["name"]);
    $originalName = basename($_FILES["imageFile"]["name"]);

    // Check if the file is an actual image
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
        echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
        exit();
    }

    $studQuery = mysqli_query($conn, "SELECT MAX(imageID)+1 AS max FROM images");
    $temp = mysqli_fetch_assoc($studQuery);
    $max = $temp['max'];

    // Get the MIME type of the uploaded file
    $mime_type = $_FILES["imageFile"]["type"];

    // Rename the uploaded file to "image1.jpg"
    $newFilename = "image".$max.".".$imageFileType;
    $targetFile = $targetDirectory . $newFilename;

    echo "targetFile: " . $targetFile . "<br>";


    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $targetFile)) {
        echo "Image uploaded and saved successfully.";
        echo "MIME Type: " . $mime_type;
    } else {
        echo "Error uploading the image.";
    }


    // Insert the image details to the database
    $insert = "INSERT INTO images VALUES ($max, '$originalName', '$mime_type', '$targetFile')";
    if (mysqli_query($conn, $insert)) {
        echo "Record has been successfully inserted! </br>";
    } else {
        echo "Error inserting record: " . mysqli_error($conn);
    }
}
?>




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