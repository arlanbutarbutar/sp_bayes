<?php
if (!isset($_SESSION["project_sp_bayes"]["users"])) {
  header("Location: ../auth/");
  exit;
}
