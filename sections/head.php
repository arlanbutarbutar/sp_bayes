<meta charset="utf-8">
<title>
  <?= $name_website ?> <?php if ($_SESSION['project_sp_bayes']['name_page'] != "") {
                          echo " - " . $_SESSION['project_sp_bayes']['name_page'];
                        } ?>
</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta content="" name="keywords">
<meta content="" name="description">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet">

<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="<?= $baseURL ?>assets/lib/animate/animate.min.css" rel="stylesheet">
<link href="<?= $baseURL ?>assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="<?= $baseURL ?>assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

<!-- Customized Bootstrap Stylesheet -->
<link href="<?= $baseURL ?>assets/css/bootstrap.min.css" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="<?= $baseURL ?>assets/css/style.css" rel="stylesheet">

<!-- Custom styles for plugin -->
<script src="<?= $baseURL ?>assets/sweetalert/dist/sweetalert2.all.min.js"></script>