<?php
session_start();
require 'config.php';

//post to cart
if(isset($_POST['rid'])){
    $rid = $_POST['rid'];
    $rbrand = $_POST['rbrand'];
    $rnama = $_POST['rnama'];
    $rno = $_POST['rno'];
    $rharga = $_POST['rharga'];
    $rcode = $_POST['rcode'];
    $rgambar = $_POST['rgambar'];
    $rqty = 1;

    $stmt = $conn->prepare("SELECT code_sewa FROM booking WHERE code_sewa=?");
    $stmt->bind_param("s",$rcode);
    $stmt->execute();
    $res = $stmt->get_result();
    $r = $res->fetch_assoc();
    $code = $r['code_sewa'];

    if(!$code){
        $query = $conn->prepare("INSERT INTO booking (brand_mobil,nama_mobil,no_mobil,harga_sewa,code_sewa,harga_total,qty,gambar) VALUES 
        (?,?,?,?,?,?,?,?)");
        $query->bind_param("ssssssis",$rbrand,$rnama,$rno,$rharga,$rcode,$rharga,$rqty,$rgambar);
        $query->execute();
        echo '<div class="alert alert-success alert-dismissible mt-2">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Berhasil ditambahkan</strong>
            </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible mt-2">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Sudah pernah ditambahkan</strong>
            </div>';
    }
}


//remove product
if(isset($_GET['remove'])){
    $id = $_GET['remove'];

    $stmt = $conn->prepare("DELETE FROM booking WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();

    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'Tiket dihapus!';
    header('location:sewa2.php');
}


//update qty
if(isset($_POST['qty'])){
    $qty = $_POST['qty'];
    $rid = $_POST['rid'];
    $rharga = $_POST['rharga'];

    $rprice = $qty*$rharga;

    $stmt = $conn->prepare("UPDATE booking SET qty=? , harga_total=? WHERE id=?");
    $stmt->bind_param("isi",$qty,$rprice,$rid);
    $stmt->execute();
}

//post checkout
if(isset($_POST['action']) && isset($_POST['action']) == 'order'){
    $products = $_POST['products'];
    $tgls = $_POST['tanggal_sewa'];
    $tglk = $_POST['tanggal_kembali'];
    $no_ktp = $_POST['no_ktp'];
    $grand_total = $_POST['grand_total'];
    $status = $_POST['status'];

    $data = '';

    $stmt = $conn->prepare("INSERT INTO sewa_jadi (nama_mobil,tanggal_sewa,tanggal_kembali,total_harga,status,no_ktp) 
    VALUES (?,?,?,?,?,?)");
    $stmt->bind_param("ssssss",$products,$tgls,$tglk,$grand_total,$status,$no_ktp);
    $stmt->execute();
    $data .= '<div> 
                <h1>Terima kasih!</h1>
                <h2>Penyewaan berhasil dibuat!</h2>
                <h4>Penyewaan : '.$products.' </h4>
                <h4>Disewa dari tanggal '.$tgls.' sampai '.$tglk.'</h4>
                <h4>Total Pembayaran : '.number_format($grand_total,2).'</h4>
                <h4>Status sewa : '.$status.'</h4>
                <h4>Silakan transfer ke rekening B**. Atau datang kekantor kami untuk melakukan pembayaran<h4>
            </div>';
    echo $data;
}
?>