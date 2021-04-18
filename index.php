<!DOCTYPE html>
<?php
    session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_SESSION['password'])){
        header("Location: dashboard.php");
    }
?>

<?php
    if(isset($_POST['submit'])) {
        if( !empty($_POST['email']) && !empty($_POST['password'])){
            $user_email = $_POST['email'];
            $password = md5($_POST['password']);

            $databasejson = file_get_contents("database.json");
            if ($databasejson === false) {
                echo '<h1>Database Not Found</h1>';
            }

            $database = json_decode($databasejson, true);
            if ($database === null) {
                echo "<h1>Not a Valid JSON file</h1>";
            }

            if(array_key_exists($user_email, $database)){
                if($database[$user_email]['password'] == $password){
                    $_SESSION['username'] = $database[$user_email]['username'];
                    $_SESSION['email'] = $database[$user_email]['email'];
                    $_SESSION['password'] = $database[$user_email]['password'];
                    header("Location: dashboard.php");
                } else {
                    echo "<p>Wrong Username or Password</p>";
                }
            } else {
                echo "<p>Not Registered. <button><a href='register.php'>Register</a></button> </p>";
            }
            
        }
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>NoQuery App</title>
</head>
<body>
    <h1>Login Page</h1>
    <form action="" method="post">
        <table align = "center">
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" placeholder="Enter Your Email" required></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" placeholder="Enter Your Password" required></td>
            </tr>
            <tr>
                    <td></td>
                    <td><input type="submit" value="Submit" name="submit"></td>
            </tr>
            <tr>
                <td></td>
                <td><button><a href="register.php">Register</a></button></td>
        </tr>
        </table>
    </form>
</body>
</html>
