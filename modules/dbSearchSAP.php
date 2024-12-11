<?php session_start();
include_once('dbConfig.php');

if (isset($_REQUEST['term'])) {
    $sql = "SELECT DISTINCT SAP_ID FROM 5g_data WHERE SAP_ID LIKE ?";

    if ($stmt = mysqli_prepare($db, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        $term = ($_SESSION['circle'] != 'NHQ' && strtolower(substr($_REQUEST['term'], 2, 2)) != strtolower($_SESSION['circle'])) ? 'Invalid' : $_REQUEST['term'];
        $param_term = $term . '%';

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                echo '<li class="dropdown-item disabled">' . mysqli_num_rows($result) . ' IDs</li>
                <li><hr class="dropdown-divider"></li>';
                while ($data = mysqli_fetch_assoc($result)) {
                    echo '<li><a class="btn dropdown-item">' . $data['SAP_ID'] . '</a></li>';
                }
            } else {
                echo '<li class="dropdown-item disabled">❌ No Matching IDs</li>';
            }
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($db);
?>