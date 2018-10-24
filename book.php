<?php include_once('./includes/header.php') ?>

<?php $services = $con->get_services();?>






<div class="container-fluid" id="content" data-page="" data-subpage="register">
    <br>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form method="POST" class="form-book text-dark">
                <input type="hidden" name="f" value="<?=$con->en_dec('en','book')?>">
                <div class="card">
                    <div class="card-header">
                        <h1 class="h3 font-weight-normal">Book Schedule for Contract Signing</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="my-input">First Name</label>
                                    <input class=" form-control" type="text" value="<?=$con->user_info->fname?>" readonly name="fname" placeholder="First Name"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="my-input">Middle Name</label>
                                    <input class=" form-control" type="text" value="<?=$con->user_info->mname?>" readonly name="mname" placeholder="Middle Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="my-input">Last Name</label>
                                    <input class=" form-control" type="text" value="<?=$con->user_info->lname?>" readonly name="lname" placeholder="Last Name"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="my-input">Email</label>
                                    <input class=" form-control" type="email" value="<?=$con->user_info->email?>" readonly name="email" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="my-input">Contact</label>
                                    <input class=" form-control" type="number" value="<?=$con->user_info->contact?>" readonly name="contact" placeholder="Contact No."
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="my-input">Street No.</label>
                                    <input class=" form-control" type="text" value="<?=$con->user_info->street_no?>" readonly name="street_no" placeholder="Street No."
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="my-input">Village/ Barangay</label>
                                    <input class=" form-control" type="text" name="village" value="<?=$con->user_info->village?>" readonly placeholder="Village/ Barangay"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="my-input">City</label>
                                    <input class=" form-control" type="text" name="city" value="<?=$con->user_info->city?>" readonly placeholder="City" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="my-input">Zipcode</label>
                                    <input class=" form-control" type="text" name="zipcode" value="<?=$con->user_info->zipcode?>" readonly placeholder="Zipcode"
                                        required>
                                </div>
                            </div>
                        </div>
                        <h4>Services: </h4>
                        <span class=" badge-info">Instruction: Please choose the service you need and check the specific offers you want to avail.</span>
                        <br>
                        <div class="row">
                            
                        
                            <div class=" col-md-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="s1">
                                    <label class="form-check-label" for="s1">Carpentry</label>
                                </div>
                            </div>
                            <div class=" col-md-6 s1_under">
                                <?php foreach($services as $ss){ if($ss->category=="Carpentry"){?>
                                    <div class="form-check">
                                        <input disabled type="checkbox" data-value="<?=$ss->price?>"  name="carpentry[]"  value="<?=$ss->name?> - P<?=$ss->price?>"  class="form-check-input" id="<?=$ss->name?>">
                                        <label class="form-check-label" for="<?=$ss->name?>"><?=$ss->name?> - P<?=number_format($ss->price,2)?></label>
                                    </div>
                                <?php } }?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class=" col-md-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="s2">
                                    <label class="form-check-label" for="s2">Plumbing</label>
                                </div>
                            </div>
                            <div class=" col-md-6 s2_under">
                                <?php foreach($services as $ss){ if($ss->category=="Plumbing"){?>
                                    <div class="form-check">
                                        <input disabled type="checkbox" data-value="<?=$ss->price?>"  name="plumbing[]"  value="<?=$ss->name?> - P<?=$ss->price?>"  class="form-check-input" id="<?=$ss->name?>">
                                        <label class="form-check-label" for="<?=$ss->name?>"><?=$ss->name?> - P<?=number_format($ss->price,2)?></label>
                                    </div>
                                <?php } }?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class=" col-md-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="s3">
                                    <label class="form-check-label" for="s3">Electrical</label>
                                </div>
                            </div>
                            <div class=" col-md-6 s3_under">
                                <?php foreach($services as $ss){ if($ss->category=="Electrical"){?>
                                    <div class="form-check">
                                        <input disabled type="checkbox" data-value="<?=$ss->price?>"  name="electrical[]"  value="<?=$ss->name?> - P<?=$ss->price?>"  class="form-check-input" id="<?=$ss->name?>">
                                        <label class="form-check-label" for="<?=$ss->name?>"><?=$ss->name?> - P<?=number_format($ss->price,2)?></label>
                                    </div>
                                <?php } }?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="my-input">Estimated Rate</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">₱</span>
                                        </div>
                                        <input class="form-control text-right" readonly name="estimated_rate" value="0.00" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-6">
                                <div class="form-group">
                                    <label for="my-input">Mode of Payment</label>
                                    <select name="payment" id="my-input" class="form-control">
                                            <option value="Remittance" selected>Remittance</option>
                                            <option value="Bank Payment">Bank Payment (BPI)</option>
                                            <option value="Paymaya">Paymaya</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <label>
                            <input type="checkbox" class="agreechk">
                            I understand and agree to the AJA Home Services Inc. <a target="_blank" href="terms.php"> Terms and conditions</a>
                        </label>
                        <button disabled class="btn btn-lg btn-success btn-block btnBook" type="submit">Book for Contract Signing</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>















<?php include_once('./includes/footer.php') ?>


<script>

    $(".agreechk").change(function(){
       if($(this).is(":checked")){
       
           $(".btnBook").attr('disabled',false);
       } else {
           $(".btnBook").attr('disabled',true);
       }
    })

    $(".form-book").submit(function (e) {
        e.preventDefault();
        var serial = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "./app/ajax_call.php",
            data: serial,
            beforeSend: function(){
                $(".btnBook").html('Please wait ...');  
            },
            success: function (response) {
                var data = JSON.parse(response);
                alert(data.msg)
                location.href="transactions.php"
            }
        });
    });



    $("#s1").on('change', function () {
        if ($(this).is(":checked")) {
            $(".s1_under input[type='checkbox']").prop('disabled', false);
        } else {
            $(".s1_under input[type='checkbox']").prop('disabled', true);
        }
    });

    $("#s2").on('change', function () {
        if ($(this).is(":checked")) {
            $(".s2_under input[type='checkbox']").prop('disabled', false);
        } else {
            $(".s2_under input[type='checkbox']").prop('disabled', true);
        }
    });

    $("#s3").on('change', function () {
        if ($(this).is(":checked")) {
            $(".s3_under input[type='checkbox']").prop('disabled', false);
        } else {
            $(".s3_under input[type='checkbox']").prop('disabled', true);
        }
    });



    var est = 0;
    $(".s1_under input[type='checkbox'], .s2_under input[type='checkbox'], .s3_under input[type='checkbox']").on('change', function () {
        var val = $(this).data('value');
        if ($(this).is(":checked")) {
           est += parseInt(val);
        } else {
            est -= parseInt(val);
        }
        $("[name=estimated_rate]").val(est);
    })

</script>