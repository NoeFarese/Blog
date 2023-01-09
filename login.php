<?php
$user = 'root';
$password = '';
$database = 'blog';

$pdo = new PDO('mysql:host=localhost;dbname=' . $database, $user, $password, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

$stmt = $pdo->query('SELECT * FROM `users`');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = $_POST;

    $errors = [];

    if (count($data) > 0) {
        $first_name = trim($_POST['first_name'] ?? '');
        if ($data["first_name"] === "") {
            $errors[] = "Bitte geben Sie Ihren Vornamen ein.";
        } else {
            echo 'Ihr Vorname: ' . $first_name;
        }

        $last_name = trim($_POST['last_name'] ?? '');
        if ($data["last_name"] === '') {
            $errors[] = 'Bitte geben Sie Ihren Nachnamen ein.';
        } else {
            echo 'Ihr Nachname: ' . $last_name;
        }

        $email = trim($_POST['email'] ?? '');
        if ($data["email"] === '') {
            $errors[] = 'Bitte geben Sie eine E-Mail ein.';
        } else {
            echo 'Ihre E-Mail: ' . $email;
        }

        $user_name = trim($_POST['user_name'] ?? '');
        if ($data["user_name"] === '') {
            $errors[] = 'Bitte geben Sie einen Benutzernamen ein.';
        } else {
            echo 'Ihr Benutzername: ' . $user_name;
        }

        $user_password = trim($_POST['user_password'] ?? '');
        if ($data["user_password"] === '') {
            $errors[] = 'Bitte geben Sie ein Passwort ein.';
        } else {
            echo 'Ihr Passwort: ' . $user_password;
        }
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

    $stmt = $pdo->prepare("INSERT INTO `users` (first_name, last_name, email, user_name, user_password) VALUES(:first_name, :last_name, :email, :user_name, :user_password) ");
    $stmt->execute([':first_name' => $first_name, ':last_name' => $last_name, ':email' => $email, ':user_name' => $user_name, ':user_password' => $user_password]);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="blog.css" rel="stylesheet">
    <title>Login</title>
</head>

<body>
    <Header>
        <h1>Login</h1>
    </Header>
    <nav class="grid-item-nav">
        <ul class="flex-container">
            <li class="flex-item andere-blogs"><a href="Hauptseite.php" class="Navigation">Hauptseite</a></li>
            <li class="flex-item blogs"><a href="blog.php" class="Navigation">Blogs</a></li>
            <li class="flex-item blogs"><a href="blogErstellen.php" class="Navigation">Blog erstellen</a></li>
            <li class="flex-item andere-blogs"><a href="andereBlogs.php" class="Navigation">Andere Blogs</a></li>
        </ul>
    </nav>
    </header>

    <main>
        <form class="formular" action="login.php" method="post">
            <fieldset class="fieldset">
                <legend class="form-legend">Ihre Kontaktdaten:</legend>
                <div class="form-group">
                    <label class="form-label" for="name">Ihr Vorname: <br></label>
                    <input class="form-control" type="text" id="vorname" name="vorname">
                </div>

                <div class="form-group">
                    <label class="form-label" for="name">Ihr Nachname: <br></label>
                    <input class="form-control" type="text" id="nachname" name="nachname">
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Ihre Email-Adresse: <br></label>
                    <input class="form-control" type="email" id="email" name="email">
                </div>

                <div class="form-group">
                    <label class="form-label" for="benutzername">Ihr Benutzername: <br></label>
                    <input class="form-control" type="text" id="benutzername" name="benutzername">
                </div>

                <div class="form-group">
                    <label class="form-label" for="passwort">Ihr Passwort: <br></label>
                    <input class="form-control" type="password" id="passwort" name="passwort">
                </div>
            </fieldset>
            <input class="speicherButton1" type="submit" value="Speichern">
        </form>
    </main>
</body>

</html>