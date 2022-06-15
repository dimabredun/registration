<?php

require_once "fileStorage.php";

if(!isset($_SESSION))
{
    session_start();
}

$_SESSION['email'] = $_POST['email'] ?? '';
$_SESSION['login'] = $_POST['login'] ?? '';
$_SESSION['realName'] = $_POST['realName'] ?? '';
$_SESSION['birthDate'] = $_POST['birthDate'] ?? '';
$_SESSION['country'] = $_POST['country'] ?? '';

if (isset($_POST['submit']) && $_POST['realName'] == '') {

    $login = $_POST['loginIn'];
    $password = $_POST['passwordIn'];

    $login = new LoginController($login, $password);
    $login->loginUser();
    header("location: index.php?error=none");

}

if (isset($_POST['submit']) && !empty($_POST['realName'])) {

    $email = $_POST['email'];
    $login = $_POST['login'];
    $realName = $_POST['realName'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordRepeat'];
    $birthDate = $_POST['birthDate'];
    $country = $_POST['country'];
    $agreement = $_POST['agreement'];

    $newUser = new RegisterController($email, $login, $realName, $password, $passwordRepeat, $birthDate, $country, $agreement);
    $newUser->registerUser();
    $login = new LoginController($login, $password);
    $login->loginUser();

    header("location: index.php?error=none");
}
