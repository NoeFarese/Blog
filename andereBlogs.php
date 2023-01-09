<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="blog.css" rel="stylesheet">
    <title>andere Blogs</title>
</head>
<body>
<Header>
            <h1>Andere Blogs</h1>
            </Header>
        <nav class="grid-item-nav">
            <ul class="flex-container">
                <li class="flex-item blogs"><a href="index.php" class="Navigation">Hauptseite</a></li>
                <li class="flex-item blogs"><a href="blog.php" class="Navigation">Blogs</a></li>
                <li class="flex-item blogs"><a href="blogErstellen.php" class="Navigation">Blog erstellen</a></li>
            </ul>
        </nav>
    </header>

    <?php 

    $dbAurel = new PDO('mysql:host=mysql1.webland.ch;dbname=d041e_auschmid', 'd041e_auschmid', '12345_Db!!!', [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    ]);

    $query = 'select * from webseiten';
    $stmt = $dbAurel->query($query);
    $rows = $stmt->fetchAll();

    echo '<ul>';
    
    foreach($rows as $row) {
        echo  '<div class="andereBlogsListe">Blog von:  <a href="' . $row['adresse'] . '" target="_blank">' . $row["vorname"] . ' ' . $row["nachname"] .  '</a></div>';
    }

    echo '</ul>';
    die();
?>
</body>
</html>