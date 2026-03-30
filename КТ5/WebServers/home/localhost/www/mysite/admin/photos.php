<?php include("db_connect.php")?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=windows-1251" />
        <title>Фото галерея (админ)</title>
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
                                
                                <p><a href="photo_handler.php?task=new">Добавить изображение</a></p>

                                <table width="100%" class="big-table">
                                <tr>
                                    <td>ID</td>
                                    <td>Название</td>
                                    <td>Фото</td>
                                    <td>Дата</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <?php
                                $sql = "SELECT * FROM photos ORDER BY date_created DESC";
                                $result = mysqli_query($connection, $sql);

                                if (!$result) {
                                    die("Ошибка запроса: " . mysqli_error($connection));
                                }
                                
                                while ($myrow = mysqli_fetch_array($result)) {

                                    $link_delete = "photo_handler.php?task=delete&id=".$myrow["id"];

                                    $task = "publish";
                                    $img_published = "uncheck.png";

                                    if ($myrow["published"]) {
                                        $task = "unpublish";
                                        $img_published = "check.png";
                                    }

                                    $link_publish = "photo_handler.php?task=".$task."&id=".$myrow["id"];
                                    $link_edit = "photo_handler.php?task=edit&id=".$myrow["id"];
                                ?>
                                <tr>
                                    <td><?php echo $myrow["id"]; ?></td>
                                    <td><?php echo $myrow["name"]; ?></td>
                                    <td><img src="../photos/<?php echo $myrow["filename"]; ?>" width="150"></td>
                                    <td><?php echo $myrow["date_created"]; ?></td>

                                    <td>
                                        <a href="<?php echo $link_delete; ?>">
                                            <img src="images/delete.png" width="25">
                                        </a>
                                    </td>

                                    <td>
                                        <a href="<?php echo $link_publish; ?>">
                                            <img src="images/<?php echo $img_published; ?>" width="25">
                                        </a>
                                    </td>

                                    <td>
                                        <a href="<?php echo $link_edit; ?>">
                                            <img src="images/edit.png" width="25">
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>

                                </table>

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

