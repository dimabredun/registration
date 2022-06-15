<?php

class Login extends DbConnection
{
    protected function getUser($login, $password, $isLogin = false)
    {
        $query = 'SELECT * FROM user ';
        $query .= $isLogin ? 'WHERE login = ?;' : 'WHERE email = ?;';

        $statement = $this->getPdo()->prepare($query);

        if (!$statement->execute([$login])) {
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

        $checkedPassword = password_verify($password, $user[0]['password']);

        if ($checkedPassword == false) {
            $statement = null;
            header("location: ../../index.php?error=wrongPassword");
            exit();
        }

        session_start();
        $_SESSION['user_id'] = $user[0]['id'];
        $_SESSION['user_login'] = $user[0]['login'];
        $_SESSION['user_email'] = $user[0]['email'];
    }
}