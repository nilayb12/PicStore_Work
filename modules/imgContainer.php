<?php include_once ('dbConfig.php') ?>

<form id="imgForm" method="post" action="" enctype="multipart/form-data">
    <button class="btn" name="deleteBtn" id="deleteBtn" style="display: none;"></button>
    <?php include ('dbDeleteSelected.php');
    $query = "SELECT * FROM image";
    $result = mysqli_query($db, $query);

    while ($data = mysqli_fetch_assoc($result)) {
        ?>
        <figure class="!figure card border-secondary" id="figBox">
            <img class="!figure-img card-img-top img-fluid" title="Click to Zoom" id="figImg"
                src="<?php echo $data['FilePath'] . '/' . $data['FileName']; ?>">
            <div class="card-header">
                <input class="form-check-input" type="checkbox" name="imgSelect[]" style="display: none;"
                    value="<?php echo $data['FileName']; ?>" id="<?php echo $data['FileName']; ?>" />
                <label class="figure-caption !card-title" for="<?php echo $data['FileName']; ?>">
                    <?php echo $data['FileName']; ?>
                </label>
            </div>
            <div class="card-body" id="figDetails">
                <p class="!card-text figure-caption">
                    <?php echo $data['FileDescription']; ?>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                    reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                    cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>
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
    ?>
</form>