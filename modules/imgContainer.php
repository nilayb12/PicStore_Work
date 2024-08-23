<?php include_once ('dbConfig.php'); ?>

<form id="imgForm" method="post" action="">
    <button class="btn d-none" name="deleteBtn" id="deleteBtn"></button>
    <input type="hidden" name="pathVal1" id="pathVal1" />
    <?php include ('dbDeleteSelected.php');
    $path = @$_POST['pathVal1'];
    $query = "SELECT * FROM image WHERE FilePath = ('$path')";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) == 0) {
        echo '<div class="text-center">';
        if (empty($path)) { ?>
            <svg class="my-3" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="8rem" height="8rem">
                <circle cx="12" cy="12" r="12" fill="#0a2885"></circle>
                <path
                    d="M17.587 14.559c-.883 0-1.49-.648-1.49-1.574 0-.912.62-1.56 1.49-1.56s1.491.648 1.491 1.573c0 .897-.634 1.56-1.49 1.56zm.03-5.152c-2.265 0-3.772 1.437-3.772 3.576 0 2.195 1.451 3.604 3.729 3.604 2.264 0 3.755-1.409 3.755-3.59 0-2.153-1.475-3.59-3.713-3.59zM11.78 6.272c-.856 0-1.395.483-1.395 1.243 0 .774.552 1.257 1.435 1.257.857 0 1.395-.483 1.395-1.257 0-.773-.552-1.243-1.435-1.243zm.152 3.204h-.277c-.675 0-1.187.317-1.187 1.285v4.42c0 .98.496 1.284 1.216 1.284h.275c.677 0 1.16-.33 1.16-1.285v-4.419c0-.995-.47-1.285-1.187-1.285zM8.316 7.392h-.4c-.76 0-1.174.43-1.174 1.285v4.13c0 1.063-.36 1.436-1.2 1.436-.662 0-1.201-.29-1.63-.816C3.87 13.373 3 13.786 3 14.81c0 1.104 1.035 1.781 2.955 1.781 2.334 0 3.563-1.173 3.563-3.742V8.675c0-.856-.413-1.283-1.202-1.283z"
                    fill="#fff"></path>
            </svg>
            <h1>Home Page</h1>
            <p class="mx-auto fs-5 text-muted">
                Navigate to SAP/Site IDs using Above Controls to View Image(s).
            </p>
        <?php } else { ?>
            <h1 class="mt-1 mb-3">
                <!-- <i class="bi bi-file-earmark-x-fill"></i> -->
                <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="7rem" height="7rem">
                    <path fill="currentColor"
                        d="M20.54,2.46A5,5,0,1,0,22,6,5,5,0,0,0,20.54,2.46ZM14,6a3,3,0,0,1,3-3,3,3,0,0,1,1.29.3l-4,4A3,3,0,0,1,14,6Zm5.12,2.12a3.08,3.08,0,0,1-3.4.57l4-4A3,3,0,0,1,20,6,3,3,0,0,1,19.12,8.12ZM19,13a1,1,0,0,0-1,1v.39L16.52,12.9a2.87,2.87,0,0,0-3.93,0l-.7.71L9.41,11.12a2.87,2.87,0,0,0-3.93,0L4,12.61V7A1,1,0,0,1,5,6H9A1,1,0,0,0,9,4H5A3,3,0,0,0,2,7V19a3,3,0,0,0,3,3H17a3,3,0,0,0,.95-.17l.09,0A3,3,0,0,0,20,19.44a1.43,1.43,0,0,0,0-.22V14A1,1,0,0,0,19,13ZM5,20a1,1,0,0,1-1-1V15.43l2.9-2.89a.79.79,0,0,1,1.09,0l3.19,3.18h0L15.46,20Zm13-1a1,1,0,0,1-.18.54L13.3,15l.71-.7a.79.79,0,0,1,1.09,0L18,17.21Z" />
                </svg> -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="7rem" height="7rem">
                    <path fill="currentColor"
                        d="M21.9,21.9l-8.49-8.49l0,0L3.59,3.59l0,0L2.1,2.1L0.69,3.51L3,5.83V19c0,1.1,0.9,2,2,2h13.17l2.31,2.31L21.9,21.9z M5,18 l3.5-4.5l2.5,3.01L12.17,15l3,3H5z M21,18.17L5.83,3H19c1.1,0,2,0.9,2,2V18.17z" />
                </svg>
            </h1>
            <p class="mx-auto fs-5 text-muted">
                No Image(s) for <code><?php echo substr($path, 8); ?></code>.<br>
                You can Try:
            </p>
            <div class="list-group">
                <button
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center text-muted"
                    id="sug2" type="button">
                    Checking other SAP/Site IDs<i class="bi bi-ui-radios"></i>
                    <script type="text/javascript">
                        var sapOpt = $('input[type="radio"][name="SAPOpt"]')
                        $('#sug2').click(function () {
                            var checked = sapOpt.filter(':checked');
                            var next = sapOpt.eq(sapOpt.index(checked) + 1);
                            if (!next.length) {
                                next = sapOpt.first();
                            }
                            next.click();
                        });
                    </script>
                </button>
                <button
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center text-muted"
                    type="button" id="sug1" onclick="$('#uploadGrp label').click();">
                    Uploading some Images<i class="bi bi-upload"></i>
                    <script type="text/javascript">
                        <?php echo $_SESSION['isAdmin']; ?> != 1 ? $('#sug1').addClass('d-none') : $('#sug1').removeClass('d-none');
                    </script>
                </button>
                <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center text-muted"
                    href="" onclick="sessionStorage.clear();">
                    Going to Home Page<i class="bi bi-arrow-clockwise"></i>
                </a>
            </div>
        <?php }
        echo '</div>';
    } else {
        while ($data = mysqli_fetch_assoc($result)) { ?>
            <figure class="!figure card border-secondary" id="figBox">
                <img class="!figure-img card-img-top img-fluid" title="Click to Zoom" id="figImg"
                    src="<?php echo 'images/' . $data['FilePath'] . '/' . $data['FileName']; ?>">
                <div class="card-header">
                    <input class="form-check-input" type="checkbox" name="imgSelect[]" style="display: none;"
                        value="<?php echo $data['FileName']; ?>" id="<?php echo $data['FileName']; ?>" />
                    <label class="figure-caption !card-title text-truncate" for="<?php echo $data['FileName']; ?>">
                        <?php echo $data['FileName']; ?>
                    </label>
                </div>
                <!-- <div class="card-body" id="figDetails">
                <textarea class="!card-text figure-caption form-control"><!?php echo $data['FileDescription']; ?></textarea>
            </div> -->
                <!-- <div class="card-footer">
                <button class="btn btn-sm btn-outline-info" title="Edit Description">
                    <i class="bi bi-card-text"></i></button>
                <div class="btn-group">
                    <input type="file" id="<!?php echo $data['FileName']; ?>" accept="image/*" style="display: none;" />
                    <button class="btn btn-sm btn-outline-primary" type="button" title="Replace Image"
                        style="border-top-left-radius: var(--bs-border-radius-sm); border-bottom-left-radius: var(--bs-border-radius-sm);">
                        <i class="bi bi-image"></i><i class="bi bi-arrow-repeat"></i></button>
                    <button class="btn btn-sm btn-outline-primary" title="Upload">
                        <i class="bi bi-upload"></i></button>
                </div>
                <button class="btn btn-sm btn-outline-danger" name="delete<!?php $data['FileName']; ?>" title="Delete">
                    <i class="bi bi-trash-fill"></i></button>
                <!?php if (isset($_POST[$data['FileName']])) {
                    $tmp = $data['FileName'];
                    $sql = "DELETE FROM image WHERE FileName IN ('$tmp')";
                    mysqli_query($db, $sql);
                    unlink('./images/' . $tmp);
                }
                ?>
            </div> -->
            </figure>
        <?php }
        echo '<script type="text/javascript">
            $("#SAPSelection").html(`' . substr($path, 8) . ' <i class="bi bi-caret-down-fill"></i>' . '`);
        </script>';
    }
    ?>
</form>