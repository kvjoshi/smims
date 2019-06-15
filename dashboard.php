<?php
    session_start();
    require 'connection.php';
    require 'session_check.php'; 
    $u_id = $_SESSION['u_id'];
    
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Dashboard</title>    
        <!-- Bootstrap-->
        <link href="lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!--Common Plugins CSS -->
        <link href="css/plugins/plugins.css" rel="stylesheet">
        <!--fonts-->
        <link href="lib/line-icons/line-icons.css" rel="stylesheet">
        <link href="lib/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">
        <link href="lib/dt-picker/jquery.datetimepicker.min.css" rel="stylesheet">
        <link href="lib/select2/dist/css/select2.min.css" rel="stylesheet">
        <link href="lib/chartist/chartist.min.css" rel="stylesheet" />
        <link href="css/chartist-custom.css" rel="stylesheet" />
        <link href="css/picker-custom.css" rel="stylesheet" />
        <link href="css/select2-custom.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body class="bg-white">

        <div class="page-wrapper" id="page-wrapper">
           <?php require 'sidebar.php'; ?>
           <!-- page-aside end-->
            <main class="content">
                <?php require 'header.php'; ?>

                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row align-items-center mb-30 pt-30">
                            <div class="col-md-12 mr-auto ml-auto">
                                <div class="mb-0">
                                    <!-- <a href='#' class='float-right btn btn-sm btn-info btn-icon'><i class="fa fa-cog mr-2"></i>View Settings</a> -->
                                    <h4>Welcome back, <?php echo $_SESSION['u_company_name'] ; ?></h4>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 mb-6 col-md-6 mb-30">
                                <div class="list border1 rounded overflow-hidden">
                                    <div class="list-item">
                                        <div class="list-thumb bg-primary text-primary-light avatar rounded-circle avatar60 shadow-sm">
                                            <i class="icon-Add-Basket"></i>
                                        </div>
                                        <div class="list-body text-right">
                                            <span class="list-title fs-2x">13</span>
                                            <span class="list-content fs14">New Orders</span>

                                        </div>
                                    </div>
                                </div>
                            </div><!--col-->
                            <div class="col-lg-3 mb-6 col-md-6 mb-30">
                                <div class="list border1 rounded overflow-hidden">
                                    <div class="list-item">
                                        <div class="list-thumb bg-warning-active text-warning-light avatar rounded-circle avatar60 shadow-sm">
                                            <i class="icon-Truck"></i>
                                        </div>
                                        <div class="list-body text-right">
                                            <span class="list-title fs-2x">10</span>
                                            <span class="list-content  fs14">Pending Orders</span>

                                        </div>
                                    </div>
                                </div>
                            </div><!--col-->
                            <div class="col-lg-3 mb-6 col-md-6 mb-30">
                                <div class="list border1 rounded overflow-hidden">
                                    <div class="list-item">
                                        <div class="list-thumb bg-danger-active text-danger-light avatar rounded-circle avatar60 shadow-sm">
                                            <i class="icon-Remove-Basket"></i>
                                        </div>
                                        <div class="list-body text-right">
                                            <span class="list-title fs-2x">2</span>
                                            <span class="list-content  fs14">Order Canceled</span>

                                        </div>
                                    </div>
                                </div>
                            </div><!--col-->
                            <div class="col-lg-3 mb-6 col-md-6  mb-30">
                                <div class="list border1 rounded overflow-hidden">
                                    <div class="list-item">
                                        <div class="list-thumb bg-success-active text-success-light avatar rounded-circle avatar60 shadow-sm">
                                            <i class="icon-Money-Bag"></i>
                                        </div>
                                        <div class="list-body text-right">
                                            <span class="list-title fs-2x">1</span>
                                            <span class="list-content fs14">Order In Process</span>

                                        </div>
                                    </div>
                                </div>
                            </div><!--col-->
                        </div>
                        <div class="row">
                           
                        </div>
                        <!--  -->
                         <div class="row">
                            <div class="col-lg-12">

                                <div class="portlet-box portlet-fullHeight border0 shadow-sm mb-30">
                                    <div class="portlet-header flex-row flex d-flex align-items-center">
                                        <div class="flex d-flex flex-column">
                                            <h3>Production Analytics</h3> 
                                            
                                        </div>
                                        <div class="portlet-tools">
                                            <ul class="nav">
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link"><i class="fa fa-sync"></i></a>

                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="portlet-body pt-0">
                                        <div class="row align-items-center">
                                            <div class='col-lg-5'>
                                                <div class="row pt-4 pb-4 text-center">
                                                    <div class="col-4 ml-auto b-r">
                                                        <span class="fa fa-square text-teal mb-2"></span>
                                                        <h4 class="mb-0">4883 KG</h4>

                                                        <span class="">Consumption</span>
                                                       <!--  <div class="text-muted fs12 pt-1">
                                                            <i class="mr-2 fa fa-arrow-up text-success"></i> 3.5%
                                                        </div> -->
                                                    </div>
                                                    <div class="col-4 mr-auto">
                                                        <i class='fa fa-square text-primary mb-2'></i>
                                                        <h4 class="mb-0"><sub class="fs10 text-muted"></sub> 4496 KG</h4>
                                                        <span class="">Production</span>
                                                       <!--  <div class="text-muted fs12 pt-1">
                                                            <i class="mr-2 fa fa-arrow-up text-success"></i> .5%
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-lg-7'>
                                                <div class='chartist'>
                                                    <div class="ct-chart"></div>
                                                </div>
                                                <!--<canvas id="lineChart" height="130"></canvas>-->
                                            </div>
                                        </div><!--portlet-->
                                    </div>
                                </div>
                            </div><!--col-->

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="portlet-box portlet-fullHeight mb-30">
                                    <div class="portlet-header bg-light flex-row flex d-flex align-items-center">
                                        <div class="flex d-flex flex-column">
                                            <h3>Recent Stock Purchase</h3> 
                                        </div>
                                       <!--  <div class="portlet-tools">
                                            <ul class="nav">

                                                <li class="nav-item">
                                                    <select class="custom-select bg-light hidden-search" data-placeholder="Filter Orders">
                                                        <option value="1" selected>Recent Orders</option>
                                                        <option value="2">Pending Orders</option>
                                                        <option value="3">Canceled Orders</option>
                                                        <option value="4">Return Orders</option>
                                                    </select>
                                                </li>
                                                <li class="nav-item pl-3">
                                                    <a href="purchase_stock.php" class="btn btn-link">
                                                        View all Purchase
                                                    </a>
                                                </li>
                                            </ul>
                                        </div> -->
                                    </div>
                                    <div class="portlet-body no-padding">

                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Srno</th>
                                                        <th>Date</th>
                                                        <th>Material Name</th>
                                                        <th>Company</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                     <?php
                                    $i=1;
                                    
                                    $view = "SELECT * FROM purchase as p,material as m  WHERE p.m_id=m.m_id AND p.u_id=$u_id ORDER BY create_date DESC LIMIT 5 ";
                                    $view_query = mysqli_query($con,$view) or die("View Query Failed");
                                    while($company_data=mysqli_fetch_assoc($view_query))
                                    {
                                    ?>
                                     
                                    <tr>

                                        <td>
                                            <?php if($company_data['delete_flag']==1){ echo "<del>";} ?>
                                            <?php echo $i++; ?>
                                               <?php if($company_data['delete_flag']==1){ echo "</del>";} ?>
                                            </td>
                                        <td>
                                            <?php echo $newDate = date("jS F Y", strtotime($company_data['purchase_date']));  ?>
                                           
                                        </td>
                                        <td>
                                            <?php if($company_data['delete_flag']==1){ echo "<del>";} ?>
                                            <?php echo $company_data['m_name']; ?>
                                            <?php if($company_data['delete_flag']==1){ echo "</del>";} ?>
                                        </td>
                                        <td>
                                            <?php if($company_data['delete_flag']==1){ echo "<del>";} ?>
                                            <?php 
                                                $cid = $company_data['c_id'];
                                                $cp = "SELECT company_name FROM company WHERE c_id = $cid " ;
                                                $cp_query= mysqli_query($con,$cp); 
                                                $cname=mysqli_fetch_assoc($cp_query);
                                                echo $cname['company_name'];
                                            ?> 
                                            <?php if($company_data['delete_flag']==1){ echo "</del>";} ?>
                                         </td>
                                        <td>
                                            <?php if($company_data['delete_flag']==1){ echo "<del>";} ?>
                                            <?php echo $company_data['quantity'];echo " "; echo $company_data['m_unit'];  ?>
                                            <?php if($company_data['delete_flag']==1){ echo "</del>";} ?>
                                        </td>
                                        <td>
                                            <?php if($company_data['delete_flag']==1){ echo "<del>";} ?>
                                            <?php echo $company_data['unit_price']; ?>
                                            <?php if($company_data['delete_flag']==1){ echo "</del>";} ?></td>
                                        
                                          
                                        
                                        
                                    </tr>

                                    <?php } ?>
                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div><!--portlet-->
                            </div><!--col-->
                        </div>
                    </div>
                </div>
            </main><!-- page content end-->
        </div><!-- app's main wrapper end -->
        <!-- Common plugins -->
        <script type="text/javascript" src="js/plugins/plugins.js"></script> 
        <script type="text/javascript" src="js/appUi-custom.js"></script> 
         <script src="lib/chartist/chartist.min.js"></script>
        <script src="lib/chartist/chartist-tooltip.js"></script>
        <script type="text/javascript" src="lib/peity/jquery.peity.min.js"></script>
        <script type="text/javascript" src="lib/dt-picker/jquery.datetimepicker.full.min.js"></script>
        <script src="lib/select2/dist/js/select2.min.js"></script>
        <script type="text/javascript" src="js/dashboard.custom.js"></script> 
    </body>
</html>
