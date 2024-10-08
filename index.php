<?php session_start();
include_once('modules/dbConfig.php');

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: Login/");
    exit;
}
$isAdmin = $_SESSION['isAdmin'] == 0 ? 'd-none' : '';
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
    <?php include('modules/confirmModal.php');
    include('modules/colorToggle.php'); ?>

    <div class="sticky-top bg-secondary-subtle border-bottom border-secondary">
        <nav class="navbar navbar-expand-md py-1 z-2">
            <div class="container-fluid" id="navHead">
                <button class="navbar-toggler me-sm-3 me-md-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <ul class="navbar-nav flex-row mb-1 mb-lg-0 me-auto">
                    <li class="nav-item me-sm-3 me-md-2">
                        <a class="nav-link" href=""><i class="bi bi-house-fill"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="modal" data-bs-target="#aboutModal">About</button>
                    </li>
                </ul>
                <a class="navbar-brand" href="">
                    <img id="brand-logo" src="Reliance_Jio_Logo.svg"> SAPID Image Hosting
                </a>
                <ul class="navbar-nav mb-1 mb-lg-0 me-auto">
                    <li class="nav-item"></li>
                </ul>
                <div class="dropdown">
                    <button class="btn btn-sm btn-secondary text-nowrap rounded-pill" data-bs-toggle="dropdown">
                        <i class="bi bi-person-fill"></i> <?php echo $_SESSION['username']; ?>
                        <i class="bi bi-caret-down-fill ms-2"></i></button>
                    <ul class="dropdown-menu dropdown-menu-md-end">
                        <li><a class="btn btn-outline-danger dropdown-item" id="logout" href="Login/logout.php"
                                onclick="sessionStorage.clear();">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path fill="currentColor"
                                        d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z" />
                                </svg> Sign Out
                            </a></li>
                    </ul>
                </div>
                <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent"></div> -->
            </div>
        </nav>
        <nav class="navbar navbar-expand-md py-1 z-1">
            <div class="container-fluid">
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
                    </div>
                    <span class="vr ms-md-4 me-md-2"></span> -->
                    <ul class="list-group text-nowrap shadow" id="SAPSelectionType">
                        <li class="list-group-item">
                            <input class="form-check-input" type="radio" name="SAPOpt" id="SAPOpt1" />
                            <label class="stretched-link" for="SAPOpt1">
                                <small>Select SAPID from List</small></label>
                            <script type="text/javascript">
                                var runOnce;
                                $('#SAPOpt1').click(function () {
                                    $('#circleSelect, #citySelect, #sectorSelect').selectpicker('show');
                                    $('#searchSAPForm').addClass('d-none');
                                    $('#showGrp').addClass('align-self-start').removeClass('align-self-end');
                                    $('.bi-chevron-right').removeClass('d-none');
                                    if ('<?php echo $_SESSION['circle']; ?>' != 'NHQ' && $('#circleSelect').val() != '<?php echo $_SESSION['circle']; ?>' && !runOnce) {
                                        runOnce = true;
                                        $('#circleSelect').selectpicker('val', '<?php echo $_SESSION['circle']; ?>');
                                    }
                                });
                            </script>
                        </li>
                        <li class="list-group-item">
                            <input class="form-check-input" type="radio" name="SAPOpt" id="SAPOpt2"
                                onclick="$('#circleSelect, #citySelect, #sectorSelect').selectpicker('hide'); $('#searchSAPForm').removeClass('d-none'); $('#showGrp').addClass('align-self-end').removeClass('align-self-start'); $('.bi-chevron-right').addClass('d-none');" />
                            <label class="stretched-link" for="SAPOpt2"><small>Search SAP/Site ID</small></label>
                        </li>
                    </ul>
                    <ul class="navbar-nav mb-1 mb-lg-0 me-1">
                        <li class="nav-item"></li>
                    </ul>
                    <select class="dropdown selectpicker show-tick align-self-start !me-1" data-width="fit"
                        title="Select Circle" data-show-subtext="true" data-live-search="true"
                        data-live-search-placeholder="🔎" data-size="5"
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
                    </select><i class="bi bi-chevron-right align-self-start mx-1 mt-1 d-none"></i>
                    <?php include('modules/selectCity.php');
                    include('modules/selectSector.php') ?>
                    <ul class="navbar-nav mb-1 mb-lg-0">
                        <li class="nav-item"></li>
                    </ul>
                    <form class="w-auto align-self-end d-none" id="searchSAPForm" role="search">
                        <fieldset class="input-group input-group-sm" id="searchSAPGrp">
                            <!-- <code class="input-group-text">I-</code> -->
                            <input class="form-control" id="searchSAP" type="search" minlength="6"
                                placeholder="I-Circle-City-Sector" aria-label="Search" />
                            <label class="input-group-text" data-bs-toggle="tooltip"
                                title="Click on a Search Result to Show Images.">
                                <i class="bi bi-info-circle"></i></label>
                        </fieldset>
                        <ul class="dropdown-menu overflow-auto shadow" id="searchRes" style="max-height: 14rem;">
                        </ul>
                        <!-- <!?php include ('modules/dbSearchSAP.php'); ?> -->
                    </form>
                    <ul class="navbar-nav mb-1 mb-lg-0 me-2">
                        <li class="nav-item"></li>
                    </ul>
                    <div class="btn-group btn-group-sm text-nowrap d-none" id="showGrp">
                        <button class="btn btn-success rounded-pill" id="showImg" data-bs-toggle="tooltip"
                            title="Show Images" disabled>
                            <div class="spinner-border spinner-border-sm align-self-center me-1 d-none" id="spinner"
                                role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <i class="bi bi-images me-1"></i> Show
                        </button>
                        <!-- <span class="vr"></span> -->
                        <!-- <button class="btn btn-success rounded-end-pill" id="showInfo" data-bs-toggle="modal"
                            data-bs-target="#SAPInfoModal" title="Show Site Info" disabled>
                            <i class="bi bi-info-circle-fill me-1"></i>
                        </button> -->
                    </div>
                    <ul class="navbar-nav mb-1 mb-lg-0 ms-1 me-auto">
                        <li class="nav-item"></li>
                    </ul>
                    <form class="input-group input-group-sm w-auto align-self-end shadow" role="search">
                        <input class="form-control" type="search" id="imgSearch" placeholder="Search Images (Ctrl + K)"
                            aria-label="Search" />
                        <label class="input-group-text" data-bs-toggle="tooltip" title="Search Displayed Images">
                            <!-- <i class="bi bi-search"></i> -->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="1.35rem" viewBox="0 0 27 27" height="1.35rem" preserveAspectRatio="xMidYMid meet"
                                style="margin-top: -.15rem;" version="1.0">
                                <defs>
                                    <clipPath id="id1">
                                        <path
                                            d="M 3.386719 2.902344 L 26.613281 2.902344 L 26.613281 26.121094 L 3.386719 26.121094 Z M 3.386719 2.902344 "
                                            clip-rule="nonzero" />
                                    </clipPath>
                                </defs>
                                <g clip-path="url(#id1)">
                                    <path fill="currentColor"
                                        d="M 19.0625 11.03125 C 17.460938 11.03125 16.160156 9.726562 16.160156 8.125 C 16.160156 6.523438 17.460938 5.222656 19.0625 5.222656 C 20.664062 5.222656 21.964844 6.523438 21.964844 8.125 C 21.964844 9.726562 20.664062 11.03125 19.0625 11.03125 Z M 23.476562 10.902344 C 24.03125 10.007812 24.347656 8.960938 24.277344 7.8125 C 24.125 5.316406 22.140625 3.203125 19.667969 2.9375 C 16.507812 2.585938 13.835938 5.039062 13.835938 8.125 C 13.835938 11.015625 16.171875 13.351562 19.050781 13.351562 C 20.074219 13.351562 21.023438 13.046875 21.824219 12.539062 L 24.625 15.335938 C 25.078125 15.789062 25.820312 15.789062 26.273438 15.335938 C 26.726562 14.882812 26.726562 14.140625 26.273438 13.6875 Z M 19.0625 21.480469 L 8.632812 21.480469 C 8.148438 21.480469 7.878906 20.921875 8.183594 20.539062 L 10.203125 17.949219 C 10.433594 17.660156 10.875 17.644531 11.109375 17.9375 L 12.917969 20.121094 L 15.648438 16.613281 C 15.878906 16.3125 16.34375 16.3125 16.566406 16.625 L 19.527344 20.5625 C 19.816406 20.933594 19.539062 21.480469 19.0625 21.480469 Z M 21.964844 17.996094 L 21.964844 22.640625 C 21.964844 23.28125 21.445312 23.800781 20.804688 23.800781 L 6.871094 23.800781 C 6.234375 23.800781 5.707031 23.28125 5.707031 22.640625 L 5.707031 8.707031 C 5.707031 8.070312 6.234375 7.542969 6.871094 7.542969 L 10.378906 7.542969 C 11.015625 7.542969 11.539062 7.023438 11.539062 6.382812 C 11.539062 5.746094 11.015625 5.222656 10.378906 5.222656 L 5.707031 5.222656 C 4.433594 5.222656 3.386719 6.269531 3.386719 7.542969 L 3.386719 23.800781 C 3.386719 25.078125 4.433594 26.121094 5.707031 26.121094 L 21.964844 26.121094 C 23.242188 26.121094 24.285156 25.078125 24.285156 23.800781 L 24.285156 17.996094 C 24.285156 17.359375 23.765625 16.832031 23.125 16.832031 C 22.488281 16.832031 21.964844 17.359375 21.964844 17.996094 "
                                        fill-opacity="1" fill-rule="nonzero" />
                                </g>
                            </svg>
                        </label>
                    </form>
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-expand-md py-1 z-0 <?php echo $isAdmin; ?>">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form class="!w-auto" id="uploadForm" method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="pathVal" id="pathVal" />
                        <div class="collapse collapse-horizontal me-1" id="uploadCollapse">
                            <fieldset class="input-group input-group-sm" id="uploadGrp" disabled style="width: 25rem;">
                                <label class="btn btn-outline-primary text-body-emphasis" for="uploadFile">
                                    Select Images</label>
                                <input class="form-control" type="file" name="uploadFile[]" id="uploadFile"
                                    accept="image/*" multiple !data-bs-toggle="tooltip" title="Select Images" />
                                <button class="btn btn-info" name="uploadBtn" data-bs-toggle="tooltip" title="Upload">
                                    <i class="bi bi-upload"></i></button>
                            </fieldset>
                        </div>
                        <?php include('modules/dbUpload.php'); ?>
                    </form>
                    <ul class="navbar-nav mb-1 mb-lg-0 !me-1">
                        <li class="nav-item"></li>
                    </ul>
                    <div class="!btn-group d-flex">
                        <span data-bs-toggle="tooltip" xdata-bs-html="true"
                            title="Show/Hide Image Upload & other Options.">
                            <button class="btn btn-sm btn-outline-primary text-nowrap" id="chkboxToggle"
                                data-bs-toggle="collapse" data-bs-target="#uploadCollapse"
                                aria-controls="uploadCollapse">
                                <i class="bi bi-ui-checks-grid"></i> <i class="↔ bi bi-box-arrow-right"></i>
                            </button></span>
                        <button class="btn btn-sm btn-outline-success mx-1" id="selectAll" data-bs-toggle="tooltip"
                            title="(De)Select All" style="display: none;">
                            <i class="bi bi-check-square-fill"></i></button>
                        <span data-bs-toggle="tooltip" title="Delete Selected">
                            <button class="btn btn-sm btn-outline-danger text-nowrap" data-bs-toggle="modal"
                                data-bs-target="#delModal" id="deleteBtnLink" style="display: none;">
                                <i class="bi bi-trash-fill"></i><i class="bi bi-ui-checks"></i>
                            </button></span>
                    </div>
                    <ul class="navbar-nav mb-1 mb-lg-0 ms-1 me-auto">
                        <li class="nav-item"></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div id="imgContainer">
        <?php include('modules/imgContainer.php'); ?>
    </div>

    <p class="alert alert-info p-1 position-fixed bottom-0 start-0 mb-1 ms-1">
        Showing <span id="imgCount">x</span> <span id="imgCntTxt">y</span></p>
    <button class="btn btn-info icon-link icon-link-hover position-fixed bottom-0 end-0 mb-1 rounded-pill d-none"
        id="gotoTop" data-bs-toggle="tooltip" title="Back to Top"
        style="margin-right: 4rem; --bs-icon-link-transform: translate3d(0, -.5rem, 0);">
        <i class="bi bi-arrow-up"></i></button>
    <script src="JS/script.js"></script>
</body>

</html>