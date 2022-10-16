<?php
  include "../EMS/php/user.php";

  session_start();

  if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
  }
  $dropDown = dropDownList();
  $isAdmin = $_SESSION['user']->getRole();
  
  if ($isAdmin) {
    $tampilkan = $_SESSION['user']->selectDataAdmin("pegawai");

    if( isset($_POST["insert"]) ) {
      $_SESSION['user']->insertPegawai($_POST['idpegawai'],$_POST['nama'],$_POST['jabatan'],$_POST['iddivisi'],$_POST['status']);
    }

    if (isset($_GET['divid'])) {
      $data=$_SESSION['user']->selectPegawaiInDiv($_GET['divid'],'admin');
      if ($data!==0) {
        $tampilkan=$data;
      }
  }


    if (isset($_GET["search-input"])) {
      $data = $_SESSION['user']->searching($_GET["search-input"],'');
 
      if ($data!==0) {
        $tampilkan=$data;
      }
    }
  }else {
    $tampilkan = $_SESSION['user']->selectDataPegawai("pegawai","");

    if (isset($_GET['divid'])) {
        $data=$_SESSION['user']->selectPegawaiInDiv($_GET['divid'],'user');
        if ($data!==0) {
          $tampilkan=$data;
        }
    }

    if (isset($_GET["search-input"])) {
      $data = $_SESSION['user']->searching($_GET["search-input"],'pegawai');
   
      if ($data!==0) {
        $tampilkan=$data;
      }
    }
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

    
    <div class="container pegawai">
      <div class="row align-items-start">
        <div class="col mb-4">
          <h1>Employee Management System</h1>
          <h2>Employee</h2>
        </div>
        
      </div>
      <div class="row align-items-center">
        <div class="col mb-2">


          <?php
            if ($isAdmin) {
              include "index-modal.php";
            }
          ?>
        </div>
        <div class="col mb-2">
           <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Divisi
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php foreach($dropDown as $val): ?>
                  <a class="dropdown-item" href="index.php?divid=<?= $val['nama_divisi']; ?>"><?= $val['nama_divisi']; ?></a>
                <?php endforeach; ?>
              </div>
            </div>
        </div>
        <div class="col mb-2">
        
          <?php
              if (true) {
                include "php/search.php";
              }
            ?>
        </div>
      </div>
      <div class="row align-items-end">
        <div class="col" style="overflow-x: scroll;">
          <table class="table table-sm table-bordered table-striped">
            <thead class="thead-dark">
              <tr>
                <th scope="col">NO</th>
                <th scope="col">ID</th>
                <th scope="col">Nama</th>
                <th scope="col">Divisi</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Telephone</th>
                <th scope="col">Foto</th>
                <?php if($isAdmin): ?>
                  <th scope="col">Status</th>
                  <!-- <th>No Identitas</th>
                  <th>Sex</th>
                  <th>Tempat Lahir></th>
                  <th>TGL Lahir</th>
                  <th>Pendidikan</th>
                  <th>Almamater</th>
                  <th>Alamat</th>
                  <th>Domisili</th> -->
                  <th>Email</th>
                  <th scope="col">Action</th>
                <?php endif; ?>
              </tr>
            </thead>
            <tbody>
            <?php $num=0; ?>
            <?php foreach( $tampilkan as $row ) : ?>
              <tr>
                <th scope="row"><?= ++$num; ?></th>
                <td> <?= $row['id_pegawai']; ?> </td>
                <td><?= $row['nama_pegawai']; ?></td>
                <td><?= $row['nama_divisi']; ?></td>
                <td><?= $row['jabatan']; ?></td>
                <td><?= $row['telepon']; ?></td>
                <td>
                <img src="../<?= $row["foto"]; ?>" width="70">
                </td>
                
                <?php if($isAdmin): ?>
                  <td><?= $row['status']; ?></td>
                  <!-- <td><?= $row['no_identitas']; ?></td>
                  <td><?= $row['jenis_kelamin']; ?></td>
                  <td><?= $row['tempat_lahir']; ?></td>
                  <td><?= $row['tanggal_lahir']; ?></td>
                  <td><?= $row['pendidikan']; ?></td>
                  <td><?= $row['almamater']; ?></td>
                  <td><?= $row['alamat']; ?></td>
                  <td><?= $row['domisili']; ?></td> -->
                  <td><?= $row['email']; ?></td>
                  <td> 
                    <!-- <a href="index.php?id=<?= $row["id_pegawai"]; ?>" data-toggle="modal" data-target="#editModal">
                      View
                    </a> -->
                  <a href="profile.php?id=<?= $row['id_pegawai']; ?>"> Profile</a><br>
                  <a href="absen.php?id=<?= $row['id_pegawai']; ?>"> Absen</a><br>
                  <a href="penggajian.php?id=<?= $row['id_pegawai']; ?>"> Gaji</a>
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