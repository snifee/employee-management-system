<?php

  include "php/user.php";




  session_start();

  if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
  }

  $isAdmin = $_SESSION['user']->getRole();
  $dropDown = dropDownList();

  if ($isAdmin) {
    if (isset($_GET['id'])) {
      $data = $_SESSION['user']->selectDivisiInfo();
    }else {
      $data = $_SESSION['user']->selectDivisiInfo();
    }
    if( isset($_POST["submitdiv"]) ) {
      $_SESSION['user']->insertDivisi($_POST['iddivisi'],$_POST['namadivisi']);
    }


    if (isset($_POST['edit'])) {
      $_SESSION['user']->updateDivisi($_POST['iddivisi'],$_POST['namadivisi'],$_POST['ketua']);
    }
  }else{


    $data = $_SESSION['user']->selectDivisiInfo();
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
  <title>Divisi</title>
</head>
<body>
  <!-- awal navbar -->
  <?php include "navbar.php";?>
    <!-- akhir navbar -->
    
    <div class="container  divisi">
      <div class="row align-items-start">
        <div class="col mb-4">
          <h1>Employee Management System</h1>
          <h2>Division</h2>
        </div>
        
      </div>
      <div class="row align-items-center">
        <div class="col  mb-2">
            
            <?php
              if ($isAdmin) {
                include "divisi-modal.php";
              }
            ?>
        </div>
        <div class="col mb-2">

        </div>
      </div>
      <div class="row align-items-end" style="overflow-x: scroll;">
        <div class="col">
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">No</th>
                <!-- <?php if($isAdmin): ?>
                  <th scope="col">Action</th>
                <?php endif; ?> -->
                <th scope="col">ID Divisi</th>
                <th scope="col">Nama</th>
                <th scope="col">Jumlah Pegawai</th>
                <th scope="col">Kepala</th>
              </tr>
            </thead>
            <tbody>
            <?php $num=0; ?>
            <?php foreach( $data as $row ) : ?>
              <tr>
                <th scope="row"><?= ++$num; ?></th>
                <td>
                    <?php if($isAdmin): ?>
                      <!-- <a href="profile.php?id=<?= $row['id_divisi']; ?>"> <?= $row['id_divisi']; ?> </a> -->
                      <?= $row['id_divisi']; ?>
                    <?php else :?>
                      <?= $row['id_divisi']; ?>
                    <?php endif; ?>
                </td>
                <td><?= $row['nama_divisi']; ?></td>
                <td><?= $row['jml_pegawai']; ?></td>
                <td>
                <a href="profile.php?id=<?= $row['ketua']; ?>"> <?= $row['ketua']; ?></a><br>
                </td>
                
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