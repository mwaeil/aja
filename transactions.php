<?php include_once('./includes/header.php') ?>

<?php $trans = $con->get_transactions_by_user($_SESSION['email']); ?>








<div class="container-fluid" id="content" data-page="signin" data-subpage="transactions"> 
    
<div class="container" id="content" data-page="signin" data-subpage="signin">
    <br>
    <div class="card text-dark">
        <div class="card-header">
           <h4> Transaction History</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class=" table-responsive nowrap table-bordered table-hover table-striped table-sm">
                        <table class="table ">
                            <thead class="">
                                <tr>
                                    <th>Date</th>
                                    <th>Services</th>
                                    <!-- <th>Estimated Rate</th> -->
                                    <th>Payment Mode</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(($trans)!="no result"){?>
                                    <?php foreach($trans as $tr){?>
                                        <tr>
                                            <td><?=$tr->date_created?></td>
                                            <td>
                                                <ul class=" m-0 pl-4">
                                                <?php $ser = explode(",",$tr->services);
                                                    foreach($ser as $ss){
                                                        if($ss!=" "){
                                                            echo "<li>".$ss."</li>";
                                                        }
                                                    }
                                                ?>
                                                </ul>
                                                <hr class="m-0">
                                                Estimated Rate: P<?=$tr->estimated_rate?>
                                            </td>
                                            <!-- <td><?=$tr->estimated_rate?></td> -->
                                            <td><?=$tr->payment?> <a class=" btn-link " href="payment_info.php?mode=<?=$tr->payment?>&id=<?=$tr->id?>"><i class="fa fa-info-circle"></i></a></td>
                                            <td>
                                                <!-- <?php if($tr->status==0) echo "Pending";if($tr->status==1) echo "Approved";if($tr->status==2) echo "Declined"; if($tr->status==3) echo "1st Payment Sent";if($tr->status==4) echo "Payment Completed";?> -->
                                                <?php if($tr->status==0) {?>
                                                    <span class="badge badge-warning"> Pending</span>
                                                <?php }?>
                                                <?php if($tr->status==1) {?> 
                                                    <span class="badge badge-info "> Schedule received <i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>
                                                    <br>
                                                    <small><a class="btn-link btn-sm" href="acceptance.php?id=<?=$tr->id?>">Click here to view</a></small>
                                                <?php }?>
                                                <?php if($tr->status==2) {?>
                                                    <span class="badge badge-danger"> Declined</span>
                                                <?php }?>
                                                <?php if($tr->status==3) {?>
                                                    <span class="badge  badge-secondary"> 1st Payment Sent</span>
                                                <?php }?>
                                                <?php if($tr->status==4) {?>
                                                    <span class="badge badge-success"> Payment Completed</span>
                                                <?php }?>
                                            </td>
                                            <td>
                                                <?php if($tr->status==1){?>
                                                <div class="btn-group">
                                                    <a class="btn btn-success btn-sm" href="payment.php?mode=<?=$tr->payment?>&id=<?=$tr->id?>">Send 1st Payment</a>
                                                </div>
                                                <?php } elseif($tr->status==3){ ?>
                                                    <a class="btn btn-success btn-sm" href="payment2.php?mode=<?=$tr->payment?>&id=<?=$tr->id?>">Send Balance Payment </a>
                                                <?php } else {
                                                    if($tr->status==2){
                                                        $reason = $con->get_reason($tr->id)->reason;
                                                        echo 'Reason: '. $reason;
                                                        echo "<br><small class=' text-muted '>If you have concerns please <a href='contact.php'>contact us.</a></small>";
                                                    } else {
                                                        echo "No Action"; 
                                                    }
                                                    }?>
                                            </td>

                                        </tr>
                                    <?php }?>
                                <?php } else {?>
                                    <tr>
                                        <td class=" text-center" colspan="5"><h4>No available record</h4></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th>#</th>
                                </tr>
                            </tfoot> -->
                        </table>
                    </div>
        
                </div>
            </div>
        </div>
    </div>
</div>
</div>





















<?php include_once('./includes/footer.php') ?>
<script>

$(".form-update").submit(function (e) { 
    e.preventDefault();
    var serial = $(this).serialize();
    swal({
            title: 'Are you sure you want save changes?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: "./app/ajax_call.php",
                data: serial,
                success: function (response) {
                    var data = JSON.parse(response);
                    if(data.success==1){
                        swal(
                            data.msg,
                            '',
                            'success'
                            )
                    } else {
                        swal(
                            data.msg,
                            '',
                            'warning'
                            )
                    }
                }
            });
        }
        })
});


$(".form-security").submit(function (e) { 
    e.preventDefault();
    var serial = $(this).serialize();
    swal({
            title: 'Are you sure you want save changes?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: "./app/ajax_call.php",
                data: serial,
                success: function (response) {
                    var data = JSON.parse(response);
                    if(data.success==1){
                        swal(
                            data.msg,
                            '',
                            'success'
                            )
                    } else {
                        swal(
                            data.msg,
                            '',
                            'error'
                            )
                    }
                }
            });
        }
        })
});

$(".form-card").submit(function (e) { 
    e.preventDefault();
    var serial = $(this).serialize();
    swal({
            title: 'Are you sure you want save changes?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: "./app/ajax_call.php",
                data: serial,
                success: function (response) {
                    var data = JSON.parse(response);
                    if(data.success==1){
                        swal(
                            data.msg,
                            '',
                            'success'
                            )
                    } else {
                        swal(
                            data.msg,
                            '',
                            'error'
                            )
                    }
                }
            });
        }
        })
});

var hash = window.location.hash;
$("a[href='"+hash+"']").click();


</script>