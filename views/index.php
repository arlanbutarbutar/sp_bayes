<?php require_once("../controller/script.php");
$_SESSION["project_sp_bayes"]["name_page"] = "";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <a href="users" class="text-decoration-none">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  Users</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countUsers ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <a href="gejala" class="text-decoration-none">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                  Gejala</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countGejala ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <a href="penyakit" class="text-decoration-none">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Penyakit
                </div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $countPenyakit ?></div>
                  </div>
                  <div class="col">
                    <div class="progress progress-sm mr-2">
                      <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <a href="diagnosa" class="text-decoration-none">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                  Diagnosa</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countDiagnosa ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-comments fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-lg-12 mb-4">

      <!-- Illustrations -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Hasil Diagnosa</h6>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Tgl Diagnosa</th>
                <th scope="col" class="text-center">Gejala</th>
                <th scope="col" class="text-center">Penyakit</th>
                <th scope="col" class="text-center">Nilai</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th class="text-center">#</th>
                <th scope="col" class="text-center">Tgl Diagnosa</th>
                <th scope="col" class="text-center">Gejala</th>
                <th scope="col" class="text-center">Penyakit</th>
                <th scope="col" class="text-center">Nilai</th>
              </tr>
            </tfoot>
            <tbody>
              <?php if (mysqli_num_rows($dataDiagnosa) > 0) {
                $no = 1;
                while ($row = mysqli_fetch_assoc($dataDiagnosa)) { ?>
                  <tr>
                    <th scope="row"><?= $no; ?></th>
                    <td><?= $row["tanggal"] ?></td>
                    <td><?php $id_diagnosa = $row["id_diagnosa"];
                        $select_diagnosa_gejala = "SELECT gejala.nama_gejala FROM diagnosa_gejala JOIN gejala ON diagnosa_gejala.id_gejala=gejala.id_gejala WHERE diagnosa_gejala.id_diagnosa='$id_diagnosa'";
                        $views_diagnosa_gejala = mysqli_query($conn, $select_diagnosa_gejala);
                        while ($row_dGejala = mysqli_fetch_assoc($views_diagnosa_gejala)) {
                          echo "- " . $row_dGejala['nama_gejala'] . "<br>";
                        }
                        ?></td>
                    <td><?= $row["penyakit"] ?></td>
                    <td><?= round($row["nilai"]) . "% (" . round($row["nilai"], 2) . ")" ?></td>
                  </tr>
              <?php $no++;
                }
              } ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>