<?php
include("db_connect.php");

$task = $_GET["task"] ?? "";
$id = intval($_GET["id"] ?? 0);

switch ($task) {

    case "publish":
    case "unpublish":
        publishPhoto($task, $id);
        break;

    case "delete":
        deletePhoto($id);
        break;

    case "edit":
    case "new":
        editPhoto($id, $task);
        break;

    case "save":
        savePhoto($id);
        break;
}

// ------------------------

function publishPhoto($task, $id) {
    global $connection;

    $published = ($task == "publish") ? 1 : 0;

    mysqli_query($connection,
        "UPDATE photos SET published='$published' WHERE id='$id'"
    );

    header("Location: photos.php");
}

// ------------------------

function deletePhoto($id) {
    global $connection;

    removePhotoFromServer($id);

    mysqli_query($connection,
        "DELETE FROM photos WHERE id='$id'"
    );

    header("Location: photos.php");
}

// ------------------------

function removePhotoFromServer($id) {
    global $connection;

    $res = mysqli_query($connection,
        "SELECT filename FROM photos WHERE id='$id'"
    );

    $row = mysqli_fetch_array($res);
    $filename = $row["filename"];

    if ($filename && file_exists("../photos/".$filename)) {
        unlink("../photos/".$filename);
    }
}

// ------------------------

function editPhoto($id, $task) {
    global $connection;

    if ($task == "edit") {
        $res = mysqli_query($connection,
            "SELECT * FROM photos WHERE id='$id'"
        );
        $myrow = mysqli_fetch_array($res);
    }

    include("photo_edit.php");
}

// ------------------------

function savePhoto($id) {
    global $connection;

    $name = addslashes($_POST["name"]);
    $published = intval($_POST["published"]);
    $file = $_FILES["myfile"];

    if ($id) {
        mysqli_query($connection,
            "UPDATE photos SET name='$name', published='$published' WHERE id='$id'"
        );
    } else {
        mysqli_query($connection,
            "INSERT INTO photos (name, date_created, published)
             VALUES ('$name', NOW(), '$published')"
        );
        $id = mysqli_insert_id($connection);
    }

    uploadPhotoToServer($file, $id);

    header("Location: photos.php");
}

// ------------------------

function uploadPhotoToServer($file, $id) {
    global $connection;

    if ($file["name"]) {

        $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
        $allowed = ["jpg","png","gif","JPG","PNG","GIF"];

        if (in_array($ext, $allowed)) {

            move_uploaded_file(
                $file["tmp_name"],
                "../photos/".$file["name"]
            );

            removePhotoFromServer($id);

            mysqli_query($connection,
                "UPDATE photos SET filename='".$file["name"]."' WHERE id='$id'"
            );
        }
    }
}
?>
