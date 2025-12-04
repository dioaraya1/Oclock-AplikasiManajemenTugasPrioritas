<?php
session_start();
require_once __DIR__ . '/../../src/config/database.php';
require_once __DIR__ . '/../../src/utils/Auth.php';

// Redirect jika sudah login
if (isset($_SESSION['user_id'])) {
  header('Location: index.php');
  exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $auth = new Auth();
  $result = $auth->register($_POST);

  if ($result['success']) {
    $success = $result['message'];
    // Redirect ke login setelah 3 detik
    header('refresh:3;url=login.php');
  } else {
    $error = $result['message'];
  }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar - oClock</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/main.build.css">
  <style>
    .gradient-bg {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .card-shadow {
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .input-with-icon {
      position: relative;
    }

    .input-with-icon input {
      padding-left: 3rem;
    }

    .input-with-icon .icon {
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: #9ca3af;
    }

    .password-toggle {
      position: absolute;
      right: 1rem;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #9ca3af;
    }
  </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-primary-50 via-white to-purple-50">
  <!-- Back to Home -->
  <div class="container mx-auto px-4 py-6">
    <a href="../index.php" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
      </svg>
      Kembali ke Beranda
    </a>
  </div>

  <div class="flex items-center justify-center min-h-screen px-4 py-12 -mt-12">
    <div class="w-full max-w-6xl mx-auto">
      <div class="flex flex-col lg:flex-row items-center bg-white rounded-2xl overflow-hidden card-shadow">
        <!-- Left Side - Illustration -->
        <div class="lg:w-1/2 p-8 lg:p-12 gradient-bg text-white">
          <div class="max-w-md mx-auto">
            <a href="../index.php" class="flex items-center space-x-3 mb-8">
              <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                <span class="text-2xl">⏰</span>
              </div>
              <span class="text-2xl font-bold">oClock</span>
            </a>

            <h1 class="text-3xl lg:text-4xl font-bold mb-6">
              Bergabung dengan Ribuan Pengguna Produktif
            </h1>

            <ul class="space-y-4 mb-8">
              <li class="flex items-center">
                <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center mr-3">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
                <span>Analisis Prioritas Otomatis dengan AI</span>
              </li>
              <li class="flex items-center">
                <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center mr-3">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
                <span>Dashboard Interaktif & Visual</span>
              </li>
              <li class="flex items-center">
                <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center mr-3">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
                <span>Gratis Selamanya untuk Fitur Utama</span>
              </li>
              <li class="flex items-center">
                <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center mr-3">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
                <span>Support 24/7</span>
              </li>
            </ul>

            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
              <p class="text-sm mb-4">"oClock telah mengubah cara saya mengatur waktu. Sekarang saya selalu fokus pada
                tugas yang benar-benar penting!"</p>
              <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-white/20 mr-3"></div>
                <div>
                  <p class="font-bold">Sarah</p>
                  <p class="text-sm opacity-80">Mahasiswa</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Side - Registration Form -->
        <div class="lg:w-1/2 p-8 lg:p-12">
          <div class="max-w-md mx-auto">
            <div class="text-center mb-8">
              <h2 class="text-3xl font-bold text-gray-900 mb-2">Buat Akun Gratis</h2>
              <p class="text-gray-600">Mulai kelola tugas Anda dengan lebih efektif</p>
            </div>

            <!-- Error/Success Messages -->
            <?php if ($error): ?>
              <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-center">
                <div class="w-6 h-6 rounded-full bg-red-100 flex items-center justify-center mr-3">
                  <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                  </svg>
                </div>
                <span class="text-red-700"><?php echo htmlspecialchars($error); ?></span>
              </div>
            <?php endif; ?>

            <?php if ($success): ?>
              <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center">
                <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center mr-3">
                  <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
                <span class="text-green-700"><?php echo htmlspecialchars($success); ?></span>
              </div>
            <?php endif; ?>

            <form method="POST" action="" class="space-y-6" id="registerForm">
              <!-- Full Name -->
              <div>
                <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">
                  Nama Lengkap
                </label>
                <div class="input-with-icon">
                  <div class="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                  </div>
                  <input type="text" id="full_name" name="full_name"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition-all pl-12"
                    placeholder="Masukkan nama lengkap"
                    value="<?php echo htmlspecialchars($_POST['full_name'] ?? ''); ?>" required>
                </div>
              </div>

              <!-- Username -->
              <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                  Username
                </label>
                <div class="input-with-icon">
                  <div class="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                      </path>
                    </svg>
                  </div>
                  <input type="text" id="username" name="username"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition-all pl-12"
                    placeholder="Pilih username unik" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                    required>
                </div>
                <p class="text-xs text-gray-500 mt-1">Hanya boleh menggunakan huruf, angka, dan underscore</p>
              </div>

              <!-- Email -->
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                  Email
                </label>
                <div class="input-with-icon">
                  <div class="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                      </path>
                    </svg>
                  </div>
                  <input type="email" id="email" name="email"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition-all pl-12"
                    placeholder="nama@email.com" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                    required>
                </div>
              </div>

              <!-- Password -->
              <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                  Password
                </label>
                <div class="input-with-icon">
                  <div class="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                      </path>
                    </svg>
                  </div>
                  <input type="password" id="password" name="password"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition-all pl-12 pr-12"
                    placeholder="Minimal 8 karakter" required>
                  <span class="password-toggle" onclick="togglePassword('password')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                      </path>
                    </svg>
                  </span>
                </div>
                <div class="mt-2 space-y-1">
                  <div class="flex items-center">
                    <div id="length-check" class="w-3 h-3 rounded-full bg-gray-300 mr-2"></div>
                    <span class="text-xs text-gray-600">Minimal 8 karakter</span>
                  </div>
                  <div class="flex items-center">
                    <div id="upper-check" class="w-3 h-3 rounded-full bg-gray-300 mr-2"></div>
                    <span class="text-xs text-gray-600">Minimal 1 huruf besar</span>
                  </div>
                  <div class="flex items-center">
                    <div id="number-check" class="w-3 h-3 rounded-full bg-gray-300 mr-2"></div>
                    <span class="text-xs text-gray-600">Minimal 1 angka</span>
                  </div>
                </div>
              </div>

              <!-- Confirm Password -->
              <div>
                <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">
                  Konfirmasi Password
                </label>
                <div class="input-with-icon">
                  <div class="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                      </path>
                    </svg>
                  </div>
                  <input type="password" id="confirm_password" name="confirm_password"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition-all pl-12 pr-12"
                    placeholder="Ketik ulang password" required>
                  <span class="password-toggle" onclick="togglePassword('confirm_password')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                      </path>
                    </svg>
                  </span>
                </div>
                <div class="mt-2">
                  <div class="flex items-center">
                    <div id="match-check" class="w-3 h-3 rounded-full bg-gray-300 mr-2"></div>
                    <span class="text-xs text-gray-600">Password harus sama</span>
                  </div>
                </div>
              </div>

              <!-- Terms & Conditions -->
              <div class="flex items-start">
                <input type="checkbox" id="terms" name="terms"
                  class="w-4 h-4 text-primary-600 rounded focus:ring-primary-500 border-gray-300 mt-1" required>
                <label for="terms" class="ml-2 text-sm text-gray-600">
                  Saya menyetujui
                  <a href="#" class="text-primary-600 hover:text-primary-700 font-medium">Syarat & Ketentuan</a>
                  dan
                  <a href="#" class="text-primary-600 hover:text-primary-700 font-medium">Kebijakan Privasi</a>
                  oClock
                </label>
              </div>

              <!-- Submit Button -->
              <button type="submit"
                class="w-full btn btn-primary py-4 text-lg font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300"
                id="submitBtn">
                <span id="btnText">Buat Akun Gratis</span>
                <div id="btnSpinner" class="hidden">
                  <svg class="animate-spin h-5 w-5 text-white mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                  </svg>
                </div>
              </button>
            </form>

            <!-- Login Link -->
            <div class="mt-8 text-center">
              <p class="text-gray-600">
                Sudah punya akun?
                <a href="login.php" class="text-primary-600 hover:text-primary-700 font-medium">
                  Masuk di sini
                </a>
              </p>
            </div>

            <!-- Divider -->
            <div class="mt-8 flex items-center">
              <div class="flex-grow border-t border-gray-300"></div>
              <span class="flex-shrink mx-4 text-gray-500 text-sm">Atau daftar dengan</span>
              <div class="flex-grow border-t border-gray-300"></div>
            </div>

            <!-- Social Login -->
            <div class="mt-6 grid grid-cols-2 gap-3">
              <button type="button"
                class="w-full py-3 px-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition flex items-center justify-center">
                <svg class="w-5 h-5 mr-2 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                  <path
                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                </svg>
                Facebook
              </button>
              <button type="button"
                class="w-full py-3 px-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                  <path
                    d="M23.954 11.629c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-1.574 2.163-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                </svg>
                Twitter
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Feature Highlights -->
      <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
          <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
              </path>
            </svg>
          </div>
          <h3 class="font-bold text-gray-900 mb-2">Keamanan Data</h3>
          <p class="text-gray-600 text-sm">Data Anda dienkripsi dan dilindungi dengan standar keamanan tertinggi.</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
          <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z">
              </path>
            </svg>
          </div>
          <h3 class="font-bold text-gray-900 mb-2">Prioritas Otomatis</h3>
          <p class="text-gray-600 text-sm">AI akan menganalisis dan mengurutkan tugas berdasarkan kepentingan.</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
          <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
              </path>
            </svg>
          </div>
          <h3 class="font-bold text-gray-900 mb-2">Gratis Selamanya</h3>
          <p class="text-gray-600 text-sm">Fitur utama tersedia gratis tanpa batas waktu.</p>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Password toggle functionality
    function togglePassword(fieldId) {
      const field = document.getElementById(fieldId);
      const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
      field.setAttribute('type', type);

      const icon = field.parentElement.querySelector('.password-toggle svg');
      if (type === 'text') {
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>';
      } else {
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
      }
    }

    // Password validation
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('confirm_password');

    function validatePassword() {
      const password = passwordField.value;
      const confirmPassword = confirmPasswordField.value;

      // Length check
      const lengthCheck = document.getElementById('length-check');
      if (password.length >= 8) {
        lengthCheck.classList.remove('bg-gray-300');
        lengthCheck.classList.add('bg-green-500');
      } else {
        lengthCheck.classList.remove('bg-green-500');
        lengthCheck.classList.add('bg-gray-300');
      }

      // Uppercase check
      const upperCheck = document.getElementById('upper-check');
      if (/[A-Z]/.test(password)) {
        upperCheck.classList.remove('bg-gray-300');
        upperCheck.classList.add('bg-green-500');
      } else {
        upperCheck.classList.remove('bg-green-500');
        upperCheck.classList.add('bg-gray-300');
      }

      // Number check
      const numberCheck = document.getElementById('number-check');
      if (/\d/.test(password)) {
        numberCheck.classList.remove('bg-gray-300');
        numberCheck.classList.add('bg-green-500');
      } else {
        numberCheck.classList.remove('bg-green-500');
        numberCheck.classList.add('bg-gray-300');
      }

      // Match check
      const matchCheck = document.getElementById('match-check');
      if (password && confirmPassword && password === confirmPassword) {
        matchCheck.classList.remove('bg-gray-300');
        matchCheck.classList.add('bg-green-500');
      } else {
        matchCheck.classList.remove('bg-green-500');
        matchCheck.classList.add('bg-gray-300');
      }
    }

    passwordField.addEventListener('input', validatePassword);
    confirmPasswordField.addEventListener('input', validatePassword);

    // Form submission
    document.getElementById('registerForm').addEventListener('submit', function (e) {
      const password = passwordField.value;
      const confirmPassword = confirmPasswordField.value;

      if (password !== confirmPassword) {
        e.preventDefault();
        alert('Password dan Konfirmasi Password tidak cocok!');
        return;
      }

      if (password.length < 8) {
        e.preventDefault();
        alert('Password minimal 8 karakter!');
        return;
      }

      // Show loading state
      const submitBtn = document.getElementById('submitBtn');
      const btnText = document.getElementById('btnText');
      const btnSpinner = document.getElementById('btnSpinner');

      btnText.classList.add('hidden');
      btnSpinner.classList.remove('hidden');
      submitBtn.disabled = true;
    });

    // Real-time username availability check
    const usernameField = document.getElementById('username');
    let usernameTimeout;

    usernameField.addEventListener('input', function () {
      clearTimeout(usernameTimeout);

      usernameTimeout = setTimeout(() => {
        const username = this.value.trim();
        if (username.length >= 3) {
          checkUsernameAvailability(username);
        }
      }, 500);
    });

    function checkUsernameAvailability(username) {
      // You can implement AJAX call here to check username availability
      // For now, just client-side validation
      const usernamePattern = /^[a-zA-Z0-9_]+$/;
      if (!usernamePattern.test(username)) {
        showUsernameMessage('Username hanya boleh huruf, angka, dan underscore', 'error');
      }
    }

    function showUsernameMessage(message, type) {
      // Implement message display
    }
  </script>
</body>

</html>