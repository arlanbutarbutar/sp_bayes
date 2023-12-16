<?php require_once("controller/script.php");
$_SESSION['project_sp_bayes']['name_page'] = "Hasil Diagnosa";
require_once("templates/top.php");
?>

<!-- Page Header Start -->
<div class="container-fluid py-5 mb-5 position-relative wow fadeIn" style="background-image: url('<?= $baseURL ?>assets/img/about-1.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center;">
  <!-- Gambar dengan efek gelap -->
  <div class="position-absolute top-0 start-0 end-0 bottom-0" style="background: rgba(0, 0, 0, 0.5);"></div>

  <div class="container py-5 position-relative">
    <h1 class="display-3 text-white mb-3 animated slideInDown">Hasil Diagnosa</h1>
    <nav aria-label="breadcrumb animated slideInDown">
      <ol class="breadcrumb text-uppercase mb-0">
        <li class="breadcrumb-item"><a class="text-white" href="<?= $baseURL ?>">Beranda</a></li>
        <li class="breadcrumb-item text-primary active" aria-current="page">Hasil Diagnosa</li>
      </ol>
    </nav>
  </div>
</div>
<!-- Page Header End -->

<!-- About Start -->
<div class="container-xxl py-5">
  <div class="container">
    <div class="row g-5">
      <div class="card border-0 p-5 shadow">
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
<!-- About End -->

<?php require_once("templates/bottom.php"); ?>