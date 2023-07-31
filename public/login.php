<html>
<head><title>Student Form</title></head>
<body>

<h2>Student Registration Form</h2>
<form method="post" action="check.php">

<table>
<tr>
  <td>Enter username:</td> 
  <td><input type="text" name="username" size="25"/></td>
</tr>
<tr>
    <td>Enter password:</td> 
    <td><input type="text" name="password" size="25"/></td>
    <tr><td colspan="2" align="center"><input type="submit" value="Login" name="loginBtn"/></td>
    </form>
  </tr>

</table>	  

<?php
      if(isset($_GET["error"])) {
          $error=$_GET["error"];
  
        //this line will be called by the check.php if the login credentials are incorrect 
         if ($error==1) {
            echo "<p align='center'>Username and/or password invalid<br/></p>"; 
		   }
      }
 
   ?>

</body>
</html>