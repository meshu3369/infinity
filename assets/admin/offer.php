<?php
/*
 * author : meshu
 */
require_once __DIR__ . '../../../controllar/db_connect.php';

$db = new DB_CONNECT();

$discount = $_POST['discount'];
$id = $_GET['id'];
echo $discount." ".$id;



$query = "select * from product_info";
$query1 = "insert into offer (product_id,discount) values('$product_id','$discount')";

mysqli_query($db->connect(), $query);
mysqli_query($db->connect(), $query1);

$db->close();

?>
