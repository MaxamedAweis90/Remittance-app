<?php
include("./../tools/function.php");
$sql=$_POST['sql'];
// if($sql == "all"){
// $s1 = generateBalanceSheet();
// echo $s1;
// // echo $sql;
// }
// else{
// $r = explode(",",$sql);
$ss = generateBalanceSheet1($sql);

echo $ss;

// echo $r[1];

// }


?>

