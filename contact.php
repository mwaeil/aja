<?php include_once('./includes/header.php') ?>









<br>


<div class="container" id="content" data-page="contact">
    <div class="container-fluid  bg-white rounded-border p-5 text-dark">
        <h3>CONTACT US</h3>
        <br>
        <hr>
        <div class="row">
        <div class="col-md-8">
            <div id="map" class=" mb-5" style="width:100%; height:300px;"> </div>
        </div>
        <div class="col-md-4 text-center">
            <form>
            <legend><span class="glyphicon glyphicon-globe"></span> Our office</legend>
            <address>
                <strong>AJA's Home Services Inc.</strong><br>
                69 Signal Village,<br>
                Taguig City, PH 1633<br>
            </address>
            <address>
                <strong>Email</strong><br>
                <a href="mailto:#">email@ajahome.com</a>
            </address>
            <address>
                <strong>Contact No.</strong><br>
                (123)-456789 / +639123456789
            </address>
            </form>
        </div>
    </div>
</div>





</div>






<?php include_once('./includes/footer.php') ?>

<script>
        function myMap() {
            var uluru = {lat:14.508020, lng:121.055510};
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 15, center: uluru});
            var marker = new google.maps.Marker({position: uluru, map: map});
        }
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYzRGEB6FqhyXllyui2V9rbvgD6QgSkQ4&callback=myMap" type="text/javascript"></script>