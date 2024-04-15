<div class="modal fade" id="delModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="delModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-secondary-subtle">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="delModalLabel"><i class="bi bi-exclamation-triangle-fill"
                        style="color: orange;"></i> Confirm Delete</h5>
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
<div class="modal fade" id="uplModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="uplModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-secondary-subtle">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="uplModalLabel"><i class="bi bi-exclamation-triangle-fill"
                        style="color: orange;"></i> Confirm Replace</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Proceeding with this Action will cause your newly selected Images to <span
                    style="color: orange;">
                    OVERWRITE Existing Images</span> with the Same Name. Do you still wish to Proceed?
                <p style="color: orange;">This action is PERMANENT.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Cancel</button>
                <form method="post" action="">
                    <button class="btn btn-info" type="submit" id="uplConfirm">
                        <i class="bi bi-check-lg"></i> Replace</button>
                </form>
            </div>
        </div>
    </div>
</div>