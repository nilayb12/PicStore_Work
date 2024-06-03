<?php include_once ('dbConfig.php') ?>

<form id="imgForm" method="post" action="">
    <button class="btn d-none" name="deleteBtn" id="deleteBtn"></button>
    <input type="hidden" name="pathVal1" id="pathVal1" />
    <?php include ('dbDeleteSelected.php');
    $path = @$_POST['pathVal1'];
    $query = "SELECT * FROM image WHERE FilePath = ('$path')";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) == 0) {
        echo '<div class="pt-5 text-center">';
        if (empty($path)) { ?>
            <svg class="my-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="8rem" height="8rem">
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
            <h1 class="my-5"><i class="bi bi-file-earmark-x-fill"></i></h1>
            <p class="mx-auto fs-5 text-muted">
                No Image(s) for <code><?php echo substr($path, 8); ?></code>.<br>
                Try Uploading some or Navigate to other SAP/Site IDs using Above Controls.<br>
                Reload to GoTo Home Page.
            </p>
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
    }
    ?>
</form>