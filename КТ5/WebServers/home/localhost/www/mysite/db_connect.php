<!-- Fatal error: Uncaught Error: Call to undefined function mysql_connect() in Z:\home\localhost\www\mysite\db_connect.php:2 Stack trace: #0 Z:\home\localhost\www\mysite\articles.php(1): include() #1 {main} thrown in Z:\home\localhost\www\mysite\db_connect.php on line 2 -->

<?php
    $connection = mysqli_connect("localhost", "root", "", "my_db");

    if (!$connection) {
        die("Ошибка подключения: " . mysqli_connect_error());
    }

    mysqli_set_charset($connection, "utf8");

    session_start();
?>
