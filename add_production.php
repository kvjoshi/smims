<?php
session_start();
require 'connection.php';
require 'session_check.php'; 
$uid = $_SESSION['u_id'];
$success=0;
if (isset($_POST['add_production'])) {
    
    $production_name=$_POST['production_name'];
    $product_id=$_POST['product'];


    $material = json_encode($_POST['material']);

     $production="INSERT INTO `production`(`production_id`, `product_id`, `u_id`,`production_name`, `material`) VALUES ('',$product_id,$uid,'$production_name','".$material."')";
    $production_query = mysqli_query($con,$production) or die('production query failed');

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
                                            <h3>Add Production</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 d-flex justify-content-end h-md-down">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb no-padding bg-trans mb-30">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="icon-Home mr-2 fs14"></i></a></li>
                                    <li class="breadcrumb-item">Pages</li>
                                    <li class="breadcrumb-item active">Add Production</li>
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
                                        <h3>Generate Production Details</h3> 
                                        <?php if($success == 1){ ?>
                                            <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                                                <strong>Success!</strong> Production Sheet Generated!

                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        <?php $success = 0; } ?>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="form-group">
                                                <label>Production Sheet Name</label>
                                                <input type="text" class="form-control form-control-lg" placeholder="Production Sheet Name" name="production_name" required="required">
                                            </div>
                                    <div class="form-group">
                                        <label>Select Existing Product     </label>   <label>  <a class="btn btn-outline-primary btn-sm mr-1 mb-2 justify-content-end" href="add_product.php">Add New Product</a></label>
                                        <select class="form-control mb-20 form-control-lg" name="product" required="required">
                                            <?php
                                            $product = "SELECT * FROM products WHERE u_id = $uid";
                                            $product_query = mysqli_query($con,$product) or die("Couldnt fetch product");
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
                                        <?php
                                        $check=1;
                                        $i=1;       
                                        $stock = "SELECT * FROM material,stock,company WHERE stock.u_id = $uid AND material.m_id = stock.m_id AND company.c_id = stock.c_id";
                                        $stock_query = mysqli_query($con,$stock) or die("Cant Fetch Stock");
                                        while ($stock_name=mysqli_fetch_assoc($stock_query)) {
                                            ?>
                                            <div class="form-check">
                                                <!-- <input class="form-check-input" type="checkbox"  name="material[stock_id][]" value="<?php echo $stock_name['stock_id']; ?>" onclick="document.getElementById('<?php echo $stock_name['stock_id']; ?>').disabled=!this.checked;">

                                                <label class="form-check-label" for="<?php echo $stock_name['stock.m_id']; ?>"><mark><?php echo $stock_name['m_name']; ?>  <?php echo $stock_name['company_name']; ?></mark></label>
                                                <input type="text" class="form-control col-md-4 form-control" name="material[quantity][]" placeholder="Quantity (KG)" id="<?php echo $stock_name['stock_id']; ?>" disabled="disabled">  -->
                                            </div>
                                            
                                            <div class="customUi-checkbox checkboxUi-primary pb-2">
                                                    <input id="<?php echo $i; ?>" value="<?php echo $stock_name['stock_id']; ?>" type="checkbox" name="material[stock_id][]"  onclick="document.getElementById('q<?php echo $i; ?>').disabled=!this.checked;">
                                                    <label for="<?php echo $i; ?>">
                                                        <span class="label-checkbox"></span>
                                                        <span class="label-helper"><mark><?php echo $stock_name['m_name']; ?>  <?php echo $stock_name['company_name']; ?></mark></span>
                                                    </label>        
                                            </div>
                                                 <input type="number" class="form-control col-md-6 form-control" name="material[quantity][]" placeholder=" Max Quantity  <?php echo $stock_name['stock']; ?>" id="q<?php echo $i; ?>" disabled="disabled" max="<?php echo $stock_name['stock']; ?>" required="required">
                                            <br/>
                                            <div class="form-group-inline">
                                              
                                            </div>
                                        <?php $i++;  }?>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary mr-1 mb-2" name="add_production" value="Add Product">
                                    </div>
                                </div>

                            </div><!--portlet-->
                             </form>
                        </div>
                       
                        <div class="col-lg-6">

                            <div class="bg-white table-responsive rounded shadow-sm pt-3 pb-3 mb-30">
                                <h6 class="pl-3 pr-3 text-capitalize font400 mb-20">Available Raw Material For Production</h6>
                                <table id="data-table" class="table mb-0 table-striped" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Material Name</th>
                                            <th>Available Quantity</th>
                                            <th>Company</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i=1;
                                        $material = "SELECT * FROM material,stock,company WHERE stock.u_id = $uid AND material.m_id = stock.m_id AND company.c_id = stock.c_id";
                                        $material_query = mysqli_query($con,$material) or die("Cant Fetch Stock");
                                        while ($stock_list=mysqli_fetch_assoc($material_query)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $stock_list['m_name']; ?></td>
                                                <td><?php echo $stock_list['stock']; echo " "; echo $stock_list['m_unit']; ?>
                                                <?php if($stock_list['m_unit']=="kg" && $stock_list['stock'] < 1000 ){
                                                    ?><span class="badge badge-text anibadge badge-danger mr-3 mb-3">Low Stock</span>
                                                <?php }?> 
                                            </td>
                                            <td><?php echo $stock_list['company_name']; ?></td>
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
