<?php
session_start();
require_once __DIR__ . '/../src/config/database.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>oClock - Manajemen Tugas Prioritas dengan AI</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/main.build.css">
  <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
</head>

<body class="bg-gradient-to-br from-primary-50 to-white min-h-screen">
  <!-- Header -->
  <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-primary-100">
    <nav class="container mx-auto px-4 py-4">
      <div class="flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center space-x-3">
          <div
            class="w-10 h-10 bg-gradient-to-r from-primary-600 to-primary-400 rounded-lg flex items-center justify-center">
            <span class="text-white font-bold text-xl">⏰</span>
          </div>
          <span class="text-2xl font-bold text-primary-800">oClock</span>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center space-x-8">
          <a href="#features" class="text-gray-700 hover:text-primary-600 font-medium transition">Fitur</a>
          <a href="#how-it-works" class="text-gray-700 hover:text-primary-600 font-medium transition">Cara Kerja</a>
          <a href="#pricing" class="text-gray-700 hover:text-primary-600 font-medium transition">Harga</a>
          <a href="#contact" class="text-gray-700 hover:text-primary-600 font-medium transition">Kontak</a>
        </div>

        <!-- CTA Buttons -->
        <div class="flex items-center space-x-4">
          <a href="dashboard/login.php" class="btn btn-secondary hidden md:inline-block">
            Masuk
          </a>
          <a href="dashboard/register.php" class="btn btn-primary">
            Daftar Gratis
          </a>

          <!-- Mobile Menu Button -->
          <button id="mobile-menu-button" class="md:hidden text-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile Menu -->
      <div id="mobile-menu" class="hidden md:hidden mt-4 space-y-3">
        <a href="#features" class="block text-gray-700 hover:text-primary-600 font-medium">Fitur</a>
        <a href="#how-it-works" class="block text-gray-700 hover:text-primary-600 font-medium">Cara Kerja</a>
        <a href="#pricing" class="block text-gray-700 hover:text-primary-600 font-medium">Harga</a>
        <a href="#contact" class="block text-gray-700 hover:text-primary-600 font-medium">Kontak</a>
        <a href="dashboard/login.php" class="block btn btn-secondary mt-2">Masuk</a>
      </div>
    </nav>
  </header>

  <!-- Hero Section -->
  <section class="container mx-auto px-4 py-16 md:py-24">
    <div class="flex flex-col lg:flex-row items-center justify-between">
      <div class="lg:w-1/2 mb-12 lg:mb-0">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
          Atur Tugasmu dengan
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-purple-600">
            Kecerdasan Buatan
          </span>
        </h1>
        <p class="text-xl text-gray-600 mb-8">
          oClock menggunakan algoritma K-Means Clustering untuk menganalisis dan mengurutkan prioritas tugasmu secara
          otomatis. Fokus pada yang penting!
        </p>
        <div class="flex flex-col sm:flex-row gap-4">
          <a href="dashboard/register.php" class="btn btn-primary text-lg px-8 py-4">
            🚀 Mulai Gratis Sekarang
          </a>
          <a href="#features" class="btn btn-secondary text-lg px-8 py-4">
            📚 Pelajari Lebih Lanjut
          </a>
        </div>

        <!-- Trust Badges -->
        <div class="mt-12 flex items-center space-x-6">
          <div class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
              <span class="text-green-600">✓</span>
            </div>
            <span class="text-gray-700">Tidak perlu kartu kredit</span>
          </div>
          <div class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
              <span class="text-blue-600">⚡</span>
            </div>
            <span class="text-gray-700">Setup dalam 2 menit</span>
          </div>
        </div>
      </div>

      <!-- Hero Image/Illustration -->
      <div class="lg:w-1/2 relative">
        <div class="relative">
          <div class="bg-gradient-to-r from-primary-500 to-purple-500 rounded-2xl p-1 transform rotate-1">
            <div class="bg-white rounded-xl p-8 shadow-2xl transform -rotate-1">
              <div class="space-y-4">
                <!-- Task Priority Card Example -->
                <div class="border-l-4 border-primary-600 bg-primary-50 p-4 rounded-r-lg">
                  <div class="flex justify-between items-center">
                    <h3 class="font-bold text-gray-800">Presentasi Client</h3>
                    <span class="px-3 py-1 bg-primary-600 text-white text-sm rounded-full">HIGH</span>
                  </div>
                  <p class="text-gray-600 text-sm mt-1">Deadline: Besok, 10:00 WIB</p>
                </div>

                <div class="border-l-4 border-yellow-500 bg-yellow-50 p-4 rounded-r-lg">
                  <div class="flex justify-between items-center">
                    <h3 class="font-bold text-gray-800">Laporan Bulanan</h3>
                    <span class="px-3 py-1 bg-yellow-500 text-white text-sm rounded-full">MEDIUM</span>
                  </div>
                  <p class="text-gray-600 text-sm mt-1">Deadline: 3 hari lagi</p>
                </div>

                <div class="border-l-4 border-gray-400 bg-gray-50 p-4 rounded-r-lg">
                  <div class="flex justify-between items-center">
                    <h3 class="font-bold text-gray-800">Arsip Dokumen</h3>
                    <span class="px-3 py-1 bg-gray-400 text-white text-sm rounded-full">LOW</span>
                  </div>
                  <p class="text-gray-600 text-sm mt-1">Deadline: Minggu depan</p>
                </div>
              </div>

              <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex items-center justify-between">
                  <div class="text-center">
                    <div class="text-2xl font-bold text-primary-600">85%</div>
                    <div class="text-sm text-gray-600">Efisiensi meningkat</div>
                  </div>
                  <div class="text-center">
                    <div class="text-2xl font-bold text-primary-600">3.2x</div>
                    <div class="text-sm text-gray-600">Lebih produktif</div>
                  </div>
                  <div class="text-center">
                    <div class="text-2xl font-bold text-primary-600">92%</div>
                    <div class="text-sm text-gray-600">Tepat waktu</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Floating Elements -->
          <div class="absolute -top-4 -right-4 w-24 h-24 bg-yellow-400 rounded-full opacity-20 blur-xl"></div>
          <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-primary-400 rounded-full opacity-20 blur-xl"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section id="features" class="bg-gray-50 py-20">
    <div class="container mx-auto px-4">
      <div class="text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Fitur Unggulan oClock</h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
          Semua yang Anda butuhkan untuk manajemen tugas yang efektif
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Feature 1 -->
        <div class="card hover:border-primary-500 transition-all">
          <div
            class="w-14 h-14 bg-gradient-to-r from-primary-500 to-primary-300 rounded-xl flex items-center justify-center mb-6">
            <span class="text-2xl">🤖</span>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">AI Priority Sorting</h3>
          <p class="text-gray-600">
            Algoritma K-Means Clustering menganalisis deadline, urgensi, dan kompleksitas untuk menentukan prioritas
            otomatis.
          </p>
        </div>

        <!-- Feature 2 -->
        <div class="card hover:border-primary-500 transition-all">
          <div
            class="w-14 h-14 bg-gradient-to-r from-green-500 to-green-300 rounded-xl flex items-center justify-center mb-6">
            <span class="text-2xl">📊</span>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">Dashboard Interaktif</h3>
          <p class="text-gray-600">
            Visualisasi data yang mudah dipahami untuk melacak produktivitas dan progres tugas.
          </p>
        </div>

        <!-- Feature 3 -->
        <div class="card hover:border-primary-500 transition-all">
          <div
            class="w-14 h-14 bg-gradient-to-r from-purple-500 to-purple-300 rounded-xl flex items-center justify-center mb-6">
            <span class="text-2xl">👥</span>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">Multi-User Support</h3>
          <p class="text-gray-600">
            Admin dapat mengelola pengguna, sementara setiap user memiliki ruang kerja pribadi.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- How It Works -->
  <section id="how-it-works" class="py-20">
    <div class="container mx-auto px-4">
      <div class="text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Bagaimana oClock Bekerja?</h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
          Hanya 3 langkah sederhana untuk produktivitas maksimal
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Step 1 -->
        <div class="text-center">
          <div class="w-20 h-20 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-6 relative">
            <span class="text-3xl text-primary-600">1</span>
            <div class="absolute -right-8 top-1/2 transform -translate-y-1/2 w-16 h-1 bg-primary-200 hidden ">
            </div>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">Input Tugas</h3>
          <p class="text-gray-600">
            Tambahkan tugas dengan detail: deadline, tingkat kesulitan, dan urgensi.
          </p>
        </div>

        <!-- Step 2 -->
        <div class="text-center">
          <div class="w-20 h-20 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-6 relative">
            <span class="text-3xl text-primary-600">2</span>
            <div class="absolute -right-8 top-1/2 transform -translate-y-1/2 w-16 h-1 bg-primary-200 hidden ">
            </div>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">Analisis AI</h3>
          <p class="text-gray-600">
            oClock menganalisis menggunakan K-Means Clustering untuk mengelompokkan prioritas.
          </p>
        </div>

        <!-- Step 3 -->
        <div class="text-center">
          <div class="w-20 h-20 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <span class="text-3xl text-primary-600">3</span>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">Eksekusi</h3>
          <p class="text-gray-600">
            Kerjakan tugas berdasarkan urutan prioritas yang telah ditentukan sistem.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="bg-gradient-to-r from-primary-600 to-purple-600 py-16">
    <div class="container mx-auto px-4 text-center">
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
        Siap Meningkatkan Produktivitas Anda?
      </h2>
      <p class="text-xl text-primary-100 mb-8 max-w-2xl mx-auto">
        Bergabung dengan ribuan pengguna yang telah mengoptimalkan waktu mereka dengan oClock.
      </p>
      <a href="dashboard/register.php"
        class="inline-block bg-white text-primary-600 px-8 py-4 rounded-lg font-bold text-lg hover:bg-gray-100 transition shadow-2xl">
        🎯 Daftar Sekarang - Gratis Selamanya!
      </a>
      <p class="text-primary-200 mt-4">Tidak perlu kartu kredit • 100% aman • Support 24/7</p>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white py-12">
    <div class="container mx-auto px-4">
      <div class="flex flex-col md:flex-row justify-between items-center">
        <div class="mb-8 md:mb-0">
          <div class="flex items-center space-x-3 mb-4">
            <div
              class="w-10 h-10 bg-gradient-to-r from-primary-600 to-primary-400 rounded-lg flex items-center justify-center">
              <span class="text-white font-bold text-xl">⏰</span>
            </div>
            <span class="text-2xl font-bold">oClock</span>
          </div>
          <p class="text-gray-400 max-w-md">
            Aplikasi manajemen tugas cerdas dengan algoritma K-Means Clustering untuk produktivitas maksimal.
          </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
          <div>
            <h4 class="font-bold text-lg mb-4">Produk</h4>
            <ul class="space-y-2 text-gray-400">
              <li><a href="#features" class="hover:text-white transition">Fitur</a></li>
              <li><a href="#pricing" class="hover:text-white transition">Harga</a></li>
              <li><a href="#" class="hover:text-white transition">API</a></li>
            </ul>
          </div>

          <div>
            <h4 class="font-bold text-lg mb-4">Perusahaan</h4>
            <ul class="space-y-2 text-gray-400">
              <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
              <li><a href="#" class="hover:text-white transition">Blog</a></li>
              <li><a href="#" class="hover:text-white transition">Karir</a></li>
            </ul>
          </div>

          <div>
            <h4 class="font-bold text-lg mb-4">Legal</h4>
            <ul class="space-y-2 text-gray-400">
              <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
              <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
              <li><a href="#contact" class="hover:text-white transition">Kontak</a></li>
            </ul>
          </div>
        </div>
      </div>

      <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
        <p>&copy; 2024 oClock. All rights reserved. Dibuat dengan ❤️ untuk produktivitas Anda.</p>
      </div>
    </div>
  </footer>

  <!-- JavaScript -->
  <script type="module" src="js/main.js"></script>

</body>

</html>