<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
</head>
<body>
<?php
include('dbcon.php');
session_start();
if (isset($_POST['username'])){
        
 $username = stripslashes($_REQUEST['username']);
      
 $username = mysqli_real_escape_string($conn,$username);
 $password = stripslashes($_REQUEST['password']);
 $password = mysqli_real_escape_string($conn,$password);
 
      $query = "SELECT * FROM `user` WHERE username='$username'
and password ='".md5($password)."'";
 $result = mysqli_query($conn,$query);
 $rows = mysqli_num_rows($result);
      if($rows==1){
     $_SESSION['username'] = $username;
     header("Location: index.php");
        }else{
 echo "<div >
<h3>Username/password is incorrect.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
 }
    }else{
?>

<h1>Log In</h1>
<form action="" method="post" name="login">
<input type="text" name="username" placeholder="Username" required />
<input type="password" name="password" placeholder="Password" required />
<input name="submit" type="submit" value="Login" />
</form>
<p>Not registered yet? <a href='userregister.php'>Register Here</a></p>

<?php } ?>
</body>
</html>