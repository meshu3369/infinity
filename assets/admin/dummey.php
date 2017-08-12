<?php
$query_string = "1";
echo '<a href="../../index.php?user_id=' . base64_encode($query_string) . '">hellow</a>';
$s = base64_encode($query_string);
echo base64_decode($s);
?>
