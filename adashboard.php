<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/ord/resource/php/class/core/init.php';
  isLogin();
  $table = new viewtable();
  $user = new user();
  isLogin();
  isRAdmin($user->data()->groups);
  $locker = new locker();
  $date = get_current_date();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="resource/css/styledash.css" type="text/css">
    <script src="https://kit.fontawesome.com/03ca298d2d.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@500&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->

    <title>Dashboard</title>
    <link rel="icon" type="image/x-icon" href="resource/img/ceu.png" />
  </head>
  <body>
    <div class="loader-container">
        <div class="loader-logo"></div>
        <div class="loader-bar">
            <div class="progress"></div>
        </div>
        <div class="loader-text">Loading 0%</div>
    </div>
    <header>
      <div class="d-flex" id="wrapper">
        <div class="bg-white" id="sidebar-wrapper">
                    
          <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase">
            <img src="resource/img/header.jpg" height="80px;" alt="">
          </div>

          
          <div class="list-group list-group-flush my-3">
            
            <a class="list-group-item list-group-item-action fw-bold text-center mb-5">
            <small>Current Date and Time</small> 
            <?php include 'clock.php'; ?>
            </a>

            <a class="list-group-item list-group-item-action fw-bold">
              <i class="fas fa-question-circle me-2"></i> Main Menu</a>
              
              <div class="item mt-3">
              <a class="sub-btn bg-selected" href="adashboard"><i class="fa-solid fa-house"></i> Dashboard</a>
              <a class="sub-btn" href="adash-search"><i class="fa-solid fa-magnifying-glass"></i> Search All</a>
            </div>
            <a class="list-group-item list-group-item-action fw-bold mt-5">
              <i class="fas fa-magnifying-glass me-2"></i> For Review </a>
            <div class="item">
              <a class="sub-btn" href="adash-onlineapp"><i class="fa-solid fa-globe"></i> Online Requests</a>
            </div>
            <a class="list-group-item list-group-item-action fw-bold mt-5">
              <i class="fas fa-check me-2"></i> For Assignment </a>
            <div class="item">
              <a class="sub-btn" href="adash-asgn1"><i class="fa-solid fa-globe"></i> Online Requests</a>
            </div>
            <div class="item">
              <a class="sub-btn" href="adash-asgn2"><i class="fa-solid fa-star"></i> Special Requests</a>
            </div>
            <a class="list-group-item list-group-item-action fw-bold mt-5">
              <i class="fa-solid fa-folder me-2"></i> Releasing Section </a>
            <div class="item">
              <a class="sub-btn" href="rdashboard"><i class="fa-solid fa-house"></i> Dashboard</a>
            </div>
            
            <script type="text/javascript">
              $(document).ready(function(){
                  $('.sub-btn').click(function(){
                      $(this).next('.sub-menu').slideToggle();
                      $(this).find('.dropdown').toggleClass('rotate');
                  });
              });
            </script>

          </div>
        </div>

        <div id="page-content-wrapper">
          <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 border-bottom">

            <div class="d-flex align-items-center">
              <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            </div>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupporteContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button> 

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav  ms-auto mb-2 mb-lg-0">
              
                <div class="row text-center me-3">
                  <div class="col-md-3 px-0">
                    <a href="locker.php?landing=adashboard" class="btn btn-sm <?php $locker->lockerButtonClr(); ?>"><?php $locker->lockerButton(); ?></a>
                  </div>
                  <div class="col-md-9">
                    <?php $locker->lockerStatusDisp(); ?>
                  </div>
                </div>

                <li class="nav-item dropdown ">
                  
                  <a href="#" class="nav-link dropdown-toggle second-text fw-bold username" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="avatar"><?php echo substr($user->data()->name, 0, 1); ?></span> <?php echo $user->data()->name; ?> </a>

                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a href='#' class='dropdown-item'><i class="fa-solid fa-key"></i> Change Password</a></li>
                    <?php 
                      if(($user->data()->username == "JANATALIO") || ($user->data()->username == "RBOLASOC")){
                        echo "<li><a href= 'acctmgt' class='dropdown-item'><i class='fa-solid fa-user-gear'></i> Accounts</a></li>";
                      }
                    ?>
                    <li><a href= 'logout.php' class='dropdown-item'><i class="fa-solid fa-person-walking-arrow-right"></i> Logout</a></li>
                    <!-- <li><a href= '#' class='dropdown-item'>Item 3</a></li>
                    <li><a href='#' class='dropdown-item'>Item 4</a></li> -->
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
          
          <div class="p-3">
            <h1>Dashboard</h1>
          </div>
          <div class="container-fluid px-5 pt-2">
            <div class="row">
              <div class='col-lg-12 shadow'>
                <div class='row ms-4 py-3'>
                  <div class='col-lg-4 px-3 pt-3 mx-2'>
                    Change Filter: 
                    <form action="" method="GET">
                      <?php
                        if(empty($_GET['monthPicker'])){
                          echo "<input type='month' id='monthPicker' name='monthPicker' value ='$date'>";
                        }else{
                          echo "<input type='month' id='monthPicker' name='monthPicker' value ='$_GET[monthPicker]'>";
                        }
                      ?>
                      <input type ="submit" class="btn btn-sm btn-info" value="Filter by Month">
                      <?php
                        $current_file_name = basename($_SERVER['PHP_SELF']);
                        echo '<a href="'.$current_file_name.'?alltime=1" class = "btn btn-sm btn-success">All-Time</a>';
                      ?>
                    </form>
                  </div>
                </div>
                <div class='row d-flex justify-content-center py-3'>
                  <div class='col-lg-4 px-3 pb-3 me-2'>
                    <h6><b>Top Performer Special Docs</b></h6>
                    <!-- <div class='ms-2'> -->
                      <?php include_once'sdocsgraph.php';?>
                    <!-- </div> -->
                  </div>
                  <div class='col-lg-4 p-3 mx-2'>
                    <h6><b>Top Performer Normal Docs</b></h6>
                    <!-- <div class='mx-2'> -->
                      <?php include_once'ndocsgraph.php';?>
                    <!-- </div> -->
                  </div>
                  <div class='col-lg-3 p-3 ms-2'>
                    <h6><b>Overall Top Performer</b></h6>
                    <!-- <div class='me-2'> -->
                      <?php include_once'odocsgraph.php';?>
                    <!-- </div> -->
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="row"> -->
              <!-- <div class="col-md p-5 content container-fluid"> -->
                  <?php include 'charts.php'; ?>

              <!-- </div> -->
            <!-- </div> -->
          </div>
        </div>
      </div>
     </div>
    </header>

      <?php include 'chart-control.php'; ?>
      <script type="text/javascript">
        var el = document.getElementById("wrapper")
        var toggleButton = document.getElementById("menu-toggle")

        toggleButton.onclick = function(){
          el.classList.toggle("toggled")
        }
      </script>
      <script src="resource/js/loader.js"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     
    </body>
</html>
