<?php

session_start();
session_destroy();

header("Location: http://localhost/sara/pages/login.php", true);