<?php
require_once __DIR__ . '../config/database.php';

class Auth
{
  private $db;

  public function __construct()
  {
    $database = new Database();
    $this->db = $database->getConnection();
  }

  /**
   * Register new user
   */
  public function register($data)
  {
    try {
      // Validate input
      $errors = $this->validateRegistration($data);
      if (!empty($errors)) {
        return ['success' => false, 'message' => implode('<br>', $errors)];
      }

      // Check if username exists
      if ($this->usernameExists($data['username'])) {
        return ['success' => false, 'message' => 'Username sudah digunakan'];
      }

      // Check if email exists
      if ($this->emailExists($data['email'])) {
        return ['success' => false, 'message' => 'Email sudah terdaftar'];
      }

      // Hash password
      $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

      // Insert user
      $query = "INSERT INTO users (username, email, password, full_name, role) 
                     VALUES (:username, :email, :password, :full_name, 'user')";

      $stmt = $this->db->prepare($query);

      $stmt->bindParam(':username', $data['username']);
      $stmt->bindParam(':email', $data['email']);
      $stmt->bindParam(':password', $hashedPassword);
      $stmt->bindParam(':full_name', $data['full_name']);

      if ($stmt->execute()) {
        return [
          'success' => true,
          'message' => 'Registrasi berhasil! Anda akan diarahkan ke halaman login.'
        ];
      } else {
        return ['success' => false, 'message' => 'Terjadi kesalahan saat registrasi'];
      }

    } catch (PDOException $e) {
      error_log("Registration error: " . $e->getMessage());
      return ['success' => false, 'message' => 'Terjadi kesalahan sistem'];
    }
  }

  /**
   * Login user
   */
  public function login($data)
  {
    try {
      $identifier = trim($data['identifier']);
      $password = $data['password'];

      // Check if identifier is email or username
      $field = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

      // Get user by email or username
      $query = "SELECT * FROM users WHERE $field = :identifier";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(':identifier', $identifier);
      $stmt->execute();

      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$user) {
        return ['success' => false, 'message' => 'Email/username atau password salah'];
      }

      // Verify password
      if (!password_verify($password, $user['password'])) {
        return ['success' => false, 'message' => 'Email/username atau password salah'];
      }

      // Update last login
      $this->updateLastLogin($user['id']);

      // Return user data without password
      unset($user['password']);

      return [
        'success' => true,
        'message' => 'Login berhasil',
        'user' => $user
      ];

    } catch (PDOException $e) {
      error_log("Login error: " . $e->getMessage());
      return ['success' => false, 'message' => 'Terjadi kesalahan sistem'];
    }
  }

  /**
   * Validate registration data
   */
  private function validateRegistration($data)
  {
    $errors = [];

    // Full name validation
    if (empty($data['full_name'])) {
      $errors[] = 'Nama lengkap harus diisi';
    } elseif (strlen($data['full_name']) < 3) {
      $errors[] = 'Nama lengkap minimal 3 karakter';
    }

    // Username validation
    if (empty($data['username'])) {
      $errors[] = 'Username harus diisi';
    } elseif (strlen($data['username']) < 3) {
      $errors[] = 'Username minimal 3 karakter';
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $data['username'])) {
      $errors[] = 'Username hanya boleh mengandung huruf, angka, dan underscore';
    }

    // Email validation
    if (empty($data['email'])) {
      $errors[] = 'Email harus diisi';
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
      $errors[] = 'Format email tidak valid';
    }

    // Password validation
    if (empty($data['password'])) {
      $errors[] = 'Password harus diisi';
    } elseif (strlen($data['password']) < 8) {
      $errors[] = 'Password minimal 8 karakter';
    } elseif (!preg_match('/[A-Z]/', $data['password'])) {
      $errors[] = 'Password harus mengandung minimal 1 huruf besar';
    } elseif (!preg_match('/\d/', $data['password'])) {
      $errors[] = 'Password harus mengandung minimal 1 angka';
    }

    // Confirm password
    if ($data['password'] !== $data['confirm_password']) {
      $errors[] = 'Password dan konfirmasi password tidak cocok';
    }

    // Terms agreement
    if (!isset($data['terms'])) {
      $errors[] = 'Anda harus menyetujui syarat dan ketentuan';
    }

    return $errors;
  }

  /**
   * Check if username exists
   */
  private function usernameExists($username)
  {
    $query = "SELECT id FROM users WHERE username = :username";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    return $stmt->rowCount() > 0;
  }

  /**
   * Check if email exists
   */
  private function emailExists($email)
  {
    $query = "SELECT id FROM users WHERE email = :email";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->rowCount() > 0;
  }

  /**
   * Update last login timestamp
   */
  private function updateLastLogin($userId)
  {
    $query = "UPDATE users SET last_login = NOW() WHERE id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
  }

  /**
   * Check if user is logged in
   */
  public static function check()
  {
    return isset($_SESSION['user_id']);
  }

  /**
   * Get current user
   */
  public static function user()
  {
    if (self::check()) {
      return [
        'id' => $_SESSION['user_id'],
        'username' => $_SESSION['username'],
        'email' => $_SESSION['email'],
        'role' => $_SESSION['role'],
        'full_name' => $_SESSION['full_name']
      ];
    }
    return null;
  }

  /**
   * Logout user
   */
  public static function logout()
  {
    session_destroy();
    return true;
  }

  /**
   * Check if user is admin
   */
  public static function isAdmin()
  {
    return self::check() && $_SESSION['role'] === 'admin';
  }
}
?>