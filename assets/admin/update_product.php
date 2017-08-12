<?php
/*
 * author : meshu
 */
require_once __DIR__ . '../../../controllar/db_connect.php';

$db = new DB_CONNECT();


if (isset($_GET['flag'])) {
    if ($flag = 1)
        $flag = 1;
    else
        $flag = 0;
}

$query = "select * from product_info";

$result = mysqli_query($db->connect(), $query);
?>


<?php include 'header.php'; ?>

<!--main content start-->
<section id="main-content">
    <section class="wrapper">            
        <!--overview start-->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="admin.php">Home</a></li>
                    <li><i class="fa fa-laptop"></i>Add Product</li>						  	
                </ol>
            </div>
        </div>




        <!-- Form validations -->              
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Update Product
                    </header>
                    <div class="panel-body">

                        <table class="table bootstrap-datatable countries">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Product id</th>
                                    <th>Action</th>
                                </tr>
                            </thead>   
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($rows = $result->fetch_assoc()) {
                                        ?>


                                        <tr>
                                            <td></td>
                                            <td class="maxtableimg"><img src="../../images/<?php echo $rows['image']; ?>" alt="" class="img-responsive" style="width: 30%"/></td>
                                            <td><?php echo $rows['product_name']; ?></td>
                                            <td><?php echo $rows['product_id']; ?></td>

                                            <td> 
                                                <div class="form-group">
                                                    <div class="col-lg-offset-2 col-lg-10">
                                                        <a href="./update.php?id=<?php echo $rows['product_id']; ?>"><button class="btn btn-primary" type="submit">Update</button></a>
                                                        <a href="./delete.php?id=<?php echo $rows['product_id']; ?>"><button class="btn btn-default" type="button">Delete</button></a>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>


                                        <?php
                                    }
                                }
                                ?>




                            </tbody>
                        </table>




                        <?php if (isset($flag) && $flag == 1) { ?>
                            <div class="alert alert-success fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="icon-remove"></i>
                                </button>
                                <strong>Well done!</strong> You have successfully updated a product.
                            </div>
                        <?php } ?>
                    </div>
                </section>
            </div>
        </div>

    </section>
</section>
<!--main content end-->
</section>
<?php include 'footer.php'; ?>