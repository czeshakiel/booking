<div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
    <ul class="breadcrumb">        
        <li>
            <a href="<?=base_url('adminmain');?>">Dashboard</a>
        </li>
        <li>
            <a href="<?=base_url('manage_settings');?>">Settings</a>
        </li>
        <li>
            Manage Booking Time
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
                <h2><i class="glyphicon glyphicon-th-list"></i> Booking Time Details</h2>     
                <div style="float:right;">
                    <a href="#" class="btn btn-round btn-default btn-sm addbookingtime" data-toggle="modal" data-target="#manageBookingTime"><i
                            class="glyphicon glyphicon-plus"></i> Add Booking Time</a>                    
                </div>           
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Time Order</th>
                            <th>Description</th>
                            <th>Shift</th>                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($courts as $court): ?>
                        <tr>
                            <td><?= $court['id']; ?></td>
                            <td><?= $court['time_id']; ?></td>
                            <td><?= $court['time_description']; ?></td>
                            <td><?= $court['time_shift']; ?></td>
                            <td>
                                <a href="#" class="btn btn-primary btn-sm editbookingtime" data-toggle="modal" data-target="#manageBookingTime" data-id="<?= $court['id']; ?>">Edit</a>
                                <a href="<?= base_url('delete_booking_time/'.$court['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this booking time?');">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>