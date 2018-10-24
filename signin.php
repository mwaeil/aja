<?php include_once('./includes/header.php') ?>








<div class="container" id="content" data-page="signin" data-subpage="signin">
    <br>
    <br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form class="form-signin text-dark">
                <div class="card">
                    <div class="card-header">
                        Log In
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger msg " style="display:none">
                        </div>
                        <div class="alert alert-success msgsuccess " style="display:none">
                        </div>
                        <input type="hidden" name="f" value="<?=$con->en_dec('en','signin')?>">
                        <div class="form-group">
                            <label for="my-input">Username</label>
                            <input name="email" type="text" id="inputEmail" class="form-control" placeholder="Username" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="my-input">Password</label>
                            <input name="pass" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-lg btn-primary btn-block btnLogin" type="submit">Sign in</button>
                    </div>
                </div>
            </form>
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
                beforeSend: function(){
                    $(".msg").fadeOut();
                },
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data.success == 1) {
                        $(".msg").fadeOut();
                        $(".msgsuccess").fadeIn();
                        $(".msgsuccess").html('<i class="fa fa-check"></i> Successfully Logged in.');
                        $("#inputPassword").val(''); 
                        setTimeout(function() {
                            location.href = data.redirect
                        }, 1000);
                    } else {
                        $("html, body").animate({ scrollTop: 0 }, "fast");
                        $(".msg").fadeIn();
                        $(".msgsuccess").fadeOut();
                        $(".msg").html('Log in failed. Please try again');
                        $("#inputPassword").val('');   
                    }
                }
            });

        });

    })

</script>