<?php
session_start();

require_once __DIR__ . "/../php/User.php";
$userTmp = new User();

if(strtolower($_SERVER['REQUEST_METHOD']) === "post") {
    $user = $userTmp->get($_POST["username"], $_POST["password"]);

    if($user) {
        $_SESSION["user"] = $user;
    }
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
        $userTmp = new User();
        $role = $userTmp->getLoggedUserRole()["role"];
        ?>
        <?php if ($role === 'admin'): ?>
            <a href="/sara/pages/deleteUser.php">Usuń użytkownika</a>
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
            <?php if(!isset($_SESSION["user"])): ?>
         <form method="post" action="">
             <label>Login/Username</label>
             <input type="text" required name="username" />
             <label>Hasło/Password</label>
             <input type="password" required name="password" />
             <br>
             <br>
             <input type="submit" value="Zaloguj/Login" />
         </form>
            <?php else: ?>
                <h2>Zalogowano</h2>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
