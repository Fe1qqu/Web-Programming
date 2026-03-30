<?php
if (isset($_POST["login"]) && isset($_POST["password"])) {

    $login = $_POST["login"];
    $password = md5($_POST["password"]); // хеширование

    $sql = "SELECT * FROM users WHERE login = '$login'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) == 0) {
        // пользователя нет → регистрируем
        $sql = "INSERT INTO users (login, password) VALUES ('$login', '$password')";
        if (!mysqli_query($connection, $sql)) {
            echo "Ошибка: " . mysqli_error($connection);
        }

        $_SESSION["login"] = $login;
        $_SESSION["auth"] = 1;
    }
    else {
        // пользователь есть → проверяем пароль
        $user = mysqli_fetch_array($result);

        if ($user["password"] == $password) {
            $_SESSION["login"] = $login;
            $_SESSION["auth"] = 1;
        }
        else {
            $_SESSION["auth"] = 2; // неверный пароль
        }
    }
}

// если пользователь уже авторизован
if (isset($_SESSION["login"]) && $_SESSION["auth"] == 1) {
    $login = $_SESSION["login"];
}
?>

<?php if (isset($login) && $_SESSION["auth"] == 1) { ?>

    <p>Вы вошли как <b><?php echo $login;?></b></p>
    <p><a href="logout.php">Выйти</a></p>

<?php } else { ?>

    <?php if (isset($_SESSION["auth"]) && $_SESSION["auth"] == 2) { ?>
        <p style="color:red;">Неверный пароль!</p>
    <?php } ?>

    <form method="post">
        <p>Логин</p>
        <p><input type="text" name="login"></p>

        <p>Пароль</p>
        <p><input type="password" name="password"></p>

        <p><input type="submit" value="Войти"></p>
    </form>

<?php } ?>
