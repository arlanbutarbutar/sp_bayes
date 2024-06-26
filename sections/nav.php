<!-- Topbar Start -->
<div class="container-fluid bg-light p-0 wow fadeIn" data-wow-delay="0.1s">
  <div class="row gx-0 d-none d-lg-flex">
    <div class="col-lg-7 px-5 text-start">
      <div class="h-100 d-inline-flex align-items-center">
        <a class="btn btn-sm-square rounded-circle bg-white text-primary me-1" href="#"><i class="fab fa-facebook-f"></i></a>
        <a class="btn btn-sm-square rounded-circle bg-white text-primary me-1" href="#"><i class="fab fa-twitter"></i></a>
        <a class="btn btn-sm-square rounded-circle bg-white text-primary me-1" href="#"><i class="fab fa-linkedin-in"></i></a>
        <a class="btn btn-sm-square rounded-circle bg-white text-primary me-0" href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
    <div class="col-lg-5 px-5 text-end">
      <a href="<?= $baseURL ?>auth/">
        <div class="h-100 d-inline-flex align-items-center py-3 me-4">
          <small class="fas fa-sign-in-alt text-primary me-2"></small>
          <small>Masuk</small>
        </div>
      </a>
      <a href="<?= $baseURL ?>auth/register">
        <div class="h-100 d-inline-flex align-items-center py-3">
          <small class="fas fa-user-plus text-primary me-2"></small>
          <small>Daftar</small>
      </a>
    </div>
  </div>
</div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 wow fadeIn" data-wow-delay="0.1s">
  <a href="<?= $baseURL ?>" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
    <h1 class="m-0 text-primary"><i class="far fa-hospital me-3"></i>SP Bayes</h1>
  </a>
  <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <div class="navbar-nav ms-auto p-4 p-lg-0">
      <a href="<?= $baseURL ?>" class="nav-item nav-link">Beranda</a>
      <a href="<?= $baseURL ?>tentang" class="nav-item nav-link">Tentang</a>
      <!-- <a href="<?= $baseURL ?>hasil-diagnosa" class="nav-item nav-link">Hasil Diagnosa</a>
      <a href="<?= $baseURL ?>obat" class="nav-item nav-link">Obat</a>
      <a href="<?= $baseURL ?>solusi" class="nav-item nav-link">Solusi</a> -->
      <a href="<?= $baseURL ?>kontak" class="nav-item nav-link">Kontak</a>
    </div>
    <a href="<?= $baseURL ?>diagnosa" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Diagnosa<i class="fa fa-arrow-right ms-3"></i></a>
  </div>
</nav>
<!-- Navbar End -->