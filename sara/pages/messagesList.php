<?php
session_start();

require_once __DIR__ . "/../php/User.php";
require_once __DIR__ . "/../php/Message.php";

$userTmp = new User();
$messageTmp = new Message();
$messagesList = $messageTmp->getAll();

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
            <h1>Lista wiadomości</h1>
            <ul>
                <li><strong>Imię - Nazwisko - Kraj/Miasto - Wiadomość</strong></li>
                <?php foreach ($messagesList as $row): ?>
                    <li><?= $row["first_name"] ?> - <?= $row["last_name"] ?> - <?= $row["place"] ?> - <?= $row["content"] ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
</body>
</html>
