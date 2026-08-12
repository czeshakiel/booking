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
            Manage Court
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
                <h2><i class="glyphicon glyphicon-th-list"></i> Court Details</h2>     
                <div style="float:right;">
                    <a href="#" class="btn btn-round btn-default btn-sm managecourt" data-toggle="modal" data-target="#manageCourt"><i
                            class="glyphicon glyphicon-plus"></i> Add Court</a>                    
                </div>           
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                    <thead>
                        <tr>
                            <th>Court ID</th>
                            <th>Court Name</th>
                            <th>Rate AM</th>
                            <th>Rate PM</th>                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($courts as $court): ?>
                        <tr>
                            <td><?= $court['id']; ?></td>
                            <td><?= $court['courtname']; ?></td>
                            <td align="right"><?= number_format($court['court_rate_am'], 2); ?></td>
                            <td align="right"><?= number_format($court['court_rate_pm'], 2); ?></td>                            
                            <td>
                                <a href="#" class="btn btn-primary btn-sm editcourt" data-toggle="modal" data-target="#manageCourt" data-id="<?= $court['id']; ?>">Edit</a>
                                <a href="<?= base_url('delete_court/'.$court['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this court?');">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>