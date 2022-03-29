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
      <?php 
        include "config.php";
        session_start();
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
        
        if (isset($_POST['submit'])) {
            $nama = $_POST['nama'];
            $jarak = $_POST['jarak'];
            $harga = $_POST['harga'];
            $deskripsi = $_POST['deskripsi'];   
            $alamat = $_POST['alamat'];
            $queryUp="UPDATE tb_kamar SET nama_kamar='$nama',jarak='$jarak',harga='$harga',deskripsi='$deskripsi',alamat='$alamat' where tb_kamar.id_kamar='$id_kamar'";
            mysqli_query($connect, $queryUp);
            $del = "DELETE FROM tb_fasilitas_kamar WHERE tb_fasilitas_kamar.id_kamar='$id_kamar'";
            mysqli_query($connect, $del);
            if(!empty($_POST['fasilitas'])) {

                foreach($_POST['fasilitas'] as $value){
                  $queryBox = "INSERT INTO tb_fasilitas_kamar SET id_kamar='$id_kamar', id_fasilitas='$value'";
                  mysqli_query($connect, $queryBox);
                }

            }
            $delL = "DELETE FROM tb_kos_putra WHERE tb_kos_putra.id_kamar='$id_kamar'";
            mysqli_query($connect, $delL);
            $delW = "DELETE FROM tb_kos_putri WHERE tb_kos_putri.id_kamar='$id_kamar'";
            mysqli_query($connect, $delW);

            if($_POST['kategori']=="L") {
                $sqlKat = "INSERT INTO tb_kos_putra SET id_putra='',id_kamar='$id_kamar'";
                mysqli_query($connect, $sqlKat);
            } else {
                $sqlKat = "INSERT INTO tb_kos_putri SET id_putri='',id_kamar='$id_kamar'";
                mysqli_query($connect, $sqlKat);
            }
            header("Location: kelola_kamar.php");
        }
      ?>
      <div class="container bg-white" style="height: 1000px;">
        <div class="row">
          <div class="col-sm-12">
            <h1>Edit Kamar</h1>
            <div class="hrS"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
              <table>
                <form method="POST">
                  <tr>
                    <th>
                      <label for="nama">Nama Kamar &nbsp;</label>
                    </th>
                    <td>
                      <?php echo "<input id='nama' type='text' name='nama' value='{$data['nama_kamar']}' required>";?>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <label for="jarak">Jarak &nbsp;</label>
                    </th>
                    <td>
                      <?php echo "<input id='jarak' type='text' name='jarak' value='{$data['jarak']}' required>";?>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <label for="alamat">Alamat &nbsp;</label>
                    </th>
                    <td>
                      <?php echo "<input id='alamat' type='text' name='alamat' value='{$data['alamat']}' required>";?>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <label for="harga">Harga &nbsp;</label>
                    </th>
                    <td>
                      <?php echo "<input id='harga' type='number' name='harga' value='{$data['harga']}' required>";?>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <label for="deskripsi">Deskripsi &nbsp;</label>
                    </th>
                    <td>
                      <?php echo "<textarea cols='22' rows='10' id='deskripsi' name='deskripsi' required>{$data['deskripsi']}</textarea>";?>
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <th rowspan='7'>Fasilitas</th>     
                  </tr>
                  <?php 
                    $sql = "SELECT * FROM tb_fasilitas";
                    $tampil = mysqli_query($connect, $sql);
                    while ($fas = mysqli_fetch_array($tampil)){
                      $sql = "SELECT * FROM tb_fasilitas_kamar WHERE id_kamar='$id_kamar' AND id_fasilitas='{$fas['id_fasilitas']}'";
                      $result = mysqli_query($connect, $sql);
                      if ($result->num_rows > 0) {
                          echo"<tr><td><input type='checkbox' name='fasilitas[]'' value='{$fas['id_fasilitas']}' checked>{$fas['fasilitas']}</td></tr>";
                      } else {
                          echo"<tr><td><input type='checkbox' name='fasilitas[]'' value='{$fas['id_fasilitas']}'>{$fas['fasilitas']}</td></tr>";
                      }
                  
                    }
                  ?>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <th rowspan="3">Kategori Kos</th>
                  </tr>
                  <?php
                    $sqlKL = "SELECT * FROM tb_kos_putra WHERE id_kamar='$id_kamar'";
                    $resultKL = mysqli_query($connect, $sqlKL);
                    if ($resultKL->num_rows > 0) {
                          echo"<tr><td><input type='radio' name='kategori' value='L' checked>Putra</td></tr>";
                      } else {
                          echo"<tr><td><input type='radio' name='kategori' value='L'>Putra</td></tr>";
                      }
                    $sqlKW = "SELECT * FROM tb_kos_putri WHERE id_kamar='$id_kamar'";
                    $resultKW = mysqli_query($connect, $sqlKW);
                    if ($resultKW->num_rows > 0) {
                          echo"<tr><td><input type='radio' name='kategori' value='W' checked>Putri</td></tr>";
                      } else {
                          echo"<tr><td><input type='radio' name='kategori' value='W'>Putri</td></tr>";
                      }
                  ?>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" style="text-align: center;">
                      <input type="submit" value="Simpan Perubahan" id="submit" name="submit" class="btn btn-primary"> 
                    </td>
                  </tr>
                </form>
              </table>
              
              
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