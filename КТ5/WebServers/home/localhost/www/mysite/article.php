<?php include("db_connect.php");
    if (isset($_REQUEST["id"])) {
        $id = intval($_REQUEST["id"]);
        $sql = "SELECT * FROM articles WHERE id=$id";
        $result = mysqli_query($connection, $sql);
        $myrow = mysqli_fetch_array($result);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="description" content="<?php echo $myrow["metadescription"]?>">
        <meta name="keywords" content="<?php echo $myrow["metadescription"]?>">
        <meta http-equiv="content-type" content="text/html; charset=windows-1251" />
        <title><?php echo $myrow["title"]?></title>
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
                                
                                <h1><?php echo $myrow["title"]?></h1>
                                <p>Дата создания:<br><b><?php echo $myrow ["date_created"]?></b></p>
                                <p>Автор:<br><b><?php echo $myrow ["author"]?></b></p>
                                <p><?php echo $myrow ["text"]?></p>
                                <p><a href="questions.php?id=<?php echo $myrow["id"]?>">Перейти к вопросам</a></p>

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
