<?php

require_once __DIR__ . "/../php/Message.php";



function saveMessage($firstName = '', $lastName = '', $place = '', $content = '') {
    $message = new Message();
    return $message->save($firstName, $lastName, $place, $content);
}


// Obsługa requestów
$request = strtolower($_SERVER['REQUEST_METHOD']);
$data = json_decode(file_get_contents('php://input'), true);

switch ($request) {
    case "post":
        // postem wysyłamy dane które następnie zapiszą się do bazy danych
        return saveMessage($data["firstName"], $data["lastName"], $data["place"], $data["content"] );
    case "get":
        // przy get nie wykonujemy żadnej akcji
        return false;
}

