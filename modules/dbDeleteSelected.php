<?php
include_once ('dbConfig.php');

if (isset($_POST['deleteBtn'])) {
    $sessUser = $_SESSION["username"];
    if (!empty($_POST['imgSelect'])) {
        foreach ($_POST['imgSelect'] as $fileName) {
            $sql = "DELETE FROM image WHERE UserName IN ('$sessUser') AND FileName IN ('$fileName')";
            mysqli_query($db, $sql);
            unlink('./images/' . $sessUser . '/' . $fileName);
        }
    } else {
        echo '';
    }
}
?>