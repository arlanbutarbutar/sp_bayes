<?php require_once("controller/script.php");
$_SESSION['project_sp_bayes']['name_page'] = "Kontak";
require_once("templates/top.php");
?>

<!-- Page Header Start -->
<div class="container-fluid py-5 mb-5 position-relative wow fadeIn" style="background-image: url('<?= $baseURL ?>assets/img/about-1.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center;">
  <!-- Gambar dengan efek gelap -->
  <div class="position-absolute top-0 start-0 end-0 bottom-0" style="background: rgba(0, 0, 0, 0.5);"></div>

  <div class="container py-5 position-relative">
    <h1 class="display-3 text-white mb-3 animated slideInDown">Solusi</h1>
    <nav aria-label="breadcrumb animated slideInDown">
      <ol class="breadcrumb text-uppercase mb-0">
        <li class="breadcrumb-item"><a class="text-white" href="<?= $baseURL ?>">Beranda</a></li>
        <li class="breadcrumb-item text-primary active" aria-current="page">Solusi</li>
      </ol>
    </nav>
  </div>
</div>
<!-- Page Header End -->

<!-- Contact Start -->
<div class="container-xxl py-5">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-12 wow fadeIn" data-wow-delay="0.1s">
        <div class="bg-light rounded p-5">
          <p class="d-inline-block border rounded-pill py-1 px-4">Solusi</p>
          <h1 class="mb-4">Solusi Penyakit Tanaman Tomat Laharus</h1>
          <p class="mb-4">Untuk mengatasi masalah penyakit pada tanaman tomat, ada beberapa solusi yang dapat diterapkan. Pertama, tanamlah varietas tomat yang resisten terhadap penyakit seperti fusarium. Selain itu, naikkan suhu tanah dengan memberikan mulsa plastik bening untuk membunuh patogen penyebab penyakit. Pastikan tanah terbebas dari nematoda sebelum menanam. Gunakan bibit yang bebas dari penyakit dan hindari menanam bibit di tanah yang terinfeksi. Jika tanaman terinfeksi, segera bakar tanaman tersebut. Selain itu, pastikan pengairan menggunakan air bersih dan tanamlah benih yang resisten terhadap penyakit. Untuk menjaga kebersihan tanaman, gunakan tiang ganjaran dan berikan mulsa transparan atau plastik bening.</p>
          <table class="table table-bordered table-striped text-dark">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Penyakit</th>
                <th scope="col">Solusi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($solusi as $data) { ?>
                <tr>
                  <th class="text-dark" scope="row"><?= $no++; ?></th>
                  <td class="text-dark"><?= $data["nama_penyakit"] ?></td>
                  <td class="text-dark"><?= $data["solusi"] ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Contact End -->

<?php require_once("templates/bottom.php"); ?>