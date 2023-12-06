<?php if (!isset($_SESSION[""])) {
  session_start();
}
error_reporting(~E_NOTICE & ~E_DEPRECATED);
require_once("db_connect.php");
require_once("../models/sql.php");
require_once("functions.php");

$messageTypes = ["success", "info", "warning", "danger", "dark"];

$baseURL = "http://$_SERVER[HTTP_HOST]/apps/tugas/sp_bayes/";
$name_website = "SP Bayes";

$select_auth = "SELECT * FROM auth";
$views_auth = mysqli_query($conn, $select_auth);

if (!isset($_SESSION["project_sp_bayes"]["users"])) {
  if (isset($_SESSION["project_sp_bayes"]["time_message"]) && (time() - $_SESSION["project_sp_bayes"]["time_message"]) > 2) {
    foreach ($messageTypes as $type) {
      if (isset($_SESSION["project_sp_bayes"]["message_$type"])) {
        unset($_SESSION["project_sp_bayes"]["message_$type"]);
      }
    }
    unset($_SESSION["project_sp_bayes"]["time_message"]);
  }
  if (isset($_POST["register"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (register($conn, $validated_post, $action = 'insert') > 0) {
      header("Location: verification?en=" . $_SESSION['data_auth']['en_user']);
      exit();
    }
  }
  if (isset($_POST["re_verifikasi"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (re_verifikasi($conn, $validated_post, $action = 'update') > 0) {
      $message = "Kode token yang baru telah dikirim ke email anda.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: verification?en=" . $_SESSION['data_auth']['en_user']);
      exit();
    }
  }
  if (isset($_POST["verifikasi"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (verifikasi($conn, $validated_post, $action = 'update') > 0) {
      $message = "Akun anda berhasil di verifikasi.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: ./");
      exit();
    }
  }
  if (isset($_POST["forgot_password"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (forgot_password($conn, $validated_post, $action = 'update', $baseURL) > 0) {
      $message = "Kami telah mengirim link ke email anda untuk melakukan reset kata sandi.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: ./");
      exit();
    }
  }
  if (isset($_POST["new_password"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (new_password($conn, $validated_post, $action = 'update') > 0) {
      $message = "Kata sandi anda telah berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: ./");
      exit();
    }
  }
  if (isset($_POST["login"])) {
    if (login($conn, $_POST) > 0) {
      header("Location: ../views/");
      exit();
    }
  }
}

if (isset($_SESSION["project_sp_bayes"]["users"])) {
  $id_user = valid($conn, $_SESSION["project_sp_bayes"]["users"]["id"]);
  $id_role = valid($conn, $_SESSION["project_sp_bayes"]["users"]["id_role"]);
  $role = valid($conn, $_SESSION["project_sp_bayes"]["users"]["role"]);
  $email = valid($conn, $_SESSION["project_sp_bayes"]["users"]["email"]);
  $name = valid($conn, $_SESSION["project_sp_bayes"]["users"]["name"]);
  if (isset($_SESSION["project_sp_bayes"]["users"]["time_message"]) && (time() - $_SESSION["project_sp_bayes"]["users"]["time_message"]) > 2) {
    foreach ($messageTypes as $type) {
      if (isset($_SESSION["project_sp_bayes"]["users"]["message_$type"])) {
        unset($_SESSION["project_sp_bayes"]["users"]["message_$type"]);
      }
    }
    unset($_SESSION["project_sp_bayes"]["users"]["time_message"]);
  }
  $select_profile = "SELECT users.*, user_role.role, user_status.status 
                      FROM users
                      JOIN user_role ON users.id_role=user_role.id_role 
                      JOIN user_status ON users.id_active=user_status.id_status 
                      WHERE users.id_user='$id_user'
                    ";
  $view_profile = mysqli_query($conn, $select_profile);
  if (isset($_POST["edit_profil"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (profil($conn, $validated_post, $action = 'update', $id_user) > 0) {
      $message = "Profil Anda berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["setting"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (setting($conn, $validated_post, $action = 'update') > 0) {
      $message = "Setting pada system login berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  $select_usersCount = "SELECT * FROM users";
  $countUsers = mysqli_query($conn, $select_usersCount);
  $countUsers = mysqli_num_rows($countUsers);
  $select_gejalaCount = "SELECT * FROM gejala";
  $countGejala = mysqli_query($conn, $select_gejalaCount);
  $countGejala = mysqli_num_rows($countGejala);
  $select_penyakitCount = "SELECT * FROM penyakit";
  $countPenyakit = mysqli_query($conn, $select_penyakitCount);
  $countPenyakit = mysqli_num_rows($countPenyakit);
  $select_diagnosaCount = "SELECT * FROM diagnosa";
  $countDiagnosa = mysqli_query($conn, $select_diagnosaCount);
  $countDiagnosa = mysqli_num_rows($countDiagnosa);
  $select_diagnosaData = "SELECT * FROM diagnosa";
  $dataDiagnosa = mysqli_query($conn, $select_diagnosaData);

  $select_users = "SELECT users.*, user_role.role, user_status.status 
                    FROM users
                    JOIN user_role ON users.id_role=user_role.id_role 
                    JOIN user_status ON users.id_active=user_status.id_status
                  ";
  $views_users = mysqli_query($conn, $select_users);
  $select_user_role = "SELECT * FROM user_role";
  $views_user_role = mysqli_query($conn, $select_user_role);
  if (isset($_POST["edit_users"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (users($conn, $validated_post, $action = 'update') > 0) {
      $message = "data users berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["add_role"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (role($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Role baru berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["edit_role"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (role($conn, $validated_post, $action = 'update') > 0) {
      $message = "Role " . $_POST['roleOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["delete_role"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (role($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Role " . $_POST['role'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  $select_menu = "SELECT * 
                    FROM user_menu 
                    ORDER BY menu ASC
                  ";
  $views_menu = mysqli_query($conn, $select_menu);
  if (isset($_POST["add_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Menu baru berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["edit_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu($conn, $validated_post, $action = 'update') > 0) {
      $message = "Menu " . $_POST['menuOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["delete_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Menu " . $_POST['menu'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  $select_sub_menu = "SELECT user_sub_menu.*, user_menu.menu, user_status.status 
                        FROM user_sub_menu 
                        JOIN user_menu ON user_sub_menu.id_menu=user_menu.id_menu 
                        JOIN user_status ON user_sub_menu.id_active=user_status.id_status 
                        ORDER BY user_sub_menu.title ASC
                      ";
  $views_sub_menu = mysqli_query($conn, $select_sub_menu);
  $select_user_status = "SELECT * 
                          FROM user_status
                        ";
  $views_user_status = mysqli_query($conn, $select_user_status);
  if (isset($_POST["add_sub_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu($conn, $validated_post, $action = 'insert', $baseURL) > 0) {
      $message = "Sub Menu baru berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["edit_sub_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu($conn, $validated_post, $action = 'update', $baseURL) > 0) {
      $message = "Sub Menu " . $_POST['titleOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["delete_sub_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu($conn, $validated_post, $action = 'delete', $baseURL) > 0) {
      $message = "Sub Menu " . $_POST['title'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  $select_user_access_menu = "SELECT user_access_menu.*, user_role.role, user_menu.menu
                                FROM user_access_menu 
                                JOIN user_role ON user_access_menu.id_role=.user_role.id_role 
                                JOIN user_menu ON user_access_menu.id_menu=user_menu.id_menu
                              ";
  $views_user_access_menu = mysqli_query($conn, $select_user_access_menu);
  $select_menu_check = "SELECT user_menu.* 
                    FROM user_menu 
                    JOIN user_access_menu ON user_access_menu.id_menu=user_menu.id_menu 
                    ORDER BY user_menu.menu ASC
                  ";
  $views_menu_check = mysqli_query($conn, $select_menu_check);
  if (isset($_POST["add_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu_access($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Akses ke menu berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["edit_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu_access($conn, $validated_post, $action = 'update') > 0) {
      $message = "Akses menu " . $_POST['menu'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["delete_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu_access($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Akses menu " . $_POST['menu'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  $select_user_access_sub_menu = "SELECT user_access_sub_menu.*, user_role.role, user_sub_menu.title
                                FROM user_access_sub_menu 
                                JOIN user_role ON user_access_sub_menu.id_role=.user_role.id_role 
                                JOIN user_sub_menu ON user_access_sub_menu.id_sub_menu=user_sub_menu.id_sub_menu
                              ";
  $views_user_access_sub_menu = mysqli_query($conn, $select_user_access_sub_menu);
  $select_sub_menu_check = "SELECT user_sub_menu.* 
                    FROM user_sub_menu 
                    ORDER BY user_sub_menu.title ASC
                  ";
  $views_sub_menu_check = mysqli_query($conn, $select_sub_menu_check);
  if (isset($_POST["add_sub_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu_access($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Akses ke sub menu berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["edit_sub_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu_access($conn, $validated_post, $action = 'update') > 0) {
      $message = "Akses sub menu " . $_POST['title'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["delete_sub_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu_access($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Akses sub menu " . $_POST['title'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  $select_gejala = "SELECT gejala.*, jenis_tanaman.nama_tanaman 
                      FROM gejala 
                      JOIN jenis_tanaman ON gejala.id_jenis_tanaman=jenis_tanaman.id_jenis_tanaman 
                      ORDER BY gejala.id_gejala ASC
                    ";
  $views_gejala = mysqli_query($conn, $select_gejala);
  $jenis_tanaman = mysqli_query($conn, "SELECT * FROM jenis_tanaman");
  if (isset($_POST["add_gejala"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (gejala($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Gejala berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["edit_gejala"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (gejala($conn, $validated_post, $action = 'update') > 0) {
      $message = "Data gejala berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["delete_gejala"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (gejala($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Data gejala berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  $select_penyakit = "SELECT penyakit.*, jenis_tanaman.nama_tanaman, nilai_penyakit.bobot 
                        FROM penyakit 
                        JOIN jenis_tanaman ON penyakit.id_jenis_tanaman=jenis_tanaman.id_jenis_tanaman 
                        JOIN nilai_penyakit ON penyakit.id_penyakit=nilai_penyakit.id_penyakit 
                        ORDER BY penyakit.kode_penyakit ASC
                      ";
  $views_penyakit = mysqli_query($conn, $select_penyakit);
  if (isset($_POST["add_penyakit"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (penyakit($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Penyakit berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["edit_penyakit"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (penyakit($conn, $validated_post, $action = 'update') > 0) {
      $message = "Data penyakit berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["delete_penyakit"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (penyakit($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Data penyakit berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  $diagnosa = mysqli_query($conn, "SELECT * 
                                    FROM akuisisi 
                                    WHERE nama_table LIKE '%probabilitas%'
                                  ");
  if (isset($_POST["diagnosa"])) {
    if (diagnosa($conn, $_POST, $action = 'insert') > 0) {
      $message = "Berhasil di diagnosa silakan lihat hasilnya";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["reset-diagnosa"])) {
    unset($_SESSION['data-diagnosa']);
    header("Location: diagnosa");
    exit();
  }

  $select_solusi = "SELECT solusi.*, jenis_tanaman.nama_tanaman, penyakit.kode_penyakit, penyakit.nama_penyakit 
                      FROM solusi 
                      JOIN penyakit ON solusi.id_penyakit=penyakit.id_penyakit 
                      JOIN jenis_tanaman ON penyakit.id_jenis_tanaman=jenis_tanaman.id_jenis_tanaman 
                      ORDER BY penyakit.kode_penyakit ASC
                    ";
  $views_solusi = mysqli_query($conn, $select_solusi);
  if (isset($_POST["add_solusi"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (solusi($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Solusi berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["edit_solusi"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (solusi($conn, $validated_post, $action = 'update') > 0) {
      $message = "Data solusi berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["delete_solusi"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (solusi($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Data solusi berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  $select_obat = "SELECT obat.*, jenis_tanaman.nama_tanaman, penyakit.nama_penyakit FROM obat JOIN penyakit ON obat.id_penyakit=penyakit.id_penyakit JOIN jenis_tanaman ON penyakit.id_jenis_tanaman=jenis_tanaman.id_jenis_tanaman ORDER BY obat.id_obat ASC";
  $views_obat = mysqli_query($conn, $select_obat);
  if (isset($_POST["add_obat"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (obat($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Obat berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["edit_obat"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (obat($conn, $validated_post, $action = 'update') > 0) {
      $message = "Data obat berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["delete_obat"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (obat($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Data obat berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  $select_pencegahan = "SELECT pencegahan.*, jenis_tanaman.nama_tanaman, penyakit.nama_penyakit 
                          FROM pencegahan 
                          JOIN penyakit ON pencegahan.id_penyakit=penyakit.id_penyakit 
                          JOIN jenis_tanaman ON penyakit.id_jenis_tanaman=jenis_tanaman.id_jenis_tanaman 
                          ORDER BY pencegahan.id_pencegahan ASC
                        ";
  $views_pencegahan = mysqli_query($conn, $select_pencegahan);
  if (isset($_POST["add_pencegahan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (pencegahan($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Pencegahan berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["edit_pencegahan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (pencegahan($conn, $validated_post, $action = 'update') > 0) {
      $message = "Data pencegahan berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["delete_pencegahan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (pencegahan($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Data pencegahan berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  $select_nilai_akuisisi = "SELECT * FROM nilai_akuisisi JOIN gejala ON nilai_akuisisi.id_gejala=gejala.id_gejala JOIN penyakit ON nilai_akuisisi.id_penyakit=penyakit.id_penyakit";
  $views_nilai_akuisisi = mysqli_query($conn, $select_nilai_akuisisi);
  if (isset($_POST["add_nilai_akuisisi"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (nilai_akuisisi($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Nilai akuisisi berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["delete_nilai_akuisisi"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (nilai_akuisisi($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Data nilai akuisisi berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  $akuisisiAll = mysqli_query($conn, "SELECT * FROM akuisisi");
  $akuisisi = mysqli_query($conn, "SELECT * FROM akuisisi WHERE nama_table LIKE '%akuisisi%'");
  if (isset($_POST["add_akuisisi"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (akuisisi($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Akuisisi berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["edit_akuisisi"])) {
    if (akuisisi($conn, $_POST, $action = 'update') > 0) {
      $message = "Data akuisisi berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page?to=list");
      exit();
    }
  }
  if (isset($_POST["delete_akuisisi"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (akuisisi($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Data akuisisi berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  $probabilitas = mysqli_query($conn, "SELECT * FROM akuisisi WHERE nama_table LIKE '%probabilitas%'");
  if (isset($_POST["edit_probabilitas"])) {
    if (probabilitas($conn, $_POST, $action = 'update') > 0) {
      $message = "Data probabilitas berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_sp_bayes"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page?to=probabilitas");
      exit();
    }
  }
}
