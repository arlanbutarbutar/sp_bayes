<?php
function valid($conn, $value)
{
  $valid = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $value))));
  return $valid;
}

function separateAlphaNumeric($string)
{
  $alpha = "";
  $numeric = "";
  // Mengiterasi setiap karakter dalam string
  for ($i = 0; $i < strlen($string); $i++) {
    // Memeriksa apakah karakter adalah huruf
    if (ctype_alpha($string[$i])) {
      $alpha .= $string[$i];
    }
    // Memeriksa apakah karakter adalah angka
    if (ctype_digit($string[$i])) {
      $numeric .= $string[$i];
    }
  }
  // Mengembalikan array yang berisi huruf dan angka terpisah
  return array(
    "alpha" => $alpha,
    "numeric" => $numeric
  );
}

function generateToken()
{
  // Generate a random 6-digit number
  $token = mt_rand(100000, 999999);
  return $token;
}

function compressImage($source, $destination, $quality)
{
  // mendapatkan info image
  $imgInfo = getimagesize($source);
  $mime = $imgInfo['mime'];
  // membuat image baru
  switch ($mime) {
      // proses kode memilih tipe tipe image 
    case 'image/jpeg':
      $image = imagecreatefromjpeg($source);
      break;
    case 'image/png':
      $image = imagecreatefrompng($source);
      break;
    default:
      $image = imagecreatefromjpeg($source);
  }

  // Menyimpan image dengan ukuran yang baru
  imagejpeg($image, $destination, $quality);

  // Return image
  return $destination;
}

if (!isset($_SESSION["project_sp_bayes"]["users"])) {
  function register($conn, $data, $action)
  {
    if ($action == "insert") {
      $checkEmail = "SELECT * FROM users WHERE email='$data[email]'";
      $checkEmail = mysqli_query($conn, $checkEmail);
      if (mysqli_num_rows($checkEmail) > 0) {
        $message = "Maaf, email yang anda masukan sudah terdaftar.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        if ($data['password'] !== $data['re_password']) {
          $message = "Maaf, konfirmasi password yang anda masukan belum sama.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        } else {
          $password = password_hash($data['password'], PASSWORD_DEFAULT);
          $token = generateToken();
          $en_user = password_hash($token, PASSWORD_DEFAULT);
          $en_user = str_replace("$", "", $en_user);
          $en_user = str_replace("/", "", $en_user);
          $en_user = str_replace(".", "", $en_user);
          require_once("mail.php");
          $to       = $data['email'];
          $subject  = "Account Verification - SP Bayes";
          $message  = "<!doctype html>
          <html>
            <head>
                <meta name='viewport' content='width=device-width'>
                <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
                <title>Account Verification</title>
                <style>
                    @media only screen and (max-width: 620px) {
                        table[class='body'] h1 {
                            font-size: 28px !important;
                            margin-bottom: 10px !important;}
                        table[class='body'] p,
                        table[class='body'] ul,
                        table[class='body'] ol,
                        table[class='body'] td,
                        table[class='body'] span,
                        table[class='body'] a {
                            font-size: 16px !important;}
                        table[class='body'] .wrapper,
                        table[class='body'] .article {
                            padding: 10px !important;}
                        table[class='body'] .content {
                            padding: 0 !important;}
                        table[class='body'] .container {
                            padding: 0 !important;
                            width: 100% !important;}
                        table[class='body'] .main {
                            border-left-width: 0 !important;
                            border-radius: 0 !important;
                            border-right-width: 0 !important;}
                        table[class='body'] .btn table {
                            width: 100% !important;}
                        table[class='body'] .btn a {
                            width: 100% !important;}
                        table[class='body'] .img-responsive {
                            height: auto !important;
                            max-width: 100% !important;
                            width: auto !important;}}
                    @media all {
                        .ExternalClass {
                            width: 100%;}
                        .ExternalClass,
                        .ExternalClass p,
                        .ExternalClass span,
                        .ExternalClass font,
                        .ExternalClass td,
                        .ExternalClass div {
                            line-height: 100%;}
                        .apple-link a {
                            color: inherit !important;
                            font-family: inherit !important;
                            font-size: inherit !important;
                            font-weight: inherit !important;
                            line-height: inherit !important;
                            text-decoration: none !important;
                        .btn-primary table td:hover {
                            background-color: #d5075d !important;}
                        .btn-primary a:hover {
                            background-color: #000 !important;
                            border-color: #000 !important;
                            color: #fff !important;}}
                </style>
            </head>
            <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
                <tr>
                    <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                    <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                    <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
            
                        <!-- START CENTERED WHITE CONTAINER -->
                        <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
            
                        <!-- START MAIN CONTENT AREA -->
                        <tr>
                            <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                            <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                                <tr>
                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                    <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi " . $data['name'] . ",</p>
                                    <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Selamat akun kamu sudah terdaftar, tinggal satu langkah lagi kamu sudah bisa menggunakan akun. Silakan salin kode token dibawah ini untuk memverifikasi akun kamu.</p>
                                    <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                    <tbody>
                                        <tr>
                                        <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                            <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                            <tbody>
                                                <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: center; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>" . $token . "</td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                    <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Terima kasih telah mendaftar di SP Bayes.</p>
                                    <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                                </td>
                                </tr>
                            </table>
                            </td>
                        </tr>
            
                        <!-- END MAIN CONTENT AREA -->
                        </table>
                        
                        <!-- START FOOTER -->
                        <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                        <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                            <tr>
                            <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                                <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                            </td>
                            </tr>
                            <tr>
                            <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                                Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                            </td>
                            </tr>
                        </table>
                        </div>
                        <!-- END FOOTER -->
            
                    <!-- END CENTERED WHITE CONTAINER -->
                    </div>
                    </td>
                    <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                </tr>
                </table>
            </body>
          </html>";
          smtp_mail($to, $subject, $message, "", "", 0, 0, true);
          $_SESSION['data_auth'] = ['en_user' => $en_user];
          $sql = "INSERT INTO users(en_user,token,name,email,password) VALUES('$en_user','$token','$data[name]','$data[email]','$password')";
        }
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function re_verifikasi($conn, $data, $action)
  {
    if ($action == "update") {
      $checkEN = "SELECT * FROM users WHERE en_user='$data[en_user]'";
      $checkEN = mysqli_query($conn, $checkEN);
      if (mysqli_num_rows($checkEN) == 0) {
        $message = "Maaf, sepertinya ada kesalahan saat mendaftar.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else if (mysqli_num_rows($checkEN) > 0) {
        $row = mysqli_fetch_assoc($checkEN);
        $name = $row['name'];
        $email = $row['email'];
        $token = generateToken();
        $reen_user = password_hash($token, PASSWORD_DEFAULT);
        $reen_user = str_replace("$", "", $reen_user);
        $reen_user = str_replace("/", "", $reen_user);
        $reen_user = str_replace(".", "", $reen_user);
        require_once("mail.php");
        $to       = $email;
        $subject  = "Account Verification - SP Bayes";
        $message  = "<!doctype html>
        <html>
          <head>
              <meta name='viewport' content='width=device-width'>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
              <title>Account Verification</title>
              <style>
                  @media only screen and (max-width: 620px) {
                      table[class='body'] h1 {
                          font-size: 28px !important;
                          margin-bottom: 10px !important;}
                      table[class='body'] p,
                      table[class='body'] ul,
                      table[class='body'] ol,
                      table[class='body'] td,
                      table[class='body'] span,
                      table[class='body'] a {
                          font-size: 16px !important;}
                      table[class='body'] .wrapper,
                      table[class='body'] .article {
                          padding: 10px !important;}
                      table[class='body'] .content {
                          padding: 0 !important;}
                      table[class='body'] .container {
                          padding: 0 !important;
                          width: 100% !important;}
                      table[class='body'] .main {
                          border-left-width: 0 !important;
                          border-radius: 0 !important;
                          border-right-width: 0 !important;}
                      table[class='body'] .btn table {
                          width: 100% !important;}
                      table[class='body'] .btn a {
                          width: 100% !important;}
                      table[class='body'] .img-responsive {
                          height: auto !important;
                          max-width: 100% !important;
                          width: auto !important;}}
                  @media all {
                      .ExternalClass {
                          width: 100%;}
                      .ExternalClass,
                      .ExternalClass p,
                      .ExternalClass span,
                      .ExternalClass font,
                      .ExternalClass td,
                      .ExternalClass div {
                          line-height: 100%;}
                      .apple-link a {
                          color: inherit !important;
                          font-family: inherit !important;
                          font-size: inherit !important;
                          font-weight: inherit !important;
                          line-height: inherit !important;
                          text-decoration: none !important;
                      .btn-primary table td:hover {
                          background-color: #d5075d !important;}
                      .btn-primary a:hover {
                          background-color: #000 !important;
                          border-color: #000 !important;
                          color: #fff !important;}}
              </style>
          </head>
          <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
              <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
              <tr>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                  <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                  <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
          
                      <!-- START CENTERED WHITE CONTAINER -->
                      <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
          
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                          <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                              <tr>
                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi " . $name . ",</p>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Selamat akun kamu sudah terdaftar, tinggal satu langkah lagi kamu sudah bisa menggunakan akun. Silakan salin kode token dibawah ini untuk memverifikasi akun kamu.</p>
                                  <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                  <tbody>
                                      <tr>
                                      <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                          <tbody>
                                              <tr>
                                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: center; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>" . $token . "</td>
                                              </tr>
                                          </tbody>
                                          </table>
                                      </td>
                                      </tr>
                                  </tbody>
                                  </table>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Terima kasih telah mendaftar di SP Bayes.</p>
                                  <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                              </td>
                              </tr>
                          </table>
                          </td>
                      </tr>
          
                      <!-- END MAIN CONTENT AREA -->
                      </table>
                      
                      <!-- START FOOTER -->
                      <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                      <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                          <tr>
                          <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                          </td>
                          </tr>
                          <tr>
                          <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                          </td>
                          </tr>
                      </table>
                      </div>
                      <!-- END FOOTER -->
          
                  <!-- END CENTERED WHITE CONTAINER -->
                  </div>
                  </td>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
              </tr>
              </table>
          </body>
        </html>";
        smtp_mail($to, $subject, $message, "", "", 0, 0, true);
        $_SESSION['data_auth'] = ['en_user' => $reen_user];
        $sql = "UPDATE users SET en_user='$reen_user', token='$token', updated_at=current_timestamp WHERE en_user='$data[en_user]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function verifikasi($conn, $data, $action)
  {
    if ($action == "update") {
      $checkEN = "SELECT * FROM users WHERE en_user='$data[en_user]'";
      $checkEN = mysqli_query($conn, $checkEN);
      if (mysqli_num_rows($checkEN) == 0) {
        $message = "Maaf, sepertinya ada kesalahan saat mendaftar.";
        $message_type = "warning";
        alert($message, $message_type);
        return false;
      } else if (mysqli_num_rows($checkEN) > 0) {
        $row = mysqli_fetch_assoc($checkEN);
        $token_primary = $row['token'];
        $updated_at = strtotime($row['updated_at']);
        $current_time = time();
        if (($current_time - $updated_at) > (5 * 60)) {
          $message = "Maaf, waktu untuk verifikasi telah habis.";
          $message_type = "warning";
          alert($message, $message_type);
          $_SESSION["project_sp_bayes"] = [
            "message-warning" => "Maaf, waktu untuk verifikasi telah habis.",
            "time-message" => time()
          ];
          return false;
        }
        if ($data['token'] !== $token_primary) {
          $message = "Maaf, kode token yang anda masukan masih salah.";
          $message_type = "warning";
          alert($message, $message_type);
          return false;
        }
        $sql = "UPDATE users SET id_active='1', updated_at=current_timestamp WHERE en_user='$data[en_user]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function forgot_password($conn, $data, $action, $baseURL)
  {
    if ($action == "update") {
      $checkEmail = "SELECT * FROM users WHERE email='$data[email]'";
      $checkEmail = mysqli_query($conn, $checkEmail);
      if (mysqli_num_rows($checkEmail) === 0) {
        $message = "Maaf, email yang anda masukan belum terdaftar.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $row = mysqli_fetch_assoc($checkEmail);
        $name = valid($conn, $row['name']);
        $token = generateToken();
        $en_user = password_hash($token, PASSWORD_DEFAULT);
        $en_user = str_replace("$", "", $en_user);
        $en_user = str_replace("/", "", $en_user);
        $en_user = str_replace(".", "", $en_user);
        require_once("mail.php");
        $to       = $data['email'];
        $subject  = "Reset password - SP Bayes";
        $message  = "<!doctype html>
        <html>
          <head>
              <meta name='viewport' content='width=device-width'>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
              <title>Reset password</title>
              <style>
                  @media only screen and (max-width: 620px) {
                      table[class='body'] h1 {
                          font-size: 28px !important;
                          margin-bottom: 10px !important;}
                      table[class='body'] p,
                      table[class='body'] ul,
                      table[class='body'] ol,
                      table[class='body'] td,
                      table[class='body'] span,
                      table[class='body'] a {
                          font-size: 16px !important;}
                      table[class='body'] .wrapper,
                      table[class='body'] .article {
                          padding: 10px !important;}
                      table[class='body'] .content {
                          padding: 0 !important;}
                      table[class='body'] .container {
                          padding: 0 !important;
                          width: 100% !important;}
                      table[class='body'] .main {
                          border-left-width: 0 !important;
                          border-radius: 0 !important;
                          border-right-width: 0 !important;}
                      table[class='body'] .btn table {
                          width: 100% !important;}
                      table[class='body'] .btn a {
                          width: 100% !important;}
                      table[class='body'] .img-responsive {
                          height: auto !important;
                          max-width: 100% !important;
                          width: auto !important;}}
                  @media all {
                      .ExternalClass {
                          width: 100%;}
                      .ExternalClass,
                      .ExternalClass p,
                      .ExternalClass span,
                      .ExternalClass font,
                      .ExternalClass td,
                      .ExternalClass div {
                          line-height: 100%;}
                      .apple-link a {
                          color: inherit !important;
                          font-family: inherit !important;
                          font-size: inherit !important;
                          font-weight: inherit !important;
                          line-height: inherit !important;
                          text-decoration: none !important;
                      .btn-primary table td:hover {
                          background-color: #d5075d !important;}
                      .btn-primary a:hover {
                          background-color: #000 !important;
                          border-color: #000 !important;
                          color: #fff !important;}}
              </style>
          </head>
          <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
              <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
              <tr>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                  <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                  <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
          
                      <!-- START CENTERED WHITE CONTAINER -->
                      <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
          
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                          <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                              <tr>
                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi " . $name . ",</p>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Pesan ini secara otomatis dikirimkan kepada anda karena anda meminta untuk mereset kata sandi. Jika anda tidak sama sekali ingin mereset atau bukan anda yang ingin mereset abaikan saja. Klik tombol reset berikut untuk melanjutkan:</p>
                                  <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                  <tbody>
                                      <tr>
                                      <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                          <tbody>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: center;' valign='top' bgcolor='#ffffff' align='center'>
                                                  <a href='" . $baseURL . "auth/new-password?en=" . $en_user . "' target='_blank' style='background-color: #ffffff; border: solid 1px #000; border-radius: 5px; box-sizing: border-box; cursor: pointer; display: inline-block; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-decoration: none; text-transform: capitalize; border-color: #000; color: #000;'>Atur Ulang Kata Sandi</a> 
                                                </td>
                                              </tr>
                                          </tbody>
                                          </table>
                                      </td>
                                      </tr>
                                  </tbody>
                                  </table>
                                  <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                              </td>
                              </tr>
                          </table>
                          </td>
                      </tr>
          
                      <!-- END MAIN CONTENT AREA -->
                      </table>
                      
                      <!-- START FOOTER -->
                      <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                      <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                          <tr>
                          <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                          </td>
                          </tr>
                          <tr>
                          <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                          </td>
                          </tr>
                      </table>
                      </div>
                      <!-- END FOOTER -->
          
                  <!-- END CENTERED WHITE CONTAINER -->
                  </div>
                  </td>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
              </tr>
              </table>
          </body>
        </html>";
        smtp_mail($to, $subject, $message, "", "", 0, 0, true);
        $sql = "UPDATE users SET en_user='$en_user', token='$token', updated_at=current_timestamp WHERE email='$data[email]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function new_password($conn, $data, $action)
  {
    if ($action == "update") {
      $lenght = strlen($data['password']);
      if ($lenght < 8) {
        $message = "Maaf, password yang anda masukan harus 8 digit atau lebih.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else if ($data['password'] !== $data['re_password']) {
        $message = "Maaf, konfirmasi password yang anda masukan belum sama.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password='$password' WHERE email='$data[email]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function login($conn, $data)
  {
    // check account
    $checkAccount = mysqli_query($conn, "SELECT * FROM users JOIN user_role ON users.id_role=user_role.id_role WHERE users.email='$data[email]'");
    if (mysqli_num_rows($checkAccount) == 0) {
      $message = "Maaf, akun yang anda masukan belum terdaftar.";
      $message_type = "danger";
      alert($message, $message_type);
      return false;
    } else if (mysqli_num_rows($checkAccount) > 0) {
      $row = mysqli_fetch_assoc($checkAccount);
      if (password_verify($data['password'], $row["password"])) {
        $_SESSION["project_sp_bayes"]["users"] = [
          "id" => $row["id_user"],
          "id_role" => $row["id_role"],
          "role" => $row["role"],
          "email" => $row["email"],
          "name" => $row["name"],
          "image" => $row["image"]
        ];
        return mysqli_affected_rows($conn);
      } else {
        $message = "Maaf, kata sandi yang anda masukan salah.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
    }
  }
}

if (isset($_SESSION["project_sp_bayes"]["users"])) {

  function profil($conn, $data, $action, $id_user)
  {
    if ($action == "update") {
      $path = "../assets/img/profil/";
      if (!empty($_FILES['image']["name"])) {
        $fileName = basename($_FILES["image"]["name"]);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName_encrypt = crc32($fileName);
        $ekstensiGambar = explode('.', $fileName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $imageUploadPath = $path . $fileName_encrypt . "." . $ekstensiGambar;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          $imageTemp = $_FILES["image"]["tmp_name"];
          compressImage($imageTemp, $imageUploadPath, 75);
          $image = $fileName_encrypt . "." . $ekstensiGambar;
        } else {
          $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      if (!empty($_FILES['image']["name"])) {
        $unwanted_characters = "../assets/img/profil/";
        $remove_image = str_replace($unwanted_characters, "", $data['imageOld']);
        if ($remove_image != "default.svg") {
          unlink($path . $remove_image);
        }
      } else if (empty($_FILE['image']["name"])) {
        $image = $data['imageOld'];
      }
      if (!empty($data['password'])) {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET name='$data[name]', image='$image', password='$password' WHERE id_user='$id_user'";
      } else {
        $sql = "UPDATE users SET name='$data[name]', image='$image' WHERE id_user='$id_user'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function setting($conn, $data, $action)
  {

    if ($action == "update") {
      $path = "../assets/img/auth/";
      if (!empty($_FILES['image']["name"])) {
        $fileName = basename($_FILES["image"]["name"]);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName_encrypt = crc32($fileName);
        $ekstensiGambar = explode('.', $fileName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $imageUploadPath = $path . $fileName_encrypt . "." . $ekstensiGambar;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          $imageTemp = $_FILES["image"]["tmp_name"];
          compressImage($imageTemp, $imageUploadPath, 75);
          $image = $fileName_encrypt . "." . $ekstensiGambar;
        } else {
          $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      if (!empty($_FILES['image']["name"])) {
        $unwanted_characters = "../assets/img/auth/";
        $remove_image = str_replace($unwanted_characters, "", $data['imageOld']);
        unlink($path . $remove_image);
      } else if (empty($_FILE['image']["name"])) {
        $image = $data['imageOld'];
      }
      $sql = "UPDATE auth SET image='$image'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function users($conn, $data, $action)
  {

    if ($action == "update") {
      $sql = "UPDATE users SET id_role='$data[id_role]', id_active='$data[id_active]' WHERE id_user='$data[id_user]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function role($conn, $data, $action)
  {
    if ($action == "insert") {
      $checkRole = "SELECT * FROM user_role WHERE role LIKE '%$data[role]%'";
      $checkRole = mysqli_query($conn, $checkRole);
      if (mysqli_num_rows($checkRole) > 0) {
        $message = "Maaf, role yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $sql = "INSERT INTO user_role(role) VALUES('$data[role]')";
      }
    }

    if ($action == "update") {
      if ($data['role'] !== $data['roleOld']) {
        $checkRole = "SELECT * FROM user_role WHERE role LIKE '%$data[role]%'";
        $checkRole = mysqli_query($conn, $checkRole);
        if (mysqli_num_rows($checkRole) > 0) {
          $message = "Maaf, role yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE user_role SET role='$data[role]' WHERE id_role='$data[id_role]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM user_role WHERE id_role='$data[id_role]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function menu($conn, $data, $action)
  {
    if ($action == "insert") {
      $checkMenu = "SELECT * FROM user_menu WHERE menu='$data[menu]'";
      $checkMenu = mysqli_query($conn, $checkMenu);
      if (mysqli_num_rows($checkMenu) > 0) {
        $message = "Maaf, menu yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $sql = "INSERT INTO user_menu(menu) VALUES('$data[menu]')";
      }
    }

    if ($action == "update") {
      if ($data['menu'] !== $data['menuOld']) {
        $checkMenu = "SELECT * FROM user_menu WHERE menu='$data[menu]'";
        $checkMenu = mysqli_query($conn, $checkMenu);
        if (mysqli_num_rows($checkMenu) > 0) {
          $message = "Maaf, menu yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE user_menu SET menu='$data[menu]' WHERE id_menu='$data[id_menu]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM user_menu WHERE id_menu='$data[id_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function sub_menu($conn, $data, $action, $baseURL)
  {
    $url = strtolower($data['title']);
    $url = str_replace(" ", "-", $url);

    if ($action == "insert") {
      $checkSubMenu = "SELECT * FROM user_sub_menu WHERE title='$data[title]'";
      $checkSubMenu = mysqli_query($conn, $checkSubMenu);
      if (mysqli_num_rows($checkSubMenu) > 0) {
        $message = "Maaf, nama sub menu yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $file = fopen("../views/" . $url . ".php", "w");
        fwrite($file, '<?php require_once("../controller/script.php");
        $_SESSION["project_sp_bayes"]["name_page"] = "' . $data['title'] . '";
        require_once("../templates/views_top.php"); ?>
        
        <!-- Begin Page Content -->
        <div class="container-fluid">
        
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_sp_bayes"]["name_page"] ?></h1>
          </div>
        
          <!-- Mulai buatlah lembar kerja anda disini! -->
        
        </div>
        <!-- /.container-fluid -->
        
        <?php require_once("../templates/views_bottom.php") ?>
        ');
        fclose($file);
        $sql = "INSERT INTO user_sub_menu(id_menu,id_active,title,url,icon) VALUES('$data[id_menu]','$data[id_active]','$data[title]','$url','$data[icon]')";
      }
    }

    if ($action == "update") {
      if ($data['title'] !== $data['titleOld']) {
        $checkSubMenu = "SELECT * FROM user_sub_menu WHERE title='$data[title]'";
        $checkSubMenu = mysqli_query($conn, $checkSubMenu);
        if (mysqli_num_rows($checkSubMenu) > 0) {
          $message = "Maaf, nama sub menu yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE user_sub_menu SET id_menu='$data[id_menu]', id_active='$data[id_active]', title='$data[title]', url='$url', icon='$data[icon]' WHERE id_sub_menu='$data[id_sub_menu]'";
    }

    if ($action == "delete") {
      unlink("../views/" . $url . ".php");
      $sql = "DELETE FROM user_sub_menu WHERE id_sub_menu='$data[id_sub_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function menu_access($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO user_access_menu(id_role,id_menu) VALUES('$data[id_role]','$data[id_menu]')";
    }

    if ($action == "update") {
      $sql = "UPDATE user_access_menu SET id_role='$data[id_role]', id_menu='$data[id_menu]' WHERE id_access_menu='$data[id_access_menu]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM user_access_menu WHERE id_access_menu='$data[id_access_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function sub_menu_access($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO user_access_sub_menu(id_role,id_sub_menu) VALUES('$data[id_role]','$data[id_sub_menu]')";
    }

    if ($action == "update") {
      $sql = "UPDATE user_access_sub_menu SET id_role='$data[id_role]', id_sub_menu='$data[id_sub_menu]' WHERE id_access_sub_menu='$data[id_access_sub_menu]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM user_access_sub_menu WHERE id_access_sub_menu='$data[id_access_sub_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function gejala($conn, $data, $action)
  {
    if ($action == "insert") {
      $checkNama = mysqli_query($conn, "SELECT * FROM gejala WHERE id_jenis_tanaman='$data[id_jenis_tanaman]' AND nama_gejala='$data[nama_gejala]'");
      if (mysqli_num_rows($checkNama) > 0) {
        $message = "Maaf, gejala " . $data['nama_gejala'] . " sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      $checkKode = mysqli_query($conn, "SELECT * FROM gejala WHERE id_jenis_tanaman='$data[id_jenis_tanaman]' ORDER BY id_gejala DESC LIMIT 1");
      if (mysqli_num_rows($checkKode) > 0) {
        $row = mysqli_fetch_assoc($checkKode);
        $string = $row['kode_gejala'];
        $result = separateAlphaNumeric($string);
        $numeric = $result['numeric'] + 1;
        $kode_gejala = "E" . $numeric;
      } else {
        $kode_gejala = "E1";
      }
      $sql = "INSERT INTO gejala(id_jenis_tanaman,nama_gejala,kode_gejala) VALUES('$data[id_jenis_tanaman]','$data[nama_gejala]','$kode_gejala')";
    }

    if ($action == "update") {
      if ($data['nama_gejala'] != $data['nama_gejalaOld']) {
        $checkNama = mysqli_query($conn, "SELECT * FROM gejala WHERE id_jenis_tanaman='$data[id_jenis_tanaman]' AND nama_gejala='$data[nama_gejala]'");
        if (mysqli_num_rows($checkNama) > 0) {
          $message = "Maaf, gejala " . $data['nama_gejala'] . " sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE gejala SET id_jenis_tanaman='$data[id_jenis_tanaman]', nama_gejala='$data[nama_gejala]' WHERE id_gejala='$data[id_gejala]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM gejala WHERE id_gejala='$data[id_gejala]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function penyakit($conn, $data, $action)
  {
    if ($action == "insert") {
      $checkID = mysqli_query($conn, "SELECT * FROM penyakit ORDER BY id_penyakit DESC LIMIT 1");
      if (mysqli_num_rows($checkID) > 0) {
        $row = mysqli_fetch_assoc($checkID);
        $id_penyakit = $row['id_penyakit'] + 1;
      } else {
        $id_penyakit = 1;
      }
      $checkNama = mysqli_query($conn, "SELECT * FROM penyakit WHERE id_jenis_tanaman='$data[id_jenis_tanaman]' AND nama_penyakit='$data[nama_penyakit]'");
      if (mysqli_num_rows($checkNama) > 0) {
        $message = "Maaf, penyakit " . $data['nama_penyakit'] . " sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      $checkKode = mysqli_query($conn, "SELECT * FROM penyakit WHERE id_jenis_tanaman='$data[id_jenis_tanaman]' ORDER BY id_penyakit DESC LIMIT 1");
      if (mysqli_num_rows($checkKode) > 0) {
        $row = mysqli_fetch_assoc($checkKode);
        $string = $row['kode_penyakit'];
        $result = separateAlphaNumeric($string);
        $numeric = $result['numeric'] + 1;
        $kode_penyakit = "H" . $numeric;
      } else {
        $kode_penyakit = "H1";
      }
      $sql = "INSERT INTO penyakit(id_penyakit,id_jenis_tanaman,nama_penyakit,kode_penyakit) VALUES('$id_penyakit','$data[id_jenis_tanaman]','$data[nama_penyakit]','$kode_penyakit');";
      $sql .= "INSERT INTO nilai_penyakit(id_penyakit,bobot) VALUES('$id_penyakit','$data[bobot]');";
    }

    if ($action == "update") {
      if ($data['nama_penyakit'] != $data['nama_penyakitOld']) {
        $checkNama = mysqli_query($conn, "SELECT * FROM penyakit WHERE id_jenis_tanaman='$data[id_jenis_tanaman]' AND nama_penyakit='$data[nama_penyakit]'");
        if (mysqli_num_rows($checkNama) > 0) {
          $message = "Maaf, penyakit " . $data['nama_penyakit'] . " sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE penyakit SET id_jenis_tanaman='$data[id_jenis_tanaman]', nama_penyakit='$data[nama_penyakit]' WHERE id_penyakit='$data[id_penyakit]';";
      $sql .= "UPDATE nilai_penyakit SET bobot='$data[bobot]' WHERE id_penyakit='$data[id_penyakit]';";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM penyakit WHERE id_penyakit='$data[id_penyakit]';";
    }

    mysqli_multi_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function solusi($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO solusi(id_penyakit,solusi) VALUES('$data[id_penyakit]','$data[solusi]')";
    }

    if ($action == "update") {
      $sql = "UPDATE solusi SET solusi='$data[solusi]' WHERE id_solusi='$data[id_solusi]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM solusi WHERE id_solusi='$data[id_solusi]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function akuisisi($conn, $data, $action)
  {
    if ($action == "insert") {
      $takeJT = mysqli_query($conn, "SELECT * FROM jenis_tanaman WHERE id_jenis_tanaman='$data[id_jenis_tanaman]'");
      $rowJT = mysqli_fetch_assoc($takeJT);

      // Ambil data gejala dan masukan ke array
      $gejala = mysqli_query($conn, "SELECT * FROM gejala WHERE id_jenis_tanaman='$data[id_jenis_tanaman]'");
      $dataGejala = array();
      if (mysqli_num_rows($gejala) > 0) {
        while ($data_gejala = mysqli_fetch_assoc($gejala)) {
          $dataGejala[] = array("id_gejala" => $data_gejala['id_gejala']);
        }
      } else {
        $message = "Maaf, data gejala dan penyakit pada tanaman " . $rowJT['nama_tanaman'] . " belum ada!";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }

      // Ambil data penyakit dan masukan ke array
      $penyakit = mysqli_query($conn, "SELECT * FROM penyakit WHERE id_jenis_tanaman='$data[id_jenis_tanaman]'");
      $dataPenyakit = array();
      if (mysqli_num_rows($penyakit) > 0) {
        while ($data_penyakit = mysqli_fetch_assoc($penyakit)) {
          $dataPenyakit[] = array("kode_penyakit" => $data_penyakit["kode_penyakit"]);
        }
      } else {
        $message = "Maaf, data penyakit pada tanaman " . $rowJT['nama_tanaman'] . " belum ada!";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }

      // Proses pembuatan table akuisisi berdasarkan jenis tanaman
      $result = mysqli_query($conn, "SELECT * FROM akuisisi WHERE nama_table='akuisisi_p$data[id_jenis_tanaman]'");
      if ($result !== false && $result->num_rows > 0) {
        $message = "Maaf, data table akuisisi_p" . $data['id_jenis_tanaman'] . " sudah ada!";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $createTableSql = "CREATE TABLE akuisisi_p" . $data['id_jenis_tanaman'] . " (
          id_akuisisi" . $data['id_jenis_tanaman'] . " INT AUTO_INCREMENT PRIMARY KEY,
          id_gejala INT,
        ";
        foreach ($dataPenyakit as $fieldName => $fieldType) {
          $createTableSql .= $fieldType['kode_penyakit'] . " CHAR(20), ";
        }
        $createTableSql = rtrim($createTableSql, ", ");
        $createTableSql .= ")";
        if ($conn->query($createTableSql) === TRUE) {
          mysqli_query($conn, "INSERT INTO akuisisi(nama_table) VALUES('akuisisi_p" . $data['id_jenis_tanaman'] . "')");
          $insertDataSql = "INSERT INTO akuisisi_p" . $data['id_jenis_tanaman'] . " (id_gejala) VALUES";
          foreach ($dataGejala as $fieldName => $fieldType) {
            $insertDataSql .= "('" . $fieldType['id_gejala'] . "'), ";
          }
          $insertDataSql = rtrim($insertDataSql, ", ");
          if ($conn->query($insertDataSql) != TRUE) {
            $message = "Maaf, terjadi kesalahan saat memasukan data di table akuisisi_p" . $data['id_jenis_tanaman'] . " baru. silakan coba lagi di formulir yang telah dibuat!";
            $message_type = "danger";
            alert($message, $message_type);
            return false;
          }
        } else {
          $message = "Maaf, terjadi kesalahan saat membuat table akuisisi_p" . $data['id_jenis_tanaman'] . " baru. silakan coba lagi!";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }

      // Proses pembuatan table probabilitas berdasarkan jenis tanaman
      $result = mysqli_query($conn, "SELECT * FROM akuisisi WHERE nama_table='probabilitas_g$data[id_jenis_tanaman]'");
      if ($result !== false && $result->num_rows > 0) {
        $message = "Maaf, data table probabilitas_g" . $data['id_jenis_tanaman'] . " sudah ada!";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $createTableSql = "CREATE TABLE probabilitas_g" . $data['id_jenis_tanaman'] . " (
          id_probabilitas" . $data['id_jenis_tanaman'] . " INT AUTO_INCREMENT PRIMARY KEY,
          id_gejala INT,
        ";
        foreach ($dataPenyakit as $fieldName => $fieldType) {
          $createTableSql .= $fieldType['kode_penyakit'] . " CHAR(20), kode_" . $fieldType['kode_penyakit'] . " CHAR(20),";
        }
        $createTableSql = rtrim($createTableSql, ", ");
        $createTableSql .= ")";
        if ($conn->query($createTableSql) === TRUE) {
          mysqli_query($conn, "INSERT INTO akuisisi(nama_table) VALUES('probabilitas_g" . $data['id_jenis_tanaman'] . "')");
          $insertDataSql = "INSERT INTO probabilitas_g" . $data['id_jenis_tanaman'] . " (id_gejala) VALUES";
          foreach ($dataGejala as $fieldName => $fieldType) {
            $insertDataSql .= "('" . $fieldType['id_gejala'] . "'), ";
          }
          $insertDataSql = rtrim($insertDataSql, ", ");
          if ($conn->query($insertDataSql) === TRUE) {
            mysqli_query($conn, "INSERT INTO akuisisi(nama_table) VALUES('pengamatan" . $data['id_jenis_tanaman'] . "')");
            $createTableSql = "CREATE TABLE pengamatan" . $data['id_jenis_tanaman'] . " (
              id_pengamatan" . $data['id_jenis_tanaman'] . " INT AUTO_INCREMENT PRIMARY KEY,
              nama_gejala VARCHAR(75),
              nama_penyakit VARCHAR(75),
              nilai_probabilitas CHAR(20)
            )";
            if ($conn->query($createTableSql) != TRUE) {
              $message = "Maaf, terjadi kesalahan saat membuat table pengamatan" . $data['id_jenis_tanaman'] . " baru. silakan coba lagi di formulir yang telah dibuat!";
              $message_type = "danger";
              alert($message, $message_type);
              return false;
            }
          } else {
            $message = "Maaf, terjadi kesalahan saat memasukan data di table probabilitas_g" . $data['id_jenis_tanaman'] . " baru. silakan coba lagi di formulir yang telah dibuat!";
            $message_type = "danger";
            alert($message, $message_type);
            return false;
          }
        } else {
          $message = "Maaf, terjadi kesalahan saat membuat table probabilitas_g" . $data['id_jenis_tanaman'] . " baru. silakan coba lagi!";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
    }

    if ($action == "update") {
      $penyakit = mysqli_query($conn, "SELECT * FROM penyakit WHERE id_jenis_tanaman='$data[id_jenis_tanaman]'");
      $dataPenyakit = array();
      if (mysqli_num_rows($penyakit) > 0) {
        while ($data_penyakit = mysqli_fetch_assoc($penyakit)) {
          $dataPenyakit[] = array("kode_penyakit" => $data_penyakit["kode_penyakit"]);
        }
      }

      $h = 1;
      foreach ($dataPenyakit as $row) {
        $upt = "UPDATE akuisisi_p$data[id_jenis_tanaman] SET H$h='' WHERE id_gejala = '$data[id_gejala]'";
        if ($conn->query($upt) === TRUE) {
        }
        $h++;
      }
      $checklist = $data['checklist'];
      if (empty($checklist)) {
        $message = "Maaf, anda belum menchecklist satupun!";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      foreach ($checklist as $id => $value) {
        $sql = "UPDATE akuisisi_p$data[id_jenis_tanaman] SET H$id = '$value' WHERE id_gejala = '$data[id_gejala]'";
        if ($conn->query($sql) === TRUE) {
        }
      }
      $_SESSION['data-accordian'] = ['akses' => $data['id_akuisisi']];
    }

    if ($action == "delete") {
      mysqli_query($conn, "DROP TABLE $data[nama_table];");
      mysqli_query($conn, "DELETE FROM akuisisi WHERE id_akuisisi='$data[id_akuisisi]';");
    }

    return mysqli_affected_rows($conn);
  }

  function probabilitas($conn, $data, $action)
  {
    if ($action == "update") {
      if (empty($data['nilai_pro'])) {
        $message = "Maaf, anda belum memasukan nilai probabilitas satupun!";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }

      // Ambil data penyakit dan masukan ke array
      $penyakit = mysqli_query($conn, "SELECT * FROM penyakit WHERE id_jenis_tanaman='$data[id_jenis_tanaman]'");
      $dataPenyakit = [];
      if (mysqli_num_rows($penyakit) > 0) {
        $no = 1;
        while ($data_penyakit = mysqli_fetch_assoc($penyakit)) {
          $sakit = $data_penyakit["nama_penyakit"];
          $value = $data['nilai_pro'][$no];
          $checkData = mysqli_query($conn, "SELECT * FROM pengamatan$data[id_jenis_tanaman] WHERE nama_gejala='$data[nama_gejala]' AND nama_penyakit='$sakit'");
          if (mysqli_num_rows($checkData) > 0) {
            $sql = "UPDATE pengamatan$data[id_jenis_tanaman] SET nilai_probabilitas='$value' WHERE nama_gejala='$data[nama_gejala]' AND nama_penyakit='$sakit'";
            mysqli_query($conn, $sql);
          } else {
            $sql = "INSERT INTO pengamatan$data[id_jenis_tanaman](nama_gejala,nama_penyakit,nilai_probabilitas) VALUES('$data[nama_gejala]','$sakit','$value')";
            mysqli_query($conn, $sql);
          }
          $dataPenyakit[] = $data_penyakit["nama_penyakit"];
          $no++;
        }
      }

      $h = 1;
      foreach ($dataPenyakit as $row) {
        $upt = "UPDATE probabilitas_g$data[id_jenis_tanaman] SET H$h='' WHERE id_gejala = '$data[id_gejala]'";
        if ($conn->query($upt) === TRUE) {
        }
        $h++;
      }
      foreach ($data['nilai_pro'] as $id => $value) {
        mysqli_query($conn, "UPDATE probabilitas_g$data[id_jenis_tanaman] SET H$id = '$value', kode_H$id='H$id' WHERE id_gejala = '$data[id_gejala]'");
      }
      $_SESSION['data-accordian'] = ['akses' => $data['id_akuisisi']];
    }

    // mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function pencegahan($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO pencegahan(id_penyakit,pencegahan) VALUES('$data[id_penyakit]','$data[pencegahan]')";
    }

    if ($action == "update") {
      $sql = "UPDATE pencegahan SET pencegahan='$data[pencegahan]' WHERE id_pencegahan='$data[id_pencegahan]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM pencegahan WHERE id_pencegahan='$data[id_pencegahan]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function obat($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO obat(id_penyakit,obat) VALUES('$data[id_penyakit]','$data[obat]')";
    }

    if ($action == "update") {
      $sql = "UPDATE obat SET obat='$data[obat]' WHERE id_obat='$data[id_obat]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM obat WHERE id_obat='$data[id_obat]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function nilai_akuisisi($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO nilai_akuisisi(id_gejala,id_penyakit) VALUES('$data[id_gejala]','$data[id_penyakit]')";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM nilai_akuisisi WHERE id_nilai_akuisisi='$data[id_nilai_akuisisi]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function diagnosa($conn, $data, $action)
  {
    if ($action == "insert") {
      $_SESSION['data-diagnosa'] = [
        'akses' => $data['id_akuisisi'],
        'gejala' => $data['checklist']
      ];
    }

    if ($action == "update") {
    }

    if ($action == "delete") {
    }

    // mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function __name($conn, $data, $action)
  {
    if ($action == "insert") {
    }

    if ($action == "update") {
    }

    if ($action == "delete") {
    }

    // mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }
}
