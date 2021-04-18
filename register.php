<!DOCTYPE html>
<?php
    session_start();
    if(isset($_SESSION['username']) ||isset($_SESSION['email'])){
        header("Location: dashboard.php");
    }
?>

<?php
    if(isset($_POST['submit'])) {
        if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])){
            $username = $_POST['username'];
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
                echo "<h1>User Exists. <button><a href='login.php'>Login</a></button> </h1>";
            } else {
                $database[$user_email] = array( "username" => $username, "email" => $user_email, "password" => $password );
                file_put_contents("database.json", json_encode($database));
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $user_email;
                $_SESSION['password'] = $password;
                header("Location: dashboard.php");
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
    <title>NoQuery App - REGISTER</title>
</head>
<body>
    <h1>Registration Page</h1>
    <form action="" method="post">
        <table align = "center">
            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" placeholder="Enter Your Username" required></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" placeholder="Enter Your Username" required></td>
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
                <td><button><a href="index.php">Login</a></button></td>
        </tr>
        </table>
    </form>
</body>
</html>
