<?php
session_start();
 
// Generate a token once per session
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['csrf_token'];
$result = '';
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // hash_equals prevents timing attacks during comparison
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
        die('CSRF validation failed. Request rejected.');
    }
    $result = 'Action completed securely.';
}
?>
<form method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
    <button type="submit">Transfer Funds</button>
</form>
<p><?php echo htmlspecialchars($result); ?></p>

