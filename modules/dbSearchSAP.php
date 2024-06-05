<?php include_once ('dbConfig.php');

if (isset($_REQUEST["term"])) {
    $sql = "SELECT DISTINCT SAP_ID FROM 5g_data WHERE SAP_ID LIKE ?";

    if ($stmt = mysqli_prepare($db, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        $param_term = $_REQUEST['term'] . '%';

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                while ($data = mysqli_fetch_assoc($result)) {
                    echo '<li class="list-group-item">' . $data['SAP_ID'] . '</li>';
                }
            } else {
                echo '<li class="list-group-item">No Match Found</li>';
            }
        } else {
            echo 'ERROR: Could not able to execute $sql. ' . mysqli_error($link);
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($db);
?>