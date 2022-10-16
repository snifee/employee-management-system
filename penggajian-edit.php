<?php
  include "../EMS/php/user.php";

  session_start();

  if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
  }

    $isAdmin = $_SESSION['user']->getRole();
    
    if ($isAdmin) {
        if (!isset($_GET['idgaji'])) {
            header("Location: penggajian.php");
        }
        if (isset($_POST['editSalary'])) {
           var_dump("hello");
           var_dump($_POST['idpegawai']);
           $_SESSION['user']->updateGaji($_POST['idpegawai'],$_POST['idgaji'],$_POST['tgl'],$_POST['jumlah'],$_POST['bonus']);
       }

    }else {
        header("Location: index.php");
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
    
    <div class="container w-50 p-3 account">
      <div class="row align-items-start">
        <div class="col mb-4">
          <h1>Employee Management System</h1>
          <h2>Edit Salary</h2>
        </div>
        
      </div>
      <div class="row align-items-center">
    
      </div>
      <div class="row align-items-end">
        <div class="col ">

            <form method="POST">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">ID Pegawai</span>
                    </div>
                    <input type="text" class="form-control" name="idpegawai" value="<?=$_GET['id']?>" aria-label="Default" aria-describedby="inputGroup-sizing-default" readonly>
                </div>
                
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Nama</span>
                    </div>
                    <input type="text" class="form-control" name="nama" value="<?=$_GET['nama']?>" aria-label="Default" aria-describedby="inputGroup-sizing-default" readonly>
                </div>

   
                <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Tanggal</span>
                        </div>
                        <input type="date" class="form-control" name="tgl" value="<?=$_GET['tgl']?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                </div>


                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">ID Gaji</span>
                    </div>
                    <input type="number" class="form-control" name="idgaji" value="<?=$_GET['idgaji']?>"  aria-label="Default" aria-describedby="inputGroup-sizing-default" readonly>
                </div>

                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Jumlah</span>
                    </div>
                    <input type="number" class="form-control" name="jumlah" value="<?=$_GET['jml']?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                </div>

                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Bonus</span>
                    </div>
                    <input type="number" class="form-control" name="bonus" value="<?=$_GET['bonus']?>"  aria-label="Default" aria-describedby="inputGroup-sizing-default">
                </div>

                <div class="form-group row">
                    

                    <div class="col-sm-10">
                        <button onClick="javascript: return confirm('Please confirm edit');" type="submit" class="btn btn-primary" name="editSalary">
                            Save Changes
                        </button>
                    </div>
                </div>

            </form>
        </div>
           
      </div>
    </div>

   <!-- footer -->
   <!-- <?php 
    include "footer.php";
   ?> -->
   <!-- akhir footer -->


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>