<?php
  include "php/user.php";

  session_start();

  if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
  }

  $isAdmin = $_SESSION['user']->getRole();
  
  if ($isAdmin) {
    $tampilkan = $_SESSION['user']->selectDataAdmin("absen");
    
    if( isset($_POST["insert"]) ) {
      $_SESSION['user']->insertAbsen($_POST['idpegawai'],$_POST['waktu']);
    }

    if (isset($_GET["search-input"])) {
      $data = $_SESSION['user']->searching($_GET["search-input"],'absen');
 
      if ($data!==0) {
        $tampilkan=$data;
      }
    }

    if (isset($_GET["id"])) {
      $data = $_SESSION['user']->searching($_GET["id"],'absen');
 
      if ($data!==0) {
        $tampilkan=$data;
      }
    }

    if (isset($_GET['idabsen'])) {
        $_SESSION['user']->deleteDataAbsen($_GET['idabsen']);
    }
  }else {
    $tampilkan = $_SESSION['user']->selectDataPegawai("absen",$_SESSION['user']->username);
  }


  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="css/global.css">

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <!-- awal navbar -->
  <?php include "navbar.php";?>
  <!-- akhir navbar -->
    
    <div class="container  penggajian">
      <div class="row align-items-start">
        <div class="col mb-4">
          <h1>Employee Management System</h1>
          <h2>Attendance</h2>
        </div>
      </div>
      <div class="row align-items-center">
        <div class="col mb-2">
          <?php
            if ($isAdmin) {
              include "absen-modal.php";
            }
            ?>
        </div>
        <div class="col mb-2">
          <?php
                if ($isAdmin) {
                  include "php/search.php";
                }
              ?>
        </div>
      </div>
      <div class="row align-items-end">
        <div class="col">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">No</th>
                <th scope="col">ID Pegawai</th>
                <th scope="col">Nama</th>
                <th scope="col">ID</th>
                <th scope="col">Waktu</th>
                <?php if($isAdmin): ?>
                  <th scope="col">Action</th>
                <?php endif; ?>
              </tr>
            </thead>
            <tbody>
            <?php $num=0; ?>
            <?php foreach( $tampilkan as $row ) : ?>
              <tr>
                <th scope="row"><?= ++$num; ?></th>
                <td><?= $row['id_pegawai']; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['id_absen']; ?></td>
                <td><?= $row['waktu']; ?></td>
                
                <?php if($isAdmin): ?>
                  <td> 
                    <a onClick="javascript: return confirm('Please confirm deletion');" href="absen.php?idabsen=<?= $row['id_absen']; ?>">
                      Hapus
                    </a>
                  </td>
                <?php endif; ?>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>



  







  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>