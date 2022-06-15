<?php

class Login extends DbConnection
{
    protected function getUser($login, $password)
    {
        $statement = $this->getPdo()->prepare(
        'SELECT password FROM user WHERE email = ? OR login = ?;');

        if (!$statement->execute([$login, $password])) {
            $statement = null;
            header("location: ../../index.php?error=requestfailed");
            exit();
        }

        if ($statement->rowCount() == 0) {
            $statement = null;
            header("location: ../../index.php?error=userNotFound");
            exit();
        }

        $hashedPassword = $statement->fetchAll(PDO::FETCH_ASSOC);
        $checkedPassword = password_verify($password, $hashedPassword[0]['password']);

        if ($checkedPassword == false) {
            $statement = null;
            header("location: ../../index.php?error=wrongPassword");
            exit();
        } elseif ($checkedPassword == true) {
            $statement = $this->getPdo()->prepare(
            'SELECT * FROM user WHERE email = ? OR login = ? AND password = ?;;');

            if (!$statement->execute([$login, $login, $password])) {
                $statement = null;
                header("location: ../../index.php?error=requestfailed");
                exit();
            }

            if ($statement->rowCount() == 0) {
                $statement = null;
                header("location: ../../index.php?error=userNotFound");
                exit();
            }

            $user = $statement->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION['user_id'] = $user[0]['id'];
            $_SESSION['user_login'] = $user[0]['login'];
            $_SESSION['user_email'] = $user[0]['email'];

        }
    }
}