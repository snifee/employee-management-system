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
              <form method="post">
                <div class="form-group">
                  <label for="idpegawai">ID-Pegawai</label>
                  <input type="text" name="idpegawai" class="form-control" id="idpegawai" placeholder="ID-Pegawai" >
                </div>
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama">
                </div>
                <label for="jabatan">Jabatan</label>
                <select class="form-control" name="jabatan">
                    <option value="Kepala Divisi">Kepala Divisi</option>
                    <option value="Karyawan">Karyawan</option>
                    <option value="Peneliti">Peneliti</option>
                  
                </select>
                <label for="iddivisi">Divisi</label>
                <select class="form-control" name="iddivisi">
                  <?php foreach($dropDown as $val): ?>
                    <option value="<?= $val['id_divisi']; ?>"><?= $val['nama_divisi']; ?></option>
                  <?php endforeach; ?>
                </select>
                <div class="form-group">
                  <label for="status">Status</label>
                  <input type="text" name="status" class="form-control" id="status" placeholder="status">
                </div>
                <button type="submit" name="insert" class="btn btn-primary">Insert</button>
              </form>
          </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

