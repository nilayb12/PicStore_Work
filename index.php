<?php session_start();
include_once ('modules/dbConfig.php');

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: Login/");
    exit;
}
$isAdmin = $_SESSION['isAdmin'] == 0 ? 'd-none' : '';

// $query = "SELECT * FROM circle";
// $result = mysqli_query($db, $query);

// while ($data = mysqli_fetch_assoc($result)) {
//     if (!file_exists($data['CircleCode'])) {
//         @mkdir('images/' . $data['CircleCode'], 0777, true);

//         $circle = $data["CircleCode"];
//         $query2 = "SELECT DISTINCT SUBSTRING(SAP_ID, 6, 4) AS City FROM 5g_data_30k WHERE CircleCode = ('$circle')";
//         $result2 = mysqli_query($db, $query2);

//         while ($data2 = mysqli_fetch_assoc($result2)) {
//             if (!file_exists($data2['City'])) {
//                 @mkdir('images/' . $circle . '/' . $data2['City'], 0777, true);

//                 $city = $data2["city"];
//                 $query3 = "WITH temp AS (SELECT DISTINCT SUBSTRING(SAP_ID, 6, 4) AS City, SAP_ID FROM 5g_data_30k) SELECT DISTINCT SAP_ID FROM temp WHERE City = ('$city')";
//                 $result3 = mysqli_query($db, $query3);

//                 while ($data3 = mysqli_fetch_assoc($result3)) {
//                     if (!file_exists($data3['SAP_ID'])) {
//                         @mkdir('images/' . $circle . '/' . $city . '/' . $data3['SAP_ID'], 0777, true);
//                     }
//                 }
//             }
//         }
//     }
// }
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

<head>
    <link rel="icon" type="image/png" sizes="96x96" href="https://img.icons8.com/dusk/64/000000/upload--v1.png">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css"> -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.css"
        integrity="sha512-za6IYQz7tR0pzniM/EAkgjV1gf1kWMlVJHBHavKIvsNoUMKWU99ZHzvL6lIobjiE2yKDAKMDSSmcMAxoiWgoWA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Image DB</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/js/all.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.js"
        integrity="sha512-EC3CQ+2OkM+ZKsM1dbFAB6OGEPKRxi6EDRnZW9ys8LghQRAq6cXPUgXCCujmDrXdodGXX9bqaaCRtwj4h4wgSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="JS/colorToggle.js"></script>
    <script src="JS/bootstrap-select(v1.14.0-gamma1).js"></script>
    <?php include ('modules/confirmModal.php');
    include ('modules/colorToggle.php'); ?>

    <div class="sticky-top bg-secondary-subtle border-bottom border-secondary">
        <nav class="navbar navbar-expand-md" style="z-index: 1002;">
            <div class="container-fluid">
                <a class="navbar-brand" href="">
                    <img id="brand-logo"
                        src="https://upload.wikimedia.org/wikipedia/commons/b/bf/Reliance_Jio_Logo.svg">
                    <!img id="app-logo" src="Image DB-logos_white_Edit.png">Image DB
                </a>
                <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <select class="dropdown selectpicker show-tick ms-4 me-1" data-width="fit" title="Select Circle"
                        data-show-subtext="true" data-live-search="true" data-live-search-placeholder="🔎" data-size="5"
                        data-style="btn-outline-primary text-body-emphasis" data-icon-base="bi"
                        data-tick-icon="bi-check-lg" data-hide-disabled="true" id="circleSelect">
                        <option data-divider="true"></option>
                        <option data-subtext="<Select Circle>" selected></option>
                        <?php
                        $query = "SELECT * FROM circle";
                        $result = mysqli_query($db, $query);

                        while ($data = mysqli_fetch_assoc($result)) {
                            // $sel = $data['CircleCode'] == $_SESSION['circle'] ? '' : 'disabled';
                            echo '<option data-subtext="' . $data['CircleName'] . '"' . $sel . '>' . $data['CircleCode'] . '</option>';
                        }
                        ?>
                    </select>
                    <!-- <ul class="navbar-nav mb-1 mb-lg-0">
                        <li class="nav-item"></li>
                    </ul> -->
                    <?php include ('modules/selectCity.php');
                    include ('modules/selectSector.php') ?>
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-expand-md" style="z-index: 1000;">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form class="me-1" id="uploadForm" method="post" action="" enctype="multipart/form-data"
                        style="width: auto;">
                        <input type="hidden" name="pathVal" id="pathVal" />
                        <fieldset class="input-group <?php echo $isAdmin; ?>" id="uploadGrp" disabled>
                            <input class="form-control" type="file" name="uploadFile[]" accept="image/*" multiple
                                title="Select Images" />
                            <button class="btn btn-outline-primary" name="uploadBtn" title="Upload">
                                <i class="bi bi-upload"></i></button>
                        </fieldset>
                        <?php include ('modules/dbUpload.php'); ?>
                    </form>
                    <ul class="navbar-nav mb-1 mb-lg-0">
                        <li class="nav-item"></li>
                    </ul>
                    <div class="!btn-group d-flex <?php echo $isAdmin; ?>">
                        <button class="btn btn-outline-primary text-nowrap" data-bs-toggle="button" id="chkboxToggle"
                            title="Multi-Select Toggle (Click for More Options)"><i class="bi bi-ui-checks-grid"></i>
                            <i class="bi bi-box-arrow-right"></i></button>
                        <button class="btn btn-outline-success ms-1 me-1" id="selectAll" title="(De)Select All"
                            style="display: none;"><i class="bi bi-check-square-fill"></i></button>
                        <button class="btn btn-outline-danger text-nowrap" data-bs-toggle="modal"
                            data-bs-target="#delModal" id="deleteBtnLink" title="Delete Selected"
                            style="display: none;">
                            <i class="bi bi-trash-fill"></i><i class="bi bi-ui-checks"></i></button>
                    </div>
                    <ul class="navbar-nav mb-1 mb-lg-0 ms-1 me-auto">
                        <li class="nav-item"></li>
                    </ul>
                    <form class="input-group me-1" role="search" style="width: auto;">
                        <input class="form-control" type="search" id="searchBox" placeholder="Ctrl/Cmd + K"
                            aria-label="Search" />
                        <label class="input-group-text" title="Global Search"><i class="bi bi-search"></i></label>
                        <!-- <button class="btn btn-outline-info" title="Search" disabled><i class="bi bi-search"></i></button> -->
                        <?php include ('modules/dbSearch.php'); ?>
                    </form>
                    <ul class="navbar-nav mb-1 mb-lg-0">
                        <li class="nav-item"></li>
                    </ul>
                    <a class="btn btn-outline-danger text-nowrap" id="logout" title="Logout" href="Login/logout.php">
                        <!-- <i class="bi bi-door-open-fill"></i> -->
                        Sign Out</a>
                </div>
            </div>
        </nav>
    </div>

    <div id="imgContainer" style="min-height: 68vh;">
        <?php include ('modules/imgContainer.php'); ?>
    </div>

    <nav class="navbar bg-secondary-subtle border-top border-secondary !justify-content-center"
        aria-label="Page Navigation" comment="z-index: 1001;">
        <!-- <ul class="pagination">
            <li class="page-item" title="First"><a class="page-link" href="#"><i class="bi bi-chevron-bar-left"></i></a>
            </li>
            <li class="page-item" title="Previous"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a>
            </li>
            <li class="page-item"><a class="page-link" href="#">x</a></li>
            <li class="page-item" title="Next"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a>
            </li>
            <li class="page-item" title="Last"><a class="page-link" href="#"><i class="bi bi-chevron-bar-right"></i></a>
            </li>
        </ul> -->
        <p class="alert alert-primary">Showing <span id="imgCount">x</span> Images</p>
    </nav>
    <script src="JS/script.js"></script>
</body>

</html>