<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <nav>
        <ul class="menu-member">
            <li><a href="index.php">Test Case</a></li>
            <?php
            if (isset($_SESSION['user_id'] )) {
                ?>
                <li style="float:right"><a href="logout.php" class="header-login-a">LOGOUT</a></li>
                <li style="float:right"><a href="#"><?=$_SESSION['user_login']?></a></li>
                <li style="float:right"><a href="#"><?=$_SESSION['user_email']?></a></li>
                <?php
            } else {
                ?>
                <li style="float:right"><a href="#">SIGN UP</a></li>
                <li style="float:right"><a href="#" class="header-login-a">SIGN IN</a></li>
                <?php
            }
            ?>
        </ul>
    </nav>
</header>

<div class="container">
    <div class="switch">
        <div class="register" onclick="tab1()">SIGN UP</div>
        <div class="signin" onclick="tab2()">SIGN IN</div>
    </div>

    <div class="outer">
        <form action="action.php" method="post" id="form" style="margin-left: 15px">
            <div id="page">
                <label>SIGN UP</label>
                <div class="element">
                    <input type="text" name="email" placeholder="Email" value="<?= $_SESSION['email'] ?? '' ?>"><br>
                </div>
                <div class="element">
                     <input type="text" id="login" name="login" value="<?= $_SESSION['login'] ?? '' ?>" placeholder="Login"><br>
                </div>
                <div class="element">
                     <input type="text" id="realName" name="realName" value="<?= $_SESSION['realName'] ?? '' ?>" placeholder="Real Name"><br>
                </div>
                <div class="element">
                    <input type="password" id="password" name="password" placeholder="Password"><br>
                </div>
                <div class="element">
                    <input type="password" id="passwordRepeat" name="passwordRepeat" placeholder="Repeat Password"><br>
                </div>
                <div class="element">
                    <input type="date" id="birthDate" name="birthDate" value="<?= $_SESSION['birthDate'] ?? '' ?>" placeholder="Birth Date"><br>
                </div>
                <div class="element">
                <select name="country">
                        <option  value="<?= $_SESSION['country'] ?? '' ?>" disabled selected>Country</option>

                        <?php
                        require_once "lib/DbConnection.php";
                        $connection = new DbConnection();
                        $pdo = $connection->getPdo();
                        $stmt = $pdo->prepare('SELECT * FROM country');
                        $stmt->execute();
                        while ($country = $stmt->fetch(PDO::FETCH_ASSOC)):
                    ?>
                        <option><?=$country['name']?></option>
                        <?php endwhile; ?>
                    </select><br>
                </div>
                    <input type="checkbox" name="agreement" style="color: white" value=""><b style="color: white">Agree on terms & conditions</b><br>
                <div class="element">
                    <input type="submit" name="submit" id="btn" value="Register">
                </div>
            </div>

            <div id="page">
                <label>SIGN IM</label>
                <div class="element">
                    <input type="text" id="login" name="loginIn" placeholder="Login"><br>
                </div>
                <div class="element">
                    <input type="password" id="password" name="passwordIn" placeholder="Password"><br>
                 </div>
                <div class="element">
                    <input type="submit" name="submit" id="btn" value="Sign in">
                </div>
            </div>
        </form>
    </div>
    <?php

    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if (strpos($url, "error=blankField")) {
        echo "<p class='error'>You have an empty fields</p>";
    }

    if (strpos($url, "error=invalidLogin")) {
        echo "<p class='error'>You can use only letters and numbers for login</p>";
    }

    if (strpos($url, "error=invalidEmail")) {
        echo "<p class='error'>Invalid Email</p>";
    }

    if (strpos($url, "error=passwordDoesNotMatch")) {
        echo "<p class='error'>Password does not match</p>";
    }

    if (strpos($url, "error=notAgreedOnTerms")) {
        echo "<p class='error'>Please make sure you agreed on terms</p>";
    }

    if (strpos($url, "error=userExist")) {
        echo "<p class='error'>User is already exist</p>";
    }

    ?>
</div>
<script type="text/javascript" src="script.js"></script>
</body>
</html>


