<!DOCTYPE html>
<html>
  <head>
    <link href="styles2.css" rel="stylesheet">
  </head>

  <body>
  <div class="parent">
    <div class="block1">
      <h2>Registration Page</h2>
      <a href="index.php">Click here to go back</a><br/><br/>
      <form action="register.php" method="POST">
        <input type="text" name="username" required="required" placeholder="username"/> <br/>
        <input type="password" name="password" required="required" placeholder="password"/> <br/>
        <input type="password" name="confirm_password" required="required" placeholder="confirm password"/><br/>
        <input type="submit" value="Register"/>
      </form>
    </div>
  </div>

<?php if($_SERVER["REQUEST_METHOD"] == "POST"){
 $username = mysql_real_escape_string($_POST['username']);
 $password = mysql_real_escape_string($_POST['password']);
 $confirm_password = mysql_real_escape_string($_POST['confirm_password']);
 $bool = true;

 if ($_POST["password"] != $_POST["confirm_password"]) die("Passwords do not match");

 mysql_connect("localhost", "root", "") or die(mysql_error());
 mysql_select_db("DB") or die("Cannot connect to database");
 $query = mysql_query("Select * from users");
 while($row = mysql_fetch_array($query))
 {
$table_users = $row['username'];
if($username == $table_users)
{
 $bool = false;
 Print '<script>alert("Username has been taken!");</script>';
 Print '<script>window.location.assign("register.php");</script>';
}
 }

 if($bool)
 {
mysql_query("INSERT INTO users (username, password) VALUES ('$username', '$password')");
Print '<script>alert("Successfully Registered!");</script>';
Print '<script>window.location.assign("index.php");</script>';
 }
} ?>

  </body>
 </html>