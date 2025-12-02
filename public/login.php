<?php $title = "Login | Oclock Aplikasi Manajemen Waktu Prioritas";
?>
<?php
session_start();
$error = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : '';
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php $title ?></title>
  <!-- CSS LINK -->
  <link rel="stylesheet" href="css/main.build.css">
  <link rel="stylesheet" href="css/main.components.css">
  <link rel="stylesheet" href="css/main.utilities.css">
  <link rel="stylesheet" href="css/main.base.css">
  <!-- MAIN JS SCRIPT -->
  <script href="js/main.js" type="module"></script>
</head>

<body class="bg-backgroundSecondary min-h-screen flex items-center justify-center p-5 text-textPrimary">
  <div
    class="w-full max-w-5xl bg-backgroundPrimary backdrop-blur-xl shadow-2xl rounded-3xl overflow-hidden grid grid-cols-1 md:grid-cols-2 border-2 border-textPrimary">
    <!-- LEFT / logo dan teks -->
    <div class="hidden md:flex flex-col justify-between bg-textSecondary">
      <div class=" px-10 pt-10">
        <div class="flex items-center justify-center gap-4">
          <img src="img/logo/oclock.png" alt="Logo Oclock" class="w-20 h-20 drop-shadow-2xl">
          <h1 class="text-4xl font-extrabold tracking-wide">Oclock</h1>
        </div>
        <p class="text-xl leading-normal max-w-md text-center mt-4">Aplikasi Manajemen Waktu Berbasis
          <span class="font-semibold">K-Means Clustering</span> untuk menentukan tugas paling prioritas.
        </p>

      </div>
      <img src="img/login1.png" class="w-full drop-shadow-2xl  opacity-95" alt="Gambar tampilan login">
    </div>
    <!-- RIGHT: LOGIN FORM -->

  </div>
</body>

</html>