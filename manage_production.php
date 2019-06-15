<?php
    session_start();
    require 'connection.php';
    require 'session_check.php'; 
    $uid = $_SESSION['u_id'];


    if (isset($_GET['use_id'])) {

        $use = "UPDATE `production` SET `status`='U' WHERE `production_id` = '".$_GET['use_id']."'";
        $use_query = mysqli_query($con,$use) or die('cant update status');

         $materials="SELECT material FROM production WHERE production_id = '".$_GET['use_id']."'";
        $material_query=mysqli_query($con,$materials) or die('cant fetch materials');
        $material_data=mysqli_fetch_assoc($material_query);

        $hold_material="INSERT INTO `hold_stock` (`hold_id`, `production_id`, `stock_details`, `u_id`) VALUES ('','".$_GET['use_id']."','".$material_data['material']."',$uid)";
        $hold_query=mysqli_query($con,$hold_material) or die('Hold Query Failed');
       
    }
    if (isset($_GET['hold_id'])) {

        $use = "UPDATE `production` SET `status`='H' WHERE `production_id` = '".$_GET['hold_id']."'";
        $use_query = mysqli_query($con,$use) or die('cant update status');
        
       

    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Manage Production</title>    
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
                                                <h3>Manage Production</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 d-flex justify-content-end h-md-down">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb no-padding bg-trans mb-30">
                                        <li class="breadcrumb-item"><a href="index.html"><i class="icon-Home mr-2 fs14"></i></a></li>
                                        <li class="breadcrumb-item">Production</li>
                                        <li class="breadcrumb-item active">Manage Production</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="page-content">
                    <div class="container-fluid">
                          <div class="bg-white table-responsive rounded shadow-sm pt-3 pb-3 mb-30">
                              <h6 class="pl-3 pr-3 text-capitalize font400 mb-20">Manage Production Sheets</h6>
                            <table id="data-table" class="table mb-0 table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Sheet Name</th>
                                        <th>Product Name</th>
                                        <th>Status</th>
                                        <th>Action</th>    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=1;
                                   
                                    $view = "SELECT * FROM production WHERE u_id = $uid ";
                                    $view_query = mysqli_query($con,$view) or die("View Query Failed");
                                    while($company_data=mysqli_fetch_assoc($view_query))
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $company_data['production_name']; ?></td>
                                        <td><?php echo $company_data['material']; ?></td>
                                       
                                        <td><?php if($company_data['status']=="H"){ ?>
                                            <span class="badge badge-text badge-warning mr-2 mb-2">Hold</span> <?php } 
                                            if($company_data['status']=="U"){ ?> <span class="badge badge-text badge-success anibadge h2 mr-2 mb-2">In Use</span> <?php } ?></td>
                                         <td><?php if($company_data['status']=="H"){ ?>
                                            <a href="manage_production.php?use_id=<?php echo $company_data['production_id']; ?>" class="btn btn-shadow btn-gradient btn-gradient-success mr-1 mb-2">Use</a> <?php } 
                                            if($company_data['status']=="U"){ ?> <a href="manage_production.php?hold_id=<?php echo $company_data['production_id']; ?>" class="btn btn-shadow btn-gradient btn-gradient-warning">Hold</a> <?php } ?></td>
                                    </tr>
                                    <?php } ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
               <?php require 'footer.php' ?>
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
