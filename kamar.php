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
          <a class="navbar-brand" href="index.php"><span style="font-family: 'Pacifico', cursive;">SewaKuy</span></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item me-4">
                    <a class="nav-link" aria-current="page" href="index.php" >Beranda</a>
                </li>
                <li class="nav-item dropdown me-4">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Kategori
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="kos_putra.php" >Kos Putra</a></li>
                    <li><a class="dropdown-item" href="kos_putri.php" >Kos Putri</a></li>
                    </ul>
                </li>
                <!-- <li class="nav-item me-4">
                    <a class="nav-link" href="#" >Tentang Kami</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="#">Kontak</a>
                </li> -->
                <li class="nav-item dropdown me-4">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Login
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="login.php" >Pemilik Kos</a></li>
                    <li><a class="dropdown-item" href="login_user.php" >Pencari Kos</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown me-4">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Register
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="register.php" >Pemilik Kos</a></li>
                    <li><a class="dropdown-item" href="register_user.php" >Pencari Kos</a></li>
                    </ul>
                </li>
            </ul>
          </div>
        </div>
      </nav>
      
    </section>
    <!-- Kost putra -->
    <?php 
        if(isset($_GET['id_kamar'])){
          $id_kamar=$_GET['id_kamar'];
        }
        else {
            die ("Error. No ID Selected!");    
        }
        include "config.php";
        $sql_kamar = "SELECT * FROM tb_kamar, tb_fasilitas_kamar, tb_fasilitas WHERE tb_kamar.id_kamar='$id_kamar' AND tb_kamar.id_kamar= tb_fasilitas_kamar.id_kamar AND tb_fasilitas_kamar.id_fasilitas=tb_fasilitas.id_fasilitas";
        $query_kamar = mysqli_query($connect, $sql_kamar);
        $data = mysqli_fetch_array($query_kamar);

        $result_book = mysqli_query($connect,"SELECT * FROM tb_booking WHERE id_kamar='$id_kamar' AND validasi='Belum Valid'");
        while ($data_book = mysqli_fetch_array($result_book)){
          $id_booking = $data_book['id_booking'];
          $now = time(); // or your date as well
          $your_date = strtotime($data_book['tgl_booking']);
          $datediff = $now - $your_date;
          $cek = round($datediff / (60 * 60 * 24));
          if ($cek > 30){
            mysqli_query($connect, "UPDATE tb_kamar SET status='Tersedia' WHERE id_kamar='$id_kamar'");
            mysqli_query($connect, "UPDATE tb_booking SET validasi='Valid' WHERE id_booking='$id_booking'");
          }
          else{
            mysqli_query($connect, "UPDATE tb_kamar SET status='Tidak Tersedia' WHERE id_kamar='$id_kamar'");  
          }
        }
      ?>
    
    <section class="konten-atas">
      <div class="container bg-white">
        <div class="row">
          <div class="col-sm-12">
            <?php echo "<h1>Kamar Kos {$data['nama_kamar']}</h1>";?>
          
            <div class="hrS"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-8">
            <!-- // Tampilkan Gambar -->
            <?php echo "<img src='images/".$data['gambar_kamar']."' class='gambar'/>";?>
          </div>
          <div class="col-sm-4">
              <div class="card kartu" style="width: 18rem;">
               <?php echo "<img src='images/".$data['gambar_kamar']."' class='card-img-top'/>";?>
              <div class="card-body">
                <?php echo "<h5 class='card-title'>$data[nama_kamar] </h5>";?>
                <?php echo "<p class='card-title'>$data[deskripsi] </p>";?>
                <?php echo "<p class='card-title'>$data[alamat] </p>";?>
                <?php echo "<p class='card-text'>Rp.$data[harga],00/bulan</p>";?>
                <form method="POST">
                  <label>Mulai kos</label>
                  <input type="date" name="date">
                </form>
                <a href="login_user.php" class="btn btn-primary">Booking Sekarang</a>
                
              </div>
            </div>
            </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <h3>Status</h3>
            <div class="hrS"></div>
            <?php echo "<p>{$data['status']}</p>";?>
          </div>
        </div>
        
        <div class="row">
          <div class="col-sm-6">
            <h3>Deskripsi</h3>
            <div class="hrS"></div>
            <?php echo "<p>{$data['deskripsi']}</p>";?>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <h3>Fasilitas</h3>
            <div class="hrS"></div>
            <?php
              $sql_kamar = "SELECT * FROM tb_kamar, tb_fasilitas_kamar, tb_fasilitas WHERE tb_kamar.id_kamar='$id_kamar' AND tb_kamar.id_kamar= tb_fasilitas_kamar.id_kamar AND tb_fasilitas_kamar.id_fasilitas=tb_fasilitas.id_fasilitas";
              $query_kamar = mysqli_query($connect, $sql_kamar);
              while ($data = mysqli_fetch_array($query_kamar)){
            ?>
            <ul>
              <?php echo "<li>{$data['fasilitas']}</li>";?>
            </ul>
            <?php
              }
            ?>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <h3>Peraturan Kos</h3>
            <div class="hrS"></div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div>
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