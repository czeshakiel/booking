<style>
.button-checkbox {
   /* display: inline-block;
    padding: 12px 25px;
    background: #eeeeee;
    border: 2px solid #ccc;
    border-radius: 8px;
    cursor: pointer;
    font-family: Arial, sans-serif;
    font-weight: bold;
    transition: 0.2s;
    text-align: center;
    width: 28vw;*/
}

.button-checkbox input {
    display: none;
}

/* Checked state */
.button-checkbox:has(input:checked) {
    background: #fe72bb;
    color: white;
    border-color: #fe72bb;
}
</style>
<div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
    <ul class="breadcrumb">
        <li>
            <a href="<?=base_url('main');?>">My Dashboard</a>
        </li>                
        <li>
            View Available Court (<?=date('F d, Y, l', strtotime($datearray));?>)
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
                <h2><i class="glyphicon glyphicon-calendar"></i> Schedule Details</h2>                
            </div>
            <div class="box-content">                 
                <form name="viewavailable" action="<?=base_url('search_view_available');?>" method="post">    
                    <input type="hidden" name="datearray" value="<?=$datearray;?>">         
                    <div class="form-group">                        
                        <label for="booking_date">Court</label>
                        <select class="form-control" name="court_id" required>
                            <option value="">Select Court</option>
                            <?php foreach($courts as $court): ?>
                                <option value="<?= $court['id']; ?>"><?= $court['courtname']; ?></option>
                            <?php endforeach; ?>
                        </select>                                          
                    </div>
                    <div class="form-group">                        
                        <input type="submit" class="btn btn-primary" value="View Available Time" /> 
                    </div>
                </form>

                <?php if($search==1){ ?>
                <h3><?=$selected_court['courtname'];?></h3>
                <form name="checkavailable" action="<?=base_url('save_booking');?>" method="post" id="myTimeForm">
                    <input type="hidden" name="datearray" value="<?=$datearray;?>">
                    <input type="hidden" name="court_id" value="<?=$selected_court['id'];?>">
                    
                    <div class="form-group" style="margin-left:2%;">                      
                            <input type="submit" class="btn btn-primary" value="Book Selected Time" id="btnSaveTime" disabled/>
                    </div>
                    
                    <?php foreach($timesettings as $time): ?>
                        <?php 
                        $status="";
                        $bkcolor="";
                        $remarks="Available";
                        $bookcount=0;                        
                        $booking=$this->Booking_model->getAllBookingsByDate($datearray,$selected_court['id']);
                        if(count($booking)>0){
                            foreach($booking as $row){                                
                                $btime=explode(';',$row['book_time']);
                                for($w=0;$w<sizeof($btime)-1;$w++){
                                    if($time['time_id']==$btime[$w]){
                                        $bookcount++;
                                    }
                                }
                            }
                        }
                        $col="blue";
                        if($bookcount>0){
                            $status="disabled";
                            $bkcolor="gray";
                            $remarks="occupied";
                            $col="gray";
                        }
                        if(date('w',strtotime($datearray))== 5 && ($time['time_id'] >= 10 && $time['time_id'] <= 15 )){
                            $status="disabled";
                            $bkcolor="gray";
                            $remarks="Not Available";
                        }else if(date('w',strtotime($datearray))== 6 && ($time['time_id'] >= 1 && $time['time_id'] <= 10 )){
                            $status="disabled";
                            $bkcolor="gray";
                            $remarks="Not Available";
                        }

                        ?>  
                           
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <label title="" class="well top-block button-checkbox" style="background-color: <?=$bkcolor;?>;">
                                <i class="glyphicon glyphicon-calendar <?=$col;?>"></i>
                                 <input type="checkbox" name="time_check[]" value="<?=$time['time_id'];?>" <?=$status;?> id="time_check" onclick="checkTimeExist()">
                                <div><?=$time['time_description'];?></div>
                                <div><?=$remarks;?></div>
                                
                            </label>
                        </div>                   
                        <!-- <label class="button-checkbox" style="background-color: <?=$bkcolor;?>;">
                            <input type="checkbox" name="time_check[]" value="<?=$time['time_id'];?>" <?=$status;?> id="time_check" onclick="checkTimeExist()">
                            <?=$time['time_description'];?><br><?=$remarks;?>
                        </label> -->
                    <?php endforeach; ?>
                    <div class="row">
                        
                    </div>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>