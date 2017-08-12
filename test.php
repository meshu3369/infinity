<?php 
  /*
 * author : meshu
 */

require_once __DIR__ . '/controllar/db_connect.php';
$db = new DB_CONNECT();

if($db){
    echo "success";
}


?>