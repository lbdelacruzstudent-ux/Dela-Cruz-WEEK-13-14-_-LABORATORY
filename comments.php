<?php
session_start();
$comments = $_SESSION['comments'] ?? [];
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comments[] = $_POST['comment'] ?? '';
    $_SESSION['comments'] = $comments;
}
?>
<form method="POST">
    <input name="comment" placeholder="Write a comment">
    <button type="submit">Post</button>
</form>
 
<h3>Comments (SECURE — output is escaped)</h3>
<?php foreach ($comments as $c): ?>
    <!-- htmlspecialchars converts < > & " into harmless entities -->
    <p><?php echo htmlspecialchars($c, ENT_QUOTES, 'UTF-8'); ?></p>
<?php endforeach; ?>
