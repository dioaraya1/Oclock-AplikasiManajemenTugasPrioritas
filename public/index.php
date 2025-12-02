<?php
$title = "Oclock | Aplikasi Manajemen Waktu Prioritas";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../public/css/main.build.css">
  <title><?= $title ?></title>
  <script src="../../public/js/main.js" type="module"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-textSecondary to-backgroundSecondary text-textPrimary">

  <?php include "../src/php/partials/header-public.php"; ?>

  <section class="w-auto flex items-center justify-between px-10 pt-24 pb-10">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 md:gap-10 items-center">
      <div>
        <h2 class="text-4xl font-bold leading-tight text-textPrimary md:text-5xl">
          Atur Waktu Lebih Efisien
        </h2>
        <p class="mt-5 text-lg text-textPrimary leading-relaxed">
          Aplikasi manajemen waktu berbasis
          <strong>K-Means Clustering</strong> yang membantu Anda menentukan
          tugas paling prioritas secara otomatis. Dibuat untuk siswa,
          mahasiswa, dan siapa saja yang ingin lebih produktif.
        </p>
        <div class="mt-8 flex gap-4">
          <a href="login.html"
            class="btn-navigation lg:btn-navigation-lg  text-textPrimary bg-primary hover:bg-textPrimary hover:text-textSecondary">Login</a>
          <a href="register.html"
            class="btn-navigation lg:btn-navigation-lg ring-4 ring-inset ring-textPrimary text-textSecondary bg-primary hover:bg-textPrimary hover:ring-primary">Daftar</a>
        </div>
      </div>


      <div class="flex justify-center">
        <img src="img/hero1.png" class="w-96 md:w-auto drop-shadow-xl" alt="Hero image" />
      </div>
    </div>
  </section>
  <?php include "../src/php/partials/footer-public.php"; ?>
</body>

</html>