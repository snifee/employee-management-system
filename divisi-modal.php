<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inputModal">
    Insert
</button>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
    Edit
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
                
                <form method="POST">
                    <div class="form-group">
                        <label for="iddivisi">ID Divisi</label>
                        <input type="username" name="iddivisi" class="form-control" id="exampleFormControlInput1" placeholder="ID Divisi">
                    </div>
                    <div class="form-group">
                        <label for="namadivisi">Nama Divisi</label>
                        <input type="username" name="namadivisi" class="form-control" id="exampleFormControlInput1" placeholder="Nama Divisi">
                    </div>
                    <button type="submit" name="submitdiv" class="btn btn-primary">Insert</button>
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
                <label for="iddivisi">Divisi</label>
                <select class="form-control" name="iddivisi">
                  <?php foreach($dropDown as $val): ?>
                    <option value="<?= $val['id_divisi']; ?>"><?= $val['nama_divisi']; ?></option>
                  <?php endforeach; ?>
                </select>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama Divisi</label>
                        <input type="username" name="namadivisi" class="form-control" id="exampleFormControlInput1" placeholder="Nama Divisi">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Kepala Divisi</label>
                        <input type="username" name="ketua" class="form-control" id="exampleFormControlInput1" placeholder="id pegawai">
                    </div>
                    <button type="submit" name=edit class="btn btn-primary">Save changes</button>
                </form>

            </div>
            <div class="modal-footer">
            </div>
        </div>
        </div>
    </div>