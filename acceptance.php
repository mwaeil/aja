<?php include_once('./includes/header.php') ?>
<div class="container-fluid" id="content" data-page="" data-subpage="register">
    <br>
    <br>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">


            <?php $info = $con->get_signing_info($_GET['id']); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card text-dark">
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
            </div>
