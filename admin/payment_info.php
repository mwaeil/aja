<?php include_once('../includes/admin_header.php') ?>

<?php $info = $con->get_payment_info_by_book_id($_GET['id']);?>

<div class="card text-dark" id="page" data-page="Appointments">
    <div class="card-header">
        <a href="appointments.php">Appointments</a> / 1st Payment Information 
    </div>
    <div class="card-body">
        <form id="formSendProof">
                <?php if($_GET['mode']=="Remittance"){ $p=$con->get_remit_info();?>
                    <div class="form-group">
                        <label for="my-input">Sender Name:</label>
                        <input id="my-input" class="form-control" value="<?=$info->pname?>" disabled  type="text"  required>
                    </div>
                    <div class="form-group">
                        <label for="my-input">Reference No/Transaction Code/Control No: </label>
                        <input id="my-input" class="form-control" value="<?=$info->pcode?>" disabled   type="text" required>
                    </div>
                    <div class="form-group">
                        <label for="my-input">Amount Sent: </label>
                        <input id="my-input" class="form-control" value="<?=$info->pamount?>" disabled   name="pamount" type="number" required>
                    </div>
                <?php } elseif($_GET['mode']=="Bank Payment"){ $p=$con->get_bank_info();?>
                    <div class="form-group">
                        <label for="my-input">Account Name of Sender:</label>
                        <input id="my-input" class="form-control" value="<?=$info->pname?>" disabled  type="text"  required>
                    </div>
                    <div class="form-group">
                        <label for="my-input">Reference No/Transaction Code/Control No: </label>
                        <input id="my-input" class="form-control" value="<?=$info->pcode?>" disabled   type="text" required>
                    </div>
                    <div class="form-group">
                        <label for="my-input">Amount Sent: </label>
                        <input id="my-input" class="form-control" value="<?=$info->pamount?>" disabled   name="pamount" type="number" required>
                    </div>
                <?php } elseif($_GET['mode']=="Paymaya"){ $p=$con->get_paymaya_info();?>
                    <div class="form-group">
                        <label for="my-input">Account Name of Sender:</label>
                        <input id="my-input" class="form-control" value="<?=$info->pname?>" disabled  type="text"  required>
                    </div>
                    <div class="form-group">
                        <label for="my-input">Reference No/Transaction Code/Control No: </label>
                        <input id="my-input" class="form-control" value="<?=$info->pcode?>" disabled   type="text" required>
                    </div>
                    <div class="form-group">
                        <label for="my-input">Amount Sent: </label>
                        <input id="my-input" class="form-control" value="<?=$info->pamount?>" disabled   name="pamount" type="number" required>
                    </div>
                <?php }?>
            <!-- <button class="btn btn-success btn-block" type="button">Received <i class="fa fa-check" aria-hidden="true"></i></button> -->
        </form>
    </div>
</div>






<?php include_once('../includes/admin_footer.php') ?>

