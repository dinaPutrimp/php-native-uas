<?php
$database_name = "rental";
$conn = mysqli_connect("localhost","root","",$database_name);

function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $nama = mysqli_real_escape_string($conn, $data["nama"]);
    $alamat = mysqli_real_escape_string($conn, $data["alamat"]);
    $no_ktp = mysqli_real_escape_string($conn, $data["no_ktp"]);
    $phone = mysqli_real_escape_string($conn, $data["phone"]);
    $gambar = mysqli_real_escape_string($conn, $data["gambar"]);


    //cek usernamesudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert('username sudah terdaftar');
        </script>";
        return false;
    }

    // cek konfirmasi password
    if($password !== $password2){
        echo "<script>
                alert('konfirmasi password tidak sama');
        </script>";
        return false;
    }
    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);


    //tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('','$username','$password','$nama','$alamat','$no_ktp','$phone','$gambar')");

    return mysqli_affected_rows($conn);
}

// jika tombol register ditekan
if(isset($_POST["register"])){
    if(registrasi($_POST) > 0){
        echo "
        <script>
            alert('userbaru berhasil ditambahkan');
        </script>";
        echo '<script>window.location="login.php"</script>';
    } else {
        echo mysqli_error($conn);
    }
}

?>

<html>
<head>
    <title>Registrasi</title>
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
            margin-top: 80px;
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

            .register {
            background-color: darkolivegreen;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
            }

            .register:hover {
            opacity:1;
            }
    </style>
</head>
<body>

<div>
    <form action="" method="post">
            <div class="kotak">
                <h1>Registrasi</h1>
                <hr>

                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Username" name="username" id="username">
                <br />
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Password" name="password" id="password">
                <br />
                <label for="password2"><b>Ulangi Password</b></label>
                <input type="password" placeholder="Ulangi Password" name="password2" id="password2">
                <br />
                <label for="nama"><b>Nama Lengkap</b></label>
                <input type="text" placeholder="Nama Lengkap" name="nama" id="nama">
                <br />
                <label for="alamat"><b>Alamat</b></label>
                <input type="text" placeholder="Alamat" name="alamat" id="alamat">
                <br />
                <label for="no_ktp"><b>No. Ktp</b></label>
                <input type="text" placeholder="No. Ktp" name="no_ktp" id="no_ktp">
                <br />
                <label for="phone"><b>Phone</b></label>
                <input type="text" placeholder="Phone" name="phone" id="phone">
                <br />
                <label for="gambar"><b>Upload Gambar Ktp</b></label>
                <input type="file" accept="image/*" placeholder="Upload Gambar Ktp" name="gambar" id="gambar">
                <hr>

                <button type="submit" class="register" name="register">Register</button>
            </div>
    </form>
    </div>
</body>
</html>