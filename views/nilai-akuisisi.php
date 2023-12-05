<?php require_once("../controller/script.php");
$_SESSION["project_sp_bayes"]["name_page"] = "Nilai Akuisisi";
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
            <th scope="col" class="text-center">Gejala</th>
            <th scope="col" class="text-center">Penyakit</th>
            <th scope="col" class="text-center">Aksi</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th class="text-center">#</th>
            <th class="text-center">Gejala</th>
            <th class="text-center">Penyakit</th>
            <th class="text-center">Aksi</th>
          </tr>
        </tfoot>
        <tbody>
          <?php if (mysqli_num_rows($views_nilai_akuisisi) > 0) {
            $no = 1;
            while ($row = mysqli_fetch_assoc($views_nilai_akuisisi)) { ?>
              <tr>
                <th scope="row"><?= $no; ?></th>
                <td><?= $row["nama_gejala"] ?></td>
                <td><?= $row["nama_penyakit"] ?></td>
                <td class="text-center">
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $row['id_nilai_akuisisi'] ?>">
                    <i class="bi bi-trash3"></i> Hapus
                  </button>
                  <div class="modal fade" id="hapus<?= $row['id_nilai_akuisisi'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_nilai_akuisisi" value="<?= $row['id_nilai_akuisisi'] ?>">
                          <div class="modal-body">
                            <p>Jika anda yakin ingin menghapus data ini klik Hapus!</p>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="delete_nilai_akuisisi" class="btn btn-danger btn-sm">hapus</button>
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
          <h5 class="modal-title" id="tambahLabel">Tambah Nilai Akuisisi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="id_gejala" class="form-label">Gejala <small class="text-danger">*</small></label>
              <select name="id_gejala" class="form-control" aria-label="Default select example" required>
                <option selected value="">Pilih Gejala</option>
                <?php foreach ($views_gejala as $row_g) : ?>
                  <option value="<?= $row_g['id_gejala'] ?>"><?= $row_g['kode_gejala'] . " " . $row_g['nama_gejala'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="id_penyakit" class="form-label">Penyakit <small class="text-danger">*</small></label>
              <select name="id_penyakit" class="form-control" aria-label="Default select example" required>
                <option selected value="">Pilih Penyakit</option>
                <?php foreach ($views_penyakit as $row_p) : ?>
                  <option value="<?= $row_p['id_penyakit'] ?>"><?= $row_p['kode_penyakit'] . " " . $row_p['nama_penyakit'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="modal-footer justify-content-center border-top-0">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" name="add_nilai_akuisisi" class="btn btn-primary btn-sm">Tambah</button>
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