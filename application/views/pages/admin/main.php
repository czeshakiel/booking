<div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
    <ul class="breadcrumb">        
        <li>
            <a href="<?=base_url('adminmain');?>">Admin Dashboard</a>
        </li>
    </ul>
</div>
<div class=" row">
    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="" class="well top-block" href="#">
            <i class="glyphicon glyphicon-book blue"></i>
            <div><?=count($totalbooking);?></div>
            <div>Total Bookings</div>
            
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="" class="well top-block" href="#">
            <i class="glyphicon glyphicon-book green"></i>
            <div><?=count($confirmedbooking);?></div>
            <div>Confirmed Bookings</div>
        
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="" class="well top-block" href="#">
            <i class="glyphicon glyphicon-book yellow"></i>
            <div><?=count($pendingbooking);?></div>
            <div>Pending Bookings</div>
            
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="" class="well top-block" href="#">
            <i class="glyphicon glyphicon-book red"></i>
            <div><?=count($cancelledbooking);?></div>
            <div>Cancelled Bookings</div>
            
        </a>
    </div>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-th-list"></i> Todays Booking</h2>                
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Full Name</th>
                            <th>Contact No</th>
                            <th>Court No.</th>
                            <th>Time</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($todaysbooking as $booking): ?>
                        <tr>
                            <td><?= $booking['booking_id']; ?></td>
                            <td><?= $booking['fullname']; ?></td>
                            <td><?= $booking['contactno']; ?></td>
                            <td><?= $booking['court_name']; ?></td>
                            <td></td>
                            <td><?= ucfirst($booking['status']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>