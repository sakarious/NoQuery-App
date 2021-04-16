<!DOCTYPE html>
<?php
    session_start();
    if(!isset($_SESSION['username']) && !isset($_SESSION['email']) && !isset($_SESSION['password'])){
        header("Location: index.php");
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Document</title>
</head>
<body>
    <h1>Welcome</h1>
    <button><a href="resetPassword.php">Reset Password</a></button>
    <button><a href="logout.php">Logout</a></button>
</body>
</html>