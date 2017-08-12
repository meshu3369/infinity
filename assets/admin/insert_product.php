<?php
/*
 * author : meshu
 */
require_once __DIR__ . '../../../controllar/db_connect.php';

$db = new DB_CONNECT();
$product_name = $product_id = $description = $category_name = '';
$quantity = $unitPrice = 0;





if (isset($_REQUEST['submit'])) {

  
        if (isset($_FILES['image'])) {
            $errors = array();
            $file_name = $_FILES['image']['name'];

            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

            $expensions = array("jpeg", "jpg", "png");

            if (in_array($file_ext, $expensions) === false) {
                $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            }

            if ($file_size > 2097152) {
                $errors[] = 'File size must be excately 2 MB';
            }

            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, "../../images/" . $file_name);
            } else {
                print_r($errors);
            }
        }

    if (isset($_REQUEST['product_name']))
        $product_name = $_REQUEST['product_name'];
    if (isset($_REQUEST['product_id']))
        $product_id = $_REQUEST['product_id'];
    if (isset($_REQUEST['unitPrice']))
        $unitPrice = $_REQUEST['unitPrice'];
    if (isset($_REQUEST['quantity']))
        $quantity = $_REQUEST['quantity'];
    if (isset($_REQUEST['description']))
        $description = $_REQUEST['description'];
    if (isset($_REQUEST['category_name']))
        $category_name = $_REQUEST['category_name'];


    $date = new DateTime('now');
    $date = $date->format('Y-m-d H:i:s');
    $admin = 1;

    $query = "INSERT into product_info (product_name,product_id,unitPrice,quantity,description,category_name,time,admin_id,image,rating) values ('$product_name','$product_id','$unitPrice','$quantity','$description','$category_name','$date','$admin','$file_name',0)";

    //$query = "update product_info set product_name='fuck you' where product_id='56'";

    $result = mysqli_query($db->connect(), $query);
}
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
                        Add Product
                    </header>
                    <div class="panel-body">
                        <div class="form" >
                            <form class="form-validate form-horizontal" id="feedback_form" action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group ">
                                    <label for="cname" class="control-label col-lg-2">Product Name<span class="required">*</span></label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="cname" name="product_name" minlength="5" type="text" required />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="cemail" class="control-label col-lg-2">Product id<span class="required">*</span></label>
                                    <div class="col-lg-10">
                                        <input class="form-control " id="cemail" type="text" name="product_id" required />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="curl" class="control-label col-lg-2">Category Name</label>
                                    <div class="col-lg-10">
                                        <input class="form-control " id="curl" type="text" name="category_name" />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="cname" class="control-label col-lg-2">Unit Price<span class="required">*</span></label>
                                    <div class="col-lg-10">
                                        <input class="form-control" id="subject" name="unitPrice" minlength="5" type="number" required />
                                    </div>
                                </div>                                      
                                <div class="form-group ">
                                    <label for="quantity" class="control-label col-lg-2">Quantity<span class="required">*</span></label>
                                    <div class="col-lg-10">
                                        <input class="form-control" name="quantity" minlength="5" type="number" required />
                                    </div>
                                </div>                                      
                                <div class="form-group ">
                                    <label for="description" class="control-label col-lg-2">description</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control "  name="description" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="picture" class="control-label col-lg-2">Image<span class="required">*</span></label>
                                    <div class="col-lg-10">
                                        <input name="image" type="file" id="file_input" required/>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-primary" type="submit" name="submit">Save</button>
                                        <button class="btn btn-default" type="button">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>
                </section>
            </div>
        </div>

    </section>
</section>
<!--main content end-->
</section>
<?php include 'footer.php' ?>