<?php
require 'db.php';
$message = '';
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
 
    // SECURE: the ? placeholder keeps input as DATA, never as SQL code.
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();
 
    if ($user && password_verify($password, $user['password_hash'])) {
        $message = 'Login successful. Welcome, '
                 . htmlspecialchars($user['username']) . '!';
    } else {
        $message = 'Invalid username or password.';
    }
}
?>
<form method="POST">
    <input name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Log in</button>
</form>
<p><?php echo htmlspecialchars($message); ?></p>


