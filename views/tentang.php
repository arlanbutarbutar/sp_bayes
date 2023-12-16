<?php require_once("../controller/script.php");
$_SESSION["project_sp_bayes"]["name_page"] = "Tentang";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_sp_bayes"]["name_page"] ?></h1>
  </div>

  <div class="card shadow mb-4 border-0">
    <div class="card-body">
      <?php foreach ($tentang as $data) : ?>
        <form action="" method="post">
          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3"><?= $data['deskripsi'] ?></textarea>
          </div>
          <button type="submit" name="edit_tentang" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Ubah</button>
        </form>
      <?php endforeach; ?>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>