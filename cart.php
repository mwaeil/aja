<?php include_once('./includes/header.php') ?>

<?php $total=0; $items = $con->get_cart_items_by_user($_SESSION['email']); ?>






<div class="container" id="content" data-page="cart">

<br>

<h1>My Shopping Cart</h1>


    <div class=" table-responsive">
        
    <table id="cart" class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th width="60%">Item</th>
                            <th width="10%">Price</th>
                            <th width="10%">Quantity</th>
                            <th width="10%">Subtotal</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(($items)!="no result"){?>
                        <?php foreach($items as $item){?>
                        <tr>
                            <td class="row">
                                <div class=" col-sm-2  d-none d-md-block">
                                    <img src="./assets/img/products/<?=$item->img?>" class="img-fluid">
                                </div>
                                <div class=" col-sm-10">
                                    <b><?=$item->product_name?></b>
                                    <p><?=$item->description?></p>
                                </div>
                            </td>
                            <td><?=number_format($item->price,2)?></td>
                            <td><?=$item->quantity?></td>
                            <td>
                                <?php
                                    $sub = ($item->price) *($item->quantity);
                                    $total += $sub;
                                    echo number_format($sub,2);
                                ?>
                            </td>
                            <td>
                                <a href="#" data-value="<?=$con->en_dec('en',$item->cart_id)?>" class="btn btn-danger remove_cart"><span class="fa fa-trash"></span></a>
                                <a href="#" data-prev="<?=$item->quantity?>" data-value="<?=$con->en_dec('en',$item->cart_id)?>" class="btn btn-info update_cart_item"><span class="fa fa-pencil"></span></a>
                            </td>
                        </tr>
                        <?php }?>
                        <?php }?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><a href="./products.php" class="btn btn-warning ">Continue Shopping</a></td>
                            <td colspan="3" class=" text-right"><b>Total <?=number_format($total,2)?></b></td>
                            <td>
                                <?php if($con->cart_count>0){?>
                                    <a href="checkout.php" class="btn btn-success  btn-block">Checkout<span class="icon icon-arrow-right"></span></a>
                                <?php } else {?>
                                    <button class="btn btn-success  btn-block" disabled>Checkout<span class="icon icon-arrow-right"></span></button>
                                <?php }?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
    </div>





</div>





















<?php include_once('./includes/footer.php') ?>


<script>

$(function(){
    $(".remove_cart").click(function (e) { 
        e.preventDefault();
        var value = $(this).data('value');
        swal({
            title: 'Are you sure you want to remove this item?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                url: "./app/ajax_call.php",
                data: {"value":value,"f":"<?=$con->en_dec('en','remove_cart')?>"},
                success: function (response) {
                    var data = JSON.parse(response);
                    if(data.success==1){
                        swal({
                            type: 'success',
                            title: 'Success',
                            text: data.msg,
                        }).then(()=>{
                            location.reload();
                        })
                        
                    }
                }
            });
        }
        })


    });
    $(".update_cart_item").click(function (e) { 
        e.preventDefault();
        var value = $(this).data('value');
        var prev = $(this).data('prev');
        swal({
            html: `<h6>Edit item quantity</h6>
                <input type="number" class="quantity form-control" min="1" max="10" value="${prev}" autofocus>`,
            confirmButtonText: 'Save',
            confirmButtonColor: '#17a2b8',
            showCancelButton: true,
            preConfirm: function() {
                return new Promise((resolve, reject) => {
                    // get your inputs using their placeholder or maybe add IDs to them
                    resolve({
                        quantity: $('.quantity').val(),
                    });
    
                    // maybe also reject() on some condition
                });
            }
        }).then((data) => {
            if(data.dismiss != "cancel"){
                // your input data object will be usable from here
                if(data.value.quantity!=""){
                    if(data.value.quantity>0){
                        if(isNaN(data.value.quantity)){
                            swal({
                                type: 'warning',
                                title: 'Oops...',
                                text: 'Quantity only accepts numeric value!',
                            })
                        } else {
                            qty = data.value.quantity;
                            $.ajax({
                                type: "POST",
                                url: "./app/ajax_call.php",
                                data: {value,qty,"f":"<?=$con->en_dec('en','update_cart_item')?>"},
                                success: function (response) {
                                    var data = JSON.parse(response);
                                    if(data.success==1){
                                        swal({
                                            type: 'success',
                                            title: 'Success',
                                            text: data.msg,
                                        }).then((result) => {
                                            location.reload();
                                        })
                                    }
                                }
                            });
                        }
                    } else {
                        swal({
                            type: 'warning',
                            title: 'Oops...',
                            text: 'You cannot add 0 quantity!',
                        })
                    }
                } else {
                    swal({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Invalid quantity!',
                    })
                }
            }
        });
    });
})

</script>