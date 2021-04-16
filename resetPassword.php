<!DOCTYPE html>
<?php
    session_start();
    if(!isset($_SESSION['username']) || !isset($_SESSION['email'])){
        header("Location: index.php");
    }
?>

<?php
    if(isset($_POST['submit'])) {
        if(!empty($_POST['password']) && !empty($_POST['newpassword']) && !empty($_POST['confirmpassword']) && $_POST['newpassword'] === $_POST['confirmpassword']){
            $password = md5($_POST['password']);
            $newpassword = md5($_POST['newpassword']);
            $currentpassword = $_SESSION['password'];

            $user_email = $_SESSION['email'];
            $username = $_SESSION['username'];

            if($currentpassword == $password) {
            
                $databasejson = file_get_contents("database.json");
                if ($databasejson === false) {
                    echo '<h1>Database Not Found</h1>';
                }

                $database = json_decode($databasejson, true);
                if ($database === null) {
                    echo "<h1>Not a Valid JSON file</h1>";
                }

                if(array_key_exists($user_email, $database))
                {
                        $database[$user_email] = array( "username" => $username, "email" => $user_email, "password" => $newpassword );
                        file_put_contents("database.json", json_encode($database));
                        header("Location: dashboard.php");
                }
            } else {
                echo "<h3>Current Password Wrong <h3>";
            }
        } else {
            echo "<h3>Password do not Match <h3>";
        }
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
    <h1>Reset Password</h1>
    <form action="" method="post">
        <table align = "center">
            <tr>
                <td>Current Password</td>
                <td><input type="password" name="password" placeholder="Enter Your Current Password" required></td>
            </tr>
            <tr>
                <td>New Password</td>
                <td><input type="password" name="newpassword" placeholder="Enter Your Password" required></td>
            </tr>
            <tr>
                <td>Confirm New Password</td>
                <td><input type="password" name="confirmpassword" placeholder="Confirm Your Password" required></td>
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

    <button><a href="dashboard.php">Back to Dashboard</a></button>
</body>
</html>