<?php 
session_start();
include "config.php";
$id = $_GET['id_kamar'];
$pemlik = $_SESSION['id_pemilik'];
$query = "SELECT * FROM tb_kamar WHERE tb_kamar.id_kamar='$id'";
$que = mysqli_query($connect, $query);
$data = mysqli_fetch_array($que);
if ($data['status']=='Tersedia'){
	mysqli_query($connect, "UPDATE tb_kamar SET status='Tidak Tersedia' WHERE id_kamar='$id'");
}else{
	mysqli_query($connect, "UPDATE tb_kamar SET status='Tersedia' WHERE id_kamar='$id'");
}
 
header("Location: kelola_kamar.php");
?>