@stack ('modal')
<div class="modal fade" id="modal-confirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Delete Confirmation</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">
                <p class="lead">
                    Are you sure you want to delete this data <strong data-filename></strong>?
                </p>

                <button type="button" data-target="" class="btn btn-danger btn-trigger-delete btn-proceed d-inline-block">Yes, Delete Data</button>
                <button type="button" class="btn btn-light d-inline-block" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>