<?php
session_start();
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Mobil</title>
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
        .container{
            padding-top: 50px;
        }
        .product{
            border: 1px solid #eaeaec;
            /* margin: -1px 40px 30px 50px; */
            padding: 37px;
            text-align: center;
            /* background-color: #efefef; */
            /* width: 25%; */
            float: left;
        }
        .title2{
            text-align: center;
            color: darkolivegreen;
            background-color: #efefef;
            padding: 2%;
        }
        h1{
            text-align: center;
            color: darkolivegreen;
            background-color: #efefef;
            padding: 0.5%;
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
                        <li class="list" style="float: right;"><a class="a" href="logout.php">Logout</a></li>
                        <li class="list" style="float: right;"><a class="a"  href="login.php">Login</a></li>
                    </ul>
                </div>
                <img src="" style="text-align: center;  width: 100%;" />
                    
            </nav>
        </header>

    <div class="container" style="width: 100%">
    <div id="message"></div>
    <h1>Jika ingin melanjutkan penyewaan, please Login.</h1>
        <div>
            <?php
                include 'config.php';
                $stmt = $conn->prepare("SELECT * FROM mobil");
                $stmt->execute();
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()):
            ?>
            <div class="product card">
                <img src="<?= $row["gambar"]; ?>" width="420" height="280">
                <h4 style="color: red;" class="text-info"><?= $row["status"]; ?></h4>
                <h4><?= $row["brand_mobil"]; ?> <?= $row["nama_mobil"]; ?></h4>
                <h4><?= $row["no_mobil"]; ?></h4>
                <h4><?= number_format($row["harga_sewa"],2); ?>/hari</h4>
                    <div class="card-footer p-1">
                        <form action="" class="form-submit">
                            <input type="hidden" class="rid" value="<?= $row['id']; ?>">
                            <input type="hidden" class="rbrand" value="<?= $row['brand_mobil']; ?>">
                            <input type="hidden" class="rnama" value="<?= $row['nama_mobil']; ?>">
                            <input type="hidden" class="rno" value="<?= $row['no_mobil']; ?>">
                            <input type="hidden" class="rharga" value="<?= $row['harga_sewa']; ?>">
                            <input type="hidden" class="rgambar" value="<?= $row['gambar']; ?>">
                            <input type="hidden" class="rcode" value="<?= $row['code_sewa']; ?>">
                            <button class="booking">Sewa</button>
                        </form>  
                    </div>
            </div>
                <?php endwhile; ?>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".booking").click(function(e){
            e.preventDefault();
            var $form = $(this).closest(".form-submit");
            var rid = $form.find(".rid").val();
            var rbrand = $form.find(".rbrand").val();
            var rnama = $form.find(".rnama").val();
            var rno = $form.find(".rno").val();
            var rharga = $form.find(".rharga").val();
            var rcode = $form.find(".rcode").val();
            var rgambar = $form.find(".rgambar").val();

            $.ajax({
                url:'function.php',
                method:'post',
                data:{rid:rid,rbrand:rbrand,rnama:rnama,rno:rno,rharga:rharga,rcode:rcode,rgambar:rgambar},
                success:function(response) {
                    $("#message").html(response);
                    window.scrollTo(0,0);
                    
                }
            });
        });
    });
</script>

</body>
</html>