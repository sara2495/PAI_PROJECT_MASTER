<?php

require_once __DIR__ . "/BaseClass.php";

class Message extends BaseClass {

    function save($firstName = '', $lastName = '', $place = '', $content = '') {

        $stmt = $this->getDb()->prepare("INSERT INTO messages (first_name, last_name, place, content) VALUES (:firstName, :lastName, :place, :content)");
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':place', $place);
        $stmt->bindParam(':content', $content);

        return $stmt->execute();
    }

    function getAll() {
        $stmt = $this->getDb()->query("SELECT * FROM `messages`");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}