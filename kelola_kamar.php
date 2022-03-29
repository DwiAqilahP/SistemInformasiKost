<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style2.css">

    <title>SewaKuy</title>
  </head>
  <body class="bg-dark">
    <section class="header">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
          <a class="navbar-brand" href="index_pemilik.php"><span style="font-family: 'Pacifico', cursive;">SewaKuy</span></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item me-4">
                    <a class="nav-link" aria-current="page" href="index_pemilik.php" >Beranda</a>
                </li>
                <li class="nav-item dropdown me-4">
                    <a class="nav-link" href="kelola_kamar.php" >Kelola Kamar</a>
                </li>
                <li class="nav-item dropdown me-4">
                    <a class="nav-link" href="validasi_booking.php" >Validasi Booking</a>
                </li>

                <li class="nav-item me-4">
                    <a class="nav-link" href="informasi_akun.php" >Informasi Akun</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="statistik.php">Statistik</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="index.php">Log out</a>
                </li>
            </ul>
          </div>
        </div>
      </nav>
    
        
    </section>
    <!-- Kost putra -->
    <section class="konten-atas">
      <div class="container bg-white">
        <div class="row">
          <div class="col-sm-6">
            <h3>Kelola Kamar</h3>
            <div class="hrS"></div>
          </div>
          <div class="col-sm-6" style="text-align: right; font-size: 20px;">
            <a href="tambah_kamar.php" class="btn btn-primary">Tambah Kamar</a>
          </div>
        </div>
        <div class="row">
          <?php 
            include "config.php";
            session_start();
            $sql = "SELECT * FROM tb_kamar, tb_pemilik, tb_kepemilikan WHERE tb_pemilik.id_pemilik=tb_kepemilikan.id_pemilik AND tb_kamar.id_kamar = tb_kepemilikan.id_kamar AND tb_pemilik.id_pemilik='$_SESSION[id_pemilik]'";
            $tampil = mysqli_query($connect, $sql);
            while ($data = mysqli_fetch_array($tampil)){
              
          ?>
          <div class="col-sm-4">
            <div class="card kartu" style="width: 18rem;">
              <?php 
                $result_book = mysqli_query($connect,"SELECT * FROM tb_booking WHERE id_kamar='{$data['id_kamar']}' AND validasi='Belum Valid'");
                if ($result_book->num_rows > 0){

               ?>

              <button disabled href="ketersediaan.php?id_kamar=<?=$data['id_kamar']?>" class="btn btn-primary"><?php echo "$data[status]"; ?></button>
              <?php }else{ ?>
              <button onclick="location.href='ketersediaan.php?id_kamar=<?=$data['id_kamar']?>'" class="btn btn-primary"><?php echo "$data[status]"; ?></button>
              <?php } ?>

               <?php echo "<img src='images/".$data['gambar_kamar']."' class='card-img-top'/>";?>
              <div class="card-body">
                <?php echo "<h5 class='card-title'>$data[nama_kamar] </h5>";?>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <?php echo "<p class='card-text'>Rp.$data[harga],00</p>";?>
                <a href="edit_kamar.php?id_kamar=<?=$data['id_kamar']?>" class="btn btn-primary">Edit</a>
                <a href="hapus_kamar.php?id_kamar=<?=$data['id_kamar']?>" class="btn btn-primary">Hapus</a>

              </div>
            </div>
          </div>
          <?php
            }
          ?>
        </div>
      </div>
    </section>
    <section class="footer text-white text-center">
      <p>copyright © Sistem Informasi C</p>
    </section>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>