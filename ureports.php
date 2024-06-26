<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ord/resource/php/class/core/init.php';
isLogin();
$user = new user();
$id = $user->data()->id;
$table = new viewtable();
isUser($user->data()->groups);
$date = get_current_date();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="resource/css/styledash.css" type="text/css">
    <script src="https://kit.fontawesome.com/03ca298d2d.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@500&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">
    <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>

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
                        <i class="fas fa-question-circle me-2"></i> Menu</a>
                        
                        
                        
                            
                    <div class="item mt-3">
                        <a class="sub-btn" href="alldash-search"><i class="fa-solid fa-magnifying-glass"></i> Search All</a>
                        <a class="sub-btn bg-selected" href="ureports"><i class="fa-solid fa-chart-bar"></i> Reports </a>
                        <a class="sub-btn" href="udashboard"><i class="fa-solid fa-house"></i> Pending </a>
                    </div>
                    
                    <!-- <div class="item">
                        <a class="sub-btn" href="adash-onlineapp"><i class="fa-solid fa-globe"></i> Online Requests</a>
                    </div> -->
                    
                    <div class="item">
                        <a class="sub-btn" href="udashboardfs"><i class="fa-solid fa-star"></i> For Signature </a>
                    </div>
                    


                    <a class="list-group-item list-group-item-action fw-bold">
                        <i class="fas fa-link me-2"></i> Links</a>
                    <div class="item">
                        <a href='switchgroup.php' class="btn btn-sm btn-info"><i class="fa-solid fa-arrow-right"></i> Special Transaction</a>
                    </div>
                    

                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('.sub-btn').click(function () {
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

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupporteContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav  ms-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown ">

                                <a href="#" class="nav-link dropdown-toggle second-text fw-bold username"
                                    id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="avatar">
                                        <?php echo substr($user->data()->name, 0, 1); ?>
                                    </span>
                                    <?php echo $user->data()->name; ?>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a href='#' class='dropdown-item'><i class="fa-solid fa-key"></i> Change
                                            Password</a></li>
                                    <li><a href='logout.php' class='dropdown-item'><i
                                                class="fa-solid fa-person-walking-arrow-right"></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                
                 <div class="p-3">
                    <h1>Dashboard</h1>
                </div>

                <div class="container-fluid p-5">
                    <div class="row">
                        <div class='col-lg-12 shadow'>
                            <div class='row ms-4 py-3'>
                                <div class='col-lg-4 px-3 pt-3 mx-2'>
                                    <i class="fa-solid fa-filter"></i> Change Filter: 
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

                                        if(!empty($_GET['alltime'])){
                                            $dispdate = "All Time";
                                        }elseif(!empty($_GET['monthPicker'])){
                                            $year = $_GET['monthPicker'];
                                            $dispdate = date(" F Y",strtotime($year));
                                        }else{
                                            $dispdate = date(" F Y");
                                        }
                                    ?>
                                    </form>
                                </div>
                            </div>
                            <div class='row d-flex justify-content-center py-3'>
                                <div class='col-lg-4 px-3 pb-3 me-2'>
                                    <h6><b><i class="fa-solid fa-medal"></i> Top Performer Special Docs <?php echo " - ".$dispdate; ?></b></h6>
                                    <!-- <div class='ms-2'> -->
                                    <?php include_once'sdocsgraph.php';?>
                                    <!-- </div> -->
                                </div>
                                <div class='col-lg-4 px-3 pb-3 mx-2'>
                                    <h6><b><i class="fa-solid fa-medal"></i> Top Performer Normal Docs <?php echo " - ".$dispdate; ?></b></h6>
                                    <!-- <div class='mx-2'> -->
                                    <?php include_once'ndocsgraph.php';?>
                                    <!-- </div> -->
                                </div>
                                <div class='col-lg-3 px-3 pb-3 ms-2'>
                                    <h6><b> <i class="fa-solid fa-medal"></i> Overall Top Performer <?php echo " - ".$dispdate; ?></b></h6>
                                    <!-- <div class='me-2'> -->
                                    <?php include_once'odocsgraph.php';?>
                                    <!-- </div> -->
                                </div>
                                <div class='col-lg-4 px-3 pb-3 ms-2'>
                                    <h6><b> <i class="fa-solid fa-check-to-slot"></i> Special Transaction Breakdown <?php echo " - ".$dispdate; ?></b></h6>
                                    <!-- <div class='me-2'> -->
                                    <?php include_once'sdocsbreakdown.php';?>
                                    <!-- </div> -->
                                </div>
                                <div class='col-lg-4 px-3 pb-3 ms-2'>
                                    <h6><b> <i class="fa-solid fa-check-to-slot"></i> Normal Transaction Breakdown <?php echo " - ".$dispdate; ?></b></h6>
                                    <!-- <div class='me-2'> -->
                                    <?php include_once'ndocsbreakdown.php';?>
                                    <!-- </div> -->
                                </div>
                            </div>
                            <div class='row d-flex justify-content-center pt-3'>
                                <div class='col-lg-12 px-3 ms-2'>
                                    <!-- <h6><b> <i class="fa-solid fa-check-to-slot"></i> Normal Transaction Breakdown </b></h6> -->
                                    <?php include_once'odocstbl.php';?>
                                </div>
                            </div>
                            <div class='row d-flex justify-content-center pb-3'>
                                <div class='col-lg-12 px-3 pb-3 ms-2'>
                                    <!-- <h6><b> <i class="fa-solid fa-check-to-slot"></i> Normal Transaction Breakdown </b></h6> -->
                                    <?php include_once'sdocstbl.php';?>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
        </div>
    </header>
    <script>
          $(document).ready(function(){
          window.$('#dataTable').DataTable({
            });
        });
      </script>  
    <script type="text/javascript">
        var el = document.getElementById("wrapper")
        var toggleButton = document.getElementById("menu-toggle")

        toggleButton.onclick = function () {
            el.classList.toggle("toggled")
        }
    </script>
    <script src="resource/js/loader.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/vfs_fonts.js"></script>
    <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/buttons.print.min.js"></script>
 
    <script type="text/javascript">
        $(document).ready( function () {
          $('#scholartable').DataTable({
            scrollX: true,
            // scrollY: 500,
            dom: 'frtipB',
            paging: true,
            buttons: [
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-primary',
                    text: 'Export to Excel',
                    titleAttr: 'Export to Excel',
                    title: 'Regular Transaction Report',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'csvHtml5',
                    className: 'btn btn-primary',
                    text: 'Export to CSV',
                    titleAttr: 'Export to CSV',
                    title: 'Regular Transaction Report',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-primary',
                    text: 'Export to PDF',
                    titleAttr: 'Export to PDF',
                    title: 'Regular Transaction Report',
                    orientation: 'landscape',
                    pageSize: 'TABLOID',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                }
            ]
          });
        });
    </script>
    <script type="text/javascript">
        $(document).ready( function () {
          $('#scholartable2').DataTable({
            scrollX: true,
            // scrollY: 500,
            dom: 'frtipB',
            paging: true,
            buttons: [
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-primary',
                    text: 'Export to Excel',
                    titleAttr: 'Export to Excel',
                    title: 'Special Transaction Report',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'csvHtml5',
                    className: 'btn btn-primary',
                    text: 'Export to CSV',
                    titleAttr: 'Export to CSV',
                    title: 'Special Transaction Report',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-primary',
                    text: 'Export to PDF',
                    titleAttr: 'Export to PDF',
                    title: 'Special Transaction Report',
                    orientation: 'landscape',
                    pageSize: 'TABLOID',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                }
            ]
          });
        });
    </script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
          // Get the modal
          var confirmationModal = document.getElementById('confirmationModal');
           console.log(confirmationModal);
          // Get the remove button
          var removeButtons = document.querySelectorAll('.remove-request');

          // Add event listeners to all remove buttons
          removeButtons.forEach(function (button) {
            button.addEventListener('click', function () {
              // Get the transaction ID
              var transactionId = this.getAttribute('data-transaction-id');
              
              // Update the modal confirmation button to include the transaction ID
              var confirmRemoveButton = document.getElementById('confirmRemove');
              confirmRemoveButton.setAttribute('data-transaction-id', transactionId);
             
            });
          });

          // Add event listener to the confirmation button inside the modal
          var confirmRemove = document.getElementById('confirmRemove');
          confirmRemove.addEventListener('click', function () {
            // Get the transaction ID from the confirmation button
            var transactionId = this.getAttribute('data-transaction-id');
            var reason = document.getElementById('reasonInput').value;
            
            // Perform the removal process (You might need AJAX or form submission here)
            window.location.href = 'actions.php?transactionID=' + transactionId+'&state=4&type=reg&landing=udash&info='+reason;
            
            // Close the modal
            var modal = bootstrap.Modal.getInstance(confirmationModal);
            modal.hide();
          });
        });
    </script>
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Please input the reason for removal of the request:
                        <input type="text" name="info" id='reasonInput' class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmRemove">Remove</button>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>