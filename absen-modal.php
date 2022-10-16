
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inputModal">
    Insert
</button>





<!-- Modal Input -->
<div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Input Page</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                
                <form method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">ID Pegawai</label>
                        <input type="text" name="idpegawai" class="form-control" id="exampleFormControlInput1" placeholder="ID Pegawai">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Waktu</label>
                        <input type="datetime-local" name="waktu" class="form-control" id="exampleFormControlInput1" placeholder="Waktu">
                    </div>
                    <button type="submit" name="insert" class="btn btn-primary">Insert</button>
                </form>

            </div>
            <div class="modal-footer">
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Page</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                
                <form method="POST">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">ID Absen</label>
                        <input type="username" class="form-control" id="exampleFormControlInput1" placeholder="id-gaji" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">ID Pegawai</label>
                        <input type="username" class="form-control" id="exampleFormControlInput1" placeholder="id-pegawai" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Waktu</label>
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
