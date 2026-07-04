<?php
require 'db.php';
 
// Passwords are NEVER stored in plain text — we store a secure hash
$username = 'admin';
$password = 'Secret123';
$hash = password_hash($password, PASSWORD_DEFAULT);
 
$stmt = $pdo->prepare('INSERT INTO users (username, password_hash) VALUES (?, ?)');
$stmt->execute([$username, $hash]);
 
echo 'Test user created. Username: admin | Password: Secret123';

