<?php include("db_connect.php")?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=windows-1251" />
        <title>Название вашего сайта</title>
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
                                
                                <?php
                                    $sql = "SELECT * FROM articles";

                                    // $result = mysql_query($sql);
                                    // Fatal error: Uncaught Error: Call to undefined function mysql_query() in Z:\home\localhost\www\mysite\articles.php:32 Stack trace: #0 {main} thrown in Z:\home\localhost\www\mysite\articles.php on line 32

                                    $result = mysqli_query($connection, $sql);

                                    // while ($myrow = mysql_fetch_array($result)) {
                                    // Fatal error: Uncaught Error: Call to undefined function mysql_fetch_array() in Z:\home\localhost\www\mysite\articles.php:38 Stack trace: #0 {main} thrown in Z:\home\localhost\www\mysite\articles.php on line 38
                                    while ($myrow = mysqli_fetch_array($result)) {
                                ?>
                                    <table width="100%" class="article">
                                        <tr>
                                            <td width="250">
                                                <p><a href="article.php?id=<?php echo $myrow ["id"]?>"><?php echo $myrow["title"]?></a></p>
                                                <p>Дата создания:<br><b><?php echo $myrow ["date_created"]?></b></p>
                                                <p>Автор:<br><b><?php echo $myrow ["author"]?></b></p>
                                            </td>
                                            <td>
                                                <?php echo $myrow ["description"]?>
                                            </td>
                                        </tr>
                                    </table>
                                <?php } ?>

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
