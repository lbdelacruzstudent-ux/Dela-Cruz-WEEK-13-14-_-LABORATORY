<?php
require 'db.php';
$message = '';
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
 
    // VULNERABLE: user input is concatenated straight into the SQL string,
    // so typing  ' OR '1'='1  in the username field changes the query's logic.
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $row = $pdo->query($sql)->fetch();
 
    $message = $row ? ('Matched user: ' . $row['username']) : 'No match.';
}
?>
<form method="POST">
    <input name="username" placeholder="Username">
    <button type="submit">Check</button>
</form>
<p><?php echo htmlspecialchars($message); ?></p>

