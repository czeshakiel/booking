
<script src="<?=base_url('design/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>

<!-- library for cookie management -->
<script src="<?=base_url('design/js/jquery.cookie.js');?>"></script>
<!-- calender plugin -->
<script src='<?=base_url('design/bower_components/moment/min/moment.min.js');?>'></script>
<script src='<?=base_url('design/bower_components/fullcalendar/dist/fullcalendar.min.js');?>'></script>
<!-- data table plugin -->
<script src='<?=base_url('design/js/jquery.dataTables.min.js');?>'></script>

<!-- select or dropdown enhancer -->
<script src="<?=base_url('design/bower_components/chosen/chosen.jquery.min.js');?>"></script>
<!-- plugin for gallery image view -->
<script src="<?=base_url('design/bower_components/colorbox/jquery.colorbox-min.js');?>"></script>
<!-- notification plugin -->
<script src="<?=base_url('design/js/jquery.noty.js');?>"></script>
<!-- library for making tables responsive -->
<script src="<?=base_url('design/bower_components/responsive-tables/responsive-tables.js');?>"></script>
<!-- tour plugin -->
<script src="<?=base_url('design/bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js');?>"></script>
<!-- star rating plugin -->
<script src="<?=base_url('design/js/jquery.raty.min.js');?>"></script>
<!-- for iOS style toggle switch -->
<script src="<?=base_url('design/js/jquery.iphone.toggle.js');?>"></script>
<!-- autogrowing textarea plugin -->
<script src="<?=base_url('design/js/jquery.autogrow-textarea.js');?>"></script>
<!-- multiple file upload plugin -->
<script src="<?=base_url('design/js/jquery.uploadify-3.1.min.js');?>"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="<?=base_url('design/js/jquery.history.js');?>"></script>
<!-- application script for Charisma demo -->
<script src="<?=base_url('design/js/charisma.js');?>"></script>

<script>
    $('.addcourt').on('click', function() {
        document.getElementById('court_id').value = '';
        document.getElementById('court_name').value = '';
        document.getElementById('court_rate_am').value = '';
        document.getElementById('court_rate_pm').value = '';
    });
    $('.editcourt').on('click', function() {
        var courtId = $(this).data('id');
        $.ajax({
            url: '<?=base_url('get_court/');?>' + courtId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                document.getElementById('court_id').value = courtId;
                document.getElementById('court_name').value = data.courtname;
                document.getElementById('court_rate_am').value = data.court_rate_am;
                document.getElementById('court_rate_pm').value = data.court_rate_pm;
            },
            error: function() {
                alert('Error retrieving court details.');
            }
        });
    });
    $('.addbookingtime').on('click', function() {
        document.getElementById('booking_time_id').value = '';
        document.getElementById('time_id').value = '';
        document.getElementById('time_description').value = '';
        document.getElementById('time_shift').value = '';
    });
    $('.editbookingtime').on('click', function() {
        var bookingTimeId = $(this).data('id');
        $.ajax({
            url: '<?=base_url('get_booking_time/');?>' + bookingTimeId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                document.getElementById('booking_time_id').value = bookingTimeId;
                document.getElementById('time_id').value = data.time_id;
                document.getElementById('time_description').value = data.time_description;
                document.getElementById('time_shift').value = data.time_shift;
            },
            error: function() {
                alert('Error retrieving booking time details.');
            }
        });
    });
</script>


</body>
</html>
