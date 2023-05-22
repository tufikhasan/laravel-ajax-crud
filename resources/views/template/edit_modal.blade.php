<!-- Edit Modal HTML -->
<div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="updateEmployee">
                @csrf
                <input type="hidden" name="up_id" id="up_id">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Employee</h4>
                    <button type="button" class="close modal-close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="updateErrMsgContainer mb-3">
                        <!--Error message area-->
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="up_name" id="up_name" required />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="up_email" id="up_email" required />
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" name="up_address" id="up_address" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="up_phone" id="up_phone" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default modal-close" data-dismiss="modal" value="Cancel" />
                    <input type="submit" class="btn btn-info update_employee" value="Save" />
                </div>
            </form>
        </div>
    </div>
</div>
