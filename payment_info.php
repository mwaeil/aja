<?php include_once('./includes/header.php') ?>








<div class="container" id="content" data-page="signin" data-subpage="signin">
    <br>
    <br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card text-dark">
                <div class="card-header">
                    <h5 class="modal-title">Payment Information</h5>
                </div>
                <div class="card-body ">
                <div class="alert alert-success">
                    After the contract signing, please pay the amount that has been discussed using these details through <u><?=$_GET['mode']?></u>
                     <!-- and send <a href="payment.php?mode=<?=$_GET['mode']?>&id=<?=$_GET['id']?>">the details here</a>. Thank you! -->
                </div>
                    <?php if($_GET['mode']=="Remittance"){ $p=$con->get_remit_info();?>
                        <div class="form-group">
                            <label for="my-input">Pay Through:</label>
                            <input id="my-input" class="form-control" name="acc_number"  value="<?=$_GET['mode']?>" type="text" readonly>
                        </div>
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
                    <?php } elseif($_GET['mode']=="Bank Payment"){ $p=$con->get_bank_info();?>
                        <div class="form-group">
                            <label for="my-input">Account Name:</label>
                            <input id="my-input" class="form-control" value="<?=$p->name?>" type="text" readonly>
                        </div>
                        <div class="form-group">
                            <label for="my-input">Account No: </label>
                            <input id="my-input" class="form-control" value="<?=$p->no?>" type="text" readonly>
                        </div>
                    <?php } elseif($_GET['mode']=="Paymaya"){ $p=$con->get_paymaya_info();?>
                        <div class="form-group">
                            <label for="my-input">Paymaya No: </label>
                            <input id="my-input" class="form-control" name="place" value="<?=$p->no?>" type="text" readonly>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>






<?php include_once('./includes/footer.php') ?>




<script>
    $(function () {

        $(".form-signin").submit(function (e) {
            e.preventDefault();
            var serial = $(this).serialize();

            $.ajax({
                type: "POST",
                url: "./app/ajax_call.php",
                data: serial,
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data.success == 1) {
                        alert('Logged in successfully')
                        location.href = data.redirect
                    } else {
                        alert('Log in failed. Please try again.')
                    }
                }
            });

        });

    })

</script>