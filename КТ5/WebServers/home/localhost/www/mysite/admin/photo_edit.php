<?php include("db_connect.php")?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=windows-1251" />
    <title>Редактирование фото</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>

<table width="800" border="1" align="center" cellpadding="0" cellspacing="0" class="table-border">

    <tr>
        <td>
            <img src="images/header.png" />
        </td>
    </tr>

    <tr>
        <td>
            <table width="900" border="0" cellpadding="0" cellspacing="0">
                <tr>

                    <td width="180" valign="top" class="left-column">
                        <?php include("menu.php");?>
                    </td>

                    <td width="720" valign="top">
                        <!-- здесь будет контент -->

                        <h2>Редактирование фото</h2>

                        <form action="photo_handler.php?task=save&id=<?php echo $myrow["id"] ?? 0; ?>"
                              method="post"
                              enctype="multipart/form-data">

                            <table class="big-table">

                                <tr>
                                    <td>Название</td>
                                    <td>
                                        <input type="text" name="name"
                                               value="<?php echo $myrow["name"] ?? ""; ?>">
                                    </td>
                                </tr>

                                <tr>
                                    <td>Файл</td>
                                    <td>

                                        <?php if (!empty($myrow["filename"])) { ?>
                                            <img src="../photos/<?php echo $myrow["filename"]; ?>" width="150"><br>
                                        <?php } ?>

                                        <input type="file" name="myfile">
                                    </td>
                                </tr>

                                <tr>
                                    <td>Опубликовано</td>
                                    <td>
                                        <label>
                                            <input type="radio" name="published" value="1"
                                            <?php if (!empty($myrow["published"])) echo "checked"; ?>> Да
                                        </label>

                                        <label>
                                            <input type="radio" name="published" value="0"
                                            <?php if (empty($myrow["published"])) echo "checked"; ?>> Нет
                                        </label>
                                    </td>
                                </tr>

                            </table>

                            <p><input type="submit" value="Сохранить"></p>

                        </form>

                        <!-- конец контента -->
                    </td>

                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td>
            <img src="images/footer.png" />
        </td>
    </tr>

</table>

</body>
</html>
