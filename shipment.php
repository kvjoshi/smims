<?php
session_start();
require 'connection.php';
require 'session_check.php'; 
$uid = $_SESSION['u_id'];
$success=0;
if (isset($_POST['shipments'])) {
        $order_id = $_POST['order_id'];
        $transport_no = $_POST['transport_no'];
        

  echo   $insert="INSERT INTO shipment (ship_id,u_id,order_id,transport_no) VALUES ('','$uid','$order_id','$transport_no')";
    $shipment_query = mysqli_query($con,$insert) or die('Shipment query failed');

    if ($shipment_query) {
        $success=1;
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Shipment</title>    
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
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

</head>
<body>

    <div class="page-wrapper" id="page-wrapper">
        <?php require 'sidebar.php';?>
        <!-- page-aside end-->
        <main class="content">
            <?php require 'header.php';?>
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
                                            <h3>Order Shipment</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 d-flex justify-content-end h-md-down">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb no-padding bg-trans mb-30">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-Home mr-2 fs14"></i></a></li>
                                    <li class="breadcrumb-item">Shipment</li>
                                    <li class="breadcrumb-item active">Shipment Details</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                       
                        <div class="col-lg-6">
                             <form method="POST">
                            <div class="portlet-box portlet-gutter ui-buttons-col mb-30">
                                <div class="portlet-header flex-row flex d-flex align-items-center b-b">
                                    <div class="flex d-flex flex-column">
                                        <h3>Shipment Details</h3> 
                                        <?php if($success == 1){ ?>
                                            <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                                                <strong>Success!</strong> Transport Sheet Generated!

                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        <?php $success = 0; } ?>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    
                                    <div class="form-group">
                                        <label>Select Order</label>
                                        <select class="form-control mb-20 form-control-lg" name="order_id">
                                            <?php
                                            $ship_n = "SELECT * FROM order_history WHERE u_id = $uid AND order_status = 'f'";
                                            $ship_query = mysqli_query($con,$ship_n) or die("Couldnt fetch Order");
                                            while($cdata=mysqli_fetch_assoc($ship_query))
                                            {
                                                ?>
                                                <option value="<?php echo $cdata['order_id']; ?>"><?php echo $cdata['order_id']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                   
                                    <div class="form-group">
                                        <label>Transport Vehicle Details</label>
                                        <input type="text" name="transport_no" class="form-control" placeholder="Enter Transport No" />
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary mr-1 mb-2" name="shipments" value="Confirm Shipment">
                                    </div>
                                </div>

                            </div><!--portlet-->
                             </form>
                        </div>
                       
                        <div class="col-lg-6">

                            <div class="bg-white table-responsive rounded shadow-sm pt-3 pb-3 mb-30">
                                <h6 class="pl-3 pr-3 text-capitalize font400 mb-20"> Past Orders </h6>
                                <table id="data-table" class="table mb-0 table-striped" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Company Name</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i=1;
                                        $p_order = "SELECT * FROM order_history,products,company WHERE order_history.u_id = $uid AND order_history.p_id = products.p_id AND order_history.company_name = company.c_id AND order_history.order_status = 'f'";
                                        $order_query = mysqli_query($con,$p_order) or die("Cant Fetch Orders");
                                        while ($order_list=mysqli_fetch_assoc($order_query)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $order_list['order_id']; ?></td>
                                                <td><?php echo $order_list['company_name']; ?></td>
                                                <td><?php echo $order_list['product_name']; ?></td>
                                                <td> <?php echo $order_list['quantity']; ?> </td>
                                                <!-- <?php if($stock_list['m_unit']=="kg" && $stock_list['stock'] < 1000 ){
                                                    ?><span class="badge badge-text anibadge badge-danger mr-3 mb-3">Low Stock</span> -->
                                                <?php }?> 
                                            </td>
                                            
                                        </tr>
                                        <?php
                                    }
                                    ?>



                                </tbody>
                            </table>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
        <?php require 'footer.php'; ?>
    </main><!-- page content end-->
</div><!-- app's main wrapper end -->
<!-- Common plugins -->
<script type="text/javascript" src="js/plugins/plugins.js"></script> 
<script type="text/javascript" src="js/appUi-custom.js"></script> 
<script type="text/javascript" src="lib/data-tables/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="lib/data-tables/dataTables.bootstrap4.min.js"></script> 
<script type="text/javascript" src="lib/data-tables/dataTables.responsive.min.js"></script> 
<script type="text/javascript" src="lib/data-tables/responsive.bootstrap4.min.js"></script> 
<script src="js/plugins-custom/datatables-custom.js"></script>

</body>
</html>
