<style>
  .classic-blink {
    /* animation: blinker 1s steps(1, end) infinite; */
  }

  @keyframes blinker {
    50% { opacity: 0; }
  }
</style>
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
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-calendar"></i> Calendar</h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-setting btn-round btn-default"><i
                                class="glyphicon glyphicon-cog"></i></a>
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i
                                class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <?php
                    $datetime=$year."-".$month;
                    if($month==date('m') && $year==date('Y')){
                        $previous="disabled";
                    }else{
                        $previous="";
                    }
                    $nextmonth=date('m',strtotime('1 month',strtotime($datetime)));
                    $nextyear=date('Y',strtotime('1 month',strtotime($datetime)));
                    $prevmonth=date('m',strtotime('-1 month',strtotime($datetime)));
                    $prevyear=date('Y',strtotime('-1 month',strtotime($datetime)));
                    ?>
                    <!-- <div id="calendar"></div> --> 
                <table class="table table-bordered" width="100%" style="table-layout: fixed;">

                  <tr style="background-color: #fe72bb; color:white;">
                    <td style="text-transform:uppercase;text-align:center; font-size:24px;">
                      <b><?=date('m',strtotime($datetime));?></b>
                    </td>
                    <td align="center" colspan="5" style="text-transform:uppercase;text-align:center; font-size:24px; border-left:0;">
                      <font styl="text-align:center;"><b><?=date('F',strtotime($datetime));?></b></font>
                    </td>
                    <td style="text-transform:uppercase;text-align:center; font-size:24px; border-left:0;">
                      <b><?=date('y',strtotime($datetime));?></b>
                    </td>
                  </tr>

                    <tr>

                      <td align="center" style="background-color:red; color:white;"><b>SUN</b></td>

                      <td align="center" style="background-color:#ffca6a; color:white;"><b>MON</b></td>

                      <td align="center" style="background-color:#ffca6a; color:white;"><b>TUE</b></td>

                      <td align="center" style="background-color:#ffca6a; color:white;"><b>WED</b></td>

                      <td align="center" style="background-color:#ffca6a; color:white;"><b>THU</b></td>

                      <td align="center" style="background-color:#ffca6a; color:white;"><b>FRI</b></td>

                      <td align="center" style="background-color:#ffca6a; color:white;"><b>SAT</b></td>

                    </tr>

                    <?php
                    $w=0;                    
                    $color="";
                    for($i=1;$i<=date('t',strtotime($datetime));$i++){

                      $date=date('Y-m-d',strtotime($datetime."-".$i));                      

                      if($i==1){

                        for($x=0;$x<7;$x++){

                            if(date('w',strtotime($date))==$x){                                                              
                                
                             
                                if($date < date('Y-m-d')){
                                    echo "<td style='height:100px; background-color:#ff9796;' align='center'><b style='font-size:1.5vw;'>$i</b>";
                                    echo "<a href='#' style='width:100%; height:100%; display:block; top:5px;'></a>";
                                }else{
                                    echo "<td style='height:100px; background-color:#7fda5b;' align='center'><b style='font-size:1.5vw;'>$i</b>";
                                     $query=$this->Booking_model->getAllBookingByDate($date);
                                    if(count($query)>0){
                                        $numb="<font style='font-size:1.5vw;' class='classic-blink'>".count($query)." bookings</font>";
                                    }else{
                                        $numb="";
                                    }
                             echo "<a href='".base_url('manage_bookings/'.$date)."' style='width:100%; height:100%; display:block; top:5px; color:black;'>$numb</a>";
        
                                }
                             echo "</td>";                                 

                                $w++;

                                break;                                                                                                                                                     

                            }else{

                                echo "<td style='background-color:gray; height:100px;'>&nbsp;</td>";

                                $w++;

                            }

                           

                       }

                    }else{                      
                                                
                                if($date < date('Y-m-d')){
                                    echo "<td style='height:100px; background-color:#ff9796;' align='center'><b style='font-size:1.5vw;'>$i</b>";
                                    echo "<a href='#' style='width:100%; height:100%; display:block; top:5px;'></a>";
                                }else{
                                    echo "<td style='height:100px; background-color:#7fda5b;' align='center'><b style='font-size:1.5vw;'>$i</b>";
                                     $query=$this->Booking_model->getAllBookingByDate($date);
                                    if(count($query)>0){
                                        $pen=0;
                                        $con=0;
                                        foreach($query as $rw){
                                            if($rw['status']=="pending"){
                                                $pen++;
                                            }
                                            if($rw['status']=="confirmed"){
                                                $con++;
                                            }
                                        }
                                        $valpen="";                                        
                                        $valcon="";
                                        if($pen>0){
                                            $valpen=$pen." pending<br>";
                                        }
                                        if($con>0){
                                            $valcon=$con." confirmed";
                                        }
                                        $mess=$valpen."".$valcon;
                                        $numb="<font style='font-size:1.7vw;' class='classic-blink'>".$mess."</font>";
                                    }else{
                                        $numb="";
                                    }
                                    echo "<a href='".base_url('manage_bookings/'.$date)."' style='width:100%; height:100%; display:block; top:5px; color:black;'><p align='center'>$numb</p></a>";
                            //  echo "<p style='text-align:center;'>View</p>";
                             echo "</a>";
                             $avail=0;
                            //  $rooms=$this->General_model->getRooms();

                            //  $avail=count($rooms);;
                            //  foreach($rooms as $room){
                            //     $query=$this->Reservation_model->checkAvailableRoom($room['id'],$date);
                            //     if(count($query)>0){
                            //         $avail--;
                            //     }
                            //  }  
                                // if($avail==0 ){
                                //     echo "<p align='center'><b style='color:red;'>Fully Booked!</b></p>";
                                // }else{
                                //     echo "<p align='center'>".$avail." Available Room(s)</p>";
                                // }
                                }
                             echo "</td>";                              

                        $w++;

                    }

                                                               

                   

                    if($w > 6){

                        $w=0;

                        echo "</tr>";

                    }

                    }

                    ?>

                </table>
                <table width="100%" border="0" cellpadding="0">
                        <tr>
                            <td width="3%">
                            <!-- <a href="#">Prev</a> -->
                             <?=form_open(base_url('adminmain'));?>
                            <input type="hidden" name="month" value="<?=$prevmonth;?>">
                            <input type="hidden" name="year" value="<?=$prevyear;?>">
                            <button type="submit" class="btn btn-primary btn-sm" <?=$previous;?>><< Previous</button>
                            <?=form_close();?>
                        </td>
                        <td>
                            <?=form_open(base_url('adminmain'));?>
                            <input type="hidden" name="month" value="<?=$nextmonth;?>">
                            <input type="hidden" name="year" value="<?=$nextyear;?>">
                            <button type="submit" class="btn btn-primary btn-sm">Next >></button>
                            <?=form_close();?>
                        </td>
                        </tr>
                </table>
                </div>
            </div>
        </div>
    </div><!--/row-->
<!-- <div class="row">
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
</div> -->