<?php
    session_start();
    require 'connection.php';
    require 'session_check.php'; 
    $uid = $_SESSION['u_id'];
    $add_success = 0;
    


    if(isset($_POST['submit']))
    {
       
        $unit = $_POST['unit'];
        $material_name = $_POST['material_name'];

        $material = "INSERT INTO material (m_id, m_name,m_unit, u_id) VALUES ('','$material_name','$unit','$uid')";
        $add_material = mysqli_query($con,$material) or die("Material Add Failed");

        if($add_material)
        {
            $add_success = 1 ;
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Add Material | SMIMS</title>    
        <!-- Bootstrap-->
        <link href="lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!--Common Plugins CSS -->
        <link href="css/plugins/plugins.css" rel="stylesheet">
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
                                                <h3>Add Material</h3>
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
                                        <li class="breadcrumb-item active">Add Material</li>
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
                                            <h3>Add Material</h3> 
                                            <?php if($add_success==1){ ?>
                                            <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                                                <strong>Success!</strong> Raw Material Added.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        <?php $add_success=0; } ?>
                                        </div>
                                    </div>
                                    <form method="POST">
                                        <div class="portlet-body">
                                            <div class="form-group">
                                                <label>Select Material</label>
                                                <input type="text" class="form-control" id="em5" placeholder="Material Name" name="material_name">
                                            </div>
                                           
                                            <div class="form-group">
                                                <label>Unit</label>
                                                <select class="form-control mb-20 form-control-lg" name="unit">
                                                    <option value="kg">KG</option>
                                                    <option value="tons">Tons</option>
                                                </select>
                                            </div>
                                            

                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary mr-1 mb-2" name="submit" value="Add Material">
                                            </div>
                                        </div>
                                    </form>
                                </div><!--portlet-->  
                            </div>
                            
                        </div>
                        <div class="row">
                             <div class="container-fluid">
                          <div class="bg-white table-responsive rounded shadow-sm pt-3 pb-3 mb-30">
                              <h6 class="pl-3 pr-3 text-capitalize font400 mb-20">Manage Material</h6>
                            <table id="data-table" class="table mb-0 table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Material Name</th>
                                        <th>Unit</th>
                                        <th>Action</th>    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=1;
                                    
                                    $view = "SELECT * FROM material WHERE u_id = $uid ";
                                    $view_query = mysqli_query($con,$view) or die("View Query Failed");
                                    while($company_data=mysqli_fetch_assoc($view_query))
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $company_data['m_name']; ?></td>
                                        <td><?php echo $company_data['m_unit']; ?></td>
                                        <td>Edit</td>
                                    </tr>
                                    <?php } ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
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
                            <div class="text-muted">© Copyright 2014-2018. Smart Inventory Management System</div>
                        </div>
                    </div>
                </footer>
            </main><!-- page content end-->
        </div><!-- app's main wrapper end -->
        <!-- Common plugins -->
        <script type="text/javascript" src="js/plugins/plugins.js"></script> 
        <script type="text/javascript" src="js/appUi-custom.js"></script> 
    </body>
</html>
