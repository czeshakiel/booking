<style>
.button-checkbox {
    display: inline-block;
    padding: 12px 25px;
    background: #eee;
    border: 2px solid #ccc;
    border-radius: 8px;
    cursor: pointer;
    font-family: Arial, sans-serif;
    font-weight: bold;
    transition: 0.2s;
    text-align: center;
}

.button-checkbox input {
    display: none;
}

/* Checked state */
.button-checkbox:has(input:checked) {
    background: #198754;
    color: white;
    border-color: #198754;
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
            View Available Court (<?=date('F d, Y', strtotime($datearray));?>)
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
                    <div class="form-group">                        
                        <label for="booking_date">Court</label>
                        <select class="form-control" name="court_id" >
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
                
                <form name="checkavailable" action="<?=base_url('save_booking');?>" method="post">
                    <?php foreach($timesettings as $time): ?>
                        <label class="button-checkbox">
                            <input type="checkbox" name="court" value="<?=$time['time_id'];?>">
                            <?=$time['time_description'];?><br>asdfsdf
                        </label>
                    <?php endforeach; ?>
                </form>
            </div>
        </div>
    </div>
</div>