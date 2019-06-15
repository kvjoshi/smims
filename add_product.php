<?php
    session_start();
    require 'connection.php';
    require 'session_check.php';

    $add_success = 0;


    if(isset($_POST['add_product']))
    {
        $uid = $_SESSION['u_id'];
        $product_name = $_POST['product_name'];
        $unit = $_POST['product_unit'];
        $price = $_POST['unit_price'];
        

        $add_product="INSERT INTO products (p_id, product_name, unit, unit_price, u_id) VALUES ('','$product_name','$unit','$price','$uid')";
        $add_query = mysqli_query($con,$add_product) or die("Add Product Failed");

        if($add_query)
        {
            $add_success = 1;
        } 
    }
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Add Company | SMIMS</title>    
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
            <?php require 'sidebar.php'; ?><!-- page-aside end-->
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
                                                <h3>Add Product</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 d-flex justify-content-end h-md-down">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb no-padding bg-trans mb-30">
                                        <li class="breadcrumb-item"><a href="index.php"><i class="icon-Home mr-2 fs14"></i></a></li>
                                        <li class="breadcrumb-item">Pages</li>
                                        <li class="breadcrumb-item active">Add Product</li>
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
                                <div class="portlet-box portlet-gutter ui-buttons-col mb-30">
                                    <div class="portlet-header flex-row flex d-flex align-items-center b-b">
                                        <div class="flex d-flex flex-column">
                                            <h3>Add Product</h3> 
                                            <?php if($add_success == 1){ ?>
                                            <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                                                <strong>Success!</strong> Product Added.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        <?php $add_success = 0; } ?>
                                        </div>
                                    </div>
                                    <form method="POST">
                                        <div class="portlet-body">
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input type="text" class="form-control form-control-lg" placeholder="Product Name" name="product_name">
                                            </div>
                                            <div class="form-group">
                                                <label>Unit</label>
                                                <select class="form-control mb-20 form-control-lg" name="product_unit">
                                                    <option value="kg">KG</option>
                                                    <option value="
                                                    ">TONS</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Unit Price</label>
                                                <input type="text" class="form-control form-control-lg" placeholder="Unit Price" name="unit_price">
                                            </div>
                                            
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary mr-1 mb-2" name="add_product" value="Add Product">
                                            </div>
                                        </div>
                                    </form>
                                </div><!--portlet-->
                               
                            </div>
                           <div class="col-lg-6">
                                <div class="page-content">
                    <div class="container-fluid">
                          <div class="bg-white table-responsive rounded shadow-sm pt-3 pb-3 mb-30">
                              <h6 class="pl-3 pr-3 text-capitalize font600 mb-20">Available Products</h6>
                            <table id="data-table" class="table mb-0 table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Sr.no</th>
                                        <th>Product Name</th>
                                        <th>Unit</th>
                                        <th>Unit Price</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=1;
                                    $uid = $_SESSION['u_id'];
                                    $view = "SELECT * FROM products WHERE u_id = $uid ";
                                    $view_query = mysqli_query($con,$view) or die("View Query Failed");
                                    while($company_data=mysqli_fetch_assoc($view_query))
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $company_data['product_name']; ?></td>
                                        <td><?php echo $company_data['unit']; ?></td>
                                        <td><?php echo $company_data['unit_price']; ?></td>
                                        
                                    </tr>
                                    <?php } ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
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
        <!-- Required datatable js -->
        <script type="text/javascript" src="lib/data-tables/jquery.dataTables.min.js"></script> 
        <script type="text/javascript" src="lib/data-tables/dataTables.bootstrap4.min.js"></script> 
        <script type="text/javascript" src="lib/data-tables/dataTables.responsive.min.js"></script> 
        <script type="text/javascript" src="lib/data-tables/responsive.bootstrap4.min.js"></script> 
        <script src="js/plugins-custom/datatables-custom.js"></script>
    </body>
</html>
