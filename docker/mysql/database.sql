-- Database: oclock_db
CREATE DATABASE IF NOT EXISTS oclock_db;
USE oclock_db;

-- Table: users
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100),
    role ENUM('user', 'admin') DEFAULT 'user',
    profile_image VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: tasks
CREATE TABLE tasks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    deadline DATE NOT NULL,
    estimated_time INT COMMENT 'Waktu estimasi dalam menit',
    importance INT COMMENT 'Tingkat kepentingan 1-5',
    urgency INT COMMENT 'Tingkat urgensi 1-5',
    difficulty INT COMMENT 'Tingkat kesulitan 1-5',
    category VARCHAR(50),
    priority_level VARCHAR(20) DEFAULT NULL COMMENT 'Hasil clustering: high/medium/low',
    status ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Table: kmeans_clusters (untuk menyimpan hasil clustering)
CREATE TABLE kmeans_clusters (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    task_id INT NOT NULL,
    cluster INT COMMENT '0: tinggi, 1: sedang, 2: rendah',
    distance_to_centroid DECIMAL(10,4),
    iteration INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (task_id) REFERENCES tasks(id) ON DELETE CASCADE
);

-- Tambah kolom untuk keamanan
ALTER TABLE users 
ADD COLUMN email_verified_at TIMESTAMP NULL AFTER email,
ADD COLUMN remember_token VARCHAR(100) NULL AFTER password,
ADD COLUMN last_login TIMESTAMP NULL AFTER updated_at;

-- Tambah index untuk performa
CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_users_username ON users(username);