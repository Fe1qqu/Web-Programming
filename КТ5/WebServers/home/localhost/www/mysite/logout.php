<?php
    session_start();              // инициализация сессии
    session_destroy();            // очистка сессии
    header("location:index.php"); // перенаправление на главную
?>
