<?php

class RegisterController extends Register
{
    private $email;
    private $login;
    private $realName;
    private $password;
    private $passwordRepeat;
    private $birthDate;
    private $country;
    private $agreement;
    private $date;

    public function __construct($email, $login, $realName, $password, $passwordRepeat, $birthDate, $country, $agreement)
    {
        $this->email = $email;
        $this->login = $login;
        $this->realName = $realName;
        $this->password = $password;
        $this->passwordRepeat = $passwordRepeat;
        $this->birthDate = $birthDate;
        $this->country = $country;
        $this->agreement = $agreement;
        $this->date = strtotime('now');
    }

    public function registerUser()
    {
        if ($this->blankField() == false) {
            header("location: ../../index.php?error=blankField");
            exit();
        }

        if ($this->invalidLogin() == false) {
            header("location: ../../index.php?error=invalidLogin");
            exit();
        }

        if ($this->invalidEmail() == false) {
            header("location: ../../index.php?error=invalidEmail");
            exit();
        }

        if ($this->passwordMatch() == false) {
            header("location: ../../index.php?error=passwordDoesNotMatch");
            exit();
        }

        if ($this->iaAgreedOnTerms() == false) {
            header("location: ../../index.php?error=notAgreedOnTerms");
            exit();
        }

        if ($this->isUserExist() == false) {
            header("location: ../../index.php?error=userExist");
            exit();
        }

        $this->setUser($this->email, $this->login, $this->realName,
        $this->password, $this->birthDate, $this->country, $this->date);
        unset($_SESSION['email']);
        unset($_SESSION['login']);
        unset($_SESSION['realName']);
        unset($_SESSION['birthDate']);
        unset($_SESSION['country']);
    }

    private function blankField(): bool
    {
        if (!$this->email || !$this->login || !$this->realName || !$this->password ||
              !$this->passwordRepeat || !$this->birthDate || !$this->country ) {
            return false;
        } else {
            return true;
        }
    }

    private function invalidLogin(): bool
    {
        if (!preg_match('/^[a-zA-Z8-9]*$/', $this->login)) {
            return false;
        } else {
            return true;
        }
    }

    private function invalidEmail(): bool
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        } else {
            return true;
        }
    }

    private function passwordMatch(): bool
    {
        if ($this->password !== $this->passwordRepeat) {
            return false;
        } else {
            return true;
        }
    }

    private function isUserExist(): bool
    {
        if ($this->usernameValidation($this->login, $this->email)) {
            return false;
        } else {
            return true;
        }
    }

    private function iaAgreedOnTerms(): bool
    {
        if (!isset($this->agreement)) {
            return false;
        } else {
            return true;
        }
    }
}