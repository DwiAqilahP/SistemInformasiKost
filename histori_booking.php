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
          <a class="navbar-brand" href="index_user.php"><span style="font-family: 'Pacifico', cursive;">SewaKuy</span></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <<li class="nav-item me-4">
                    <a class="nav-link" aria-current="page" href="index_user.php" >Beranda</a>
                </li>
                <li class="nav-item dropdown me-4">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Kategori
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="kos_putra_user.php" >Kos Putra</a></li>
                    <li><a class="dropdown-item" href="kos_putri_user.php" >Kos Putri</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown me-4">
                    <a class="nav-link" href="histori_booking.php" >History Booking</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="informasi_user.php" >Informasi Akun</a>
                </li>
               <!--  <li class="nav-item me-4">
                    <a class="nav-link" href="statistik.php">Statistik</a>
                </li> -->
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
      <div class="container bg-white" style="min-height: 600px;">
        <div class="row">
          <div class="col-sm-12">
            <h3>History Booking</h3>
            <div style="background: -webkit-linear-gradient(right, #00FFFF, #00FA9A);height: 2px;width: 200px;margin-bottom: 10px;"></div>
          </div>
        </div>
        <div class="row">
          <?php 
            include "config.php";
            session_start();
            $sql = "SELECT * FROM tb_kamar, tb_booking WHERE tb_booking.id_kamar=tb_kamar.id_kamar AND tb_booking.username='{$_SESSION['username']}'";
            $tampil = mysqli_query($connect, $sql);
            while ($data = mysqli_fetch_array($tampil)){
              
          ?>
          <div class="col-sm-4">
            <div class="card kartu" style="width: 18rem;">
               <?php echo "<img src='images/".$data['gambar_kamar']."' class='card-img-top'/>";?>
              <div class="card-body">
                <?php echo "<h5 class='card-title'>$data[nama_kamar] </h5>";?>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="card-text">Harga</p>
                  </div>
                  <div class="col-sm-8">
                    <?php echo "<p class='card-text'>Rp.$data[harga],00/bulan</p>";?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="card-text">User</p>
                  </div>
                  <div class="col-sm-8">
                    <?php echo "<p class='card-text'>$data[username]</p>";?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="card-text">Tgl</p>
                  </div>
                  <div class="col-sm-8">
                    <?php echo "<p class='card-text'>$data[tgl_booking]</p>";?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="card-text">Kode</p>
                  </div>
                  <div class="col-sm-8">
                    <?php echo "<p class='card-text'>$data[id_booking]</p>";?>
                  </div>
                </div>
                
                <a href="kamar_user.php?id_kamar=<?=$data['id_kamar']?>" class="btn btn-primary">Go Kamar</a>
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