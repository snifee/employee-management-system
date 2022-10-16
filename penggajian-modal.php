
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inputModal">
  Insert
</button>

<!-- Modal -->
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
                <label for="idpegawai">id-pegawai</label>
                <input type="text" name="idpegawai" class="form-control" id="idpegawai" placeholder="id-pegawai">
              </div>
              <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" id="tanggal" placeholder="Tanggal">
              </div>
              <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" id="exampleFormControlInput1" placeholder="Jumlah">
              </div>
              <div class="form-group">
                <label for="bonus">Bonus</label>
                <input type="number" name="bonus" class="form-control" id="exampleFormControlInput1" placeholder="Bonus">
              </div>
              <button type="submit" name="insert" class="btn btn-primary">Insert</button>
            </form>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>


<!-- Modal -->
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
              
          <form>
            <div class="form-group">
              <label for="exampleFormControlInput1">id-gaji</label>
              <input type="username" class="form-control" id="exampleFormControlInput1" placeholder="id-gaji" readonly>
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">id-pegawai</label>
              <input type="username" class="form-control" id="exampleFormControlInput1" placeholder="id-pegawai" readonly>
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Tanggal</label>
              <input type="username" class="form-control" id="exampleFormControlInput1" placeholder="id-pegawai">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Jumlah</label>
              <input type="username" class="form-control" id="exampleFormControlInput1" placeholder="id-pegawai">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Pajak</label>
              <input type="username" class="form-control" id="exampleFormControlInput1" placeholder="id-pegawai">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Bonus</label>
              <input type="username" class="form-control" id="exampleFormControlInput1" placeholder="id-pegawai">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Total</label>
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