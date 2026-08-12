<div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
    <ul class="breadcrumb">
        <li>
            <a href="<?=base_url('main');?>">My Dashboard</a>
        </li>        
        <li>
            My Bookings
        </li>
    </ul>
</div>
<?php
if($this->session->flashdata('success')){
    echo "<div class='alert alert-success'>".$this->session->flashdata('success')."</div>";
}
if($this->session->flashdata('failed')){
    echo "<div class='alert alert-danger'>".$this->session->flashdata('failed')."</div>";
}
?>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-book"></i> Booking List</h2>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                    <thead>
                    <tr>
                        <th>No.</th>                        
                        <th>Booking ID</th>
                        <th>Booking Date</th>
                        <th>Booking Time</th>
                        <th>Court No.</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th width="20%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 1;
                        foreach($bookings as $item){  
                            $btime=explode(";",$item['book_time']);
                             $c=sizeof($btime)-1;
                             $a=$btime[0];
                             $b=$btime[$c-1]; 
                             $totalhrs=$c; 
                             
                             
                             $querycourt=$this->Booking_model->get_court($item['court_id']);

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
                             $pay="";
                             $cancel="";
                             if($item['payment']==""){
                                $view="style='display:none;'";
                             }else{
                                $view="";                                
                             }
                             if($item['status']=="cancelled" || $item['status']=="confirmed"){
                                $view="style='display:none;'";
                                $pay="style='display:none;'";
                                $cancel="style='display:none;'";
                             }
                             
                            echo "<tr>";
                                echo "<td>$counter</td>";
                                echo "<td>$item[booking_id]</td>";
                                echo "<td>". date('m/d/Y', strtotime($item['book_date'])) . "</td>";
                                echo "<td>$booktime</td>";
                                echo "<td>$item[courtname]</td>";
                                echo "<td>" . number_format($totalamount, 2) . "</td>";
                                echo "<td>$item[status]</td>";
                            ?>
                                <td>                                    
                                    <a href="#" data-toggle="modal" data-target="#uploadPayment" data-id="<?= $item['booking_id']; ?>" class="btn btn-info btn-sm uploadPayment" <?=$pay;?>>Upload Proof of Payment</a>
                                    <a href="<?= base_url('view_payment/'.$item['booking_id']); ?>" class="btn btn-success btn-sm" <?=$view;?> target="_blank">View</a>
                                    <a href="<?= base_url('cancel_bookings/'.$item['booking_id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to cancel this booking?');" <?=$cancel;?>>Cancel</a>
                                </td>
                                <?php
                            echo "</tr>";
                            $counter++;
                        }
                        ?>
                    </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>