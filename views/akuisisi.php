<?php require_once("../controller/script.php");
$_SESSION["project_sp_bayes"]["name_page"] = "Akuisisi";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_sp_bayes"]["name_page"] ?></h1>
  </div>

  <div class="row">
    <div class="col-lg-3">
      <div class="card border-0 rounded-0 shadow mt-3">
        <div class="card-body">
          <nav class="sidebar sidebar-offcanvas bg-transparent" id="sidebar">
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='akuisisi'">
                  <i class="fas fa-chevron-right"></i>
                  <span class="menu-title text-dark">Akuisisi</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='akuisisi?to=list'">
                  <i class="fas fa-chevron-right"></i>
                  <span class="menu-title text-dark">List Akuisisi</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" style="cursor: pointer;" onclick="window.location.href='akuisisi?to=probabilitas'">
                  <i class="fas fa-chevron-right"></i>
                  <span class="menu-title text-dark">List Probabilitas</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <div class="col-lg-9">
      <?php if (!isset($_GET['to'])) { ?>
        <div class="card border-0 rounded-0 shadow mt-3">
          <h5 class="card-header">Tambah Akuisisi</h5>
          <div class="card-body">
            <form action="" method="post">
              <div class="mb-3">
                <label for="id_jenis_tanaman" class="form-label">Tanaman <small class="text-danger">*</small></label>
                <select name="id_jenis_tanaman" class="form-control" aria-label="Default select example" required>
                  <option selected value="">Pilih Jenis Tanaman</option>
                  <?php foreach ($jenis_tanaman as $row_jt) : ?>
                    <option value="<?= $row_jt['id_jenis_tanaman'] ?>"><?= $row_jt['nama_tanaman'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <button type="submit" name="add_akuisisi" class="btn btn-primary btn-sm text-white rounded-0 border-0">Simpan</button>
            </form>
          </div>
        </div>
        <div class="card rounded-0 mt-3">
          <div class="card-body table-responsive">
            <table class="table table-striped table-hover table-borderless table-sm display" id="datatable">
              <thead>
                <tr>
                  <th scope="col" class="text-center">#</th>
                  <th scope="col" class="text-center">Nama Table</th>
                  <th scope="col" class="text-center">Tanaman</th>
                  <th scope="col" class="text-center">Tgl Buat</th>
                  <th scope="col" class="text-center">Tgl Ubah</th>
                  <th scope="col" class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php if (mysqli_num_rows($akuisisiAll) > 0) {
                  $no = 1;
                  while ($row = mysqli_fetch_assoc($akuisisiAll)) { ?>
                    <tr>
                      <th scope="row"><?= $no; ?></th>
                      <td><?= $row["nama_table"] ?></td>
                      <td><?php $result = separateAlphaNumeric($row['nama_table']);
                          $id_jenis_tanaman = $result['numeric'];
                          $takeJT = mysqli_query($conn, "SELECT * FROM jenis_tanaman WHERE id_jenis_tanaman='$id_jenis_tanaman'");
                          $rowJT = mysqli_fetch_assoc($takeJT);
                          echo $rowJT['nama_tanaman']; ?></td>
                      <td>
                        <div class="badge badge-opacity-success">
                          <?php $dateCreate = date_create($row["created_at"]);
                          echo date_format($dateCreate, "l, d M Y h:i a"); ?>
                        </div>
                      </td>
                      <td>
                        <div class="badge badge-opacity-warning">
                          <?php $dateUpdate = date_create($row["updated_at"]);
                          echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
                        </div>
                      </td>
                      <td class="d-flex justify-content-center">
                        <div class="col">
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $row['id_akuisisi'] ?>">
                            <i class="bi bi-trash3"></i> Hapus
                          </button>
                          <div class="modal fade" id="hapus<?= $row['id_akuisisi'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header border-bottom-0 shadow">
                                  <h5 class="modal-title" id="exampleModalLabel">Hapus data <?= $row["nama_table"] ?></h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action="" method="post">
                                  <input type="hidden" name="id_akuisisi" value="<?= $row["id_akuisisi"] ?>">
                                  <input type="hidden" name="nama_table" value="<?= $row["nama_table"] ?>">
                                  <div class="modal-body">
                                    <p>Jika anda yakin ingin menghapus data ini klik Hapus!</p>
                                  </div>
                                  <div class="modal-footer justify-content-center border-top-0">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                    <button type="submit" name="delete_akuisisi" class="btn btn-danger btn-sm">hapus</button>
                                  </div>
                                </form>
                              </div>
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
        <?php } elseif (isset($_GET['to'])) {
        if ($_GET['to'] == "list") { ?>
          <div class="accordion mt-3 shadow" id="accordionExample">
            <?php foreach ($akuisisi as $row_akuisisi) : ?>
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      <?php $result = separateAlphaNumeric($row_akuisisi['nama_table']);
                      $id_jenis_tanaman = $result['numeric'];
                      $takeJT = mysqli_query($conn, "SELECT * FROM jenis_tanaman WHERE id_jenis_tanaman='$id_jenis_tanaman'");
                      $rowJT = mysqli_fetch_assoc($takeJT);
                      echo $rowJT['nama_tanaman']; ?>
                    </button>
                  </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                  <div class="card-body table-responsive">
                    <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th scope="col" class="text-center">#</th>
                          <th scope="col" class="text-center">Kode</th>
                          <th scope="col" class="text-center">Gejala</th>
                          <?php $takeP1 = mysqli_query($conn, "SELECT * FROM penyakit WHERE id_jenis_tanaman='$id_jenis_tanaman'");
                          foreach ($takeP1 as $rowP1) : ?>
                            <th scope="col"><?= $rowP1['kode_penyakit'] ?> <i class="mdi mdi-information text-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= $rowP1['nama_penyakit'] ?>"></i></th>
                          <?php endforeach; ?>
                          <th scope="col" class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $nama_table = $row_akuisisi['nama_table'];
                        $takeAkuisisi = mysqli_query($conn, "SELECT $nama_table.*, gejala.nama_gejala, gejala.kode_gejala FROM $nama_table JOIN gejala ON $nama_table.id_gejala=gejala.id_gejala");
                        if (mysqli_num_rows($takeAkuisisi) > 0) {
                          $no_table = 1;
                          while ($row = mysqli_fetch_assoc($takeAkuisisi)) { ?>
                            <tr>
                              <th scope="row"><?= $no_table++; ?></th>
                              <td><?= $row["kode_gejala"] ?></td>
                              <td><?= $row["nama_gejala"] ?></td>
                              <form action="" method="post">
                                <?php $takeP2 = mysqli_query($conn, "SELECT * FROM penyakit WHERE id_jenis_tanaman='$id_jenis_tanaman'");
                                $no = 1;
                                $H = 1;
                                $Hv = 1;
                                foreach ($takeP2 as $rowP2) : ?>
                                  <td>
                                    <div class="form-check">
                                      <input class="form-check-input" name="checklist[<?= $no++ ?>]" style="margin-left: 0;font-size: 20px;" type="checkbox" value="Checked" <?php $id_gejala = $row['id_gejala'];
                                                                                                                                                                              $checklist = mysqli_query($conn, "SELECT * FROM akuisisi_p$id_jenis_tanaman WHERE H$H='Checked' AND id_gejala='$id_gejala'");
                                                                                                                                                                              if (mysqli_num_rows($checklist) > 0) {
                                                                                                                                                                                echo "checked";
                                                                                                                                                                              } ?>>
                                    </div>
                                  </td>
                                <?php $H++;
                                endforeach; ?>
                                <td>
                                  <input type="hidden" name="id_jenis_tanaman" value="<?= $id_jenis_tanaman ?>">
                                  <input type="hidden" name="id_gejala" value="<?= $row['id_gejala'] ?>">
                                  <input type="hidden" name="id_akuisisi" value="<?= $row_akuisisi['id_akuisisi'] ?>">
                                  <button type="submit" name="edit_akuisisi" class="btn btn-warning btn-sm rounded-0 text-white border-0" style="height: 30px;"><i class="far fa-edit"></i></button>
                                </td>
                              </form>
                            </tr>
                        <?php }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php }
        if ($_GET['to'] == "probabilitas") { ?>
          <div class="accordion mt-3 shadow" id="accordionExample">
            <?php foreach ($probabilitas as $row_pro) : ?>
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      <?php $result = separateAlphaNumeric($row_pro['nama_table']);
                      $id_jenis_tanaman = $result['numeric'];
                      $takeJT = mysqli_query($conn, "SELECT * FROM jenis_tanaman WHERE id_jenis_tanaman='$id_jenis_tanaman'");
                      $rowJT = mysqli_fetch_assoc($takeJT);
                      echo $rowJT['nama_tanaman']; ?>
                    </button>
                  </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                  <div class="card-body table-responsive">
                    <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th scope="col" class="text-center">#</th>
                          <th scope="col" class="text-center">Kode</th>
                          <?php $takeP1 = mysqli_query($conn, "SELECT * FROM penyakit WHERE id_jenis_tanaman='$id_jenis_tanaman'");
                          foreach ($takeP1 as $rowP1) : ?>
                            <th scope="col"><?= $rowP1['kode_penyakit'] ?> <i class="mdi mdi-information text-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= $rowP1['nama_penyakit'] ?>"></i></th>
                          <?php endforeach; ?>
                          <th scope="col" class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $nama_table = $row_pro['nama_table'];
                        $takeProbabilitas = mysqli_query($conn, "SELECT $nama_table.*, gejala.nama_gejala, gejala.kode_gejala FROM $nama_table JOIN gejala ON $nama_table.id_gejala=gejala.id_gejala");
                        if (mysqli_num_rows($takeProbabilitas) > 0) {
                          $no_table = 1;
                          while ($rowPro = mysqli_fetch_assoc($takeProbabilitas)) { ?>
                            <tr>
                              <th scope="row"><?= $no_table++; ?></th>
                              <td><?= $rowPro["kode_gejala"] ?></td>
                              <form action="" method="post">
                                <?php $takeP3 = mysqli_query($conn, "SELECT * FROM penyakit WHERE id_jenis_tanaman='$id_jenis_tanaman'");
                                $no = 1;
                                $H = 1;
                                foreach ($takeP3 as $rowP3) : ?>
                                  <td>
                                    <div class="mb-3">
                                      <label for="exampleFormControlInput1" class="form-label">Nilai Probabilitas</label>
                                      <input type="number" class="form-control" name="nilai_pro[<?= $no++ ?>]" value="<?= $rowPro['H' . $H] ?>" min="0" max="1" step="0.01">
                                    </div>
                                  </td>
                                <?php $H++;
                                endforeach; ?>
                                <td>
                                  <input type="hidden" name="id_jenis_tanaman" value="<?= $id_jenis_tanaman ?>">
                                  <input type="hidden" name="id_gejala" value="<?= $rowPro['id_gejala'] ?>">
                                  <input type="hidden" name="id_akuisisi" value="<?= $row_pro['id_akuisisi'] ?>">
                                  <input type="hidden" name="nama_gejala" value="<?= $rowPro['nama_gejala'] ?>">
                                  <button type="submit" name="edit_probabilitas" class="btn btn-warning btn-sm rounded-0 text-white border-0" style="height: 30px;"><i class="far fa-edit"></i></button>
                                </td>
                              </form>
                            </tr>
                        <?php }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
      <?php }
      } ?>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>