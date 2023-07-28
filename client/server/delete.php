<?php
session_start();
require("connect.php");
?>

<html>
<head><title>Using the Delete Statement</title></head>
<body bgcolor="#89CFF0">
<h2> Delete a Record </h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php
if(isset($_POST["enter"])){
  
  $studQuery = mysqli_query($conn, "SELECT num, id, code FROM tblenlist WHERE id = ".$_SESSION["getLogin"]." AND code = \"".$_POST['subjectcode']."\"");
  while($studResult = mysqli_fetch_assoc($studQuery)){
    $num = $studResult['num'];
    $id = $_SESSION["getLogin"];
    $code = $_POST['subjectcode'];
  }

	 mysqli_query($conn, "DELETE FROM tblenlist WHERE num='".$num."' AND id='".$id."' AND code='".$code."'");
		 echo "<p>This record has been deleted from the database!</p><br>";
     
}else{
    echo "Failed to delete record!!!<br>";
}	 
?>

<?php
$studQuery = mysqli_query($conn, "SELECT DISTINCT sub.code AS code, sub.title AS title FROM tblstudent s JOIN tblenlist e ON e.id = s.id JOIN tblsubject sub ON e.code = sub.code WHERE e.id = ".$_SESSION["getLogin"]);
echo "Subject: <select name='subjectcode' value='subjectcode'>";
while($studResult = mysqli_fetch_assoc($studQuery)){
        echo "<option value=".$studResult['code'].">".$studResult['code']."</option>";
  } 


?>
<input type="submit" name="enter" value="Enter" /><br /><br />


</body>
</html>
