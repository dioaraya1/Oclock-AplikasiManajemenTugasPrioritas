<?php
// session_start();
// require_once __DIR__ . '/../../src/config/database.php';
// require_once __DIR__ . '/../../src/utils/Auth.php';

// // Redirect jika sudah login
// if (isset($_SESSION['user_id'])) {
//   header('Location: index.php');
//   exit();
// }

// $error = '';
// $success = isset($_GET['success']) ? 'Registrasi berhasil! Silakan login.' : '';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//   $auth = new Auth();
//   $result = $auth->login($_POST);

//   if ($result['success']) {
//     $_SESSION['user_id'] = $result['user']['id'];
//     $_SESSION['username'] = $result['user']['username'];
//     $_SESSION['email'] = $result['user']['email'];
//     $_SESSION['role'] = $result['user']['role'];
//     $_SESSION['full_name'] = $result['user']['full_name'];

//     // Redirect based on role
//     if ($result['user']['role'] === 'admin') {
//       header('Location: admin/index.php');
//     } else {
//       header('Location: index.php');
//     }
//     exit();
//   } else {
//     $error = $result['message'];
//   }
// }
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Masuk - oClock</title>
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

    .remember-forgot {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    @media (max-width: 640px) {
      .remember-forgot {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
      }
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
        <!-- Left Side - Login Form -->
        <div class="lg:w-1/2 p-8 lg:p-12">
          <div class="max-w-md mx-auto">
            <div class="text-center mb-8">
              <a href="../index.php" class="inline-flex items-center space-x-3 mb-6">
                <div
                  class="w-12 h-12 bg-gradient-to-r from-primary-600 to-primary-400 rounded-xl flex items-center justify-center">
                  <span class="text-2xl text-white">⏰</span>
                </div>
                <span class="text-2xl font-bold text-primary-800">oClock</span>
              </a>
              <h2 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang Kembali</h2>
              <p class="text-gray-600">Masuk untuk melanjutkan ke dashboard Anda</p>
            </div>

            <!-- Error/Success Messages -->
            <?php if ($error): ?>
              <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-center animate-shake">
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

            <form method="POST" action="" class="space-y-6" id="loginForm">
              <!-- Email/Username -->
              <div>
                <label for="identifier" class="block text-sm font-medium text-gray-700 mb-2">
                  Email atau Username
                </label>
                <div class="input-with-icon">
                  <div class="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                      </path>
                    </svg>
                  </div>
                  <input type="text" id="identifier" name="identifier"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition-all pl-12"
                    placeholder="Email atau username"
                    value="<?php echo htmlspecialchars($_POST['identifier'] ?? ''); ?>" required autofocus>
                </div>
              </div>

              <!-- Password -->
              <div>
                <div class="flex justify-between items-center mb-2">
                  <label for="password" class="block text-sm font-medium text-gray-700">
                    Password
                  </label>
                  <a href="forgot-password.php" class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                    Lupa password?
                  </a>
                </div>
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
                    placeholder="Masukkan password" required>
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
              </div>

              <!-- Remember Me & Forgot Password -->
              <div class="remember-forgot">
                <div class="flex items-center">
                  <input type="checkbox" id="remember" name="remember"
                    class="w-4 h-4 text-primary-600 rounded focus:ring-primary-500 border-gray-300" <?php echo isset($_POST['remember']) ? 'checked' : ''; ?>>
                  <label for="remember" class="ml-2 text-sm text-gray-600">
                    Ingat saya selama 30 hari
                  </label>
                </div>
              </div>

              <!-- Submit Button -->
              <button type="submit"
                class="w-full btn btn-primary py-4 text-lg font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 group"
                id="submitBtn">
                <span id="btnText" class="flex items-center justify-center">
                  <svg class="w-5 h-5 mr-2 transition-transform group-hover:translate-x-1" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                    </path>
                  </svg>
                  Masuk ke Dashboard
                </span>
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

              <!-- Demo Accounts -->
              <div class="mt-4">
                <details class="bg-gray-50 rounded-lg p-4">
                  <summary class="font-medium text-gray-700 cursor-pointer hover:text-primary-600">
                    🔐 Akun Demo (Klik untuk melihat)
                  </summary>
                  <div class="mt-3 space-y-2 text-sm">
                    <div class="p-2 bg-white rounded border">
                      <p class="font-medium">User Demo</p>
                      <p class="text-gray-600">Email: <span class="font-mono">user@demo.com</span></p>
                      <p class="text-gray-600">Password: <span class="font-mono">demo123</span></p>
                    </div>
                    <div class="p-2 bg-white rounded border">
                      <p class="font-medium">Admin Demo</p>
                      <p class="text-gray-600">Email: <span class="font-mono">admin@demo.com</span></p>
                      <p class="text-gray-600">Password: <span class="font-mono">admin123</span></p>
                    </div>
                  </div>
                </details>
              </div>
            </form>

            <!-- Register Link -->
            <div class="mt-8 text-center">
              <p class="text-gray-600">
                Belum punya akun?
                <a href="register.php" class="text-primary-600 hover:text-primary-700 font-medium">
                  Daftar di sini
                </a>
              </p>
            </div>

            <!-- Divider -->
            <div class="mt-8 flex items-center">
              <div class="flex-grow border-t border-gray-300"></div>
              <span class="flex-shrink mx-4 text-gray-500 text-sm">Atau masuk dengan</span>
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

        <!-- Right Side - Illustration & Features -->
        <div class="lg:w-1/2 p-8 lg:p-12 gradient-bg text-white">
          <div class="max-w-md mx-auto">
            <h1 class="text-3xl lg:text-4xl font-bold mb-6">
              Kelola Tugas dengan Lebih Cerdas
            </h1>

            <div class="space-y-6 mb-8">
              <!-- Feature 1 -->
              <div class="flex items-start">
                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center mr-4 flex-shrink-0">
                  <span class="text-lg">🤖</span>
                </div>
                <div>
                  <h3 class="font-bold text-lg mb-1">Analisis AI Real-time</h3>
                  <p class="text-white/80">Sistem secara otomatis menganalisis dan mengurutkan prioritas tugas Anda.</p>
                </div>
              </div>

              <!-- Feature 2 -->
              <div class="flex items-start">
                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center mr-4 flex-shrink-0">
                  <span class="text-lg">📊</span>
                </div>
                <div>
                  <h3 class="font-bold text-lg mb-1">Dashboard Interaktif</h3>
                  <p class="text-white/80">Visualisasi data yang mudah dipahami untuk melacak produktivitas.</p>
                </div>
              </div>

              <!-- Feature 3 -->
              <div class="flex items-start">
                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center mr-4 flex-shrink-0">
                  <span class="text-lg">⏱️</span>
                </div>
                <div>
                  <h3 class="font-bold text-lg mb-1">Penghematan Waktu</h3>
                  <p class="text-white/80">Hemat hingga 40% waktu dengan sistem prioritas otomatis.</p>
                </div>
              </div>
            </div>

            <!-- Stats -->
            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 mb-8">
              <div class="grid grid-cols-3 gap-4 text-center">
                <div>
                  <div class="text-2xl font-bold">10K+</div>
                  <div class="text-sm opacity-80">Pengguna Aktif</div>
                </div>
                <div>
                  <div class="text-2xl font-bold">85%</div>
                  <div class="text-sm opacity-80">Efisiensi</div>
                </div>
                <div>
                  <div class="text-2xl font-bold">4.9</div>
                  <div class="text-sm opacity-80">Rating</div>
                </div>
              </div>
            </div>

            <!-- Testimonial -->
            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
              <p class="text-sm mb-4 italic">"Sejak menggunakan oClock, saya tidak pernah ketinggalan deadline. Sistem
                prioritasnya benar-benar membantu fokus pada yang penting!"</p>
              <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-white/20 mr-3"></div>
                <div>
                  <p class="font-bold">Budi</p>
                  <p class="text-sm opacity-80">Freelancer</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Security Notice -->
      <div class="mt-8 text-center">
        <div
          class="inline-flex items-center text-sm text-gray-600 bg-white px-4 py-2 rounded-lg border border-gray-200">
          <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
            </path>
          </svg>
          Data Anda dilindungi dengan enkripsi SSL 256-bit
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

    // Form submission
    document.getElementById('loginForm').addEventListener('submit', function (e) {
      const submitBtn = document.getElementById('submitBtn');
      const btnText = document.getElementById('btnText');
      const btnSpinner = document.getElementById('btnSpinner');

      // Show loading state
      btnText.classList.add('hidden');
      btnSpinner.classList.remove('hidden');
      submitBtn.disabled = true;
    });

    // Auto-focus on identifier field if empty
    document.addEventListener('DOMContentLoaded', function () {
      const identifierField = document.getElementById('identifier');
      if (!identifierField.value) {
        identifierField.focus();
      }
    });

    // Demo account auto-fill
    document.addEventListener('DOMContentLoaded', function () {
      const urlParams = new URLSearchParams(window.location.search);
      const demo = urlParams.get('demo');

      if (demo === 'user') {
        document.getElementById('identifier').value = 'user@demo.com';
        document.getElementById('password').value = 'demo123';
        document.getElementById('remember').checked = true;
      } else if (demo === 'admin') {
        document.getElementById('identifier').value = 'admin@demo.com';
        document.getElementById('password').value = 'admin123';
        document.getElementById('remember').checked = true;
      }
    });
  </script>
</body>

</html>