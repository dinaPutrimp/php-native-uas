<?php
    session_start();
    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }
?>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="author" content="Dina">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" >
<title>My booking</title>
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
        .product ul li{
            list-style: none;
            text-align: center;
        }
        img{
            width: 400px;
            height: 280px;
            float: left:
        }
        .container{
            padding-top: 50px;
        }
        .product{
            border: 1px solid #eaeaec;
            /* margin: -1px 40px 30px 50px; */
            padding: 37px;
            /* background-color: #efefef; */
            /* width: 25%; */
        }
        .cls{
            background-color: #f44336; 
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            border-radius: 8px;
        }
        .ctn{
            background-color: #008CBA;; 
            border: none;
            color: white;
            padding: 12px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 12px;
        }
        table, th, tr{
            text-align: center;
        }
        .fa{
            float: right;
        }
        h2{
            text-align: center;
            color: #30b8b3;
            padding-top: 10px;

        }
        table{
            width: 70%;
            margin: 0 auto;
            border: 1px solid lightgrey;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        td{
            height: 30px;
        }
        table tr th{
            background-color: #9ebaa8;
            width: 50px;
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

<div class="container">
    <div>
        <div>
        <div style="display: <?php if(isset($_SESSION['showAlert'])){
            echo $_SESSION['showAlert'];
        } else {
            echo 'none';
        } 
        unset($_SESSION['showAlert']);
        ?>" class="alert alert-success alert-dismissible mt-2">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>
                <?php if(isset($_SESSION['message'])){
                    echo $_SESSION['message'];} 
                    unset($_SESSION['showAlert']);
                ?>
            </strong>
        </div>
            <div class="product">
                        <!-- <a href="function.php?clear=all" class="cls"  onclick="return confirm('Yakin ingin menghapus semua?');">Clear cart</a> -->

                        <?php
                            require 'config.php';
                            $stmt = $conn->prepare("SELECT * FROM booking");
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $grand_total = 0;
                            while($row = $result->fetch_assoc()):
                        ?>
                        
                        <img src="<?= $row['gambar']; ?>" class="kiri">
                        <ul>
                                <li><?= $row['id']; ?></li>
                                <!-- update quantity saat ditambah -->
                                <input type="hidden" class="rid" value="<?= $row['id']; ?>">
                                <li><?= $row['brand_mobil']; ?> <?= $row['nama_mobil']; ?></li>
                                <li><?= $row['no_mobil']; ?></li>
                                <li><?= number_format($row['harga_sewa'],2); ?></li>
                                <input type="hidden" class="rharga" value="<?= $row['harga_sewa']; ?>">
                                <li><input type="number" class="itemQty" value="<?= $row['qty']; ?>" style="width: 75px;"> hari</li>
                                <li><?= number_format($row['harga_total'],2); ?></li>
                                <a href="function.php?remove=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash" style="color: red; font-size: 50px;"></i></a>
                        </ul>  
        
                        <?php $grand_total += $row['harga_total']; ?>
                        <?php endwhile; ?>                    
       
            </div>
            <div>
                <a style="float:right;" class="ctn" href="mobil.php">Kembali</a>
                <a style="float:left;" class="ctn" href="penyewaan.php"
                <?= ($grand_total > 1)?"":"disabled"; ?>>Next</a> 
            </div>
            <div style="text-align: center">
                    <b>Total</b>
                    <b><?= number_format($grand_total,2); ?></b>
            </div>   
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        //update qty
        $(".itemQty").on('change',function(){
            var $el = $(this).closest('ul');

            var rid = $el.find(".rid").val();
            var rnama = $el.find(".rnama").val();
            var rno = $el.find(".rno").val();
            var tharga = $el.find(".rharga").val();
            var qty = $el.find(".itemQty").val();
            location.reload(true);

            //post to order
            $.ajax({
                url:'function.php',
                method:'post',
                cache:false,
                data:{qty:qty,rid:rid,rnama:rnama,rno:rno,rharga:rharga},
                success:function(response){
                    console.log(response);
                }
            });
        });

        
    });
</script>
</body>
</html>