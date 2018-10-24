<?php include_once('../includes/admin_header.php') ?>

<div class="card text-dark">
    <div class="card-header">
             <a href="appointments.php">Appointments</a> / Contract Signing Acceptance
    </div>
    <div class="card-body">

        <?php if(!isset($_GET['view'])){  ?>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Contract Signing Acceptance - Set Schedule</h5>
                    </div>
                    <div class="card-body">
                        <form class="accform">
                            <input type="hidden" name="f" value="<?=$con->en_dec('en','approve_book')?>">
                            <input type="hidden" name="id" value="<?=$_GET['id']?>">
                            <div class="form-group">
                                <label for="my-input">Date</label>
                                <input id="my-input" class="form-control" name="date" type="date" required>
                            </div>
                            <div class="form-group">
                                <label for="my-input">Time</label>
                                <input id="my-input" class="form-control" name="time" type="time" required>
                            </div>
                            <div class="form-group">
                                <label>Place</label>
                                <input class="form-control" name="place" type="text" required>
                            </div>
                            <button class="btn btn-success btn-block" type="submit">Approve and Send Schedule of Contract Signing <i class="fa fa-send" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
            <?php } else{ $info = $con->get_signing_info($_GET['id']); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            This transaction is waiting for the Contract Signing Acceptance meeting. The schedule of the appointment is listed below.
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Contract Signing Acceptance Schedule Info</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="my-input">Date</label>
                                    <input id="my-input" class="form-control" value="<?=$info->date?>" type="date" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="my-input">Time</label>
                                    <input id="my-input" class="form-control" value="<?=$info->time?>" type="time" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="my-input">Place</label>
                                    <input id="my-input" class="form-control" value="<?=$info->place?>" type="text" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Partial Payment</h5>
                            </div>
                            <div class="card-body">
                                <form class="paymentForm">
                                    <input type="hidden" name="f" value="<?=$con->en_dec('en','send_payment')?>">
                                    <input type="hidden" name="id" value="<?=$_GET['id']?>">
                                    
                                    <div class="form-group">
                                        <label for="my-input">Payment Type:</label>
                                        <input id="my-input" class="form-control" name="ptype" value="<?php echo $info->payment;?>" readonly type="text" required>
                                    </div>
                                    <?php if($info->payment=="Remittance"){ $p=$con->get_remit_info();?>
                                        <div class="form-group">
                                            <label for="my-input">Receiver Name:</label>
                                            <input id="my-input" class="form-control" name="acc_number"  value="<?=$p->name?>" type="text" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="my-input">Receiver Address: </label>
                                            <input id="my-input" class="form-control" name="place"  value="<?=$p->address?>" type="text" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="my-input">Receiver Contact No: </label>
                                            <input id="my-input" class="form-control" name="place" value="<?=$p->contact?>" type="text" readonly>
                                        </div>
                                    <?php } elseif($info->payment=="Bank Payment"){ $p=$con->get_bank_info();?>
                                        <div class="form-group">
                                            <label for="my-input">Account Name:</label>
                                            <input id="my-input" class="form-control" value="<?=$p->name?>" type="text" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="my-input">Account No: </label>
                                            <input id="my-input" class="form-control" value="<?=$p->no?>" type="text" readonly>
                                        </div>
                                    <?php } elseif($info->payment=="Paymaya"){ $p=$con->get_paymaya_info();?>
                                        <div class="form-group">
                                            <label for="my-input">Account No: </label>
                                            <input id="my-input" class="form-control" name="place" value="<?=$p->no?>" type="text" readonly>
                                        </div>
                                    <?php }?>
                                </form>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-success" type="button">Send Payment Info <i class="fa fa-send" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div> -->
                </div>
                
        <?php }?>
    </div>
</div>









<?php include_once('../includes/admin_footer.php') ?>


<script>
    $(".accform").submit(function (e) { 
        e.preventDefault();
        var serial = $(this).serialize();
        var con = confirm('Are you sure you want to approve this schedule?');
        if(con){
            $.ajax({
                type: "POST",
                url: "../app/ajax_call.php",
                data: serial,
                success: function (response) {
                    alert('Schedule sent!')
                    location.href="appointments.php"
                }
            });
        }
    });
</script>