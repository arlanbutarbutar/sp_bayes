<?php require_once("controller/script.php");
$_SESSION['project_sp_bayes']['name_page'] = "";
require_once("templates/top.php");
?>

<!-- Header Start -->
<div class="container-fluid header bg-primary p-0 mb-5" style="height: 100vh;">
  <div class="row g-0 align-items-center flex-column-reverse flex-lg-row">
    <div class="col-lg-6 p-5 wow fadeIn" data-wow-delay="0.1s">
      <h1 class="display-4 text-white mb-5">System Pakar <br>Metode Bayes</h1>
      <div class="row g-4">
        <div class="col-sm-4">
          <div class="border-start border-light ps-4">
            <h2 class="text-white mb-1" data-toggle="counter-up"><?= $counts_gejala ?></h2>
            <p class="text-light mb-0">Gejala</p>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="border-start border-light ps-4">
            <h2 class="text-white mb-1" data-toggle="counter-up"><?= $counts_penyakit ?></h2>
            <p class="text-light mb-0">Penyakit</p>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="border-start border-light ps-4">
            <h2 class="text-white mb-1" data-toggle="counter-up"><?= $counts_diagnosa ?></h2>
            <p class="text-light mb-0">Hasil Diagnosa</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
      <div class="owl-carousel header-carousel">
        <div class="owl-carousel-item position-relative">
          <img class="img-fluid" src="<?= $baseURL ?>assets/img/carousel-1.jpg" style="height: 100vh; object-fit: cover;" alt="">
        </div>
        <div class="owl-carousel-item position-relative">
          <img class="img-fluid" src="<?= $baseURL ?>assets/img/carousel-2.jpeg" style="height: 100vh; object-fit: cover;" alt="">
        </div>
        <div class="owl-carousel-item position-relative">
          <img class="img-fluid" src="<?= $baseURL ?>assets/img/carousel-3.jpg" style="height: 100vh; object-fit: cover;" alt="">
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Header End -->


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
          $num_char = 500;
          $text = trim($data['deskripsi']);
          $text = preg_replace('#</?strong.*?>#is', '', $text);
          $lentext = strlen($text);
          if ($lentext > $num_char) {
            echo substr($text, 0, $num_char) . '...';
          } else if ($lentext <= $num_char) {
            echo substr($text, 0, $num_char);
          }
        } ?><br><br>
        <a class="btn btn-primary rounded-pill py-3 px-5 mt-3" href="tentang">Baca Lebih</a>
      </div>
    </div>
  </div>
</div>
<!-- About End -->

<!-- Appointment Start -->
<div class="container-xxl py-5">
  <div class="container">
    <div class="row g-5">
      <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
        <p class="d-inline-block border rounded-pill py-1 px-4">Kontak</p>
        <h1 class="mb-4">Buatlah Pesan Untuk Kami!</h1>
        <p class="mb-4">Selamat datang di halaman pesan kami! Kami menghargai masukan dan pertanyaan dari Anda. Mohon tinggalkan pesan atau pertanyaan di bawah ini, dan kami akan dengan senang hati membantu Anda.</p>
        <div class="bg-light rounded d-flex align-items-center p-5 mb-4">
          <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white" style="width: 55px; height: 55px;">
            <i class="fa fa-phone-alt text-primary"></i>
          </div>
          <div class="ms-4">
            <p class="mb-2">Hubungi kami sekarang</p>
            <h5 class="mb-0">+62 812-2904-5704</h5>
          </div>
        </div>
      </div>
      <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
        <div class="bg-light rounded h-100 d-flex align-items-center p-5">
          <form method="post">
            <div class="row g-3">
              <div class="col-12 col-sm-6">
                <input type="text" name="nama" class="form-control border-0" placeholder="Nama" style="height: 55px;" required>
              </div>
              <div class="col-12 col-sm-6">
                <input type="email" name="email" class="form-control border-0" placeholder="Email" style="height: 55px;" required>
              </div>
              <div class="col-12 col-sm-12">
                <input type="number" name="phone" class="form-control border-0" placeholder="Nomor Handphone" style="height: 55px;" required>
              </div>
              <div class="col-12 col-sm-12">
                <input type="text" name="subject" class="form-control border-0" placeholder="Subject" style="height: 55px;" required>
              </div>
              <div class="col-12">
                <textarea name="pesan" class="form-control border-0" rows="5" placeholder="Pesan" required></textarea>
              </div>
              <div class="col-12">
                <button class="btn btn-primary w-100 py-3" type="submit" name="kontak">Kirim</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Appointment End -->

<?php require_once("templates/bottom.php"); ?>