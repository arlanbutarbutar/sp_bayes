<?php if (!isset($_SESSION)) {
  session_start();
}
require_once("../controller/script.php");
if (isset($_SESSION["project_sp_bayes"])) {
  unset($_SESSION["project_sp_bayes"]);
  header("Location: ./");
  exit();
}
