<!-- PUBLIC HEADER -->
<header id="publicHeader"
  class="w-full fixed top-0 left-0 z-30 bg-backgroundPrimary/60 backdrop-blur-lg border-b border-white/30 shadow-md">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
    <!-- Left side -->
    <div class="flex items-center gap-10">
      <!-- LOGO + FONT -->
      <div class="flex items-center gap-3">
        <img src="../public/img/logo/oclock.PNG" class="w-11 h-11" alt="Logo" />
        <h1 class="text-2xl font-bold tracking-wide text-text">Oclock</h1>
      </div>

      <!-- DESKTOP NAV -->
      <nav class="hidden md:flex items-center gap-6 text-[18px] font-semibold">
        <?php // <a href="#features" class="hover:text-primary transition">Fitur</a>
        // <a href="#about" class="hover:text-primary transition">Tentang</a> ?>
      </nav>
    </div>
    <!-- RIGHT SIDE | Desktop BUTTON NAV -->
    <div class="hidden md:flex items-center gap-4 font-medium">
      <a href="../src/pages/login.html"
        class="btn-navigation bg-primary text-textSecondary hover:bg-textPrimary">Login</a>
      <a href="../src/pages/login.html"
        class="btn-navigation text-text_primary [box-shadow:inset_0_0_0_4px_theme('colors.primary')] hover:[box-shadow:inset_0_0_0_4px_theme('colors.textPrimary')]">Register</a>
    </div>

    <!-- MOBILE MENU BUTTON -->
    <button id="menuBtn" class="md:hidden p-2 rounded-lg hover:bg-textSecondary">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="size-6">

        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />

      </svg>
    </button>
  </div>

  <!-- MOBILE MENU -->
  <div id="mobileNav" class="hidden md:hidden bg-backgroundPrimary/80 backdrop-blur-xl border-t border-textPrimary/80">
    <nav class="flex flex-col p-6 gap-4 text-textPrimary font-medium">
      <a href="#features" class="hover:text-primary transition">Fitur</a>
      <a href="#about" class="hover:text-primary transition">Tentang</a>

      <a href="../src/pages/login.html"
        class="btn-navigation bg-primary text-textSecondary hover:bg-textPrimary">Login</a>
      <a href="../src/pages/login.html"
        class="btn-navigation text-text_primary [box-shadow:inset_0_0_0_4px_theme('colors.primary')] hover:[box-shadow:inset_0_0_0_4px_theme('colors.textPrimary')]">Register</a>
    </nav>
  </div>
</header>

<div class="lg:pt-20"></div>