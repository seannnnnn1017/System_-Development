<?php
    session_start();
    session_destroy();
    ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
<title>LOGIN</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  
    <div class="box">
        <span class="borderLine"></span>
        <form action="loginCheck.php"
                method="post">
            <h2>Sign in</h2>
            <div class="inputBox">
                <input type="text" name="id"
                    id="id" required="required">
                <span>Username</span>
                <i></i>   
            </div> 
            <div class="inputBox">
                <input type="password" name="pw"
                    id="pw" required="required">
                <span>Password</span>
                <i></i>   
            </div>
            <div class="links">
                <a href="#">Forgot Password</a>
                <a href="#">Signup</a>
            </div>
            <input type="submit"
                    value="Login">
        </form>
</body>
</html>