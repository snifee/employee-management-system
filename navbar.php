<?php
  if (isset($_POST["logout"])) {
    header("Location: php/logout.php");
  }

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Evil Corp</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/EMS/index.php">Employee</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/EMS/penggajian.php">Salary</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/EMS/absen.php">Attendance</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/EMS/divisi.php">Division</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/EMS/account.php">Account</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#logoutModal">Logout</a>
      </li>

    </ul>
  </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <form action="" method="post">
        <button type="submit" class="btn btn-primary" name="logout" " >Logout</button>
        </form>
        
      </div>
    </div>
  </div>
</div>