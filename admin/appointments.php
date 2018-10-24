<?php include_once('../includes/admin_header.php') ?>

<?php
    $search = '';
    if(isset($_GET['search'])) {$search=$_GET['search'];}
    $trans = $con->get_transactions($search); 
?>


<div class="card text-dark" id="page" data-page="Appointments">
    <div class="card-header">
        Appointments
    </div>
    <div class="card-body">
    <div class=" table-responsive nowrap">
                        <table class="table table-bordered table-striped table-hover table-sm ">
                            <thead class="">
                                <tr>
                                    <th>Date Submitted</th>
                                    <th>Customer</th>
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
                                            <td><a href="customers.php?search=<?=$tr->email?>"><?=$tr->email?></a></td>
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
                                            <td><?=$tr->payment?></td>
                                            <td>
                                                <?php if($tr->status==0) {?>
                                                    <span class="badge badge-warning"> Pending</span>
                                                <?php }?>
                                                <?php if($tr->status==1) {?>
                                                    <span class="badge badge-info"> Approved <small>Schedule sent</small></span>
                                                <?php }?>
                                                <?php if($tr->status==2) {?>
                                                    <span class="badge badge-danger"> Declined</span>
                                                <?php }?>
                                                <?php if($tr->status==3) {?>
                                                    <span class="badge badge-secondary"> 1st Payment Sent</span>
                                                <?php }?>
                                                <?php if($tr->status==4) {?>
                                                    <span class="badge badge-success"> Payment Completed</span>
                                                <?php }?>
                                                <!-- <?php if($tr->status==3) echo "1st Payment Sent";if($tr->status==4) echo "Payment Completed";if($tr->status==0) echo "Pending";if($tr->status==1) echo "Approved";if($tr->status==2) echo "Declined";?> -->
                                            </td>
                                            <td>
                                                <div class=""> <!-- btn-group btn-group-sm -->
                                                    <?php if($tr->status==0) {?>
                                                        <a href="acceptance.php?id=<?=$tr->id?>" style="width:49%"  class="btn btn-success btn-sm " >Accept</a>
                                                        <button data-id="<?=$tr->id?>" style="width:49%"  class="btn btn-danger btndecline btn-sm" <?=$tr->status==1?"disabled":""?> <?=$tr->status==2?"disabled":""?> type="button">Decline</button>
                                                    <?php }?>
                                                    <?php if($tr->status==1){?>
                                                        <a href="acceptance.php?id=<?=$tr->id?>&view=1"  class="btn btn-info  btn-sm  btn-block" >View</a>
                                                    <?php } ?>
                                                    <?php if($tr->status==2){?>
                                                        <a href="acceptance.php?id=<?=$tr->id?>"  class="btn btn-success btn-sm  btn-block" >Re-accept</a>
                                                    <?php } ?>
                                                    <?php if($tr->status==3){?>
                                                        <a href="payment_info.php?id=<?=$tr->id?>&mode=<?=$tr->payment?>"  class="btn btn-primary btn-sm " >View 1st Payment</a>
                                                        <a href="payment_info2.php?id=<?=$tr->id?>&mode=<?=$tr->payment?>" disabled  class="btn btn-info  btn-sm disabled " >View 2nd Payment</a>
                                                    <?php } ?>
                                                    <?php if($tr->status==4){?>
                                                        <a href="payment_info.php?id=<?=$tr->id?>&mode=<?=$tr->payment?>"  style="width:49%"  class="btn   btn-primary btn-sm " >View 1st Payment</a>
                                                        <a href="payment_info2.php?id=<?=$tr->id?>&mode=<?=$tr->payment?>"  style="width:49%"  class="btn btn-info  btn-sm " >View 2nd Payment</a>
                                                    <?php } ?>
                                                        
                                                </div>
                                            </td>
                                        </tr>
                                    <?php }?>
                                <?php } else {?>
                                    <tr>
                                        <td class=" text-center" colspan="7">No record</td>
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




<div id="dialog"  title="Decline">
    <div class="form-group">
        <label for="my-input">Reason</label>
        <textarea id="reasonTxt" class="form-control" rows="3"></textarea>
    </div>
</div>




<?php include_once('../includes/admin_footer.php') ?>


<script>

    $(".btnapprove").click(function (e) { 
        e.preventDefault();
        var id = $(this).data('id');
       
    });
    $(".btndecline").click(function (e) { 
        e.preventDefault();
        var id = $(this).data('id');
        $( "#dialog" ).dialog({
            resizable: false,
            height: "auto",
            width: "auto",
            draggable: false,
            modal: true,
            buttons: {
                "Decline": function() {
                    var reasons = $("#reasonTxt").val();
                    $.ajax({
                        type: "POST",
                        url: "../app/ajax_call.php",
                        data: {id,reasons,"f":"<?=$con->en_dec('en','decline_book')?>"},
                        success: function (response) {
                            location.reload()
                        }
                    });
                    // $( this ).dialog( "close" );
                },
                Cancel: function() {
                $( this ).dialog( "close" );
                }
            }
            });
        // var con = confirm('Are you sure you want to decline this schedule?');
        // if(con){
        //  
        // }
    });
</script>