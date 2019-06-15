<?php
    session_start();
    require 'connection.php';
    require 'session_check.php'; 
    $uid = $_SESSION['u_id'];

    if (isset($_GET['use_id'])) {

        $use = "UPDATE `order_history` SET `order_status`='i' WHERE `order_id` = '".$_GET['use_id']."'";
        $use_query = mysqli_query($con,$use) or die('cant update status');
       
    }
    if (isset($_GET['hold_id'])) {

        $use = "UPDATE `order_history` SET `order_status`='f' WHERE `order_id` = '".$_GET['hold_id']."'";
        $use_query = mysqli_query($con,$use) or die('cant update status');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Manage Companies</title>    
        <!-- Bootstrap-->
        <link href="lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!--Common Plugins CSS -->
        <link href="css/plugins/plugins.css" rel="stylesheet">
        <link href="lib/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="lib/data-tables/responsive.bootstrap4.min.css" rel="stylesheet">
        <!--fonts-->
        <link href="lib/line-icons/line-icons.css" rel="stylesheet">
        <link href="lib/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>

        <div class="page-wrapper" id="page-wrapper">
            <?php require 'sidebar.php'; ?>
            <!-- page-aside end-->
            <main class="content">
                <?php require 'header.php'; ?>
                <div class="page-subheader mb-30">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <div class="list">
                                    <div class="list-item pl-0">
                                        <div class="list-thumb ml-0 mr-3 pr-3  b-r text-muted">
                                            <i class="icon-Folder-Pictures"></i>
                                        </div>
                                        <div class="list-body">
                                            <div class="list-title fs-2x">
                                                <h3>Manage Orders</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 d-flex justify-content-end h-md-down">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb no-padding bg-trans mb-30">
                                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-Home mr-2 fs14"></i></a></li>
                                        <li class="breadcrumb-item">Orders</li>
                                        <li class="breadcrumb-item active">Manage Order</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="page-content">
                    <div class="container-fluid">
                          <div class="bg-white table-responsive rounded shadow-sm pt-3 pb-3 mb-30">
                              <h6 class="pl-3 pr-3 text-capitalize font400 mb-20">Manage Orders</h6>
                            <table id="data-table" class="table mb-0 table-striped" cellspacing="0" width="100%">
                                <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Company Name</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i=1;
                                        $p_order = "SELECT * FROM order_history,products,company WHERE order_history.u_id = $uid AND order_history.p_id = products.p_id AND order_history.company_name = company.c_id";
                                        $order_query = mysqli_query($con,$p_order) or die("Cant Fetch Orders");
                                        while ($order_list=mysqli_fetch_assoc($order_query)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $order_list['company_name']; ?></td>
                                                <td><?php echo $order_list['product_name']; ?></td>
                                                <td> <?php echo $order_list['quantity']; ?> </td>
                                                <td><?php if($order_list['order_status']=="i"){ ?>
                                            <span class="badge badge-text badge-primary mr-2 mb-2">In Process</span> <?php } 
                                            if($order_list['order_status']=="f"){ ?> <span class="badge badge-text badge-success mr-2 mb-2">Completed</span> <?php } ?></td>
                                                <td>
                                                <?php if($order_list['order_status']=="f"){ ?>
                                                <a href="manage_order.php?use_id=<?php echo $order_list['order_id']; ?>" class="btn btn-shadow btn-gradient btn-gradient-primary mr-1 mb-2">Revert</a> <?php } 
                                                if($order_list['order_status']=="i"){ ?> <a href="manage_order.php?hold_id=<?php echo $order_list['order_id']; ?>" class="btn btn-shadow btn-gradient btn-gradient-success">Finish</a> <?php } ?>
                                                </td>
                                        
                                            </tr>
                                    <?php } ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <footer class="content-footer bg-light b-t">
                    <div class="d-flex flex align-items-center pl-15 pr-15">
                        <div class="d-flex flex p-3 ml-auto">
                            <div>
                                <a href="#" class="d-inline-flex pl-0 pr-2 b-r">Contact</a>
                                <a href="#" class="d-inline-flex pl-2 pr-2 b-r">Storage</a>
                                <a href="#" class="d-inline-flex pl-2 pr-2 ">Privacy</a>
                            </div>
                        </div>
                        <div class="d-flex flex p-3 mr-auto justify-content-end">
                            <div class="text-muted">© Copyright 2014-2018. Assan</div>
                        </div>
                    </div>
                </footer>
            </main><!-- page content end-->
        </div><!-- app's main wrapper end -->
        <!-- Common plugins -->
        <script type="text/javascript" src="js/plugins/plugins.js"></script> 
        <script type="text/javascript" src="js/appUi-custom.js"></script> 
         <!-- Required datatable js -->
        <script type="text/javascript" src="lib/data-tables/jquery.dataTables.min.js"></script> 
        <script type="text/javascript" src="lib/data-tables/dataTables.bootstrap4.min.js"></script> 
        <script type="text/javascript" src="lib/data-tables/dataTables.responsive.min.js"></script> 
        <script type="text/javascript" src="lib/data-tables/responsive.bootstrap4.min.js"></script> 
        <script src="js/plugins-custom/datatables-custom.js"></script>
    </body>
</html>
