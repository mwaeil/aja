<?php include_once('./includes/header.php') ?>



<?php
    $search = '';
    if(isset($_GET['search'])) { $search=$_GET['search']; }
    $services = $con->get_services($search);
?>



<br>



<div class="container" id="content" data-page="services">


    <div class="container-fluid text-center bg-white text-dark rounded-border">
    <hr class="featurette-divider">
            <div class="row featurette p-3">
              <div class="col-md-7">
                <h2 class="featurette-heading">Carpentry </h2>
                <p class="lead text-justify">Carpentry is a skilled trade in which the primary work performed is the cutting, shaping and installation of building materials during the construction of buildings, ships, timber bridges, concrete formwork, etc.</p>
                <div class="text-left">
                  <h4>List of available Services</h4>
                  <ul>
                    <?php foreach($services as $s){?>
                      <?php if($s->category=="Carpentry") { ?>
                        <li><?=$s->name?> - P<?=$s->price?></li>
                      <?php }?>
                    <?php }?>
                  </ulol>
                </div>
              </div>
              <div class="col-md-5">
                <img class="featurette-image img-fluid mx-auto" src="./assets/img/carp.jpg" alt="Generic placeholder image">
              </div>
            </div>
    
            <hr class="featurette-divider">
    
            <div class="row featurette">
              <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading">Plumbing</h2>
                <p class="lead text-left">Plumbing is any system that conveys fluids for a wide range of applications. Plumbing uses pipes, valves, plumbing fixtures, tanks, and other apparatuses to convey fluids. </p>
                <div class="text-left">
                  <h4>List of available Services</h4>
                  <ul>
                    <?php foreach($services as $s){?>
                      <?php if($s->category=="Plumbing") { ?>
                        <li><?=$s->name?> - P<?=$s->price?></li>
                      <?php }?>
                    <?php }?>
                      </ul>
                </div>
              </div>
              <div class="col-md-5 order-md-1">
              <img class="featurette-image img-fluid mx-auto" src="./assets/img/plumb.jpg" alt="Generic placeholder image">
              </div>
            </div>
    
            <hr class="featurette-divider">
    
            <div class="row featurette">
              <div class="col-md-7">
                <h2 class="featurette-heading">Electrical</h2>
                <p class="lead text-justify">Electrical engineering is a professional engineering discipline that generally deals with the study and application of electricity, electronics, and electromagnetism. </p>
                <div class="text-left">
                  <h4>List of available Services</h4>
                  <ul>
                    <?php foreach($services as $s){?>
                      <?php if($s->category=="Electrical") { ?>
                        <li><?=$s->name?> - P<?=$s->price?></li>
                      <?php }?>
                    <?php }?>
                      </ul>
                </div>
              </div>
              <div class="col-md-5">
              <img class="featurette-image img-fluid mx-auto" src="./assets/img/el.jpg" alt="Generic placeholder image">
              </div>
            </div>
    
            <hr class="featurette-divider">
    
    </div>



</div>





















<?php include_once('./includes/footer.php') ?>
