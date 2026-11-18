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

$errors = [];
$sent = isset($_GET['sent']);
$form = ['name' => '', 'email' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form['name'] = trim($_POST['name'] ?? '');
    $form['email'] = trim($_POST['email'] ?? '');
    $form['message'] = trim($_POST['message'] ?? '');

    if ($form['name'] === '' || mb_strlen($form['name']) > 80) {
        $errors[] = 'Please write your name, up to 80 characters.';
    }

    if (!filter_var($form['email'], FILTER_VALIDATE_EMAIL) || mb_strlen($form['email']) > 120) {
        $errors[] = 'Please write a valid email address.';
    }

    if ($form['message'] === '' || mb_strlen($form['message']) > 1000) {
        $errors[] = 'Please write a message, up to 1000 characters.';
    }

    if (!$errors) {
        if ($pdo) {
            $statement = $pdo->prepare('INSERT INTO messages (name, email, message) VALUES (?, ?, ?)');
            $statement->execute([$form['name'], $form['email'], $form['message']]);
            header('Location: index.php?sent=1#contact');
            exit;
        }

        $errors[] = 'Messages cannot be saved while the database is offline.';
    }
}

$count = $pdo ? (int) $pdo->query('SELECT COUNT(*) FROM messages')->fetchColumn() : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetiha Ousman | Personal Portfolio</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <nav>
            <h2 class="logo">&#128081; Fetiha Ousman</h2>

            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#hobbies">Hobbies</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>

            <a href="messages.php" class="cv">Inbox (<?= $count ?>)</a>
        </nav>
    </header>

    <section id="home">
        <div class="profile">
            <img src="Profile.jpg" alt="Fetiha Ousman">
        </div>

        <div class="welcome">
            <h3>Welcome to my website!</h3>
            <h1>Fetiha Ousman</h1>
            <h2>Student | Developer | Tech Enthusiast</h2>
            <p>
                Passionate about learning new technologies, building 
                creative web projects, and exploring code. Welcome to my personal space!
            </p>
            <a href="#about" class="button">Explore More &rarr;</a>
        </div>

        <div class="social">
            <h2>Connect With Me &#9825;</h2>
            <p>GitHub | LinkedIn | Telegram | TikTok</p>
            <h3>Code. Create. Inspire.</h3>
        </div>
    </section>

    <section id="about">
        <h2>About Me</h2>
        <p>
            Hello! I'm Fetiha Ousman. An ambitious student dedicated 
            to mastering programming, web development, and expanding my digital skills.
        </p>
        <a href="#contact">Get in Touch &rarr;</a>
    </section>

    <section id="hobbies">
        <h2>My Hobbies</h2>
        <div class="hobby">
            <h3>&#128187; Coding</h3>
            <h3>&#128218; Reading</h3>
            <h3>&#127911; Music</h3>
            <h3>&#127916; Movies</h3>
        </div>
    </section>

    <section id="skills">
        <h2>My Skills</h2>
        <div class="skills-list">
            <p>HTML &amp; CSS</p>
            <p>PHP &amp; MySQL</p>
            <p>JavaScript</p>
            <p>Problem Solving</p>
        </div>
    </section>

    <section id="contact">
        <h2>Contact Me</h2>
        <p>Have a question or want to work together? Drop a message!</p>

        <?php if ($dbError): ?>
            <div class="notice bad"><?= e($dbError) ?></div>
        <?php endif; ?>

        <?php if ($sent): ?>
            <div class="notice ok">Thank you! Your message has been saved. <a href="messages.php">View Inbox</a>.</div>
        <?php endif; ?>

        <?php if ($errors): ?>
            <div class="notice bad">
                <strong>Please check the form fields.</strong>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= e($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" action="index.php#contact">
            <input type="text" name="name" placeholder="Your Name" maxlength="80" value="<?= e($form['name']) ?>" required>
            <input type="email" name="email" placeholder="Your Email" maxlength="120" value="<?= e($form['email']) ?>" required>
            <textarea name="message" rows="5" placeholder="Your Message" maxlength="1000" required><?= e($form['message']) ?></textarea>
            <button type="submit" class="button">Send Message</button>
        </form>

        <p class="inbox-link"><a href="messages.php">Check saved messages &rarr;</a></p>
    </section>

    <footer>
        <p>&copy; <?= date('Y') ?> Fetiha Ousman. All Rights Reserved.</p>
    </footer>

</body>
</html>
