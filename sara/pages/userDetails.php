<?php
session_start();

require_once __DIR__ . "/../php/User.php";
$userTmp = new User();
$user = false;

$loggedUser = isset($_SESSION["user"]) ? $_SESSION["user"] : null;

if ($loggedUser) {
    $userDetails = $userTmp->getUserDetails($loggedUser['id']);
}

if (strtolower($_SERVER['REQUEST_METHOD']) === "post") {
    $user = $userTmp->addUserDetails($loggedUser['id'], $_POST["firstName"], $_POST["lastName"], $_POST['email']);
    $userDetails = $userTmp->getUserDetails($loggedUser['id']);
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>User edit</title>
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
            <?php if (!$user): ?>
                <form method="post" action="">
                    <label>Imię/First name</label>
                    <input type="text"
                           value="<?= isset($userDetails['first_name']) ? $userDetails['first_name'] : '' ?>" required
                           name="firstName"/>
                    <label>Nazwisko/Last name</label>
                    <input type="text" value="<?= isset($userDetails['last_name']) ? $userDetails['last_name'] : '' ?>"
                           required name="lastName"/>
                    <label>E-mail</label>
                    <input type="email" value="<?= isset($userDetails['email']) ? $userDetails['email'] : '' ?>"
                           required name="email"/>
                    <br>
                    <br>
                    <input type="submit" value="Zapisz/Save"/>
                </form>
            <?php else: ?>
                <h2>Dodano / Zedytowane dane</h2>
                <form method="post" action="">
                    <label>Imię/First name</label>
                    <input type="text"
                           value="<?= isset($userDetails['first_name']) ? $userDetails['first_name'] : '' ?>" required
                           name="firstName"/>
                    <label>Nazwisko/Last name</label>
                    <input type="text" value="<?= isset($userDetails['last_name']) ? $userDetails['last_name'] : '' ?>"
                           required name="lastName"/>
                    <label>E-mail</label>
                    <input type="email" value="<?= isset($userDetails['email']) ? $userDetails['email'] : '' ?>"
                           required name="email"/>
                    <br>
                    <br>
                    <input type="submit" value="Zapisz/Save"/>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
