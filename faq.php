<?php
    require 'config.php';
    function faq($data){
        global $conn;
    
        $nama = strtolower(stripslashes($data["nama"]));
        $email = mysqli_real_escape_string($conn, $data["email"]);
        $tanya_jawab = mysqli_real_escape_string($conn, $data["tanya_jawab"]);
    
        //tambahkan user baru ke database
        mysqli_query($conn, "INSERT INTO faq VALUES('','$nama','$email','$tanya_jawab')");
    
        return mysqli_affected_rows($conn);
    }
    
    // jika tombol register ditekan
    if(isset($_POST["submit"])){
        if(faq($_POST) > 0){
            echo "
            <script>
                alert('Comment berhasil ditambahkan');
            </script>";
        } else {
            echo mysqli_error($conn);
        }
    }

    // menampilkan data
    $result = mysqli_query($conn,"SELECT * FROM faq");

?>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="author" content="Dina">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" >
<title>FAQ</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
        @import url('https://fonts.googleapis.com/css?family=Titillium+Web');

        *{
            font-family: 'Titillium Web', sans-serif;
        }
        nav{
            padding: 10px;
            background-color: black;  
        }
        .navbar-brand{
            color: white;
            padding-left: 0;
            padding-right: 20px;
            font-weight: bold;
            opacity: 0.5;
        }
        .navbar ul li .a{
            color: white;
            text-decoration: none;
            padding: 0 60px 20px 0;
            font-size: medium; 
        }
        .list{
            list-style: none;
            display: inline;
        }
        .body{
            width: 100%;
        }
        .container{
            margin: 0 auto;
            text-align: center;
        }
        input{
            width: 30%;
            height: 40px;
        }
        label b{
            text-align: left;
        }
        .form-group{
            padding: 5px;
        }
        .kotak{
            background-color: lightgrey;
            width: 100%;
            text-align: left;
            border: 1px solid white;
        }
        .text{
            padding: 10px;
        }
        h1{
            color: #0e849e;
        }
        .btn{
            color: white;
            background-color: #008CBA;
        }
    </style>
</head>

<body>
<header>
    <nav class="navbar">
        <div>
            <ul>
                <li class="list"><a class="a" href="index.php">Home</a></li>
                <li class="list"><a class="a" href="mobil.php">Mobil</a></li>
                <li class="list"><a class="a" href="sewa2.php">My Booking</a></li>
                <li class="list"><a class="a" href="penyewaan.php">Penyewaan</a></li>
                <li class="list" style="float: right;"><a class="a" href="logout.php">Logout</a></li>
                <li class="list" style="float: right;"><a class="a" href="faq.php">FAQ</a></li>
            </ul>
        </div>        
    </nav>
</header>
<div class="kotak">
    <?php $i = 1; ?>
        <?php while($row = mysqli_fetch_assoc($result)) : ?>
            <div class="text">
                <b><?php echo $i ?>. <?php echo $row["nama"]; ?><b>
                <h4><?php echo $row["tanya_jawab"]; ?></h4> 
            </div>
        <?php $i++; ?>
        <?php endwhile; ?>
</div>

<div class="body">
    <div class="container">
        <div class="jumbrotan" id="order">
            <h1>Tulis Jawabanmu</h1>
            <form action="" method="post" id="placeOrder">
                <div class="form-group">
                    <input type="text" name="nama" class="form-control" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <textarea name="tanya_jawab"  rows="5" cols="52" placeholder="Enter your comment"></textarea>
                    <!-- <input type="text" name="email" class="form-control"> -->
                </div>
               
                <div class="form-group">
                    <input type="submit" name="submit" value="Post Comment" class="btn"> 
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>