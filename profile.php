<?php include_once('./includes/header.php') ?>








<div class="container-fluid" id="content" data-page="signin" data-subpage="profile">

    <div class="container" id="content" data-page="signin" data-subpage="signin">
        <br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">

                <div class="card text-dark">
                    <div class="card-header">
                        <h4>Update Profile</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Security</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <br>
                                <form class="form-update">
                                    <input type="hidden" name="f" value="<?=$con->en_dec('en','update_user')?>">
                                    <div class=" form-group">
                                        <label>Username </label>
                                        <input class=" form-control" value="<?=$con->user_info->email?>" type="text" name="email" placeholder="Username" required>
                                    </div>
                                    <div class=" form-group">
                                        <label>First Name</label>
                                        <input class=" form-control" value="<?=$con->user_info->fname?>" type="text" name="fname" placeholder="First Name" required>
                                    </div>
                                    <div class=" form-group">
                                        <label>Middle Name</label>
                                        <input class=" form-control" value="<?=$con->user_info->mname?>" type="text" name="mname" placeholder="Middle Name">
                                    </div>
                                    <div class=" form-group">
                                        <label>Last Name</label>
                                        <input class=" form-control" value="<?=$con->user_info->lname?>" type="text" name="lname" placeholder="Last Name" required>
                                    </div>
                                    <div class=" form-group">
                                        <label>Gender</label>
                                        <select name="gender" class=" form-control" id="" required>
                                    <option value="" selected hidden>Select Gender</option>
                                    <option value="Male" <?=($con->user_info->gender=="Male")?"selected":""?>>Male</option>
                                    <option value="Female" <?=($con->user_info->gender=="Female")?"selected":""?>>Female</option>
                                    </select>
                                    </div>
                                    <div class=" form-group">
                                        <label>Contact No.</label>
                                        <input class=" form-control" value="<?=$con->user_info->contact?>" type="number" name="contact" placeholder="Contact No."
                                            required>
                                    </div>
                                    <div class=" form-group">
                                        <label>Street No.</label>
                                        <input class=" form-control" value="<?=$con->user_info->street_no?>" type="text" name="street_no" placeholder="Street No."
                                            required>
                                    </div>
                                    <div class=" form-group">
                                        <label>Village/Barangay</label>
                                        <input class=" form-control" value="<?=$con->user_info->village?>" type="text" name="village" placeholder="Village/ Barangay"
                                            required>
                                    </div>
                                    <div class=" form-group">
                                        <label>City</label>
                                        <input class=" form-control" value="<?=$con->user_info->city?>" type="text" name="city" placeholder="City" required>
                                    </div>
                                    <div class=" form-group">
                                        <label>Zipcode</label>
                                        <input class=" form-control" value="<?=$con->user_info->zipcode?>" type="text" name="zipcode" placeholder="Zipcode" required>
                                    </div>
                                    <br>
                                    <button class="btn btn-lg btn-primary btn-block btnUpdate" type="submit">Save Changes</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <br>
                                <form class="form-security">
                                    <input type="hidden" name="f" value="<?=$con->en_dec('en','change_pass')?>">
                                    <div class=" form-group">
                                        <label>Current Password</label>
                                        <input class=" form-control" type="password" name="old_password" placeholder="Current Password" required>
                                    </div>
                                    <div class=" form-group">
                                        <label>New Password</label>
                                        <input class=" form-control" type="password" name="password" placeholder="New Password" required>
                                    </div>
                                    <div class=" form-group">
                                        <label>Confirm New Password</label>
                                        <input class=" form-control" type="password" name="password_confirmation" placeholder="New Password Confirmation" required>
                                    </div>
                                    <br>
                                    <button class="btn btn-lg btn-primary btn-block " type="submit">Save Changes</button>
                                </form>
                            </div>
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
        var cc = confirm('Are you sure you want save changes?');
        if (cc) {
            $.ajax({
                type: "POST",
                url: "./app/ajax_call.php",
                data: serial,
                success: function (response) {
                    var data = JSON.parse(response);
                    alert(data.msg)
                }
            });
        }
    });


    $(".form-security").submit(function (e) {
        e.preventDefault();
        var serial = $(this).serialize();
        var cc = confirm('Are you sure you want save changes?');
        if (cc) {
            $.ajax({
                type: "POST",
                url: "./app/ajax_call.php",
                data: serial,
                success: function (response) {
                    var data = JSON.parse(response);

                    alert(data.msg)
                }
            });
        }
    });

    var hash = window.location.hash;
    $("a[href='" + hash + "']").click();

</script>