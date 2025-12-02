<?php $title = $title ?? "Oclock"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>

  <!-- Tailwind CSS -->
  <link rel="stylesheet" href="../public/css/main.build.css">

  <!-- JS Modular -->
  <script type="module" defer src="../public/js/main.js"></script>
</head>

<body class="bg-gray-50 text-gray-800">

  <!-- PUBLIC HEADER -->
  <header id="publicHeader"
    class="fixed top-0 w-full z-50 backdrop-blur-xl bg-white/70 border-b border-gray-200 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

      <!-- Logo -->
      <a href="/" class="text-2xl font-bold tracking-tight text-gray-900 hover:text-indigo-600 transition">
        MyApp
      </a>

      <!-- Desktop Nav -->
      <nav class="hidden md:flex gap-8 text-sm font-medium">
        <a href="/" class="hover:text-indigo-600 transition">Home</a>
        <a href="/about.php" class="hover:text-indigo-600 transition">About</a>
        <a href="/contact.php" class="hover:text-indigo-600 transition">Contact</a>
        <a href="/login.php"
          class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition shadow">
          Login
        </a>
      </nav>

      <!-- Mobile Menu Button -->
      <button id="menuBtn" class="md:hidden flex flex-col gap-1">
        <span class="w-6 h-0.5 bg-black"></span>
        <span class="w-6 h-0.5 bg-black"></span>
        <span class="w-6 h-0.5 bg-black"></span>
      </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu"
      class="hidden flex-col bg-white/90 shadow-lg md:hidden px-6 pb-4 space-y-4 transition-all duration-300">
      <a href="/" class="block hover:text-indigo-600 transition">Home</a>
      <a href="/about.php" class="block hover:text-indigo-600 transition">About</a>
      <a href="/contact.php" class="block hover:text-indigo-600 transition">Contact</a>
      <a href="/login.php"
        class="block px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition shadow">
        Login
      </a>
    </div>
  </header>

  <div class="pt-20"></div>