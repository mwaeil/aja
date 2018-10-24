
            </div>
        </div>
	</div>


<br><br>

<footer class="container">
<p>&copy; Company 2018, AJA's Home Services Inc</p>
</footer>




<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>

<script src="../assets/js/jquery-ui/jquery-ui.min.js"></script>
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
                url: "../app/ajax_call.php",
                data: {"f":"<?=$con->en_dec('en','logout')?>"},
                success: function (response) {
                    var data = JSON.parse(response);
                    if(data.success==1){
                        location.href = "../index.php";
                    }
                }
            });
        }
    });


    $("#sidepills .nav-link").each(function (index, element) {
        // element == this
        var page = $("#page").data('page');
        if($(element).hasClass(page)){
            $(element).addClass('active');
        }
    });


})

</script>