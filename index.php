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
//         $query2 = "SELECT * FROM city WHERE CircleCode = ('$circle')";
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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link href="Bootstrap/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->
    <link rel="stylesheet" href="Bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css">
    <!-- <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css"> -->
    <link rel="stylesheet" href="Bootstrap/bootstrap-select-1.14.0-beta3-dist/css/bootstrap-select.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.css"
        integrity="sha512-za6IYQz7tR0pzniM/EAkgjV1gf1kWMlVJHBHavKIvsNoUMKWU99ZHzvL6lIobjiE2yKDAKMDSSmcMAxoiWgoWA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="ViewerJS/viewer.min.css">
    <title>Image DB</title>
</head>

<body>
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->
    <script src="JS/jquery-3.7.1.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script> -->
    <script src="Bootstrap/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script> -->
    <script src="JS/bootstrap-select(v1.14.0-gamma1).js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.js"
        integrity="sha512-EC3CQ+2OkM+ZKsM1dbFAB6OGEPKRxi6EDRnZW9ys8LghQRAq6cXPUgXCCujmDrXdodGXX9bqaaCRtwj4h4wgSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="ViewerJS/viewer.min.js"></script>
    <script src="JS/colorToggle.js"></script>
    <?php include ('modules/confirmModal.php');
    include ('modules/colorToggle.php'); ?>

    <div class="sticky-top bg-secondary-subtle border-bottom border-secondary">
        <nav class="navbar navbar-expand-md z-1">
            <div class="container-fluid">
                <a class="navbar-brand" href="">
                    <img id="brand-logo" src="Reliance_Jio_Logo.svg"> Image DB
                </a>
                <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- <div class="dropdown ms-4">
                        <button class="btn btn-primary text-nowrap" id="SAPSelection" data-bs-toggle="dropdown">
                            Select SAP/Site ID <i class="bi bi-caret-down-fill"></i>
                        </button>
                        <ul class="dropdown-menu" id="SAPSelectionType">
                            <li><button class="dropdown-item btn btn-outline-primary"
                                    onclick="$('#circleSelect, #citySelect, #sectorSelect').selectpicker('show'); $('#searchSAP').addClass('d-none');">
                                    From Dropdowns</button></li>
                            <li><button class="dropdown-item btn btn-outline-primary"
                                    onclick="$('#circleSelect, #citySelect, #sectorSelect').selectpicker('hide'); $('#searchSAP').removeClass('d-none');">
                                    Search Directly</button></li>
                        </ul>
                    </div> -->
                    <span class="vr ms-md-4 me-md-2"></span>
                    <ul class="list-group text-nowrap" id="SAPSelectionType">
                        <li class="list-group-item">
                            <input class="form-check-input" type="radio" name="SAPOpt" id="SAPOpt1"
                                onclick="$('#circleSelect, #citySelect, #sectorSelect').selectpicker('show'); $('#searchSAP').addClass('d-none');" />
                            <label class="stretched-link" for="SAPOpt1">
                                <small>Select SAPID from Dropdown</small></label>
                        </li>
                        <li class="list-group-item">
                            <input class="form-check-input" type="radio" name="SAPOpt" id="SAPOpt2"
                                onclick="$('#circleSelect, #citySelect, #sectorSelect').selectpicker('hide'); $('#searchSAP').removeClass('d-none');" />
                            <label class="stretched-link" for="SAPOpt2"><small>Search SAP/Site ID</small></label>
                        </li>
                    </ul>
                    <ul class="navbar-nav mb-1 mb-lg-0 me-1">
                        <li class="nav-item"></li>
                    </ul>
                    <select class="dropdown selectpicker show-tick me-1" data-width="fit" title="Select Circle"
                        data-show-subtext="true" data-live-search="true" data-live-search-placeholder="🔎" data-size="5"
                        data-style="btn-sm btn-outline-primary text-body-emphasis" data-icon-base="bi"
                        data-tick-icon="bi-check-lg" data-hide-disabled="true" id="circleSelect">
                        <option data-divider="true"></option>
                        <option data-subtext="<Select Circle>" selected></option>
                        <?php
                        $query = "SELECT * FROM circle";
                        $result = mysqli_query($db, $query);
                        $sel = '';

                        while ($data = mysqli_fetch_assoc($result)) {
                            if ($_SESSION['circle'] != 'NHQ') {
                                $sel = $data['CircleCode'] == $_SESSION['circle'] ? '' : 'disabled';
                            }
                            echo '<option data-subtext="' . $data['CircleCode'] . '" value="' . $data['CircleCode'] . '" ' . $sel . '>' . $data['CircleName'] . '</option>';
                        }
                        ?>
                    </select>
                    <?php include ('modules/selectCity.php');
                    include ('modules/selectSector.php') ?>
                    <ul class="navbar-nav mb-1 mb-lg-0">
                        <li class="nav-item"></li>
                    </ul>
                    <form class="w-auto d-none" id="searchSAP" role="search">
                        <fieldset class="input-group input-group-sm">
                            <code class="input-group-text">I-</code>
                            <input class="form-control" type="search" minlength="4" placeholder="Circle-City-Sector"
                                aria-label="Search" />
                            <label class="input-group-text" data-bs-toggle="tooltip" title="Search SAP/Site ID">
                                <i class="bi bi-search"></i></label>
                        </fieldset>
                        <ul class="dropdown-menu overflow-auto" id="searchRes"
                            style="max-height: 14rem; margin-left: 2.7rem;">
                        </ul>
                        <!-- <!?php include ('modules/dbSearchSAP.php'); ?> -->
                    </form>
                    <ul class="navbar-nav mb-1 mb-lg-0 me-1">
                        <li class="nav-item"></li>
                    </ul>
                    <button class="btn btn-sm btn-success text-nowrap d-none" id="showImg" disabled>
                        <i class="bi bi-images"></i> Show</button>
                    <ul class="navbar-nav mb-1 mb-lg-0 ms-1 me-auto">
                        <li class="nav-item"></li>
                    </ul>
                    <div class="dropdown">
                        <button class="btn btn-secondary text-nowrap" data-bs-toggle="dropdown">
                            <i class="bi bi-person-fill"></i> <?php echo $_SESSION['username']; ?> <i
                                class="bi bi-caret-down-fill"></i></button>
                        <ul class="dropdown-menu">
                            <li><a class="btn btn-outline-danger dropdown-item" id="logout" href="Login/logout.php">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path fill="currentColor"
                                            d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                                    </svg> Sign Out
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-expand-md">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form class="w-auto" id="uploadForm" method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="pathVal" id="pathVal" />
                        <fieldset class="input-group <?php echo $isAdmin; ?>" id="uploadGrp" disabled>
                            <input class="form-control" type="file" name="uploadFile[]" accept="image/*" multiple
                                data-bs-toggle="tooltip" title="Select Images" />
                            <button class="btn btn-primary z-0" name="uploadBtn" data-bs-toggle="tooltip"
                                title="Upload"><i class="bi bi-upload"></i></button>
                        </fieldset>
                        <?php include ('modules/dbUpload.php'); ?>
                    </form>
                    <ul class="navbar-nav mb-1 mb-lg-0 me-1">
                        <li class="nav-item"></li>
                    </ul>
                    <div class="!btn-group d-flex <?php echo $isAdmin; ?>">
                        <button class="btn btn-outline-primary text-nowrap" data-bs-toggle="button" id="chkboxToggle">
                            <span data-bs-toggle="tooltip"
                                title="Multi-Select Toggle (Click to Show/Hide More Options)">
                                <i class="bi bi-ui-checks-grid"></i> <i class="↔ bi bi-box-arrow-right"></i>
                            </span></button>
                        <button class="btn btn-outline-success mx-1" id="selectAll" data-bs-toggle="tooltip"
                            title="(De)Select All" style="display: none;">
                            <i class="bi bi-check-square-fill"></i></button>
                        <button class="btn btn-outline-danger text-nowrap" data-bs-toggle="modal"
                            data-bs-target="#delModal" id="deleteBtnLink" style="display: none;">
                            <span data-bs-toggle="tooltip" title="Delete Selected">
                                <i class="bi bi-trash-fill"></i><i class="bi bi-ui-checks"></i>
                            </span></button>
                    </div>
                    <ul class="navbar-nav mb-1 mb-lg-0 ms-1 me-auto">
                        <li class="nav-item"></li>
                    </ul>
                    <form class="input-group w-auto" role="search">
                        <input class="form-control" type="search" id="searchBox" placeholder="Ctrl/⌘ + K"
                            aria-label="Search" />
                        <label class="input-group-text" data-bs-toggle="tooltip"
                            title="Instantly Search Images on Page">
                            <i class="bi bi-search"></i></label>
                        <!-- <button class="btn btn-outline-info" title="Search" disabled><i class="bi bi-search"></i></button> -->
                    </form>
                </div>
            </div>
        </nav>
    </div>

    <div id="imgContainer">
        <?php include ('modules/imgContainer.php'); ?>
    </div>

    <!-- <nav class="navbar bg-secondary-subtle border-top border-secondary !justify-content-center"
        aria-label="Page Navigation" comment="z-index: 1001;">
        <ul class="pagination">
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
    <p class="alert alert-info p-2 position-fixed bottom-0 start-0 mb-1 ms-1">
        Showing <span id="imgCount">x</span> Image(s)</p>
    <!-- </nav> -->
    <script src="JS/script.js"></script>
</body>

</html>