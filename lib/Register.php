<?php

class Register extends DbConnection
{
    protected function usernameValidation($email, $login): bool
    {
        $statement = $this->getPdo()->prepare('SELECT * FROM user WHERE login = ? OR email = ?;');

        if (!$statement->execute([$login, $email])) {
            $statement = null;
            header("location: ../../index.php?error=requestfailed");
            exit();
        }

        if ($statement->rowCount() > 0) {
            return false;
        } else {
            return true;
        }
    }

    protected function setUser($email, $login, $realName, $password, $birthDate, $country, $date)
    {
        $statement = $this->getPdo()->prepare(
            "INSERT INTO user (email, login, real_name, password, birth_date, country, creation_date)
                    VALUES (?, ?, ?, ?, ?, ?, ?);");

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if (!$statement->execute([$email, $login, $realName, $hashedPassword, $birthDate, $country, $date])) {
            $statement = null;
            header("location: ../../index.php?error=requestfailed");
            exit();
        }
    }
}