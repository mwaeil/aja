<?php include_once('../includes/admin_header.php') ?>



<?php
    $search = '';
    if(isset($_GET['search'])) { $search=$_GET['search']; }
    $customers = $con->get_customers($search);
?>



<div class="card text-dark" id="page" data-page="Customers">
    <div class="card-header">
        Customer Accounts
    </div>
    <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class=" table-responsive ">
                        <table class="table table-bordered table-striped table-hover table-sm ">
                            <thead class="">
                                <tr>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Contact</th>
                                    <th>Address</th>
                                    <!-- <th>Status</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(($customers)!="no result"){?>
                                    <?php foreach($customers as $tr){?>
                                        <tr>
                                            <td><?=$tr->email?></td>
                                            <td><?=$tr->fname?> <?=$tr->mname?> <?=$tr->lname?></td>
                                            <td><?=$tr->gender?></td>
                                            <td><?=$tr->contact?></td>
                                            <td><?=$tr->street_no?> <?=$tr->village?> <?=$tr->city?> <?=$tr->zipcode?></td>
                                        </tr>
                                    <?php }?>
                                <?php } else {?>
                                    <tr>
                                        <td class=" text-center" colspan="5"><h4>No available record</h4></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
        
                </div>
            </div>
    </div>
</div>









<?php include_once('../includes/admin_footer.php') ?>
