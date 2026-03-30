<?php include("db_connect.php")?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=windows-1251" />
        <title>Фото галерея</title>
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
                                
                                <h1>Фото галерея</h1>

                                <?php
                                    $sql = "SELECT * FROM photos WHERE published = 1";
                                    $result = mysqli_query($connection, $sql);

                                    while ($myrow = mysqli_fetch_array($result)) {
                                ?>

                                    <table width="100%" class="article">
                                        <tr>
                                            <td>
                                                <img src="photos/<?php echo $myrow["filename"]; ?>"
                                                    alt="<?php echo $myrow["name"]; ?>"
                                                    width="100%">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><?php echo $myrow["name"]; ?></p>
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
