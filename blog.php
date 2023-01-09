<?php
$user = 'd041e_nofarese';
$password = '12345_Db!!!';
$database = 'd041e_nofarese';

$pdo = new PDO('mysql:host=mysql1.webland.ch;dbname=' . $database, $user, $password, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

$stmt = $pdo->query('SELECT * FROM `posts` ORDER BY id DESC');
$blogs = $stmt->fetchALL();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="blog.css" rel="stylesheet">
    <title>Blog - Noé Farese</title>
</head>

<body>

    <Header>
        <h1>Blogs</h1>
    </Header>
    <nav class="grid-item-nav">
        <ul class="flex-container">
            <li class="flex-item blogs"><a href="index.php" class="Navigation">Hauptseite</a></li>
            <li class="flex-item blogs"><a href="blogErstellen.php" class="Navigation">Blog erstellen</a></li>
            <li class="flex-item andere-blogs"><a href="andereBlogs.php" class="Navigation">Andere Blogs</a></li>
        </ul>
    </nav>
    </header>

    <?php
    foreach ($blogs as $blog) { ?>

        <div class="flexcontainer">
            <div>
                <div>
                    <h2 class="benutzername">Benutzername:</h2>
                    <p><?= htmlspecialchars($blog['created_by']) ?></p>
                </div>

                <div>
                    <h2 class="erstelldatum">Erstelldatum:</h2>
                    <p><?= htmlspecialchars($blog['created_at']) ?></p>
                </div>

                <div>
                    <h2 class="titel">Titel:</h2>
                    <p><?= htmlspecialchars($blog['post_title']) ?></p>
                </div>

                <div>
                    <h2 class="beitrag">Beitrag:</h2>
                    <p><?= htmlspecialchars($blog['post_text']) ?></p>
                </div>

                <div>
                    <?php if (strlen($blog['bilder'] > 4)) { ?>
                        <h2 class="bilder">Bild:</h2>
                        <img class="image" src=<?= htmlspecialchars($blog['bilder']) ?> widht="150" , height="175"> <?php }                                                                                        ?>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</body>
</html>