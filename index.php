<?php include_once('./includes/header.php') ?>








<div class=" " id="content" data-page="home">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class=" text-dark">
        <div class="">
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active carpentry">
                <img class="d-block w-100 carpentry" src="./assets/img/carpentry-construction.jpg" alt="First slide">
                <div class="carousel-caption d-none d-md-block bg-transparent rounded-border carpentry">
                  <h5>WE OFFER CARPENTRY!</h5>
                  <p>AJA Home Services Offer Carpentry</p>
                  <a class="btn btn-primary carpentry" href="services.php">Read More</a>
                </div>
              </div>
              <div class="carousel-item plumbing">
                <img class="d-block w-100 plumbing" src="./assets/img/plumbing-header.jpg" alt="Second slide">
                <div class="carousel-caption d-none d-md-block bg-transparent rounded-border plumbing">
                  <h5>WE OFFER PLUMBING!</h5>
                  <p>AJA Home Services Offer Plumbing</p>
                  <a class="btn btn-primary plumbing" href="services.php">Read More</a>
                </div>
              </div>
              <div class="carousel-item">
                <img class="d-block w-100 electrical" src="./assets/img/elec.jpg" alt="Third slide">
                <div class="carousel-caption d-none d-md-block bg-transparent rounded-border electrical">
                  <h5>WE OFFER ELECTRICAL SERVICES!</h5>
                  <p>AJA Home Services Offer Electrical Services</p>
                  <a class="btn btn-primary electrical" href="services.php">Read More</a>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
<br><br>
    <div class="container ">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4 carpentry">
          <h2>Carpentry</h2>
          <p>Carpentry is a skilled trade in which the primary work performed is the cutting, shaping and installation of building materials during the construction of buildings, ships, timber bridges, concrete formwork, etc. </p>
          <p><a class="btn btn-secondary" href="services.php" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4 plumbing">
          <h2>Plumbing</h2>
          <p>Plumbing is any system that conveys fluids for a wide range of applications. Plumbing uses pipes, valves, plumbing fixtures, tanks, and other apparatuses to convey fluids.</p>
          <p><a class="btn btn-secondary" href="services.php" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4 electrical">
          <h2>Electrical</h2>
          <p>Electrical engineering is a professional engineering discipline that generally deals with the study and application of electricity, electronics, and electromagnetism.</p>
          <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
        </div>
      </div>

      <hr>

    </div> <!-- /container -->


</div>





















<?php include_once('./includes/footer.php') ?>