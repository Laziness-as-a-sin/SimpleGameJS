<?php
    session_start();
    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string($_POST['password']);
    $bool = true;

    mysql_connect("localhost", "root", "") or die (mysql_error()); //Connect to server
    mysql_select_db("DB") or die ("Cannot connect to database"); //Connect to database
    $query = mysql_query("Select * from users WHERE username='$username'"); // Query the users table
    $exists = mysql_num_rows($query); //Checks if username exists
    $table_users = "";
    $table_password = "";
    if($exists > 0) //IF there are no returning rows or no existing username
    {
       while($row = mysql_fetch_assoc($query)) // display all rows from query
       {
          $table_users = $row['username']; // the first username row is passed on to $table_users, and so on until the query is finished
          $table_password = $row['password']; // the first password row is passed on to $table_password, and so on until the query is finished
       }
       if(($username == $table_users) && ($password == $table_password))// checks if there are any matching fields
       {
          if($password == $table_password)
          {
             $_SESSION['user'] = $username; //set the username in a session. This serves as a global variable
             header("location: sindex.php"); // redirects the user to the authenticated home page
          }
       }
       else
       {
        Print '<script>alert("Incorrect Password!");</script>'; // Prompts the user
        Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
       }
    }
    else
    {
        Print '<script>alert("Incorrect username!");</script>'; // Prompts the user
        Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
    }
?>
<?php
    session_start();
    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string($_POST['password']);

    mysql_connect("localhost:3306", "u0346_admin", "admin") or die (mysql_error());
    mysql_select_db("u0346744_BD") or die ("Cannot connect to database");
$q = mysql_query("SELECT count(*) FROM users WHERE username='$username' and password='$password'");

if(mysql_result($q,0)==1) {
  Print '<script>alert("Incorrect PasswordAAAAAAAAAAAAAA!");</script>'; 
  Print '<script>window.location.assign("index.php");</script>';
}
else{  
	Print '<script>alert("Incorrect Password!");</script>'; 
   Print '<script>window.location.assign("index.php");</script>';
}

?>
