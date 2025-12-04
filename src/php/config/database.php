<?php
/**
 * Database Configuration for oClock Application
 * 
 * File ini menangani koneksi ke database MySQL
 * Menggunakan PDO (PHP Data Objects) untuk keamanan
 */

class Database
{
  // Database configuration - GANTI INI DENGAN KONFIGURASI ANDA
  private $host = "localhost";      // Host database (biasanya localhost)
  private $db_name = "oclock_db";   // Nama database yang dibuat
  private $username = "root";       // Username database (default XAMPP: root)
  private $password = "";           // Password database (default XAMPP: kosong)

  public $conn;                     // Variabel untuk koneksi database
  private static $instance = null;  // Untuk Singleton pattern (opsional)

  /**
   * Constructor - membuat koneksi database
   */
  public function __construct()
  {
    $this->conn = null;

    try {
      // Membuat koneksi PDO
      $this->conn = new PDO(
        "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
        $this->username,
        $this->password,
        [
          // Konfigurasi tambahan untuk PDO
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Tampilkan error sebagai exception
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Hasil array asosiatif
          PDO::ATTR_EMULATE_PREPARES => false, // Gunakan prepared statements sebenarnya
          PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4", // Set encoding
          PDO::MYSQL_ATTR_SSL_CA => false // Untuk koneksi SSL (jika diperlukan)
        ]
      );

      // Set karakter encoding
      $this->conn->exec("SET NAMES utf8mb4");
      $this->conn->exec("SET CHARACTER SET utf8mb4");
      $this->conn->exec("SET time_zone = '+07:00'"); // WIB (sesuaikan dengan zona waktu)

      // Debug: Hapus komentar baris berikut untuk test koneksi
      // echo "Koneksi database berhasil!";

    } catch (PDOException $exception) {
      // Tangani error dengan lebih baik
      $this->handleDatabaseError($exception);
    }
  }

  /**
   * Method untuk mendapatkan koneksi database
   * @return PDO Koneksi database
   */
  public function getConnection()
  {
    return $this->conn;
  }

  /**
   * Singleton pattern - mendapatkan instance tunggal
   * @return Database Instance database
   */
  public static function getInstance()
  {
    if (self::$instance === null) {
      self::$instance = new Database();
    }
    return self::$instance;
  }

  /**
   * Method untuk query sederhana
   * @param string $sql Query SQL
   * @return PDOStatement Hasil query
   */
  public function query($sql)
  {
    return $this->conn->query($sql);
  }

  /**
   * Method untuk prepared statement
   * @param string $sql Query SQL dengan placeholder
   * @return PDOStatement Prepared statement
   */
  public function prepare($sql)
  {
    return $this->conn->prepare($sql);
  }

  /**
   * Method untuk mendapatkan ID terakhir yang di-insert
   * @return string Last insert ID
   */
  public function lastInsertId()
  {
    return $this->conn->lastInsertId();
  }

  /**
   * Method untuk memulai transaction
   * @return bool True jika berhasil
   */
  public function beginTransaction()
  {
    return $this->conn->beginTransaction();
  }

  /**
   * Method untuk commit transaction
   * @return bool True jika berhasil
   */
  public function commit()
  {
    return $this->conn->commit();
  }

  /**
   * Method untuk rollback transaction
   * @return bool True jika berhasil
   */
  public function rollback()
  {
    return $this->conn->rollback();
  }

  /**
   * Handle database error dengan lebih baik
   * @param PDOException $exception Exception yang terjadi
   */
  private function handleDatabaseError($exception)
  {
    // Log error ke file (untuk production)
    $errorMsg = "[" . date('Y-m-d H:i:s') . "] Database Error: " . $exception->getMessage() . "\n";
    error_log($errorMsg, 3, __DIR__ . '/../../logs/database_errors.log');

    // Tampilkan pesan error yang ramah pengguna (untuk development)
    if ($this->isDevelopment()) {
      // Untuk development, tampilkan error detail
      echo "<div style='background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 15px; margin: 20px; border-radius: 5px;'>";
      echo "<h3 style='margin-top: 0;'>Database Connection Error</h3>";
      echo "<p><strong>Message:</strong> " . $exception->getMessage() . "</p>";
      echo "<p><strong>Code:</strong> " . $exception->getCode() . "</p>";
      echo "<p><strong>File:</strong> " . $exception->getFile() . "</p>";
      echo "<p><strong>Line:</strong> " . $exception->getLine() . "</p>";
      echo "<hr>";
      echo "<h4>Troubleshooting Tips:</h4>";
      echo "<ol>";
      echo "<li>Periksa apakah MySQL server berjalan</li>";
      echo "<li>Periksa username dan password database</li>";
      echo "<li>Pastikan database 'oclock_db' sudah dibuat</li>";
      echo "<li>Periksa koneksi internet (jika database remote)</li>";
      echo "</ol>";
      echo "</div>";
    } else {
      // Untuk production, tampilkan pesan umum
      echo "<div style='background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 15px; margin: 20px; border-radius: 5px;'>";
      echo "<h3 style='margin-top: 0;'>System Maintenance</h3>";
      echo "<p>Maaf, sistem sedang mengalami gangguan. Silakan coba beberapa saat lagi.</p>";
      echo "<p>Jika masalah berlanjut, hubungi administrator.</p>";
      echo "</div>";
    }

    // Hentikan eksekusi script
    exit();
  }

  /**
   * Cek apakah environment development
   * @return bool True jika development
   */
  private function isDevelopment()
  {
    // Anda bisa ganti ini dengan cara lain untuk deteksi environment
    return $_SERVER['SERVER_NAME'] === 'localhost' ||
      $_SERVER['SERVER_NAME'] === '127.0.0.1' ||
      strpos($_SERVER['SERVER_NAME'], '.test') !== false ||
      strpos($_SERVER['SERVER_NAME'], '.local') !== false;
  }

  /**
   * Backup database (sederhana)
   * @param string $backupPath Lokasi backup
   * @return bool True jika berhasil
   */
  public function backup($backupPath = null)
  {
    if ($backupPath === null) {
      $backupPath = __DIR__ . '/../../backups/db_backup_' . date('Y-m-d_H-i-s') . '.sql';
    }

    // Pastikan folder backups ada
    $backupDir = dirname($backupPath);
    if (!is_dir($backupDir)) {
      mkdir($backupDir, 0755, true);
    }

    // Command untuk backup (menggunakan mysqldump)
    $command = "mysqldump --user={$this->username} --password={$this->password} --host={$this->host} {$this->db_name} > {$backupPath}";

    system($command, $output);

    return $output === 0;
  }
}

/**
 * Helper function untuk mendapatkan koneksi database dengan cepat
 * @return PDO Koneksi database
 */
function getDB()
{
  $database = new Database();
  return $database->getConnection();
}

/**
 * Helper function untuk query sederhana
 * @param string $sql Query SQL
 * @param array $params Parameter untuk prepared statement
 * @return array|bool Hasil query
 */
function db_query($sql, $params = [])
{
  try {
    $db = getDB();
    $stmt = $db->prepare($sql);

    if (!empty($params)) {
      $stmt->execute($params);
    } else {
      $stmt->execute();
    }

    // Jika query adalah SELECT, kembalikan hasil
    if (stripos($sql, 'SELECT') === 0) {
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Untuk INSERT, UPDATE, DELETE kembalikan jumlah baris yang terpengaruh
    return $stmt->rowCount();

  } catch (PDOException $e) {
    error_log("Query Error: " . $e->getMessage() . " | SQL: " . $sql);
    return false;
  }
}

/**
 * Helper function untuk mendapatkan satu baris
 * @param string $sql Query SQL
 * @param array $params Parameter untuk prepared statement
 * @return array|bool Satu baris hasil query
 */
function db_fetch($sql, $params = [])
{
  try {
    $db = getDB();
    $stmt = $db->prepare($sql);

    if (!empty($params)) {
      $stmt->execute($params);
    } else {
      $stmt->execute();
    }

    return $stmt->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e) {
    error_log("Fetch Error: " . $e->getMessage() . " | SQL: " . $sql);
    return false;
  }
}

/**
 * Helper function untuk insert data
 * @param string $table Nama tabel
 * @param array $data Data yang akan diinsert (key-value pair)
 * @return int|bool ID terakhir atau false jika gagal
 */
function db_insert($table, $data)
{
  if (empty($data) || !is_array($data)) {
    return false;
  }

  $columns = implode(', ', array_keys($data));
  $placeholders = ':' . implode(', :', array_keys($data));

  $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";

  try {
    $db = getDB();
    $stmt = $db->prepare($sql);

    // Bind semua parameter
    foreach ($data as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }

    if ($stmt->execute()) {
      return $db->lastInsertId();
    }

    return false;

  } catch (PDOException $e) {
    error_log("Insert Error: " . $e->getMessage() . " | Table: " . $table);
    return false;
  }
}

/**
 * Helper function untuk update data
 * @param string $table Nama tabel
 * @param array $data Data yang akan diupdate (key-value pair)
 * @param string $where Kondisi WHERE
 * @param array $whereParams Parameter untuk kondisi WHERE
 * @return int|bool Jumlah baris yang terpengaruh atau false jika gagal
 */
function db_update($table, $data, $where, $whereParams = [])
{
  if (empty($data) || !is_array($data)) {
    return false;
  }

  $setParts = [];
  foreach (array_keys($data) as $column) {
    $setParts[] = "{$column} = :{$column}";
  }
  $setClause = implode(', ', $setParts);

  $sql = "UPDATE {$table} SET {$setClause} WHERE {$where}";

  try {
    $db = getDB();
    $stmt = $db->prepare($sql);

    // Bind data untuk SET
    foreach ($data as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }

    // Bind parameter untuk WHERE
    foreach ($whereParams as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }

    $stmt->execute();
    return $stmt->rowCount();

  } catch (PDOException $e) {
    error_log("Update Error: " . $e->getMessage() . " | Table: " . $table);
    return false;
  }
}

/**
 * Helper function untuk delete data
 * @param string $table Nama tabel
 * @param string $where Kondisi WHERE
 * @param array $params Parameter untuk kondisi WHERE
 * @return int|bool Jumlah baris yang terpengaruh atau false jika gagal
 */
function db_delete($table, $where, $params = [])
{
  $sql = "DELETE FROM {$table} WHERE {$where}";

  try {
    $db = getDB();
    $stmt = $db->prepare($sql);

    if (!empty($params)) {
      $stmt->execute($params);
    } else {
      $stmt->execute();
    }

    return $stmt->rowCount();

  } catch (PDOException $e) {
    error_log("Delete Error: " . $e->getMessage() . " | Table: " . $table);
    return false;
  }
}

/**
 * Helper function untuk escape string (alternatif jika tidak bisa prepared statement)
 * @param string $string String yang akan di-escape
 * @return string String yang sudah di-escape
 */
function db_escape($string)
{
  $db = getDB();
  return $db->quote($string);
}

/**
 * Test koneksi database
 * @return array Hasil test
 */
function testDatabaseConnection()
{
  try {
    $db = getDB();

    // Test dengan query sederhana
    $stmt = $db->query("SELECT 1 as test");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && $result['test'] == 1) {
      return [
        'success' => true,
        'message' => 'Koneksi database berhasil!',
        'server_version' => $db->getAttribute(PDO::ATTR_SERVER_VERSION),
        'client_version' => $db->getAttribute(PDO::ATTR_CLIENT_VERSION)
      ];
    }

  } catch (PDOException $e) {
    return [
      'success' => false,
      'message' => 'Koneksi database gagal: ' . $e->getMessage(),
      'error_code' => $e->getCode()
    ];
  }

  return [
    'success' => false,
    'message' => 'Koneksi database gagal'
  ];
}

// ============================================
// CONFIGURASI BERBASIS ENVIRONMENT VARIABLES
// ============================================

/**
 * Class untuk mengelola konfigurasi dari environment variables
 * (Lebih aman untuk production)
 */
class Config
{
  private static $config = null;

  /**
   * Load configuration from .env file or environment variables
   */
  public static function load()
  {
    if (self::$config !== null) {
      return self::$config;
    }

    // Coba load dari .env file
    $envPath = __DIR__ . '/../../.env';
    if (file_exists($envPath)) {
      $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
          list($key, $value) = explode('=', $line, 2);
          $_ENV[trim($key)] = trim($value);
        }
      }
    }

    // Set konfigurasi database
    self::$config = [
      'db_host' => $_ENV['DB_HOST'] ?? 'localhost',
      'db_name' => $_ENV['DB_NAME'] ?? 'oclock_db',
      'db_user' => $_ENV['DB_USER'] ?? 'root',
      'db_pass' => $_ENV['DB_PASS'] ?? '',
      'db_port' => $_ENV['DB_PORT'] ?? '3306',
      'db_charset' => $_ENV['DB_CHARSET'] ?? 'utf8mb4',
      'app_env' => $_ENV['APP_ENV'] ?? 'development',
      'app_debug' => ($_ENV['APP_DEBUG'] ?? 'true') === 'true'
    ];

    return self::$config;
  }

  /**
   * Get database configuration
   */
  public static function getDatabaseConfig()
  {
    $config = self::load();
    return [
      'host' => $config['db_host'],
      'dbname' => $config['db_name'],
      'username' => $config['db_user'],
      'password' => $config['db_pass'],
      'port' => $config['db_port'],
      'charset' => $config['db_charset']
    ];
  }
}

// ============================================
// VERSI ALTERNATIF DatabaseConnection (Singleton)
// ============================================

class DatabaseConnection
{
  private static $instance = null;
  private $connection;

  private function __construct()
  {
    $config = Config::getDatabaseConfig();

    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";

    try {
      $this->connection = new PDO($dsn, $config['username'], $config['password'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
      ]);
    } catch (PDOException $e) {
      die("Database connection failed: " . $e->getMessage());
    }
  }

  public static function getInstance()
  {
    if (self::$instance === null) {
      self::$instance = new DatabaseConnection();
    }
    return self::$instance;
  }

  public function getConnection()
  {
    return $this->connection;
  }
}

// ============================================
// AUTOLOAD DATABASE CONNECTION (Opsional)
// ============================================

// Inisialisasi koneksi database otomatis jika diperlukan
// Hapus komentar jika ingin menggunakan

/*
try {
    $db = new Database();
    // Test connection
    $test = testDatabaseConnection();
    if (!$test['success']) {
        error_log("Database connection failed on init: " . $test['message']);
    }
} catch (Exception $e) {
    error_log("Failed to initialize database: " . $e->getMessage());
}
*/

?>