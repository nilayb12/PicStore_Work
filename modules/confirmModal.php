<!-- <!?php include_once ('dbConfig.php'); ?> -->

<div class="modal fade" id="delModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="delModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-secondary-subtle">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="delModalLabel">
                    <i class="bi bi-exclamation-triangle-fill" style="color: orange;"></i> Confirm Delete
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you Sure you want to <span style="color: orange;">PERMANENTLY Delete</span> the Image(s)?
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Cancel</button>
                <button class="btn btn-danger" id="delConfirm"><i class="bi bi-trash"></i> Delete</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="aboutModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="aboutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-secondary-subtle">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="aboutModalLabel">About</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Reliance Jio Infocomm Ltd.</div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal"><i class="bi bi-check-lg"></i> OK</button>
            </div>
        </div>
    </div>
</div>
<!-- <div class="modal fade" id="SAPInfoModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="SAPInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-secondary-subtle">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="SAPInfoModalLabel">
                    <i class="bi bi-info-circle-fill text-info"></i>Site Info
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!?php
                $path = @$_POST['pathVal2'];
                $query = "SELECT Lat, `Long`, SiteStat FROM 5g_data WHERE SAP_ID = ('$path')";
                $result = mysqli_query($db, $query);

                while ($data = mysqli_fetch_assoc($result)) { ?>
                    Lat: <!?php echo $data['Lat']; ?><br>
                    Long: <!?php echo $data['Long']; ?><br>
                    Status: <!?php echo $data['SiteStat']; ?>
                <!?php }
                ?>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal"><i class="bi bi-check-lg"></i> OK</button>
            </div>
        </div>
    </div>
</div> -->