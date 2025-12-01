<?php
$title = "Oclock | Aplikasi Manajemen Waktu Prioritas";
include "src/php/partials/header-public.php";
?>

//? HERO SECTION
<section class="w-auto flex items-center justify-between px-10 pt-24 pb-10">
  <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 md:gap-10 items-center">
    //? TEXT
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
          class="btn-navigation text-textPrimary bg-primary hover:bg-textPrimary hover:text-textSecondary">Login</a>
        <a href="register.html"
          class="btn-navigation ring-4 ring-inset ring-textPrimary text-textSecondary bg-primary hover:bg-textPrimary hover:ring-primary">Daftar</a>
      </div>
    </div>

    //? HERO IMAGE
    <div class="flex justify-center">
      <img src="img/hero1.png" class="w-96 md:w-auto drop-shadow-xl" alt="Hero image" />
    </div>
  </div>
</section>
</body>

<?php include "src/php/partials/footer-public.php"; ?>