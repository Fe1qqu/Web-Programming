<?php include("db_connect.php");
    if (isset($_REQUEST["id"])) {
        $id = intval($_REQUEST["id"]);

        // статья
        $sql = "SELECT * FROM articles WHERE id=$id";
        $result = mysqli_query($connection, $sql);
        $article = mysqli_fetch_array($result);
        
        // вопросы
        $sql = "SELECT * FROM questions WHERE article_id = $id";
        $result = mysqli_query($connection, $sql);

        $count = mysqli_num_rows($result);
        $verno = 0;

        while ($questions = mysqli_fetch_array($result)) {
            $answer_name = "answer_" . $questions["id"];

            if (isset($_POST[$answer_name])) {
                if ($questions["correct"] == $_POST[$answer_name]) {
                    $verno++;
                }
            }
        }
        
        // процент
        if ($count > 0) {
            $itog = round(($verno * 100) / $count, 0);
        }
        else {
            $itog = 0;
        }
        
        // сохранение результатов тестирования
        if (isset($_SESSION["login"])) {

            $login = $_SESSION["login"];
            $date = date("Y-m-d H:i:s");
        
            $sql = "INSERT INTO results (login, article_id, total, correct, percent, date)
                    VALUES ('$login', '$id', '$count', '$verno', '$itog', '$date')";
        
            mysqli_query($connection, $sql);
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="description" content="<?php echo $article["metadescription"]?>">
        <meta name="keywords" content="<?php echo $article["metadescription"]?>">
        <meta http-equiv="content-type" content="text/html; charset=windows-1251" />
        <title>Результаты знаний. Тема: <?php echo $article["title"]?></title>
        <link href="style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <table width="800" border="1" align="center" cellpadding="0" cellspacing="0" class="table-border">
            <tr>
                <td>
                    <!-- В этом месте будет шапка сайта: название сайта и ФИО разработчика -->
                    <img src="images/header.png" />
                </td>
            </tr>
            <tr>
                <td>
                    <!-- <?php echo "<p> Протестируем стили</p>" ?> -->

                    <table width="900" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="180" valign="top" class="left-column">
                                <!-- здесь будет меню -->
                                <?php include("menu.php");?>
                            </td>
                            <td width="720" valign="top">
                                <!-- здесь будет контент -->
                                
                                <h1>
                                    <?php if (isset($login)) echo $login . ", "; ?>
                                    ваши результаты
                                </h1>

                                <h2>Тема: "<?php echo $article["title"]?>"</h2>

                                <p>Количество вопросов: <b><?php echo $count; ?></b></p>
                                <p>Верных ответов: <b><?php echo $verno; ?></b></p>
                                <p>Результат: <b><?php echo $itog; ?>%</b></p>
                        
                                <!-- конец контента -->
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <!-- В этом месте будет подвал сайта: информация о правах на копирование, email разработчика -->
                    <img src="images/footer.png" />
                </td>
            </tr>
        </table>
    </body>
</html>
