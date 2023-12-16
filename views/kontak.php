<?php require_once("../controller/script.php");
$_SESSION["project_sp_bayes"]["name_page"] = "Kontak";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_sp_bayes"]["name_page"] ?></h1>
  </div>

  <div class="card shadow mb-4 border-0">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center">Nama</th>
              <th class="text-center">Email</th>
              <th class="text-center">Phone</th>
              <th class="text-center">Subject</th>
              <th class="text-center">Pesan</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-center">Nama</th>
              <th class="text-center">Email</th>
              <th class="text-center">Phone</th>
              <th class="text-center">Subject</th>
              <th class="text-center">Pesan</th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($views_kontak as $data) { ?>
              <tr>
                <td><?= $data['nama'] ?></td>
                <td><a href="mailto:<?= $data['email'] ?>"><?= $data['email'] ?></a></td>
                <td><a href="tel:+62<?= $data['phone'] ?>"><?= $data['phone'] ?></a></td>
                <td><?= $data['subject'] ?></td>
                <td><?= $data['pesan'] ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>