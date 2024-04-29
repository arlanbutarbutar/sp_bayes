<?php require_once("../controller/script.php");
$_SESSION["project_sp_bayes"]["name_page"] = "Hasil Diagnosa";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_sp_bayes"]["name_page"] ?></h1>
  </div>


  <div class="card border-0 shadow">
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
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>