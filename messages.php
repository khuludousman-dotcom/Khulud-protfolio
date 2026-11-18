<?php
date_default_timezone_set('Africa/Addis_Ababa');

$studentName = 'fetiha ousman';
$dbHost = '127.0.0.1';
$dbName = 'fetiha_portfolio';
$dbUser = 'root';
$dbPass = '';

$pdo = null;
$dbError = '';

try {
    $pdo = new PDO("mysql:host=$dbHost;charset=utf8mb4", $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `$dbName`");
    $pdo->exec("CREATE TABLE IF NOT EXISTS messages (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(80) NOT NULL,
        email VARCHAR(120) NOT NULL,
        message TEXT NOT NULL,
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
} catch (PDOException $exception) {
    $pdo = null;
    $dbError = 'The database is not connected. Start MySQL in XAMPP, then refresh this page.';
}

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

$messages = [];

if ($pdo) {
    $messages = $pdo->query('SELECT id, name, email, message, created_at FROM messages ORDER BY id DESC')->fetchAll();
}

$count = count($messages);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox | Fetiha Ousman</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <nav>
            <h2 class="logo">&#128081; Fetiha Ousman</h2>

            <ul>
                <li><a href="index.php#home">Home</a></li>
                <li><a href="index.php#about">About</a></li>
                <li><a href="index.php#contact">Contact</a></li>
            </ul>

            <a href="index.php" class="cv">Portfolio</a>
        </nav>
    </header>

    <section class="inbox">
        <h2>Admin Inbox</h2>
        <p class="lead"><?= $count ?> message<?= $count === 1 ? '' : 's' ?> received from visitors.</p>

        <?php if ($dbError): ?>
            <div class="notice bad"><?= e($dbError) ?></div>
        <?php endif; ?>

        <?php if (!$messages && !$dbError): ?>
            <div class="empty">
                <p>No messages yet. Check back later!</p>
                <a href="index.php#contact" class="button">Back to Home</a>
            </div>
        <?php endif; ?>

        <?php if ($messages): ?>
            <div class="msg-list">
                <?php foreach ($messages as $message): ?>
                    <article class="msg">
                        <div class="msg-head">
                            <h3><?= e($message['name']) ?></h3>
                            <span><?= date('d M Y, H:i', strtotime($message['created_at'])) ?></span>
                        </div>
                        <a href="mailto:<?= e($message['email']) ?>"><?= e($message['email']) ?></a>
                        <p><?= e($message['message']) ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>

    <footer>
        <p>&copy; <?= date('Y') ?> Fetiha Ousman. All Rights Reserved.</p>
    </footer>

</body>
</html>
