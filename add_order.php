<?php
session_start();
require 'connection.php';
require 'session_check.php'; 
$uid = $_SESSION['u_id'];
$success=0;
if (isset($_POST['add_order'])) {
        $p_id = $_POST['product'];
        $company_name = $_POST['company_name'];
        $quantity = $_POST['quantity'];

  echo   $insert="INSERT INTO order_history (order_id,u_id,company_name,p_id,quantity) VALUES ('','$uid','$company_name','$p_id','$quantity')";
    $production_query = mysqli_query($con,$insert) or die('Order query failed');

    if ($production_query) {
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
    <title>Production</title>    
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
                                            <h3>Add Order</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 d-flex justify-content-end h-md-down">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb no-padding bg-trans mb-30">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-Home mr-2 fs14"></i></a></li>
                                    <li class="breadcrumb-item">Order</li>
                                    <li class="breadcrumb-item active">Add Order</li>
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
                                        <h3>Add Order Details</h3> 
                                        <?php if($success == 1){ ?>
                                            <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                                                <strong>Success!</strong> Order Sheet Generated!

                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        <?php $success = 0; } ?>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    
                                    <div class="form-group">
                                        <label>Select Customer</label>
                                        <select class="form-control mb-20 form-control-lg" name="company_name">
                                            <?php
                                            $company_n = "SELECT * FROM company WHERE u_id = $uid AND type = 'C'";
                                            $company_query = mysqli_query($con,$company_n) or die("Couldnt fetch Company");
                                            while($cdata=mysqli_fetch_assoc($company_query))
                                            {
                                                ?>
                                                <option value="<?php echo $cdata['c_id']; ?>"><?php echo $cdata['company_name']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                   <div class="form-group">
                                        <label>Select Product</label>
                                        <select class="form-control mb-20 form-control-lg" name="product">
                                            <?php
                                            $product_n = "SELECT * FROM products WHERE u_id = $uid";
                                            $product_query = mysqli_query($con,$product_n) or die("Couldnt fetch Company");
                                            while($pdata=mysqli_fetch_assoc($product_query))
                                            {
                                                ?>
                                                <option value="<?php echo $pdata['p_id']; ?>"><?php echo $pdata['product_name']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="quantity" class="form-control" placeholder="Enter Quantity" />
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary mr-1 mb-2" name="add_order" value="Generate Order">
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
                                            <th>Sr.No</th>
                                            <th>Company Name</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
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
