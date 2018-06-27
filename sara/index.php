<?php session_start(); ?>
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

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/calendar.css">

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
        <a>Rola: <?= $role ?></a>
        <?php if ($role === 'admin'): ?>
            <a href="/sara/pages/deleteUser.php">Usuń użytkownika</a>
            <a href="/sara/pages/messagesList.php">Lista wiadomości</a>
        <?php endif; ?>
        <a href="/sara/pages/logout.php">Wyloguj</a>
    <?php endif; ?>
</div>
<div class="container">
    <div class="desc">
        <div id="text">
            <h2>ZaUEK...</h2>
            <p>Klub Studencki zaUEK to nie tylko najlepsza kawa i ciasta w okolicy - w studenckich cenach.
                To przede wszystkim centrum kulturalne całej Uczelni - i nie tylko.
                Pokazy filmowe, koncerty, mecze, slajdowiska, karaoke i co tylko przyjdzie jeszcze nam do głowy.
                Nam, gdyż zaUEK to klub całej społeczności UEK i każdy może zrealizować w nim swój pomysł na wieczorne
                atrakcje.
                Klub Studencki zaUEK powstał pod opieką Stowarzyszenia Parlamentu Studenckiego UEK, a cały dochód z
                działalności przekazywany będzie na działalność studencką.
                Każda kawa czy herbata wypita w klubie oznacza np. jeszcze lepsze Juwenalia!!</p>
        </div>
    </div>
    <div class="slideshow-container" id="Galeria">
        <div class="mySlides fade">
            <div class="numbertext">1 / 3</div>
            <img src="img/11.jpg" style="width:100%">
            <div class="text">Caption Text</div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">2 / 3</div>
            <img src="img/12.jpg" style="width:100%">
            <div class="text">Caption Two</div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext">3 / 4</div>
            <img src="img/13.jpg" style="width:100%">
            <div class="text">Caption Three</div>
        </div>
        <div class="mySlides fade">
            <div class="numbertext">4 / 4</div>
            <img src="img/14.jpg" style="width:100%">
            <div class="text">Caption Four</div>
        </div>


        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>
    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        <span class="dot" onclick="currentSlide(4)"></span>

        <script src="index.js"></script>
    </div>
    <div class="calendar">
        <?php
        include_once 'calendar.php';
        ?>
    </div>
    <div class="reserwation">

        <div class="row">
            <div class="col-75">
                <div class="container_r">
                    <form action="/action_page.php">

                        <div class="row">
                            <div class="col-50">
                                <h3>Rezerwacje</h3>
                                <label for="fname"><i class="fa fa-user"></i>Imię i Nazwisko</label>
                                <input type="text" id="fname" name="firstname" placeholder="Jan Kowalski">
                                <label for="email"><i class="fa fa-envelope"></i> Email</label>
                                <input type="text" id="email" name="email" placeholder="john@example.com">
                                <label for="adr"><i class="fa fa-address-card-o"></i>Data</label>
                                <input type="text" id="adr" name="address" placeholder="1 maja 2018">
                                <label for="city"><i class="fa fa-institution"></i>Godzina</label>
                                <input type="text" id="city" name="city" placeholder="18:00">
                                <label for="city"><i class="fa fa-institution"></i>Liczba osób</label>
                                <input type="text" id="city" name="city" placeholder="12">
                                <label for="city"><i class="fa fa-institution"></i>Telefon</label>
                                <input type="text" id="city" name="city" placeholder="123-123-123">

                                <div class="row">

                                    <div class="col-50">

                                    </div>
                                </div>
                            </div>

                            <div class="col-50">
                                <h3>Erasmus Reserwation</h3>
                                <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                                <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
                                <label for="email"><i class="fa fa-envelope"></i> Email</label>
                                <input type="text" id="email" name="email" placeholder="john@example.com">
                                <label for="adr"><i class="fa fa-address-card-o"></i> Date</label>
                                <input type="text" id="adr" name="address" placeholder="1 May 2018">
                                <label for="city"><i class="fa fa-institution"></i> Hour</label>
                                <input type="text" id="city" name="city" placeholder=" 6 pm">
                                <label for="city"><i class="fa fa-institution"></i>Number people</label>
                                <input type="text" id="city" name="city" placeholder="12">
                                <label for="city"><i class="fa fa-institution"></i>Phone</label>
                                <input type="text" id="city" name="city" placeholder="123-123-123">

                                <div class="row">
                                    <div class="col-50">

                                    </div>
                                    <div class="col-50">

                                    </div>
                                </div>
                            </div>

                        </div>
                        <label>
                            <input type="checkbox" checked="checked" name="sameadr"> Akceptuję regulamin
                            rezerwacji</input>
                        </label>
                        <input type="submit" value="Dokonaj rezerwcji/ Finish reserwation" class="btn">
                    </form>
                </div>
            </div>

            <div class="col-25">
                <div class="container_t">
                    <h4>Twoje rezerwacje:
                        <span class="price" style="color:black">
             <i class="fa fa-shopping-cart"></i>
             <b>4</b>
           </span>
                    </h4>
                    <p><a href>18 maj 2017r.</a> <span class="18 maj 2017"></span></p>
                    <p><a href>23 grudzień 2017r.</a> <span class="23 grudzie 2017"></span></p>
                    <p><a href>3 marca 2018r.</a> <span class="3 marca 2018"></span></p>
                    <p><a href>1 maja 2017r.</a> <span class="1 maja 2017"></span></p>

                </div>
            </div>
        </div>
    </div>
    <div id="Kontakt" class="contact">
        <div style="text-align:left">
            <h2>Napisz do Nas/Contact Us</h2>
            <p>"Swing by for a cup of coffee, or leave us a message:"</p>
        </div>
        <div class="row">
            <div class="column">
                <div id="map" style="width:100%;height:500px">

                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2560.923656247805!2d19.953726715717654!3d50.068991379424546!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47165b1f2aca72f9%3A0x7022fc7637af3d01!2szaUEK!5e0!3m2!1spl!2spl!4v1528406949184"
                            width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>

                </div>
            </div>
            <div class="column">
                <span id="contactFormMessage"></span>
                <form action="javascript::void(0)" id="contactForm">
                    <label for="fname">Imię/First Name</label>
                    <input type="text" id="fname" name="firstName" placeholder="Your name.." required>
                    <label for="lname">Nazwisko/Last Name</label>
                    <input type="text" id="lname" name="lastName" placeholder="Your last name.." required>
                    <label for="country">Miasto/Country</label>
                    <select id="country" name="place">
                        <option value="uk">Ukraina</option>
                        <option value="hisz">Hiszpania</option>
                        <option value="fr">Francja</option>
                        <option value="pl">Polska</option>
                    </select>
                    <label for="subject">Temat/Subject</label>
                    <textarea id="subject" name="content" placeholder="Write something.." style="height:170px"
                              required></textarea>
                    <input type="submit" onClick="sendContactForm()" value="Wyślij/Send">
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
