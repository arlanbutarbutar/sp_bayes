<?php require_once("../controller/script.php");
$_SESSION["project_sp_bayes"]["name_page"] = "Diagnosa";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_sp_bayes"]["name_page"] ?></h1>
  </div>

  <div class="accordion shadow" id="accordionExample">
    <?php $no_tanaman = 1;
    foreach ($diagnosa as $row) : ?>
      <div class="card">
        <div class="card-header border-0 shadow" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              <?php $result = separateAlphaNumeric($row['nama_table']);
              $id_jenis_tanaman = $result['numeric'];
              $takeJT = mysqli_query($conn, "SELECT * FROM jenis_tanaman WHERE id_jenis_tanaman='$id_jenis_tanaman'");
              $rowJT = mysqli_fetch_assoc($takeJT);
              echo $rowJT['nama_tanaman']; ?>
            </button>
          </h2>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
            <?php if (!isset($_SESSION['data-diagnosa'])) { ?>
              <form action="" method="post">
                <table class="table table-striped table-hover table-borderless table-sm display">
                  <thead>
                    <tr>
                      <th scope="col">Pilih</th>
                      <th scope="col" class="text-center">Kode</th>
                      <th scope="col" class="text-center">Gejala</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (mysqli_num_rows($views_gejala) > 0) {
                      $no = 1;
                      while ($rowG = mysqli_fetch_assoc($views_gejala)) { ?>
                        <tr>
                          <th scope="row">
                            <div class="form-check">
                              <input class="form-check-input" name="checklist[<?= $no++ ?>]" style="margin-left: 0;font-size: 20px;" type="checkbox" value="<?= $rowG['id_gejala'] ?>">
                            </div>
                          </th>
                          <td class="text-center"><?= $rowG["kode_gejala"] ?></td>
                          <td><?= $rowG["nama_gejala"] ?></td>
                        </tr>
                    <?php }
                    } ?>
                  </tbody>
                </table>
                <input type="hidden" name="id_akuisisi" value="<?= $row['id_akuisisi'] ?>">
                <button type="submit" name="diagnosa" class="btn btn-primary btn-sm rounded-0 text-white border-0 mt-3" style="height: 30px;">Diagnosa</button>
              </form>
            <?php } elseif (isset($_SESSION['data-diagnosa'])) {
              $gejalas = $_SESSION['data-diagnosa']['gejala'];

              // Tahap 1: 
              // => Identifikasi Kondisi
              $gejalaList = implode("', '", $gejalas);
              $sql = "SELECT DISTINCT penyakit.nama_penyakit FROM nilai_akuisisi 
                              JOIN gejala ON nilai_akuisisi.id_gejala=gejala.id_gejala 
                              JOIN penyakit ON nilai_akuisisi.id_penyakit=penyakit.id_penyakit 
                              WHERE gejala.id_gejala IN ('$gejalaList')";
              $result = mysqli_query($conn, $sql);
              $conditions = [];
              while ($row = mysqli_fetch_assoc($result)) {
                $conditions[] = $row['nama_penyakit'];
              }
              // => Tampilkan Data
              echo "<h3>Identifikasi Kondisi</h3><div class='table-responsive'>
                            <table class='table table-striped table-hover table-borderless table-sm display'>
                              <thead>
                                <tr>
                                  <th scope='col' class='text-center'>#</th>
                                  <th scope='col' class='text-center'>Penyakit</th>
                                </tr>
                              </thead>
                              <tbody>";
              $no = 1;
              foreach ($conditions as $rowCondition) {
                echo "<tr>
                              <th scope='row'>" . $no++ . "</th>
                              <td>" . $rowCondition . "</td></tr>";
              }
              echo "</tbody></table><hr>";

              // Tahap 2: 
              // => Tentukan Probabilitas Awal
              $initialProbabilities = [];
              foreach ($conditions as $condition) {
                $sqlProbabilitas = "SELECT bobot FROM penyakit JOIN nilai_penyakit ON penyakit.id_penyakit=nilai_penyakit.id_penyakit WHERE penyakit.nama_penyakit='$condition'";
                $result = mysqli_query($conn, $sqlProbabilitas);
                $rowProbabilitas = mysqli_fetch_assoc($result);
                $initialProbabilities[$condition] = $rowProbabilitas['bobot'];
              }
              // => Tentukan Probabilitas Awal
              echo "<h3 class='mt-4'>Identifikasi Kondisi</h3><div class='table-responsive'>
                            <table class='table table-striped table-hover table-borderless table-sm display'>
                              <thead>
                                <tr>
                                  <th scope='col' class='text-center'>#</th>
                                  <th scope='col' class='text-center'>Penyakit</th>
                                  <th scope='col' class='text-center'>Probabilitas</th>
                                </tr>
                              </thead>
                              <tbody>";
              $no = 1;
              foreach ($initialProbabilities as $penyakit => $value) {
                echo "<tr>
                              <th scope='row'>" . $no++ . "</th>
                              <td>" . $penyakit . "</td>
                              <td class='text-center'>" . $value . "</td></tr>";
              }
              echo "</tbody></table><hr>";

              // Tahap 3: Identifikasi Bukti (Gejala)
              $evidences = [];
              foreach ($gejalas as $gejala) {
                $sqlBuktiGejala = "SELECT DISTINCT nama_gejala FROM gejala WHERE id_gejala='$gejala'";
                $resultBuktiGejala = mysqli_query($conn, $sqlBuktiGejala);
                $row = mysqli_fetch_assoc($resultBuktiGejala);
                $evidences[] = $row['nama_gejala'];
              }
              // => Tampilkan Data
              echo "<h3 class='mt-4'>Identifikasi Bukti (Gejala)</h3><div class='table-responsive'>
                            <table class='table table-striped table-hover table-borderless table-sm display'>
                              <thead>
                                <tr>
                                  <th scope='col' class='text-center'>#</th>
                                  <th scope='col' class='text-center'>Gejala</th>
                                </tr>
                              </thead>
                              <tbody>";
              $no = 1;
              foreach ($evidences as $gejala) {
                echo "<tr>
                              <th scope='row'>" . $no++ . "</th>
                              <td>" . $gejala . "</td></tr>";
              }
              echo "</tbody></table><hr>";

              // Tahap 4: Tentukan Probabilitas Pengamatan
              // => Ambil data penyakit dan masukan ke array
              $penyakit = mysqli_query($conn, "SELECT * FROM penyakit WHERE id_jenis_tanaman='$id_jenis_tanaman'");
              $dataPenyakit = array();
              if (mysqli_num_rows($penyakit) > 0) {
                while ($data_penyakit = mysqli_fetch_assoc($penyakit)) {
                  $dataPenyakit[] = array(
                    "kode_penyakit" => $data_penyakit["kode_penyakit"]
                  );
                }
              }
              // => Menghitung Probabilitas Pengamatan
              $observationProbabilities = [];
              foreach ($conditions as $condition) {
                $observationProbabilities[$condition] = [];
                foreach ($evidences as $evidence) {
                  $sql = "SELECT nilai_probabilitas FROM pengamatan$id_jenis_tanaman WHERE nama_penyakit = '$condition' AND nama_gejala = '$evidence'";
                  $result = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_assoc($result);
                  $observationProbabilities[$condition][$evidence] = $row['nilai_probabilitas'];
                }
              }
              // => Tampilkan Data
              echo "<h3 class='mt-4'>Menentukan Probabilitas Pengamatan</h3><div class='table-responsive'>
                            <table class='table table-striped table-hover table-borderless table-sm display'>
                              <thead>
                                <tr>
                                  <th scope='col' class='text-center'>#</th>
                                  <th scope='col' class='text-center'>Penyakit</th>
                                  <th scope='col' class='text-center'>Gejala =><small>(Nilai Probabilitas)</small></th>
                                </tr>
                              </thead>
                              <tbody>";
              $no = 1;
              foreach ($conditions as $condition) {
                echo "<tr>
                              <th scope='row'>" . $no++ . "</th>
                              <td>" . $condition . "</td><td style='line-height: 20px;'>";
                foreach ($evidences as $evidence) {
                  $insql = "SELECT nilai_probabilitas FROM pengamatan$id_jenis_tanaman WHERE nama_penyakit = '$condition' AND nama_gejala = '$evidence'";
                  $inresult = mysqli_query($conn, $insql);
                  $inrow = mysqli_fetch_assoc($inresult);
                  echo $evidence . " => ";
                  echo $inrow['nilai_probabilitas'];
                  echo "<br>";
                }
                echo "</td></tr>";
              }
              echo "</tbody></table><hr>";

              // Tahap 5: Tentukan Probabilitas Marginal
              $marginalProbabilities = [];
              foreach ($conditions as $condition) {
                $marginalProbabilities[$condition] = 1;
                foreach ($evidences as $evidence) {
                  $marginalProbabilities[$condition] *= $observationProbabilities[$condition][$evidence];
                }
              }

              // Tahap 6: Gunakan Teorema Bayes
              $totalProbabilities = [];
              $totalSum = 0;
              foreach ($conditions as $condition) {
                $totalProbabilities[$condition] = $initialProbabilities[$condition] * $marginalProbabilities[$condition];
                $totalSum += $totalProbabilities[$condition];
              }
              // Normalisasi Probabilitas Total
              $normalizedProbabilities = [];
              foreach ($conditions as $condition) {
                $normalizedProbabilities[$condition] = $totalProbabilities[$condition] / $totalSum;
              }
              // Tentukan Diagnosa
              $diagnosis = "";
              $highestProbability = 0;
              foreach ($normalizedProbabilities as $condition => $probability) {
                if ($probability > $highestProbability) {
                  $highestProbability = $probability * 100;
                  $diagnosis = $condition;
                }
              }

              echo "<div class='table-responsive'>
                            <table class='table table-striped table-hover table-borderless table-sm display'>
                              <thead>
                                <tr>
                                  <th scope='col' class='text-center'>Penyakit</th>
                                  <th scope='col' class='text-center'>Probabilitas Awal</th>
                                  <th scope='col' class='text-center'>Probabilitas Marginal</th>
                                  <th scope='col' class='text-center'>Probabilitas Total</th>
                                </tr>
                              </thead>
                              <tbody>";
              foreach ($conditions as $condition) {
                echo "<tr><th>" . $condition . "</th>";
                echo "<td class='text-center'>" . $initialProbabilities[$condition] . "</td>";
                echo "<td class='text-center'>" . rtrim(sprintf("%.6f", $marginalProbabilities[$condition]), '0') . "</td>";
                echo "<td class='text-center'>" . rtrim(sprintf("%.6f", $totalProbabilities[$condition]), '0') . "</td>";
                echo "</td></tr>";
              }
              echo "</tbody></table>";
              mysqli_query($conn, "INSERT INTO diagnosa(id_diagnosa,penyakit,nilai) VALUES('$id_diagnosa','$diagnosis','$highestProbability')");
              foreach ($gejalas as $gejala) {
                mysqli_query($conn, "INSERT INTO diagnosa_gejala(id_diagnosa,id_gejala) VALUES('$id_diagnosa','$gejala')");
              }
            ?>
              <div class="row p-0 m-0">
                <div class="col-lg-6">
                  <h3 class='mt-4'>Evaluasi</h3>
                  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                  <canvas id="myChart"></canvas>
                  <script>
                    // Fungsi untuk mengambil data dari database
                    function fetchData() {
                      // Lakukan request ke server untuk mengambil data dari database
                      // Anda dapat menggunakan AJAX atau library HTTP request seperti axios atau fetch

                      // Contoh data yang diambil dari database
                      var dataFromDatabase = {
                        labels: [<?php foreach ($conditions as $condition) {
                                    echo "'" . $condition . ": " . round($normalizedProbabilities[$condition], 6) . "',";
                                  } ?>],
                        values: [<?php foreach ($conditions as $condition) {
                                    echo round($normalizedProbabilities[$condition], 6) . ",";
                                  } ?>]
                      };

                      // Panggil fungsi untuk membuat chart pie setelah data berhasil diambil
                      createPieChart(dataFromDatabase.labels, dataFromDatabase.values);
                    }

                    // Fungsi untuk membuat chart pie menggunakan data dari database
                    function createPieChart(labels, values) {
                      var backgroundColors = generateRandomColors(values.length); // Generate random colors

                      var data = {
                        labels: labels,
                        datasets: [{
                          data: values,
                          backgroundColor: backgroundColors
                        }]
                      };

                      var options = {
                        responsive: true
                      };

                      var ctx = document.getElementById('myChart').getContext('2d');
                      var myPieChart = new Chart(ctx, {
                        type: 'pie',
                        data: data,
                        options: options
                      });
                    }

                    // Fungsi untuk menghasilkan daftar warna acak
                    function generateRandomColors(numColors) {
                      var colors = [];
                      for (var i = 0; i < numColors; i++) {
                        var color = getRandomColor();
                        colors.push(color);
                      }
                      return colors;
                    }

                    // Fungsi untuk menghasilkan warna acak dalam format heksadesimal
                    function getRandomColor() {
                      var letters = '0123456789ABCDEF';
                      var color = '#';
                      for (var i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                      }
                      return color;
                    }

                    // Panggil fungsi fetchData untuk mengambil data dari database dan membuat chart
                    fetchData();
                  </script>
                </div>
                <div class="col-lg-6">
                  <h3 class='mt-4' style="line-height: 30px;">Penyakit <?= $diagnosis . " " . round($highestProbability) . "%" ?> Dengan Evaluasi Nilai Tertinggi</h3>
                  <p style="font-size: 16px;"><strong>Solusi</strong> dari penyakit ini yaitu <?php $solusi = mysqli_query($conn, "SELECT * FROM penyakit JOIN solusi ON penyakit.id_penyakit=solusi.id_penyakit WHERE penyakit.nama_penyakit='$diagnosis'");
                                                                                              $rowSolusi = mysqli_fetch_assoc($solusi);
                                                                                              echo $rowSolusi['solusi']; ?></p>
                  <p style="font-size: 16px;"><strong>Pencegahan</strong> dari penyakit ini yaitu <?php $pencegahan = mysqli_query($conn, "SELECT * FROM penyakit JOIN pencegahan ON penyakit.id_penyakit=pencegahan.id_penyakit WHERE penyakit.nama_penyakit='$diagnosis'");
                                                                                                  $rowSolusi = mysqli_fetch_assoc($pencegahan);
                                                                                                  echo $rowSolusi['pencegahan']; ?></p>
                  <p style="font-size: 16px;"><strong>Obat</strong> yang dapat digunakan yaitu <?php $obat = mysqli_query($conn, "SELECT * FROM penyakit JOIN obat ON penyakit.id_penyakit=obat.id_penyakit WHERE penyakit.nama_penyakit='$diagnosis'");
                                                                                                $rowSolusi = mysqli_fetch_assoc($obat);
                                                                                                echo $rowSolusi['obat']; ?></p>
                  <form action="" method="post">
                    <button type="submit" name="reset-diagnosa" class="btn btn-primary text-white mt-4"><i class="mdi mdi-reload"></i> Reset</button>
                  </form>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    <?php $no_tanaman++;
    endforeach; ?>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>