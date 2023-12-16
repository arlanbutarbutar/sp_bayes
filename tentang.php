<?php require_once("controller/script.php");
$_SESSION['project_sp_bayes']['name_page'] = "Tentang";
require_once("templates/top.php");
?>

<!-- Page Header Start -->
<div class="container-fluid py-5 mb-5 position-relative wow fadeIn" style="background-image: url('<?= $baseURL ?>assets/img/about-1.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center;">
  <!-- Gambar dengan efek gelap -->
  <div class="position-absolute top-0 start-0 end-0 bottom-0" style="background: rgba(0, 0, 0, 0.5);"></div>

  <div class="container py-5 position-relative">
    <h1 class="display-3 text-white mb-3 animated slideInDown">Tentang</h1>
    <nav aria-label="breadcrumb animated slideInDown">
      <ol class="breadcrumb text-uppercase mb-0">
        <li class="breadcrumb-item"><a class="text-white" href="<?= $baseURL ?>">Beranda</a></li>
        <li class="breadcrumb-item text-primary active" aria-current="page">Tentang</li>
      </ol>
    </nav>
  </div>
</div>
<!-- Page Header End -->

<!-- About Start -->
<div class="container-xxl py-5">
  <div class="container">
    <div class="row g-5">
      <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
        <div class="d-flex flex-column">
          <img class="img-fluid rounded w-100 align-self-end" src="<?= $baseURL ?>assets/img/about-1.jpg" alt="">
        </div>
      </div>
      <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
        <p class="d-inline-block border rounded-pill py-1 px-4">Tentang</p>
        <h1 class="mb-4">Sistem Pakar Metode Bayes</h1>
        <?php foreach ($tentang as $data) {
          echo $data['deskripsi'];
        } ?>
      </div>
    </div>
  </div>
</div>
<!-- About End -->

<?php require_once("templates/bottom.php"); ?>