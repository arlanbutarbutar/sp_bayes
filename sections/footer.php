<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer mt-5 wow fadeIn" data-wow-delay="0.1s">
  <div class="container">
    <div class="copyright">
      <div class="row">
        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
          &copy; <a class="border-bottom" href="https://wasd.netmedia-framecode.com" target="_blank">WASD Netmedia Framecode</a>, All Right Reserved.
        </div>
        <div class="col-md-6 text-center text-md-end">
          Develop By <a class="border-bottom" href="https://pddikti.kemdikbud.go.id/data_mahasiswa/RkExOEFFRTItMjIxQy00OTAyLTlGOUYtQkJFQzRDM0ExMDAz" target="_blank">JULIANE IVY BOU</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= $baseURL ?>assets/lib/wow/wow.min.js"></script>
<script src="<?= $baseURL ?>assets/lib/easing/easing.min.js"></script>
<script src="<?= $baseURL ?>assets/lib/waypoints/waypoints.min.js"></script>
<script src="<?= $baseURL ?>assets/lib/counterup/counterup.min.js"></script>
<script src="<?= $baseURL ?>assets/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="<?= $baseURL ?>assets/lib/tempusdominus/js/moment.min.js"></script>
<script src="<?= $baseURL ?>assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="<?= $baseURL ?>assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="<?= $baseURL ?>assets/js/main.js"></script>

<script>
  const showMessage = (type, title, message) => {
    if (message) {
      Swal.fire({
        icon: type,
        title: title,
        text: message,
      });
    }
  };

  showMessage("success", "Berhasil Terkirim", $(".message-success").data("message-success"));
  showMessage("info", "For your information", $(".message-info").data("message-info"));
  showMessage("warning", "Peringatan!!", $(".message-warning").data("message-warning"));
  showMessage("error", "Kesalahan", $(".message-danger").data("message-danger"));
</script>