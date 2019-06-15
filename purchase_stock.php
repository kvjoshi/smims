<?php
    session_start();
    require 'connection.php';
    require 'session_check.php'; 
    
    $uid = $_SESSION['u_id'];
    $purchase_success = 0;

    if(isset($_POST['purchase']))
    {
        $m_id = $_POST['m_id'];
        $c_id = $_POST['c_id'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        $purchase = "INSERT INTO purchase (purchase_id, m_id, u_id, c_id, unit_price, quantity) VALUES ('','$m_id','$uid','$c_id','$price','$quantity')";
        
        $purchase_query = mysqli_query($con,$purchase) or die("Purchase failed");
        

        if($purchase_query)
        {
            $purchase_success = 1;
            $check = "SELECT * FROM stock WHERE u_id = '$uid' AND m_id = '$m_id' AND c_id = '$c_id'";
            $check_query = mysqli_query($con,$check) or die("Cant fetch");
            if(mysqli_num_rows($check_query)==0)
            {
                $stock = "INSERT INTO stock (stock_id, u_id, m_id, c_id, stock) VALUES ('','$uid','$m_id','$c_id','$quantity')";
                $stock_query = mysqli_query($con,$stock) or die("stock add failed");
            }
            if (mysqli_num_rows($check_query)==1)
            {
                $stock_update = "UPDATE stock SET stock=stock+'$quantity' WHERE u_id = '$uid' AND m_id = '$m_id' AND c_id = '$c_id' ";
                $stock_update_query = mysqli_query($con,$stock_update) or die("Cant Update Stock ");
            }
            
        }
    }
    if (isset($_GET['del_id'])) {
        $del_id=$_GET['del_id'];
        

        $delete = "UPDATE `purchase` SET `delete_flag`=1 WHERE purchase_id = $del_id ";
       
        $delete_query = mysqli_query($con,$delete) or die("Delete Failed");
    
    }
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Purchase | SMIMS</title>    
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
                                                <h3>Purchase Material</h3>
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
                                        <li class="breadcrumb-item active">Purchase Material</li>
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
                                            <h3>Purchase</h3> 
                                            <?php if($purchase_success == 1){ ?>
                                            <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                                                <strong>Success!</strong> Stock Purchased.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        <?php $purchase_success=0; } ?>
                                        </div>
                                    </div>
                                    <form method="POST">
                                        <div class="portlet-body">
                                            <div class="form-group">
                                                <label>Select Material</label>
                                                <select class="form-control mb-20 form-control-lg" name="m_id">
                                                    <?php 
                                                    $material = "SELECT * FROM material WHERE u_id = $uid";
                                                    $material_query = mysqli_query($con,$material) or die("couldnt fetch material");
                                                    while($m_data = mysqli_fetch_assoc($material_query))
                                                    {
                                                    ?>
                                                    <option value="<?php echo $m_data['m_id']; ?>"><?php echo $m_data['m_name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Select Company</label>
                                                <select class="form-control mb-20 form-control-lg" name="c_id">
                                                    <?php 
                                                    $company = "SELECT * FROM company WHERE u_id = $uid AND type = 'S'";
                                                    $company_query = mysqli_query($con,$company) or die("couldnt fetch material");
                                                    while($c_data = mysqli_fetch_assoc($company_query))
                                                    {
                                                    ?>
                                                    <option value="<?php echo $c_data['c_id']; ?>"><?php echo $c_data['company_name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Unit Price</label>
                                                <input type="text" class="form-control form-control-lg" placeholder="Unit Price" name="price">
                                            </div>
                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input type="text" class="form-control form-control-lg" placeholder="Quantity" name="quantity">
                                            </div>

                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary mr-1 mb-2" name="purchase" value="Purchase">
                                            </div>
                                        </div>
                                    </form>
                                </div><!--portlet-->  
                            </div>
                           
                        </div>
                        <div class="row">
                             <div class="container-fluid">
                          <div class="bg-white table-responsive rounded shadow-sm pt-3 pb-3 mb-30">
                              <h6 class="pl-3 pr-3 text-capitalize font400 mb-20">Purchase Details</h6>
                            <table id="data-table" class="table mb-0 table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Date</th>
                                        <th>Material Name</th>
                                        <th>Unit</th>
                                        <th>Purchase Amount</th>
                                        <th>Company</th>
                                        <th>Action</th>    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=1;
                                    
                                    $view = "SELECT * FROM purchase as p,material as m  WHERE p.m_id=m.m_id AND p.u_id=$uid  ";
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
                                            <?php echo $company_data['purchase_date']; ?>
                                        </td>
                                        <td>
                                            <?php if($company_data['delete_flag']==1){ echo "<del>";} ?>
                                            <?php echo $company_data['m_name']; ?>
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
                                            <?php if($company_data['delete_flag']==0){?>
                                            <a href="purchase_stock.php?del_id=<?php echo $company_data['purchase_id']; ?>&mid=<?php echo $company_data['m_id']; ?>&quantity=<?php echo $company_data['quantity'];?>" class="btn btn-outline-danger btn-sm mr-1 mb-2">Delete</a></td>
                                        <?php }?>
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
        <script type="text/javascript" src="lib/data-tables/jquery.dataTables.min.js"></script> 
        <script type="text/javascript" src="lib/data-tables/dataTables.bootstrap4.min.js"></script> 
        <script type="text/javascript" src="lib/data-tables/dataTables.responsive.min.js"></script> 
        <script type="text/javascript" src="lib/data-tables/responsive.bootstrap4.min.js"></script> 
        <script src="js/plugins-custom/datatables-custom.js"></script>
    </body>
</html>
