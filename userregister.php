
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
</head>
<body>
<?php
    include "dbcon.php";

  
    if (isset($_REQUEST['username'])) {
      
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($conn, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($conn, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $password1 = stripslashes($_REQUEST['password1']);
        $password1 = mysqli_real_escape_string($conn, $password1);


        $query = "SELECT * FROM `user` WHERE username ='$username' or email ='$email'";
      
        $result   = mysqli_query($conn, $query);

        if(mysqli_num_rows($result)>=1) {
        echo "Email or Username already exist, try something else.";
        echo "<div>
            <p>Click here to <a href='userregister.php'>Register</a></p>
            </div>";
        }
        elseif($password != $password1){
            echo "passwords doesn't match";
            echo "<div>
            <p>Click here to <a href='userregister.php'>Register</a></p>
            </div>";
       }
        else{ 
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $query    = "INSERT into `user` (username, password, password1,email)
                     VALUES ('$username', '" . md5($password) . "','" . md5($password1) . "', '$email')";
        $result   = mysqli_query($conn, $query);
            
        echo "<div>
            <h3>You are registered successfully.</h3><br/>
            <p>Click here to <a href='login.php'>Login</a></p>
            </div>";
        }
    }
}
    else{ 
    
?>
    <form  action="" method="post">
        <h1>Register</h1>
        <input type="text"  name="username" placeholder="Username" required /><br>
        <input type="email"  name="email" placeholder="Email Adress"><br>
        <input type="password"  name="password" placeholder="Password"><br>
        <input type="password "  name="password1" placeholder="Confirm Password"><br>
        <input type="submit" name="submit" value="Register" >
        <p>Already a member ?<a href="login.php">Sign in </a></p>
    </form>

<?php
} 

?>


<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

</script>

</body>
</html>

