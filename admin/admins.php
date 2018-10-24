<?php include_once('../includes/admin_header.php') ?>

<?php
    $search = '';
    if(isset($_GET['search'])) { $search=$_GET['search']; }
    $admins = $con->get_admins($search);
?>


<div class="card text-dark" id="page" data-page="Admins">
    <div class="card-header">
        Admin Accounts
        <button data-toggle="modal" data-target="#myModal" class="btn btn-success float-right btn-sm" type="button"><i class="fa fa-user-plus" aria-hidden="true"></i> Add account</button>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class=" table-responsive ">
                    <table class="table table-bordered table-striped table-hover table-sm ">
                        <thead class="">
                            <tr>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(($admins)!="no result"){?>
                                <?php foreach($admins as $tr){?>
                                    <tr>
                                        <td><?=$tr->email?></td>
                                        <td><?=$tr->fname?> <?=$tr->mname?> <?=$tr->lname?></td>
                                        <td><?=$tr->gender?></td>
                                        <td>
                                            <button class="btn btn-primary btn-sm viewBtn" data-email="<?=$tr->email?>" data-fname="<?=$tr->fname?>" data-mname="<?=$tr->mname?>" data-lname="<?=$tr->lname?>" data-gender="<?=$tr->gender?>" data-password="<?=$tr->password?>" type="button"><i class="fa fa-edit" aria-hidden="true"></i></button>
                                            <?php if($tr->email!=$_SESSION['email']){?>
                                            <button class="btn btn-danger btn-sm btndelete" data-id="<?=$tr->email?>" type="button"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            <?php }?>
                                        </td>
                                    </tr>
                                <?php }?>
                            <?php } else {?>
                                <tr>
                                    <td class=" text-center" colspan="5"><h4>No available record</h4></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
    
            </div>
        </div>
    </div>
</div>



<div class="modal fade text-dark" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6>Add admin account</h6>
            </div>
            <div class="modal-body">
                <form id="adminaccount">
                    <input type="hidden" name="f" value="<?=$con->en_dec('en','save_new_admin');?>">
                    <div class="form-group">
                        <label for="my-input">Username</label>
                        <input name="email" class="form-control" type="text" required>
                    </div>
                    <div class="form-group">
                        <label for="my-input">First Name</label>
                        <input name="fname" class="form-control" type="text" required>
                    </div>
                    <div class="form-group">
                        <label for="my-input">Middle Name</label>
                        <input name="mname" class="form-control" type="text" >
                    </div>
                    <div class="form-group">
                        <label for="my-input">Last Name</label>
                        <input name="lname" class="form-control" type="text" required>
                    </div>
                    <div class="form-group">
                        <label for="my-input">Gender</label>
                        <select id="my-input" class="form-control" required name="gender">
                            <option value="" selected hidden>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="my-input">Password</label>
                        <input name="password" readonly required class="form-control" type="password">
                    </div>
                    <button class="btn btn-success float-right" type="submit">Save New Account <i class="fa fa-save" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade text-dark" id="updateModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6>Edit admin account</h6>
            </div>
            <div class="modal-body">
                <button class="btn btn-danger btnreset" type="button">Reset Password? <i class="fa fa-unlock" aria-hidden="true"></i></button>
                <hr>
                <form class="form-update">
                    <input name="old_email" class="form-control" type="hidden" required>
                    <input type="hidden" name="f" value="<?=$con->en_dec('en','update_admin_user');?>">
                    <div class="form-group">
                        <label for="my-input">Username</label>
                        <input name="email" class="form-control" type="text" required>
                    </div>
                    <div class="form-group">
                        <label for="my-input">First Name</label>
                        <input name="fname" class="form-control" type="text" required>
                    </div>
                    <div class="form-group">
                        <label for="my-input">Middle Name</label>
                        <input name="mname" class="form-control" type="text" >
                    </div>
                    <div class="form-group">
                        <label for="my-input">Last Name</label>
                        <input name="lname" class="form-control" type="text" required>
                    </div>
                    <div class="form-group">
                        <label for="my-input">Gender</label>
                        <select id="my-input" class="form-control" required name="gender">
                            <option value="" selected hidden>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group">
                        <button class="btn btn-success float-right" type="submit">Save Changes <i class="fa fa-save" aria-hidden="true"></i></button>
                    </div>
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
        $("#adminaccount").submit(function (e) { 
            e.preventDefault();
            var serial = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "../app/ajax_call.php",
                data: serial,
                success: function (response) {
                    location.reload()
                }
            });
        });
        $(".form-update").submit(function (e) {
            e.preventDefault();
            var serial = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "../app/ajax_call.php",
                data: serial,
                success: function (response) {
                    location.reload()
                }
            });
        });
        $(".btnreset").click(function (e) { 
            e.preventDefault();
            var email = $("#updateModal input[name='email']").val()
            var f = "<?=$con->en_dec('en','reset_password')?>"
            $.ajax({
                type: "POST",
                url: "../app/ajax_call.php",
                data: {email,f},
                success: function (response) {
                    alert('Password Reset Successful')
                    location.reload()
                }
            });
        });
        $(".btndelete").click(function (e) { 
            e.preventDefault();
            var conf = confirm('Are you sure you want to delete this account ? ')
            if(conf){
                var id = $(this).data('id');
                var f = "<?=$con->en_dec('en','delete_account')?>"
                $.ajax({
                    type: "POST",
                    url: "../app/ajax_call.php",
                    data: {id,f},
                    success: function (response) {
                        alert('Account deleted')
                        location.reload()
                    }
                });
            }
        });
        $(".viewBtn").click(function (e) { 
            e.preventDefault();
            $("#updateModal").modal('show')
            var email = $(this).data('email');
            var fname = $(this).data('fname');
            var mname = $(this).data('mname');
            var lname = $(this).data('lname');
            var gender = $(this).data('gender');

            $("#updateModal input[name='email']").val(email)
            $("#updateModal input[name='old_email']").val(email)
            $("#updateModal input[name='fname']").val(fname)
            $("#updateModal input[name='mname']").val(mname)
            $("#updateModal input[name='lname']").val(lname)
            $("#updateModal select[name='gender']").val(gender)

        });
    })
</script>