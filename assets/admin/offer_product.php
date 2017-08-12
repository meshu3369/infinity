<?php
/*
 * author : meshu
 */
require_once __DIR__ . '../../../controllar/db_connect.php';

$db = new DB_CONNECT();


if(isset($_REQUEST['submit1'])){
    $discount = $_REQUEST['discount_on'];
    $product_id = $_REQUEST['product_id'];
    $que = "UPDATE product_info set discount = '$discount' where product_id='$product_id'";
    $result = mysqli_query($db->connect(), $que);
    if($result){
        echo "<script>alert('Successfully updated')</script>";
    }
}

$query = "select * from product_info";

$result = mysqli_query($db->connect(), $query);
?>


   <?php include 'header.php';?>

            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">            
                    <!--overview start-->
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-home"></i><a href="admin.php">Home</a></li>
                                <li><i class="fa fa-laptop"></i>Add Offer</li>						  	
                            </ol>
                        </div>
                    </div>




                    <!-- Form validations -->              
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                   offer product
                                </header>
                                <div class="panel-body">
                                    <div class="panel-body">
                                        <table class="table bootstrap-datatable countries">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Product Image</th>
                                                    <th>Product Name</th>
                                                    <th>Product id</th>
                                                    <th>Discount</th>
                                                
                                                </tr>
                                            </thead>   
                                            <tbody>
                                                <?php
                                                if ($result->num_rows > 0) {
                                                    while ($rows = $result->fetch_assoc()) {
                                                        ?>


                                                        <tr>
                                                            <td></td>
                                                            <td><img src="../../images/<?php echo $rows['image']; ?>" alt="" class="img-responsive"/></td>
                                                            <td><?php echo $rows['product_name']; ?></td>
                                                            <td><?php echo $rows['product_id']; ?></td>
                                                            <td>
                                                                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
                                                                    <input  name="discount_on" type="number" value="<?php echo $rows['discount']; ?>">
                                                                    <input  name="product_id" type="hidden" value="<?php echo $rows['product_id']; ?>">
                                                                      
                                                               
                                                                        <button class="btn btn-primary" name="submit1" type="submit">Update</button>
                                                                
                                                                </form>
                                                            </td>

                                                          

                                                        </tr>


                                                        <?php
                                                    }
                                                }
                                                ?>




                                            </tbody>
                                        </table>
                                    </div>



                                </div>
                            </section>
                        </div>
                    </div>

                </section>
            </section>
            <!--main content end-->
        </section>
        <!-- container section start -->

        <?php include 'footer.php';?>