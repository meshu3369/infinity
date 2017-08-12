<?php
/*
 * author : meshu
 */
require_once __DIR__ . '../../../controllar/db_connect.php';

$db = new DB_CONNECT();


$id = $_GET['id'];

$qur = "delete from product_info where product_id='$id'";
$result_search = mysqli_query($db->connect(), $qur);

if($result_search){
    header("Location:update_product.php");
}


?>