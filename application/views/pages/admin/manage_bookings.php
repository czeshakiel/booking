<div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
    <ul class="breadcrumb">
        <li>
            <a href="<?=base_url('adminmain');?>">Dashboard</a>
        </li>        
        <li>
            Booking Manager
        </li>        
    </ul>
</div>
<?php
if($this->session->flashdata('success')){
    echo "<div class='alert alert-success'>".$this->session->flashdata('success')."</div>";
}
if($this->session->flashdata('error')){
    echo "<div class='alert alert-danger'>".$this->session->flashdata('error')."</div>";
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
                        <th>Booking ID</th>                        
                        <th>Booking Date</th>
                        <th>Name</th>
                        <th>Contact No.</th>
                        <th>Court No.</th>
                        <th>Time</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th width="20%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
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
                                $confirm="";
                                $view="";
                                $cancel="";
                             if($item['status']=="cancelled"){
                                $confirm="style='display:none;'";
                                $view="style='display:none;'";
                                $cancel="style='display:none;'";
                             }
                             if($item['status']=="confirmed"){
                                $confirm="style='display:none;'";
                                $cancel="style='display:none;'";
                             }
                            echo "<tr>";
                                echo "<td>$item[booking_id]</td>";
                                echo "<td>".date('m/d/Y',strtotime($item['book_date']))."</td>";
                                echo "<td>$item[fullname]</td>";
                                echo "<td>$item[contactno]</td>";
                                echo "<td>$item[courtname]</td>";
                                echo "<td>$booktime</td>";
                                echo "<td>".number_format($totalamount,2)."</td>";
                                echo "<td>$item[status]</td>";
                                ?>
                                <td>
                                    <a href="<?= base_url('view_payment/'.$item['booking_id']); ?>" class="btn btn-success btn-sm" target="_blank" <?=$view;?>>View POP</a>
                                    <a href="<?=base_url('confirm_booking/'.$item['booking_id']);?>" class="btn btn-primary btn-sm" onclick="return confirm('Do you wish to confirm this booking?');return false;" <?=$confirm;?>> Confirm</a>
                                    <a href="<?= base_url('cancel_bookings/'.$item['booking_id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to cancel this booking?');" <?=$cancel;?>>Cancel</a>
                                </td>
                                <?php
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>