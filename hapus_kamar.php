<?php 
session_start();
include "config.php";
$id = $_GET['id_kamar'];
$pemlik = $_SESSION['id_pemilik'];
$query = "DELETE FROM tb_kamar WHERE tb_kamar.id_kamar='$id'";
mysqli_query($connect, $query);
 
header("Location: kelola_kamar.php");
?>