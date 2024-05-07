<?php require_once("controller/script.php");
$_SESSION['project_sp_bayes']['name_page'] = "Diagnosa";
require_once("templates/top.php");
?>

<!-- Page Header Start -->
<div class="container-fluid py-5 mb-5 position-relative wow fadeIn" style="background-image: url('<?= $baseURL ?>assets/img/about-1.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center;">
  <!-- Gambar dengan efek gelap -->
  <div class="position-absolute top-0 start-0 end-0 bottom-0" style="background: rgba(0, 0, 0, 0.5);"></div>

  <div class="container py-5 position-relative">
    <h1 class="display-3 text-white mb-3 animated slideInDown">Diagnosa</h1>
    <nav aria-label="breadcrumb animated slideInDown">
      <ol class="breadcrumb text-uppercase mb-0">
        <li class="breadcrumb-item"><a class="text-white" href="<?= $baseURL ?>">Beranda</a></li>
        <li class="breadcrumb-item text-primary active" aria-current="page">Diagnosa</li>
      </ol>
    </nav>
  </div>
</div>
<!-- Page Header End -->

<!-- About Start -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="container-xxl py-5">
  <div class="container">
    <div class="row g-5">
      <div class="card border-0 p-5 shadow">
        <div class="card-body">
          <?php $no_tanaman = 1;
          foreach ($hasil_diagnosa as $row) : ?>
            <h2 class="mb-4">Diagnosa Gejala Tanaman <?php $result = separateAlphaNumeric($row['nama_table']);
                                                      $id_jenis_tanaman = $result['numeric'];
                                                      $takeJT = mysqli_query($conn, "SELECT * FROM jenis_tanaman WHERE id_jenis_tanaman='$id_jenis_tanaman'");
                                                      $rowJT = mysqli_fetch_assoc($takeJT);
                                                      echo $rowJT['nama_tanaman']; ?></h2>

            <?php if (!isset($_SESSION['data-diagnosa'])) { ?>
              <form action="" method="post">
                <table class="table table-hover table-borderless table-sm text-dark">
                  <thead>
                    <tr>
                      <th scope="col" class="text-center">Pilih</th>
                      <th scope="col" class="text-center">Kode</th>
                      <th scope="col" class="text-center">Gejala</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $gejala = mysqli_query($conn, "SELECT gejala.*, jenis_tanaman.nama_tanaman FROM gejala JOIN jenis_tanaman ON gejala.id_jenis_tanaman=jenis_tanaman.id_jenis_tanaman ORDER BY gejala.id_gejala ASC");
                    if (mysqli_num_rows($gejala) > 0) {
                      $no = 1;
                      while ($rowG = mysqli_fetch_assoc($gejala)) { ?>
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
                <button type="submit" name="diagnosa_gejala" class="btn btn-primary text-white border-0 mt-3 p-2">Diagnosa</button>
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
              echo "<h4 class='text-dark'>Identifikasi Kondisi</h4>
              <div class='table-responsive'>
                          <table class='table table-hover table-borderless table-sm text-dark'>
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
              echo "<h4 class='mt-4 text-dark'>Identifikasi Kondisi</h4>
              <div class='table-responsive'>
              <table class='table table-hover table-borderless table-sm text-dark'>
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
              echo "<h4 class='mt-4 text-dark'>Identifikasi Bukti (Gejala)</h3>
              <div class='table-responsive'>
              <table class='table table-hover table-borderless table-sm text-dark'>
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
              echo "<h4 class='mt-4 text-dark'>Menentukan Probabilitas Pengamatan</h4>
              <div class='table-responsive'>
              <table class='table table-hover table-borderless table-sm text-dark'>
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
                if ($totalSum != 0) {
                    $normalizedProbabilities[$condition] = $totalProbabilities[$condition] / $totalSum;
                } else {
                    $normalizedProbabilities[$condition] = 0;
                }
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
              <table class='table table-hover table-borderless table-sm text-dark'>
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

              $select_diganosa = "SELECT * FROM diagnosa ORDER BY id_diagnosa DESC LIMIT 1";
              $views_diagnosa = mysqli_query($conn, $select_diganosa);
              if (mysqli_num_rows($views_diagnosa) > 0) {
                $dataDiagnosa = mysqli_fetch_assoc($views_diagnosa);
                $id_diagnosa = $dataDiagnosa['id_diagnosa'] + 1;
              } else {
                $id_diagnosa = 1;
              }
              mysqli_query($conn, "INSERT INTO diagnosa(id_diagnosa,penyakit,nilai) VALUES('$id_diagnosa','$diagnosis','$highestProbability')");
              foreach ($gejalas as $gejala) {
                mysqli_query($conn, "INSERT INTO diagnosa_gejala(id_diagnosa,id_gejala) VALUES('$id_diagnosa','$gejala')");
              }
            ?>
              <div class="row p-0 m-0">
                <div class="col-lg-6">
                  <h3 class='mt-4 text-dark'>Evaluasi</h3>
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
                  <h3 class='mt-4 text-dark' style="line-height: 30px;">Penyakit <?= $diagnosis . " " . round($highestProbability) . "%" ?> Dengan Evaluasi Nilai Tertinggi</h3>
                  <p style="font-size: 16px;"><strong>Solusi</strong> dari penyakit ini yaitu <?php $solusi = mysqli_query($conn, "SELECT * FROM penyakit JOIN solusi ON penyakit.id_penyakit=solusi.id_penyakit WHERE penyakit.nama_penyakit='$diagnosis'");
                                                                                              $rowSolusi = mysqli_fetch_assoc($solusi);
                                                                                              echo $rowSolusi['solusi']; ?>. <strong>Pencegahan</strong> berupa <?php $pencegahan = mysqli_query($conn, "SELECT * FROM penyakit JOIN pencegahan ON penyakit.id_penyakit=pencegahan.id_penyakit WHERE penyakit.nama_penyakit='$diagnosis'");
                                                                                                                                                                                $rowSolusi = mysqli_fetch_assoc($pencegahan);
                                                                                                                                                                                echo $rowSolusi['pencegahan']; ?>. <strong>Obat</strong> yang dapat digunakan <?php $obat = mysqli_query($conn, "SELECT * FROM penyakit JOIN obat ON penyakit.id_penyakit=obat.id_penyakit WHERE penyakit.nama_penyakit='$diagnosis'");
                                                                                                                                                                                                                                                                    $rowSolusi = mysqli_fetch_assoc($obat);
                                                                                                                                                                                                                                                                    echo $rowSolusi['obat']; ?></p>
                  <form action="" method="post">
                    <button type="submit" name="reset-diagnosa" class="btn btn-primary"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                  </form>
                </div>
              </div>
          <?php }
            $no_tanaman++;
          endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- About End -->

<?php require_once("templates/bottom.php"); ?>