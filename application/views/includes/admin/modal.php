<div class="modal fade" id="adminlogout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>Logout</h3>
            </div>
            <div class="modal-body">
                <h2>Do you wish to logout?</h2>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-default" data-dismiss="modal">No, I will stay</a>
                <a href="<?=base_url('adminlogout');?>" class="btn btn-primary">Yes, Log me out</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="manageCourt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form name="managecourt" action="<?=base_url('save_court');?>" method="post">
            <input type="hidden" name="id" id="court_id">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>Manage Court</h3>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="courtname">Court Name</label>
                    <input type="text" class="form-control" id="court_name" name="courtname" required>
                </div>
                <div class="form-group">
                    <label for="court_rate_am">Rate (AM)</label>
                    <input type="text" class="form-control" id="court_rate_am" name="court_rate_am" required>
                </div>
                <div class="form-group">
                    <label for="court_rate_pm">Rate (PM)</label>
                    <input type="text" class="form-control" id="court_rate_pm" name="court_rate_pm" required>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="manageBookingTime" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form name="managebookingtime" action="<?=base_url('save_booking_time');?>" method="post">
            <input type="hidden" name="id" id="booking_time_id">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>Manage Booking Time</h3>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="time_id">Time Ordinal</label>
                    <input type="text" class="form-control" id="time_id" name="time_id" required>
                </div>
                <div class="form-group">
                    <label for="time_description">Description</label>
                    <input type="text" class="form-control" id="time_description" name="time_description" required>
                </div>
                <div class="form-group">
                    <label for="time_shift">Shift</label>
                    <input type="text" class="form-control" id="time_shift" name="time_shift" required>
                </div>                
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
