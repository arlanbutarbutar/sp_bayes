<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once("sections/head.php"); ?>
</head>

<body>
  <?php foreach ($messageTypes as $type) {
    if (isset($_SESSION["project_sp_bayes"]["message_$type"])) {
      echo "<div class='message-$type' data-message-$type='{$_SESSION["project_sp_bayes"]["message_$type"]}'></div>";
    }
  } ?>

  <!-- Spinner Start -->
  <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div> -->
  <!-- Spinner End -->

  <?php require_once("sections/nav.php"); ?>