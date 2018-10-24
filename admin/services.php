<?php include_once('../includes/admin_header.php') ?>

<?php
    $search = '';
    if(isset($_GET['search'])) { $search=$_GET['search']; }
    $services = $con->get_services($search);
?>

<div class="card text-dark" id="page" data-page="Services">
    <div class="card-header">
        Settings: Services and Rate
        <button data-toggle="modal" data-target="#myModal" class="btn btn-success float-right btn-sm" type="button"><i class="fa  fa-plus-circle" aria-hidden="true"></i> Add service</button>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class=" table-responsive ">
                    <table class="table table-bordered table-striped table-hover table-sm ">
                        <thead class="">
                            <tr>
                                <th>Category</th>
                                <th>Service Name</th>
                                <th>Price Rate (PHP)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(($services)!="no result"){?>
                                <?php foreach($services as $tr){?>
                                    <tr>
                                        <td><?=$tr->category?></td>
                                        <td><?=$tr->name?> </td>
                                        <td><?=$tr->price?></td>
                                        <td>
                                            <button class="btn btn-primary btn-sm viewBtn" data-category="<?=$tr->category?>" data-name="<?=$tr->name?>" data-price="<?=$tr->price?>" data-id="<?=$tr->id?>" type="button"><i class="fa fa-edit" aria-hidden="true"></i></button>
                                            <button class="btn btn-danger btn-sm btndelete" data-id="<?=$tr->id?>" type="button"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
                <form id="serviceForm">
                    <input type="hidden" name="f" value="<?=$con->en_dec('en','save_new_service');?>">
                    <div class="form-group">
                        <label for="my-input">Category</label>
                        <select name="category" id="my-input" required class="form-control">
                            <option value="" selected hidden>Select Category</option>
                            <option value="Carpentry">Carpentry</option>
                            <option value="Electrical">Electrical</option>
                            <option value="Plumbing">Plumbing</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="my-input">Service Name</label>
                        <input name="name" class="form-control" type="text" required>
                    </div>
                    <div class="form-group">
                        <label for="my-input">Price Rate (PHP)</label>
                        <input name="price" class="form-control" type="number" >
                    </div>
                    <button class="btn btn-success float-right" type="submit">Save New Service <i class="fa fa-save" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade text-dark" id="updateModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6>Edit Service Info</h6>
            </div>
            <div class="modal-body">
                <form id="update_service">
                    <input type="hidden" name="f" value="<?=$con->en_dec('en','update_service');?>">
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="my-input">Category</label>
                        <select name="category" id="my-input" required class="form-control">
                            <option value="" selected hidden>Select Category</option>
                            <option value="Carpentry">Carpentry</option>
                            <option value="Electrical">Electrical</option>
                            <option value="Plumbing">Plumbing</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="my-input">Service Name</label>
                        <input name="name" class="form-control" type="text" required>
                    </div>
                    <div class="form-group">
                        <label for="my-input">Price Rate (PHP)</label>
                        <input name="price" class="form-control" type="number" >
                    </div>
                    <button class="btn btn-success float-right" type="submit">Save Changes <i class="fa fa-save" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>





<?php include_once('../includes/admin_footer.php') ?>


<script>
    $(function(){
        $("#serviceForm").submit(function (e) { 
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
        $("#update_service").submit(function (e) {
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
                        location.reload()
                    }
                });
            }
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
                var f = "<?=$con->en_dec('en','delete_service')?>"
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
            var id = $(this).data('id');
            var name = $(this).data('name');
            var category = $(this).data('category');
            var price = $(this).data('price');

            $("#updateModal input[name='id']").val(id)
            $("#updateModal input[name='name']").val(name)
            $("#updateModal input[name='price']").val(price)
            $("#updateModal select[name='category']").val(category)

        });
    })
</script>