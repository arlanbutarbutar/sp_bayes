<?php require_once("../controller/script.php");
$_SESSION["project_sp_bayes"]["name_page"] = "Solusi";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_sp_bayes"]["name_page"] ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambah"><i class="bi bi-plus-lg"></i> Tambah</a>
  </div>

  <div class="card border-0 shadow">
    <div class="card-body table-responsive">
      <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th scope="col" class="text-center">#</th>
            <th scope="col" class="text-center">Nama Tanaman</th>
            <th scope="col" class="text-center">Kode</th>
            <th scope="col" class="text-center">Penyakit</th>
            <th scope="col" class="text-center">Solusi</th>
            <th scope="col" class="text-center">Aksi</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th class="text-center">#</th>
            <th class="text-center">Nama Tanaman</th>
            <th class="text-center">Kode</th>
            <th class="text-center">Penyakit</th>
            <th class="text-center">Solusi</th>
            <th class="text-center">Aksi</th>
          </tr>
        </tfoot>
        <tbody>
          <?php if (mysqli_num_rows($views_solusi) > 0) {
            $no = 1;
            while ($row = mysqli_fetch_assoc($views_solusi)) { ?>
              <tr>
                <th scope="row"><?= $no; ?></th>
                <td><?= $row["nama_tanaman"] ?></td>
                <td><?= $row["kode_penyakit"] ?></td>
                <td><?= $row["nama_penyakit"] ?></td>
                <td><textarea name="solusi" class="form-control border-0 rounded-0" id="solusi" style="height: 100px;width: 500px;line-height: 20px;" placeholder="Solusi penyakit"><?= $row['solusi'] ?></textarea></td>
                <td class="text-center">
                  <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $row['id_solusi'] ?>">
                    <i class="bi bi-pencil-square"></i> Ubah
                  </button>
                  <div class="modal fade" id="ubah<?= $row['id_solusi'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $row['nama_penyakit'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_solusi" value="<?= $row['id_solusi'] ?>">
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="solusi" class="form-label">Solusi <small class="text-danger">*</small></label>
                              <textarea name="solusi" class="form-control" id="solusi" style="height: 100px;" placeholder="Solusi penyakit"><?= $row['solusi'] ?></textarea>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="edit_solusi" class="btn btn-warning btn-sm">Ubah</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $row['id_solusi'] ?>">
                    <i class="bi bi-trash3"></i> Hapus
                  </button>
                  <div class="modal fade" id="hapus<?= $row['id_solusi'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row['nama_penyakit'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_solusi" value="<?= $row['id_solusi'] ?>">
                          <div class="modal-body">
                            <p>Jika anda yakin ingin menghapus data ini klik Hapus!</p>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="delete_solusi" class="btn btn-danger btn-sm">hapus</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
          <?php $no++;
            }
          } ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-bottom-0 shadow">
          <h5 class="modal-title" id="tambahLabel">Tambah Solusi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="id_penyakit" class="form-label">Penyakit <small class="text-danger">*</small></label>
              <select name="id_penyakit" class="form-control" aria-label="Default select example" required>
                <option selected value="">Pilih Penyakit</option>
                <?php foreach ($views_penyakit as $rowP) : ?>
                  <option value="<?= $rowP['id_penyakit'] ?>"><?= $rowP['nama_penyakit'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="solusi" class="form-label">Solusi <small class="text-danger">*</small></label>
              <textarea name="solusi" class="form-control" id="solusi" style="height: 100px;" placeholder="Solusi penyakit"></textarea>
            </div>
          </div>
          <div class="modal-footer justify-content-center border-top-0">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" name="add_solusi" class="btn btn-primary btn-sm">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>