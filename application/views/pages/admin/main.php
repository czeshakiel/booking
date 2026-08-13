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
                            <?php
                            $btime=explode(";",$booking['book_time']);
                             $c=sizeof($btime)-1;
                             $a=$btime[0];
                             $b=$btime[$c-1]; 
                             $totalhrs=$c; 
                             
                             
                             $querycourt=$this->Booking_model->get_court($booking['court_id']);

                             if($a==$b){
                                $query=$this->Booking_model->get_book_time($a);
                                $booktime=$query['time_description'];                                
                             }else{
                                $first="";
                                $last="";
                                $query=$this->Booking_model->get_book_time($a);
                                if($query) {
                                    $qrb=explode(' - ',$query['time_description']);
                                    $bd=$query['time_description'];                                    
                                    $first=$qrb[0];
                                } else {
                                    $qrb = "";
                                    $bd="";
                                    $booktime="";
                                }
                                
                                $query=$this->Booking_model->get_book_time($b);
                                if($query) {
                                    $qre=explode(' - ',$query['time_description']);
                                    $be=$query['time_description'];
                                    $qre=explode(' - ',$be);        
                                    $last=$qre[1];                            
                                } else {
                                    $qre = "";
                                    $be="";                                    
                                    $booktime="";
                                }
                                
                                $booktime=$first." - ".$last;
                                
                                
                             }
                             $totalamount=0;
                             for($i=0;$i<$c;$i++){                                
                                $query=$this->Booking_model->get_book_time($btime[$i]);
                                if($query['time_shift']=='AM'){
                                    $rate=$querycourt['court_rate_am'];
                                }else{
                                    $rate=$querycourt['court_rate_pm'];
                                }
                                
                                $totalamount +=$rate;
                             }
                            ?>
                        <tr>
                            <td><?= $booking['booking_id']; ?></td>
                            <td><?= $booking['fullname']; ?></td>
                            <td><?= $booking['contactno']; ?></td>
                            <td><?= $booking['courtname']; ?></td>
                            <td><?=$booktime;?></td>
                            <td><?=number_format($totalamount,2);?></td>
                            <td><?= $booking['status']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>