<?php include_once('../includes/admin_header.php') ?>

<?php
    $search = '';
    if(isset($_GET['search'])) { $search=$_GET['search']; }
    $admins = $con->get_admins($search);
?>


<div class="card text-dark" id="page" data-page="Profile">
    <div class="card-header">
        Profile Information
    </div>
    <div class="card-body">
    <form class="form-update">
            <input type="hidden" name="f" value="<?=$con->en_dec('en','update_user')?>">
            <div class=" form-group">
                <label>Username </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">@</span>
                    </div>
                    <input class=" form-control" value="<?=$con->user_info->email?>" type="text" name="email" placeholder="Username" required>
                </div>
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
            <br>
            <button class="btn btn-success float-right btnUpdate" type="submit">Save Changes <i class="fa fa-save"></i></button>
            <button class="btn btn-link " data-toggle="modal" data-target="#cpassword" type="button">Change Password <i class="fa fa-lock"></i></button>
        </form>
    </div>
</div>



<div class="modal fade text-dark" id="cpassword">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6>Change Password</h6>
            </div>
            <div class="modal-body">
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
                    <button class="btn btn-success float-right " type="submit">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>





<?php include_once('../includes/admin_footer.php') ?>


<script>
    $(function(){
        $("input[name='email']").on('input', function () {
            $("input[name='password']").val($(this).val());
        });
        $(".form-update").submit(function (e) { 
            e.preventDefault();
            var conf = confirm('Are you sure you want to save changes?')
            if(conf){
                    var serial = $(this).serialize();
                    $.ajax({
                        type: "POST",
                    url: "../app/ajax_call.php",
                    data: serial,
                    success: function (response) {
                        alert('Profile successfully updated');
                        location.reload()
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
                    url: "../app/ajax_call.php",
                    data: serial,
                    success: function (response) {
                        var data = JSON.parse(response);
                        alert(data.msg)
                        if(data.success==1){
                            $("#cpassword").modal('hide')
                            $(".form-security").find("input").val('')
                        }
                    }
                });
            }
        });
    })
</script>