<?php require_once("controller/script.php");
$_SESSION['project_sp_bayes']['name_page'] = "Kontak";
require_once("templates/top.php");
?>

<!-- Page Header Start -->
<div class="container-fluid py-5 mb-5 position-relative wow fadeIn" style="background-image: url('<?= $baseURL ?>assets/img/about-1.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center;">
  <!-- Gambar dengan efek gelap -->
  <div class="position-absolute top-0 start-0 end-0 bottom-0" style="background: rgba(0, 0, 0, 0.5);"></div>

  <div class="container py-5 position-relative">
    <h1 class="display-3 text-white mb-3 animated slideInDown">Kontak</h1>
    <nav aria-label="breadcrumb animated slideInDown">
      <ol class="breadcrumb text-uppercase mb-0">
        <li class="breadcrumb-item"><a class="text-white" href="<?= $baseURL ?>">Beranda</a></li>
        <li class="breadcrumb-item text-primary active" aria-current="page">Contact</li>
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
          <p class="d-inline-block border rounded-pill py-1 px-4">Kontak</p>
          <h1 class="mb-4">Buatlah Pesan Untuk Kami!</h1>
          <p class="mb-4">Selamat datang di halaman pesan kami! Kami menghargai masukan dan pertanyaan dari Anda. Mohon tinggalkan pesan atau pertanyaan di bawah ini, dan kami akan dengan senang hati membantu Anda.</p>
          <form method="post">
            <div class="row g-3">
              <div class="col-md-6">
                <div class="form-floating">
                  <input type="text" name="nama" class="form-control" id="name" placeholder="Nama" required>
                  <label for="name">Nama</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating">
                  <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                  <label for="email">Email</label>
                </div>
              </div>
              <div class="col-12">
                <div class="form-floating">
                  <input type="number" name="phone" class="form-control" id="phone" placeholder="Nomor Handphone" required>
                  <label for="email">Nomor Handphone</label>
                </div>
              </div>
              <div class="col-12">
                <div class="form-floating">
                  <input type="text" name="subject" class="form-control" id="subject" placeholder="Subject" required>
                  <label for="subject">Subject</label>
                </div>
              </div>
              <div class="col-12">
                <div class="form-floating">
                  <textarea class="form-control" name="pesan" placeholder="Leave a message here" id="message" style="height: 100px" required></textarea>
                  <label for="message">Pesan</label>
                </div>
              </div>
              <div class="col-12">
                <button class="btn btn-primary w-100 py-3" type="submit" name="kontak">Send Message</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Contact End -->

<?php require_once("templates/bottom.php"); ?>