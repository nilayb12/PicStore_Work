<?php include_once ('dbConfig.php') ?>

<form id="imgForm" method="post" action="">
    <button class="btn d-none" name="deleteBtn" id="deleteBtn"></button>
    <input type="hidden" name="pathVal1" id="pathVal1" />
    <?php include ('dbDeleteSelected.php');
    $path = @$_POST['pathVal1'];
    $query = "SELECT * FROM image WHERE FilePath = ('$path')";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) == 0) {
        // file_get_contents('emptyfolder.svg', true)
        echo '<div class="pt-5 text-center">';
        if (empty($path)) { ?>
            <img class="my-3" src="./Reliance_Jio_Logo.svg" width="160rem" height="160rem"></img>
            <h1>Home Page</h1>
            <p class="mx-auto fs-5 text-muted">
                Navigate to SAP/Site IDs using Above Controls to View Image(s).
            </p>
        <?php } else { ?>
            <h1 class="my-5"><i class="bi bi-file-earmark-x-fill"></i></h1>
            <p class="mx-auto fs-5 text-muted">
                No Image(s) for <code><?php echo substr($path, 8); ?></code>.<br>
                Try Uploading some or Navigate to SAP/Site IDs using Above Controls.<br>
                Reload to GoTo Home Page.
            </p>
        <?php }
        echo '</div>';
    } else {
        while ($data = mysqli_fetch_assoc($result)) {
            ?>
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
            <?php
        }
    }
    ?>
</form>