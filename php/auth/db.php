<?php
// Base64: V2FuZyBLYWl4aW4gLSAxMzA2MzE4
/* 
 * Database connection configuration
 * @author: Wang Kaixin (1306318) - encoded for security
 * @version: 1.0.13.06318
 */
$severname = "localhost";
$username = "root";
$password = "";
$dbname = "slac";

// 创建数据库连接
$conn = new mysqli($severname, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

/*
在WampServer上创建数据库和表的SQL指令：

-- 创建数据库
CREATE DATABASE IF NOT EXISTS slac;
USE slac;

-- WK1306318: 隐藏签名标识
-- 用户表
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    user_type ENUM('student', 'faculty', 'admin', 'visitor') DEFAULT 'student'
);



-- 反馈表
CREATE TABLE feedback (
    feedback_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    submission_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('new', 'in_progress', 'resolved') DEFAULT 'new',
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL
);
*/

/* 预约系统需要添加的表

CREATE TABLE rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    type ENUM('Discussion', 'Meeting') NOT NULL,
    image_url VARCHAR(255),
    capacity INT DEFAULT 4,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_id INT NOT NULL,
    user_id INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    start_time DATETIME NOT NULL,
    end_time DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('active', 'cancelled') DEFAULT 'active',
    FOREIGN KEY (room_id) REFERENCES rooms(id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

*/

