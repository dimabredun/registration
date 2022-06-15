<?php

class LoginController extends Login
{
    private $login;
    private $password;

    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function loginUser()
    {
        if ($this->blankField() == false) {
            header("location: ../../index.php?error=blankField");
            exit();
        }

        if (!str_contains($this->login, '@')) {
            $this->getUser($this->login, $this->password, true);
            return;
        }

        $this->getUser($this->login, $this->password);

    }

    private function blankField(): bool
    {
        if (empty($this->login || $this->password )) {
            return false;
        } else {
            return true;
        }
    }
}
