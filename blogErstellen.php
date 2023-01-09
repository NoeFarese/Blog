<?php
$user = 'd041e_nofarese';
$password = '12345_Db!!!';
$database = 'd041e_nofarese';

$pdo = new PDO('mysql:host=mysql1.webland.ch;dbname=' . $database, $user, $password, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

$stmt = $pdo->query('SELECT * FROM `posts`');
$blogs = $stmt->fetchALL();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="blog.css" rel="stylesheet">
    <title>Blog erstellen - Noé Farese</title>
</head>
<body>

    <Header>
            <h1>Blogs</h1>
        </Header>
        <nav class="grid-item-nav">
            <ul class="flex-container">
                <li class="flex-item blogs"><a href="index.php" class="Navigation">Hauptseite</a></li>
                <li class="flex-item blogs"><a href="blog.php" class="Navigation">Blogs</a></li>
                <li class="flex-item andere-blogs"><a href="andereBlogs.php" class="Navigation">Andere Blogs</a></li>
            </ul>
        </nav>
    </header>

<form action="blogErstellen.php" method="POST">

    <h1>Neuer Blog erstellen</h1>
            <fieldset class="fieldset">
                <div class="form-field">
                    <label class="form-label" for="name">Name: <br></label>
                    <input class="form-control" type="text" id="name" name="name">
                </div>

                <div class="form-field">
                    <label class="form-label" for="titel">Titel des Beitrags: <br></label>
                    <textarea class="form-control" type="text" id="titel" name="titel"></textarea>
                </div>

                <div class="form-field">
                    <label class="form-label" for="message">Ihr Text: <br></label>
                    <textarea class="form-control" type="text" id="message" name="message"></textarea>
                </div>

                <div class="form-field">
                    <label class="form-label" for="bilder">Bild: <br></label>
                    <textarea class="form-control" type="picture" id="bilder" name="bilder" placeholder ="URL des Bildes"></textarea>
                </div>

                <input class="speicherButton" name="button" type="submit" value="Speichern">
        
</form>
            </fieldset>

<?php 

$data = $_POST;
$name = 'name';
$titel = 'titel';
$bilder = 'bilder';
$message = 'message';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $data = $_POST;
        $errors = [];
        
       if (count($data) > 0) {
        $name = trim($_POST['name'] ?? '');
            if ($data["name"] === "") {
                $errors[] = "Bitte geben Sie einen Namen ein.";
            } else {
               // echo 'Dein Name: ' . $name;
            }
        
        $message = trim($_POST['message'] ?? '');    
            if ($data["message"] === '') {
                $errors[] = 'Bitte geben Sie eine Nachricht ein.';
            } else {
              //  echo 'Deine Nachricht: ' . $message; 
                
            }
    
        $titel = trim($_POST['titel'] ?? '');    
            if ($data["titel"] === '') {
                $errors[] = 'Bitte geben Sie einen Titel ein.';
            } else {
               // echo 'Ihr Titel: ' .$titel;
            }
        }

        $bilder = trim($_POST ['bilder'] ?? '');
            if ($data["bilder"] === '') {
                $errors[] = 'Bitte fügen Sie ein Bild ein.';
            }  else {
               // echo 'Ihr Titel: ' .$bilder;
            } 


if (count($errors) > 0) { ?>
            <div class="error-box">
                <ul>
                    <?php foreach ($errors as $error) { ?>
                        <li><?= $error ?></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } 
else {
    $stmt = $pdo->prepare("INSERT INTO `posts` (created_by, post_text, post_title, bilder) VALUES(:name, :titel, :message, :bilder) ");
    $stmt->execute([':name' => $name, ':titel' => $titel, ':message' => $message, ':bilder' => $bilder]); 
        }
    }   
?>