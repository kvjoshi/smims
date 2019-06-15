<?php
    session_start();
    require 'connection.php';
    require 'session_check.php'; 

    $add_success = 0;
    $duplicate_entry = 0;


    if(isset($_POST['submit']))
    {
        $uid = $_SESSION['u_id'];
        $company_name = $_POST['company_name'];
        $gst_no = $_POST['gst_no'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $contact_person = $_POST['contact_person'];
        $phone = $_POST['phone_number'];
        $type = $_POST['type'];

        $find="SELECT * FROM company where gst_no='$gst_no' AND u_id='$uid'";
        $find_query=mysqli_query($con,$find) or die('find company failed');

        if (mysqli_num_rows($find_query)==0) 
        {
           $insert="INSERT INTO company (c_id,u_id,company_name,address,gst_no,contact_person,phone_no,email,type) VALUES ('','$uid','$company_name','$address','$gst_no','$contact_person','$phone','$email','$type')";
            $insert_query = mysqli_query($con,$insert) or die("Add Company Failed");

            if($insert_query)
            {
                $add_success = 1;
            } 
        }
        else{
            $duplicate_entry=1;
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
                                                <h3>Add Company</h3>
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
                                        <li class="breadcrumb-item active">Add Company</li>
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
                                            <h3>Add Company</h3> 
                                            <?php if($add_success==1){ ?>
                                                <br>
                                            <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                                                <strong>Success!</strong> Company Added.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        <?php $add_success=0; } ?>
                                         <?php if($duplicate_entry==1){ ?>
                                             <br>
                                            <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                                <strong>Duplicate Entry!</strong>Company with same GST No Already exsits.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        <?php $duplicate_entry=0; } ?>
                                        </div>
                                    </div>
                                    <form method="POST">
                                        <div class="portlet-body">
                                            <div class="form-group">
                                                <label>Company Name</label>
                                                <input type="text" class="form-control form-control-lg" placeholder="Company Name" name="company_name" required="required">
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control form-control-lg" placeholder="Address" name="address" required="required">
                                            </div>
                                            <div class="form-group">
                                                <label>GST No.</label>
                                                <input type="text" class="form-control form-control-lg" placeholder="GST Number" name="gst_no" required="required">
                                            </div>
                                            <div class="form-group">
                                                <label>Contact Person</label>
                                                <input type="text" class="form-control form-control-lg" placeholder="Contact Person" name="contact_person" required="required">
                                            </div>
                                            <div class="form-group">
                                                <label for="txt1">Phone Number</label>
                                                <input id="txt1" type="text" class="form-control form-control-lg" placeholder="Phone Number" name="phone_number" required="required">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control form-control-lg" placeholder="Email" name="email" required="required">
                                            </div>
                                            <div class="form-group">
                                                <label>Type of Company</label><br/>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="S" name="type" checked="checked">
                                                    <label class="form-check-label" for="inlineCheckbox1">Supplier</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="C" name="type">
                                                    <label class="form-check-label" for="inlineCheckbox2">Customer</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary mr-1 mb-2" name="submit" value="Add Company">
                                            </div>
                                        </div>
                                    </form>
                                </div><!--portlet-->   
                            </div>
                            <div class="col-lg-6">
                                <div class="page-content">
                    <div class="container-fluid">
                          <div class="bg-white table-responsive rounded shadow-sm pt-3 pb-3 mb-30">
                              <h6 class="pl-3 pr-3 text-capitalize font600 mb-20">Available Companies</h6>
                            <table id="data-table" class="table mb-0 table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        
                                        <th>Company Name</th>
                                        <th>GST No.</th>
                                        <th>Type</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                    $uid = $_SESSION['u_id'];
                                    $view = "SELECT * FROM company WHERE u_id = $uid ";
                                    $view_query = mysqli_query($con,$view) or die("View Query Failed");
                                    while($company_data=mysqli_fetch_assoc($view_query))
                                    {
                                    ?>
                                    <tr>
                                        
                                        <td><?php echo $company_data['company_name']; ?></td>
                                        <td><?php echo $company_data['gst_no']; ?></td>
                                        <td><?php if($company_data['type']=="C"){ ?>
                                            <span class="badge badge-text badge-primary mr-2 mb-2">Customer</span> <?php } 
                                            if($company_data['type']=="S"){ ?> <span class="badge badge-text badge-success mr-2 mb-2">Supplier</span> <?php } ?></td>
                                        
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
        <script type="text/javascript" src="lib/data-tables/jquery.dataTables.min.js"></script> 
        <script type="text/javascript" src="lib/data-tables/dataTables.bootstrap4.min.js"></script> 
        <script type="text/javascript" src="lib/data-tables/dataTables.responsive.min.js"></script> 
        <script type="text/javascript" src="lib/data-tables/responsive.bootstrap4.min.js"></script> 
        <script src="js/plugins-custom/datatables-custom.js"></script>
    </body>
</html>
