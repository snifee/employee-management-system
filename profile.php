<?php
  include "../EMS/php/user.php";

  session_start();
  $dropDown = dropDownList();

  if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
  }

    $isAdmin = $_SESSION['user']->getRole();
    if ($isAdmin) {
        if (isset($_GET['id'])) {
            $data = $_SESSION['user']->getUserData($_GET['id']);
            $row = mysqli_fetch_assoc($data);
        }

        if( isset($_POST["savechanges"]) ) {
          $_SESSION['user']->updateProfile($_POST['idpegawai'],$_POST['noidentitas'],$_POST['nama'],$_POST['kelamin'],$_POST['tempat'],$_POST['tgl'],$_POST['pendidikan'],$_POST['almamater'],$_POST['alamat'],$_POST['domisili'],$_POST['tlp'],$_POST['email'],$_POST['divisi'],$_POST['jabatan']);
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
          <h2>Employee Profile</h2>
        </div>
        
      </div>
      <div class="row align-items-center">
        <div class="col mb-4">
            <img src="../<?=$row['foto'];?>" class="rounded" alt="...">
            </div>
        <div class="col mb-4">
            
        </div>
      </div>
      <div class="row align-items-center">
        <div class="col mb-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editPhotoModal">
                    Edit Photo
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editPassModal">
                    Edit Password
                </button>
            </div>
      </div>
      <div class="row align-items-end">
        <div class="col ">

            <form method="post">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">ID Pegawai</span>
                    </div>
                    <input type="text" class="form-control" name="idpegawai" value="<?=$row['id_pegawai']?>" aria-label="Default" aria-describedby="inputGroup-sizing-default" readonly>
                </div>
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">No identitas</span>
                    </div>
                    <input type="text" class="form-control" name="noidentitas"  value="<?=$row['no_identitas']?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Nama</span>
                    </div>
                    <input type="text" class="form-control" name="nama" value="<?=$row['nama_pegawai']?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="iddivisi">Divisi</label>
                        </div>
                            <select class="form-control" name="divisi">
                                <option value="<?= $row['id_divisi']; ?>"><?= $row['nama_divisi']; ?></option>
                            <?php foreach($dropDown as $val): ?>
                                <option value="<?= $val['id_divisi']; ?>"><?= $val['nama_divisi']; ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Jabatan</span>
                                </div>
                                <select class="form-control" name="jabatan">
                                    <option value="<?= $row['jabatan']; ?>"><?= $row['jabatan']; ?></option>
                                    <option value="Kepala Divisi">Kepala Divisi</option>
                                    <option value="Karyawan">Karyawan</option>
                                    <option value="Peneliti">Peneliti</option>
                  
                                 </select>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Kelamin</label>
                </div>
                    <select class="custom-select" name="kelamin" id="inputGroupSelect01">
                    <?php if ($row['jenis_kelamin']=="1") : ?>
                        <option <?=  "selected "; ?> value="1">Gaki</option>
                        <option  value="0">Perempuan</option>
                    <?php else : ?>
                        <option  value="1">Gaki</option>
                        <option <?= "selected" ;?> value="0">Perempuan</option>
                    <?php endif ?>
                    </select>
                </div>
                    <!-- <input type="text" class="form-control" name="kelamin" value="" aria-label="Default" aria-describedby="inputGroup-sizing-default"> -->

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Tempat</span>
                            </div>
                            <input type="text" class="form-control" name="tempat" value="<?=$row['tempat_lahir']?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Tanggal Lahir</span>
                                </div>
                                <input type="date" class="form-control" name="tgl" value="<?=$row['tanggal_lahir']?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Pendidikan</span>
                            </div>
                            <input type="text" class="form-control" name="pendidikan" value="<?=$row['pendidikan']?>"  aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Almamater</span>
                                </div>
                                <input type="text" class="form-control" name="almamater" value="<?=$row['almamater']?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                </div>



                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Alamat</span>
                            </div>
                            <input type="text" class="form-control" name="alamat" value="<?=$row['alamat']?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Domisili</span>
                                </div>
                                <input type="text" class="form-control" name="domisili" value="<?=$row['domisili']?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                </div>

                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Telepon</span>
                    </div>
                    <input type="number" class="form-control" name="tlp" value="<?=$row['telepon']?>"  aria-label="Default" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
                    </div>
                    <input type="text" class="form-control" name="email" value="<?=$row['email']?>" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Status</span>
                    </div>
                    <input type="text" class="form-control" name="status" value="<?=$row['status']?>"  aria-label="Default" aria-describedby="inputGroup-sizing-default">
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" onClick="javascript: return confirm('Please confirm Update');" name="savechanges" class="btn btn-primary">Save</button>
                    </div>
                </div>

            </form>
        </div>
           
      </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="editPhotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Page</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form>
                <div class="modal-body">

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        </div>
    </div>
    

    <!-- Modal -->
    <div class="modal fade" id="editPassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Page</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                
                <form>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Password Lama</label>
                    <input type="username" class="form-control" id="exampleFormControlInput1" placeholder="id-gaji" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Password Baru</label>
                    <input type="username" class="form-control" id="exampleFormControlInput1" placeholder="id-pegawai" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Password baru</label>
                    <input type="username" class="form-control" id="exampleFormControlInput1" placeholder="id-pegawai">
                </div>
                </form>

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
            </div>
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