<?php
session_start();

if(isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}

$database_name = "rental";
$con = mysqli_connect("localhost","root","",$database_name);
// cek tombol submit sudah ditekan
if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    // cek username yg diinputkan ada ga di database
    $result = mysqli_query($con, "SELECT * FROM user WHERE username = '$username'");
    if(mysqli_num_rows($result) === 1){
        // cek password
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
             // set session
             $_SESSION["login"] = true;


            header("Location: sewa2.php");
            exit;
        }
        $error = true;
    }
}
?>

<html>
<head>
    <title>Login</title>
    <style>
        body{
            background-color: black;
        }

        * {box-sizing: border-box}

            .kotak {
            padding: 16px;
            width: 40%;
            background-color: white;
            margin: 0 auto;
            margin-top: 100px;
            }

            input[type=text], input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
            }

            input[type=text]:focus, input[type=password]:focus {
            background-color: #ddd;
            outline: none;
            }

            hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
            }

            .login {
            background-color: darkolivegreen;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
            }

            .login:hover {
            opacity:1;
            }

            a {
            color: dodgerblue;
            }

            p{
                text-align: center;
            }
    </style>
</head>
<body>
    <form action="" method="post">
            <div class="kotak">
                <h1 style="text-align: center;">Login</h1>
                <?php if(isset($error)) : ?>
                <p style="color: red; font-style: italic; text-align: left;">username / password salah</p>
                <?php endif; ?>
                <hr>

                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Username" name="username" id="username">
                <br />
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Password" name="password" id="password">
                <hr>

                <button type="submit" class="login" name="login">Login</button>
                <p>Anda belum punya akun? <a href="registrasi.php">Registrasi</a></p>
            </div>
    </form>
</body>
</html>