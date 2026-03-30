<?php include("db_connect.php");
    if (isset($_REQUEST["id"])) {
        $id = intval($_REQUEST["id"]);
        $sql = "SELECT * FROM articles WHERE id=$id";
        $result = mysqli_query($connection, $sql);
        $article = mysqli_fetch_array($result);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="description" content="<?php echo $article["metadescription"]?>">
        <meta name="keywords" content="<?php echo $article["metadescription"]?>">
        <meta http-equiv="content-type" content="text/html; charset=windows-1251" />
        <title>Вопросы для проверки знаний. Тема: <?php echo $article["title"]?></title>
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
                                
                                <h1>Вопросы для проверки знаний</h1>
                                <h2>Тема: "<?php echo $article["title"]?>"</h2>

                                <form action="check_answers.php" method="post">

                                <?php
                                    // выбираем вопросы по статье
                                    $sql = "SELECT * FROM questions WHERE article_id = $id";
                                    $result = mysqli_query($connection, $sql);

                                    while ($questions = mysqli_fetch_array($result)) {
                                        // разбиваем ответы
                                        $answers = explode("|", $questions["answers"]);
                                ?>

                                    <p><b><?php echo $questions["quest"]?></b></p>

                                    <?php foreach ($answers as $number => $answer) { ?>
                                        <p>
                                            <label>
                                                <input type="radio"
                                                    name="answer_<?php echo $questions["id"]; ?>"
                                                    value="<?php echo $number + 1; ?>">
                                                <?php echo $answer; ?>
                                            </label>
                                        </p>
                                    <?php } ?>

                                    <hr>

                                <?php } ?>

                                    <p><input type="submit" name="button" value="Отправить"></p>
                                    <input type="hidden" name="id" value="<?php echo $article["id"]?>">

                                </form>
                        
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
