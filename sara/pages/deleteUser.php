<?php
session_start();

require_once __DIR__ . "/../php/User.php";
$userTmp = new User();
$removeResult = false;

if (isset($_GET["id"])) {
    $removeResult = $userTmp->deleteUser($_GET["id"]);
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login/Sign-In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <meta http-equiv="Refresh" content="2" /> -->

    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="/sara/css/style.css">
    <link rel="stylesheet" href="/sara/css/calendar.css">

</head>
<body>
<div class="topnav">
    <a href="/sara/#Start">Zauek</a>
    <a href="/sara/#Rezerwacje">Rezerwacje</a>
    <a href="/sara/#Kontakt">Kontakt</a>
    <a href="/sara/#Galeria">Galeria</a>
    <?php if (!isset($_SESSION["user"])): ?>
        <a href="/sara/pages/login.php">Zaloguj</a>
    <?php else: ?>
        <?php
        $role = $userTmp->getLoggedUserRole()["role"];
        ?>
        <?php if ($role === 'admin'): ?>
            <a href="/sara/pages/deleteUser.php">Usuń użytkownika</a>
            <a href="/sara/pages/messagesList.php">Lista wiadomości</a>
        <?php else: ?>
            <a href="/sara/pages/userDetails.php">Edytuj swoje dane</a>
        <?php endif; ?>
        <a>Rola: <?= $role; ?></a>
        <a href="/sara/pages/logout.php">Wyloguj</a>
    <?php endif; ?>
</div>
<div class="container">
    <div class="desc">
        <div id="text">
            <h1>Usuwanie użytkowników</h1>
            <h2 id="userDeleted"><?= $removeResult ? "Użytkownik usunięty" : "" ?></h2>
            <ul>
                <?php $stmt = $userTmp->getAll(); ?>
                <?php foreach ($stmt as $row): ?>
                    <li><?= $row["username"] ?> - <a href="deleteUser.php?id=<?= $row["id"]; ?>">Usuń</a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
</body>
</html>
