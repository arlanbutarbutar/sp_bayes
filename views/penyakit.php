<?php require_once("../controller/script.php");
$_SESSION["project_sp_bayes"]["name_page"] = "Penyakit";
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
            <th scope="col" class="text-center">Penyakit</th>
            <th scope="col" class="text-center">Kode</th>
            <th scope="col" class="text-center">Bobot</th>
            <th scope="col" class="text-center">Aksi</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th class="text-center">#</th>
            <th class="text-center">Nama Tanaman</th>
            <th class="text-center">Penyakit</th>
            <th class="text-center">Kode</th>
            <th class="text-center">Bobot</th>
            <th class="text-center">Aksi</th>
          </tr>
        </tfoot>
        <tbody>
          <?php if (mysqli_num_rows($views_penyakit) > 0) {
            $no = 1;
            while ($row = mysqli_fetch_assoc($views_penyakit)) { ?>
              <tr>
                <th scope="row"><?= $no; ?></th>
                <td><?= $row["nama_tanaman"] ?></td>
                <td><?= $row["nama_penyakit"] ?></td>
                <td><?= $row["kode_penyakit"] ?></td>
                <td><?= $row["bobot"] ?></td>
                <td class="text-center">
                  <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $row['id_penyakit'] ?>">
                    <i class="bi bi-pencil-square"></i> Ubah
                  </button>
                  <div class="modal fade" id="ubah<?= $row['id_penyakit'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $row['nama_penyakit'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_penyakit" value="<?= $row["id_penyakit"] ?>">
                          <input type="hidden" name="nama_penyakitOld" value="<?= $row["nama_penyakit"] ?>">
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="id_jenis_tanaman" class="form-label">Nama Tanaman <small class="text-danger">*</small></label>
                              <select name="id_jenis_tanaman" class="form-control" aria-label="Default select example" required>
                                <option selected value="<?= $row['id_jenis_tanaman'] ?>"><?= $row['nama_tanaman'] ?></option>
                                <?php $id_jenis_tanaman = $row['id_jenis_tanaman'];
                                $selectJT = mysqli_query($conn, "SELECT * FROM jenis_tanaman WHERE id_jenis_tanaman!='$id_jenis_tanaman'");
                                foreach ($selectJT as $row_jt) : ?>
                                  <option value="<?= $row_jt['id_jenis_tanaman'] ?>"><?= $row_jt['nama_tanaman'] ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="nama_penyakit" class="form-label">Nama Penyakit <small class="text-danger">*</small></label>
                              <input type="text" name="nama_penyakit" value="<?= $row["nama_penyakit"] ?>" class="form-control text-center" id="nama_penyakit" minlength="3" placeholder="Nama Penyakit" required>
                            </div>
                            <div class="form-group">
                              <label for="bobot" class="form-label">Bobot <span class="nilaiBobot<?= $row["id_penyakit"] ?>">0</span></label><br>
                              <input type="range" name="bobot" value="<?= $row["bobot"] ?>" class="form-range" id="mySlider<?= $row["id_penyakit"] ?>" placeholder="Bobot" min="0" max="1" step="0.01" required>
                              <script>
                                const slider<?= $row["id_penyakit"] ?> = document.getElementById("mySlider<?= $row["id_penyakit"] ?>");
                                const output<?= $row["id_penyakit"] ?> = document.querySelector(".nilaiBobot<?= $row["id_penyakit"] ?>");
                                output<?= $row["id_penyakit"] ?>.innerHTML = slider<?= $row["id_penyakit"] ?>.value;

                                slider<?= $row["id_penyakit"] ?>.oninput = function() {
                                  output<?= $row["id_penyakit"] ?>.innerHTML = this.value;
                                }
                              </script>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="edit_penyakit" class="btn btn-warning btn-sm">Ubah</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $row['id_penyakit'] ?>">
                    <i class="bi bi-trash3"></i> Hapus
                  </button>
                  <div class="modal fade" id="hapus<?= $row['id_penyakit'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row['nama_penyakit'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_penyakit" value="<?= $row['id_penyakit'] ?>">
                          <div class="modal-body">
                            <p>Jika anda yakin ingin menghapus data ini klik Hapus!</p>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="delete_penyakit" class="btn btn-danger btn-sm">hapus</button>
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
          <h5 class="modal-title" id="tambahLabel">Tambah Penyakit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="id_jenis_tanaman" class="form-label">Nama Tanaman <small class="text-danger">*</small></label>
              <select name="id_jenis_tanaman" class="form-control" aria-label="Default select example" required>
                <option selected value="">Pilih Jenis Tanaman</option>
                <?php foreach ($jenis_tanaman as $row_jt) : ?>
                  <option value="<?= $row_jt['id_jenis_tanaman'] ?>"><?= $row_jt['nama_tanaman'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="nama_penyakit" class="form-label">Nama Penyakit <small class="text-danger">*</small></label>
              <input type="text" name="nama_penyakit" class="form-control text-center" id="nama_penyakit" minlength="3" placeholder="Nama Penyakit" required>
            </div>
            <div class="form-group">
              <label for="bobot" class="form-label">Bobot <span class="nilaiBobotAdd">0</span></label>
              <input type="range" name="bobot" class="form-range" id="mySliderAdd" placeholder="Bobot" min="0" max="1" step="0.01" required>
            </div>
          </div>
          <div class="modal-footer justify-content-center border-top-0">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" name="add_penyakit" class="btn btn-primary btn-sm">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    const sliderAdd = document.getElementById("mySliderAdd");
    const outputAdd = document.querySelector(".nilaiBobotAdd");
    outputAdd.innerHTML = sliderAdd.value;

    sliderAdd.oninput = function() {
      outputAdd.innerHTML = this.value;
    }
  </script>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>