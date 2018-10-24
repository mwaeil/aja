<?php include_once('./includes/header.php') ?>





<div class="container" id="content" data-page="signin" data-subpage="signin">
    <br>
    <br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card text-dark">
                <div class="card-header">
                    <h5 class="modal-title">Send Payment Information</h5>
                </div>
                <div class="card-body ">
                    <form id="formSendProof">
                        <input type="hidden" name="book_id"  value="<?=$_GET['id']?>">
                        <input type="hidden" name="payment_type"  value="<?=$_GET['mode']?>">
                        <input type="hidden" name="f" value="<?=$con->en_dec('en','send_payment_proof2')?>">
                            <?php if($_GET['mode']=="Remittance"){ $p=$con->get_remit_info();?>
                                <div class="form-group">
                                    <label for="my-input">Sender Name:</label>
                                    <input id="my-input" class="form-control" name="pname"   type="text"  required>
                                </div>
                                <div class="form-group">
                                    <label for="my-input">Reference No/Transaction Code/Control No: </label>
                                    <input id="my-input" class="form-control" name="pcode" type="text" required>
                                </div>
                                <div class="form-group">
                                    <label for="my-input">Amount Sent: </label>
                                    <input id="my-input" class="form-control" name="pamount" type="number" required>
                                </div>
                            <?php } elseif($_GET['mode']=="Bank Payment"){ $p=$con->get_bank_info();?>
                                <div class="form-group">
                                    <label for="my-input">Account Name of Sender:</label>
                                    <input id="my-input" class="form-control" name="pname"   type="text"  required>
                                </div>
                                <div class="form-group">
                                    <label for="my-input">Reference No/Transaction Code/Control No: </label>
                                    <input id="my-input" class="form-control" name="pcode" type="text" required>
                                </div>
                                <div class="form-group">
                                    <label for="my-input">Amount Sent: </label>
                                    <input id="my-input" class="form-control" name="pamount" type="number" required>
                                </div>
                            <?php } elseif($_GET['mode']=="Paymaya"){ $p=$con->get_paymaya_info();?>
                                <div class="form-group">
                                    <label for="my-input">Account Name of Sender:</label>
                                    <input id="my-input" class="form-control" name="pname"   type="text"  required>
                                </div>
                                <div class="form-group">
                                    <label for="my-input">Reference No/Transaction Code/Control No: </label>
                                    <input id="my-input" class="form-control" name="pcode" type="text" required>
                                </div>
                                <div class="form-group">
                                    <label for="my-input">Amount Sent: </label>
                                    <input id="my-input" class="form-control" name="pamount" type="number" required>
                                </div>
                            <?php }?>
                        <button class="btn btn-success btn-block" type="submit">Send <i class="fa fa-send" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>






<?php include_once('./includes/footer.php') ?>




<script>
    $(function () {

        $("#formSendProof").submit(function (e) {
            e.preventDefault();
            var serial = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "./app/ajax_call.php",
                data: serial,
                success: function (response) {
                alert('Payment Sent! ')
                location.href = 'transactions.php'
                }
            });

        });

    })

</script>