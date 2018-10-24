<?php include_once('../includes/admin_header.php') ?>



<div class="card text-dark" id="page" data-page="Payment">
    <div class="card-header">
        Settings: Payment Information
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <h4>Remittance Info</h4>
                <hr>
                <form class="form">
                    <?php $p=$con->get_remit_info(); ?>
                    <input type="hidden" name="f" value="<?=$con->en_dec('en','save_payment_info')?>">
                    <input type="hidden" name="table" value="remit">
                    <div class="form-group">
                        <label for="my-input">Receiver Name:</label>
                        <input id="my-input" class="form-control" name="name"  value="<?=$p->name?>" type="text" >
                    </div>
                    <div class="form-group">
                        <label for="my-input">Receiver Address: </label>
                        <input id="my-input" class="form-control" name="address"  value="<?=$p->address?>" type="text" >
                    </div>
                    <div class="form-group">
                        <label for="my-input">Receiver Contact No: </label>
                        <input id="my-input" class="form-control" name="no" value="<?=$p->contact?>" type="text" >
                    </div>
                    <button class="btn btn-success" type="submit">Save Changes</button>
                </form>
            </div>
            <div class="col-md-4">
                <h4>Bank Info</h4>
                <hr>
                <form class="form">
                    <?php $p=$con->get_bank_info();?>
                    <input type="hidden" name="f" value="<?=$con->en_dec('en','save_payment_info')?>">
                    <input type="hidden" name="table" value="bank">
                    <div class="form-group">
                        <label for="my-input">Account Name:</label>
                        <input name="name" class="form-control" value="<?=$p->name?>" type="text" >
                    </div>
                    <div class="form-group">
                        <label for="my-input">Account No: </label>
                        <input name="no" class="form-control" value="<?=$p->no?>" type="text" >
                    </div>
                    <button class="btn btn-success" type="submit">Save Changes</button>
                </form>
            </div>
            <div class="col-md-4">
                <h4>Paymaya Info</h4>
                <hr>
                <form class="form">
                    <?php $p=$con->get_paymaya_info();?>
                    <input type="hidden" name="f" value="<?=$con->en_dec('en','save_payment_info')?>">
                    <input type="hidden" name="table" value="paymaya">
                    <div class="form-group">
                        <label for="my-input">Paymaya No: </label>
                        <input name="no" class="form-control" name="place" value="<?=$p->no?>" type="text" >
                    </div>
                    <button class="btn btn-success" type="submit">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>









<?php include_once('../includes/admin_footer.php') ?>

<script>

    $(function(){

        $(".form").submit(function (e) {
            e.preventDefault();
            var conf = confirm("Are you sure you want to save changes?")
            if(conf){
                var serial = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "../app/ajax_call.php",
                    data: serial,
                    success: function (response) {
                        alert('Saved Changes')
                        // location.reload()
                    }
                });
            }
        });


    })

</script>