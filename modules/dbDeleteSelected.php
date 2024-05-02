<?php
include_once ('dbConfig.php');

if (isset($_POST['deleteBtn'])) {
    if (!empty($_POST['imgSelect'])) {
        foreach ($_POST['imgSelect'] as $fileName) {
            $query = "SELECT * FROM image WHERE FileName IN ('$fileName')";
            $delQuery = "DELETE FROM image WHERE FileName IN ('$fileName')";
            $result = mysqli_query($db, $query);
            while ($data = mysqli_fetch_assoc($result)) {
                mysqli_query($db, $delQuery);
                unlink($data['FilePath'] . '/' . $data['FileName']);
            }
        }
    } else {
        echo '';
    }
}
?>