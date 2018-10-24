<?php include_once('./includes/header.php') ?>








<div class="container-fluid" id="content" data-page="register" data-subpage="register">


    <div class="container" id="content" data-page="signin" data-subpage="signin">
        <br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form class="form-signup text-dark">
                    <input type="hidden" name="f" value="<?=$con->en_dec('en','signup')?>">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="h3 font-weight-normal">Registration Form</h1>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-danger msg " style="display:none">
                            </div>
                            <div class="alert alert-success msgsuccess " style="display:none">
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="my-input">Username</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">@</span>
                                            </div>
                                            <input class=" form-control" type="text" name="email" placeholder="Username" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="my-input">Password</label>
                                        <input class=" form-control" type="password" name="password" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="my-input">Confirm Password</label>
                                        <input class=" form-control" type="password" name="password_confirmation" placeholder="Password Confirmation" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="my-input">First Name</label>
                                        <input class=" form-control" type="text" name="fname" placeholder="First Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="my-input">Middle Name</label>
                                        <input class=" form-control" type="text" name="mname" placeholder="Middle Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="my-input">Last Name</label>
                                        <input class=" form-control" type="text" name="lname" placeholder="Last Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="my-input">Gender</label>
                                        <select name="gender" class=" form-control" id="" required>
                                            <option value="" selected hidden>Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="my-input">Contact</label>
                                        <input class=" form-control" type="number" name="contact" placeholder="Contact No." required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="my-input">Street No.</label>
                                        <input class=" form-control" type="text" name="street_no" placeholder="Street No." required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="my-input">Village/ Barangay</label>
                                        <input class=" form-control" type="text" name="village" placeholder="Village/ Barangay" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="my-input">City</label>
                                        <input class=" form-control" type="text" name="city" placeholder="City" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="my-input">Zipcode</label>
                                        <input class=" form-control" type="text" name="zipcode" placeholder="Zipcode" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-lg btn-primary btn-block btnSignup" type="submit">Sign up</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>















<?php include_once('./includes/footer.php') ?>


<script>
    $(".form-signup").submit(function (e) {
        e.preventDefault();
        var serial = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "./app/ajax_call.php",
            data: serial,
            success: function (response) {
                var data = JSON.parse(response);
                // alert(data.msg)
                if(data.success==1){
                    $(".form-signup").find('input,select').val('');
                    $("html, body").animate({ scrollTop: 0 }, "fast");
                    $(".msgsuccess").fadeIn();
                    $(".msg").fadeOut();
                    $(".msgsuccess").html('<i class="fa fa-check"></i> You have successfully registered. Please wait, you will redirected to login page.');
                    setTimeout(function() {
                        location.href="signin.php"
                    }, 6000);
                } else {
                    $("html, body").animate({ scrollTop: 0 }, "fast");
                    $(".msg").fadeIn();
                    $(".msgsuccess").fadeOut();
                    $(".msg").html(data.msg);
                }
                
            }
        });
    });

</script>