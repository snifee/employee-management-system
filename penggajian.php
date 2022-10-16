<?php
  include "php/user.php";

  session_start();

  if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
  }

  $isAdmin = $_SESSION['user']->getRole();
  
  if ($isAdmin) {
    $tampilkan = $_SESSION['user']->selectDataAdmin("gaji");

    if( isset($_POST["insert"]) ) {
      $_SESSION['user']->insertGaji($_POST['idpegawai'],$_POST['tanggal'],$_POST['jumlah'],$_POST['bonus']);
    }

    if (isset($_GET["search-input"])) {
      $data = $_SESSION['user']->searching($_GET["search-input"],'gaji');
 
      if ($data!==0) {
        $tampilkan=$data;
      }
    }

    if (isset($_GET["id"])) {
      $data = $_SESSION['user']->searching($_GET["id"],'gaji');
 
      if ($data!==0) {
        $tampilkan=$data;
      }
    }
    if (isset($_GET['filter'])) {
      $data=$_SESSION['user']->filterGaji($_GET['filter']);
      if ($data!==0) {
        $tampilkan=$data;
      }
    }

    if (isset($_GET['filter2'])) {
      $data=$_SESSION['user']->filterGaji2($_GET['bts1'],$_GET['bts2']);
      if ($data!==0) {
        $tampilkan=$data;
      }
    }

  }else {
    $tampilkan = $_SESSION['user']->selectDataPegawai("gaji",$_SESSION['user']->username);
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
          <h2>Salary</h2>
        </div>
      </div>
      <div class="row align-items-center">
        <div class="col mb-2">
          <?php
            if ($isAdmin) {
              include "penggajian-modal.php";
            }
            ?>
        </div>
        <div class="col mb-2">
            <?php if($isAdmin):?>
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Filter
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="penggajian.php?filter=1">Gaji diatas AVG</a>
                    <a class="dropdown-item" href="penggajian.php?filter=2">Gaji dibawah AVG</a>
                    <a class="dropdown-item" href="penggajian.php?filter=3">Jumlah atau Bonus diatas AVG</a>
                </div>
              </div>

            <?php endif; ?>
        </div>
        <div class="col mb-2">
          <?php
                if ($isAdmin) {
                  include "php/search.php";
 
                }
              ?>
        </div>
        <div class="col mb-2">
                
              <form method="GET">
                    <div class="form-row">
                      <div class="col">
                        <input type="number" name="bts1" class="form-control">
                      </div>
                      <div class="col">
                        <input type="number" name="bts2" class="form-control">
                      </div>
                      <button type="submit" name="filter2" class="btn btn-primary">Cari</button>
                    </div>
                  </form>
        </div>
      </div>
      <div class="row align-items-end">
        <div class="col" style="overflow-x: scroll;">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">No</th>
                <th scope="col">ID Pegawai</th>
                <th scope="col">Nama</th>
                <th scope="col">ID</th>
                <th scope="col">Tanggal</th>
                <th scope="col">jumlah</th>
                <th scope="col">Bonus</th>
                <th scope="col">Pajak</th>
                <th scope="col">Total</th>
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
                <td><?= $row['nama_pegawai']; ?></td>
                <td><?= $row['id_gaji']; ?></td>
                <td><?= $row['tanggal']; ?></td>
                <td>IDR <?= $row['jumlah']; ?></td>
                <td>IDR <?= $row['bonus']; ?></td>
                <td>IDR <?= $row['pajak']; ?></td>
                <td>IDR <?= $row['total']; ?></td>
                
                <?php if($isAdmin): ?>
                  <td> 
                    <a href="penggajian-edit.php?idgaji=<?= $row["id_gaji"]; ?>&id=<?= $row["id_pegawai"]; ?>&nama=<?= $row['nama_pegawai']; ?>&tgl=<?= $row['tanggal']; ?>&jml=<?= $row['jumlah']; ?>&bonus=<?= $row['bonus']; ?>">
                      Edit
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