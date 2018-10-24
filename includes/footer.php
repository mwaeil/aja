
<br><br>

<footer class="container">
<p>&copy; Company 2018, AJA's Home Services Inc</p>
</footer>






<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/main.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
</body>

</html>





<script>

$(function(){
    $(".btnLogout").click(function (e) { 
        e.preventDefault();
        var cc = confirm('Are you sure you want to logout?')
        if(cc){
            $.ajax({
                type: "POST",
                url: "./app/ajax_call.php",
                data: {"f":"<?=$con->en_dec('en','logout')?>"},
                success: function (response) {
                    var data = JSON.parse(response);
                    if(data.success==1){
                        location.href = "index.php";
                    }
                }
            });
        }
    });

    $(".add_to_cart").click(function (e) { 
        e.preventDefault();
        var value = $(this).data('value');
        var qty = 1;
        swal({
            html: `<h6>Enter quantity you want to add in your cart</h6>
                <input type="number" class="quantity form-control" min="1" max="10" value="1" autofocus>`,
            confirmButtonText: 'Add',
            confirmButtonColor: '#218838',
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
                                data: {value,qty,"f":"<?=$con->en_dec('en','add_to_cart')?>"},
                                success: function (response) {
                                    var data = JSON.parse(response);
                                    if(data.success==1){
                                        swal({
                                            type: 'success',
                                            title: 'Success',
                                            text: data.msg,
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