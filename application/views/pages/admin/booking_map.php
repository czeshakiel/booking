<style>
  .classic-blink {
    animation: blinker 1s steps(1, end) infinite;
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
            <a href="<?=base_url('adminmain');?>">Dashboard</a>
        </li>
        <li>
            Booking Map (<?=date('M d, Y, l',strtotime($datearray));?>)
        </li>
    </ul>
</div>

<div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-calendar"></i> Booking Map</h2>

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
                <table width="100%" border="1" cellspacing="0" cellpadding="1" style="border-collapse:collapse;">
                    <tr>
                        <td width="30%">Time/Court</td>
                        <?php
                        $courts=$this->Booking_model->getAllCourts();
                        foreach($courts as $row){
                            echo "<td align='center'>$row[courtname]</td>";
                        }
                        ?>
                    </tr>
                    <?php
                    $booktime=$this->Booking_model->getAllBookingTime();
                    foreach($booktime as $book){
                        $time_id=$book['time_id'];
                        echo "<tr>";
                            echo "<td align='center'>$book[time_description]</td>";
                            $courts=$this->Booking_model->getAllCourts();
                            foreach($courts as $row){
                                $status="";
                                $color="";
                                $bookings=$this->Booking_model->getAllBookingByDate($datearray);
                                foreach($bookings as $row){
                                    $tid=explode(';',$row['book_time']);
                                    for($i=0;$i<sizeof($tid);$i++){
                                        if($tid[$i]==$time_id && $row['status']=="confirmed"){
                                            $status="Booked by".$row['fullname'];
                                            $color="background-color:#fe72bb; color: white;";
                                        }
                                    }
                                }
                                echo "<td align='center' style='$color'>$status</td>";
                            }
                        echo "</tr>";
                    }
                    ?>
                </table>
                <br>
                <?php
                
                $nexday=date('Y-m-d',strtotime('1 day',strtotime($datearray)));
                $prevday=date('Y-m-d',strtotime('-1 day',strtotime($datearray)));
                $nex2day=date('Y-m-d',strtotime('2 day',strtotime($datearray)));
                $prev2day=date('Y-m-d',strtotime('-2 day',strtotime($datearray)));                
                if($datearray <= date('Y-m-d')){
                    $previous="disabled";
                }else{
                    $previous="";                    
                }                
                ?>
                <table width="100%" border="0" cellpadding="0">
                        <tr>
                            <td width="3%">
                            <!-- <a href="#">Prev</a> -->
                             <?=form_open(base_url('booking_map'));?>                            
                            <input type="hidden" name="datearray" value="<?=$prevday;?>">
                            <button type="submit" class="btn btn-primary btn-sm" <?=$previous;?>><< Previous</button>
                            <?=form_close();?>
                        </td>
                        <td width="3%">
                            <?=form_open(base_url('booking_map'));?>
                            <input type="hidden" name="datearray" value="<?=$nexday;?>">                            
                            <button type="submit" class="btn btn-primary btn-sm">Next >></button>
                            <?=form_close();?>
                        </td>
                        <?php
                        if($prev2day < date('Y-m-d')){
                                                $previous="disabled";
                                            }
                        ?>
                        <td width="3%">
                            <?=form_open(base_url('booking_map'));?>
                            <input type="hidden" name="datearray" value="<?=$prev2day;?>">                            
                            <button type="submit" class="btn btn-primary btn-sm" <?=$previous;?>><< -2 days</button>
                            <?=form_close();?>
                        </td>
                        <td>
                            <?=form_open(base_url('booking_map'));?>
                            <input type="hidden" name="datearray" value="<?=$nex2day;?>">                            
                            <button type="submit" class="btn btn-primary btn-sm"> + 2 days >></button>
                            <?=form_close();?>
                        </td>
                        </tr>
                </table>
                </div>
            </div>
        </div>
    </div><!--/row-->