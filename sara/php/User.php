<?php

require_once __DIR__ . "/BaseClass.php";

class User extends BaseClass {

    function add($username = '', $password = '') {

        $hashedPassword = md5($password);
        $stmt = $this->getDb()->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);

        return $stmt->execute();
    }

    function get($username = '', $password = '') {
        $stmt = $this->getDb()->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $stmt->execute(['username' => $username, 'password' => md5($password)]);
        return $stmt->fetch();
    }

    function getAll() {
        $stmt = $this->getDb()->query("SELECT * FROM `users`");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getLoggedUserRole() {
        if (isset($_SESSION["user"])) {
            $user = $_SESSION["user"];
            $stmt = $this->getDb()->prepare("SELECT role FROM roles WHERE id IN (SELECT role_id FROM users_roles WHERE user_id = :user_id)");
            $stmt->execute(['user_id' => $user['id']]);
            return $stmt->fetch();
        } else {
            return null;
        }
    }

    function deleteUser($id) {

        try {
            //begin a transaction
            $this->getDb()->beginTransaction();

            $stmt = $this->getDb()->prepare("DELETE FROM users_roles WHERE user_id = :user_id");
            $stmt->execute(['user_id' => $id]);

            $stmt = $this->getDb()->prepare("DELETE FROM users WHERE id = :user_id");
            $stmt->execute(['user_id' => $id]);


            // If we arrive here, it means that no exception was thrown
            // i.e. no query has failed, and we can commit the transaction
            $this->getDb()->commit();
        } catch (Exception $e) {
            // An exception has been thrown
            // We must rollback the transaction

            print_r("roll back");

            $this->getDb()->rollback();
        }

    }

    function addUserDetails($userId = '', $firstName = '', $lastName = '', $email = '') {

        $userDetails = $this->getUserDetailsSimple($userId);

        if(!$userDetails) {
            $stmt = $this->getDb()->prepare("INSERT INTO user_details (user_id, first_name, last_name, email) VALUES (:user_id, :first_name, :last_name, :email)");
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':first_name', $firstName);
            $stmt->bindParam(':last_name', $lastName);
            $stmt->bindParam(':email', $email);
            return $stmt->execute();
        } else {
            $stmt = $this->getDb()->prepare("UPDATE user_details SET first_name = :first_name, last_name = :last_name, email = :email WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':first_name', $firstName);
            $stmt->bindParam(':last_name', $lastName);
            $stmt->bindParam(':email', $email);
            return $stmt->execute();
        }

    }

    function getUserDetailsSimple($userId = '') {
        $stmt = $this->getDb()->prepare("SELECT * FROM user_details WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetch();
    }

    function getUserDetails($userId = '') {
        $stmt = $this->getDb()->prepare("SELECT * FROM users_with_details WHERE id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetch();
    }


}