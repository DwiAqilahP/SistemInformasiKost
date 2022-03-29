<?php 
include "config.php";
error_reporting(0);

session_start();
if (isset($_POST['submit'])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM tbakun WHERE username='$username' AND password='$password'";
    $result = mysqli_query($connect, $sql);
    $valid = mysqli_fetch_assoc($result);
    if ($valid > 0) {
        $_SESSION['Full_Name'] = $valid['Full_Name'];
        $_SESSION['gender'] = $valid['gender'];
        $_SESSION['username'] = $valid['username'];
        $_SESSION['email'] = $valid['email'];
        header("Location: index_user.php");
    } else {
		echo "<script>alert('Woops! Username dan Password salah.')</script>";
	}
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-image: linear-gradient(to right, #4682B4, #00FFFF, #00FA9A);
            font-family: "Raleway", sans-serif;
        }
        .isi {
            background-color: white;
            height: 400px;
            width: 300px;
            margin: 100px auto;
            border-radius: 8px;
            box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.65);
            text-align: center;
            letter-spacing: 2px;
            padding: 20px 20px 10px 20px;
        }
        .form {
            align-items: flex-start;
            display: flex;
            flex-direction: column;
        }
        label {
            font-family: "Raleway", sans-serif;
            font-size: 16pt;
            cursor: pointer;
        }
        .garis{
            background: -webkit-linear-gradient(right, #00FFFF, #00FA9A);
            height: 2px;
            margin: -1.1rem auto 30px auto;
            width: 99px;
        }
        .isiForm{
            background: white;
            border: none;
            outline: none;
            padding-top: 14px;
        }
        .batas {
            background: -webkit-linear-gradient(right, #00FFFF, #00FA9A);
            height: 1px;
            width: 100%;
            margin-bottom: 10px;
        }
        #submit{
            background: -webkit-linear-gradient(right, #00FFFF, #00FA9A);
            border: none;
            border-radius: 21px;
            box-shadow: 0px 1px 8px #24c64f;
            cursor: pointer;
            color: white;
            width: 153px;
            height: 42.3px;
            margin: 0 auto;
            margin-top: 50px;
            letter-spacing: 2px;
        }
    </style>
</head>
<body>
    <div class="isi">
        <h1>LOGIN</h1>
        <div class="garis"></div>
        <form method="POST" class="form">
            <label for="username">Username</label>
                <input id="username" name="username" type="text" class="isiForm" required>
            <div class="batas"></div>    
            <label for="password">Password</label>
            <input id="password" type="password" name="password" class="isiForm" required>
            <div class="batas"></div>
            <input type="submit" value="LOGIN" id="submit" name="submit">   

        </form>
        <p style="margin-top: 30px;">Not a member? <a href="register_user.php" style="text-decoration: none;">Sign Up</a></p>
        <a href="index.php" style="text-decoration: none;">HOME</a>
    </div>
</body>
</html>